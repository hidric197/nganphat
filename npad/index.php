<!DOCTYPE html>
<?php 
include 'common/Common.php';
include 'model/db/DBManager.php';

session_start();
ob_start();

?>
<?php 
    if (isset($_SESSION[Common::$SESSION_ADMIN_USER_INFO]) && !empty($_SESSION[Common::$SESSION_ADMIN_USER_INFO])) {
?>
<html>
<head>
<?php 

$conn = DBManager::getConnection();
// Turn autocommit off
$conn->autocommit(FALSE);

?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ngân Phát Admin</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link rel="shortcut icon"
	href="http://localhost/nganphat/template/images/favicon.ico">
<!--Custom Font-->
<link
	href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
	rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/np.js"></script>

</head>
<body>
<?php 

$INFO_INSERT_DATA_OK = "(<span style='color: red'>Thêm Thông Tin Thành Công !</span>)";
$INFO_UPDATE_DATA_OK = "(<span style='color: red'>Sửa Thông Tin Thành Công !</span>)";
$INFO_DELETE_DATA_OK = "(<span style='color: red'>Xóa Thông Tin Thành Công !</span>)";

$ERROR_FIELD_NULL = "(<span style='color: red'>Nhập Thiếu. Hãy Kiểm Tra Lại Các Trường Bắt Buộc !</span>)";
$ERROR_DUPLICATE_SLUG = "(<span style='color: red'>Bị Trùng Permalink. Hãy Chọn Link Permalink Khác!</span>)";
$ERROR_UPDATE_DATA_FAIL = "(<span style='color: red'>Sửa Thông Tin Không Thành Công !</span>)";

$CONFIRM_DELETE = "Bạn có chắc chắn muốn xóa bản ghi này không?";

$login_user_info = $_SESSION[Common::$SESSION_ADMIN_USER_INFO];
$login_user_id  = $login_user_info[0];
$sql_common_update = ", insert_user = '$login_user_id' ";

?>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<?php include '_common_header.php';?>
		</div>
		<!-- /.container-fluid -->
	</nav>

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<?php include '_common_slideBar.php';?>
	</div>
	<!--/.sidebar-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<?php 
		$pageName = '';
		if (isset($_REQUEST["pcid"])) {
		    if ($_REQUEST["pcid"] == 'tagpd'){
		        $pageName = '_ad_tag.php';
		    } else if ($_REQUEST["pcid"] == 'brapd'){
		        $pageName = '_ad_brand.php';
		    } else if ($_REQUEST["pcid"] == 'home'){
		        $pageName = '_ad_home.php';
		    } else if ($_REQUEST["pcid"] == 'imgbr'){
		        $pageName = '_ad_brand_img.php';
		    } else if ($_REQUEST["pcid"] == 'grdpd'){
		        $pageName = '_ad_group.php';
		    } else if ($_REQUEST["pcid"] == 'grdpg'){
		        $pageName = '_ad_pg_group.php';
		    } else if ($_REQUEST["pcid"] == 'detpd'){
		        $pageName = '_ad_prd_detail.php';
		    } else if ($_REQUEST["pcid"] == 'imgpd'){
		        $pageName = '_ad_prd_img.php';
		    } else if ($_REQUEST["pcid"] == 'detpg'){
		        $pageName = '_ad_pg.php';
		    } else if ($_REQUEST["pcid"] == 'detpgImg'){
		        $pageName = '_ad_pg_img.php';
		    } else if ($_REQUEST["pcid"] == 'imgads'){
		        $pageName = '_ad_ads_img.php';
		    } else if ($_REQUEST["pcid"] == 'landingpg'){
		        $pageName = '_ad_landingpg.php';
		    } else if ($_REQUEST["pcid"] == 'comment'){
		        $pageName = '_ad_comment.php';
		    } else if ($_REQUEST["pcid"] == 'filterpd'){
		        $pageName = '_ad_prd_filter.php';
		    } else if ($_REQUEST["pcid"] == 'imgfilterpd'){
		        $pageName = '_ad_prd_filter_img.php';
		    } else if ($_REQUEST["pcid"] == 'imggrd'){
		        $pageName = '_ad_group_img.php';
		    } else if ($_REQUEST["pcid"] == 'order'){
		        $pageName = '_ad_order.php';
		    } else if ($_REQUEST["pcid"] == 'user'){
		        $pageName = '_ad_user.php';
		    } else if ($_REQUEST["pcid"] == 'importCSV'){
		        $pageName = 'importCSV.php';
		    } else if ($_REQUEST["pcid"] == 'logout'){
		        unset($_SESSION[Common::$SESSION_ADMIN_USER_INFO]);
		        header("Refresh:0");
		    } else {
		        $pageName = 'dashboard.php';
		    }
		} else {
		    $pageName = 'dashboard.php';
		}
		?>
		<?php include $pageName;?>
		
		
		
	</div>
	<!--/.main-->
<?php include '_common_footer.php';?>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>

<?php 
// Commit transaction
if (!$conn -> commit()) {
    echo "Commit transaction failed";
    exit();
}
// Rollback transaction
$conn -> rollback();
DBManager::closeConn($conn);
?>

</body>
</html>

<?php 
    } else {
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quản trị website Nganphat - Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<?php 
$conn = DBManager::getConnection();

$message = '';
if (isset($_POST['submit'])) {
    if (!isset($_POST['login_user']) || empty($_POST['login_user'])) {
        $message = "(<span style='color: red'>Hãy nhập đầy đủ thông tin.)</span>";
    }
    
    if (!isset($_POST['password']) || empty($_POST['password'])) {
        $message = "<span style='color: red'>(Hãy nhập đầy đủ thông tin.)</span>";
    }
    
    if ($message != '') {
        
    } else {
        // check ton tai DB
        $login_user = $conn->real_escape_string($_POST['login_user']);
        $password = $conn->real_escape_string(md5($_POST['login_user']));
        $sql = "SELECT * FROM np_user ";
        $sql .= " WHERE ";
        $sql .= " (user_phone = '$login_user' AND user_password = '$password') ";
        $sql .= " OR (user_name = '$login_user' AND user_password = '$password') ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // set len session
                $session = array();
                $session[0] = $row['user_id'];
                $session[1] = $row['user_phone'];
                $session[2] = $row['user_name'];
                $session[3] = $row['user_full_name'];
                $session[4] = $row['user_email'];
                $session[5] = $row['user_type'];
                
                $_SESSION[Common::$SESSION_ADMIN_USER_INFO] = $session;
                
                header("Refresh:0");
            }
        } else {
            $message = "<span style='color: red'>(User không tồn tại.)</span>";
        }
    }
}

DBManager::closeConn($conn);

?>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Đăng nhập phần quản trị <?=$message?></div>
				<div class="panel-body">
					<form action="?pcid=main" name="login_form" id="login_form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Nhập số điện thoại hoặc tên đăng nhập" name="login_user" type="login_user" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu đăng nhập" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<button type="submit" name="submit" class="btn btn-primary">Đăng nhập</button></fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php 
    }

?>