<?php
$servername = "localhost";
$dbname = 'sqlite:DB/prestamos.slite';
$sql = '';
//$form='';
session_start();
$form= $_SESSION["form"];
session_destroy();
# $username = "username";
# $password = "password";
# $dbname = "myDBPDO";
$id = $form["date"].$form["user"].$form["book"];
$id = md5($id);
$bib='generic';
$form["user"] = strtoupper($form["user"]);

try {
    $conn = new PDO($dbname);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO prestamosydevoluciones (idform, tipotransaccion, iptransaccion, fechayhora, biblioteca, usuario, libro)
    VALUES (:idform,:tipotransaccion,:iptransaccion,:fechayhora,:biblioteca,:usuario,:libro)";
    // use exec() because no results are returned
    $conn = $conn->prepare($sql);
    $conn->bindParam(":idform",$id);
    $conn->bindParam(":tipotransaccion",$form["radio"],PDO::PARAM_STR);
    $conn->bindParam(":iptransaccion",$form["ip"],PDO::PARAM_STR);
    $conn->bindParam(":fechayhora",$form["date"],PDO::PARAM_INT);
    $conn->bindParam(":biblioteca",$bib,PDO::PARAM_STR);
    $conn->bindParam(":usuario",$form["user"],PDO::PARAM_STR);
    $conn->bindParam(":libro",$form["book"],PDO::PARAM_STR);
    $conn->execute();
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


?>
