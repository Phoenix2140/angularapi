<?php 
	/**
	 * Controlador que muestra la pantalla de selección una vez loggeado
	 * separa por usuarios (usuario, encargado o administrador)
	 */

	Class UsuariosController {
		private $config;
		private $usuarios;

		/**
		 * Se crea la función construct, que recibe  la configuración y
		 * activa el soporte para vistas
		 */
		public function __construct ($config) {
			/**
			 * Obtiene y asigna la configuración
			 */
			$this->config = $config;


			/**
			 * Cargamos el modelo Usuarios
			 */
			require_once ($this->config->get ('modelsDir') . 'Usuarios.php');
			$this->usuarios = new Usuarios ($config);

		}

		public function getUsuarios () {
			$datos = array ();
			$contador = 0;

			foreach ($this->usuarios->getUsers () as $usuario) {
				$datos[$contador]["id"] 	= $usuario["id_usuarios"];
				$datos[$contador]["user"] 	= utf8_encode ($usuario["user"]);
				$datos[$contador]["email"] 	= utf8_encode ($usuario["email"]);
				++$contador;
			}

			echo json_encode ( $datos );
		}

		public function getUsuarioById ($id) {
			$datos = array ();
			$user = $this->usuarios->getUserId ($id);

			$datos["id"]	= $user["id_usuarios"];
			$datos["user"]	= utf8_encode ($user["user"]);
			$datos["email"]	= utf8_encode($user["email"]);

			echo json_encode ( $datos );
		}

		public function crearUsuario ($datos) {
			if ( (isset($datos->user) && $datos->user != null)
				&& (isset($datos->email) && $datos->email != null) ) {

				$existe_usuario = $this->usuarios->getUserByName ($datos->user);
				
				if (isset($existe_usuario["id_usuarios"])) {
					echo json_encode (array ('response' => false) );
				} else {
					$this->usuarios->createUser ($datos->user, $datos->email);

					$this->getUsuarios ();
				}
				
			} else {
				echo json_encode (array ('response' => false) );
			}
		}
	}
?>