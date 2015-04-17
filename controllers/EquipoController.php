<?php

class EquipoController
{
	public function indexAction()
	{
		return new View('equipo','layout');
	}

	public function backendAction($especialidad)
	{
		exit('Equipo con especialidad: '.$especialidad);
	}
}