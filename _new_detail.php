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


	<div id="center-m" class="htProduct" style="height: auto !important;">
		<div class="wrap" style="height: auto !important;">
			<div class="center-body-support" style="height: auto !important;">



				<style>
.prod-viewed-wrap, .prod-viewed, .txt-thumb-view {
	width: auto;
}

.prod-viewed-wrap {
	position: relative;
	margin: 5px 0;
}

.row-prod {
	width: 48%;
	border: none;
	display: table-row;
}

.row-prod>span {
	float: unset;
	display: table-cell;
	vertical-align: top;
}

.prod-viewed h2 {
	position: absolute;
	z-index: 100;
	right: 0;
	bottom: 0;
	margin: 0 !important;
	padding: 0 5px !important;
	font-size: 1em;
	line-height: 23px;
	background: #ddd;
	border-radius: 5px 0 0 0;
	font-weight: normal;
}

.txt-thumb-view p:first-child {
	font-weight: unset;
}

@media ( max-width :500px) {
	.row-prod {
		width: unset;
	}
}

.feedTag {
	float: right;
	font-size: 11px;
}

.s-product-related-item {
	align-items: stretch !important;
	text-align: left;
	box-sizing: border-box;
	font-size: unset;
	font-weight: normal;
}

.s-p-right a {
	font-weight: normal;
}

.adslot-1 {
	display: block;
	margin-bottom: 20px
}
</style>

				<div class="S-content-center" style="height: auto !important; width: 70%">
					<div class="s-content-detail" style="height: auto !important;">
	<?php 
	$page_group_id = '';
	$page_id = '';
	$user_id = '';
	$sql25 = "SELECT A.page_id, A.page_group_id, A.page_name, A.page_description, A.page_content, A.insert_user, A.image_title, A.image_url ";
	$sql25 .= " , A.page_count_view, B.permalink ";
	$sql25 .= " FROM np_page A ";
	$sql25 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
	$sql25 .= " WHERE B.permalink = '$home_estr_pmk' AND A.delete_flag = '0' ";
	$result25 = $conn->query($sql25);
	if ($result25->num_rows > 0) {
	    while ($row25 = $result25->fetch_assoc()) {
            
	        $user_id = $row25['insert_user'];
	        $page_id = $row25['page_id'];
	        
	        // Tang so lan doc page
	        // Truong hop dan vao doc roi
	        if (isset($_SESSION[Common::$SESSION_USER_READ_PAGE]) && !empty($_SESSION[Common::$SESSION_USER_READ_PAGE])) {
	            $lstPageRead = $_SESSION[Common::$SESSION_USER_READ_PAGE];
	            $isRead = false; 
	            foreach($lstPageRead as $pageid) {
	                if ($pageid == $page_id) {
	                    $isRead = true;
	                    break;
	                }
	            }
	            
	            if (!$isRead) {
	                $lstPageRead[] = $page_id;
	                $_SESSION[Common::$SESSION_USER_READ_PAGE] = $lstPageRead;
	                
	                $sql251 = " UPDATE np_page SET page_count_view = page_count_view + 1 WHERE page_id = '$page_id' ";
	                $stmt251 = $conn->prepare($sql251);
	                $stmt251->execute();
	            }
	         
	        // Truong hop vao lan dau
	        } else {
	            $lstPageRead = array();
	            $lstPageRead[] = $page_id;
	            $_SESSION[Common::$SESSION_USER_READ_PAGE] = $lstPageRead;
	            
	            $sql251 = " UPDATE np_page SET page_count_view = page_count_view + 1 WHERE page_id = '$page_id' ";
	            $stmt251 = $conn->prepare($sql251);
	            $stmt251->execute();
	        }
	        
	        $page_group_id = $row25['page_group_id'];
	?>			
						<meta property="og:url" content="<?=Common::$_HOME_PAGE?>/<?=$row25['permalink']?>" />
                        <meta property="og:type" content="article" />
                        <meta property="og:title" content="<?=$row25['page_name']?>" />
                        <meta property="og:description" content="<?=$row25['page_description']?>" />
						<meta property="og:image" content="<?=Common::$_HOME_PAGE?>/npad/<?=$row25['image_url']?>" />
						
						<section class="s-wrap-Article" style="height: auto !important;">
							<article style="height: auto !important;">
								<h1 class="article-title"><?=$row25['page_name']?></h1>
								<div class="article-count">
									<i class="fa fa-user"></i> <span><?=$row25['page_count_view']?> lượt xem</span>
								</div>
								<div>
								
								</div>
								<?=$row25['page_content']?>

								<br>
								
								<?php 
								$sql255 = "SELECT * FROM np_user ";
								$sql255 .= " WHERE user_id = '$user_id' ";
								$result255 = $conn->query($sql255);
								if ($result255->num_rows > 0) {
								    while ($row255 = $result255->fetch_assoc()) {
								?>							
								<div class="detail-comment-wrap" id="wrap-comment" style="border: 1px solid #eee;">
									<h4><b><?=$row255['user_full_name']?></b></h4>
									<?=$row255['user_info']?>
								</div>
								<?php 
								    }
								}
								?>
								<br>
								
								<div class="s-share" id='s-share'>
									<div class="bar-share-s">
										<span class="icon-share-s"> <img
											src="template/images/share-16.png" title="Chia sẻ bài viết"
											alt="☁"></span> <span>Đừng quên chia sẻ bài viết nhé!</span>
									</div>
									<div class="list-share">
										<ul>
											<li class="list-share-item facebook"><a
												href="https://www.facebook.com/share.php?title=<?=$row25['page_name']?>&u=<?=Common::$_HOME_PAGE?>/<?=$row25['permalink']?>"
												title="Chia sẻ trên Facebook" class="sd-button-s"><span>Facebook</span></a></li>
											<li class="list-share-item linkedin"><a
												href="https://www.linkedin.com/shareArticle?mini=true&title=<?=$row25['page_name']?>&url=<?=Common::$_HOME_PAGE?>/<?=$row25['permalink']?>"
												title="Chia sẻ trên Linkedin" class="sd-button-s"><span>Linkedin</span></a></li>
											<li class="list-share-item twitter"><a
												href="https://twitter.com/intent/tweet?url=<?=Common::$_HOME_PAGE?>/<?=$row25['permalink']?>&text=<?=$row25['page_name']?>&original_referer=<?=Common::$_HOME_PAGE?>/<?=$row25['permalink']?>"
												title="Chia sẻ trên Twitter" class="sd-button-s"><span>Twitter</span></a></li>
											<li class="list-share-item pinterest"><a
												href="https://pinterest.com/pin/create/button/?url=<?=Common::$_HOME_PAGE?>/<?=$row25['permalink']?>&description=<?=$row25['page_name']?>"
												title="Chia sẻ trên Pinterest" class="sd-button-s"><span>Pinterest</span></a></li>
										</ul>
									</div>
								</div>
<!-- 
								<div class="s-detail-tags">
									<div class="s-detail-tags-title">Tìm thêm:</div>
									<ul class="list-tags-s">
										<li class="tags-s-item"><a
											href="https://nganphat.com.vn/hotro/t/cach-lam-nuoc-dau-den-rang"><i
												class="fa fa-tags"></i>Cách làm nước đậu đen rang</a></li>
										<li class="tags-s-item"><a
											href="https://nganphat.com.vn/hotro/t/tac-dung-cua-nuoc-dau-den-rang"><i
												class="fa fa-tags"></i>tác dụng của nước đậu đen rang</a></li>
										<li class="tags-s-item"><a
											href="https://nganphat.com.vn/hotro/t/uong-nuoc-dau-den-rang-co-tac-dung-gi"><i
												class="fa fa-tags"></i>uống nước đậu đen rang có tác dụng gì</a></li>
									</ul>
								</div>
								
						 -->		
							</article>
						</section>
						
			<!-- ======================== -->
				<?php
                $message = '';
                if (isset($_POST['submit'])) {
                    $resultOK = 1;
                    if (! isset($_POST['rate-content']) || "" == $_POST['rate-content']) {
                        $resultOK = 0;
                    }
                    if (! isset($_POST['rate-name']) || "" == $_POST['rate-name']) {
                        $resultOK = 0;
                    }
                    if ($resultOK == 0) {
                        $message = "(<span style='color: red'>Bạn cần nhập đầy đủ thông tin đánh giá</span>)";
                    } else {
                        $comment_detail = $_POST['rate-content'];
                        $comment_name = $_POST['rate-name'];
                        $comment_type = $_POST['comment_type'];
                        $refer_id = $_POST['refer_id'];

                        $sql203 = "INSERT INTO np_comment(refer_id, comment_name, comment_detail, comment_type) ";
                        $sql203 .= " VALUES (?,?,?,?)";
                        $stmt203 = $conn->prepare($sql203);
                        $stmt203->bind_param("ssss", $refer_id, $comment_name, $comment_detail, $comment_type);
                        $stmt203->execute();

                        $message = "(<span style='color: red'>Cảm ơn bạn đã gửi đánh giá của mình. Chúng tôi sẽ trả lời trong thời gian sớm nhất</span>)";
                    }
                }
                ?>
						<div class="detail-comment-wrap" id="wrap-comment">
							<a name="comments" id="comments"></a>
							<div class="share-box-comment">
								<form id="rate-form" name="rate-form" method="post" action="#s-share">
									<div class="title-rated-prod">Chia sẻ nhận xét của bạn <?=$message?></div>
									<div class="body-share-comment">
										<div class="input-content-comment">
											<textarea class="txt-input-comment" id="rate-content" name="rate-content"
												placeholder="Nhập nội dung bình luận của bạn"
												title="Nhập nội dung bình luận của bạn"></textarea>
											<input type="text" class="input-txt-cm name required"
														placeholder="Nhập tên của bạn" id="rate-name"
														name="rate-name" aria-required="true"
														title="* Vui lòng nhập tên" value="" width="50%">
										</div><br>
										<div class="send-content-comment">
    										<input type="hidden" name="comment_type" value="2"> 
    										<input type="hidden" name="refer_id" value="<?=$page_id?>">
    										<button type="submit" class="btn-send-content" id="btn-review-send" 
    											onclick="document.getElementById('rate-form').submit()" 
    											name="submit" value="Gửi đánh giá">Gửi đánh giá</button>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-box-comment" id="rate-reviews" >
						<input type="radio" name="tabComment" title="Bình luận" id="tab1" checked="" data-sort="1"> 
						<label for="tab1">Bình luận</label>
						<section id="comment-1" class="rate-reviews-list">
						<?php 
    						$sql111 = "SELECT comment_id, refer_id, comment_title, comment_name, comment_email, ";
    						$sql111 .= " comment_detail , comment_status, comment_type, comment_index, comment_flow";
    						$sql111 .= "  FROM np_comment ";
    						$sql111 .= " WHERE refer_id = '" . $page_id . "' AND comment_index = '1' AND comment_type = '2' AND comment_status = '1'";
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
													for="reply-comment-<?=$row111['comment_id']?>"><span></span>Trả lời</label>

												<div class="like-comment block">
													<i class="fa fa-thumbs-o-up"></i><a
														href="https://nganphat.com.vnmay-pha-ca-phe-espresso-tiross-ts-621-p10195#"
														class="review-like rvw-lk-363595" data-id="363595">Thích</a>
												</div>
												<div class="time-comment block">
													<span title="12:06 14-01-2021">1 tháng</span>
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
													<label for="reply-comment-<?=$row111['comment_id']?>"><span></span>Trả lời</label>

												<div class="like-comment block">
													<i class="fa fa-thumbs-o-up"></i><a
														href="https://nganphat.com.vnmay-pha-ca-phe-espresso-tiross-ts-621-p10195#"
														class="review-like rvw-lk-363621" data-id="363621">Thích</a>
												</div>
												<div class="time-comment block">
													<span title="15:56 14-01-2021">1 tháng</span>
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
				<div class="view-more-tags-wrap">
				<div class="title-view-more-tags">Tìm thêm</div>
				<div class="box-view-prod-tags">
					<ul class="tags-prod">
						<?php 
						$sqltag = "SELECT A.tag_name, C.permalink ";
						$sqltag .= " FROM np_prod_tag A ";
						$sqltag .= " INNER JOIN tag_page D ON A.tag_id = D.tag_id ";
						$sqltag .= " INNER JOIN np_page B ON D.page_id = B.page_id ";
						$sqltag .= " INNER JOIN np_permalink C ON A.data_id = C.data_id ";
						$sqltag .= " WHERE  B.page_id = '$page_id' ";
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
						<!-- ======================== -->		
	<?php
    }
}
?>
						<div class="most-read-title">Đọc nhiều nhất</div>
						<ul class="most-read-list">
						<?php
    $sql35 = "SELECT A.page_id, A.page_name, B.permalink FROM np_page A ";
    $sql35 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
    $sql35 .= " WHERE A.page_group_id = '4' AND B.delete_flag = '0'";
    $sql35 .= " ORDER BY A.page_count_view DESC ";
    $sql35 .= " LIMIT 7 ";

    $result35 = $conn->query($sql35);
    if ($result35->num_rows > 0) {
        while ($row35 = $result35->fetch_assoc()) {
            ?>
							<li class="most-read-item"><a
								href="<?=$row35['permalink']?>"><?=$row35['page_name']?></a></li>
						<?php
        }
    }
    ?>
						</ul>



						<div class="most-new-related">
							<div class="most-read-title">Tin mới nhất</div>
							<ul class="most-read-list">
						<?php
    $sql35 = "SELECT A.page_id, A.page_name, B.permalink FROM np_page A ";
    $sql35 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
    $sql35 .= " WHERE A.page_group_id = '4' AND B.delete_flag = '0'";
    $sql35 .= " ORDER BY A.insert_datetime DESC ";
    $sql35 .= " LIMIT 7 ";

    $result35 = $conn->query($sql35);
    if ($result35->num_rows > 0) {
        while ($row35 = $result35->fetch_assoc()) {
            ?>
							<li class="most-read-item"><a
								href="<?=$row35['permalink']?>"><?=$row35['page_name']?></a></li>
						<?php
        }
    }
    ?>

							</ul>
						</div>

					</div>
				</div>

				<aside class="S-content-right" style="height: auto !important;">
					<div class="most-new-related">
						<div class="most-read-title">Tin liên quan</div>
						<ul class="most-read-list">

							<?php
    $sql35 = "SELECT A.page_id, A.page_name, B.permalink FROM np_page A ";
    $sql35 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
    $sql35 .= " WHERE A.page_group_id = '$page_group_id' AND B.delete_flag = '0'";
//     $sql35 .= " ORDER BY A.insert_datetime DESC ";
    $sql35 .= " LIMIT 7 ";

    $result35 = $conn->query($sql35);
    if ($result35->num_rows > 0) {
        while ($row35 = $result35->fetch_assoc()) {
            ?>
    							<li class="most-read-item"><a
    								href="<?=$row35['permalink']?>"><?=$row35['page_name']?></a></li>
    						<?php
        }
    }
    ?>

						</ul>
					</div>


					<aside class="s-product-related sticky" id="s-product-related"
						style="">
						<div class="s-product-related-header">Sản phẩm liên quan</div>

					<?php
    $sql = "SELECT B.permalink AS prd_permalink, B.data_table";
    $sql .= ", A.product_id, A.product_name, A.product_code ";
    $sql .= " , A.product_old_price, A.product_down_price, A.product_sell_price ";
    $sql .= " , A.brand_id, C.brand_name ";
    $sql .= " , D.permalink AS brand_permalink ";
    $sql .= " , E.image_title, E.image_url ";
    $sql .= " FROM np_product A ";
    $sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
    $sql .= " LEFT OUTER JOIN np_prod_brand C ON A.brand_id = C.brand_id ";
    $sql .= " LEFT OUTER JOIN np_permalink D ON C.data_id = D.data_id ";
    $sql .= " INNER JOIN np_prod_image E ON A.product_id = E.product_id AND E.image_type = '1' ";
    $sql .= " INNER JOIN page_product X ON A.product_id = X.product_id ";
    $sql .= " WHERE  X.page_id  = '$page_id' ";

    $flashsaleproduct_result = $conn->query($sql);
    if ($flashsaleproduct_result->num_rows > 0) {
        $n = 0;
        while ($row = $flashsaleproduct_result->fetch_assoc()) {
            $n ++;
            ?>
						<div class="swiper-slide s-product-related-item">
							<div class="s-p-left">
								<div class="freeship-icon">
									<img class="lazy-img lazy-loaded"
										src="npad/<?=$row['image_url']?>"
										data-src="npad/<?=$row['image_url']?>">
								</div>
								<a
									href="<?=$row['prd_permalink']?>">
									<img
									src="npad/<?=$row['image_url']?>"
									alt="<?=$row['image_title']?>">
								</a>
							</div>
							<div class="s-p-right">
								<a
									href="<?=$row['prd_permalink']?>"
									title="<?=$row['product_name']?>" target="_blank"><?=$row['product_name']?></a>
								<div class="price-s-p">
									<span class="price-s-p-meta"><?=Common::convertMoney($row['product_sell_price'])?></span> <span
										class="price-s-p-old"><?=Common::convertMoney($row['product_old_price'])?></span>

								</div>
								<div class="buy-s-p">
									<a
										href="mua-hang">
										<img src="template/images/btnMua-s.png" alt="🛒">
									</a>
								</div>
							</div>
						</div>

					<?php
        }
    }
    ?>
					</aside>
				</aside>
			</div>
		</div>
	</div>

	<!-- Footer -->

<?php include 'common_footer.php';?>

</body>

</html>