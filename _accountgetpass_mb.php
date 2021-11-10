<!DOCTYPE html>
<html lang="vi">
<head>

<?php include 'common_headermeta_mb.php';?>

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

</head>
<body id="checkout">
	<?php  include 'common_top_ads.php'; ?>
	<?php  include 'common_topmenu_mb_homepage.php'; ?>
	
	
<?php
$msg = '';
$msg1 = '';
$msg2 = '';
$msg4 = '';
$msg5 = '';

$checkOK = true;

$rg_mobile = '';
$rg_login_id = '';
$rg_password = '';
$rg_password_cf = '';

if (isset($_POST['btnGetPass']) && ! empty($_POST['btnGetPass']))  {
    
    if (!isset($_POST['rg_mobile']) || empty($_POST['rg_mobile'])) {
        $msg1 = "* Cần phải nhập số điện thoại";
        $checkOK = false;
    } else {
        $rg_mobile = $_POST['rg_mobile'];
        if (!Common::isPhoneNumber($rg_mobile)) {
            $msg1 = "* Bạn nhập sai trường Số Điện Thoại. Hãy nhập lại.";
            $checkOK = false;
        }
    }
    
    if (!isset($_POST['rg_login_id']) || empty($_POST['rg_login_id'])) {
        $msg2 = "* Cần phải nhập tên đăng nhập";
        $checkOK = false;
    } else {
        $rg_login_id = $_POST['rg_login_id'];
    }
    
    if (!isset($_POST['rg_password']) || empty($_POST['rg_password'])) {
        $msg4 = "* Cần phải nhập mật khẩu";
        $checkOK = false;
    } 
    
    if (!isset($_POST['rg_password_cf']) || empty($_POST['rg_password_cf'])) {
        $msg5 = "* Cần phải nhập để kiểm tra mật khẩu";
        $checkOK = false;
    } else {
        $rg_password = $_POST['rg_password'];
        $rg_password_cf = $_POST['rg_password_cf'];
        if ($rg_password != $rg_password_cf) {
            $msg5 = "* Nhập 2 mật khẩu không trùng nhau";
            $checkOK = false;
        }
    }
    if ($checkOK) {

        $pass = md5($rg_password);
        
        $phone = $conn->real_escape_string($rg_mobile);
        $user = $conn->real_escape_string($rg_login_id);
        
        $sql = "SELECT user_phone FROM np_user WHERE user_phone = '$phone' AND user_name = '$user'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql = "UPDATE np_user SET user_password = ? WHERE  user_phone = '$phone' OR user_name = '$user' ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $pass);
            $stmt->execute();
            $msg = '(Bạn đã thay đổi mật khẩu thành công)';
        } else {
            $msg = '(Không tồn tại tài khoản này trong cơ sở dữ liệu)';
        }
        
    }
}
?>

	<section id="center-m" data-step="0">
		<form id="register-account-p" method="post">
			<div class="wrap" id="checkout-info">
				<div class="breadcrum-cat" style="margin-top: 5px"><a href="dang-ky-tai-khoan" class="show-more">
					<i class="fa fa-angle-left"></i>&nbsp;Lấy lại mật khẩu</a>
				</div>
						<div id="ctl00_pageBody_billinfo" class="checkout-info-box buyer">
							<div class="checkout-info-body">
								<div class="input-text-checkout-item">
									<span style="color: red"><?=$msg?></span>
								</div>
								<div class="input-text-checkout-item">
									<span style="color: red"><?=$msg1?></span> 
								</div>
								<div class="input-text-checkout-item">
									<input type="text" class="account-input" name="rg_mobile" value="<?=$rg_mobile?>"
										placeholder="Nhập Số điện thoại"> 
								</div>
								<div class="input-text-checkout-item">
										<span style="color: red"><?=$msg2?></span> 
								</div>
								<div class="input-text-checkout-item">
									<input type="text" class="account-input" name="rg_login_id" value="<?=$rg_login_id?>"
										placeholder="Nhập Số tên đăng nhập"> 
								</div>
								<div class="input-text-checkout-item">
									<span style="color: red"><?=$msg4?></span> 
								</div>
								<div class="input-text-checkout-item">
									<input type="password" class="account-input" id="rg_password" value="<?=$rg_password?>"
										name="rg_password" placeholder="Mật khẩu mới">
								</div>
								<div class="input-text-checkout-item">
									<span style="color: red"><?=$msg5?></span> 
								</div>
								<div class="input-text-checkout-item">
									<input type="password" class="account-input"  value="<?=$rg_password_cf?>"
										id="rg_password_cf" name="rg_password_cf"
										placeholder="Xác nhận mật khẩu mới"> 
								</div>
							</div>
							<div class="Submit-checkout">
								<button type="submit" class="style-submit-checkout" id="btnGetPass" name="btnGetPass" value="Đăng ký tài khoản">
									Đổi mật khẩu
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
	<?php include 'common_footer_mb.php';?>
</body>
</html>
