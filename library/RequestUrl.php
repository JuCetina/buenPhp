<?php

class RequestUrl{

	protected $url;
	protected $segments = array();

	public function __construct($url)
	{
		$this->url = $url;  //Guarda la url en la propiedad
	}

	public function getUrl()
	{
		return $this->url; //Obtiene la Url
	}

	public function getSegments(){
		return $this->segments = explode('/', $this->getUrl()); //Guada en la propiedad segments la url dividida cada /
	}
}