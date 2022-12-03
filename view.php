<?php
include_once 'dbconfig.class.php';

// include "database_connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
	<style>
		body {
			margin: 0;
			padding: 0;
		}

		/* .container{
	width:90%
	margin:10px auto;
} */
		.portfolio-menu {
			text-align: center;
		}

		.portfolio-menu ul li {
			display: inline-block;
			margin: 0;
			list-style: none;
			padding: 10px 15px;
			cursor: pointer;
			-webkit-transition: all 05s ease;
			-moz-transition: all 05s ease;
			-ms-transition: all 05s ease;
			-o-transition: all 05s ease;
			transition: all .5s ease;
		}


		.portfolio-item .item {
			/*width:303px;*/
			float: left;
			margin-bottom: 10px;
		}

		.badge.even-larger-badge {
			font-size: 1.1em;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 my-4">
				<a href="index" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter une nouvelle image</a>
			</div>
			<div class="col-lg-12 text-center my-1">
				<h1><span class="mt-2 badge rounded-pill badge-primary ">Image Gallerie</span></h1>
			</div>
		</div>
		<!-- <div class="portfolio-menu mt-2 mb-4">
			<ul>
				<li class="btn btn-outline-dark active" data-filter="*">All</li>
			</ul>
		</div> -->
		<div class="portfolio-item row mt-2">
			<?php
			$database = new Connection();
			$db = $database->openConnection();
			$stmt = $db->prepare('select * from images');
			$stmt->execute();
			$imagelist = $stmt->fetchAll();

			foreach ($imagelist as $image) {
			?>

				<div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
					<a href="<?php echo $image['image'] ?>" class="fancylight popup-btn" data-fancybox-group="light">
						<img class="img-fluid" src="<?php echo $image['image'] ?>" title="<?= $image['name'] ?>" width='170' height='170'>
					</a>
					<div class="w-50 ml-0 mr-0 mx-auto mt-2">
						<a class="btn btn-warning text-white mt-1" href="comments?id=<?php echo $image['id'] ?>"><i class="fa fa-comments"></i> Avis</a>
						<a href="#myModal" role="button" class="btn text-danger" data-id="4" data-toggle="modal" data-toggle="modal" data-id_img="<?php echo $image['id'] ?>"><i class="fa fa-trash-o"></i></a>
					</div>
				</div>

			<?php
			}
			?>
		</div>
	</div>

	<!--Modal for delete img-->
	<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header flex-column">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title w-100 text-center text-danger">Supprimer l'image</h4>
				</div>
				<div class="modal-body">
					<form action="">
						<input type="hidden" name="id_imgsup" id="showimg_id" value="">
						<h2 class="text-danger text-center">confirmer la supprition ?</h2>
						<h2 class="text-danger text-center">😕</h2>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn btn-danger" type="submit">supprimer</button>
					</form>

				</div>
			</div>
		</div>
	</div>

	<div id="myModal" class="modal hide">
		<div class="modal-header">
			<a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
			<h3>Delete</h3>
		</div>
		<div class="modal-body">
			<p>You are about to delete.</p>
			<p>Do you want to proceed?</p>
		</div>
		<div class="modal-footer">
			<a href="#" id="btnYes" class="btn danger">Yes</a>
			<a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
		</div>
	</div>



	<!--scriiipts-->
	<script>
		$(function() {
			$('#myModal').on('show.bs.modal', function(event) {
				var button = $(event.relatedTarget);
				var id_img = button.data('id_img'); 
				var modal = $(this);
				modal.find('#showimg_id').val(id_img);
			});
		});
	</script>

	<script>
		$('#myModal').on('show', function() {
			var id = $(this).data('id'),
				removeBtn = $(this).find('.danger');
		})

		$('.confirm-delete').on('click', function(e) {
			e.preventDefault();

			var id = $(this).data('id');
			$('#myModal').data('id', id).modal('show');
		});

		$('#btnYes').click(function() {
			// handle deletion here
			var id = $('#myModal').data('id');
			$('[data-id=' + id + ']').remove();
			$('#myModal').modal('hide');
		});
	</script>
	<script>
		// $('.portfolio-item').isotope({
		//  	itemSelector: '.item',
		//  	layoutMode: 'fitRows'
		//  });
		$('.portfolio-menu ul li').click(function() {
			$('.portfolio-menu ul li').removeClass('active');
			$(this).addClass('active');

			var selector = $(this).attr('data-filter');
			$('.portfolio-item').isotope({
				filter: selector
			});
			return false;
		});
		$(document).ready(function() {
			var popup_btn = $('.popup-btn');
			popup_btn.magnificPopup({
				type: 'image',
				gallery: {
					enabled: true
				}
			});
		});
	</script>
</body>

</html>