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
<h1 class="h3 mb-2 text-gray-800">Registro de Nuevas Agenda</h1>
<p class="mb-4">En esta pestaña podra ingresar un nueva Agenda</p>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
                <div class="card-header py-3">
                <div class="text-right">
    <a href="mascotas.php" class=" btn btn-primary btn-icon-split">
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
				$agendas= new Database();
				if(isset($_POST) && !empty($_POST)){
										$mascota = $agendas->sanitize($_POST['mascota']);
                    $fecha = $agendas->sanitize($_POST['fecha']);
                    $hora = $agendas->sanitize($_POST['hora']);
                    $tipo = $agendas->sanitize($_POST['tipo']);

					$res = $agendas->agregarAgenda($id, $fecha,$hora,$tipo);
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
                    <label for="">Mascota</label>

                    <select class="form-control" id="mascota" name="mascota" >
                      <?php
                      $usarAgenda = $agendas->usarMascota2($id);
                while ($row=mysqli_fetch_object($usarAgenda)){
                    $id_usar_mascota=$row->id;
                    $nombre_mascota_usar_mascota=$row->nombre_mascota;
                    $nombre_usar_mascota=$row->nombre;
                    $apellido_usar_mascota=$row->apellido;
                    $rut_usar_mascota=$row->rut;
             ?>

          <option value=<?php echo $id_usar_mascota ?>><?php echo $nombre_mascota_usar_mascota. " # ". $nombre_usar_mascota. "  ". $apellido_usar_mascota. " # ". $rut_usar_mascota  ?></option>

          <?php
            }
          ?>
                    </select>
                    </div>
                    <div class="col-sm-6">
                    <label for="">Fecha</label>
                      <input type="Date" class="form-control form-control-user" id="fecha" name="fecha" placeholder="Fecha" require>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Hora</label>
                    <input type="Time" class="form-control form-control-user" id="hora" name="hora" placeholder="hora" require>
                    </div>
                    <div class="col-sm-6">
                    <label for="">Tipo</label>
                    <select class="form-control" id="tipo" name="tipo">
                        <option value="Consulta">Consulta</option>
                        <option value="Vacuna">Vacuna</option>
                        <option value="Hospitalización">Hospitalización</option>
                        <option value="Tratamiento">Tratamiento</option>
                        <option value="Peluqueria">Peluqueria</option>
                    </select>

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


<!-- /.container-fluid -->

<!-- End of Main Content -->
<?php include("footer.php") ?>
