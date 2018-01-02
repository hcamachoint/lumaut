<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

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
        $user->token = str_random(25);
        $user->save();

        $data = $user->toArray();
        $data['url'] = route('confirmation', ['token' => $user->token]);
        Mail::send('email.confirmation', $data, function($message) use($data){
          $message->to($data['email']);
          $message->subject('Registration Confirmation');
        });

        return new JsonResponse([
            'message' => 'Successfully registered! Please confirm your account with the link that we have sent to your email.',
        ], 200);
    }

    public function confirmation($token)
    {
      $user = User::where('token', $token)->first();
      if (!is_null($user)) {
        $user->confirmed = 1;
        $user->token = '';
        $user->api_token = str_random(128);
        $user->save();
        return new JsonResponse([
            'message' => 'Your account has been confirmed!',
            'authorization' => $user->api_token,
        ], 200);
      }
      return new JsonResponse([
          'message' => 'The sent token has already been confirmed or is not associated with any user.',
      ], 400);
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
