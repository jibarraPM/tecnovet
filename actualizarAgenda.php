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
<h1 class="h3 mb-2 text-gray-800">Registro de Edición de Agenda</h1>
<p class="mb-4">En esta pestaña podra Actualizar los datos de la cita seleccionada</p>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
                <div class="card-header py-3">
                <div class="text-right">
    <a href="agendas.php" class=" btn btn-primary btn-icon-split">
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
					$fecha = $agendas->sanitize($_POST['fecha']);
                    $hora = $agendas->sanitize($_POST['hora']);
                    $tipo = $agendas->sanitize($_POST['tipo']);				
					$res = $agendas->actualizarAgenda($fecha,$hora,$tipo,$id);
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
                $datos_agenda=$agendas->editar_agenda($id);
			?>
            <div class="p-5">
            <form method="post">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Mascota</label>
                    <input type="text" class="form-control form-control-user" id="mascota" name="mascota" placeholder="Mascota" value="<?php echo $datos_agenda->nombre_mascota. " # ". $datos_agenda->nombre." ". $datos_agenda->apellido  ;?>" disabled>
                    
                    </div>
                    <div class="col-sm-6">
                    <label for="">Fecha</label>
                      <input type="Date" class="form-control form-control-user" id="fecha" name="fecha" placeholder="Fecha" value="<?php echo $datos_agenda->fecha;?>" >
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="">Hora</label>
                    <input type="Time" class="form-control form-control-user" id="hora" name="hora" placeholder="hora" value="<?php echo $datos_agenda->hora;?>">
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