<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'string | required',
            'email' => 'required | email | unique:users',
            'password' => 'string | required | confirmed'
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = app('hash')->make($request->input('password'));
        $user->api_token = str_random(128);
        $user->save();

        return new JsonResponse([
            'message' => 'Successfully registered!',
            'authorization' => $user->api_token,
        ], 200);
    }

    public function password(Request $request)
    {
      $this->validate($request, [
          'password' => 'string | required | confirmed'
      ]);

      $user = $request->user();

      if (app('hash')->check($request->opassword, $user->password)){
        $user->password = app('hash')->make($request->password);
        $user->save();

        return new JsonResponse([
            'message' => 'Successfully password changed!'
        ], 200);
      }

      return new JsonResponse([
          'message' => 'An error occurred with the old password, it does not match the one entered in the form.'
      ], 400);
    }

    public function delete(Request $request)
    {
      $user = $request->user();
      $user->delete();

      return new JsonResponse([
          'message' => 'Successfully deleted.',
      ], 200);
    }

}
