
<div id="slogan-main">
	<div class="slogan-top"></div>

	<div class="slogan-body">
		<div class="wrap">
			<div class="row-slogan">
				<div class="slogan-item">
					<a href="bao-hanh-san-pham" target="_blank"> <span> 
						<span class="icon-slogan"> 
							<img height="35px" class="lazy-img" src="template/images/Cam-ket-chinh-hang.png"
								data-src="template/images/Cam-ket-chinh-hang.png" alt="Cam kết chính hãng">
						</span>
							<span class="service-name">Cam kết chính hãng</span>
					</span>
					</a>
				</div>
				
				<div class="slogan-item">
					<a href="trung-tam-ho-tro" target="_blank"> <span> 
						<span class="icon-slogan"> 
							<img height="35px" class="lazy-img" src="template/images/Chiet-khau-hap-dan.png"
								data-src="template/images/Chiet-khau-hap-dan.png" alt="Chiết khấu hấp dẫn">
						</span>
							<span class="service-name">Chiết khấu hấp dẫn</span>
					</span>
					</a>
				</div>

				<div class="slogan-item">
					<a href="chinh-sach-giao-hang" target="_blank">
						<span> 
							<span class="icon-slogan"> 
								<img height="35px" class="lazy-img"
									src="template/images/Mien-phi-van-chuyen.png"
									data-src="template/Mien-phi-van-chuyen.png" alt="Miễn phí vận chuyển">
							</span>
							<span class="service-name">Miễn phí vận chuyển</span>
					</span>
					</a>
				</div>

				<div class="slogan-item">
					<a href="dieu-khoan-thanh-toan" target="_blank">
						<span> 
							<span class="icon-slogan"> 
								<img height="35px" class="lazy-img"
    								src="template/images/Thanh-toan-don-gian.png"
    								data-src="template/Thanh-toan-don-gian.png" alt="Thanh toán đơn giản">
							</span> 
						<span class="service-name">Thanh toán đơn giản</span>
					</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<a href="#" id="scrolltop" data-mobile="0" data-isadmin="0"><i
	class="fa fa-chevron-up"></i></a>
<footer id="footer-m">
	<div class="wrap">
		<div class="row-footer support">
			<div class="bar-row-title">Tổng đài tư vấn</div>
			<div class="body-supp">
				<div class="column-supp region">
					<div class="region-name">
						<i class="fa fa-phone-square"></i>Thiết bị vệ sinh &amp; Nhà bếp
					</div>
					<div class="region-phone">
						<span class="title-supp-pc">Điện thoại :</span><span><a
							href="tel:0983573166"> 0983 573 166 </a></span>
					</div>
					<div class="region-phone">
						<span class="title-supp-pc">Điện thoại :</span><span><a
							href="tel:0916950756"> 0916 950 756</a></span>
					</div>
				</div>
			</div>
		</div>
		<div class="row-footer connect">
			<div class="bar-row-title">Kết nối với chúng tôi</div>
			<div class="body-connect">
				<div class="box-social">
					<div class="social-item pinterest">
						<a href="#" rel="noreferrer nofollow"> 
							<img src="template/images/pinterest-icon.png" alt="pinterest">
							<div class="name-social">Pinterest</div>
						</a>
					</div>
					<div class="social-item facebook">
						<a href="#" rel="noreferrer nofollow"> 
							<img src="template//images/facebook-icon.png" alt="facebook">
							<div class="name-social">Facebook</div>
						</a>
					</div>
					<div class="social-item youtube">
						<a href="#" rel="noreferrer nofollow"> 
							<img src="template/images/youtube-icon.png" alt="youtube">
							<div class="name-social">Youtube</div>
						</a>
					</div>
				</div>
			</div>
		</div>


		<div class="row-footer info">
			<div class="brand-company">
				<div class="name-company">Công ty TNHH Xây dựng và Thương mại Ngân Phát</div>
				<div class="name-slogan">Kinh doanh Thiết bị vệ sinh, Thiết bị phòng
				bếp và Gạch ốp lát, luôn đem lại những lợi ích tốt nhất cho khách
				hàng.</div>
			</div>
			<div class="address-company">
				<div class="add-hn">
				<span class="add-footer"><strong>SHOWROOM THIẾT BỊ VỆ SINH & NHÀ BẾP</strong>
					17 Thanh Nhàn, Hai Bà Trưng, Hà Nội</span> <span class="phone-add"><strong>-
						Điện thoại:</strong><a href="tel:02436331159"> (024) 3633 1159</a></span>
    			</div>
    			<div class="email-add">
    				<b>Email:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=Common::$_NP_MAIL?>
    			</div>
			</div>

			<div class="info-another support-cust">
				<div class="title-row-info">
					Hỗ trợ khách hàng<span class="arrow-icon"></span>
				</div>
				<?php 
				$sql15 = "SELECT A.page_id, A.page_name, B.permalink FROM np_page A ";
				$sql15 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
				$sql15 .= " WHERE A.page_group_id = '1' AND B.delete_flag = '0'";
				$result15 = $conn->query($sql15);
				if ($result15->num_rows > 0) {
				?>
				<ul class="list-info-another">
					<?php
					while ($row15 = $result15->fetch_assoc()) {
					?>
					<li class="info-another-item">
						<a href="<?=$row15['permalink']?>" target="_blank"><?=$row15['page_name']?></a>
					</li>
					<?php 
					}
					?>
				</ul>
				<?php 
				}
				?>
			</div>
			<div class="info-another account-manager">
				<div class="title-row-info">
					Hướng dẫn thanh toán<span class="arrow-icon"></span>
				</div>
				<?php 
				$sql15 = "SELECT A.page_id, A.page_name, B.permalink FROM np_page A ";
				$sql15 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
				$sql15 .= " WHERE A.page_group_id = '2' AND B.delete_flag = '0'";
				$result15 = $conn->query($sql15);
				if ($result15->num_rows > 0) {
				?>
				<ul class="list-info-another">
					<?php
					while ($row15 = $result15->fetch_assoc()) {
					?>
					<li class="info-another-item">
						<a href="<?=$row15['permalink']?>" target="_blank"><?=$row15['page_name']?></a>
					</li>
					<?php 
    				}
    				?>
    			</ul>
				<?php 
				}
				?>
			</div>
			<div class="info-another about-meta">
				<div class="title-row-info">
					Về Nganphat.com.vn<span class="arrow-icon"></span>
				</div>
				<?php 
				$sql15 = "SELECT A.page_id, A.page_name, B.permalink FROM np_page A ";
				$sql15 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
				$sql15 .= " WHERE A.page_group_id = '3' AND B.delete_flag = '0'";
				$result15 = $conn->query($sql15);
				if ($result15->num_rows > 0) {
				?>
				<ul class="list-info-another">
					<?php
					while ($row15 = $result15->fetch_assoc()) {
					?>
					<li class="info-another-item"><a
						href="<?=$row15['permalink']?>" target="_blank"><?=$row15['page_name']?></a>
					</li>
					<?php 
					}
					?>					
				</ul>
				<?php 
				}
				?>
			</div>
		</div>

		<div class="border-bottom-pc-1"></div>
		<div class="border-bottom-pc-2"></div>

	</div>
	<script language="JavaScript" type="text/javascript">
    $(document).ready(function () {
        $('.title-row-info').click(function () {
            $(this).closest('.info-another').toggleClass('expanded');
        });
    });
	</script>
</footer>