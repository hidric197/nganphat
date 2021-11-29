<!DOCTYPE html>
<html lang="vi">
<head>

<?php include 'common_headermeta_mb.php';?>

<link rel=stylesheet media=all type=text/css
	href="template/css/np_mb.css" />
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/header-home.min.css">
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/style-chuyenmuc.min.css">

</head>
<body id="catpagesub-m">
<!-- ============================================= -->
	<?php  include 'common_top_ads.php'; ?>
	
	<?php  include 'common_topmenu_mb_homepage.php'; ?>
<!-- ============================================= -->	
<style>
#center-m #_filters.filter-general-expanded, #center-m.active #_filters.filter-general-expanded
	{
	-webkit-overflow-scrolling: touch;
}

#catpagesub-m .body-left-box-inner-extra {
	-webkit-overflow-scrolling: touch;
}
</style>
	<section id="center-m" class="container">
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

				<?php include '_groupcontent_mb_slug.php';?>
<!-- 
				<div class="bar-sort-right">
					<a href="https://meta.vn/may-pha-ca-phe-c581" title="Lưới"
						type="button" class="sort-view grid active"></a> <a
						href="https://meta.vn/may-pha-ca-phe-c581?view=list"
						title="Danh sách" type="button" class="sort-view list "></a>
				</div>
 -->
			</div>
			<div class="center-body">
				<aside class="center-body-left" id="_filters">
					<div class="body-left-box filter-brand">
						<div class="body-left-title-filter">
							Thương hiệu<span class="arrow-icon-filter"></span>
						</div>
						<br>
						<form action="" method="post" name="form_filter_brand" id="form_filter_brand">
							<?php 
								$filter_brand = '';
								if (isset($_GET['filter_brand']) && !empty($_GET['filter_brand'])) {
								    $filter_brand = $_GET['filter_brand'];
								}

								$filter_price = '';
								if (isset($_GET['filter_price']) && !empty($_GET['filter_price'])) {
								    $filter_price = $_GET['filter_price'];
								}
								?>
    						<div class="body-left-box-inner">
    							<ul class="list-filter list-brand-check ls-brand-check" style="">
    
    								<?php 
                                		$sqlBrand = "SELECT A.brand_id, A.brand_name FROM np_prod_brand A ";
                                   		$sqlBrand .= " WHERE A.delete_flag = '0' ";
                                   		
                                    	$resultBrand = $conn->query($sqlBrand);
                                		if ($resultBrand->num_rows > 0) {
                                		    while ($rowBrand = $resultBrand->fetch_assoc()) {
                            		?>
    								<li class="filter-item">
    									<label class="select-filter-item" for="chk_manf_<?=$rowBrand['brand_id']?>" onclick="submitFormFilterBrand('<?=$rowBrand['brand_id']?>', <?="chk_manf_".$rowBrand['brand_id']?>);"> 
    										<input class="chk-manf-select" id="chk_manf_<?=$rowBrand['brand_id']?>" type="checkbox" data-m-alias="<?=$rowBrand['brand_name']?>" value="" <?php if($filter_brand == $rowBrand['brand_id']) echo "checked='checked'"; ?>> 
    										<span title="<?=$rowBrand['brand_name']?>" class="filter-check"></span>
    										<span title="<?=$rowBrand['brand_name']?>" class="filter-link"><?=$rowBrand['brand_name']?></span>
    									</label>
    								</li>
    								<?php 
                                		    }
                                		}
    								?>
    								
    							</ul>
    							<div class="tab-filter-close">
    								<a href="#"><i class="fa fa-times"></i>Đóng</a>
    								<!-- <input type="hidden" name="filter_brand" id="filter_brand"> -->
    							</div>
    						</div>
						</form>
						<script language="JavaScript" type="text/javascript">
                        	function submitFormFilterBrand(brandId, dom) {
								const params = new URLSearchParams(window.location.search)
								let url = dom.checked ? ("?filter_brand=" + brandId) : "?"
								let filter_brand = dom.checked ? "filter_brand=" + brandId : ''
								if (params.has('filter_price')) {
									url = (filter_brand ? "?" + filter_brand + "&": "?") + "filter_price=" + params.get('filter_price')
								}
								location.href = url
								// document.getElementById("form_filter_brand").submit();
							}	
                        </script>
					</div>
					<div class="body-left-box filter-price">
						<div class="body-left-title-filter">
							Giá<span class="arrow-icon-filter"></span>
						</div>
						<div class="body-left-box-inner">
							<form action="" method="post" name="form_sort" id="form_sort">
    							<div class="sort-by-price">
    								<div class="sort-by-price-title">Sắp xếp theo</div>
    								<ul class="list-sort">
    									<li class="sort-item" onclick="submitFormSort();">
    										<input type="radio" value="01"
    											id="sort-r4" name="sort-select"> <label for="sort-r4"> <span></span>
    												Giá tăng dần
    										</label>
    									</li>
										<li class="sort-item"  onclick="submitFormSort();">
    										<input type="radio" value="02"
    											id="sort-r5" name="sort-select"> <label for="sort-r5"> <span></span>
    												Giá giảm dần
    										</label>
    									</li>
										<li class="sort-item"  onclick="submitFormSort();">
											<input type="radio" value="03"
    											id="sort-r6" name="sort-select"> <label for="sort-r6"> <span></span>
    												Sản phẩm giảm giá
											</label>
										</li>
										<li class="sort-item last"  onclick="submitFormSort();">
											<input type="radio" value="04"
    											id="sort-r3" name="sort-select"> <label for="sort-r3"> <span></span>
    												Sản phẩm hot
											</label>
										</li>
    								</ul>
    							</div>
							</form>
							<script language="JavaScript" type="text/javascript">
    							function submitFormSort() {
    								document.getElementById("form_sort").submit();
    							}	
    						</script>
							<div class="sort-by-price-title">Chọn khoảng giá</div>

							<ul class="list-filter" style="">
							<form action="" method="get" name="form_filter_price" id="form_filter_price">
								<li class="filter-item" title="Dưới 3 triệu">
                    				<label for="filter_price_1" class="select-filter-item" onclick="submitFormFilterPrice('01', 'filter_price_1');">
                    					<input class="chk-price-select" id="filter_price_1" type="checkbox" name="filter_price_1" value="01" <?php if($filter_price == '01') echo "checked='checked'"; ?>>
                    					<span title="Dưới 3 triệu" class="price-checker-link filter-check"></span>
                    					<span class="filter-link">Dưới 3 triệu
                    					</span>
                    				</label>
                    			</li>

								<li class="filter-item" title="Từ 3 - 5 triệu">
                    				<label for="filter_price_2" class="select-filter-item" onclick="submitFormFilterPrice('02', 'filter_price_2');">
                    					<input class="chk-price-select" id="filter_price_2" type="checkbox" name="filter_price_2" value="02" <?php if($filter_price == '02') echo "checked='checked'"; ?>>
                    					<span title="Từ 3 - 5 triệu" class="price-checker-link filter-check"></span>
                    					<span class="filter-link">Từ 3 - 5 triệu
                    					</span>
                    				</label>
                    			</li>
                    			<li class="filter-item" title="Từ 5 - 10 triệu">
                    				<label for="filter_price_3" class="select-filter-item" onclick="submitFormFilterPrice('03', 'filter_price_3');">
                    					<input class="chk-price-select" id="filter_price_3" type="checkbox" name="filter_price_3" value="03" <?php if($filter_price == '03') echo "checked='checked'"; ?>>
                    					<span title="Từ 5 - 10 triệu" class="price-checker-link filter-check"></span>
                    					<span class="filter-link">Từ 5 - 10 triệu
                    					</span>
                    				</label>
                    			</li>
                    			<li class="filter-item" title="Từ 10 - 20 triệu">
                    				<label for="filter_price_4" class="select-filter-item" onclick="submitFormFilterPrice('04', 'filter_price_4');">
                    					<input class="chk-price-select" id="filter_price_4" type="checkbox" name="filter_price_4" value="04" <?php if($filter_price == '04') echo "checked='checked'"; ?>>
                    					<span title="Từ 10 - 20 triệu" class="price-checker-link filter-check"></span>
                    					<span class="filter-link">Từ 10 - 20 triệu
                    					</span>
                    				</label>
                    			</li>
                    			<li class="filter-item" title="Từ 20 - 30 triệu">
                    				<label for="filter_price_5" class="select-filter-item" onclick="submitFormFilterPrice('05', 'filter_price_5');">
                    					<input class="chk-price-select" id="filter_price_5" type="checkbox" name="filter_price_5" value="05" <?php if($filter_price == '05') echo "checked='checked'"; ?>>
                    					<span title="Từ 20 - 30 triệu" class="price-checker-link filter-check"></span>
                    					<span class="filter-link">Từ 20 - 30 triệu
                    					</span>
                    				</label>
                    			</li>
                    			<li class="filter-item" title="Từ 30 - 50 triệu">
                    				<label for="filter_price_6" class="select-filter-item" onclick="submitFormFilterPrice('06', 'filter_price_6');">
                    					<input class="chk-price-select" id="filter_price_6" type="checkbox" name="filter_price_6" value="06" <?php if($filter_price == '06') echo "checked='checked'"; ?>>
                    					<span title="Từ 30 - 50 triệu" class="price-checker-link filter-check"></span>
                    					<span class="filter-link">Từ 30 - 50 triệu
                    					</span>
                    				</label>
                    			</li>
                    			<li class="filter-item" title="Từ 50 - 80 triệu">
                    				<label for="filter_price_7" class="select-filter-item" onclick="submitFormFilterPrice('07', 'filter_price_7');">
                    					<input class="chk-price-select" id="filter_price_7" type="checkbox" name="filter_price_7" value="07" <?php if($filter_price == '07') echo "checked='checked'"; ?>>
                    					<span title="Từ 50 - 80 triệu" class="price-checker-link filter-check"></span>
                    					<span class="filter-link">Từ 50 - 80 triệu
                    					</span>
                    				</label>
                    			</li>
                    			<li class="filter-item" title="Từ 80 - 100 triệu">
                    				<label for="filter_price_8" class="select-filter-item" onclick="submitFormFilterPrice('08', 'filter_price_8');">
                    					<input class="chk-price-select" id="filter_price_8" type="checkbox" name="filter_price_8" value="08" <?php if($filter_price == '08') echo "checked='checked'"; ?>>
                    					<span title="Từ 80 - 100 triệu" class="price-checker-link filter-check"></span>
                    					<span class="filter-link">Từ 80 - 100 triệu
                    					</span>
                    				</label>
                    			</li>
                    			<li class="filter-item" title="Trên 100 triệu">
                    				<label for="filter_price_9" class="select-filter-item" onclick="submitFormFilterPrice('09', 'filter_price_9');">
                    					<input class="chk-price-select" id="filter_price_9" type="checkbox" name="filter_price_9" value="09" <?php if($filter_price == '09') echo "checked='checked'"; ?>>
                    					<span title="Trên 100 triệu" class="price-checker-link filter-check"></span>
                    					<span class="filter-link">Trên 100 triệu
                    					</span>
                    				</label>
                    			</li>
                    			
								<input type="hidden" name="filter_price" id="filter_price">

                            </form>

                            <script language="JavaScript" type="text/javascript">
                            	function submitFormFilterPrice(priceId, domId) {
									var dom = document.getElementById(domId);
									const params = new URLSearchParams(window.location.search)
									let filter_price = dom.checked ? "filter_price=" + priceId : ''
									let url = dom.checked ? ("?filter_price=" + priceId) : "?"
									if (params.has('filter_brand')) {
										url = "?filter_brand="+ params.get('filter_brand') + (filter_price ? "&" + filter_price : '')
									} 

									location.href = url
									// document.getElementById("filter_price").value = priceId;
									// document.getElementById("form_filter_price").submit();
								}
                            </script>
							</ul>

							<div class="tab-filter-close">
								<a href="#"><i class="fa fa-times"></i>Đóng</a>
							</div>

						</div>
					</div>
					<div class="body-left-box filter-general">
						<div class="body-left-title-filter">
							Bộ lọc<span class="arrow-icon-filter"></span>
						</div>
						<div class="body-left-box-sub-under">
							<div
								class="body-left-box-sub filter-another box-color-filter filter_68">
								<?php 
									if ($home_level_group == 1 || $home_level_group == 2) {
								       	include 'common_slidebar_type_brand.php';
								    }
								?>
								<div class="body-left-box-title extra cat-menu-title">Nhóm thương hiệu</div>
								<div class="body-left-box-inner-extra">
									<ul class="list-filter" style="">
										<?php 
                                    		$sqlFilter = "SELECT A.prod_filter_id, A.prod_filter_name, B.permalink AS filter_permalink FROM np_prod_filter A ";
                                    		$sqlFilter .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
                                //     		$sqlFilter .= " INNER JOIN np_product C ON C.Filter_id = A.Filter_id ";
                                       		$sqlFilter .= " WHERE A.delete_flag = '0' AND A.group_id = '$home_group_id'";
                                       		
                                        	$resultFilter = $conn->query($sqlFilter);
                                    		if ($resultFilter->num_rows > 0) {
                                    		    while ($rowFilter = $resultFilter->fetch_assoc()) {
                                		?>
										<li class="filter-item">
											<label class="select-filter-item">
												<input type="checkbox" class="chk-specs" value="<?=$rowFilter['prod_filter_id']?>">
												<span class="filter-check"></span>
												<a href="<?=$rowFilter['filter_permalink']?>" class="filter-link" title="<?=$rowFilter['prod_filter_name']?>">
													<?=$rowFilter['prod_filter_name']?>
												</a>
											</label>
										</li>
										<?php 
                                    		  }
                                    		}
                                		?>
									</ul>
								</div>
							</div>
							<div class="tab-filter-close">
								<a href="#"><i class="fa fa-times"></i>Đóng</a>
							</div>
						</div>
					</div>
				</aside>
<script type="text/javascript" lang="javascript">
        $(document).ready(function () {
            $('.body-left-title-filter').click(function () {
                if (!$(this).closest('.body-left-box').hasClass('expanded')) {
                    $('.body-left-box').each(function () {
                        if ($(this).hasClass('expanded')) {
                            $(this).toggleClass('expanded');
                        }
                    });
                }
                $(this).closest('.body-left-box').toggleClass('expanded');
                if ($('.body-left-box.expanded').length > 0) {
                    $('.center-body-left').addClass('filter-general-expanded');
                    $('body').addClass('active');
                    $('.center-body-right, #footer-m').css('visibility', 'hidden');
                    $('body').css({ 'overflow': 'hidden', 'height': '100vh' });
                    $('#_filters').scrollTop(0);
                } else {
                    $('.center-body-left').removeClass('filter-general-expanded');
                    $('body').removeClass('active');
                    $('.center-body-right, #footer-m').css('visibility', 'visible');
                    $('body').css({ 'overflow': 'auto', 'height': 'auto' });
                }
            });

            $('.tab-filter-close>a').click(function (e) {
                e.preventDefault();
                $('.body-left-title-filter', $(this).parents('.body-left-box')).trigger('click');
            });

            $('.view-more-filter-left>a').click(function (e) {
                e.preventDefault();
                var $a = $(this);
                var $ul = $a.parents().siblings("ul");
                $('.filter-item.be-hidden', $ul).toggleClass('hidden');
                if ($a.data('display')) {
                    $a.data('display', false);
                    $a.html('Xem thêm <i class="fa fa-angle-double-down"></i>');
                    $(window).scrollTop($ul.offset().top - $('.box-header').height());
                } else {
                    $a.data('display', true);
                    $a.html('Thu gọn <i class="fa fa-angle-double-up"></i>');
                }
            });
        });
    </script>
				<section class="center-body-right">
			<!-- 
					<div class="wrap-show-cat-new ">
						<div class="inner-show-cat-new" style="position: relative;">
							<a href="/may-pha-ca-phe-tu-dong-c627" class="show-cat-item"><div
									class="show-cat-icon">
									<img alt="🖼️" class="lazy-img lazy-loaded"
										src="/icons/cateico/c627-150x150.jpg"
										data-src="/icons/cateico/c627-150x150.jpg">
								</div>
								<div class="show-cat-title">Máy pha cà phê tự động</div> <span
								class="cat-shortcut"></span></a>
						</div>
					</div>
 -->
					<div class="wrap-product-catagsub" id="catalog">
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
						}  else
						    // chon Filter
						    if ($home_table_name == Common::$_TABLE_NP_PROD_FILTER) {
						        if ($home_level_group == '2') {
						            $sql .= " WHERE  A.group_id = '$home_group_id' ";
						        } else if ($home_level_group == '1') {
						            $sql .= " INNER JOIN np_prod_group X ON A.group_id = X.group_id ";
						            $sql .= " WHERE  X.group_level_up = '$home_group_id' ";
						        } else if ($home_level_group == '0') {
						            $sql .= " INNER JOIN np_prod_group X ON A.group_id = X.group_id ";
						            $sql .= " INNER JOIN np_prod_group Y ON Y.group_id = X.group_level_up ";
						            $sql .= " WHERE  Y.group_level_up = '$home_group_id' ";
						        }
						} else
						    // Search
        				    if ($home_pmk == 'tim-kiem') {
        					    $sql .= " WHERE  A.product_name LIKE '%". $name_group. "%' ";
    				    } else
    				        // Search
    				        if ($home_pmk == 'flash-sale') {
    				            $sql .= " WHERE  A.	product_flash_sale = '1' ";
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
						        $sql .= " AND A.product_sell_price < 3000000 ";
						    } else if ($filter_price == '02') {
						        $sql .= " AND A.product_sell_price >= 3000000 ";
						        $sql .= " AND A.product_sell_price < 5000000 ";
						    } else if ($filter_price == '03') {
						        $sql .= " AND A.product_sell_price >= 5000000 ";
						        $sql .= " AND A.product_sell_price < 10000000 ";
						    } else if ($filter_price == '04') {
						        $sql .= " AND A.product_sell_price >= 10000000 ";
						        $sql .= " AND A.product_sell_price < 20000000 ";
						    } else if ($filter_price == '05') {
						        $sql .= " AND A.product_sell_price >= 20000000 ";
						        $sql .= " AND A.product_sell_price < 30000000 ";
						    } else if ($filter_price == '06') {
						        $sql .= " AND A.product_sell_price >= 30000000 ";
						        $sql .= " AND A.product_sell_price < 50000000 ";
						    } else if ($filter_price == '07') {
						        $sql .= " AND A.product_sell_price >= 50800000 ";
						        $sql .= " AND A.product_sell_price < 80000000 ";
						    } else if ($filter_price == '08') {
						        $sql .= " AND A.product_sell_price >= 80000000 ";
						        $sql .= " AND A.product_sell_price < 100000000 ";
						    } else if ($filter_price == '09') {
						        $sql .= " AND A.product_sell_price >= 100000000 ";
						    }
						}
						
						$sql .= " AND  A.delete_flag = '0' ";
						
						// click sort
						if (isset($_POST['sort-select']) && !empty($_POST['sort-select'])) {
						    if ($_POST['sort-select'] == '01') {
						        $sql .= " ORDER BY A.product_sell_price ASC ";
						    } else  if ($_POST['sort-select'] == '02') {
						        $sql .= " ORDER BY A.product_sell_price DESC ";
						    } else  if ($_POST['sort-select'] == '03') {
						        $sql .= " ORDER BY A.product_down_price DESC ";
						    } else  if ($_POST['sort-select'] == '04') {
						        $sql .= " ORDER BY A.product_count_view DESC ";
						    }
						}
						
						// =======================paging ============================
						// lay so so luong ban ghi
						$resultCount = $conn->query($sql);
						$totalRecord = $resultCount->num_rows;
						$totalPage =  intdiv($totalRecord, Common::$_PAGING_NUMBER_MB);
						if ($totalRecord - ($totalPage * Common::$_PAGING_NUMBER_MB) > 0) {
						    $totalPage ++;
						}
						$currentPage = 1;
						if (isset($_POST['currentPage']) && !empty($_POST['currentPage'])) {
						    $currentPage = $_POST['currentPage'];
						}
						$startR = ($currentPage - 1) * Common::$_PAGING_NUMBER_MB;
						
						$sql .= " Limit " .$startR. ", " .Common::$_PAGING_NUMBER_MB * $currentPage. " ";
        				
						$resultxx = $conn->query($sql);
        				if ($resultxx->num_rows > 0) {
        				    
        				?>
						<div class="description-filter mobile" >
							<div class="title-cat-xeo-brand">
								<h1 class="cat-xeo-desc"><?=$name_group?></h1>
								<span>&nbsp;</span><span class="cat-xeo-number">(<?=Common::$_PAGING_NUMBER_MB * $currentPage?>/<?=$totalRecord?> sản phẩm)</span>
							</div>

						</div>
						<div class="result-filter"></div>
						<section id="_products">
							<div class="wrap-list-product-catagsub">
								<div class="list-product-highlight">

									<ul class="product-highlight-wrap">
										<?php 
										while ($rowxx = $resultxx->fetch_assoc()) {
										    $sum_vote = 0;
										    $vote = 0;
										    $sum_vote = $rowxx['one_star'] + $rowxx['two_star'] + $rowxx['three_star'] + $rowxx['four_star'] + $rowxx['five_star'];
										    if ($sum_vote != 0){
										        $vote = ($rowxx['one_star'] * 1 + $rowxx['two_star'] * 2 + $rowxx['three_star'] * 3 + $rowxx['four_star'] * 4 + $rowxx['five_star'] * 5 )
										        / $sum_vote;
										    }
										?>
										<li class="product-highlight-item prod-item _list_ico_3031"
											data-pid="70418"><a data-promoid="3031"
											href="<?=$rowxx['prd_permalink']?>" target="_blank"
											class="fast-view type-promo">
											</a>
											<?php 
											 if ($rowxx['product_down_price'] != '0') {
                            				?>
											<div class="prod-hl-discount">
												<span>-<?=$rowxx['product_down_price']?>%</span>
											</div>
											<?php 
											 }
											?>
											<div class="prod-hl-thumb">
												<a href="<?=$rowxx['prd_permalink']?>">
    												<img alt="🖼️" src="npad/<?=$rowxx['image_url']?>"
    													data-src="npad/<?=$rowxx['image_url']?>"
    													width="140" height="140"
    													class="lazy-img thumb-list is-thumb">
												</a>
											</div>
											<div class="prod-hl-name">
												<a title="<?=$rowxx['product_name']?>"
													href="<?=$rowxx['prd_permalink']?>"><?=$rowxx['product_name']?></a>
											</div>
											<div class="prod-hl-brand">
												<a href="<?=$rowxx['brand_permalink']?>" data-brand-id="2420"
													data-brand-alias="<?=$rowxx['brand_name']?>"><?=$rowxx['brand_name']?></a>
											</div>
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
                            					</span>
                            					<span class="amount-rate"><?=$sum_vote?> đánh giá</span>
											</div>
											<div class="product-price list-product-price">
												<span class="product-price-meta"><?=Common::convertMoney($rowxx['product_sell_price'])?></span><span
													class="product-price-old"><?=Common::convertMoney($rowxx['product_old_price'])?></span>
											</div></li>
										<?php 
										}
										?>
									</ul>
								</div>
    							<?php 
        							if ($totalPage > 1) {
    							
    							?>
    							<form action="" method="post" name="paging_form" id="paging_form">
    								<div data-total="<?=$totalRecord?>" class="list-product-catasub-more">
    									<input type="hidden" name="currentPage" id="currentPage" value="<?=($currentPage + 1)?>"/>
    									<a onclick="document.getElementById('paging_form').submit();" >
    										Xem thêm <?=Common::$_PAGING_NUMBER_MB?> sản phẩm <i class="fa fa-chevron-down"></i>
    									</a>
    								</div>
								</form>
								<?php 
        							}
								?>
							</div>
						</section>
						<?php 
        				}
						?>
					</div>
					<div class="page-catalog-main">
						<div id="catalogSub-brand" class="box-catalog-main brand">
							<?php include '_productcontent_mb_viewed.php';?>
						</div>
						<div id="catalogSub-brand" class="box-catalog-main brand">
							<?php include 'common_brands_mb.php';?>
						</div>
						<div id="catalogSub-support" class="box-catalog-main support">
							<?php include 'common_services_mb.php';?>
						</div>
						
					</div>
				</section>
			</div>
			<div></div>
		</div>
	</section>
	<?php include 'common_footer_mb.php';?>
</body>
</html>