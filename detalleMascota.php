<?php
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
	} else {
		header("location:index.php");
	}
?>

<?php include("header.php"); ?>
<div class="container-fluid">
  <?php
    //Importación de datos
    include("database.php");
    $datos = new Database();
    $detalles = $datos -> editar_mascota($id);
   ?>
     <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($detalles->foto) .'"class=" mx-auto d-block img-thumbnail img-fluid img-responsive " width="150" height="150"/>'; ?>
		 <h1 class="p-3"><?php echo $detalles->nombre_mascota;?></h1>
	 <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Datos de la Mascota</h6>
                </div>
                <div class="card-body">
									<table class="table table-borderless">
									  <thead>
									    <tr>
									      <td >Dueño: <?php echo $detalles->nombre. " ". $detalles->apellido; ?></td>
									      <td >Raza: <?php echo $detalles->nombre_raza; ?></td>
									      <td >Chip: <?php echo $detalles->chip; ?></td>
									    </tr>
									  </thead>
									  <tbody>
									    <tr>
									      <td>RUT: <?php echo $detalles->rut; ?></td>
									      <td>Sexo: <?php echo $detalles->sexo; ?></td>
									      <td>Caracter: <?php echo $detalles->caracter ?></td>
									    </tr>
									    <tr>
									      <td>Especie: <?php echo $detalles->especie; ?></td>
									      <td>Fecha Nacimiento: <?php echo date("d/m/Y", strtotime($detalles->fechaNacimiento)); ?></td>
									      <td>Esterilizado: <?php echo $detalles->esterilizado; ?></td>
									    </tr>
									  </tbody>
									</table>
                </div>
              </div>
            </div>

						<div class="card-body">
					    <div class="table-responsive">
					                <div class="col-lg-12">
					                    <div class="table-responsive">
					                        <table id="example" class="display table table-bordered" id="dataTable" width="100%" cellspacing="0">
					        <thead>
					          <tr>
					            <th>Fecha</th>
					            <th>Veterinario</th>
					            <th>Vacuna</th>
					            <th>Observación</th>
											<th>Documento</th>
					          </tr>
					        </thead>
					        <tfoot>
					          <tr>
											<th>Fecha</th>
					            <th>Veterinario</th>
					            <th>Vacuna</th>
					            <th>Observación</th>
											<th>Documento</th>
					          </tr>
					        </tfoot>
					        <?php
					            $listado = $datos->detalleControl($id);
					        ?>
					        <tbody>
					            <?php
					                while ($row=mysqli_fetch_object($listado)){
					                    $fecha=$row->fecha;
					                    $nombre=$row->nombre;
					                    $apellido=$row->apellido;
					                    $vacuna=$row->vacuna;
					                    $observacion=$row->observacion;
					                    $documento=$row->documento;
					             ?>
					          <tr>
					            <td><?php echo date("d/m/Y", strtotime($fecha));?></td>

					            <td><?php echo $nombre. " ". $apellido;?></td>
					            <td><?php echo $vacuna;?></td>
					            <td><?php echo $observacion;?></td>
					            <td> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($documento) .'"class="img-fluid img-responsive " width="75" height="75"/>'; ?></td>
					          </tr>
					          <?php
					            }
					          ?>
					        </tbody>
					      </table>
					    </div>
					  </div>
					</div>

					</div>


  <?php include("footer.php"); ?>
</div>
