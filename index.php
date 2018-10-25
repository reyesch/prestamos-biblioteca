<?php
session_start();
unset($_SESSION["form"]);
date_default_timezone_set('Europe/Madrid');

?>

<!DOCTYPE html>
<html lang="es">
    <head>
      <meta http-equiv="content-type" content="text/html" charset="utf-8">
      <script src="validate.js" type="text/javascript"></script>
      <link rel="stylesheet" href="style.css">
    </head>
  <body>
    
    <section id="form">
      <h1>BIBLIOTECA DE</h1>
      <form method="post" onsubmit="return validateForm()" action="validate.php">
        <div class="cell" id="radio">
          <input type="radio" name="radio" id="radioL" onclick="inputColor()" value="L" required/>
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
        <input type="hidden" name="bib" value="generic">
        <div class="cell">
          <button id ="send" type="submit">Enviar</button>
        </div>
      </form>
    </section>
    <section id="date">
      <?php echo "DEVOLVER EN 21 DÍAS </br><h2>".date('d-m-Y', strtotime("+21 days"))."</h2>";?>
    </section>

    <script type="text/javascript">
    function inputColor(){
      if(document.getElementById("radioL").checked){
        document.getElementById("form").style.backgroundColor = "#d98880";
      }else{
        document.getElementById("form").style.backgroundColor = "#52be80";
      }
    }    
    <?php if(isset($_SESSION["errors"])){ ?>
        alert("<?php
          foreach ($_SESSION["errors"] as $msg) {
          echo $msg.'\n';
        }?>");
    <?php }; ?>
    </script>
    <?php unset($_SESSION["errors"]);?>
  </body>
</html>
