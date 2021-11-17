<!DOCTYPE html>
<html lang="vi">
<head>
<?php
include 'common_headermeta_pc.php';
?>

<link rel="stylesheet" media="all" type="text/css"
	href="template/css/np.css">
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/header-home.min.css">
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/style-chuyenmuc.min.css">
<link rel="stylesheet" type="text/css"
	href="template/css/swiper-bundle.min.css">
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
<body id="catpage-m">

<?php  include 'common_top_ads.php'; ?>	

	<!-- Header -->
<?php include 'common_topmenu_pc_otherpage.php';?>

<style>
#center-m #_filters.filter-general-expanded, #center-m.active #_filters.filter-general-expanded
	{
	-webkit-overflow-scrolling: touch;
}

#catpagesub-m .body-left-box-inner-extra {
	-webkit-overflow-scrolling: touch;
}
</style>
	<section id="center-m">
		<div class="wrap">
			<div class="breadcrum-catalog">

				<style>
.has-chidren.hover.mobile .breadcrum-cat-menu {
	display: block;
	position: absolute;
	background-color: #fff;
	border: 1px solid #ddd;
	z-index: 99;
	left: 0;
}

.breadcrum-cat-item.home img {
	filter: grayscale(100%);
	opacity: .75;
}
</style>
		
		<?php
if ($home_table_name == Common::$_TABLE_NP_PROD_BRAND){
    include '_groupcontent_brand_slug.php';
} else if ($home_table_name == Common::$_TABLE_NP_PROD_TAG){
    include '_groupcontent_tag_slug.php';
} else if ($home_pmk == 'tim-kiem'){
    include '_groupcontent_search_slug.php';
} else if ($home_pmk == 'flash-sale'){
    include '_groupcontent_flashsale_slug.php';
} else if ($home_pmk == 'khuyen-mai'){
    include '_groupcontent_promotion_slug.php';
} else if ($home_level_group == 0) {
    include '_groupcontent1_slug.php';
} else if ($home_level_group == 1) {
    include '_groupcontent2_slug.php';
} else if ($home_level_group == 2) {
    include '_groupcontent3_slug.php';
} else if ($home_level_group == 3) {
    // include '_groupcontent4_slug.php';
} 
?>
		</div>
			<div class="center-body">
				<aside class="center-body-left" id="_filters">
				
				 	<?php 
				 	$filter_check = '1';
				 	if ($home_table_name != Common::$_TABLE_NP_PROD_BRAND 
				 	      && $home_table_name != Common::$_TABLE_NP_PROD_TAG 
				 	          && $home_pmk != 'tim-kiem'){
				 	  include 'common_slidebar_filter.php';
				 	}
				 	?>
				 	
					<?php 
					if ($filter_check == '0' 
					       && $home_table_name != Common::$_TABLE_NP_PROD_BRAND) {
					   include 'common_slidebar_brand.php';
					}
					?>

					<?php include 'common_slidebar_price.php';?>

					<div class="body-left-box filter-manu filter-general">
						<div class="body-left-title-filter"></div>
						<div class="body-left-box-sub-under"></div>
					</div>
				</aside>
				<section class="center-body-right">
					<!-- Slide ảnh -->
					<?php include 'common_swiper_group_123.php';?>
					
					<!-- Sản phẩm bán chạy nhất -->
					<div class="wrap-catalog-main">
						<div id="catalogSub-brand" class="box-catalog-main brand">
							<?php include '_groupcontent_bestsale.php';?>
						</div>
					</div>
					
					<!-- Group con -->
					<div class="wrap-catalog-main">
					<?php 
					if ($home_table_name != Common::$_TABLE_NP_PROD_BRAND 
					       && $home_table_name != Common::$_TABLE_NP_PROD_TAG
					           && $home_pmk != 'tim-kiem' && $home_pmk != 'flash-sale' && $home_pmk != 'khuyen-mai') {
					
					?>
						<ul
							class="list-catalog-main">
							<?php
							if ($home_table_name == Common::$_TABLE_NP_PROD_GROUP) {
    							$sqlGroup = "SELECT B.permalink, A.group_id, A.group_name, A.image_title, A.image_url ";
    							$sqlGroup .= " FROM np_prod_group A ";
    							$sqlGroup .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
    							$sqlGroup .= " WHERE A.delete_flag = '0' ";
    							
                        		if ($home_pmk == Common::$_GROUP_THIET_BI_VE_SINH) {
                        		    $sqlGroup .= " AND A.group_type = '" .Common::$_GROUP_THIET_BI_VE_SINH_TYPE. "' AND A.group_level = '1' ";
                        		} else if($home_pmk == Common::$_GROUP_THIET_BI_NHA_BEP) {
                        		    $sqlGroup .= " AND A.group_type = '" .Common::$_GROUP_THIET_BI_NHA_BEP_TYPE. "' AND A.group_level = '1' ";
                        		} else if($home_pmk == Common::$_GROUP_THIET_BI_DIEN){
                        		    $sqlGroup .= " AND A.group_type = '" .Common::$_GROUP_THIET_BI_DIEN_TYPE. "' AND A.group_level = '1' ";
                        		} else if ($home_table_name == Common::$_TABLE_NP_PROD_GROUP) {
                        		    $sqlGroup .= " AND A.group_level_up = '" . $home_group_id . "'";
                        		}
							} else if ($home_table_name == Common::$_TABLE_NP_PROD_FILTER) {
							    $sqlGroup = "SELECT B.permalink AS permalink, A.prod_filter_id , A.prod_filter_name AS group_name, A.image_title, A.image_url ";
							    $sqlGroup .= " FROM np_prod_filter A ";
							    $sqlGroup .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
							    $sqlGroup .= " WHERE A.delete_flag = '0' ";
							    $sqlGroup .= " AND filter_id_up = '$home_prod_filter_id' ";
							}
                    		
                    		$result1 = $conn->query($sqlGroup);
                    		if ($result1->num_rows > 0) {
                    		    while ($row1 = $result1->fetch_assoc()) {
                    	?>
							
							<li class="catalog-main-item"><a href="<?=$row1['permalink']?>"
								title="<?=$row1['group_name']?>">
								<div class="icon-cat-main-thumb">
									<span><img class="lazy-img lazy-loaded" alt="<?=$row1['image_title']?>"
											data-src="npad/<?=$row1['image_url']?>"
											src="npad/<?=$row1['image_url']?>">
									</span>
								</div>
								<div class="name-cat-main"><?=$row1['group_name']?>
								</div>
									</a>
							</li>
						<?php 
                    		    }
                    		}
						?>
						</ul>
						<?php 
					   }
						?>
<!-- 						<div class="view-more-page"> -->
<!-- 							<a href="#">Xem thêm 14 chuyên mục</a> -->
<!-- 						</div> -->
					</div>
					
					
					<!-- ================================= -->
        				<?php 
                		$sql = "SELECT B.permalink AS prd_permalink, B.data_table";
                		$sql .= ", A.product_id, A.product_name, A.product_code ";
                		$sql .= " , A.product_old_price, A.product_down_price, A.product_sell_price ";
                		$sql .= " , A.brand_id, C.brand_name ";
                		$sql .= " , D.permalink AS brand_permalink ";
                		$sql .= " , E.image_title, E.image_url ";
                		$sql .= " , F.one_star, F.two_star, F.three_star, F.four_star, F.five_star ";
                		$sql .= " FROM np_product A ";
                		$sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
                		$sql .= " LEFT OUTER JOIN np_prod_brand C ON A.brand_id = C.brand_id ";
                		$sql .= " LEFT OUTER JOIN np_permalink D ON C.data_id = D.data_id ";
                		$sql .= " INNER JOIN np_prod_image E ON A.product_id = E.product_id AND E.image_type = '1' ";
                		$sql .= " LEFT OUTER JOIN np_prod_vote F ON A.product_id = F.product_id ";

                		// Chọn Brand
                		if ($home_table_name == Common::$_TABLE_NP_PROD_BRAND) {
                		    $sql .= " WHERE  A.brand_id = '$listBrandId' ";
                		} else
                		    // chọn Tag
                		    if ($home_table_name == Common::$_TABLE_NP_PROD_TAG) {
                		        $sql .= " INNER JOIN tag_product Z ON A.product_id = Z.product_id ";
                		        $sql .= " WHERE  Z.tag_id = '$listTagId' ";
            		    } else 
                		    // chọn Group
                		    if ($home_table_name == Common::$_TABLE_NP_PROD_GROUP) {
                		        if ($home_level_group == '2') {
                		            $sql .= " WHERE  A.group_id = '$home_group_id' ";
                		        } else if ($home_level_group == '1') {
                		            $sql .= " INNER JOIN np_prod_group X ON A.group_id = X.group_id ";
                		            $sql .= " WHERE  X.group_level_up = '$home_group_id' ";
                		        } else if ($home_level_group == '0') {
                		            $sql .= " INNER JOIN np_prod_group X ON A.group_id = X.group_id ";
                		            $sql .= " WHERE  X.group_type = '$home_group_type' ";
                		        }
                		} else 
                		    // chon Filter
                		    if ($home_table_name == Common::$_TABLE_NP_PROD_FILTER) {
                		            $sql .= " INNER JOIN np_prod_filter X ON A.	filter_id = X.	prod_filter_id ";
                		            $sql .= " WHERE  X.prod_filter_id  = '$home_prod_filter_id' ";
                		            
                		} else 
                		    // Search
                		    if ($home_pmk == 'tim-kiem') {
                		        $sql .= " WHERE  A.product_name LIKE '%". $name_group. "%' ";
            		    } else
            		        // Search
            		        if ($home_pmk == 'flash-sale') {
            		            $sql .= " WHERE  A.	product_flash_sale = '1' ";
            		   } else if ($home_pmk == 'khuyen-mai'){
            		   		$sql .= " WHERE  A.	product_down_price > 0 ";
            		   }
        		        
        		        // click Filter brand checkbook
        		        if (isset($_GET['filter_brand']) && !empty($_GET['filter_brand'])) {
        		            $filter_brand = $_GET['filter_brand'];
        		            $sql .= " AND A.brand_id = '" .$filter_brand. "' ";
        		        }
                		
                		// click filter price checkbook
                		if (isset($_GET['filter_price']) && !empty($_GET['filter_price'])) {
                		    $filter_price = $_GET['filter_price'];
                		    if ($filter_price == '01') {
                		        $sql .= " AND A.product_sell_price < 100000 ";
                		    } else if ($filter_price == '02') {
                		        $sql .= " AND A.product_sell_price BETWEEN 100000 AND 500000";
                		    } else if ($filter_price == '03') {
                		        $sql .= " AND A.product_sell_price BETWEEN 500000 AND 1000000";
                		    } else if ($filter_price == '04') {
                		        $sql .= " AND A.product_sell_price BETWEEN 1000000 AND 2000000";
                		    } else if ($filter_price == '05') {
                		        $sql .= " AND A.product_sell_price BETWEEN 2000000 AND 5000000";
                		    } else if ($filter_price == '06') {
                		        $sql .= " AND A.product_sell_price BETWEEN 5000000 AND 10000000 ";
                		    } else if ($filter_price == '07') {
                		        $sql .= " AND A.product_sell_price BETWEEN 10000000 AND 20000000";
                		    } else if ($filter_price == '08') {
                		        $sql .= " AND A.product_sell_price >= 20000000 ";
                		    }
                		}
                		
                		$sql .= " AND  A.delete_flag = '0' ";

                		$sort_select = '';
                		// click sort
                		if (isset($_POST['sort-select']) && !empty($_POST['sort-select'])) {
                		    $sort_select = $_POST['sort-select'];
                		    if ($sort_select == '01') {
                		        $sql .= " ORDER BY A.product_sell_price ";
                		    } else  if ($sort_select == '02') {
                		        $sql .= " ORDER BY A.product_sell_price DESC ";
                		    } else  if ($sort_select == '03') {
                		        $sql .= " ORDER BY A.product_down_price DESC ";
                		    } else  if ($sort_select == '04') {
                		        $sql .= " ORDER BY A.product_count_view DESC ";
                		    }
                		}

                		// Cac san pham noi bat cua tung nhom
                		if ($home_pmk == Common::$_GROUP_THIET_BI_VE_SINH_NOI_BAT
                		    || $home_pmk == Common::$_GROUP_THIET_BI_NHA_BEP_NOI_BAT
                		      || $home_pmk == Common::$_GROUP_THIET_BI_DIEN_NOI_BAT) {
                		    $sql .= " ORDER BY A.product_count_view DESC ";
                		}                		
                		
                		// =======================paging ============================
                		// lay so so luong ban ghi
                		$resultCount = $conn->query($sql);
                		$totalRecord = $resultCount->num_rows;
                		$totalPage =  intdiv($totalRecord, Common::$_PAGING_NUMBER);
                		if ($totalRecord - ($totalPage * Common::$_PAGING_NUMBER) > 0) {
                		    $totalPage ++;
                		}
                		$currentPage = 1;
                		if (isset($_POST['page_display']) && !empty($_POST['page_display'])) {
                		    $currentPage = $_POST['page_display'];
                		    
                		    if ($currentPage < 1) {
                		        $currentPage = 1;
                		    } 
                		    if ($currentPage > $totalPage) {
                		        $currentPage = $totalPage;
                		    }
                		}
                		$startR = ($currentPage - 1) * Common::$_PAGING_NUMBER;
                        
                		$sql .= " Limit " .$startR. ", " .Common::$_PAGING_NUMBER. " ";
                        
                        // =======================paging ============================
                        
                		$result10 = $conn->query($sql);
                		if ($result10->num_rows > 0) {

                ?>
					<div class="wrap-product-catagsub" id="catalog">
						<div class="description-filter">
							<div class="title-cat-xeo-brand">
								<h1 class="cat-xeo-desc"><?=$name_group?></h1>
								<span>&nbsp;</span><span class="cat-xeo-number">(<?=$totalRecord?> sản phẩm)</span>
							</div>
						</div>
						<div class="bar-sort-product">
							<div class="bar-sort-left">
							<form action="" method="post" name="form_sort" id="form_sort">
								<div class="bar-sort-left-title block">Sắp xếp theo:</div>
								<div class="bar-sort-left-box block">
									<ul class="list-sort" id="sort-select">
										<li class="sort-item" onclick="submitFormSort();">
    										<input type="radio" value="01"
    											id="sort-r4" name="sort-select"> 
    										<label for="sort-r4" <?php if($sort_select == "01") echo 'style="color:#da251c; font-weight: bold;"';?> > 
    											<span></span>
    												Giá tăng dần
    										</label>
    									</li>
										<li class="sort-item"  onclick="submitFormSort();">
    										<input type="radio" value="02"
    											id="sort-r5" name="sort-select"> 
    											<label for="sort-r5" <?php if($sort_select == "02") echo 'style="color:#da251c; font-weight: bold;"';?> > 
    												<span></span>
    												Giá giảm dần
    										</label>
    									</li>
										<li class="sort-item"  onclick="submitFormSort();">
											<input type="radio" value="03"
    											id="sort-r6" name="sort-select"> 
    											<label for="sort-r6" <?php if($sort_select == "03") echo 'style="color:#da251c; font-weight: bold;"';?> > 
    												<span></span>
    												Sản phẩm giảm giá
											</label>
										</li>
										<li class="sort-item last"  onclick="submitFormSort();">
											<input type="radio" value="04"
    											id="sort-r3" name="sort-select"> 
    												<label for="sort-r3" <?php if($sort_select == "04") echo 'style="color:#da251c; font-weight: bold;"';?>> 
    													<span></span>
    												Sản phẩm hot
											</label>
										</li>

									</ul>
								</div>
								</form>
							</div>
						</div>
						<script language="JavaScript" type="text/javascript">
							function submitFormSort() {
								document.getElementById("form_sort").submit();
							}	
						</script>

						<div class="result-filter"></div>
						<section id="_products">

							<div class="wrap-list-product-catagsub">
								<div class="list-product-highlight">
									<form action="mua-hang" name="list_product_form" id="list_product_form" method="post">
									<ul class="product-highlight-wrap">
										<?php 
										while ($row10 = $result10->fetch_assoc()) {
										    $sum_vote = 0;
										    $vote = 0;
										    $sum_vote = $row10['one_star'] + $row10['two_star'] + $row10['three_star'] + $row10['four_star'] + $row10['five_star'];
										    if ($sum_vote != 0){
										        $vote = ($row10['one_star'] * 1 + $row10['two_star'] * 2 + $row10['three_star'] * 3 + $row10['four_star'] * 4 + $row10['five_star'] * 5 )
										        / $sum_vote;
										    }
										
										?>
										<li class="product-highlight-item prod-item" data-pid="10195">
											<?php 
											 if ($row10['product_down_price'] != '0') {
                            				?>
											<div
												class="prod-hl-discount">
												<span>-<?=$row10['product_down_price']?>%</span>
											</div>
											<?php 
											 }
											?>
											<div class="prod-hl-thumb">
												<a href="<?=$row10['prd_permalink']?>"
													title="<?=$row10['product_name']?>"><img
													src="npad/<?=$row10['image_url']?>" width="200"
													height="200" class="thumb-list is-thumb"></a>
											</div>
											<div class="prod-hl-name">
												<a title="<?=$row10['product_name']?>"
													href="<?=$row10['prd_permalink']?>">
                            						<?=$row10['product_name']?>
                            					</a>
											</div>
											<div class="prod-hl-brand">
												<a href="<?=$row10['brand_permalink']?>"><?=$row10['brand_name']?></a>
											</div>
											<?php 
    											if ($home_pmk != 'flash-sale')
    											{
											?>
    											<div class="product-rate">
    												<span class="rating-box" title="<?=$vote?> sao">
                                						<?php 
                                						  for ($i = 1; $i < 6; $i++) {
                                						      if ($i < $vote) {
                                						?>
                                						<span class="fa fa-star rated"></span>
                                							<?php 
                                						      } else {
                                							?>
                                						<span class="fa fa-star"></span>
                                						<?php 
                                						      }
                                						  }
                                						?>
                                					</span> <span class="amount-rate"><?=$sum_vote?> đánh giá</span>
    											</div>
    											<div class="product-price list-product-price">
    												<span class="product-price-meta"><?=Common::convertMoney($row10['product_sell_price'])?></span>
    												<span class="product-price-old"><?=Common::convertMoney($row10['product_old_price'])?></span>
    											</div>
    											<div class="prod-hl-buynow">
    												<a class="prod-hl-buy-txt" onclick="submitFormOrderProduct('<?=$row10['product_id']?>');">Mua ngay</a>
    											</div>
											<?php 
    											} else {
											?>

												<div class="countdown-product  end-fs">
                        						<div class="cdown-pro-left">
                        							<div class="fs-price">
                        								<span class="fs-price-main"><?=Common::convertMoney($row10['product_sell_price'])?></span>
                        								<div class="sale-fs">
                        									<span class="percent-fs">-<?$row10['product_down_price']?>%</span><span
                        										class="old-price-fs"><?=Common::convertMoney($row10['product_old_price'])?></span>
                        								</div>
                        							</div>
                        						</div>
                        						<?php 
                        						    $mesg = 'Còn hàng';
                        						    $today = time();
                        						    $timeSale = strtotime($row10['product_flash_sale_time']);
                        						    
                        						    $downday = round(($timeSale - $today)/86400);
                        						    
                        						    if ($downday < 0) {
                        						        $downday = 0;
                        						        $downday = 0;
                        						        $mesg = 'Hết hàng';
                        						    } else if (($downday * 86400) > ($timeSale - $today)) {
                        						        $downday --;
                        						    }
                        						?>
                        						<div class="cdown-pro-right">
                        							<div class="flashsale-box">
                        								<div class="time-box-left">
                        									<span class="timeleft">Kết thúc sau</span>
                        								</div>
                        								<div class="time-flash running">
                        									<div class="time-box-first">
                        										<span class="ngay days"> <?=$downday ?> </span> ngày
                        									</div>
                        <!-- 									<div class="time-box-item"> -->
                        <!-- 										<span class="gio hours">37</span> -->
                        <!-- 									</div> -->
                        <!-- 									<div class="time-box-item"> -->
                        <!-- 										<span class="phut minutes">24</span> -->
                        <!-- 									</div> -->
                        <!-- 									<div class="time-box-item"> -->
                        <!-- 										<span class="giay seconds">07</span> -->
                        <!-- 									</div> -->
                        								</div>
                        								<div class="time-box-left">
                        									<span class="seconds"><?=$mesg?></span>
                        								</div>
                        							</div>
                        						</div>
                        					</div>
                        																
											<?php 
    											}
											?>
										</li>
										<?php 
										}
										?>

									</ul>
									<input type="hidden" name="checkout_product_id" id="checkout_product_id" value="">
									<input type="hidden" id="txtQty" name="txtQty" value="1" class="form-among">
									</form>
									
									<script language="JavaScript" type="text/javascript">
                                    	function submitFormOrderProduct(prodId) {
                                    		document.getElementById("checkout_product_id").value = prodId;
                                    		document.getElementById("list_product_form").submit();
                                    	}	
                                    </script>
									
								</div>
								
    							<?php 
    							if ($totalPage > 1) {
    							
    							?>
								<form action="" method="post" name="paging_form" id="paging_form">
								<div class="box-paging">
									<a onclick="submitFormPaging('1');" title="Trang 1 / Tổng số <?=$totalPage?> trang" class="pagination-item first">
										<i class="fa fa-angle-left fa-lg"></i>Trang đầu</a>
									<a onclick="submitFormPaging('<?=($currentPage - 1)?>');" title="Trang <?=($currentPage - 1)?> / Tổng số <?=$totalPage?> trang" class="pagination-item first">
										<i class="fa fa-angle-left fa-lg"></i>Trang trước</a>
									<?php 
									$numberPage = $totalPage;
									if ($totalPage > Common::$_PAGING_NUMBER_VIEW) {
									    $numberPage = Common::$_PAGING_NUMBER_VIEW;
									}
									
									$startFor = 1;
									if ($currentPage >= Common::$_PAGING_NUMBER_VIEW) {
									    $startFor = $currentPage - 4;
									    $numberPage = $currentPage + 5;
									    if ($numberPage > $totalPage) {
									        $numberPage = $totalPage;
									    }
									}
									
									if ($startFor > 1) {
									    echo '...';
									}
									
									for ($i = $startFor; $i <= $numberPage; $i++) {
									?>
									<a onclick="submitFormPaging('<?=$i?>');" title="Trang <?=$i?> / Tổng số <?=$totalPage?> trang" class="pagination-item <?php if($currentPage == $i) echo "active"; ?>"><?=$i?></a>
									<?php 
									   }
									   
									   if ($totalPage > Common::$_PAGING_NUMBER_VIEW && $numberPage < $totalPage) {
									       echo '...';
									   }
									?>

									<a onclick="submitFormPaging('<?=($currentPage + 1)?>');" title="Trang <?=($currentPage + 1)?> / Tổng số <?=$totalPage?> trang" class="pagination-item">Trang sau 
										<i class="fa fa-angle-right fa-lg"></i></a>
									<a onclick="submitFormPaging('<?=$totalPage?>');" title="Trang <?=$totalPage?> / Tổng số <?=$totalPage?> trang" class="pagination-item">Trang cuối 
										<i class="fa fa-angle-right fa-lg"></i></a>
    								<input type="hidden" name="page_display" id="page_display" value="">
    								</div>
    								</form>
    								<script language="JavaScript" type="text/javascript">
                                    	function submitFormPaging(pgNum) {
                                    		document.getElementById("page_display").value = pgNum;
                                    		document.getElementById("paging_form").submit();
                                    	}	
                                    </script>
                                   <?php 
							         }
                                   ?>
    							</div>
    						</section>
        					</div>
        				<div>
        			</div>
    				<?php
                    }
                    ?>
                    <div class="page-catalog-main">
						<div id="catalogSub-brand" class="box-catalog-main brand">
							<?php include '_productcontent_viewed.php';?>
						</div>
						<div id="catalogSub-brand" class="box-catalog-main brand">
							<?php include 'common_brands.php';?>
						</div>
						<div id="catalogSub-support" class="box-catalog-main support">
							<?php include 'common_services.php';?>
						</div>
						
					</div>
				</section>
			</div>
		</div>
	</section>

	<!-- Footer -->
<?php include 'common_footer.php';?>
</body>
</html>