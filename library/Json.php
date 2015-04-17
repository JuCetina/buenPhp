<?php

class Json extends Response
{

	protected $vars = array();
	protected $layout;
	
	public function __construct($vars = array(),$layout)
	{
		$this->vars = $vars;
		$this->layout = $layout;
	}

	public function getVars(){
		return $this->vars;
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
		$vars = $this->getVars();
		$layoutFileName = $this->getLayoutFileName();

		call_user_func(function () use ($vars, $layoutFileName)
		{
			extract($vars);

			$tpl_content = json_encode($vars);

			require $layoutFileName;
		});
	}
}