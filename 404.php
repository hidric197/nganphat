<!DOCTYPE html>
<html lang="vi">
<head>
<?php
    include 'npad/lib/gmail/Mail.php';
    include 'common_headermeta_pc.php';
?>


<link rel="stylesheet" media="all" type="text/css"
	href="template/css/header.min.css">
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/style-chuyenmuc.min.css">
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/np.css">
<!-- <link rel="stylesheet" media="all" type="text/css" href="template/css/tranghotro.min.css"> -->
<!-- <link rel="stylesheet" media="all" type="text/css" href="template/css/admin-style.min.css"> -->
<!-- <link rel="stylesheet" media="all" type="text/css" href="template/css/binhluan-hotro.min.css"> -->
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/checkout-beta.css">

<style>
.top-banner ~ #menu-container .block.button-home-nav, .top-banner ~
	.box-navi-top .box-navi-inner {
	top: 155px;
}

#searchpage>.top-banner ~ #menu-container .block.button-home-nav,
	#searchpage .top-banner ~ .box-navi-top .box-navi-inner {
	top: 137px;
}

.top-banner ~ #header-m {
	margin-top: 60px;
}

#header-m.active.show .box-header {
	position: fixed !important;
}

.top-banner {
	position: absolute;
	top: 0;
	width: 100%;
	text-align: center;
	overflow: hidden;
	height: 60px;
}

.top-banner ~ #header-m .pos-relative {
	position: relative !important;
}

.top-banner a {
	display: block;
	height: 100%;
}

.top-banner img {
	max-width: 1236px;
	margin: auto;
	height: 100%;
}

#adsbgright, #adsbgleft {
	top: 125px;
	-webkit-transition: all .3s ease-in-out;
	-moz-transition: all .3s ease-in-out;
	-ms-transition: all .3s ease-in-out;
	-o-transition: all .3s ease-in-out;
	transition: all .3s ease-in-out;
	z-index: 98;
}

#adsbgleft {
	left: -3px;
}

#adsbgright {
	right: -3px;
}

#header-m.pos-fixed ~ #adsbgright, #header-m.pos-fixed ~ #adsbgleft {
	top: 75px;
}

#header-m.active ~ #adsbgright, #header-m.active ~ #adsbgleft {
	top: 50px;
}

.top-banner ~ #adsbgright, .top-banner ~ #adsbgleft {
	top: 135px;
}
</style>
</head>
<body id="catpagesub-m">

<?php  include 'common_top_ads.php'; ?>	

	<!-- Header -->
<?php include 'common_topmenu_pc_otherpage.php';?>


<section id="center-m" data-step="0">
	<div class="wrap" id="checkout-info">
		<div class="wrap-checkout step1" align="center">
			<br>
			<br>
			<h2>Rất tiếc nội dung này không tồn tại.</h2>
			<br>
			<br>
		</div>
		<!--Phan hien thi San pham da xem-->
	<?php include '_productcontent_viewed.php';?>
	</div>
</section>

    
	<!-- Footer -->
<?php include 'common_footer.php';?>

</body>
</html>