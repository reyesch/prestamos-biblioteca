<!DOCTYPE html>
<html lang="es">
<?php

//modificar
session_start();

  $form = $_SESSION["form"];
  unset($_SESSION["form"]);
  unset($_SESSION["errors"]);

echo $form["user"];
echo $form["book"];
echo $form["radio"];
echo $form["ip"];
echo $form["date"];



?>

<button id="return">ATRÁS</button>
<script>
var ret = document.getElementById("return");
ret.addEventListener(
  'click',function(){
    document.location.href = 'prueba.php';
  }
);
</script>

</html>
