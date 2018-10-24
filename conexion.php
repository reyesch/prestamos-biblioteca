<?php
$servername = "localhost";
$dbname = 'sqlite:DB/prestamos.slite';
$sql = '';
//$form='';
session_start();
$form= $_SESSION["form"];
$id = $form["date"].$form["user"].$form["book"];
$id = md5($id);
$bib='generic';
$form["user"];
csvExport($id,$form["radio"],$form["ip"],$form["date"],$bib,$form["user"],$form["book"]);

try {
    $conn = new PDO($dbname);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO prestamosydevoluciones (idform, tipotransaccion, iptransaccion, fechayhora, biblioteca, usuario, libro)
    VALUES (:idform,:tipotransaccion,:iptransaccion,:fechayhora,:biblioteca,:usuario,:libro)";
    $conn = $conn->prepare($sql);
    $conn->bindParam(":idform",$id);
    $conn->bindParam(":tipotransaccion",$form["radio"],PDO::PARAM_STR);
    $conn->bindParam(":iptransaccion",$form["ip"],PDO::PARAM_STR);
    $conn->bindParam(":fechayhora",$form["date"],PDO::PARAM_INT);
    $conn->bindParam(":biblioteca",$bib,PDO::PARAM_STR);
    $conn->bindParam(":usuario",$form["user"],PDO::PARAM_STR);
    $conn->bindParam(":libro",$form["book"],PDO::PARAM_STR);
    $conn->execute();
    Header("Location: exito.php");
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

function csvExport($id,$radio,$ip,$date,$bib,$user,$book){
  $csvFile = fopen('prestamosydevoluciones.csv','a+');
  $columns = ["idform","tipotransaccion", "iptransaccion", "fechayhora", "biblioteca", "usuario", "libro"];
  $row = array($id,$radio,$ip,$date,$bib,$user,$book);
  if($csvFile){
      fputs($csvFile, implode($row, ',').PHP_EOL);
      fclose($csvFile);
  }else{
    echo "El archivo no existe o no se pudo crear";
  }
}

?>
