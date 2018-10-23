<!DOCTYPE html>
<html lang="es">
<?php

//modificar
session_start();
  $form = $_SESSION["form"];
  unset($_SESSION["errors"]);
?>
<body>
<table>
  <tr><td>Usuario: <?php echo $form["user"];?></td></tr>
  <tr><td>Libro: <?php echo $form["book"];?></td></tr>
  <tr><td>Tipo de préstamo: <?php echo $form["radio"];?></td></tr>
  <tr><td>Servidor: <?php echo $form["ip"];?></td></tr>
  <tr><td>Fecha y hora: <?php echo $form["date"];?></td></tr>
</table>
<button id="return">ATRÁS</button>

<script>
var ret = document.getElementById("return");
ret.addEventListener(
  'click',function(){
    document.location.href = 'index.php';
  }
);
</script>
</body>
</html>
