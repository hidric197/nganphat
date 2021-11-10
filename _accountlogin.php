<!DOCTYPE html>
<html lang="vi">
<head>
<?php 
    include 'common_headermeta_pc.php';
?>


<link rel="stylesheet" media="all" type="text/css"
	href="template/css/header.min.css">
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/style-chuyenmuc.min.css">
<link rel="stylesheet" media="all" type="text/css"
	href="template/css/np.css">

<!-- <link rel="stylesheet" media="all" type="text/css" href="template/css/tranghotro.min.css"> -->
<!-- <link rel="stylesheet" media="all" type="text/css" href="template/css/admin-style.min.css"> -->
<!-- <link rel="stylesheet" media="all" type="text/css" href="template/css/binhluan-hotro.min.css"> -->
	
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
</style>
</head>
<body id="catpagesub-m">

<?php  include 'common_top_ads.php'; ?>	

	<!-- Header -->
<?php include 'common_topmenu_pc_otherpage.php';?>
	<section id="center-m">
		<div class="wrap-login">
			<div class="wrap">
				<div class="wrap-box-login">
					<div class="tabLogin">

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
        $sql .= " AND (( user_phone = '$phone' AND user_password = '$pass' ) ";
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
						<div class="title-tabLg">
							<input type="radio" name="tabLg" data-target="#panel-Lg-2"
								id="Lg-o2" data-tabid="-register-tab"> <label for="Lg-o2">Đăng
								nhập </label> </span>
						</div>
						<section id="panel-Lg-1" class="tab-content-Lg active">
							<div class="box-Lg-inner">
								<form id="login-account-p" method="post">
									<div>
										<span style="color: red"><?=$msg?></span>
									</div>
									<div>
										<span style="color: red"><?=$msg1?></span>
									</div>
									<input type="text" class="account-input" id="rg_mobile"
										value="" name="rg_mobile"
										placeholder="Số điện thoại/Tên đăng nhập"> 
									<div>
										<span style="color: red"><?=$msg2?></span>
									</div>
									<input
										type="password" class="account-input" id="rg_password"
										name="rg_password" placeholder="Mật khẩu">
									<div class="login-submit">
										<input type="submit" id="btnHdLoginSubmit" class="btn-login" name="btnHdLoginSubmit"
											value="Đăng nhập" title="Đăng nhập">
										
										<div class="account-row account-forget-pass">
                							<a href="lay-lai-mat-khau">Quên mật khẩu?</a>
                						</div>
                						<div class="account-row account-register">
                							<a href="dang-ky-tai-khoan">Đăng ký</a>
            							</div>	
									</div>
								</form>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Footer -->
<?php include 'common_footer.php';?>

</body>
</html>