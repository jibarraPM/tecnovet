<?php include("header.php") ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Registro de Nuevo Control</h1>
<p class="mb-4">En esta pestaña podra I ngresar un nuevo Control</p>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
                <div class="card-header py-3">
                <div class="text-right">
    <a href="controles.php" class=" btn btn-primary btn-icon-split">
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
				$control= new Database();
				if(isset($_POST) && !empty($_POST)){
					$fecha = $control->sanitize($_POST['fecha']);
                    $veterinario = $control->sanitize($_POST['veterinario']);
                    $mascota= $control->sanitize($_POST['mascota']);
                    $consulta = $control->sanitize($_POST['consulta']);
					$fr = $control->sanitize($_POST['fr']);					
					$fc = $control->sanitize($_POST['fc']);
                    $presion= $control->sanitize($_POST['presion']);
                    $mucosa = $control->sanitize($_POST['mucosa']);
                    $vacuna = $control->sanitize($_POST['vacuna']);
                    $observacion = $control->sanitize($_POST['observacion']);
                    $documento = " ";
                    $path = $_FILES["documento"]["tmp_name"];
                   if(is_uploaded_file($path) && !empty($_FILES)){
                      $documento = addslashes(file_get_contents($_FILES['documento']['tmp_name']));	
                      }

					$res = $control->agregarControl($fecha, $veterinario,$mascota,$consulta,$fr,$fc,$presion,$mucosa,$vacuna,$observacion, $documento);
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
                <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="">Fecha</label>
                        <input type="date" class="form-control form-control-user" id="fecha" name="fecha" placeholder="Fecha">
                    </div>
                    <div class="col-sm-6">
                        <label >Veterinario</label>
                        <select class="form-control" name="veterinario" id="veterinario">
                            <?php
                                $usarVeterinario = $control->usarVeterinario();
                                while ($row=mysqli_fetch_object($usarVeterinario)){
                                $id_usar_veterinario=$row->id;
                                $nombre_usar_veterinario=$row->nombre;
                                $apellido_usar_veterinario=$row->apellido;
                                $rut_usar_veterinario=$row->rut;
                            ?>
                            <option value=<?php echo $id_usar_veterinario ?>><?php echo $apellido_usar_veterinario. " ". $nombre_usar_veterinario. "  ". $rut_usar_veterinario  ?></option>
                            <?php 
                                }
                            ?>  
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label >Mascota</label>
                        <select class="form-control" name="mascota" id="mascota">
                            <?php
                                $usarMascota = $control->usarMascota();
                                while ($row=mysqli_fetch_object($usarMascota)){
                                $id_usar_mascota=$row->id;
                                $nombre_mascota_usar_mascota=$row->nombre_mascota;
                                $rut_usar_mascota=$row->rut;
                                $nombre_usar_mascota=$row->nombre;
                                $apellido_usar_mascota=$row->apellido;
                                
                            ?>
                            <option value=<?php echo $id_usar_mascota ?>><?php echo $nombre_mascota_usar_mascota. " ". $apellido_usar_mascota. " ". $nombre_usar_mascota. "  ". $rut_usar_mascota  ?></option>
                            <?php 
                                }
                            ?>  
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label >Consulta</label>
                        <select class="form-control" name="consulta" id="consulta">
                                <option value="Consulta">Consulta</option>
                                <option value="Vacuna">Vacuna</option>
                                <option value="Hospitalización">Hospitalización</option>
                                <option value="Tratamiento">Tratamiento</option>
                                <option value="Peluqueria">Peluqueria</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="fr" name="fr" placeholder="FR">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="fc" name="fc" placeholder="FC">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="presion" name="presion" placeholder="Presión">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="mucosa" name="mucosa" placeholder="Mucosa">
                    </div>    
                  </div>
                  <div class="form-group" class="col-sm-6 mb-3 mb-sm-0">
                    <label >Vacuna</label>
                        <select class="form-control" name="vacuna" id="vacuna">
                            <option value="Sin Vacuna">Sin Vacuna</option>
                            <option value="Coronavirus">Coronavirus</option>
                            <option value="Séxtuple">Séxtuple</option>
                            <option value="Octuple">Octuple</option>
                            <option value="Traqueobronquitis">Traqueobronquitis</option>
                            <option value="Leucemia">Leucemia</option>
                            <option value="Triple Felina">Triple Felina</option>
                            <option value="Rabia">Rabia</option>
                        </select>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="observacion" name="observacion" placeholder="Observación">
                  </div>
                  <div class="form-group">
                  <input type="file" class="form-control-file file-path validate" id="documento" name="documento" accept="image/*">
                  </div>
                  
                  <button type="submit" class="btn btn-primary btn-block">Agregar</button>                
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