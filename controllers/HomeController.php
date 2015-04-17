<?php

class HomeController
{
	public function indexAction()
	{
		return new View('home','layout',['titulo' => 'Buen PHP','language' => 'PHP']);
	}
}

	