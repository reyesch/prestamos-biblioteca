<?php
session_start();
date_default_timezone_set('Europe/Madrid');

//form request
  $form["radio"] = $_POST["radio"];
  $form["user"] = strtoupper($_POST["user"]);
  $form["book"] = $_POST["book"];
  $form["ip"] = get_client_ip();
  $form["date"] = date("YmdHis");
  $errors = array();
  $errors = validateForm($form);
  if(count($errors)!==0){
    $_SESSION["errors"]=$errors;
    Header("Location: index.php");
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
      Header("Location: index.php");
    }
    return $ip;
  }

//Validate

function validateForm($form){

  $errors = array();

  if($form["radio"]==""){
    array_push($errors,"<p> No ha seleccionado la acción que quiere realizar.<p>");
  }
  if($form["user"]==""){
    array_push($errors,"<p> No se ha introducido el usuario.<p>");
  }
  if($form["book"]==""){
    array_push($errors,"<p> No se ha introducido el ejemplar.<p>");
  }
/*  if (!filter_var($form["ip"], FILTER_VALIDATE_IP)) {
    array_push($errors,"<p>La dirección IP no es válida.</p>");
  } */
  if($form["radio"]!=="R" && $form["radio"]!=="L"){
    array_push($errors,"<p> La opción no es válida.<p>");
  }
  if(!preg_match("/^[0-9]{9}$/", $form["book"])){
    array_push($errors,"<p> El libro no es correcto<p>");
  }
	$letter = substr($form["user"], -1);
	$number = substr($form["user"], 0, -1);
	if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $number%23, 1) == $letter && strlen($letter) == 1 && strlen ($number) == 8 ){
	}else{
    array_push($errors,"<p> El usuario no es correcto<p>");
	}
  return $errors;
}
 ?>
