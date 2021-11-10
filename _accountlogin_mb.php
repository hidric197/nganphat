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
$msg = 'Bạn chưa đăng nhập. Hãy đăng nhập tại đây.';
$msg1 = '';
$msg2 = '';

$checkOK = true;

$rg_mobile = '';
$rg_password = '';

$loginOK = false;

if (isset($_POST['btnHdLoginSubmit']) && ! empty($_POST['btnHdLoginSubmit']))  {
    
    if (!isset($_POST['rg_mobile']) || empty($_POST['rg_mobile'])) {
        $msg1 = "* Cần phải nhập số điện thoại";
        $checkOK = false;
    } else {
        $rg_mobile = $_POST['rg_mobile'];
    }
    
    if (!isset($_POST['rg_password']) || empty($_POST['rg_password'])) {
        $msg2 = "* Cần phải nhập mật khẩu";
        $checkOK = false;
    } else {
        $rg_password = $_POST['rg_password'];
    }
    
    if ($checkOK) {
        $pass = md5($rg_password); 
        
        $phone = $conn->real_escape_string($rg_mobile);
        $sql = "SELECT user_id, user_phone, user_name, user_full_name, user_email, user_type FROM np_user WHERE delete_flag = '0' ";
        $sql .= " AND ( ( user_phone = '$phone' AND user_password = '$pass' ) ";
        $sql .= " OR ( user_name = '$phone' AND user_password = '$pass' )) ";
        
        $user_info = '';
        $result = $conn->query($sql);
        if (null != $result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_info[0] = $row['user_id'];
                $user_info[1] = $row['user_phone'];
                $user_info[2] = $row['user_name'];
                $user_info[3] = $row['user_full_name'];
                $user_info[4] = $row['user_email'];
                $user_info[5] = $row['user_type'];
            }
            $_SESSION[Common::$_SESSION_USER_INFO] = $user_info;
            $msg = '(Bạn đã đăng nhập thành công)';
            $loginOK = true;
        } else {
            $msg = '(Bạn đã đăng nhập chưa thành công)';
        }
        
    }
}
?>
<?php 
    if ($loginOK) {
?>
    <script language="JavaScript" type="text/javascript">
    	alert('<?=$msg?>');
    	window.location.href = "<?=Common::$_HOME_PAGE?>";		
    </script>
<?php 
    }
?>
	<section id="center-m" data-step="0">
			<div class="wrap" id="checkout-info">
				<div class="breadcrum-cat" style="margin-top: 5px">
				<a href="dang-nhap" class="show-more">
					<i class="fa fa-angle-left"></i>&nbsp;Đăng nhập</a>
				</div>
				<form id="login-account-p" method="post">
				<div class="wrap-checkout step1">
					<div id="ctl00_pageBody_ajxPanel" class="checkout-info-panel">
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
										class="account-input" placeholder="Số điện thoại/Tên đăng nhập" />
								</div>
								<div class="input-text-checkout-item">
										<span style="color: red"><?=$msg2?></span>
									</div>
								<div class="input-text-checkout-item">
									<input name="rg_password" id="rg_password" class="account-input"
										placeholder="Mật khẩu" type="password"/>
								</div>
							<div align="center">
								<button class="style-submit-checkout" type="submit"
									id="btnHdLoginSubmit" name="btnHdLoginSubmit" value="Đăng nhập">
										Đăng nhập
								</button>
							</div>
							
							<div class="account-row account-forget-pass">
    							<a href="lay-lai-mat-khau">&nbsp;&nbsp;Quên mật khẩu?</a>
    						</div>
    						<div class="account-row account-register">
    							<a href="dang-ky-tai-khoan">Đăng ký&nbsp;&nbsp;</a>
							</div>
							<br><br>
						</div>
					</div>
				</div>
				</form>
			</div>
	</section>
	<?php include 'common_footer_mb.php';?>
</body>
</html>
