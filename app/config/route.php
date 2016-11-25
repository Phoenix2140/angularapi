<?php 
	/**
	 * Se llama a la clase Router para tratar las rutas
	 * y el tipo de Método que utiliza (POST, GET u otro)
	 */
	require_once ($config->get ('baseDir') . 'Router.php');
	$ruta = new Router ();

	require_once ($config->get ('controllersDir') . 'UsuariosController.php');

	$usuarios = new UsuariosController ($config);

	$seccion = $config->get ('deep');

	
	/**
	 * Se separan las rutas por los métodos GET y POST
	 * que son los métodos más utilizados, se pueden 
	 * incorporar otros según se requiera.
	 */
	if ($ruta->get () == 'GET') {

		
		$enlace = $ruta->enlace ();

		/**
		 * El Switch utiliza una accion dependiendo de la ruta.
		 */
		switch ($enlace[$seccion]) {
			case 'api':
				if ( isset ($enlace[$seccion+1]) && $enlace[$seccion+1] != "" ) {
					switch ( $enlace[$seccion+1]) {
						case 'usuarios':
							if (isset ($enlace[$seccion+2]) && $enlace[$seccion+2] != "" ) {
								$usuarios->getUsuarioById ($enlace[$seccion+2]);
							} else {
								$usuarios->getUsuarios ();
							}
							break;
						
						default:
							echo json_encode(array("response" => false));
							break;
					}
				} else {
					echo json_encode(array("response" => false));
				}
				
				break;
			default:
				echo json_encode(array("response" => false));
				break;
		}

	}elseif($ruta->get() == 'POST'){
		$enlace = $ruta->enlace ();

		$json = $ruta->angularJSON ( );

		switch ($enlace[$seccion]) {
			case 'api':
				if ( isset ($enlace[$seccion+1]) && $enlace[$seccion+1] != "" ) {
					switch ( $enlace[$seccion+1]) {
						case 'usuarios':
							$usuarios->crearUsuario ($json);
							break;
						
						default:
							echo json_encode(array("response" => false));
							echo 1;
							break;
					}
				} else {
					echo json_encode(array("response" => false));
					echo 1;
				}
				
				break;
			default:
				echo json_encode(array("response" => false));
				echo 1;
				break;
		}
	}elseif($ruta->get() == 'PUT'){
		$enlace = $ruta->enlace ();

		$json = $ruta->angularJSON ( );

		switch ($enlace[$seccion]) {
			case 'api':
				# code...
				break;
			default:
				echo json_encode(array("response" => false));
				echo 1;
				break;
		}
	}elseif($ruta->get() == 'DELETE'){
		$enlace = $ruta->enlace ();

		$json = $ruta->angularJSON ( );

		switch ($enlace[$seccion]) {
			case 'api':
				# code...
				break;
			default:
				echo json_encode(array("response" => false));
				echo 1;
				break;
		}
	}
 ?>
