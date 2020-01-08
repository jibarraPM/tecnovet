<?php include("header.php") ?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Listado de las Controles en el Sistema</h1>
<p class="mb-4">En esta pestaña encontrara la información de los Controles registrados en el sistema</p>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="text-right">
    <a href="agregarControl.php" class=" btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Agregar</span>
    </a>
    </div>
  </div>
  
  <div class="card-body">
    <div class="table-responsive">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="example" class="display table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Veterinario</th>
            <th>Mascota</th>
            <th>Consulta</th>
            <th>FR</th>
            <th>FC</th>
            <th>Presión</th>
            <th>Mucosa</th>
            <th>Vacuna</th>
            <th>Observación</th>
            <th>Documento</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Veterinario</th>
            <th>Mascota</th>
            <th>Consulta</th>
            <th>FR</th>
            <th>FC</th>
            <th>Presión</th>
            <th>Mucosa</th>
            <th>Vacuna</th>
            <th>Observación</th>
            <th>Documento</th>
          </tr>
        </tfoot>
        <?php 
            include('database.php');
            $controles = new Database();
            $listado = $controles->leerControles();
        ?>
        <tbody>
            <?php
                while ($row=mysqli_fetch_object($listado)){
                    $id=$row->id;
                    $fecha=$row->fecha;
                    $nombre=$row->nombre;
                    $nombre_mascota=$row->nombre_mascota;
                    $consulta=$row->consulta;
                    $fr=$row->fr;
                    $fc=$row->fc;
                    $presion=$row->presion;
                    $mucosa=$row->mucosa;
                    $vacuna=$row->vacuna;
                    $observacion=$row->observacion;
                    $documento=$row->documento;
             ?>
          <tr>
            <td><?php echo $id;?></td>
            <td><?php echo date("d/m/Y", strtotime($fecha));?></td>
            <td><?php echo $nombre;?></td>
            <td><?php echo $nombre_mascota;?></td>
            <td><?php echo $consulta;?></td>
            <td><?php echo $fr;?></td>
            <td><?php echo $fc;?></td>
            <td><?php echo $presion;?></td>
            <td><?php echo $mucosa;?></td>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->





<?php include("footer.php") ?>