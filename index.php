<?php
include_once 'dbconfig.class.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<title>Inserer Une Image</title>

</head>

<body>
	<div class="container">
	<div class="col-lg-12 w-100 ml-0 mr-0 mx-auto mt-2">
		<h1><span class="badge bg-primary rounded-pill">insérer nouvelle image</span></h1>
		<form class="form ml-0 mr-0 mx-auto mt-2" method='post' action='' enctype='multipart/form-data'>
		<div class="col-lg-12 form-group fl_icon">
			<input type="text" name="title" class="form-control" placeholder="Image category">
		</div>
		<div class="col-lg-12 form-group fl_icon mt-2">
			<input type='file' class="form-control" name='files[]' multiple />
		</div>
		<div class="col-lg-12 form-group fl_icon mt-2">
			<a href="view.php" class="btn btn-info text-white mt-2 fw-bold" style="width:15% ;"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Afficher Gallerie</a>
	         <button type='submit' class="btn btn-success mt-2 fw-bold" name='upload_img' style="width:15% ;"><i class="fa fa-check-circle"></i> Enregistrer</button>
		</div>
		</form>
		<?php
		// include "database_connection.php";

if (isset($_POST['upload_img'])) {
	$database = new Connection();
	$db = $database->openConnection();
	$category = $_POST['title'];
	// Count total files
	$countfiles = count($_FILES['files']['name']);

	// Prepared statement

	$query = "INSERT INTO images (name,image,title) VALUES(?,?,?)";

	$statement = $db->prepare($query);

	// Loop all files
	for ($i = 0; $i < $countfiles; $i++) {

		// File name
		$filename = $_FILES['files']['name'][$i];

		// Location
		$target_file = './uploads/' . $filename;

		// file extension
		$file_extension = pathinfo(
			$target_file,
			PATHINFO_EXTENSION
		);

		$file_extension = strtolower($file_extension);

		// Valid image extension
		$valid_extension = array("png", "jpeg", "jpg", "webp");

		if (in_array($file_extension, $valid_extension)) {

			// Upload file
			if (move_uploaded_file(
				$_FILES['files']['tmp_name'][$i],
				$target_file
			)) {

				// Execute query
				$statement->execute(
					array($filename, $target_file,$category)
				);
			}
		}
	}

	echo '<h3 class="text-success mt-2 fw-bold">Téléchargement des fichiers réussi</h3>';
	$database->closeConnection();
}
?>
	</div>	
	</div>
	

</body>

</html>