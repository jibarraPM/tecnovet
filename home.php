<?php include("header.php") ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bienvenido </h1>
          </div>

          <!-- Content Row -->
          <div class="row">
          <?php 
            include('database.php');
            $datos = new Database();
            $totalUsuarios = $datos->totalUsuarios();
            $totalMascotas = $datos->totalMascotas();
            $totalControles = $datos->totalControles();
            $totalAgenda = $datos->totalAgenda();
        ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Dueños</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalUsuarios;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mascotas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalMascotas;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-paw fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Controles</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $totalControles;?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Visitas del Dia</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalAgenda;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          

          <h1 class="h3 mb-2 text-gray-800">Listado de Citas Agendadas </h1>
<p class="mb-4">En esta pestaña encontrara la información todas las citas agendadas en el sistema</p>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  

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
            <th>Contacto</th>
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
            <th>Contacto</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tipo</th>
            <th>Acción</th>
          </tr>
        </tfoot>
        <?php 
            $listado =$datos->leerAgendasHome();
        ?>
        <tbody>
            <?php
                while ($row=mysqli_fetch_object($listado)){
                    $id=$row->id;
                    $nombre_mascota=$row->nombre_mascota;
                    $nombre=$row->nombre;
                    $apellido=$row->apellido;
                    $contacto=$row->contacto;
                    $rut=$row->rut;
                    $fecha=$row->fecha;
                    $hora=$row->hora;
                    $tipo=$row->tipo;

             ?>
          <tr>
            <td><?php echo $id;?></td>
            <td><?php echo $nombre_mascota;?></td>
            <td><?php echo $nombre. " ". $apellido. " # ". $rut;?></td>
            <td><?php echo $contacto;?></td>
            <td><?php echo date("d/m/Y", strtotime($fecha));?></td>
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
      

      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <?php include("footer.php") ?>
