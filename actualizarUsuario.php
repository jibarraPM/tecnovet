<?php
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
	} else {
		header("location:index.php");
	}
?>
<?php include("header.php") ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Registro de Edición Dueños</h1>
<p class="mb-4">En esta pestaña podra Actualizar los datos del Dueño Seleccionado</p>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
                <div class="card-header py-3">
                <div class="text-right">
    <a href="usuarios.php" class=" btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-user"></i>
        </span>
        <span class="text">Volver</span>
    </a>
    </div>
                </div>
                <div class="card-body">
                <div class="table-wrapper">
            <?php
				include ("database.php");
				$usuarios= new Database();
				if(isset($_POST) && !empty($_POST)){
					$nombre = $usuarios->sanitize($_POST['nombre']);
                    $apellido = $usuarios->sanitize($_POST['apellido']);
                    $rut = $usuarios->sanitize($_POST['rut']);
                    $direccion = $usuarios->sanitize($_POST['direccion']);
                    $contacto = $usuarios->sanitize($_POST['contacto']);
                    $correo = $usuarios->sanitize($_POST['correo']);					
					$id_usuario=intval($_POST['id_usuario']);
					$res = $usuarios->actualizarUsuario($nombre,$apellido,$rut,$contacto,$direccion,$correo,$id_usuario);
					if($res){
						$message= "Datos Actualzaidos con éxito";
						$class="alert alert-success";
					}else{
						$message="No se pudieron Actualizar los datos";
						$class="alert alert-danger";
					}
					
					?>
				<div class="<?php echo $class?>">
				  <?php echo $message;?>
				</div>	
					<?php
				}
                $datos_usuario=$usuarios->single_record($id);
			?>
            <div class="p-5">
                <form method="post">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="hidden" name="id_usuario" id="id_usuario" class='form-control' maxlength="100"   value="<?php echo $datos_usuario->id;?>">
                      <input type="text" class="form-control form-control-user" id="nombre" name="nombre" placeholder="Nombre" required value="<?php echo $datos_usuario->nombre;?>">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control form-control-user" id="apellido" name="apellido" placeholder="Apellido" required value="<?php echo $datos_usuario->apellido;?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="text" class="form-control form-control-user" id="rut" name="rut" placeholder="RUT" required value="<?php echo $datos_usuario->rut;?>">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control form-control-user" id="contacto" name="contacto" placeholder="Contacto" value="<?php echo $datos_usuario->contacto;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="direccion" name="direccion" placeholder="Direccion" value="<?php echo $datos_usuario->direccion;?>">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="correo" name="correo" placeholder="Correo" value="<?php echo $datos_usuario->correo;?>">
                  </div>
                  <div class="form-group row">
                  
                  </div>
                  <button type="submit" class="btn btn-warning btn-user btn-block">Actualizar</button>                
                </form>              
        </div>
        </div>

</div>
                </div>
              </div>

            </div>


<!-- /.container-fluid -->

<!-- End of Main Content -->
<?php include("footer.php") ?>