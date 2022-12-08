<?php
include_once 'dbconfig.class.php';
$database = new Connection();
$db = $database->openConnection();
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
		@import "compass/css3";

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

		/**modal 5 pagination */
	</style>
</head>

<body>
	<?php
	$count = "SELECT COUNT(*) as nbr_img FROM images WHERE isdeleted !=1 ";
	$nbr_img = $db->prepare($count);
	$nbr_img->execute();
	$res_nbr = $nbr_img->fetch();
	//pagination
	@$page = $_GET['page'];
	if (empty($page))
		$page = 1;
	$nbr_per_page = 8;
	$nbr_de_page = ceil($res_nbr['nbr_img'] / $nbr_per_page);
	$debut = ($page - 1) * $nbr_per_page;
	?>
	<div class="container">
		<div class="section">
			<div class=" my-4">
				<a href="index" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter une nouvelle image</a>
			</div>
			<div class="col-lg-12 text-center my-1">
				<h1><span class="badge bg-primary rounded-pill text-white">Image Gallerie</span></h1>
			</div>
			<form action="" class="mt-4" method="GET">
				<div class="row">
					<div class="col-lg-2 my-1">
						<a href="view.php" style="width: 100%;" class="btn btn-primary fw-bold text-white" id="back_glr"><i class="fa fa-refresh" aria-hidden="true"></i> Actualiser</a>
					</div>
					<div class="col-lg-7 my-1">
						<input type="text" name="recherch" class="form-control" placeholder="Rechercher par category...">
					</div>
					<div class="col-lg-3 my-1">
						<button class="btn btn-primary" type="submit" name="btn_search" style="width: 100%;"><i class="fa fa-search" aria-hidden="true"></i> Rechercher</button>
					</div>
				</div>
			</form>

		</div>

		<!-- <div class="portfolio-menu mt-2 mb-4">
			<ul>
				<li class="btn btn-outline-dark active" data-filter="*">All</li>
			</ul>
		</div> -->
		<div class="section">

			<div class="portfolio-item row mt-5">
				<?php
				if (!isset($_GET['btn_search'])) {
					if (isset($_POST['btn_supimg'])) {

						$id_img = $_POST['id_imgsup'];
						$query = "UPDATE images set isdeleted=1 WHERE id=?";
						$stmt_delete = $db->prepare($query);
						$stmt_delete->execute([$id_img]);
					}
					$stmt = $db->prepare("SELECT * from images where isdeleted != 1 limit $debut,$nbr_per_page");
					$stmt->execute();
					$imagelist = $stmt->fetchAll();
					if (count($imagelist) == 0)
						header("location: view.php");

					foreach ($imagelist as $image) {
				?>
						<!--for one size -->
						<div class="col-sm-3 col-md-3">
							<div class="item selfie ml-2">
								<div class="thumbnail">

									<a href="<?php echo $image['image'] ?>" class="fancylight popup-btn" data-fancybox-group="light">
										<img style="height: 250px;" src="<?php echo $image['image'] ?>" alt="<?= $image['title'] ?>" title="<?= $image['title'] ?>">
									</a>
								</div>
								<div class="caption">
									<h3><?= $image['title'] ?></h3>
									<p>
										<a class="btn btn-primary text-white mt-1" href="comments?id=<?php echo $image['id'] ?>"><i class="fa fa-comments"></i> Avis</a>
										<a href="#myModal" role="button" class="btn text-danger" data-id="4" data-toggle="modal" data-toggle="modal" data-id_img="<?php echo $image['id'] ?>"><i class="fa fa-trash-o"></i></a>
									</p>
								</div>
							</div>
						</div>
						<!--for portfolio-->
						<!-- <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
							<a href="< echo $image['image'] ?>" class="fancylight popup-btn" data-fancybox-group="light">
								<img class="img-fluid" src="< echo $image['image'] ?>" title= $image['title'] ?>" width='200' height='200'>
							</a>
							<div class="w-50 ml-0 mr-0 mx-auto mt-2">
								<a class="btn btn-warning text-white mt-1" href="comments?id=< echo $image['id'] ?>"><i class="fa fa-comments"></i> Avis</a>
								<a href="#myModal" role="button" class="btn text-danger" data-id="4" data-toggle="modal" data-toggle="modal" data-id_img="< echo $image['id'] ?>"><i class="fa fa-trash-o"></i></a>
							</div>
						</div> -->

					<?php
						$database->closeConnection();
					}
					?>
			</div>
			<ul class="pagination justify-content-center">
				<?php
					if ($page > 1) {
						echo '<li class="page-item "><a class="page-link" href="?page=' . ($page - 1) . '"><<</a></li>';
					}else{
		                echo '<li class="page-item "><a class="page-link" href="javascript:void(0);"><<</a></li>';
					}
					for ($i = 1; $i <= $nbr_de_page; $i++) {
						if ($i == $page)
							$active = "active";
						else
							$active = "";

						if ($page != $i)
							echo "<li class=\"page-item \"><a class=\"page-link\" href=\"?page=$i\">$i</a></li>";
						else
							echo "<li class=\"$active page-item \"><a class=\"page-link\">$i</a></li>";
					}
					if ($nbr_de_page > $page) {
						echo '<li class="page-item "><a class="page-link" href="?page=' . ($page + 1) . '">>></a></li>';
					}else{
		                echo '<li class="page-item "><a class="page-link" href="javascript:void(0);">>></a></li>';
					}

				?>
			</ul>
			<!-- <div class="pagination text-center">
				<ul>
					<
					for ($i = 1; $i <= $nbr_de_page; $i++) {
						if ($page != $i)
							echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$i\">$i</a></li>";
						else
							echo "<li class=\"page-item active\"><a class=\"page-link\">$i</a></li>";
					}
					?>
				</ul>
			</div> -->

			<?php
				} else {

					if (isset($_GET['btn_search'])) {
						//pagination for search
						$keyword = $_GET['recherch'];
						$count2 = "SELECT COUNT(*) as nbr_img FROM images WHERE isdeleted !=1 AND title like ?";
						$nbr_img2 = $db->prepare($count2);
						$nbr_img2->execute(['%'. $keyword .'%']);
						$res_nbr2 = $nbr_img2->fetch();
						//pagination
						@$page = $_GET['page'];
						if (empty($page))
							$page = 1;
						$nbr_per_page = 8;

						$nbr_de_page = ceil($res_nbr2['nbr_img'] / $nbr_per_page);
						$debut = ($page - 1) * $nbr_per_page;
						$query = "SELECT * FROM images WHERE isdeleted !=1 AND title LIKE ? limit $debut,$nbr_per_page";
						$stat_srch = $db->prepare($query);
						$stat_srch->execute(['%' . $keyword . '%']);
						$result = $stat_srch->fetchAll();

						foreach ($result as $res) {
			?>
					<div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
						<a href="<?php echo $res['image'] ?>" class="fancylight popup-btn" data-fancybox-group="light">
							<img class="img-fluid" src="<?php echo $res['image'] ?>" title="<?= $res['title'] ?>">
						</a>
						<div class="w-50 ml-0 mr-0 mx-auto mt-2">
							<a class="btn btn-warning text-white mt-1" href="comments?id=<?php echo $res['id'] ?>"><i class="fa fa-comments"></i> Avis</a>
							<a href="#myModal" role="button" class="btn text-danger" data-id="4" data-toggle="modal" data-toggle="modal" data-id_img="<?php echo $res['id'] ?>"><i class="fa fa-trash-o"></i></a>
						</div>
					</div>
			<?php
						}
					}
			?>
		</div>
		<ul class="pagination justify-content-center">
				<?php
					if ($page > 1) {
						echo '<li class="page-item "><a class="page-link" href="?page=' . ($page - 1) . '&recherch='.$keyword.'&btn_search=\'\'"><<</a></li>';
					}else{
		                echo '<li class="page-item "><a class="page-link" href="javascript:void(0);"><<</a></li>';
					}
					for ($i = 1; $i <= $nbr_de_page; $i++) {
						if ($i == $page)
							$active = "active";
						else
							$active = "";

						if ($page != $i)
							echo "<li class=\"page-item \"><a class=\"page-link\" href=\"?page=$i&recherch=$keyword&btn_search=''\">$i</a></li>";
						else
							echo "<li class=\"$active page-item \"><a class=\"page-link\">$i</a></li>";
					}
					if ($nbr_de_page > $page) {
						echo '<li class="page-item "><a class="page-link" href="?page=' . ($page + 1) . '&recherch='.$keyword.'&btn_search=\'\'">>></a></li>';
					}else{
		                echo '<li class="page-item "><a class="page-link" href="javascript:void(0);">>></a></li>';
					}

				?>
			</ul>
		
	<?php
				}

	?>
	</div>

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
					<form action="" method="POST">
						<input type="hidden" name="id_imgsup" id="showimg_id" value="">
						<h2 class="text-danger text-center">confirmer la supprition ?</h2>
						<h2 class="text-danger text-center">😕</h2>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn btn-danger" name="btn_supimg" type="submit">supprimer</button>
					</form>

				</div>
			</div>
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