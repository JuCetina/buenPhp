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
		$this->requestUrl = $reqUrl;  //Guarda el objeto RequestUrl en la propiedad
		
		$segments = $this->requestUrl->getSegments(); //Guarda los segmentos obtenidos de getSegments
		
		$this->resolveController($segments); 
		$this->resolveAction($segments);
		$this->resolveParams($segments);
	}

	public function resolveController(&$segments) //& Significa que pasa variable por referencia y no por valor 
	{
		$this->controller = array_shift($segments); //Toma la primera posicion del array y la quita del mismo, primer parte de la Url

		if(empty($this->controller)) 
		{
			$this->controller = $this->defaultController; //Si es vacio, el controlador por default es home
		}
	}

	public function resolveAction(&$segments) //& Significa que pasa variable por referencia y no por valor 
	{
		$this->action = array_shift($segments); //Toma la primera posicion del array y la quita del mismo, segunda parte de la Url

		if(empty($this->action))
		{
			$this->action = $this->defaultAction; //Si es vacio, la accion por default es index
		}
	}

	public function resolveParams(&$segments) //& Significa que pasa variable por referencia y no por valor 
	{
		$this->params = $segments; //Pasa la ultima parte de la url (lo que quedo del array)
	}

	public function getController() //Obtener el segmento que contiene el nombre del controlador
	{
		return $this->controller;
	}

	public function getControllerClassName() //Obtener Nombre de la clase del controlador, primer palabra en mayuscula
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

	public function getActionMethodName() //Obtiene la accion con la primer palabra en minuscula
		return Inflector::lowerCamel($this->getAction())."Action";
	}

	public function getParams() //Obtiene la ulrima parte de la url
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
			exit("Error 404");
		}

		require $controllerFileName;
	
		$controller = new $controllerClassName();

		$response = call_user_func_array([$controller, $actionMethodName], $params); //Llama el controlador, el metodo y los parametros

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