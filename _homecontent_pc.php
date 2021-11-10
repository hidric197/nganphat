<!DOCTYPE html>
<html lang="vi">
<head>

<link rel="stylesheet" type="text/css" href="template/css/swiper-bundle.min.css">
<link rel="stylesheet" media="all" type="text/css" href="template/css/np.css">
<link rel="stylesheet" media="all" type="text/css" href="template/css/header-home.min.css">
<link rel="stylesheet" media="all" type="text/css" href="template/css/style-home.min.css">

<?php 
    include 'common_headermeta_pc.php';
?>

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

a.link_group:hover {
    color: #da251c;
}

</style>
</head>
<body id="homepage">

<?php  include 'common_top_ads.php'; ?>
	<!-- Header -->
<?php 
    include 'common_topmenu_pc_homepage.php';
?>

<div class="wrap" id="menu-container">
    <nav class="block button-home-nav ">
        <a id="icon_home" class="button-home-inner" href="<?=Common::$_HOME_PAGE?>">
        <i class="icon-home"></i><span class="title-menu-nav">Danh mục sản phẩm</span></a>
			
			<?php include 'common_topmenu_pc_menubox.php';?>	

		</nav>
</div>
	<div class="box-navi-top">
		<div class="wrap">
			<div class="box-navi-inner ">
				<span class="title-khuyen-mai">
                	<a href="#" title="Bấm vào đây để xem danh sách khuyến mại">Khuyến mại</a>
           	 	</span>

				<div class="rslides rslides1" id="rslides">
					<div style="margin-left: 20px">
    					<a href="#" class="promo-new-item">
        					<span class="title-navi-prom">
    							Mua hóa đơn trị giá trên 3 triệu sẽ được tặng quả 300k
    						</span>
						</a>
						<audio controls style="height:25px; width:25%; background:white; margin-bottom:-8px; margin-left: 30px">
                      		<source src="khuyenmai/khuyen-mai.mp3" type="audio/mpeg">
						</audio>
					</div>
				</div>
				<div class="tag-price-sale">
                	<a href="#" title="Giá rẻ hàng ngày">
                    <img class="lazy-img lazy-loaded" src="template/images/gia-re-moi-ngay.png" 
                    	data-src="template/images/gia-re-moi-ngay.png" alt="Giá rẻ hàng ngày"></a>
            	</div>
			</div>
		</div>
	</div>

	<section id="center-m">
		<div class="wrap">
			
			<?php include 'common_swiper_homepage_pc.php'; ?>
			
			<!--Tin ho tro duoi banner-->

			<div class="support-pad-home">
               <ul class="articles-pad">
               		<?php
                        $sql35 = "SELECT A.page_id, A.page_name, B.permalink, A.image_url, A.image_title FROM np_page A ";
                        $sql35 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
                        $sql35 .= " WHERE A.page_group_id = '4' AND B.delete_flag = '0'";
                        $sql35 .= " ORDER BY A.page_count_view DESC ";
                        $sql35 .= " LIMIT 3 ";
                    
                        $result35 = $conn->query($sql35);
                        if ($result35->num_rows > 0) {
                            while ($row35 = $result35->fetch_assoc()) {
                        ?>
                        	<li class="articles-pad-item">
                                <a title="<?=$row35['page_name']?>" href="<?=$row35['permalink']?>">
                                    <img class="articles-pad-img lazy-img lazy-loaded" width="90" height="68" 
                                    data-src="npad/<?=$row35['image_url']?>" src="npad/<?=$row35['image_url']?>" alt="<?=$row35['image_title']?>">
                                    <span class="articles-pad-title"><?=$row35['page_name']?></span>
                                </a>
                            </li>
                    	<?php
                            }
                        }
                      ?>                
               </ul>
           </div>

		</div>
		<div class="wrap">
			<div class="home-catalog">
				<?php include 'common_flashSale_pc.php';?>
				<?php include 'common_hotproduct_pc.php';?>
				<?php include 'common_suggestproduct_pc.php';?>
				
				<?php include '_homecontent_thietbivesinh_pc.php';?>
				<?php include '_homecontent_thietbidien_pc.php';?>
				<?php include '_homecontent_thietbinhabep_pc.php';?>
			</div>
			<?php include 'common_services.php';?>
			<?php include 'common_brands.php';?>
		</div>
	</section>

<?php include 'common_script_load_data_swipe.php';?>
	<!-- Footer -->
<?php include 'common_footer.php';?>
</body>
</html>