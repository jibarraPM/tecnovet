<?php include("header.php") ?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Listado de Citas Agendadas </h1>
<p class="mb-4">En esta pestaña encontrara la información todas las citas agendadas en el sistema</p>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="text-right">
    <a href="agregarAgenda.php" class=" btn btn-primary btn-icon-split">
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
            <th>Mascota</th>
            <th>Dueño</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tipo</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Mascota</th>
            <th>Dueño</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tipo</th>
            <th>Acción</th>
          </tr>
        </tfoot>
        <?php 
            include('database.php');
            $usuarios = new Database();
            $listado = $usuarios->leerAgendas();
        ?>
        <tbody>
            <?php
                while ($row=mysqli_fetch_object($listado)){
                    $id=$row->id;
                    $nombre_mascota=$row->nombre_mascota;
                    $nombre=$row->nombre;
                    $apellido=$row->apellido;
                    $rut=$row->rut;
                    $fecha=$row->fecha;
                    $hora=$row->hora;
                    $tipo=$row->tipo;

             ?>
          <tr>
            <td><?php echo $id;?></td>
            <td><?php echo $nombre_mascota;?></td>
            <td><?php echo $nombre. " ". $apellido. " # ". $rut;?></td>
            <td><?php echo $fecha;?></td>
            <td><?php echo $hora;?></td>
            <td><?php echo $tipo;?></td>
            <td><a href="actualizarAgenda.php?id=<?php echo $id;?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a></td>
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