<?php
session_start();
date_default_timezone_set('Europe/Madrid');

//form request
  $form["radio"] = $_POST["radio"];
  $form["user"] = $_POST["user"];
  $form["book"] = $_POST["book"];
  $form["ip"] = get_client_ip();
  $form["date"] = date("YmdHis");
  $errors = validateForm($form);
  if(count($errors)!==0){
    $_SESSION["errors"]=$errors;
    Header("Location: prueba.php");
  }else{
    $_SESSION["form"]=$form;
    Header("Location: conexion.php");
  }

  //Get the client ip
  function get_client_ip(){
    $ip = '';
    echo getenv('HTTP_CLIENT_IP') ."";
    if(getenv('HTTP_CLIENT_IP')){
      $ip = getenv('HTTP_CLIENT_IP');
    }else{
      $ip="IP SERVER";
      $errors[]="<p> No ha podido registrarse el libro.<p>";
      Header("Location: prueba.php");
    }
    return $ip;
  }

//Validate
function validateForm($form){
  
  $errors = [];
  
  if($form["radio"]==""){
    $errors[]="<p> No se ha seleccionado la acción que quiere realizar.<p>";
  }
  if($form["user"]==""){
    $errors[]="<p> No se ha introducido el usuario.<p>";
  }
  if($form["book"]==""){
    $errors[]="<p> No se ha introducido el ejemplar.<p>";
  }
  /*if (!filter_var($form["ip"], FILTER_VALIDATE_IP)) {
    $errors[]="La dirección IP no es válida.";
  }*/
  if($form["radio"]!=="R" && $form["radio"]!=="L"){
    $errors[]="<p> La opción no es válida.<p>";
  }
  if($form["radio"]!=="R" && $form["radio"]!=="L"){
    $errors[]="<p> La opción no es válida.<p>";
  }
  if(!preg_match("/^[0-9]{8}[A-Za-z]$/", $form["user"])){
    $errors[]="<p> El usuario no es correcto<p>";
  }
  if(!preg_match("/^[A-Za-z0-9_-]$/", $form["book"])){
    $errors[]="<p> El libro no es correcto<p>";
  }
  return $errors;
}
 ?>
