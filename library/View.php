<?php

class View extends Response
{

	protected $template;
	protected $vars = array();
	protected $layout;

	public function __construct($template,$layout,$vars = array())
	{
		$this->template = $template;
		$this->vars = $vars;
		$this->layout = $layout;
	}

	public function getTemplate(){
		return $this->template;
	}

	public function getTemplateFileName(){
		return "views/".$this->getTemplate().".tpl.php";
	}

	public function getVars(){
		return $this->vars;
	}

	public function getLayout(){
		return $this->layout;
	}

	public function getLayoutFileName(){
		return "views/".$this->getLayout().".tpl.php";
	}

	public function execute()
	{
		$vars = $this->getVars();
		$templateFileName = $this->getTemplateFileName();
		$layoutFileName = $this->getLayoutFileName();

		call_user_func(function () use ($templateFileName, $layoutFileName, $vars)
		{
			extract($vars);

			ob_start();

			require $templateFileName;

			$tpl_content = ob_get_clean();

			require $layoutFileName;
		});
	}
}