<?php
$servername = "localhost";
$dbname = 'sqlite:DB/prestamos.slite';
$sql = '';
//$form='';
session_start();
$form= $_SESSION["form"];
$id = $form["date"].$form["user"].$form["book"];
$id = md5($id);
$form["user"];
csvExport($id,$form["radio"],$form["ip"],$form["date"],$form["bib"],$form["user"],$form["book"]);
//TODO csv2
csvExport2($form["radio"],$form["date2"],$form["user"],$form["book"]);

try {
    $conn = new PDO($dbname);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO prestamosydevoluciones (idform, tipotransaccion, iptransaccion, fechayhora, biblioteca, usuario, libro)
    VALUES (:idform,:tipotransaccion,:iptransaccion,:fechayhora,:biblioteca,:usuario,:libro)";
    $conn = $conn->prepare($sql);
    $conn->bindParam(":idform",$id);
    $conn->bindParam(":tipotransaccion",$form["radio"],PDO::PARAM_STR);
    $conn->bindParam(":iptransaccion",$form["ip"],PDO::PARAM_STR);
    $conn->bindParam(":fechayhora",$form["date"],PDO::PARAM_STR);
    //TODO bindParam biblioteca
    $conn->bindParam(":biblioteca",$form["bib"],PDO::PARAM_STR);
    $conn->bindParam(":usuario",$form["user"],PDO::PARAM_STR);
    $conn->bindParam(":libro",$form["book"],PDO::PARAM_STR);
    $conn->execute();
    
    //TODO cambio exito-index
    Header("Location: index.php");
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

function csvExport($id,$radio,$ip,$date,$bib,$user,$book){
  $csvFile = fopen('prestamosydevoluciones.csv','a+');
  $columns = array("idform","tipotransaccion", "iptransaccion", "fechayhora", "biblioteca", "usuario", "libro");
  $row = array($id,$radio,$ip,$date,$bib,$user,$book);
  if($csvFile){
      fputs($csvFile, implode($row, ',').PHP_EOL);
      fclose($csvFile);
  }else{
    echo "El archivo no existe o no se pudo crear";
  }
}

//TODO función csv2
function csvExport2($radio,$date,$user,$book){
  $csvFile = fopen('prestamos.csv','a+');
  $columns = array("tipotransaccion", "fechayhora", "usuario", "libro");
  $row = array($radio,$date,$user,$book);
  if($csvFile){
      fputs($csvFile, implode($row, ',').PHP_EOL);
      fclose($csvFile);
  }else{
    echo "El archivo no existe o no se pudo crear";
  }
}

?>
