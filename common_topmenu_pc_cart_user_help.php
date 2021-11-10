<div class="block cart-and-account">

	<div class="notications-box">
<?php
if (isset($_SESSION[Common::$_SESSION_USER_INFO] )) {
?>
		<div class="notica-link">
			<i class="fa fa-user" aria-hidden="true"></i> <span
				class="title-icon-top"> <a href="dang-xuat"><span
					class="title-icon-top">Thoát</span></a> <a href="mua-hang"><span
					class="txt-login-more" style="color: white">Chưa xem sản phẩm nào</span></a>
			</span>
		</div>
<?php
} else {
?>
			<div class="notica-link">
			<i class="fa fa-user" aria-hidden="true"></i> <span
				class="title-icon-top"> <a href="dang-nhap"><span
					class="title-icon-top">Đăng nhập</span></a> <a href="mua-hang"><span
					class="txt-login-more" style="color: white">Sản phẩm đã xem</span></a>
			</span>
		</div>
<?php
}

?>
	</div>
	<!--Cart--->
	<div class="cart-box">
		<a href="mua-hang" class="popup-cart-lnk">
			<div class="cart-link">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span
					class="title-icon-top">Giỏ hàng</span>
					<?php 
					if (isset($_SESSION[Common::$_SESSION_CHECKOUT_INFO])) {
					    $checkout_info = $_SESSION[Common::$_SESSION_CHECKOUT_INFO];
					    $totalPrd = 0;
					    for ($i = 0; $i < sizeof($checkout_info); $i++) {
					        $totalPrd += $checkout_info[$i][1];
					    }
					    echo "<div class='count-cart'>";
					    echo $totalPrd;
					    echo "</div>";
					} 
					?>
			</div>
		</a>
	</div>

	<div class="support-box">
		<div class="link-support">
			<i class="fa fa-question-circle"></i><span class="title-icon-top">Hỗ
				trợ</span>
		</div>
		<div class="phone-hover-bg"></div>
		<div class="wrap-supp-inner">
			<div class="supp-inner-item">
				<a href="trung-tam-ho-tro" title="Trung tâm hỗ trợ"><i
					class="fa fa-lightbulb-o"></i>Trung tâm hỗ trợ</a>
			</div>
			<div class="supp-inner-item">
				<a href="bao-hanh-san-pham" title="Bảo hành sản phẩm"><i
					class="fa fa-lightbulb-o"></i>Bảo hành sản phẩm</a>
			</div>
			<div class="supp-inner-item">
				<a href="chinh-sach-doi-tra-hang" title="Chính sách đổi trả hàng"><i
					class="fa fa-lightbulb-o"></i>Chính sách đổi trả hàng</a>
			</div>
			<div class="supp-inner-item">
				<a href="huong-dan-dat-hang" title="Hướng dẫn đặt hàng"><i
					class="fa fa-lightbulb-o"></i>Hướng dẫn đặt hàng</a>
			</div>
		</div>
	</div>
	<div class="phone-box">
		<div class="phone-hover">
			<i class="fa fa-phone"></i><span class="title-icon-top">Hotline</span>
		</div>
		<div class="phone-hover-bg"></div>
		<div class="phone-list">
			<div class="phone-list-item hotlines">
				<div class="hotline-title">
					<i class="fa fa-phone-square"></i>Thiết bị vệ sinh :
				</div>
				<div class="number-phone">
					<a class="number-phone" href="tel:0983573166">0983 573 166</a>
				</div>
			</div>
			<div class="phone-list-item">
				<div class="hotline-title">
					<i class="fa fa-clock-o"></i>Thời gian:
				</div>
				<div class="txt-timer">8h00 - 18h00</div>
			</div>
			<div class="phone-list-item">
				<div class="hotline-title">
					<i class="fa fa-envelope-open"></i>Email :  <?=Common::$_NP_MAIL?>
				</div>
			</div>
		</div>
	</div>
</div>