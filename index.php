<?php

/*
* El frontend controller se encarga de configurar nuestra aplicacion
*/
require "config.php"; //Este archivo hace que se muestren o no los errores

//Library - Clases
require "library/RequestUrl.php";
require "library/Request.php";
require "library/Inflector.php";
require "library/Response.php";
require "library/View.php";
require "library/String.php";
require "library/Json.php";
require "library/Pais.php";

//Llamar al controlador indicado

if(empty($_GET['url']))
{
	$url = "";
}
else
{
	$url = $_GET['url'];
}


$requestUrl = new RequestUrl($url);
$request = new Request($requestUrl);
$request->execute();
