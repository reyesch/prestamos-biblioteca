<?php
session_start();
if(isset($_SESSION["form"])){
  $form = $_SESSION["form"];
}
date_default_timezone_set('Europe/Madrid');

?>

<!DOCTYPE html>
<html lang="es">
    <head>
      <meta http-equiv="content-type" content="text/html" charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="validate.js" type="text/javascript"></script>
      <link rel="stylesheet" href="style.css">
    </head>
  <body>
    
    <!--TODO MENSAJES EMERGENTES-->
    <?php if(isset($_SESSION["errors"])){ ?>
    <div class="alert warning">
      <span class="closebtn">&times;</span>  
      <?php
            foreach ($_SESSION["errors"] as $msg) {
            echo $msg;
          } ?>
    </div>
        <?php  }; ?>
    <?php if(isset($_SESSION["form"])){ ?>
    <div class="alert">
      <span class="closebtn">&times;</span> 
      <h1>Préstamo realizado correctamente.</h1> 
      <?php
       echo "USUARIO: ".$form["user"]."</br></br>";
       echo "LIBRO: ".$form["book"]."</br></br>";
       echo "SERVICIO: ".$form["radio"]."</br></br>";
       echo "FECHA: ".$form["date2"]."";
       ?>
    </div>
        <?php  };
        unset($_SESSION["form"]);
        $form = '';
         ?>
    <div class="alert warning" id="alert">
        <span class="closebtn">&times;</span>  
        </div>
      </div>
    <!---->
    
    
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
    //TODO NUEVO SCRIPT    
    var close = document.getElementsByClassName("closebtn");
    var i;
    for (i = 0; i < close.length; i++) {
        close[i].onclick = function(){
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function(){ div.style.display = "none"; }, 600);
        }
    }
    </script>
    <?php unset($_SESSION["errors"]);?>
  </body>
</html>
