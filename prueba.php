<?php

session_start();

if(!isset($_SESSION["form"])){
  $form['radio']="";
  $form['user']="";
  $form['book']="";
  $_SESSION["form"] = $form;
}else
$form = $_SESSION["form"];

//Mesage
if(isset($_SESSION["errors"])){
  foreach ($_SESSION["errors"] as $msg) {
    echo $msg;
  }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
      <meta http-equiv="content-type" content="text/html" charset="utf-8">
      <link rel="stylesheet" href="style.css">
    </head>
  <body>
    <section>
      <form method="get" action="validate.php">
        <div class="cell" id="radio">
          <input type="radio" name="radio" value="L"/>
          <label>Préstamo</label>
          <input type="radio" name="radio" value="R" />
          <label>Devolución</label>
        </div>
        <div class="cell" id="user">
          <label class="labcell">Usuario</label>
          <input type="text" name="user" required/>
        </div>
        <div class="cell" id="book">
          <label class="labcell">Libro</label>
          <input type="text" name="book" required/>
        </div>
        <div class="cell">
          <button id ="send" type="submit">Enviar</button>
        </div>
      </form>
    </section>
  </body>
</html>
