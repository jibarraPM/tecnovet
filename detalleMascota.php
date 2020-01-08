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
   <h1><?php echo $detalles->nombre_mascota;?></h1>



  <?php include("footer.php"); ?>
</div>
