<!DOCTYPE html>
<html lang="vi">
<head>

<?php include 'common_headermeta_mb.php';

    $meta_sql = "SELECT p.product_seo FROM np_product as p WHERE p.data_id = (SELECT pl.data_id FROM np_permalink as pl WHERE pl.permalink = '".$home_estr_pmk."')";
    $meta_tag = $conn->query($meta_sql);$meta_tag->fetch_assoc();
    foreach($meta_tag as $meta){
        echo $meta['product_seo'];
    }
?>
<link rel=stylesheet media=all type=text/css
	href="template/css/np_mb.css" />
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/header-home.min.css">
<link type="text/css" rel="stylesheet"
	href="template/css/details-theme.css" />
<link type="text/css" rel="stylesheet"
    href="template/css/lightboxed.css">
<link rel="stylesheet" media="all" type="text/css" href="template/css/np.css">
<link rel="stylesheet" media="all" type="text/css" href="template/css/style-home.min.css">
<link rel="stylesheet" media="all" type="text/css" href="template/css/header-home.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body id="detail">
<?php 
// add session
$checkout_returnInfo = array();
$checkout_info = array();
$checkout_item = array();

if (isset($_SESSION[Common::$_SESSION_CHECKOUT_INFO])) {
    $checkout_info = $_SESSION[Common::$_SESSION_CHECKOUT_INFO];
} else {
    
}
if (isset($_POST['checkout_product_id']) && ! empty($_POST['checkout_product_id'])
    && isset($_POST['txtQty']) && ! empty($_POST['txtQty'])) {
        $numberProd = sizeof($checkout_info);
        $checkout_item[] = $_POST['checkout_product_id'];
        $checkout_item[] = $_POST['txtQty'];
        if ($numberProd > 0) {
            $isDouble = false;
            foreach ($checkout_info as $itemInfo) {
                if ($checkout_item[0] == $itemInfo[0]) {
                    $itemInfo[1] += $checkout_item[1];
                    $isDouble = true;
                }
                $checkout_returnInfo[] = $itemInfo;
            }
            if (!$isDouble) {
                $checkout_returnInfo[] = $checkout_item;
            }
        } else {
            $checkout_returnInfo[] = $checkout_item;
        }
        $_SESSION[Common::$_SESSION_CHECKOUT_INFO] = $checkout_returnInfo;
    }
?>
<?php  include 'common_top_ads.php'; ?>
<?php  include 'common_topmenu_mb_homepage.php'; ?>
	<section id="center-m" class="status-y">
		<div class="wrap">
		<div class="breadcrum-cat">
         <?php include '_productcontent_mb_slug.php';?>
         </div>
 			 <?php
            $sql100 = "SELECT * ";
            $sql100 .= " FROM np_product A ";
            $sql100 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
            $sql100 .= " LEFT OUTER JOIN np_prod_brand C ON A.brand_id = C.brand_id ";
            $sql100 .= " LEFT OUTER JOIN np_permalink E ON E.data_id = C.data_id ";
            $sql100 .= " LEFT OUTER JOIN np_prod_vote F ON A.product_id = F.product_id ";
    //         $sql100 .= " WHERE  B.permalink = '$home_estr_pmk' ";
            $sql100 .= " WHERE  A.product_id = '$home_product_id' ";
            $sql100 .= " AND  A.delete_flag = '0' ";
            
            $detailprd_result = $conn->query($sql100);
            if ($detailprd_result->num_rows > 0) {
                while ($row100 = $detailprd_result->fetch_assoc()) {
                    
                    // Tang so lan doc page
                    // Truong hop dan vao doc roi
                    if (isset($_SESSION[Common::$SESSION_USER_VIEW_PRODUCT]) && !empty($_SESSION[Common::$SESSION_USER_VIEW_PRODUCT])) {
                        $lstProductView = $_SESSION[Common::$SESSION_USER_VIEW_PRODUCT];
                        $isView = false;
                        foreach($lstProductView as $pageid) {
                            if ($pageid == $home_product_id) {
                                $isView = true;
                                break;
                            }
                        }
                        if (!$isView) {
                            $lstProductView[] = $home_product_id;
                            $_SESSION[Common::$SESSION_USER_VIEW_PRODUCT] = $lstProductView;
                            
                            $sql251 = " UPDATE np_product SET product_count_view = product_count_view + 1 WHERE product_id = '$home_product_id' ";
                            $stmt251 = $conn->prepare($sql251);
                            $stmt251->execute();
                        }
                        
                        // Truong hop vao lan dau
                    } else {
                        $lstProductView = array();
                        $lstProductView[] = $home_product_id;
                        $_SESSION[Common::$SESSION_USER_VIEW_PRODUCT] = $lstProductView;
                        
                        $sql251 = " UPDATE np_product SET product_count_view = product_count_view + 1 WHERE product_id = '$home_product_id' ";
                        $stmt251 = $conn->prepare($sql251);
                        $stmt251->execute();
                    }
                    
            ?>
                    
			<div id="ctl00_pageBody_pnlProdOffer" class="row-detail">

				<div class="view-detail-product">
					<!-- Phan slide show anh san pham -->
					<div class="view-images-product">
						<div class="swiper-container">
							<div class="img-attribute hidden"></div>
							<div class="swiper-wrapper slide-list">
								<?php 
								    $imageCount = '';
								    $imagetitle = '';
								    $imageurl = '';
								    
								    $sql98 = "SELECT image_id, image_title, image_url FROM np_prod_image ";
								    $sql98 .= " WHERE product_id = '$home_product_id' AND image_type = '2'";
								    $sql98 .= "  AND  delete_flag = '0'  ";

								    $result98 = $conn->query($sql98);
								    if ($result98->num_rows > 0) {
								        $imageCount = $result98->num_rows;
								        while ($row98 = $result98->fetch_assoc()) {
								            $imagetitle = $row98['image_title'];
								            $imageurl = $row98['image_url'];
								?>
								<div class="swiper-slide pop-gallery">
									<img data-idx="0" class="prod-img lightboxed" rel="group1" data-id="img-0" alt="<?=$row98['image_title']?>"
										data-ssrc="npad/<?=$row98['image_url']?>" src="npad/<?=$row98['image_url']?>">
								</div>
								<?php 
								        }
								    }
								?>
							</div>


							<div class="swiper-pagination img-slide"></div>
							<div class="swiper-button-next img-slide"></div>
							<div class="swiper-button-prev img-slide"></div>
						</div>
						<div class="row-viewmore-thumb">
							<div class="col-viewmore-item pop1 gallery">
									<img class="lazy-img" alt="<?=$imagetitle?>" src="npad/<?=$imageurl?>"
									data-src="npad/<?=$imageurl?>">
									<div class="over-gallery" id="show-light-box">Xem <?=$imageCount?> h??nh</div>
							</div>

							<div class="col-viewmore-item comment">
								<div class="icon-spec">
									<img class="lazy-img" src="template/images/Comments-icon.png"
										data-src="template/images/Comments-icon.png">
								</div>
								<div class="title-spec">
									<a href="#box-danhgia"> Xem nh???n x??t</a>
								</div>
							</div>

							<div class="col-viewmore-item special">
								<div class="icon-spec">
									<img class="lazy-img" src="template/images/thong-so-icon.png"
										data-src="template/images/thong-so-icon.png">
								</div>
								<div class="title-spec">
									<a href="#box-thongso">Th??ng s??? k??? thu???t</a>
								</div>
							</div>
						</div>
					</div>

<script type="text/javascript" lang="javascript">
    function change_qty_detail(id, step) {
        var $txt = $('#' + id);
        var min = parseInt($txt.attr('min'));
        var number = parseInt($txt.val()) + step;
        if (number < min) {
            number = min;
            alert('M???t h??ng n??y ph???i ?????t t??? ' + min + ' s???n ph???m tr??? l??n!');
        }
        $txt.val(number > 1 ? number : 1);
        $txt.trigger('modified');
        return false;
    }
    $(document).ready(function () {
        $("#show-light-box").click(function(){
            $('img[rel=group1]').first().click();
        });
            $('.title-hotline-more').click(function () {
                var $box = $(this).closest('.box-hotline-more');
                $box.toggleClass('expanded');
                if ($box.hasClass('expanded'))
                    $('span', $(this)).html('Thu g???n chi ti???t');
                else
                    $('span', $(this)).html('Xem th??m chi ti???t');
            });


            $('a.close-promo').click(function (e) {
                e.preventDefault();
                var pos = $(window).scrollTop();
                window.location.hash = '';
                history.replaceState('', document.title, window.location.pathname);
                $(window).scrollTop(pos);
            });

            $('.bg-promo').click(function (e) {
                $('a.close-promo', $('.bg-promo').parent()).trigger('click');
            });

            //$('.swiper-button-next, .swiper-button-prev').hide();

            _loadJs('template/js/swiper.min.js', function () {
                var swiper = new Swiper('.swiper-container', {
                    pagination: {
                        el: '.swiper-pagination',
                        //type: 'fraction',
                        clickable: true,
                        renderBullet: function (index, className) {
                            return '<span class="' + className + '"></span>';
                        },
                    },
                    spaceBetween: 1,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    loop: true,
                });

                var $indexSpan = $('<span class="slide-pagination"><span class="slide-pagination-idx">1</span> / ' + (swiper.slides.length - 2) + '<span>');
                $indexSpan.appendTo('.swiper-pagination');
                swiper.on('slideChange', function () {
                    var idx = swiper.realIndex + 1;
                    $('.slide-pagination-idx').html(idx);
                    if (swiper.realIndex > 0) {
                        var $img = $('img[data-idx="' + swiper.realIndex + '"]');
                        if (!$img.data('lazyloaded')) {
                            $img.prop('src', $img.data('ssrc'));
                            $img.data('lazyloaded', 1);
                        }
                    }
                });

                $('.col-viewmore-item.pop1>a').bind('click', function (e) {
                    e.preventDefault();
                    swiper.slideTo(1, 800, true);
                });

            });

        });
</script>
					<div class="Product-info-right-name">
						<div class="detail-prod-name">
							<div class="prod-name-main">
								<h1 title="<?=$row100['product_name']?>"><?=$row100['product_name']?></h1>
							</div>
						</div>
						<div class="prod-subtitle">
							<span class="block brand-link"> <a href="<?=$pmk_group_link?>"
								title="<?=$name_group_link?>"><?=$name_group_link?></a>
							</span>
						</div>
						
						<div class="detail-product-rate">
						<?php
                        $prd_vote_sum = 0;
                        $prd_vote = 0;
                        $prd_voteLevel = '';
                        $prd_vote_sum = $row100['one_star'] + $row100['two_star'] + $row100['three_star'] + $row100['four_star'] + $row100['five_star'];
                        if ($prd_vote_sum != 0) {
                            $prd_vote = ($row100['one_star'] * 1 + $row100['two_star'] * 2 + $row100['three_star'] * 3 + $row100['four_star'] * 4 + $row100['five_star'] * 5) / $prd_vote_sum;
                        }
        
                        if ($prd_vote < 3) {
                            $prd_voteLevel = 'Kh??ng T???t';
                        } else if ($prd_vote < 4) {
                            $prd_voteLevel = 'Trung B??nh';
                        } else {
                            $prd_voteLevel = 'T???t';
                        }
                        ?>
							<span class="rating-box rating-box-second"
								title="<?=$prd_voteLevel?>"> 
    							<?php
                                for ($i = 1; $i < 6; $i ++) {
                                    if ($i < $prd_vote) {
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
							</span> <span class="amount-rate"><a href="#box-danhgia">(<?=$prd_vote_sum?> ????nh gi??)</a></span>
						</div>
					</div>
					<form action="" name="form_checkout_product" id="form_checkout_product" method="post">
					<div class="Product-info-right-top">
						<div class="Product-summary">
							<?php 
							if ($row100['product_flash_sale'] == '0') {
							?>
    							<div class="detail-info-spec prod-price-meta">
    								<span class="info-spec-right">
    									<span id="p_price" class="p-price"><?=Common::convertMoney($row100['product_sell_price'])?></span>
        								<span id="p_lprice" class="p-price-old"><?=Common::convertMoney($row100['product_old_price'])?></span>
        								<span class="p-price-sale" title="-<?=$row100['product_down_price']?> %">
        									<span>-<?=$row100['product_down_price']?>%</span>
        								</span>
    								</span>
    							</div>
							<?php 
							} else {
							?>
							<?php 
    						    $today = time();
    						    $timeSale = strtotime($row100['product_flash_sale_time']);
    						    $totalDayTimeDown = $timeSale - $today;
    						?>
    						<?php 
    						  if ($totalDayTimeDown > 0) {
    						?>
    						<script type="text/javascript">
    							var upgradeTime = <?=$totalDayTimeDown?>;
                                var seconds = upgradeTime;
                                function timer() {
                                  var days        = Math.floor(seconds/24/60/60);
                                  var hoursLeft   = Math.floor((seconds) - (days*86400));
                                  var hours       = Math.floor(hoursLeft/3600);
                                  var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
                                  var minutes     = Math.floor(minutesLeft/60);
                                  var remainingSeconds = seconds % 60;
                                  function pad(n) {
                                    return (n < 10 ? "0" + n : n);
                                  }
                                  $("#days").text(pad(days));
                                  $("#hours").text(pad(hours));
                                  $("#minutes").text(pad(minutes));
                                  $("#seconds").text(pad(remainingSeconds));
                                  
                                  if (seconds == 0) {
                                    clearInterval(countdownTimer);
                                  } else {
                                    seconds--;
                                  }
                                }
                                var countdownTimer = setInterval('timer()', 1000);
    						</script>
    						<?php 
    						  }
    						?>
								<div class="detail-info-spec flash-sale running"
									data-promoid="6897">
									<span class="info-spec-left"></span><span
										class="info-spec-right"><div class="flashsale-box">
											<div class="time-box-left">
												<span class="timeleft">K???t th??c sau</span>
											</div>
											<div id="flashsale">
												<div class="time-box-item">
													<span class="days">0</span>
													<div class="smalltext">ng??y</div>
												</div>
												<div class="time-box-item">
													<span class="hours">0</span>
													<div class="smalltext">gi???</div>
												</div>
												<div class="time-box-item">
													<span class="minutes">0</span>
													<div class="smalltext">ph??t</div>
												</div>
												<div class="time-box-item">
													<span class="seconds">0</span>
													<div class="smalltext">gi??y</div>
												</div>
											</div>
											<div class="time-box-left">
												<span class="seconds">&nbsp;&nbsp; <span class="among-buy"></span>
												</span>
											</div>
											<div class="fs-price">
												<span>Gi?? Flash Sale </span><span><?=Common::convertMoney($row100['product_sell_price'])?></span>
												<div class="sale-fs">
													<span class="percent-fs">-<?=number_format($row100['product_down_price'])?>%</span><span
														class="old-price-fs"><?=Common::convertMoney($row100['product_old_price'])?></span>
												</div>
											</div>
										</div>
									</span>
								</div>
<style>
.show-flash-sale ~ .prod-price-meta {
    display: none;
}

.show-flash-sale ~ .prod-price-old {
    display: none;
}

.flashsale-box {
    display: inline-block;
}

#flashsale {
    font-family: sans-serif;
    color: #fff;
    display: inline-block;
    font-weight: 100;
    text-align: center;
    font-size: 16px;
    user-select: none;
    margin: 5px 0;
}

    #flashsale .time-box-item {
        background: #fff;
        display: inline-block;
        position: relative;
        width: 31px;
        height: 30px;
        border-radius: 3px
    }

.time-box-left {
    color: #fff;
}

    .time-box-left .seconds {
        font-size: 12px;
    }

span.among-buy {
    font-size: 16px;
    font-weight: bold;
}

#flashsale div > span {
    width: 32px;
    height: 30px;
    line-height: 20px;
    text-align: center;
    border-radius: 3px;
    display: block;
    font-size: 14px;
    z-index: 1;
    color: #333;
}

.fs-price span:last-child {
    color: #da251c;
    margin-left: 10px;
}

.smalltext {
    font-size: 12px;
    color: #333;
    position: absolute;
    bottom: 1px;
    left: 0;
    width: 100%;
    text-align: center;
    z-index: 2;
    background: rgba(255,255,255,0.2);
    line-height: 14px;
    font-size: 10px;
}

.detail-info-spec.flash-sale {
    padding: 7px;
    border-radius: 5px;
    position: relative;
    display: inline-block;
    width: calc(100% - 10px);
    background: #da251c;
}

    .detail-info-spec.flash-sale.fs-before {
        background: #0fa80f;
    }

    .detail-info-spec.flash-sale .info-spec-right {
        width: auto;
        text-align: right;
        float: right;
    }

.fs-price {
    float: left;
    display: block;
    height: 45px;
    position: absolute;
    left: 10px;
    top: 17px;
    text-align: left;
}

.sale-fs {
    color: #fff;
}

.old-price-fs {
    text-decoration: line-through;
    color: #fff !important;
    font-size: 14px !important;
    font-weight: inherit !important;
}

.sale-fs .percent-fs {
    display: inline-block !important;
    padding-left: 0 !important;
}

.fs-price:after {
}

.fs-price span:first-of-type {
    padding-left: 28px;
    display: none;
}

.fs-price span:nth-child(2) {
    color: #fff;
    font-weight: bold;
    font-size: 26px;
}
</style>
							<?php 
							}
							?>
							
							
							<div class="detail-info-spec prod-spec-brand">
								<span class="info-spec-left">Th????ng hi???u:</span> 
								<span class="info-spec-right"> 
									<span class="brand-link">
										<a href="<?=$row100['permalink']?>" title="<?=$row100['brand_name']?>"><?=$row100['brand_name']?></a>
									</span>
								</span>
							</div>

							<div class="detail-info-spec status">
								<span class="info-spec-left">Tr???ng th??i:</span> <span
									class="stock stock-status stk_y" itemprop="availability"
									content="in_stock">
									<?php
                                    if ($row100['product_status'] == '0') {
                                        echo "C??n h??ng";
                                    } else {
                                        echo "H???t h??ng";
                                    }
                                    ?>
								</span>
							</div>
							<div class="detail-info-spec among">
								<span class="info-spec-left">Ch???n s??? l?????ng:</span> <span
									class="info-spec-right">
									<table class="select-among">
										<tbody>
											<tr>
												<td class="input-group-btn">
													<button class="btn-among down"
														onclick="return change_qty_detail('txtQty', -1)"
														type="button">-</button>
												</td>
												<td class="input-txt-among">
													<input type="hidden" name="checkout_product_id" id="checkout_product_id" value="<?=$home_product_id?>">
													<input type="text" id="txtQty" name="txtQty" value="1" step="1" min="1" max="100" class="form-among">
												</td>
												<td class="input-group-btn">
													<button class="btn-among up"
														onclick="return change_qty_detail('txtQty', 1)">+</button>
												</td>
											</tr>
										</tbody>
									</table>
								</span>
							</div>
    						<div class="pick-in-cart">
                                <span class="title-pick" onclick="addCartSubmit();">Cho v??o gi???</span>
                            </div>
                        	<?php 
                        	
                        	
                        	?>
                        </div>
						<div class='btn-prod-shopping'>
							<div class="btn-buy-wrap buy-now">
								<a href="#" class="btn-shopp-manual btn-buy btn-order button-buy " id="btn-buy-prod" onclick="checkoutSubmit();"> <span
									class="icon-shopp icon-spcart" style="position: relative"></span>
									<span class="txt-shopp"> <span class="txt-buy-now">?????t mua</span>
								</span>
								</a>
							</div>
							<div class="btn-supp-wrap supp-now">
								<a class="btn-shopp-manual btn-supp" rel="nofollow" id="btn-supp-prod" data-toggle="modal" data-target="#exampleModal"><span
									class="icon-shopp icon-supp"></span> <span class="txt-shopp"> <span
										class="txt-buy-now">T?? v???n</span>
								</span>
								</a>
							</div>

						</div>

						<div class="Service-freeship">
							<div class="freeship-wrap-pc">
								<span class="icon-freeship"> <img class="lazy-img lazy-loaded"
									alt="???" src="template/images/free-ship.png"
									data-src="template/images/free-ship.png"></span> <span
									class="txt-freeship"> Mi???n ph?? giao h??ng v?? l???p ?????t t???i H?? N???i
								</span> <a target="blank" href="huong-dan-dat-hang" class="view-freeship">Xem th??m<i
									class="fa fa-angle-double-right"></i>
								</a>
							</div>

						</div>
						<div id="support-ctrl" class="test-ab box-hotline">
							<div id="ctl00_pageBody_ctl00_pnlWorking" class="hotline-wrap">

								<div class="slogan-box-hotline">Mi???n ph?? giao h??ng v?? l???p ?????t t???i H?? N???i</div>

								<div class="box-hotline-more">

									<div class="title-hotline-more">
										<span>Xem th??m chi ti???t</span><i class="arrow-icon-hotline"></i>
									</div>
									<div id="ctl00_pageBody_ctl00_pnlAddress"
										class="list-more-hotline">

										<div class="box-address-region">

											<div class="address-region-item address2">
												<span class="add-left"><i class="fa fa-home"></i><b>SHOWROOM THI???T B??? V??? SINH & NH?? B???P:</b></span>
												<span class="add-right">17 Thanh Nh??n, Hai B?? Tr??ng, H?? N???i</span>
											</div>
											<div class="address-region-item address2">
												<span class="add-left">&nbsp;</span> <span class="add-right">??i???n tho???i:  (024) 3633 1159</span>
											</div>

										</div>
										<div class="box-time-work">
											<div class="time-work-left block">
												<i class="fa fa-clock-o"></i><b>Th???i gian:</b>
											</div>
											<div class="time-work-right block">
												<div>T??? 8h - 19h00 Th??? 2 ?????n th??? 6</div>
												<div>T??? 8h - 17h30 Th??? 7 & Ch??? nh???t</div>
											</div>
										</div>
									</div>
								</div>

							</div>

						</div>
						<div class="div-showhide-stock"></div>
					</div>
					</form>
                    <!-- T?? v???n -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">??i???n th??ng tin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <div class="modal-body">
                                H??? t??n:<br>
                                <input class="form-control" type="text" size="19" name="mail_name" id="mail_name"><br>
                                S??? ??i???n tho???i:<br>
                                <input class="form-control" type="text" size="19" name="mail_phone" id="mail_phone"><br>
                                Email li??n h???:<br>
                                <input class="form-control" type="text" size="19" name="mail_contact" id="mail_contact"><br>
                                N???i dung:<br> <textarea class="form-control" name="mail_content" rows="6" cols="20" id="mail_content"></textarea><br>
                                <div id="res_ajax">&nbsp;</div>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-success" onclick="supportSubmit()">G???i</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal-close">????ng</button>
                            </div>
                        </div>
                      </div>
                    </div>
					<script type="text/javascript" lang="javascript">
    					function checkoutSubmit() {
    						document.form_checkout_product.action = "mua-hang";
    						document.getElementById("form_checkout_product").submit();
    					}
    					
    					function supportSubmit() {
    						var name = $('#mail_name').val();
                            var phone = $('#mail_phone').val();
                            var contact = $('#mail_contact').val();
                            var content = $('#mail_content').val();
                            var url = location.href;
                            $('#res_ajax').children().remove();
                             $.ajax({
                                url: "_sendMail.php",
                                type: "post",
                                data: {mail_name: name, mail_phone: phone, mail_contact:contact, mail_content: content, send_url: url} ,
                                success: function (response) {
                                    response = JSON.parse(response)
                                    console.log(response.message)
                                    $('#res_ajax').append(response.message)
                                    if (response.status == 'success') {
                                        setTimeout(function() {
                                            $('#modal-close').click();
                                        }, 1000);
                                    }
                                },
                                error: function () {
                                    $('#res_ajax').append("<span style='color: red'>* C?? l???i x???y ra. Vui l??ng th??? l???i.</span>")
                                }
                            });
    					}
    					
    					function addCartSubmit() {
    						if (confirm('B???n mu???n th??m v??o gi??? h??ng ?')) {
        						document.form_checkout_product.action = "";
        						document.getElementById("form_checkout_product").submit();
    						}
    					}
    				</script>
					<!-- Phan gia ca tham khao-->
				</div>
				<!-- Noi dat Iframe lich su ton kho-->
			</div>
			
			<!-- San pham tuong tu  -->
			<?php include '_productcontent_mb_sameProduct.php';?>

			<!--Phan hien thi noi dung san pham -->

			<section class="row-content-main">
				<a id="box-thongso" name="box-thongso"></a>
				<div class="prod-Specifications">
					<div class="prod-Spec-main">
						<div class="title-specs">
							<h2>Th??ng s??? k??? thu???t</h2>
						</div>
						<div class="body-specs">
						<ul>
							<li><span class="specs-left block">T??n s???n ph???m</span> <span
								class="specs-right block"><?=$row100['product_name']?></span></li>
							<li><span class="specs-left block">M?? s???n ph???m</span> <span
								class="specs-right block"><?=$row100['product_code']?></span></li>
							<li><span class="specs-left block">M??u s???c</span> <span
								class="specs-right block"><?=$row100['product_color']?></span></li>
							<li><span class="specs-left block">Ch???t li???u</span> <span
								class="specs-right block"><?=$row100['product_material']?></span>
							</li>
							<li><span class="specs-left block">K??ch th?????c</span> <span
								class="specs-right block"><?=$row100['product_size']?></span></li>
							<li><span class="specs-left block">Ki???u d??ng</span> <span
								class="specs-right block"><?=$row100['product_style']?></span></li>
							<li><span class="specs-left block">N??i s???n xu???t</span> <span
								class="specs-right block"><?=$row100['product_made_in']?></span>
							</li>
							<li><span class="specs-left block">B???o h??nh</span> <span
								class="specs-right block"><?=$row100['product_save']?></span></li>
							<li><span class="specs-left block">Th??ng tin kh??c</span> <span
								class="specs-right block"><?=$row100['product_other_info']?></span>
							</li>
						</ul>
					</div>
						
					</div>
				</div>
				<div>
					<a id="box-intro" name="box-intro"></a>
				</div>
				<article class="show-content-main">
					<?=$row100['product_detail']?>
				</article>

				<!--Phan danh gia binh luan-->
				<div>
					<a id="box-danhgia" name="box-danhgia"></a>
				</div>
				<script>(function(){window.editor=function(n){n.hide();var t=$("<div><\/div>");t.attr("data-placeholder","Nh???p n???i dung ph???n h???i...");t.attr("contenteditable","true");t.attr("title","H??y cho bi???t nh???n x??t ????nh gi?? c???a b???n");t.addClass("rc-editor");t.insertAfter(n);t.on("blur keyup paste input",function(){var t=$(this);n.val($.trim(t.get(0).innerText))})};window.activeInit=function(){};window.checkedInit=function(){};window.changeTypeInit=function(){}})()</script>

<style type="text/css">
#progress-wrap {
	position: fixed;
	top: 45%;
	left: 0;
	width: 100%;
	height: 100%;
	display: block;
	z-index: 9999;
	background: rgba(255, 255, 255, 0.5);
	box-shadow: 0 -1px 0 1000px rgba(255, 255, 255, 0.5);
}

#progress-wrap div {
	margin: 0 auto;
	text-align: center;
	vertical-align: middle;
	background: #F8ED98;
	padding: 10px;
	border-radius: 0 0 5px 5px;
	box-shadow: 10px 10px 5px rgba(50, 50, 50, 0.75);
	width: 230px;
}

.fbDelImg {
	background: rgba(0, 0, 0, .25);
	height: 20px;
	width: 20px;
	position: absolute;
	color: #fff;
	text-align: center;
	cursor: pointer;
	font-style: normal;
	box-sizing: border-box;
	right: 0;
	top: 0;
}
</style>

	<div id="comment-box" class="col wrap-tab-comments">
					<div class="detail-comment-wrap">

						<div class="title-rated-prod">????nh gi?? &amp; B??nh lu???n</div>
						<div id="ctl00_pageBody_ctl11_pnlRateResult"
							class="result-rated-prod">


							<div class="result-rated-box left">
								<div class="star-rated rating-box-second2">
								<?php
                                    for ($i = 1; $i < 6; $i ++) {
                                        $rate_vote = '';
                                        if ($i < $prd_vote) {
                                            $rate_vote = 'rated';
                                        }
                                ?>
								<span class="fa fa-star <?=$rate_vote?> star-<?=$i?>"
									data-point="<?=$i?>"></span> 
								<?php
                                    }
                                ?>
							</div>
								<div class="txt-rated">
								<div class="txt-rated-1">????nh gi?? <?=$prd_voteLevel?></div>
								<div class="txt-rated-2">(C?? <?=$prd_vote_sum?> ????nh gi??)</div>
							</div>
								<div class="medium-score-rated"><?=number_format($prd_vote,1)?></div>
							</div>

							<div class="result-rated-box right">
							<div class="row-rate-item" data-pt="10" data-percent="10">
								<div class="stt block">5</div>
								<div class="star-item block">
									<i class="fa fa-star"></i>
								</div>
								<?php
                                    if ($row100['five_star'] > 1) {
                                ?>
								<div class="process-rate block">
									<div class="process-inner process-rate-10"></div>
								</div>
								<?php
                                    } else {
                                 ?>
								<div class="process-rate block">
									<div class="process-inner process-rate-0"></div>
								</div>
								<?php
                                    }
                                 ?>
								<div class="quantum-star block">
									<a data-filterstar="5"
										data-title="Xem nh???ng l?????t ????nh gi?? 5 sao"> <?=$row100['five_star']?> <span
										class="txt-quantum">????nh gi??</span></a>
								</div>
							</div>
							<div class="row-rate-item" data-pt="10" data-percent="0">
								<div class="stt block">4</div>
								<div class="star-item block">
									<i class="fa fa-star"></i>
								</div>
								<?php
                                    if ($row100['four_star'] > 1) {
                                ?>
								<div class="process-rate block">
									<div class="process-inner process-rate-10"></div>
								</div>
								<?php
                                    } else {
                                ?>
								<div class="process-rate block">
									<div class="process-inner process-rate-0"></div>
								</div>
								<?php
                                    }
                                ?>
								<div class="quantum-star block">
									<a data-filterstar="4"
										data-title="Xem nh???ng l?????t ????nh gi?? 4 sao"> <?=$row100['four_star']?> <span
										class="txt-quantum">????nh gi??</span></a>
								</div>
							</div>
							<div class="row-rate-item" data-pt="10" data-percent="10">
								<div class="stt block">3</div>
								<div class="star-item block">
									<i class="fa fa-star"></i>
								</div>
								<?php
                                    if ($row100['three_star'] > 1) {
                                ?>
								<div class="process-rate block">
									<div class="process-inner process-rate-10"></div>
								</div>
								<?php
                                    } else {
                                ?>
								<div class="process-rate block">
									<div class="process-inner process-rate-0"></div>
								</div>
								<?php
                                    }
                                ?>
								<div class="quantum-star block">
									<a data-filterstar="3"
										data-title="Xem nh???ng l?????t ????nh gi?? 3 sao"> <?=$row100['three_star']?> <span
										class="txt-quantum">????nh gi??</span></a>
								</div>
							</div>
							<div class="row-rate-item" data-pt="10" data-percent="0">
								<div class="stt block">2</div>
								<div class="star-item block">
									<i class="fa fa-star"></i>
								</div>
								<?php
                                    if ($row100['two_star'] > 1) {
                                ?>
								<div class="process-rate block">
									<div class="process-inner process-rate-10"></div>
								</div>
								<?php
                                    } else {
                                ?>
								<div class="process-rate block">
									<div class="process-inner process-rate-0"></div>
								</div>
								<?php
                                    }
                                ?>
								<div class="quantum-star block">
									<a data-filterstar="2"
										data-title="Xem nh???ng l?????t ????nh gi?? 2 sao"> <?=$row100['two_star']?> <span
										class="txt-quantum">????nh gi??</span></a>
								</div>
							</div>
							<div class="row-rate-item" data-pt="10" data-percent="0">
								<div class="stt block">1</div>
								<div class="star-item block">
									<i class="fa fa-star"></i>
								</div>
								<?php
                                    if ($row100['one_star'] > 1) {
                                ?>
								<div class="process-rate block">
									<div class="process-inner process-rate-10"></div>
								</div>
								<?php
                                    } else {
                                ?>
								<div class="process-rate block">
									<div class="process-inner process-rate-0"></div>
								</div>
								<?php
                                    }
                                ?>
								<div class="quantum-star block">
									<a data-filterstar="1"
										data-title="Xem nh???ng l?????t ????nh gi?? 1 sao"> <?=$row100['one_star']?> <span
										class="txt-quantum">????nh gi??</span></a>
								</div>
							</div>
						</div>
						</div>

<?php
                $message = '';
                $rating = '';
                $comment_detail = '';
                $comment_name = '';
                if (isset($_POST['submit'])) {
                    $resultOK = 1;
                    if (! isset($_POST['rating']) || empty($_POST['rating'])) {
                        $resultOK = 0;
                    } else {
                        $rating = $_POST['rating'];
                    }
                    if (! isset($_POST['rate-content']) || empty($_POST['rate-content'])) {
                        $resultOK = 0;
                    } else {
                        $comment_detail = $_POST['rate-content'];
                    }
                    if (! isset($_POST['rate-name']) || empty($_POST['rate-name'])) {
                        $resultOK = 0;
                    } else {
                        $comment_name = $_POST['rate-name'];
                    }
                    if ($resultOK == 0) {
                        $message = "(<span style='color: red'>B???n c???n nh???p ?????y ????? th??ng tin ????nh gi??, B??nh lu???n v?? T??n c???a b???n</span>)";
                    } else {
                        $rating = $_POST['rating'];
                        $comment_detail = $_POST['rate-content'];
                        $comment_name = $_POST['rate-name'];
                        $comment_type = $_POST['comment_type'];
                        $refer_id = $_POST['refer_id'];
                        // insert vote
                        $product_vote_id = $conn->real_escape_string($refer_id);
                        $sql200 = "SELECT * FROM np_prod_vote WHERE product_id = '$product_vote_id'";
                        $result200 = $conn->query($sql200);
                        if ($result200->num_rows > 0) {
                            if ($rating == '1') {
                                $sql201 = "UPDATE np_prod_vote SET one_star = one_star + 1 WHERE product_id = ? ";
                            }
                            if ($rating == '2') {
                                $sql201 = "UPDATE np_prod_vote SET two_star = two_star + 1 WHERE product_id = ? ";
                            }
                            if ($rating == '3') {
                                $sql201 = "UPDATE np_prod_vote SET three_star = three_star + 1 WHERE product_id = ? ";
                            }
                            if ($rating == '4') {
                                $sql201 = "UPDATE np_prod_vote SET four_star = four_star + 1 WHERE product_id = ? ";
                            }
                            if ($rating == '5') {
                                $sql201 = "UPDATE np_prod_vote SET five_star = five_star + 1 WHERE product_id = ? ";
                            }
                            $stmt201 = $conn->prepare($sql201);
                            $stmt201->bind_param("s", $refer_id);
                            $stmt201->execute();
                        } else {
                            if ($rating == '1') {
                                $sql202 = "INSERT INTO np_prod_vote(product_id, one_star) VALUES (?,1)";
                            }
                            if ($rating == '2') {
                                $sql202 = "INSERT INTO np_prod_vote(product_id, two_star) VALUES (?,1)";
                            }
                            if ($rating == '3') {
                                $sql202 = "INSERT INTO np_prod_vote(product_id, three_star) VALUES (?,1)";
                            }
                            if ($rating == '4') {
                                $sql202 = "INSERT INTO np_prod_vote(product_id, four_star) VALUES (?,1)";
                            }
                            if ($rating == '5') {
                                $sql202 = "INSERT INTO np_prod_vote(product_id, five_star) VALUES (?,1)";
                            }
                            $stmt202 = $conn->prepare($sql202);
                            $stmt202->bind_param("s", $refer_id);
                            $stmt202->execute();
                        }

                        $sql203 = "INSERT INTO np_comment(refer_id, comment_name, comment_detail, comment_type) ";
                        $sql203 .= " VALUES (?,?,?,?)";
                        $stmt203 = $conn->prepare($sql203);
                        $stmt203->bind_param("ssss", $refer_id, $comment_name, $comment_detail, $comment_type);
                        $stmt203->execute();

                        $message = "(<span style='color: red'>C???m ??n b???n ???? g???i ????nh gi?? c???a m??nh. Ch??ng t??i s??? tr??? l???i trong th???i gian s???m nh???t</span>)";
                    }
                }
                ?>
						<div class="share-box-comment top-box-comments" id="rate-box">
							<div class="title-rated-prod">Chia s??? nh???n x??t c???a b???n <?=$message?></div>
						<form id="rate-form" method="post" novalidate="novalidate" action="#comment-box">
							<div class="body-share-comment" id="cmt-step1">
								<div class="txt-box-share">????nh gi?? c???a b???n</div>
								<div class="list-star-share">
									<fieldset class="rating-star">
										<input type="radio" class="rate-point" data-point="5"
											id="star5" name="rating" value="5"> <label class="full"
											for="star5" title="5 sao: Tuy???t v???i"><i class="fa fa-star"></i></label>
										<input type="radio" class="rate-point" data-point="4"
											id="star4" name="rating" value="4"> <label class="full"
											for="star4" title="4 sao: H??i l??ng"><i class="fa fa-star"></i></label>
										<input type="radio" class="rate-point" data-point="3"
											id="star3" name="rating" value="3"> <label class="full"
											for="star3" title="3 sao: B??nh th?????ng"><i class="fa fa-star"></i></label>
										<input type="radio" class="rate-point" data-point="2"
											id="star2" name="rating" value="2"> <label class="full"
											for="star2" title="2 sao: T???m ???????c"><i class="fa fa-star"></i></label>
										<input type="radio" class="rate-point" data-point="1"
											id="star1" name="rating" value="1"> <label class="full"
											for="star1" title="1 sao: Kh??ng th??ch"><i class="fa fa-star"></i></label>
									</fieldset>
								</div>
								<p>B???n ??ang b??n kho??n c???n t?? v???n? Vui l??ng ????? l???i s??? ??i???n tho???i
									ho???c l???i nh???n, Nganphat.com.vn s??? li??n h??? tr??? l???i b???n s???m nh???t.</p>
								<div class="input-content-comment">
									<textarea class="txt-input-comment" id="rate-content"
										name="rate-content"></textarea>
									<div
										data-placeholder="Nh???p c??u h???i / b??nh lu???n / nh???n x??t t???i ????y..."
										contenteditable="true"
										title="H??y cho bi???t nh???n x??t ????nh gi?? c???a b???n"
										class="rc-editor" id="rc-editor"><?=$comment_detail?></div>
									<script language="JavaScript" type="text/javascript">
                                        (function (w, d) {
                                            var rc_time = 0;
                                            d.addEventListener('keyup', function (e) {
                                                if (rc_time)
                                                    w.clearTimeout(rc_time);
                                                rc_time = w.setTimeout(function () {
                                                    if (e.target.id === 'rc-editor') {
                                                        var text = e.target.innerText;
                                                        if (text)
                                                            text = text.trim();
                                                        d.getElementById('rate-content').value = text;
                                                    }
                                                }, 100);
                                            })
                                        })(window, document);
                                    </script>
									<div class="form-complette-comment" id="popup-comment">
										<div class="form-comment-inner">
											<div class="row-comment-inner-form">
												<input type="hidden" value="" id="hdfCmtImg-0">
												<div class="txt-form-item">
													<span class="txt-form-item-left block">H??? v?? t??n:</span> <span
														class="txt-form-item-right block"> <input type="text"
														class="input-txt-cm name required"
														placeholder="Nh???p t??n c???a b???n" id="rate-name"
														name="rate-name" aria-required="true"
														title="* Vui l??ng nh???p t??n" value="<?=$comment_name?>">
													</span>
												</div>
												<input type="hidden" name="comment_type" value="1"> <input
													type="hidden" name="refer_id" value="<?=$slug_product_id?>">
												<button class="btn-send-content" id="btn-review-send"
													name="submit" value="G???i ????nh gi??">G???i ????nh gi??</button>
												<div class="list-img-upload-review"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
						<script type="text/javascript" lang="javascript">
        					function checkoutSubmit() {
        						document.getElementById("form_checkout_product").submit();
        					}
        					
        					// function supportSubmit() {
        					// 	var name = $('#mail_name').val();
             //                    var phone = $('#mail_phone').val();
             //                    var contact = $('#mail_contact').val();
             //                    var content = $('#mail_content').val();
             //                    var url = location.href;
             //                    $('#res_ajax').children().remove();
             //                    $.ajax({
             //                        url: "_sendMail.php",
             //                        type: "post",
             //                        data: {mail_name: name, mail_phone: phone, mail_contact:contact, mail_content: content, send_url: url} ,
             //                        success: function (response) {
             //                            response = JSON.parse(response)
             //                            console.log(response.message)
             //                            $('#res_ajax').append(response.message)
             //                            if (response.status == 'success') {
             //                                setTimeout(function() {
             //                                    $('#modal-close').click();
             //                                }, 1000);
             //                            }
             //                        },
             //                        error: function () {
             //                            $('#res_ajax').append("<span style='color: red'>* C?? l???i x???y ra. Vui l??ng th??? l???i.</span>")
             //                        }
             //                    });
        					// }
				
						</script>
					</div>

						<a id="anchor-comment"></a>
						<div class="tab-box-comment" id="rate-reviews" >
						<input type="radio" name="tabComment" title="B??nh lu???n" id="tab1" checked="" data-sort="1"> 
						<label for="tab1">B??nh lu???n</label>
						<section id="comment-1" class="rate-reviews-list">
						<?php 
    						$sql111 = "SELECT comment_id, refer_id, comment_title, comment_name, comment_email, ";
    						$sql111 .= " comment_detail , comment_status, comment_type, comment_index, comment_flow";
    						$sql111 .= "  FROM np_comment ";
    						$sql111 .= " WHERE refer_id = '" . $home_product_id . "' AND comment_index = '1' AND comment_type = '1' AND comment_status = '1'";
    						$sql111 .= "  AND  delete_flag = '0'  ";
    						$sql111 .= "  ORDER BY  comment_id ";
    						
    						$result111 = $conn->query($sql111);
    						if ($result111->num_rows > 0) {
    						    while ($row111 = $result111->fetch_assoc()) {
						?>
<!-- ------------------- -->
								<div data-id="<?=$row111['comment_id']?>" id="review-item-<?=$row111['comment_id']?>"
									class="comment-row-item view-comments-item level1"
									data-fname="petro times">
									<div class="comment-user-name">
										<div class="comment-item-left block">
											<span class="sort-name-cm"><?=strtoupper(substr(Common::stripVN($row111['comment_name']),0,1))?></span> <span
												class="full-name-cm ava-name user-normal"><?=$row111['comment_name']?></span>
										</div>
									</div>
									<div class="comment-user-body">
										<div class="comment-ask-box level1">
											<div class="comment-ask"><?=$row111['comment_detail']?></div>

											<div class="relate-comment">
<!-- 												<input class="rep-comment relate-com-item" value="<?=$row111['comment_id']?>"
													id="reply-comment-<?=$row111['comment_id']?>" type="radio" name="rdo-reply"> <label
													for="reply-comment-<?=$row111['comment_id']?>"><span></span>Tr??? l???i</label>

												<div class="like-comment block">
													<i class="fa fa-thumbs-o-up"></i><a
														href="https://nganphat.com.vnmay-pha-ca-phe-espresso-tiross-ts-621-p10195#"
														class="review-like rvw-lk-363595" data-id="363595">Th??ch</a>
												</div>
												<div class="time-comment block">
													<span title="12:06 14-01-2021">1 th??ng</span>
												</div>
												<div class="more-info-checked"
													id="reply-comment-363595-form"></div>
	 -->
	 												
											</div>
										</div>
										
										<?php 
                    						$sql112 = "SELECT comment_id, refer_id, comment_title, comment_name, comment_email, ";
                    						$sql112 .= " comment_detail , comment_status, comment_type, comment_index, comment_flow";
                    						$sql112 .= " FROM np_comment ";
                    						$sql112 .= " WHERE comment_flow = '" . $row111['comment_id'] . "' AND comment_index <> '1' AND comment_status = '1' ";
                    						$sql112 .= " AND  delete_flag = '0'  ";
                    						$sql111 .= " ORDER BY  comment_index ";
                    						
                    						$result112 = $conn->query($sql112);
                    						if ($result112->num_rows > 0) {
                    						    while ($row112 = $result112->fetch_assoc()) {
                						?>
										<!-- ------------------- -->
										<div data-id="<?=$row111['comment_id']?>"
											class="comment-ask-box member-rep level2">
											<div class="comment-replied">
												<div class="ava-name user-staff"><?=$row112['comment_name']?></div>
												<div class="show-replied">
													<?=$row112['comment_detail']?>
												</div>
											</div>
											<div class="relate-comment">
<!-- 												<input class="rep-comment relate-com-item" value="<?=$row111['comment_id']?>"
													id="reply-comment-<?=$row111['comment_id']?>" type="radio" name="rdo-reply"> 
													<label for="reply-comment-<?=$row111['comment_id']?>"><span></span>Tr??? l???i</label>

												<div class="like-comment block">
													<i class="fa fa-thumbs-o-up"></i><a
														href="https://nganphat.com.vnmay-pha-ca-phe-espresso-tiross-ts-621-p10195#"
														class="review-like rvw-lk-363621" data-id="363621">Th??ch</a>
												</div>
												<div class="time-comment block">
													<span title="15:56 14-01-2021">1 th??ng</span>
												</div>
												<div class="more-info-checked"
													id="reply-comment-363621-form"></div>
 -->													
											</div>
										</div>
										<!-- ------------------- -->
										<?php 
                    						    }
                    						}
										?>
										
									</div>
								</div>
<!-- ------------------- -->
						<?php 
						    }
						}
						?>
						</section>
						<section id="comment-2" class="rate-reviews-list" data-sort="2"
							data-loaded="0">
							<div class="comment-wrap comment-new" id="list-comment-2"></div>
						</section>
					</div>


					</div>
				</div>

				<div class="view-more-tags-wrap">
					<div class="title-view-more-tags">T??m th??m</div>
					<div class="a-desc-more">
					<ul class="list-more-cat-detail">
						<li class="list-more-cat-d-item">
							<a href="<?=$pmk_group_link?>" title="<?=$name_group_link?>"><?=$name_group_link?></a>
						</li>
					</ul>
					</div>
					<div class="box-view-prod-tags">
						<ul class="tags-prod">
						<?php 
						$sqltag = "SELECT A.tag_name, C.permalink ";
						$sqltag .= " FROM np_prod_tag A ";
						$sqltag .= " INNER JOIN tag_product D ON A.tag_id = D.tag_id ";
						$sqltag .= " INNER JOIN np_product B ON D.product_id = B.product_id ";
						$sqltag .= " INNER JOIN np_permalink C ON A.data_id = C.data_id ";
						$sqltag .= " WHERE  B.product_id = '$home_product_id' ";
						$sqltag .= " AND  A.delete_flag = '0' ";
						
						$result_tag = $conn->query($sqltag);
						if ($result_tag->num_rows > 0) {
						    while ($rowtag = $result_tag->fetch_assoc()) {
						?>
						
						<li class="tags-item"><a
							href="<?=$rowtag['permalink']?>"><i
								class="fa fa-tags"></i><?=$rowtag['tag_name']?></a></li>
								
						<?php 
						    }
						}
						?>
						
					</ul>
					</div>
				</div>
			</section>
			
			
			<?php 
                    }
                }
			?>

			<!--Phan hien thi San pham cung thuong hieu-->
			<?php include '_productcontent_mb_sameBrand.php';?>
            <!--Phan hien thi San pham ???? xem-->
			<?php include '_productcontent_mb_viewed.php';?>
			<!--Phan hien thi Ho tro va dich vu-->

		</div>
	</section>

	<?php include 'common_footer_mb.php';?>
</body>
</html>
