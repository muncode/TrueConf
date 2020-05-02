<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// GET user
$app->get('/api/user', function(Request $request, Response $response){

  $file = file_get_contents("../src/routes/user.json");

  $json_a = json_decode($file, true);

  try{
    if ($json_a){
      foreach ($json_a as $json_b){
        echo "id - " . $json_b["id"] . "; ";
        echo "name - " . $json_b["name"] . "<br/>";
      }
    }else {
      echo "Users пуст";
    }
  }catch(Exception $e){
    echo '{"Ошибка" : {"текст":'.$e->getMessage().'}';
  }
});

// GET user по ID
$app->get('/api/user/', function(Request $request, Response $response){
  $id = $request->getParam('id');
  $file = file_get_contents("../src/routes/user.json");

  $json_a = json_decode($file, true);
  try{
    if ($json_a){
      foreach ($json_a as $json_b){
        if ($json_b["id"] == $id){
          echo "id - " . $json_b["id"] . "; ";
          echo "name - " . $json_b["name"] . "<br/>";
        }
      }
    }else {
      echo "Users пуст";
    }
  }catch(Exception $e){
    echo '{"Ошибка" : {"текст":'.$e->getMessage().'}';
  }
});

// POST добваить user
$app->post('/api/user/', function(Request $request, Response $response){
  $name = $request->getParam('name');
  $file = file_get_contents("../src/routes/user.json");
  $json_a = json_decode($file, true);
  try{
    if ($json_a){
      array_push($json_a,array ("id" => $json_a[array_key_last($json_a)]["id"]+1,"name" => $name));
      foreach ($json_a as $json_b){
        echo "id - " . $json_b["id"] . "; ";
        echo "name - " . $json_b["name"] . "<br/>";
      }
      echo "user добавлен";
      file_put_contents("../src/routes/user.json", json_encode($json_a));
    }else {
      $json_a = array (array ("id" => 1,"name" => $name));
      file_put_contents("../src/routes/user.json", json_encode($json_a));
    }
  }catch(Exception $e){
    echo '{"Ошибка" : {"текст":'.$e->getMessage().'}';
  }
});

// PATCH изменить user
$app->patch('/api/user/', function(Request $request, Response $response){
   $id = $request->getParam('id');
   $name = $request->getParam('name');
   $file = file_get_contents("../src/routes/user.json");

  $json_a = json_decode($file, true);
  try{
    if ($json_a){
      foreach ($json_a as $json_b => $val){
        if ($json_a[$json_b]["id"] == $id){
          $json_a[$json_b]["name"] = $name;
          echo $json_a[$json_b]["id"] . "<br/>";
          echo "user изменен";
        }
      }
      file_put_contents("../src/routes/user.json", json_encode($json_a));
    }else {
      echo "Users пуст";
    }
  }catch(Exception $e){
    echo '{"Ошибка" : {"текст":'.$e->getMessage().'}';
  }
});

// DELETE удалить user
$app->delete('/api/user/', function(Request $request, Response $response){
   $id = $request->getParam('id');
   $file = file_get_contents("../src/routes/user.json");

  $json_a = json_decode($file, true);
  try{
    if ($json_a){
         foreach ($json_a as $json_b => $val){
        if ($json_a[$json_b]["id"] == $id){
          unset($json_a[$json_b]);
          echo "user удален";
        }
      }
file_put_contents("../src/routes/user.json", json_encode($json_a));
    }else {
      echo "Users пуст";
    }
  }catch(Exception $e){
    echo '{"Ошибка" : {"текст":'.$e->getMessage().'}';
  }

});
?>

<form method="GET" action="user/" enctype="application/json">
  <input name="id" type="number" placeholder="id"/>
  <input type="submit" value="Пользователь по ID"/>
 </form>

<form method="POST" action="user/" enctype="application/json">
  <input name="name" type="текст" placeholder="name"/>
  <input type="submit" value="Добавить"/>
 </form>

<form method="POST" action="user/" enctype="application/json">
  <input type="hidden" name="_METHOD" value="PATCH">
  <input name="id" type="number" placeholder="id"/>
  <input name="name" type="текст" placeholder="name"/>
  <input type="submit" value="Изменить"/>
 </form>

<form method="POST" action="user/" enctype="application/json">
  <input type="hidden" name="_METHOD" value="DELETE">
  <input name="id" type="number" placeholder="id"/>
  <input type="submit" value="Удалить"/>
 </form>


<?


