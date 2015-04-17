<?php

class Request 
{

	protected $requestUrl;
	protected $controller;
	protected $defaultController = "home";
	protected $defaultAction = "index";
	protected $params = array();

	public function __construct($reqUrl)
	{
		$this->requestUrl = $reqUrl;
		
		$segments = $this->requestUrl->getSegments(); 
		
		$this->resolveController($segments);
		$this->resolveAction($segments);
		$this->resolveParams($segments);
	}

	public function resolveController(&$segments) //& Significa que pasa variable por referencia y no por valor 
	{
		$this->controller = array_shift($segments);

		if(empty($this->controller))
		{
			$this->controller = $this->defaultController;
		}
	}

	public function resolveAction(&$segments) //& Significa que pasa variable por referencia y no por valor 
	{
		$this->action = array_shift($segments);

		if(empty($this->action))
		{
			$this->action = $this->defaultAction;
		}
	}

	public function resolveParams(&$segments) //& Significa que pasa variable por referencia y no por valor 
	{
		$this->params = $segments;
	}

	public function getController() //Obtener el segmento que contiene el nombre del controlador
	{
		return $this->controller;
	}

	public function getControllerClassName() //Obtener Nombre de la clase del controlador
	{
		return Inflector::camel($this->getController())."Controller";
	}

	public function getControllerFileName() //Obtener Nombre del archivo que contiene el controlador
	{
		return "controllers/".$this->getControllerClassName().".php";
	}

	public function getAction() //Obtener el segmento que contiene el nombre de la accion
	{
		return $this->action;
	}

	public function getActionMethodName()
	{
		return Inflector::lowerCamel($this->getAction())."Action";
	}

	public function getParams()
	{
		return $this->params;
	}

	public function execute()
	{
		$controllerClassName 	= $this->getControllerClassName();
		$controllerFileName 	= $this->getControllerFileName();
		$actionMethodName 		= $this->getActionMethodName();
		$params 				= $this->getParams();

		if( ! file_exists($controllerFileName))
		{
			exit("El controlador no existe.");
		}

		require $controllerFileName;
	
		$controller = new $controllerClassName();

		$response = call_user_func_array([$controller, $actionMethodName], $params);

		$this->executeResponse($response);
	}

	public function executeResponse($response)
	{
		if($response instanceof Response)
		{
			$response->execute();
		}
		else
		{
			$response->imprimirPais();
			//exit("No es una instancia de la clase abstracta Response.");
		}
	}
}