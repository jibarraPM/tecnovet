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
<h1 class="h3 mb-2 text-gray-800">Registro de Edición Razas</h1>
<p class="mb-4">En esta pestaña podra Actualizar los datos del Raza Seleccionado</p>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
                <div class="card-header py-3">
                <div class="text-right">
    <a href="razas.php" class=" btn btn-primary btn-icon-split">
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
				$razas= new Database();
				if(isset($_POST) && !empty($_POST)){
					$nombre_raza = $razas->sanitize($_POST['nombre_raza']);
                    $descripcion = $razas->sanitize($_POST['descripcion']);		
					$id=intval($_POST['id']);
					$res = $razas->actualizarRaza($id,$nombre_raza,$descripcion);
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
                $datos_raza=$razas->buscar_raza($id);
			?>
            <div class="p-5">
                <form method="post">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="hidden" name="id" id="id" class='form-control' maxlength="100"   value="<?php echo $datos_raza->id;?>">
                      <input type="text" class="form-control form-control-user" id="nombre_raza" name="nombre_raza" placeholder="Nombre" required value="<?php echo $datos_raza->nombre_raza;?>">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control form-control-user" id="descripcion" name="descripcion" placeholder="descripcion" required value="<?php echo $datos_raza->descripcion;?>">
                    </div>
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