<?php

class NosotrosController
{
	public function indexAction()
	{
		return new View('nosotros','layout');
	}

	public function proyectosAction()
	{
		return new View('proyectos','layout');
	} 
}