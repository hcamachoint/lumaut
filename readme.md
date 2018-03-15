<h1>Lumen auth</h1>

<p>Autenticacion de usuarios con Lumen</p>
<lu>
  <li>Registro de usuarios</li>
  <li>Confirmacion de correo</li>
  <li>Autenticacion de usuario</li>
  <li>Actualizacion de pefil de usuario</li>
  <li>Eliminar usuario</li>
</lu>
<br>
<p>php artisan migrate:refresh --seed</p>
<p>php -S localhost:8000 -t public</p>
<p>curl --request POST --data "email=admin@localhost.dev&password=admin" http://localhost:8000/login</p>
