<?php
$servername = "localhost";
$dbname = 'sqlite:DB/prestamos.slite';
$sql = '';
session_start();
$form= $_SESSION["form"];
session_destroy();
# $username = "username";
# $password = "password";
# $dbname = "myDBPDO";
$id = $form["fechayhora"].$form["usuario"].$form["libro"];
$id = md5($id);
$bib='generic';

try {
    $conn = new PDO($dbname);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO prestamosydevoluciones (id, tipotransaccion, iptransaccion, fechayhora, biblioteca, usuario, libros)
    VALUES (:id, :tipotransaccion,:iptranscaccion, :fechayhora, :biblioteca, :usuario, :libros)";
    // use exec() because no results are returned
    $conn->prepare($sql);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->bindParam(":id",$id, PDO::PARAM_STR);
    $conn->bindParam(":tipotransaccion",$form["radio"], PDO::PARAM_STR);
    $conn->bindParam(":iptransaccion",$form["ip"], PDO::PARAM_STR);
    $conn->bindParam(":fechayhora",$form["date"], PDO::PARAM_INT);
    $conn->bindParam(":biblioteca",$bib, PDO::PARAM_STR);
    $conn->bindParam(":usuario",$form["user"], PDO::PARAM_STR);
    $conn->bindParam(":libros",$form["book"], PDO::PARAM_STR);
    $conn->exec();
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


?>
