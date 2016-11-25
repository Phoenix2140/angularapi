<?php 
	/**
	 * Modelo de la tabla usuarios
	 * Estructura de la base de datos:
	 *	id_usuarios				INT
	 *	user 					VARCHAR(30)
	 *	email 			 		VARCHAR(120)
	 */

	Class Usuarios {
		private $db;

		public function __construct ($config) {
			$this->db = new Database ($config);
		}

		/**
		 * Función para crear nuevo usuario
		 */
		public function createUser ($user, $email) {

			$this->db->query ("INSERT INTO usuarios ( user, email)
				VALUES (:user, :email) ");

			$this->db->bind (':user', $user);
			$this->db->bind (':email', $email);

			$this->db->execute ();
		}

		public function createUserReturnId ($user, $email) {

			$this->createUser ($user, $email);

			return $this->db->lastInsertId ();
		}

		public function getUsers () {
			$this->db->query ("SELECT id_usuarios, user, email FROM usuarios");

			return $this->db->resultSet ();
		}


		public function getUserByName ($user) {
			$this->db->query ("SELECT * FROM usuarios WHERE user=:user");

			$this->db->bind (":user", $user);

			return $this->db->single ();

		}

		public function getUserId ($id) {
			$this->db->query ("SELECT * FROM usuarios WHERE id_usuarios=:id");

			$this->db->bind (":id", $id);

			return $this->db->single ();
		}

		public function updateUser ($id, $user, $email) {

			$this->db->query ("UPDATE usuarios SET user=:user, email=:email 
				WHERE id_usuarios=:id");

			$this->db->bind (":user", $user);
			$this->db->bind (":email", $email);

			$this->db->execute ();
		}

		public function removeUserId ($id) {
			$this->db->query ("DELETE FROM usuarios WHERE id_usuarios=:id");

			$this->db->bind (':id', $id);

			$this->db->execute ();
		}
	}
 ?>