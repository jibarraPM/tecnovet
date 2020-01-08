<?php include("header.php") ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Registro de Nuevas Razas</h1>
<p class="mb-4">En esta pestaña podra ingresar un nueva Razas</p>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
                <div class="card-header py-3">
                <div class="text-right">
    <a href="razas.php" class=" btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-calendar"></i>
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
					
					$res = $razas->agregarRaza($nombre_raza, $descripcion);
					if($res){
						$message= "Datos insertados con éxito";
						$class="alert alert-success";
					}else{
						$message="No se pudieron insertar los datos";
						$class="alert alert-danger";
					}
					
					?>
				<div class="<?php echo $class?>">
				  <?php echo $message;?>
				</div>	
					<?php
				}
	
			?>
                <div class="p-5">
                <form method="post">              
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control form-control-user" id="nombre_raza" name="nombre_raza" placeholder="Nombre" require>
                    </div>
                    <div class="col-sm-6">  
                    <label for="">Descripción</label>
                      <input type="text" class="form-control form-control-user" id="descripcion" name="descripcion" placeholder="Descripcion" >
                    
            </div>
                 </div>                 
                 </div>
                  </div>

                  <button type="submit" class="btn btn-primary btn-user btn-block">Agregar</button>                
                </form>              
        </div>
     

</div>
                </div>
              </div>

        

<!-- /.container-fluid -->

<!-- End of Main Content -->
<?php include("footer.php") ?>