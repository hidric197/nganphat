<div class="profile-sidebar">
	<div class="profile-userpic">
		<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive"
			alt="">
	</div>
	<div class="profile-usertitle">
		<div class="profile-usertitle-name"><?=$_SESSION[Common::$SESSION_ADMIN_USER_INFO][3]?></div>
		<div class="profile-usertitle-status">
			<span class="indicator label-success"></span>Online
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="divider"></div>

<?php 
$pg_index = '';
$pg_tagpd = '';
$pg_brapd = '';
$pg_imgbr = '';
$pg_grdpd = '';
$pg_detpd = '';
$pg_grdpg = '';
$pg_detpg = '';
$pg_comment = '';
$pg_order = '';
$pg_imgads = '';
$pg_landingpg = '';
$pg_filterpd = '';
$pg_imgfilterpd = '';
$pg_imggrd = '';
$pg_user = '';
$pg_detpgImg = '';
if (isset($_REQUEST['pcid'])) {
    if ($_REQUEST['pcid'] == "index") {
        $pg_index = "active";
    } else if ($_REQUEST['pcid'] == "tagpd") {
        $pg_tagpd = "active";
    } else if ($_REQUEST['pcid'] == "brapd") {
        $pg_brapd = "active";
    } else if ($_REQUEST['pcid'] == "imgbr") {
        $pg_imgbr = "active";
    } else if ($_REQUEST['pcid'] == "grdpd") {
        $pg_grdpd = "active";
    } else if ($_REQUEST['pcid'] == "detpd") {
        $pg_detpd = "active";
    } else if ($_REQUEST['pcid'] == "grdpg") {
        $pg_grdpg = "active";
    } else if ($_REQUEST['pcid'] == "detpg") {
        $pg_detpg = "active";
    } else if ($_REQUEST['pcid'] == "detpgImg") {
        $pg_detpgImg = "active";
    } else if ($_REQUEST['pcid'] == "imgpd") {
        $pg_imgpd = "active";
    } else if ($_REQUEST['pcid'] == "comment") {
        $pg_comment = "active";
    } else if ($_REQUEST['pcid'] == "order") {
        $pg_order = "active";
    } else if ($_REQUEST['pcid'] == "imgads") {
        $pg_imgads = "active";
    } else if ($_REQUEST['pcid'] == "landingpg") {
        $pg_landingpg = "active";
    } else if ($_REQUEST['pcid'] == "filterpd") {
        $pg_filterpd = "active";
    } else if ($_REQUEST['pcid'] == "imgfilterpd") {
        $pg_imgfilterpd = "active";
    } else if ($_REQUEST['pcid'] == "imggrd") {
        $pg_imggrd = "active";
    } else if ($_REQUEST['pcid'] == "user") {
        $pg_user = "active";
    } else {
        $pg_index = "active";
    }
} else {
    $pg_index = "active";
}
?>

<ul class="nav menu">
	<li class="<?=$pg_index?>"><a href="?pcid=index"><em class="fa fa-dashboard">&nbsp;</em>
			Tổng hợp </a></li>
	<!-- active -->
	<li class="parent">
		<a data-toggle="collapse" href="#"> <em
			class="fa fa-navicon">&nbsp;</em> Quản lý sản phẩm
		</a> 
		<!-- expand collapse -->
		<ul class="children expand" id="sub-item-1">
			<li><a class="<?=$pg_tagpd?>" href="?pcid=tagpd"> <span
					class="fa fa-arrow-right">&nbsp;</span> Tag
			</a></li>
			<li><a class="<?=$pg_brapd?>" href="?pcid=brapd"> <span class="fa fa-arrow-right">&nbsp;</span>
					Brand sản phẩm
			</a></li>
			<li><a class="<?=$pg_imgbr?>" href="?pcid=imgbr"> <span class="fa fa-arrow-right">&nbsp;</span>
					Ảnh Brand
			</a></li>
			<li><a class="<?=$pg_grdpd?>" href="?pcid=grdpd"> <span class="fa fa-arrow-right">&nbsp;</span>
					Group sản phẩm
			</a></li>
			<li><a class="<?=$pg_imggrd?>" href="?pcid=imggrd"> <span class="fa fa-arrow-right">&nbsp;</span>
					Ảnh Group sản phẩm
			</a></li>
			<li><a class="<?=$pg_filterpd?>" href="?pcid=filterpd"> <span class="fa fa-arrow-right">&nbsp;</span>
					Bộ lọc Thương hiệu Group
			</a></li>
			<li><a class="<?=$pg_imgfilterpd?>" href="?pcid=imgfilterpd"> <span class="fa fa-arrow-right">&nbsp;</span>
					Ảnh Bộ lọc Thương hiệu Group
			</a></li>
			<li><a class="<?=$pg_detpd?>" href="?pcid=detpd"> <span class="fa fa-arrow-right">&nbsp;</span>
					Sản phẩm
			</a></li>
		</ul>
	</li>
	<li class="parent">
		<a data-toggle="collapse" href="#"> <em
			class="fa fa-navicon">&nbsp;</em> Quản lý Bài Viết
		</a> 
		<!-- expand collapse -->
		<ul class="children expand" id="sub-item-1">
			<li><a class="<?=$pg_grdpg?>" href="?pcid=grdpg"> <span
					class="fa fa-arrow-right">&nbsp;</span> Nhóm Bài Viết
			</a></li>
			<li><a class="<?=$pg_detpg?>" href="?pcid=detpg"> <span class="fa fa-arrow-right">&nbsp;</span>
					Bài Viết
			</a></li><li><a class="<?=$pg_detpgImg?>" href="?pcid=detpgImg"> <span class="fa fa-arrow-right">&nbsp;</span>
					Ảnh Bìa Bài Viết
			</a></li>
			<li><a class="<?=$pg_landingpg?>" href="?pcid=landingpg"> <span class="fa fa-arrow-right">&nbsp;</span>
					Landing Page
			</a></li>
		</ul>
	</li>
	<li class="<?=$pg_imgads?>"><a href="?pcid=imgads"><em class="fa fa-navicon">&nbsp;</em>
			Quản Lý Ảnh Banner</a></li>
	<li class="<?=$pg_comment?>"><a href="?pcid=comment"><em class="fa fa-navicon">&nbsp;</em>
			Quản Lý Comment</a></li>
	<li class="<?=$pg_order?>"><a href="?pcid=order"><em class="fa fa-navicon">&nbsp;</em>
			Quản Lý Đơn hàng</a></li>
	<li class="<?=$pg_user?>"><a href="?pcid=user"><em class="fa fa-navicon">&nbsp;</em>
			Quản Lý User</a></li>
	
	<li><a href="?pcid=logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
</ul>