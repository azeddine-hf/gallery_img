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
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<style>
    body{
	margin:0;
	padding:0;
}
/* .container{
	width:90%
	margin:10px auto;
} */
.portfolio-menu{
	text-align:center;
}
.portfolio-menu ul li{
	display:inline-block;
	margin:0;
	list-style:none;
	padding:10px 15px;
	cursor:pointer;
	-webkit-transition:all 05s ease;
	-moz-transition:all 05s ease;
	-ms-transition:all 05s ease;
	-o-transition:all 05s ease;
	transition:all .5s ease;
}


.portfolio-item .item{
	/*width:303px;*/
	float:left;
	margin-bottom:10px;
}

</style>
</head>

<body>
<div class="container">
         <div class="row">
            <div class="col-lg-12 text-center my-2">
                <h4>Isotope filter magical layouts with Bootstrap 4</h4>
            </div>
         </div>
         <div class="portfolio-menu mt-2 mb-4">
            <ul>
               <li class="btn btn-outline-dark active" data-filter="*">All</li>
            </ul>
         </div>
         <div class="portfolio-item row">
	<?php
	$database = new Connection();
     $db = $database->openConnection();
	$stmt = $db->prepare('select * from images');
	$stmt->execute();
	$imagelist = $stmt->fetchAll();

	foreach($imagelist as $image) {
	?>
		<div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
               <a href="<?php echo $image['image']?>" class="fancylight popup-btn" data-fancybox-group="light"> 
               <img class="img-fluid" src="<?php echo $image['image'] ?>" title="<?=$image['name'] ?>" width='200' height='200'>
               </a><a class="btn btn-info text-white mt-1">Les avis</a><a class="btn text-danger"><i class="fa fa-trash"></i></a>
            </div>
	
	<?php
	}
	?>
 </div>
</div>

<script>
            // $('.portfolio-item').isotope({
        //  	itemSelector: '.item',
        //  	layoutMode: 'fitRows'
        //  });
        $('.portfolio-menu ul li').click(function(){
         	$('.portfolio-menu ul li').removeClass('active');
         	$(this).addClass('active');
         	
         	var selector = $(this).attr('data-filter');
         	$('.portfolio-item').isotope({
         		filter:selector
         	});
         	return  false;
         });
         $(document).ready(function() {
         var popup_btn = $('.popup-btn');
         popup_btn.magnificPopup({
         type : 'image',
         gallery : {
         	enabled : true
         }
         });
         });
</script>
</body>

</html>
