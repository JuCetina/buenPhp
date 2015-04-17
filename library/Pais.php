<?php

class Pais
{
	protected $nombre;
	protected $layout;

	public function __construct($nom,$lay)
	{
		$this->nombre = $nom;
		$this->layout = $lay;
	}

	public function getNombrePais()
	{
		return $this->nombre;
	}

	public function getLayout()
	{
		return $this->layout;
	}

	public function getLayoutFileName()
	{
		return "views/".$this->getLayout().".tpl.php";
	}

	public function imprimirPais()
	{
		$nombrePais = $this->getNombrePais();
		$layoutFileName = $this->getLayoutFileName();

		call_user_func(function () use ($nombrePais, $layoutFileName)
		{

			$tpl_content = $nombrePais;

			require $layoutFileName;
		});
	}
}