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
<h1 class="h3 mb-2 text-gray-800">Registro de Edición de Mascotas</h1>
<p class="mb-4">En esta pestaña podra Actualziar los datos de la Mascota Seleccionada</p>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
                <div class="card-header py-3">
                <div class="text-right">
    <a href="mascotas.php" class=" btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-paw"></i>
        </span>
        <span class="text">Volver</span>
    </a>
    </div>
                </div>
                <div class="card-body">
                <div class="table-wrapper">
            <?php
				include ("database.php");
				$mascotas= new Database();
				if(isset($_POST) && !empty($_POST)){
								
                    $fechaNacimiento = $mascotas->sanitize($_POST['fechaNacimiento']);
                    $color = $mascotas->sanitize($_POST['color']);	
                    $chip = $mascotas->sanitize($_POST['chip']);	
                    $caracter = $mascotas->sanitize($_POST['caracter']);	
                    $estado_mascota = $mascotas->sanitize($_POST['estado_mascota']);
                    $esterilizacion = $mascotas->sanitize($_POST['esterilizacion']);
                    $foto = " ";
                    $path = $_FILES["foto"]["tmp_name"];
                   if(is_uploaded_file($path) && !empty($_FILES)){
                      $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));	
                      }
					          $res = $mascotas->actualizarMascota($fechaNacimiento,$chip,$caracter,$estado_mascota,$esterilizacion, $id, $color, $foto);
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
                $datos_mascota=$mascotas->editar_mascota($id);
			?>
            <div class="p-5">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Dueño</label>
                    <input type="text" class="form-control form-control-user" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $datos_mascota->nombre. " ". $datos_mascota->apellido;?>" disabled>
                    </div>
                    <div class="col-sm-6">
                    <label for="">Nombre</label>
                      <input type="text" class="form-control form-control-user" id="mascota" name="mascota" placeholder="Nombre" value="<?php echo $datos_mascota->nombre_mascota;?>" disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Especie</label>
                    <input type="text" class="form-control form-control-user" id="especie" name="especie" placeholder="Nombre" value="<?php echo $datos_mascota->especie;?>" disabled>
                    </div>
                    <div class="col-sm-6">
                    <label for="">Raza</label>
                    <input type="text" class="form-control form-control-user" id="raza" name="raza" placeholder="Nombre" value="<?php echo $datos_mascota->nombre_raza;?>" disabled>
            </div>
                 </div>
                 <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Sexo</label>
                    <input type="text" class="form-control form-control-user" id="sexo" name="sexo" placeholder="Nombre" value="<?php echo $datos_mascota->sexo;?>" disabled>
                    </div>
                    <div class="col-sm-6">
                    <label for="">Fecha Nacimiento:</label>
                    <input type="date" class="form-control form-control-user" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha Nacimiento" value="<?php echo $datos_mascota->fechaNacimiento;?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Color</label>
                    <input type="text" class="form-control form-control-user" id="color" name="color" placeholder="Color" value="<?php echo $datos_mascota->color;?>">
                    </div>
                    <div class="col-sm-6">
                    <label for="">Chip</label>
                    <input type="text" class="form-control form-control-user" id="chip" name="chip" placeholder="Chip" value="<?php echo $datos_mascota->chip;?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Caracter</label>
                    
                    <select class="form-control" id="caracter" name="caracter">
                      <option value="Agresivo" <?php if($datos_mascota->caracter =="Agresivo"){echo "selected"; } ?>>Agresivo</option>
                      <option value="Timido" <?php if($datos_mascota->caracter =="Timido"){echo "selected"; } ?>>Timido</option>
                      <option value="Sociable" <?php if($datos_mascota->caracter =="Sociable"){echo "selected"; } ?>>Sociable</option>
                      <option value="Independiente" <?php if($datos_mascota->caracter =="Independiente"){echo "selected"; } ?>>Independinte</option>

                      
                    </select>
                    </div>
                    <div class="col-sm-6">
                    <label for="">Estado Mascota</label>
                    <select class="form-control" id="estado_mascota" name="estado_mascota"> 
                     <option value="Sano">Sano</option>
                     <option value="Vacunación" <?php if($datos_mascota->estado_mascota =="Vacunación"){echo "selected"; } ?>>Vacunación</option>
                     <option value="Post-Operatorio" <?php if($datos_mascota->estado_mascota =="Post-Operatorio"){echo "selected"; } ?>>Post-Operatorio</option>
                     <option value="Tratamiento" <?php if($datos_mascota->estado_mascota =="Tratamiento"){echo "selected"; } ?>>Tratamiento</option>
                     <option value="Fallecida" <?php if($datos_mascota->estado_mascota =="Fallecida"){echo "selected"; } ?>>Fallecida</option>                  
                    </select>
            </div>
                 </div>
                 <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Esterilización</label>
                    <select class="form-control" id="esterilizacion" name="esterilizacion">
                      <option value="No" <?php if($datos_mascota->esterilizado =="No"){echo "selected"; } ?>>No</option>
                      <option value="Si" <?php if($datos_mascota->esterilizado =="Si"){echo "selected"; } ?>>Si</option>                      
                    </select>
                    </div>
                    <div class="col-sm-6">
                    <label for="">Foto</label>
                   
                    
                    <input type="file" class="form-control-file file-path validate" id="foto" name="foto" accept="image/*">
                    </div>
            </div>
                 </div>
                  </div>
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