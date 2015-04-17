<?php

class ContactosController
{
	public function indexAction()
	{
		return new View('contactos','layout');
	}

	public function ciudadAction($ciudad)
	{
		exit('Contactos Ciudad: '.$ciudad);
	}

	public function cadenaAction()
	{
		return new String('Esta es una cadena de caracteres','layout');
	}

	public function jsonAction()
	{
		return new Json(["titulo" => "MejorandoPHP","language" => "PHP"],'layout');
	}

	public function paisAction()
	{
		return new Pais('Colombia','layout');
	}
}