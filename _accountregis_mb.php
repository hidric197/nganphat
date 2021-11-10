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
$msg3 = '';
$msg4 = '';
$msg5 = '';
$msg6 = '';

$checkOK = true;

$rg_mobile = '';
$rg_login_id = '';
$rg_fullname = '';
$rg_email = '';
$rg_password = '';
$rg_password_cf = '';

if (isset($_POST['btnRgSubmit']) && ! empty($_POST['btnRgSubmit']))  {
    
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
        $msg6 = "* Cần phải nhập tên đăng nhập";
        $checkOK = false;
    } else {
        $rg_login_id = $_POST['rg_login_id'];
    }
    
    if (!isset($_POST['rg_fullname']) || empty($_POST['rg_fullname'])) {
        $msg2 = "* Cần phải nhập Họ tên của bạn";
        $checkOK = false;
    } else {
        $rg_fullname = $_POST['rg_fullname'];
    }
    
    if (!isset($_POST['rg_email']) || empty($_POST['rg_email'])) {
        $msg3 = "* Cần phải nhập Email của bạn";
        $checkOK = false;
    } else {
        $rg_email = $_POST['rg_email'];
        if (!Common::isEmail($rg_email)) {
            $msg3 = "* Bạn nhập sai trường Email. Hãy nhập lại.";
            $checkOK = false;
        }
        
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
        $sql = "SELECT user_phone FROM np_user WHERE user_phone = '$phone' OR user_name = '$user'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $msg = '(Số điện thoại này hoặc tên đăng nhập này đã được đăng ký)';
        } else {
            $sql = "INSERT INTO np_user(user_phone, user_name, user_full_name, user_email, user_password) VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $rg_mobile, $rg_login_id, $rg_fullname, $rg_email, $pass);
            $stmt->execute();
            $msg = '(Bạn đã đăng ký thành công)';
        }
        
    }
}
?>

	<section id="center-m" data-step="0">
		<form id="register-account-p" method="post">
			<div class="wrap" id="checkout-info">
				<div class="breadcrum-cat" style="margin-top: 5px"><a href="dang-ky-tai-khoan" class="show-more">
					<i class="fa fa-angle-left"></i>&nbsp;Đăng ký tài khoản</a>
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
									<input name="rg_mobile" type="text" id="rg_mobile"
										class="account-input" placeholder="Nhập điện thoại" value="<?=$rg_mobile?>"/>
								</div>
								<div class="input-text-checkout-item">
										<span style="color: red"><?=$msg6?></span> 
								</div>
								<div class="input-text-checkout-item">
									<input type="text" class="account-input" id="rg_login_id" value="<?=$rg_login_id?>"
										name="rg_login_id" placeholder="Nhập tên đăng nhập"> 
								</div>
								<div class="input-text-checkout-item">
									<span style="color: red"><?=$msg2?></span> 
								</div>
								<div class="input-text-checkout-item">
									<input type="text" class="account-input" id="rg_fullname" value="<?=$rg_fullname?>"
										name="rg_fullname" placeholder="Nhập họ tên">
								</div>
								<div class="input-text-checkout-item">
									<span style="color: red"><?=$msg3?></span> 
								</div>
								<div class="input-text-checkout-item">
									<input type="text" class="account-input" id="rg_email" value="<?=$rg_email?>"
										name="rg_email" placeholder="Nhập Email (không bắt buộc)"> 
								</div>
								<div class="input-text-checkout-item">
									<span style="color: red"><?=$msg4?></span> 
								</div>
								<div class="input-text-checkout-item">
    								<input type="password" class="account-input" id="rg_password"
    										value="<?=$rg_password?>" name="rg_password" placeholder="Mật khẩu">
								</div>
								<div class="input-text-checkout-item">
									<span style="color: red"><?=$msg5?></span> 
								</div>
								<div class="input-text-checkout-item">
    								<input type="password" class="account-input" id="rg_password_cf" value="<?=$rg_password_cf?>"
    										name="rg_password_cf" placeholder="Xác nhận mật khẩu">
								</div>
							</div>
							<div class="Submit-checkout">
								<button type="submit" class="style-submit-checkout" id="btnRgSubmit" name="btnRgSubmit" value="Đăng ký tài khoản">
									Đăng ký
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
