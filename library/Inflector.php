<?php

class Inflector 
{
	public static function camel($value)
	{
		$segments = explode("-", $value);

		array_walk($segments, function (&$item) //& por referencia, no por valor
		{
			$item = ucfirst($item); //Primer caracter de cada posicion del array en mayuscula
		});

		return implode("", $segments);
	}

	public static function lowerCamel($value)
	{
		return lcfirst(static::camel($value)); //Implementa el metodo camel, pero pasa el primer caracter a minuscula
	}
}