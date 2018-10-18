<?php

session_start();

date_default_timezone_set('Europe/Madrid');

//form request
if(isset($_SESSION["form"])){
  $form["radio"] = $_REQUEST["radio"];
  $form["user"] = $_REQUEST["user"];
  $form["book"] = $_REQUEST["book"];
  $form["ip"] = get_client_ip();
  $form["date"] = date("YmdHis");
}else
  Header("Location: prueba.php");
  $_SESSION["form"]=$form;

  $errors = validateForm($form);
  if(count($errors)!==0){
    $_SESSION["errors"]=$errors;
    Header("Location: prueba.php");
  }else{
    Header("Location: exito.php");
  }

  //Get the client ip
  function get_client_ip(){
    $ip = '';
    if($_SERVER['HTTP_CLIENT_IP'])
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
      $ip = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
      $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
      $ip = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
      $ip = $_SERVER['REMOTE_ADDR'];
    else
      $ip = 'UNKNOWN';

    return $ip;
  }

//Validate
function validateForm($form){
  if($form["radio"]==""){
    $errors[]="<p> No se ha seleccionado la acción que quiere realizar.<p>";
  }
  if($form["user"]==""){
    $errors[]="<p> No se ha introducido el usuario.<p>";
  }
  if($form["book"]==""){
    $errors[]="<p> No se ha introducido el ejemplar.<p>";
  }

  return $errors;

}
 ?>
