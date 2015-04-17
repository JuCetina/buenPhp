<?php

class Inflector 
{
	public static function camel($value)
	{
		$segments = explode("-", $value);

		array_walk($segments, function (&$item) //& por referencia, no por valor //array_walk le aplica una funcion a cada elemento de un array
		{
			$item = ucfirst($item); //Primer caracter de cada posicion del array en mayuscula
		});

		return implode("", $segments); //Une todos los segmentos
	}

	public static function lowerCamel($value)
	{
		return lcfirst(static::camel($value)); //Implementa el metodo camel, pero pasa el primer caracter a minuscula
	}
}
