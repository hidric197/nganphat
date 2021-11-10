<!DOCTYPE html>
<html lang="vi">
<head>
<?php
include 'common_headermeta_pc.php';
?>

<link rel="stylesheet" media="all" type="text/css"
	href="template/css/np.css">
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/header.min.css">
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/css_hotro.css">

<link type="text/css" rel="stylesheet"
	href="template/css/details-theme.css">

<style>
#_filters ::-webkit-scrollbar {
	width: 10px;
	margin-right: 5px
}

#_filters ::-webkit-scrollbar-track {
	background: #fafafa;
	border: 1px solid #ddd;
	border-radius: 5px
}

#_filters ::-webkit-scrollbar-thumb {
	border-radius: 5px;
	background: #ddd;
	border: 1px solid #ddd
}

#_filters ::-webkit-scrollbar-thumb:active {
	background: #ccc
}

.qrcode-app>img.hover {
	max-width: unset;
	max-height: unset;
	width: 150px;
	height: 150px;
	padding: 10px;
	background: #fff;
	box-shadow: 0 0 5px rgba(0, 0, 0, .5);
	position: absolute;
	bottom: 0;
	left: 0;
	z-index: 99
}

@media ( max-width : 450px) {
	.meta-ads {
		float: none !important;
		margin: 10px auto;
	}
}
</style>

<style type="text/css">
._ilcss0_ {
	text-align: left;
}

._ilcss1_ {
	background: #dbedf9;
	border: 1px solid #c7e4f4;
	border-radius: 4px;
	padding: 5px;
	margin-top: 5px;
}

._ilcss2_ {
	text-align: center;
	font-size: 16px;
}

._ilcss3_ {
	text-align: center;
}

._ilcss6_ {
	border: solid 1px #ccc;
}
</style>
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

button.btn-send-content {
	width: 150px;
	height: 37px;
	margin: auto;
	background-color: #0071c4;
	color: #fff !important;
	text-align: center;
	line-height: 32px;
	font-size: 14.5px;
	border-radius: 3px;
	display: block
}
</style>
</head>
<body id="hotro">


<?php  include 'common_top_ads.php'; ?>	

	<!-- Header -->
<?php include 'common_topmenu_pc_otherpage.php';?>


<?php
$footer_display = '0';
$sql999 = 'SELECT landing_page_content, footer_display FROM  np_landing_page WHERE data_id = ' . $dataId;
$result999 = $conn->query($sql999);
if ($result999->num_rows > 0) {
    while ($row999 = $result999->fetch_assoc()) {
        $footer_display = $row999['footer_display'];
        echo $row999['landing_page_content'];
    }
}
?>

<!-- Footer -->
<?php 
if ($footer_display == '0') {
    include 'common_footer.php';
}
?>
</body>
</html>