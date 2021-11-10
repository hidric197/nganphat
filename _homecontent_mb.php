<!DOCTYPE html>
<html lang="vi">
<head>
	<?php include 'common_headermeta_mb.php';?>

<link rel=stylesheet media=all type=text/css
	href="template/css/np_mb.css" />
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/header-home.min.css">
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/style-home.min.css">
	
</head>
<body id="homepage">

<?php  include 'common_top_ads.php'; ?>
	
	<?php  include 'common_topmenu_mb_homepage.php'; ?>

	<!-- ======================================================== -->

	<div class="box-navi-top" style="height: 15px">
<!-- 		<div class="wrap"> -->
<!-- 			<div class="box-navi-inner "> -->

<!-- 				<span class="title-khuyen-mai"> <a href="/khuyenmai.html" -->
<!-- 					title="Bấm vào đây để xem danh sách khuyến mại">Khuyến mại</a> -->
<!-- 				</span> -->

<!-- 				<ul class="rslides" id="rslides"> -->
<!-- 				</ul> -->

<!-- 				<div class="tag-price-sale"> -->
<!-- 					<a href="/khuyenmai/75/gia-re-hang-ngay.html"> <img -->
<!-- 						class="lazy-img" src="template/js/0.gif" -->
<!-- 						data-src="template/images/gia-re-moi-ngay.png" -->
<!-- 						alt="Giá rẻ mỗi ngày"></a> -->
<!-- 				</div> -->

<!-- 			</div> -->
<!-- 		</div> -->
	</div>

	<section id="center-m">
		<div class="wrap">
			<!-- ========================================================== -->
			
			<?php include 'common_swiper_homepage_mb.php';?>
			
			<!-- ========================================================== -->

		</div>

		<div class="wrap">

			<div class="home-catalog">
			
				<?php include 'common_flashSale_mb.php';?>

				<?php include 'common_hotproduct_mb.php';?>

				<?php include 'common_suggestproduct_mb.php';?>
				
    			<?php include '_homecontent_thietbivesinh_mb.php';?>
    			
    			<?php include '_homecontent_thietbidien_mb.php';?>
    			
    			<?php include '_homecontent_thietbinhabep_mb.php';?>
    			
    			<?php include 'common_brands_mb.php';?>
    			
    			<?php include 'common_services_mb.php';?>
			
			</div>
		</div>
	</section>

	<?php include 'common_script_load_data_swipe.php';?>
	
	<?php include 'common_footer_mb.php';?>
	
</body>
</html>
