<?php

session_start();

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => base_url()."/index.php/cursos",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
      $_SESSION["auth"],
  ),
));

$response = curl_exec($curl);

curl_close($curl);

// Puede que tengamos caracteres ocultos la final de la respuesta
$data = substr($response, 0, $_SESSION["tam"]);
$data = json_decode($data, true);

$casa = new App\Controllers\Casa();
$nmodulos = $casa->traerModulos();

$datos = ["perfil"  => $_SESSION["perfil"],                                                                                                         
         "titulo"  => "CURSOS",                                                                                                                   
         "nombre"  => $_SESSION["nombres"],                                                                                                       
         "modulos" => $nmodulos];

$casa->cargarCabeza($datos);

?>

<!--main-container-part-->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
<div id="content">
    <br><br>
    <!--Action boxes-->
    <div class="container-fluid">
	<!--End-Action boxes-->    

	<!--Chart-box-->    
	<div class="row-fluid">
	    <div class="widget-box">
		<div class="widget-title bg_lg">
		    <h5>Contenido</h5>
		</div>
		<div class="widget-content" >
                    
		    <a href="registrar" class="btn btn-success mb-1">Registrar</a>
		    <a href="tipo" class="btn btn-secondary mb-1 ml-5">Tipos de cursos</a>
		    <a href="registrar" class="btn btn-info mb-1">Categorias de cursos</a>
		    <a href="registrar" class="btn btn-dark mb-1">Naturalezas de cursos</a>		    

		    <table class="table table-bordered table-striped">
			<thead>
			    <tr>
				<th>ID</th>
				<th>Curso</th>
				<th>Tipo</th>
				<th>Categoria</th>
				<th>Naturaleza</th>
				<th colspan="2">Operaciones</th>
			    </tr>
			</thead>

			<?php
			if ($data["Estado"] == 200) {
			    foreach($data["Detalles"] as $curso) { ?>
			    <tbody>
				<tr class="odd gradeX">
				    <td><?php echo $curso['idCurso']; ?></td>
				    <td><?php echo $curso['curso']; ?></td>
				    <td><?php echo $curso['tipo']; ?></td>
				    <td><?php echo $curso['categoria']; ?></td>
				    <td><?php echo $curso['naturaleza']; ?></td>
				    <td><a href="editar/<?= $curso['idCurso']?>" class="btn
						 btn-warning">Editar</a></td>
				    <td><a href="eliminar/<?= $curso['idCurso']?>"
					   class="btn btn-danger">Eliminar</a></td>
				</tr>
			    </tbody>
			<?php
			}
			}
			?>	    

		    </table>
		</div>
	    </div>
	</div>
    </div>
    <!--End-Chart-box--> 
    <hr/>
</div>
</main>
</div>
</div>
<?php echo view("comun/pie"); ?>



