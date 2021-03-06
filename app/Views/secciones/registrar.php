<?php
session_start();
//namespace App\Controllers;
//use CodeIgniter\HTTP\Files\UploadedFile;
//use CodeIgniter\HTTP\Files\FileCollection;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    //var_dump($_POST);
    //var_dump($_FILES);die;
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://localhost/colibri/index.php/secciones/create",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>
        "seccion=".$_POST["seccion"].
        "&id_grado=".$_POST["id_grado"].
        "&id_cliente=1",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic YTJhYTA3YWRmaGRmcmV4ZmhnZGZoZGZlcnR0Z2VMaHJqbVR2b2cyS0hMZ2l4b0s4YjZjcHR0dS8wZFRXOm8yYW8wN29kZmhkZnJleGZoZ2RmaGRmZXJ0dGdlL3BKUmZVVlhYc1E0MW9TUURnUHUzNDB6VU42TlZSbQ==",
            "Content-Type: application/x-www-form-urlencoded",
                                    ),
                                   ));

    $response = curl_exec($curl);

    curl_close($curl);


    // Puede que tengamos caracteres ocultos la final de la respuesta
    $data = substr($response, 0, $_SESSION["tam"]);
    //$data = substr($response, 0, -269);
    $data = json_decode($data, true);
    if ($data["Estado"] != 200)
    {
        var_dump($data);die;
	}
    // Redireccion

    
}
//if (session_start() == false)
//{
   // session_start();
//}


$casa = new App\Controllers\Casa();
$nmodulos = $casa->traerModulos();

$datos = ["perfil"  => $_SESSION["perfil"],                                                                                                         
         "titulo"  => "SECCIONES",
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
			<h3>Registrar nuevo alumno</h3>
		    </div>
		    <div class="widget-content" >
			
			<form  method="post" action="<?php base_url().'/index.php/secciones/create'?>" enctype="multipart/form-data" class="needs-validation" novalidate>
			    <div class="form-row">
				<div class="form-group col-md-6">
				    <label for="nombres">Grado</label>
				    <select id="id_grado" name="id_grado" class="form-control" required>
					<?php foreach ($grados as $grado): ?>
					    <option value="<?= $grado["idGrado"]?>"> <?= $grado["grado"]; ?></option>
					    <?php endforeach; ?> 
				    </select>
				    <div class="valid-feedback">
					Esto est&aacute; bien
				    </div>
				    <div class="invalid-feedback">
					Ingrese su seccion
				    </div>
				</div>
				<div class="form-group col-md-6">
				    <label for="seccion">Sección</label>
				    <input type="text" name="seccion" class="form-control" id="seccion" required>
				    <div class="valid-feedback">
					Esto est&aacute; bien
				    </div>
				    <div class="invalid-feedback">
					Ingrese su grado
				    </div>
				</div>
			    </div>
			    <button type="submit" class="btn btn-primary">Registrar</button>
			</form>
			
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

<script>
 // Example starter JavaScript for disabling form submissions if there are invalid fields
 (function() {
     'use strict';
     window.addEventListener('load', function() {
	 // Fetch all the forms we want to apply custom Bootstrap validation styles to
	 var forms = document.getElementsByClassName('needs-validation');
	 // Loop over them and prevent submission
	 var validation = Array.prototype.filter.call(forms, function(form) {
	     form.addEventListener('submit', function(event) {
		 if (form.checkValidity() === false) {
		     event.preventDefault();
		     event.stopPropagation();
		 }
		 form.classList.add('was-validated');
	     }, false);
	 });
     }, false);
 })();
</script>

<?php echo view("comun/pie"); ?>