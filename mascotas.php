<?php include("header.php") ?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Listado de las Mascotas en el Sistema</h1>
<p class="mb-4">En esta pestaña encontrara la información de las Mascotas registrados en el sistema</p>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="text-right">
    <a href="agregarMascota.php" class=" btn btn-primary btn-icon-split">
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
            <th>N°</th>
            <th>Dueño</th>
            <th>Nombre</th>
            <th>Raza</th>
            <th>Sexo</th>
            <th>Nacimiento</th>
            <th>Chip</th>
            <th>Caracter</th>
            <th>Estado</th>
            <th>Esterilizado</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>N°</th>
            <th>Dueño</th>
            <th>Nombre</th>
            <th>Raza</th>
            <th>Sexo</th>
            <th>Nacimiento</th>
            <th>Chip</th>
            <th>Caracter</th>
            <th>Estado</th>
            <th>Esterilizado</th>
            <th>Acción</th>
          </tr>
        </tfoot>
        <?php
            include('database.php');
            $mascotas = new Database();
            $listado = $mascotas->leerMascotas();
            $contador= 0;
        ?>
        <tbody>
            <?php
                while ($row=mysqli_fetch_object($listado)){
                    $contador+=1;
                    $id=$row->id;
                    $nombreUsuario=$row->nombre;
                    $apellido=$row->apellido;
                    $nombre_mascota=$row->nombre_mascota;
                    $especie=$row->especie;
                    $raza=$row->nombre_raza;
                    $sexo=$row->sexo;
                    $fechaNacimiento=$row->fechaNacimiento;
                    $color=$row->color;
                    $chip=$row->chip;
                    $caracter=$row->caracter;
                    $estado=$row->estado_mascota;
                    $esterilizado=$row->esterilizado;
                    $foto=$row->foto;


             ?>
          <tr>
            <td><?php echo $contador;?></td>
            <td><?php echo $nombreUsuario. " ". $apellido;?></td>
            <td><?php echo $nombre_mascota;?></td>
            <td><?php echo $raza;?></td>
            <td><?php echo $sexo;?></td>
            <td><?php echo date("d/m/Y", strtotime($fechaNacimiento));?></td>
            <td><?php echo $chip;?></td>
            <td><?php echo $caracter;?></td>
            <td><?php echo $estado;?></td>
            <td><?php echo $esterilizado;?></td>
            <td>
              <a href="detalleMascota.php?id=<?php echo $id;?>" class="btn btn-primary btn-circle"><i class="fas fa-info"></i></a>
              <a href="actualizarMascota.php?id=<?php echo $id;?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
              <a href="controlMascota.php?id=<?php echo $id;?>" class="btn btn-primary btn-circle"><i class="fas fa-file-alt"></i></a>
              <a href="agregarAgendaMascota.php?id=<?php echo $id;?>" class="btn btn-success btn-circle"><i class="fas fa-calendar"></i></a>
            </td>
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
