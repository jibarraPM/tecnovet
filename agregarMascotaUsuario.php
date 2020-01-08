<?php
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
	} else {
		header("location:index.php");
	}
?>
<?php include("header.php") ?>
<!--carga de datos -->
<?php
    include ("database.php");
    $registro = new Database();
    $dueño = $registro->leerDueño($id);
    while ($row=mysqli_fetch_object($dueño)){
        $DueñoNombre=$row->nombre;
        $DueñoApellido=$row->apellido;
    }
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Registro de Mascotas para <?php echo ($DueñoNombre." ".$DueñoApellido);?></h1>
    <p class="mb-4">En esta pestaña podra agregar mascotas del cliente</p>
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
                    $mascotas= new Database();
				    if(isset($_POST) && !empty($_POST)){
                        $usuario = $mascotas->sanitize($id);
                        $nombre = $mascotas->sanitize($_POST['nombre']);
                        $especie = $mascotas->sanitize($_POST['especie']);
                        $raza = $mascotas->sanitize($_POST['raza']);
                        $sexo = $mascotas->sanitize($_POST['sexo']);
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
                        $res = $mascotas->agregarMascota($usuario, $nombre,$especie,$raza,$sexo,$fechaNacimiento,$color,$chip,$caracter,$estado_mascota,$esterilizacion,$foto);
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
                 <!-- Por defecto el perfil es usuario y el estado es 1-->
                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control form-control-user" id="nombre" name="nombre" placeholder="Nombre" require>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0" >
                            <label for="">Dueño</label>
                            <input type="text" class="form-control form-control-user" id="nombre" name="nombre" placeholder="<?php echo $DueñoNombre. " " . $DueñoApellido?>" disabled >
                        </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="">Especie</label>
                                <select class="form-control" id="especie" name="especie">
                                    <option value="Canino">Canino</option>
                                    <option value="Felino">Felino</option>
                                    <option value="Exotico">Exotico</option>
                                </select>
                     </div>
                    <div class="col-sm-6">
                    <label for="">Raza</label>
                    <select class="form-control" id="raza" name="raza">
                    <?php
                      $usarRazas = $mascotas->usarRazas();
                while ($row=mysqli_fetch_object($usarRazas)){
                    $id_usar_raza=$row->id;
                    $nombre_raza_usar=$row->nombre_raza;
             ?>

          <option value=<?php echo $id_usar_raza ?>><?php echo $nombre_raza_usar?></option>

          <?php
            }
          ?>
         </select>
            </div>
                 </div>
                 <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Sexo</label>
                    <select class="form-control" id="sexo" name="sexo">
                      <option value="Macho">Macho</option>
                      <option value="Hembra">Hembra</option>
                    </select>
                    </div>
                    <div class="col-sm-6">
                    <label for="">Fecha Nacimiento:</label>
                    <input type="date" class="form-control form-control-user" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha Nacimiento">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Color</label>
                    <input type="text" class="form-control form-control-user" id="color" name="color" placeholder="Color">
                    </div>
                    <div class="col-sm-6">
                    <label for="">Chip</label>
                    <input type="text" class="form-control form-control-user" id="chip" name="chip" placeholder="Chip">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Caracter</label>
                    <select class="form-control" id="caracter" name="caracter">
                      <option value="Agresivo">Agresivo</option>
                      <option value="Timido">Timido</option>
                      <option value="Sociable">Sociable</option>
                      <option value="Independiente">Independinte</option>


                    </select>
                    </div>
                    <div class="col-sm-6">
                    <label for="">Estado Mascota</label>
                    <select class="form-control" id="estado_mascota" name="estado_mascota">
                     <option value="Sano">Sano</option>
                     <option value="Vacunación">Vacunación</option>
                     <option value="Post-Operatorio">Post-Operatorio</option>
                     <option value="Tratamiento">Tratamiento</option>
                     <option value="Fallecida">Fallecida</option>
                    </select>
            </div>
                 </div>
                 <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Esterilización</label>
                    <select class="form-control" id="esterilizacion" name="esterilizacion">
                      <option value="Si">Si</option>
                      <option value="No">No</option>
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
                  <button type="submit" class="btn btn-primary btn-user btn-block">Agregar</button>
                </form>
        </div>
        </div>

</div>
                </div>
              </div>

            </div>

</div>


<!-- /.container-fluid -->

<!-- End of Main Content -->
<?php include("footer.php") ?>
