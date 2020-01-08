<?php
date_default_timezone_set('America/Santiago');


	class Database{
		private $con;
		private $dbhost="localhost";
		private $dbuser="root";
		private $dbpass="";
		private $dbname="tecnovetapp";
		function __construct(){
			$this->connect_db();
		}

		function connect(){

			try{

				$connection = "mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname . ";charset=utf8mb4";
				$options = [
					PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_EMULATE_PREPARES   => false,
				];
				$pdo = new PDO($connection, $this->dbuser, $this->dbpass, $options);

				return $pdo;

			}catch(PDOException $e){
				print_r('Error connection: ' . $e->getMessage());
			}
		}

		public function connect_db(){
			$this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
			if(mysqli_connect_error()){
				die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
			}
		}

		public function sanitize($var){
			$return = mysqli_real_escape_string($this->con, $var);
			return $return;
		}
		public function agregarUsuario($nombre,$apellido,$rut,$contacto,$direccion,$correo){
			if($contacto ==""){
				$contacto= "Sin Contacto";
			}
			if($direccion ==""){
				$direccion= "Sin Dirección";
			}
			if($correo ==""){
				$correo= "Sin Correo";
			}


			$sql = "INSERT INTO `usuarios`(`nombre`, `apellido`, `rut`, `direccion`, `contacto`, `correo`, `rol`, `estado`) VALUES ('$nombre','$apellido','$rut','$direccion','$contacto','$correo','Dueño','Activo')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}

		public function leerUsuarios(){
			$sql = "SELECT id, nombre, apellido, rut, direccion, contacto, correo, estado FROM `usuarios`";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function leerDueño($id){
			$sql = "SELECT nombre, apellido FROM `usuarios` WHERE id = '$id'";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function leerAgendas(){
			$sql = "SELECT agenda.id, nombre_mascota,rut, nombre, apellido, fecha, hora, tipo FROM `agenda`
			INNER JOIN mascotas
			on mascotas.id = agenda.mascota
			inner JOIN usuarios
			on usuarios.id = mascotas.usuario";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function mascotaUsuario($id){
			$sql = "SELECT nombre_mascota FROM `usuarios`
			INNER JOIN mascotas
			on mascotas.usuario = usuarios.id
			 WHERE usuarios.id = $id";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}

		public function leerRazas(){
			$sql = "SELECT id, nombre_raza, descripcion from razas";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}

		public function leerAgendasHome(){
			$fechaActual = date('Y-m-d');
			$sql = "SELECT agenda.id, nombre_mascota,rut, nombre, apellido,contacto, fecha, hora, tipo FROM `agenda`
			INNER JOIN mascotas
			on mascotas.id = agenda.mascota
			inner JOIN usuarios
			on usuarios.id = mascotas.usuario
			WHERE fecha ='$fechaActual'";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}

		public function leerMascotas(){
			$sql = "SELECT mascotas.id, nombre,apellido, nombre_mascota, especie, nombre_raza, sexo, fechaNacimiento, color, chip, caracter, estado_mascota, esterilizado,foto FROM `mascotas`
			INNER JOIN usuarios
			ON usuarios.id=mascotas.usuario
			INNER JOIN razas
			on razas.id = mascotas.raza";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function agregarMascota($usuario,$nombre_mascota,$especie,$raza,$sexo,$fechaNacimiento,$color,$chip,$caracter,$estado_mascota,$esterilizacion,$foto){
			if($color ==""){
				$color= "No Especificado";
			}
			if($chip ==""){
				$direccion= "Sin Chip";
			}
			$sql = "INSERT INTO `mascotas`( `usuario`, `nombre_mascota`, `especie`, `raza`, `sexo`, `fechaNacimiento`, `color`, `chip`, `caracter`, `estado_mascota`, `esterilizado`, `foto`) VALUES ('$usuario','$nombre_mascota','$especie','$raza','$sexo','$fechaNacimiento','$color','$chip','$caracter','$estado_mascota','$esterilizacion','$foto')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}

		public function agregarAgenda($mascota,$fecha,$hora,$tipo){
			$sql = "INSERT INTO `agenda`( `mascota`, `fecha`, `hora`, `tipo`) VALUES ('$mascota','$fecha','$hora','$tipo')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}

		public function agregarControl($fecha,$veterinario,$mascota,$consulta,$fr,$fc,$presion,$mucosa,$vacuna,$observacion,$documento){
			if($fr==""){
				$fr= "fr";
			}
			if($fc==""){
				$fc= "fc";
			}
			if($presion==""){
				$presion= "presion";
			}
			if($mucosa==""){
				$mucosa= "mucosa";
			}
			if($observacion==""){
				$observacion= "Sin Observación";
			}

			$sql = "INSERT INTO `control`( `fecha`, `veterinario`, `mascota`, `consulta`, `fr`, `fc`, `presion`, `mucosa`, `vacuna`, `observacion`, `documento`) VALUES ('$fecha','$veterinario','$mascota','$consulta','$fr','$fc','$presion','$mucosa','$vacuna','$observacion','$documento')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
		public function agregarRaza($nombre_raza,$descripcion){
			$sql = "INSERT INTO `razas`(`nombre_raza`, `descripcion`) VALUES ('$nombre_raza','$descripcion')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}

		public function single_record($id){
			$sql = "SELECT * FROM usuarios where id='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res );
			return $return ;
		}

		public function buscar_raza($id){
			$sql = "SELECT * FROM razas where id='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res );
			return $return ;
		}


		public function editar_agenda($id){
			$sql = "SELECT fecha, hora,tipo, nombre_mascota, nombre, apellido, rut FROM agenda
			INNER JOIN mascotas
			on mascotas.id = agenda.mascota
			INNER JOIN usuarios
			on usuarios.id = mascotas.usuario
			 where agenda.id='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res );
			return $return ;
		}
		public function editar_mascota($id){
			$sql = "SELECT mascotas.id, nombre,apellido, nombre_mascota, especie, nombre_raza, sexo, fechaNacimiento, color, chip, caracter, estado_mascota, esterilizado,foto FROM `mascotas`
			INNER JOIN usuarios
			ON usuarios.id=mascotas.usuario
			INNER JOIN razas
			on razas.id = mascotas.raza where mascotas.id='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res );
			return $return ;
		}
		public function actualizarUsuario($nombre,$apellido,$rut,$contacto,$direccion,$correo, $id_usuario){
			$sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido',rut='$rut', contacto='$contacto', direccion='$direccion', correo='$correo' WHERE id='$id_usuario'";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
		public function actualizarAgenda($fecha,$hora,$tipo,$id_agenda){
			$sql = "UPDATE agenda SET fecha='$fecha', hora='$hora',tipo='$tipo' WHERE id='$id_agenda'";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
		public function actualizarMascota($fechaNacimiento,$chip,$caracter,$estado_mascota,$esterilizacion, $id_mascota, $color, $foto){
			if($foto==" "){
				$sql = "UPDATE mascotas SET fechaNacimiento='$fechaNacimiento',  color='$color', chip='$chip',caracter='$caracter', estado_mascota='$estado_mascota', esterilizado='$esterilizacion' WHERE id='$id_mascota'";
			}else{
				$sql = "UPDATE mascotas SET fechaNacimiento='$fechaNacimiento',  color='$color', chip='$chip',caracter='$caracter', estado_mascota='$estado_mascota', esterilizado='$esterilizacion' , foto='$foto' WHERE id='$id_mascota'";
			}
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}

		public function actualizarRaza($id,$nombre_raza,$descripcion){
			$sql = "UPDATE razas SET nombre_raza='$nombre_raza', descripcion='$descripcion' WHERE id='$id'";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}

		public function delete($id){
			$sql = "DELETE FROM usuarios WHERE id=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
		public function usarVeterinario(){
			$sql = "SELECT id, nombre, apellido, rut FROM usuarios WHERE rol = 'Administrador'";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function usarMascota(){
			$sql = "SELECT mascotas.id, nombre_mascota, rut, nombre, apellido FROM mascotas
			INNER JOIN usuarios
			on usuarios.id = mascotas.usuario";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}

		public function usarUsuarios(){
			$sql = "SELECT id, nombre, apellido, rut FROM `usuarios` ORDER BY rut ASC";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function usarRazas(){
			$sql = "SELECT id, nombre_raza FROM `razas` ORDER BY nombre_raza ASC";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function usarMascota2($id){
            $sql = "SELECT nombre_mascota, rut, nombre, apellido FROM usuarios
            INNER JOIN mascotas
            on mascotas.usuario = usuarios.id
             WHERE mascotas.id = '$id'";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }

		/*Esta seccion esta la cuenta de los valores de inicio */

		public function totalUsuarios(){
			$sql = "SELECT COUNT(*) total FROM usuarios";
			$result = mysqli_query($this->con, $sql);
			$fila = mysqli_fetch_assoc($result);
			return $fila['total'];
		}
		public function totalMascotas(){
			$sql = "SELECT COUNT(*) total FROM mascotas";
			$result = mysqli_query($this->con, $sql);
			$fila = mysqli_fetch_assoc($result);
			return $fila['total'];
		}
		public function totalControles(){
			$sql = "SELECT COUNT(*) total FROM control";
			$result = mysqli_query($this->con, $sql);
			$fila = mysqli_fetch_assoc($result);
			return $fila['total'];
		}
		public function totalAgenda(){
			$fechaActual = date('Y-m-d');
			$sql = "SELECT COUNT(*) total FROM agenda
			WHERE fecha = '$fechaActual'";
			$result = mysqli_query($this->con, $sql);
			$fila = mysqli_fetch_assoc($result);
			return $fila['total'];
		}
		public function leerControles(){
			$sql = "SELECT control.id, fecha, nombre, nombre_mascota, consulta, fr, fc, presion, mucosa, vacuna, observacion, documento   FROM `control`
			INNER JOIN usuarios
			ON usuarios.id=control.veterinario
			INNER JOIN mascotas
			on mascotas.id = control.mascota";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}

	}



?>
