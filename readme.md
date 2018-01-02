<h1>Lumen auth</h1>
<p>Lument authentication</p>
<br>
<p>php artisan migrate:refresh --seed</p>
<p>php -S localhost:8000 -t public</p>
<p>curl --request POST --data "email=admin@localhost.dev&password=admin" http://localhost:8000/login</p>
