<?php

class String extends Response
{

	protected $cadena;
	protected $layout;
	
	public function __construct($cadena,$layout)
	{
		$this->cadena = $cadena;
		$this->layout = $layout;
	}

	public function getCadena()
	{
		return $this->cadena;
	}

	public function getLayout()
	{
		return $this->layout;
	}

	public function getLayoutFileName()
	{
		return "views/".$this->getLayout().".tpl.php";
	}

	public function execute()
	{
		$cadena = $this->getCadena();
		$layoutFileName = $this->getLayoutFileName();

		call_user_func(function () use ($cadena, $layoutFileName)
		{

			$tpl_content = $cadena;

			require $layoutFileName;
		});
	}
}