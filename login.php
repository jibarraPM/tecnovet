<?php
    include_once 'database.php';
    
    session_start();
    if(isset($_GET['cerrar_sesion'])){
        session_unset(); 
        // destroy the session 
        session_destroy(); 
    }

    if(isset($_POST['rut']) && isset($_POST['clave'])){
        $rut = $_POST['rut'];
        $clave = $_POST['clave'];
        $db = new Database();
        $query = $db->connect()->prepare('SELECT *FROM usuarios WHERE rut = :rut AND clave = :clave');
        $query->execute(['rut' => $rut, 'clave' => $clave]);
        $row = $query->fetch(PDO::FETCH_NUM);
        if($row == true){
          $_SESSION['rut']=$rut;
          $_SESSION['clave']=$clave;
          header('location: home.php');
        }else{
            // no existe el usuario
            echo "Nombre de usuario o contraseña incorrecto";
        }
        
    }
?>


<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Gestion de Usuarios</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Ingresar al Sistema</h1>
                  </div>
                  <form class="user" action="" method="POST">
                    <?php
                      if(isset($errorLogin)){
                        echo $errorLogin;
                    }
                    ?>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="rut" id="rut" aria-describedby="emailHelp" placeholder="Ingrese RUT">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="clave" id="clave" placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Recuerdame</label>
                      </div>
                    </div>
                    <button href="" class="btn btn-primary btn-user btn-block">Ingresar</button>
              
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
 <!-- Bootstrap core JavaScript-->
 <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
