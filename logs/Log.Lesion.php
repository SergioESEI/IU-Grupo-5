<?php

	class Log_Lesion
	{
		public function __construct($nombreFichero, $ruta)
		{
			$this->ruta     = ($ruta) ? $ruta : "/var/www/html/logs/";
			$this->nombreFichero = ($nombreFichero) ? $nombreFichero : "logAccesoLesiones";
			$this->date     = date("Y-m-d H:i:s");
		}
		public function insertar($page, $user, $dni, $idlesion, $clear)
		{
			$append = ($clear) ? null : FILE_APPEND;
			$log    = $this->date . " [pagina] " . $page . " [usuario] " . $user . " [persona consultada] " . $dni . " [id lesion] " . $idlesion . PHP_EOL ."\r\n";
			$result = (file_put_contents($this->ruta . $this->nombreFichero . ".log", $log, $append)) ? 1 : 0;

			return $result;
		}
	}