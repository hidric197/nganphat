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
	
<script language="JavaScript" type="text/javascript">
function showMoreBrands() {
    $('.filter-brand .arrow-icon-filter').trigger('click');
    return false;
}
</script>

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
						<div class="title-tabLg">
							<input type="radio" name="tabLg" data-target="#panel-Lg-3" id="Lg-o3" data-tabid="-getpwd-tab"> 
								<label for="Lg-o3">L???y l???i m???t kh???u</label>
						</div>
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
        $msg1 = "* C???n ph???i nh???p s??? ??i???n tho???i";
        $checkOK = false;
    } else {
        $rg_mobile = $_POST['rg_mobile'];
        if (!Common::isPhoneNumber($rg_mobile)) {
            $msg1 = "* B???n nh???p sai tr?????ng S??? ??i???n Tho???i. H??y nh???p l???i.";
            $checkOK = false;
        }
    }
    
    if (!isset($_POST['rg_login_id']) || empty($_POST['rg_login_id'])) {
        $msg2 = "* C???n ph???i nh???p t??n ????ng nh???p";
        $checkOK = false;
    } else {
        $rg_login_id = $_POST['rg_login_id'];
    }
    
    if (!isset($_POST['rg_password']) || empty($_POST['rg_password'])) {
        $msg4 = "* C???n ph???i nh???p m???t kh???u";
        $checkOK = false;
    } 
    
    if (!isset($_POST['rg_password_cf']) || empty($_POST['rg_password_cf'])) {
        $msg5 = "* C???n ph???i nh???p ????? ki???m tra m???t kh???u";
        $checkOK = false;
    } else {
        $rg_password = $_POST['rg_password'];
        $rg_password_cf = $_POST['rg_password_cf'];
        if ($rg_password != $rg_password_cf) {
            $msg5 = "* Nh???p 2 m???t kh???u kh??ng tr??ng nhau";
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
            $msg = '(B???n ???? thay ?????i m???t kh???u th??nh c??ng)';
        } else {
            $msg = '(Kh??ng t???n t???i t??i kho???n n??y trong c?? s??? d??? li???u)';
        }
        
    }
}
?>
						
						<section id="panel-Lg-3" class="tab-content-Lg active">
							<div class="box-Lg-inner">
								<form id="reset-pass-p" method="post">
									<div><span style="color: red"><?=$msg?></span></div>
									<div>
										<span style="color: red"><?=$msg1?></span> 
									</div>
									<input type="text" class="account-input" name="rg_mobile" value="<?=$rg_mobile?>"
										placeholder="Nh???p S??? ??i???n tho???i"> 
									<div>
										<span style="color: red"><?=$msg2?></span> 
									</div>
									<input type="text" class="account-input" name="rg_login_id" value="<?=$rg_login_id?>"
										placeholder="Nh???p S??? t??n ????ng nh???p"> 
									<div>
										<span style="color: red"><?=$msg4?></span> 
									</div>
									<input type="password" class="account-input" id="rg_password" value="<?=$rg_password?>"
										name="rg_password" placeholder="M???t kh???u m???i"> 
									<div>
										<span style="color: red"><?=$msg5?></span> 
									</div>
									<input type="password" class="account-input"  value="<?=$rg_password_cf?>"
										id="rg_password_cf" name="rg_password_cf"
										placeholder="X??c nh???n m???t kh???u m???i">
									<div class="login-submit">
    									<input
    											type="submit" id="btnGetPass" class="btn-login"
    											value="?????i m???t kh???u" title="?????i m???t kh???u" name="btnGetPass">
									</div>									

									<div class="note-resetpass">Nh???p ?????a t??n t??i kho???n/s???
										??i???n tho???i b???n ???? ????ng k?? v???i Nganphat.com.vn ????? thay ?????i m???t kh???u.</div>
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