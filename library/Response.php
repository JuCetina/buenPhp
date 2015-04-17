<?php
//Clase abstracta response, clases que la extiendan estan obligadas a implementar el metodo execute
abstract class Response 
{
	abstract public function execute();
}