<?php
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  require __DIR__ . '/../vendor/autoload.php';
  // Rout user
  require '../src/routes/user.php';
  // Запускаем приложение
  $app->run();
 ?>
<br/>
<a href="http://myproject/public/api/user">http://myproject/public/api/user</a>

