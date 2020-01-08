<?php include("header.php") ?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Listado de Usuarios y Dueños</h1>
<p class="mb-4">En esta pestaña encontrara la información de los dueños registrados en el sistema</p>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="text-right">
    <a href="agregarUsuario.php" class=" btn btn-primary btn-icon-split">
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
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Rut</th>
            <th>Dirección</th>
            <th>Contacto</th>
            <th>Correo</th>
            <th>Mascotas</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>N°</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Rut</th>
            <th>Dirección</th>
            <th>Contacto</th>
            <th>Correo</th>
            <th>Mascotas</th>
            <th>Acción</th>
          </tr>
        </tfoot>
        <?php
            include('database.php');
            $usuarios = new Database();
            $listado = $usuarios->leerUsuarios();
            $contador = 0;
        ?>
        <tbody>
            <?php
                while ($row=mysqli_fetch_object($listado)){
                    $contador+=1;
                    $id=$row->id;
                    $nombre=$row->nombre;
                    $apellido=$row->apellido;
                    $rut=$row->rut;
                    $direccion=$row->direccion;
                    $contacto=$row->contacto;
                    $correo=$row->correo;
                    $estado=$row->estado;

             ?>
          <tr>
            <td><?php echo $contador;?></td>
            <td><?php echo $nombre;?></td>
            <td><?php echo $apellido;?></td>
            <td><?php echo $rut;?></td>
            <td><?php echo $direccion;?></td>
            <td><?php echo $contacto;?></td>
            <td><?php echo $correo;?></td>
            <td>
            <?php
             $nm="";
             $mascota = $usuarios->mascotaUsuario($id);
             while ($row2=mysqli_fetch_object($mascota)){


               $nm = $nm.$row2->nombre_mascota;
               $nm = $nm."<br />";
             }
             echo $nm;


            ?>
            </td>
            <td><a href="actualizarUsuario.php?id=<?php echo $id;?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                <a href="agregarMascotaUsuario.php?id=<?php echo $id;?>" class="btn btn-primary btn-circle"><i class="fas fa-paw"></i></a></td>
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
