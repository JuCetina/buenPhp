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

	public function getTemplate(){ //Obtiene el nombre de la vista
		return $this->template;
	}

	public function getTemplateFileName(){ //Obtiene el nombre del archivo de la vista
		return "views/".$this->getTemplate().".tpl.php";
	}

	public function getVars(){ //Obtiene las variables que pueda necesitar la vista
		return $this->vars;
	}

	public function getLayout(){ //Obtiene el nombre del layout
		return $this->layout;
	}

	public function getLayoutFileName(){ //Obtiene el nombre del archivo del layout
		return "views/".$this->getLayout().".tpl.php";
	}

	public function execute() //Metodo obligatorio por ser una clase extendida de Response
	{
		$vars = $this->getVars();
		$templateFileName = $this->getTemplateFileName();
		$layoutFileName = $this->getLayoutFileName();

		call_user_func(function () use ($templateFileName, $layoutFileName, $vars)
		{
			extract($vars); //Convierte en variable cada elemento del array

			ob_start(); //Activa el almacenamiento en el buffer de salida

			require $templateFileName; //Requiere el archivo que contiene el contenido de la vista

			$tpl_content = ob_get_clean(); //Obtiene el contenido del búfer actual y elimina el buffer de salida actual

			require $layoutFileName; //Requiere el archivo que contiene el layout
		});
	}
}
