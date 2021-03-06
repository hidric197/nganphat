<!DOCTYPE html>
<html lang="vi">
<head>

<?php 
    include 'npad/lib/gmail/Mail.php';
    include 'common_headermeta_mb.php';
?>

<link rel=stylesheet media=all type=text/css
	href="template/css/np.css" />
<link rel=stylesheet media=all type=text/css
	href="template/css/header.min.css" />

<link rel=stylesheet media=all type=text/css
	href="template/css/checkout-beta.css" />
<link rel=stylesheet media=all type=text/css
	href="template/css/swiper.min.css"/>
	
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/header-home.min.css">
<link rel=stylesheet media=all type=text/css
	href="template/css/np_mb.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body id="checkout">
<?php
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
	
	if (isset($_POST['del_prod_id']) && !empty($_POST['del_prod_id'])) {
	   
	    $numberProd = sizeof($checkout_info);
	    $del_prod_id = $_POST['del_prod_id'];
	    
	    if ($numberProd > 0) {
	        foreach ($checkout_info as $itemInfo) {
	            if ($del_prod_id == $itemInfo[0]) {
	                continue;
	            }
	            $checkout_returnInfo[] = $itemInfo;
	        }
	        $_SESSION[Common::$_SESSION_CHECKOUT_INFO] = $checkout_returnInfo;
	    }
	}
	
	if (isset($_POST['reset_cart'])) {
	    if (isset($_POST['list_checkout_product_id'])) {
    	    $list_checkout_product_id = $_POST['list_checkout_product_id'];
    	    $list_txtQty = $_POST['list_txtQty'];
    	    $n = 0;
    	    foreach ($list_checkout_product_id as $id) {
    	        $checkout_item[0] = $id;
    	        $checkout_item[1] = $list_txtQty[$n];
    	        $n ++;
    	        
    	        $checkout_returnInfo[] = $checkout_item;
    	    }
    	    $_SESSION[Common::$_SESSION_CHECKOUT_INFO] = $checkout_returnInfo;
	    }
	}
	$message = '';
	$checkout_fullname = '';
	$checkout_phone = '';
	$checkout_email = '';
	$checkout_address = '';
	$checkout_other = '';
	if (isset($_POST['submit_cart'])) {
	    if (!isset($_POST['list_checkout_product_id'])) {
	        
	        $message = "<span style='color: red'>* B???n ch??a c?? th??ng tin s???n ph???m mua</span>";
	        
	    } else {
	        $list_checkout_product_id = $_POST['list_checkout_product_id'];
	        $list_txtQty = $_POST['list_txtQty'];
	        $checkout_fullname = $_POST['checkout_fullname'];
	        $checkout_phone = $_POST['checkout_phone'];
	        $checkout_email = $_POST['checkout_email'];
	        $checkout_address = $_POST['checkout_address'];
	        $checkout_other = $_POST['checkout_other'];
	        
	        if (empty($checkout_fullname) || empty($checkout_phone) 
	            || empty($checkout_email) || empty($checkout_address) 
	               || empty($checkout_other)){
	             $message = "<span style='color: red'>* B???n h??y nh???p ????? th??ng tin. Ch??ng t???i s??? li??n l???c l???i.</span>";
	        } else if (!Common::isPhoneNumber($checkout_phone)) {
	            $message = "<span style='color: red'>* B???n nh???p sai tr?????ng S??? ??i???n Tho???i. H??y nh???p l???i.</span>";
	        } else if (!Common::isEmail($checkout_email)) {
	            $message = "<span style='color: red'>* B???n nh???p sai tr?????ng Email. H??y nh???p l???i.</span>";
	        } else {

        	    // Add lai session
        	    $n = 0;
        	    foreach ($list_checkout_product_id as $id) {
        	        $checkout_item[0] = $id;
        	        $checkout_item[1] = $list_txtQty[$n];
        	        $n ++;
        	        
        	        $checkout_returnInfo[] = $checkout_item;
        	    }
        	    $_SESSION[Common::$_SESSION_CHECKOUT_INFO] = $checkout_returnInfo;
        	    // dang ky DB
        	    $sql = "INSERT INTO np_order (order_full_name, order_phone, order_email, order_address, order_other) VALUES (?, ?, ?, ?, ?)";
        	    $stmt = $conn->prepare($sql);
        	    $stmt->bind_param("sssss", $checkout_fullname, $checkout_phone, $checkout_email, $checkout_address, $checkout_other);
        	    $stmt->execute();
        	    
        	    $orderId = NpPermaLinkDba::getMaxOrderId($conn);
        	    $n = 0;
        	    foreach ($list_checkout_product_id as $id) {
        	        $sql = "INSERT INTO order_product (order_id, product_id, order_quality) VALUES (?, ?, ?)";
        	        $stmt = $conn->prepare($sql);
        	        $stmt->bind_param("sss", $orderId, $id, $list_txtQty[$n]);
        	        $stmt->execute();
        
        	        $n ++;
        	    }
        	    
        	    // Send Mail
        	    $titleMail = 'Th??ng Tin ????n H??ng Tr??n Nganphat.com.vn';
        	    $bodyMail = 'Xin ch??o ' . $checkout_fullname . ' !<br><br>';
        	    $bodyMail .= 'Th??ng tin ????n ?????t h??ng c???a b???n nh?? sau : <br>';
        	    $bodyMail .= 'T??n Kh??ch H??ng : ' .$checkout_fullname. '<br>';
        	    $bodyMail .= 'S??? ??i???n Tho???i : ' .$checkout_phone. '<br>';
        	    $bodyMail .= '?????a Ch??? : ' .$checkout_address. '<br>';
        	    $bodyMail .= 'Y??u C???u : ' .$checkout_other. '<br><br>';
        	    
        	    $bodyMail .= 'T???ng s??? s???n ph???m : ' .sizeof($list_checkout_product_id). '<br>';
        	    
        	    
        	    Mail::send($checkout_email, $checkout_fullname, Common::$_NP_MAIL, $titleMail, $bodyMail);
        	    
        	    // xong th?? b??? session n??y ??i
        	    unset($_SESSION[Common::$_SESSION_CHECKOUT_INFO]);
        	    $message = "<span style='color: red'>* C??m ??n b???n ???? ?????t h??ng. Ch??ng t??i s??? li??n l???c v???i b???n s???m nh???t.</span>";
	        }
	    }
	}
	///  Lay session de select
	if (isset($_SESSION[Common::$_SESSION_CHECKOUT_INFO])) {
	    $checkout_info = $_SESSION[Common::$_SESSION_CHECKOUT_INFO];
	}
?>
<?php  include 'common_top_ads.php'; ?>
<?php  include 'common_topmenu_mb_homepage.php'; ?>
	<section id="center-m" data-step="0">
		<form method="post" action="" name="checkout_form" id="checkout_form">
			<div class="wrap" id="checkout-info">
				<div class="breadcrum-cat" style="margin-top: 5px"><a href="<?=Common::$_HOME_PAGE?>" class="show-more">
					<i class="fa fa-angle-left"></i>&nbsp;Ch???n th??m s???n ph???m kh??c</a>
				</div>
				<div class="wrap-checkout step1">
					<div id="ctl00_pageBody_ajxPanel" class="checkout-info-panel">
						<div id="ctl00_pageBody_ajxProducts"
							class="checkout-info-products">
							<div class="checkout-info-box product" id="cart-items">
								<div class="checkout-info-body">
								<!-- 
									<div class="checkout-info-body-title">
										<div class="checkout-info-title-col pro">S???n ph???m</div>
										<div class="checkout-info-title-col amo">S??? l?????ng</div>
										<div class="checkout-info-title-col price">????n gi??</div>
										<div class="checkout-info-title-col sum">Th??nh ti???n</div>
									</div>
                                 -->
									<div class="checkout-info-body-detail" style="margin-top:50px">
										<ul class="list-product-checkout">
									<?php 
										$totalMoney = 0;
										foreach ($checkout_info as $itemInfo) {
										    $productId = $itemInfo[0];
										    $sqlCo = "SELECT B.permalink AS prd_permalink, B.data_table";
										    $sqlCo .= ", A.product_id, A.product_name, A.product_code, A.product_old_price, A.product_down_price, A.product_sell_price ";
										    $sqlCo .= " , E.image_title, E.image_url ";
										    $sqlCo .= " FROM np_product A ";
										    $sqlCo .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
										    $sqlCo .= " INNER JOIN np_prod_image E ON A.product_id = E.product_id AND E.image_type = '1' ";
										    $sqlCo .= " WHERE  A.product_id = '" .$productId. "' ";
										    $sqlCo .= " AND  A.delete_flag = '0' ";
										    $sqlCo .= " GROUP BY  A.product_id";
										    
										    $resultCo = $conn->query($sqlCo);
										    if ($resultCo->num_rows > 0) {
										        while ($rowCo = $resultCo->fetch_assoc()) {
										            $totalMoney += ($rowCo['product_sell_price'] * $itemInfo[1]);
										            
										?>
											<li class="product-checkout-item">
											<table>
    											<tr>
        											<td width="20%">
        												<div class="product-checkout-item-thumb">
        													<a target='_blank' href="<?=$rowCo['prd_permalink']?>"> <img
        															src="npad/<?=$rowCo['image_url']?>"></a>
        												</div>
        											</td>
        											<td width="80%">
        												<div class="product-checkout-item-right">
        												<table>
                											<tr>
                    											<td>
                													<div class="product-checkout-item-name">
                														<a target='_blank' href="<?=$rowCo['prd_permalink']?>"><?=$rowCo['product_name']?></a>
                													</div>
                												</td>
            												</tr>
            												<tr>	
                												<td>
                													<div class="product-checkout-item-price-among" >
																		<table>      
																		<tr>
																		<td>         														
                    														<div class="product-checkout-item-among" ">
                            														<table class="select-among">
                            															<tbody>
                            																<tr>
                            																	<td class="input-group-btn">
                            																		<button class="btn-among down"
                            																			onclick="return change_qty_detail('qty_<?=$productId?>',-1, <?=$rowCo['product_sell_price']?>)">-</button>
                            																	</td>
                            																	<td class="input-txt-among">
                            																	<input type="text" class="form-among txtQty-cart"
                            																		title="Thay ?????i s??? l?????ng n???u b???n mu???n" placeholder="S??? l?????ng" name="list_txtQty[]"
                            																			id="qty_<?=$productId?>" step="1" min="1" max="500" aria-valuemin="1"
                            																		aria-valuemax="500" value="<?=$itemInfo[1]?>" />
                            																	<input type="hidden" name="list_checkout_product_id[]" id="list_checkout_product_id" value="<?=$productId?>">
                            													
                            																		</td>
                            																	<td class="input-group-btn">
                            																		<button class="btn-among up"
                            																			onclick="return change_qty_detail('qty_<?=$productId?>',1, <?=$rowCo['product_sell_price']?>)">+</button>
                            																	</td>
                            																</tr>
                            															</tbody>
                            														</table>
                        														</div>
                    														</td>
                    														<td>
                        														<div class="product-checkout-item-price">
                        															<span class="price-sale"><?=Common::convertMoney($rowCo['product_sell_price'])?></span>
                        														</div>
                    														</td>
                    														<td>
                        														<div class="product-checkout-item-del">
                        															<span style="cursor: pointer" title="Xo?? <?=$rowCo['product_name']?> kh???i gi??? h??ng?" 
                            															class="lnk-cart-item-rem">
                            															<i class="fa fa-trash-o" onclick="delProdOnCart('<?=$productId?>');"></i>
                            														</span>
                        														</div>
                    														</td>
                    														</tr> 
                														</table>
                													</div>
                												</td>
                											</tr>
                										</table>
        												</div>
    												</td>
												</tr>
											</table>
											</li>
										
										<?php 
										        }
										    }
										}
                                       ?>
                                       
										</ul>
										<input type="hidden" name="del_prod_id" id="del_prod_id" value="">
										<script language="JavaScript" type="text/javascript">
                                            function change_qty_detail(id, step, price) {
                                                var $txt = $('#' + id);
                                                var min = parseInt($txt.attr('min'));
                                                var number = parseInt($txt.val()) + step;
                                                if (number < min) {
                                                    number = min;
                                                    alert('M???t h??ng n??y ph???i ?????t t??? ' + min + ' s???n ph???m tr??? l??n!');
                                                }
                                                $txt.val(number > 1 ? number : 1);
                                                $txt.trigger('modified');
                                                var total_price = $('#total_price').text((price*number).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + ' ??')
												$('input[name=reset_cart]').click()
                                                return false;
                                            }
                                            
                                            function delProdOnCart(prodId) {
                                            	$('<div></div>').appendTo('body')
												    .html('<div><h6>B???n c?? ch???c ch???n th???c hi???n h??nh ?????ng n??y?</h6></div>')
												    .dialog({
												      modal: true,
												      title: 'C???nh b??o',
												      zIndex: 10000,
												      autoOpen: true,
												      width: 'auto',
												      resizable: false,
												      buttons: {
												        "X??c nh???n": function() {
												          	document.getElementById("del_prod_id").value = id;
															document.getElementById("checkout_form").submit();
												          	$(this).dialog("close");
												        },
												        "H???y": function() {
												          	$(this).dialog("close");
												        }
												      },
												      close: function(event, ui) {
												        $(this).remove();
												      }
												    });
											  	$('#myInput').trigger('focus')
                                            }
                                         </script>
										<div class="product-checkout-sumary">
											<div class="checkout-sumary">
												<!-- 
												<div class="checkout-sumary-row">
													<div class="checkout-sumary-left">Ti???n h??ng:</div>
													<div class="checkout-sumary-right">3.390.000??</div>
												</div>
												
											
												<div id="ctl00_pageBody_pnlDiscountRow"
													class="checkout-sumary-row bill-row">
													<div class="checkout-sumary-left">Gi???m gi??:</div>
													<div class="checkout-sumary-right">-100.000??</div>
												</div>
												<div class="checkout-sumary-row">
													<div class="checkout-sumary-left">V???n chuy???n:</div>
													<div class="checkout-sumary-right">
														Ch??a r?? <input type="hidden"
															name="ctl00$pageBody$hdnShipFee"
															id="ctl00_pageBody_hdnShipFee" value="0">
													</div>
												</div>
                                            -->
                                            	<div class="checkout-sumary-row" align="right">
													<input type="hidden" class="btn-login" name="reset_cart"
														value="L??m m???i gi??? h??ng" title="L??m m???i gi??? h??ng" style="width: 40%">
												</div>
												<div class="checkout-sumary-row total">
													<div class="checkout-sumary-left">T???ng ti???n:</div>
													<div class="checkout-sumary-right" id="total_price"><?=number_format($totalMoney)?>??</div>
												</div>
											</div>
											<br><br>
											
										<!-- 	
											<div class="choose-more mobile">
												<a href="#" class="show-more"><i class="fa fa-angle-left"></i>Ch???n th??m s???n ph???m kh??c</a>
												<div class="more-bg"></div>
												<div class="more-wrap">
													<ul>
														<li><a class="visited" href="/visited"><img
																src="/Data/image/2020/09/30/history.png"
																data-src="/Data/image/2020/09/30/history.png"
																class="lazy-img lazy-loaded">S???n ph???m ???? xem</a></li>
														<li><a href="/camera-hanh-trinh-c3408"><img
																src="/icons/cats/3408.png" class="lazy-img lazy-loaded"
																data-src="/icons/cats/3408.png">Camera h??nh tr??nh,
																Camera l??i</a></li>
														<li><a class="more-open-menu" href="#"><img
																src="/themes/meta.vn/images/icon-home-main-red.png"
																class="lazy-img">Danh m???c s???n ph???m</a></li>
													</ul>
												</div>
											</div>
										 -->
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="ctl00_pageBody_billinfo" class="checkout-info-box buyer">
							<div class="checkout-info-body">
								<div class="input-text-checkout-item">
									<span class="title-input-left ">H??? v?? t??n:</span> 
									<input name="checkout_fullname" type="text" id="checkout_fullname"
										class="account-input" placeholder="H??? v?? t??n"
										data-link="fullName" data-text="Nh???p h??? &amp; t??n"
										data-level="1" value="<?=$checkout_fullname?>" />
								</div>
								<div class="input-text-checkout-item">
									<span class="title-input-left">??i???n tho???i:</span> 
									<input name="checkout_phone" id="checkout_phone" class="account-input"
										placeholder="Nh???p s??? ??i???n tho???i" type="text" data-link="mobile"
										data-text="Cung c???p s??? ??i???n tho???i" data-level="1" value="<?=$checkout_phone?>" />
								</div>
								<div class="input-text-checkout-item">
									<span class="title-input-left">Email:</span> 
									<input name="checkout_email" id="checkout_email" class="account-input"
										placeholder="Nh???p email" type="text" data-link="mobile"
										data-text="Nh???p email" data-level="1" value="<?=$checkout_email?>" />
								</div>
								<div class="input-text-checkout-item">
									<span class="title-input-left">?????a ch??? :</span>
									<input type="text"  class="account-input" id="checkout_address" name="checkout_address"  
										placeholder="Nh???p ?????a ch??? nh???n h??ng" value="<?=$checkout_address?>" />
								</div>
								<div class="input-text-checkout-item">
									<span class="title-input-left">Y??u c???u kh??c:</span>
									<input type="text"  class="account-input" id="checkout_other" name="checkout_other" 
										placeholder="Nh???p th??m y??u c???u n???u c??" />
								</div>
							</div>
							<?=$message?>
							<br>
							<div class="Submit-checkout">
								<button class="style-submit-checkout"
									id="submit_cart" name="submit_cart" value="G???i ????n h??ng" onclick="validCheckoutOrder();">
									<i class="fa fa-shopping-cart"></i>G???i ????n h??ng
								</button>
							</div>
						</div>
					</div>
				</div>
				<!--Phan hien thi San pham da xem-->
			<?php include '_productcontent_mb_viewed.php';?>
			</div>
		</form>
	</section>
	<script language="JavaScript" type="text/javascript">

	function validCheckoutOrder() {
		var str = '';
	
        var val = document.forms['checkout_form']['checkout_fullname'].value;
        if (val == "") {
            str += 'H??? v?? T??n';
        }
        
        val = document.forms['checkout_form']['checkout_phone'].value;
        if (val == "") {
            str += '\n??i???n tho???i';
        }
        
        val = document.forms['checkout_form']['checkout_email'].value;
        if (val == "") {
            str += '\nEmail';
        }
        
        val = document.forms['checkout_form']['checkout_address'].value;
        if (val == "") {
            str += '\n?????a ch???';
        }
        
        if (str != '') {
        	alert('C??c tr?????ng b??n d?????i c???n ph???i nh???p : \n' + str);
        	return false;
        } else {
        	document.getElementById("checkout_form").submit();
        }
	}
</script>
	<?php include 'common_footer_mb.php';?>
</body>
</html>
