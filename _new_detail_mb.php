<!DOCTYPE html>
<html lang="vi">
<head>

<?php include 'common_headermeta_mb.php';?>

<link rel=stylesheet media=all type=text/css
	href="template/css/np_mb.css" />
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/header-home.min.css">
<link type="text/css" rel="stylesheet"
	href="template/css/css_hotro.css" />
<style type="text/css">
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
<body id="detail">

	<?php  include 'common_top_ads.php'; ?>
	<?php  include 'common_topmenu_mb_homepage.php'; ?>

	
	<div id="center-m" class="htProduct active"
		style="height: auto !important;">
		<div class="wrap" style="height: auto !important;">
			<div class="center-body-support" style="height: auto !important;">
				<div class="S-content-center" style="height: auto !important;">
					<div class="s-content-detail" style="height: auto !important;">
						
						<?php include '_new_detail_mb_slug.php';?>
<?php 
	$page_group_id = '';
	$sql25 = "SELECT A.page_id, A.page_group_id, A.page_name, A.page_description, A.page_content, A.insert_user ";
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
	                $lstPageRead[] = $row25['page_id'];
	                $_SESSION[Common::$SESSION_USER_READ_PAGE] = $lstPageRead;
	                
	                $sql251 = " UPDATE np_page SET page_count_view = page_count_view + 1 WHERE page_id = '$page_id' ";
	                $stmt251 = $conn->prepare($sql251);
	                $stmt251->execute();
	            }
	            
	        } else {
	            $lstPageRead = array();
	            $lstPageRead[] = $row25['page_id'];
	            $_SESSION[Common::$SESSION_USER_READ_PAGE] = $lstPageRead;
	            
	            $sql251 = " UPDATE np_page SET page_count_view = page_count_view + 1 WHERE page_id = '$page_id' ";
	            $stmt251 = $conn->prepare($sql251);
	            $stmt251->execute();
	        }
	        
	        $page_group_id = $row25['page_group_id'];
?>	
						<section class="s-wrap-Article" style="height: auto !important;">
							<article style="height: auto !important;">
								<h1 class="article-title"><?=$row25['page_name']?></h1>
								<div class="article-count">
									<i class="fa fa-user"></i> <span><?=$row25['page_count_view']?> lượt xem</span>
								</div>
								<section class="s-content-article" style="height: auto !important;">
								<?=$row25['page_content']?>
								</section>
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
								
								<div class="s-share" id="s-share">
									<div class="bar-share-s">
										<span class="icon-share-s"> <img
											src="template/images/share-16.png"
											title="Chia sẻ bài viết" alt="☁"></span> <span>Đừng quên chia
											sẻ bài viết nhé!</span>
									</div>
									<div class="list-share">
										<ul>
											<li class="list-share-item facebook"><a target="blank"
												href="https://www.facebook.com/share.php?title=<?=$row25['page_name']?>&u=<?=Common::$_HOME_PAGE?>/<?=$row25['permalink']?>"
												title="Chia sẻ trên Facebook" class="sd-button-s"><span>Facebook</span></a></li>
											<li class="list-share-item linkedin"><a target="blank
												href="https://www.linkedin.com/shareArticle?mini=true&title=<?=$row25['page_name']?>&url=<?=Common::$_HOME_PAGE?>/<?=$row25['permalink']?>"
												title="Chia sẻ trên Linkedin" class="sd-button-s"><span>Linkedin</span></a></li>
											<li class="list-share-item twitter"><a target="blank
												href="https://twitter.com/intent/tweet?url=<?=Common::$_HOME_PAGE?>/<?=$row25['permalink']?>&text=<?=$row25['page_name']?>&original_referer=<?=Common::$_HOME_PAGE?>/<?=$row25['permalink']?>"
												title="Chia sẻ trên Twitter" class="sd-button-s"><span>Twitter</span></a></li>
											<li class="list-share-item pinterest"><a target="blank
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
											href="/hotro/t/ship-cod-nghia-la-gi"><i class="fa fa-tags"></i>Ship
												COD nghĩa là gì</a></li>
										<li class="tags-s-item"><a href="/hotro/t/ship-cod"><i
												class="fa fa-tags"></i>ship cod</a></li>
										<li class="tags-s-item"><a href="/hotro/t/ship-cod-toan-quoc"><i
												class="fa fa-tags"></i>ship cod toàn quốc</a></li>
										<li class="tags-s-item"><a href="/hotro/t/giao-hang-cod"><i
												class="fa fa-tags"></i>giao hàng cod</a></li>
										<li class="tags-s-item"><a href="/hotro/t/phi-ship-cod"><i
												class="fa fa-tags"></i>phí ship cod</a></li>
										<li class="tags-s-item"><a href="/hotro/t/cach-ship-cod"><i
												class="fa fa-tags"></i>cách ship cod</a></li>
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
				<aside class="S-content-right">
					<div class="most-new-related">
						<div class="most-read-title">Tin liên quan</div>
						<ul class="most-read-list">
							<?php 
    						$sql35 = "SELECT A.page_id, A.page_name, B.permalink FROM np_page A ";
    						$sql35 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
    						$sql35 .= " WHERE A.page_group_id = '$page_group_id' AND B.delete_flag = '0'";
    						$sql35 .= " ORDER BY A.insert_datetime DESC ";
    						$sql35 .= " LIMIT 5 ";
            				
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

				</aside>

			</div>
		</div>
	</div>
	<?php include 'common_footer_mb.php';?>
</body>
</html>
