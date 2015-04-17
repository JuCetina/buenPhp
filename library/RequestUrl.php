<?php

class RequestUrl{

	protected $url;
	protected $segments = array();

	public function __construct($url)
	{
		$this->url = $url;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getSegments(){
		return $this->segments = explode('/', $this->getUrl());
	}
}