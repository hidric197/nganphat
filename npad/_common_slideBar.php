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
$pg_home = '';
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
    } else if ($_REQUEST['pcid'] == "home") {
        $pg_home = "active";
    } else {
        $pg_index = "active";
    }
} else {
    $pg_index = "active";
}
?>
<style>
	ul li {
		overflow: hidden;
	    white-space: nowrap; 
	    text-overflow: ellipsis;
	}
	ul li a {
		font-size: 14px;
	}
</style>

<ul class="nav menu">
	<li class="<?=$pg_index?>"><a href="?pcid=index"><em class="fa fa-dashboard">&nbsp;</em>
			T???ng h???p </a></li>
	<!-- active -->
	<li class="parent">
		<a data-toggle="collapse" href="#"> <em
			class="fa fa-navicon">&nbsp;</em> Qu???n l?? trang ch???
		</a> 
		<!-- expand collapse -->
		<ul class="children expand" id="sub-item-1">
			<li title="Qu???n l?? th??? meta"><a class="<?=$pg_home?>" href="?pcid=home"> <span
					class="fa fa-arrow-right">&nbsp;</span> Qu???n l?? th??? meta
			</a></li>
		</ul>
	</li>
	<li class="parent">
		<a data-toggle="collapse" href="#"> <em
			class="fa fa-navicon">&nbsp;</em> Qu???n l?? s???n ph???m
		</a> 
		<!-- expand collapse -->
		<ul class="children expand" id="sub-item-1">
			<li title="Tag"><a class="<?=$pg_tagpd?>" href="?pcid=tagpd"> <span
					class="fa fa-arrow-right">&nbsp;</span> Tag
			</a></li>
			<li title="Brand s???n ph???m"><a class="<?=$pg_brapd?>" href="?pcid=brapd"> <span class="fa fa-arrow-right">&nbsp;</span>
					Brand s???n ph???m
			</a></li>
			<li title="???nh Brand"><a class="<?=$pg_imgbr?>" href="?pcid=imgbr"> <span class="fa fa-arrow-right">&nbsp;</span>
					???nh Brand
			</a></li>
			<li title="Group s???n ph???m"><a class="<?=$pg_grdpd?>" href="?pcid=grdpd"> <span class="fa fa-arrow-right">&nbsp;</span>
					Group s???n ph???m
			</a></li>
			<li title="???nh Group s???n ph???m"><a class="<?=$pg_imggrd?>" href="?pcid=imggrd"> <span class="fa fa-arrow-right">&nbsp;</span>
					???nh Group s???n ph???m
			</a></li>
			<li title="B??? l???c Th????ng hi???u Group"><a class="<?=$pg_filterpd?>" href="?pcid=filterpd"> <span class="fa fa-arrow-right">&nbsp;</span>
					B??? l???c Th????ng hi???u Group
			</a></li>
			<li title="???nh B??? l???c Th????ng hi???u Group"><a class="<?=$pg_imgfilterpd?>" href="?pcid=imgfilterpd"> <span class="fa fa-arrow-right">&nbsp;</span>
					???nh B??? l???c Th????ng hi???u Group
			</a></li>
			<li title="S???n ph???m"><a class="<?=$pg_detpd?>" href="?pcid=detpd"> <span class="fa fa-arrow-right">&nbsp;</span>
					S???n ph???m
			</a></li>
		</ul>
	</li>
	<li class="parent">
		<a data-toggle="collapse" href="#"> <em
			class="fa fa-navicon">&nbsp;</em> Qu???n l?? B??i Vi???t
		</a> 
		<!-- expand collapse -->
		<ul class="children expand" id="sub-item-1">
			<li title="Nh??m B??i Vi???t"><a class="<?=$pg_grdpg?>" href="?pcid=grdpg"> <span
					class="fa fa-arrow-right">&nbsp;</span> Nh??m B??i Vi???t
			</a></li>
			<li title="B??i Vi???t"><a class="<?=$pg_detpg?>" href="?pcid=detpg"> <span class="fa fa-arrow-right">&nbsp;</span>
					B??i Vi???t
			</a></li>
			<li title="???nh B??a B??i Vi???t"><a class="<?=$pg_detpgImg?>" href="?pcid=detpgImg"> <span class="fa fa-arrow-right">&nbsp;</span>
					???nh B??a B??i Vi???t
			</a></li>
			<li title="Landing Page"><a class="<?=$pg_landingpg?>" href="?pcid=landingpg"> <span class="fa fa-arrow-right">&nbsp;</span>
					Landing Page
			</a></li>
		</ul>
	</li>
	<li class="<?=$pg_imgads?>" title="Qu???n L?? ???nh Banner"><a href="?pcid=imgads"><em class="fa fa-navicon">&nbsp;</em>
			Qu???n L?? ???nh Banner</a></li>
	<li class="<?=$pg_comment?>" title="Qu???n L?? Comment"><a href="?pcid=comment"><em class="fa fa-navicon">&nbsp;</em>
			Qu???n L?? Comment</a></li>
	<li class="<?=$pg_order?>" title="Qu???n L?? ????n h??ng"><a href="?pcid=order"><em class="fa fa-navicon">&nbsp;</em>
			Qu???n L?? ????n h??ng</a></li>
	<li class="<?=$pg_user?>" title="Qu???n L?? User"><a href="?pcid=user"><em class="fa fa-navicon">&nbsp;</em>
			Qu???n L?? User</a></li>
	
	<li><a href="?pcid=logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
</ul>