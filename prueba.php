<?php

session_start();


date_default_timezone_set('Europe/Madrid');

?>

<!DOCTYPE html>
<html lang="es">
    <head>
      <meta http-equiv="content-type" content="text/html" charset="utf-8">
      <link rel="stylesheet" href="style.css">
    </head>
  <body>
    <?php if(isset($_SESSION["errors"])){ ?>
    <div id="errors">
      <?php
        foreach ($_SESSION["errors"] as $msg) {
          echo $msg;
      }?>
      <button onlick="close()">Cerrar</button>
    </div>
  <?php } ?>
    <section id="form">
      <h1>BIBLIOTECA DE</h1>
      <form method="post" action="validate.php">
        <div class="cell" id="radio">
          <input type="radio" name="radio" id="radioL" onclick="inputColor()" value="L"/>
          <label>Préstamo</label>
          <input type="radio" name="radio" id="radioR" onclick="inputColor()" value="R" />
          <label>Devolución</label>
        </div>
        <div class="cell" id="user">
          <label class="labCell">Usuario</label>
          <input type="text" id="userInput" name="user" required/>
        </div>
        <div class="cell" id="book">
          <label class="labCell">Libro</label>
          <input type="text" id="bookInput" name="book" required/>
        </div>
        <input type="hidden" value="generic">
        <div class="cell">
          <button id ="send" type="submit">Enviar</button>
        </div>
      </form>
    </section>
    <section id="date">
      <?php echo "DEVOLVER EL DÍA ".date('d-m-Y', strtotime("+21 days"));?>
    </section>

    <script type="text/javascript">
    
    function close(){
      document.getElementById("errors").style.display = "none";
    }
    function inputColor(){
      document.getElementById("bookInput").style.color = "#fff";
      if(document.getElementById("radioL").checked){
        document.getElementById("userInput").style.boxShadow = "0 0 0.5em #990000";
        document.getElementById("bookInput").style.backgroundColor = "#990000";
      }else{
        document.getElementById("userInput").style.boxShadow = "0 0 0.5em green";
        document.getElementById("bookInput").style.backgroundColor = "green";
      }
    }
    </script>
    <?php unset($_SESSION["errors"]);?>
  </body>
</html>
