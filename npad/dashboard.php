<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?php  echo Common::$_HOME_PAGE .'/npad/' ?>"> <em
				class="fa fa-home"></em>
		</a></li>
		<li class="active">Dashboard</li>
	</ol>
</div>
<!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard</h1>
	</div>
</div>
<!--/.row-->

<div class="panel panel-container">
	<div class="row">
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<div class="panel panel-teal panel-widget border-right">
				<div class="row no-padding">
					<em class="fa fa-xl fa-shopping-cart color-blue"></em>
					<div class="large"><a href="?pcid=order"><?=NpPermaLinkDba::countData($conn, "np_order", "order_status = '0'")?></a></div>
					<div class="text-muted">Đơn hàng mới & Tư vấn</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<div class="panel panel-blue panel-widget border-right">
				<div class="row no-padding">
					<em class="fa fa-xl fa-comments color-orange"></em>
					<div class="large"><a href="?pcid=comment"><?=NpPermaLinkDba::countData($conn, "np_comment", "comment_status = '0'")?></a></div>
					<div class="text-muted">Comments Chưa Duyệt</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<div class="panel panel-orange panel-widget border-right">
				<div class="row no-padding">
					<em class="fa fa-xl fa-users color-teal"></em>
					<div class="large"><a href="?pcid=user"><?=NpPermaLinkDba::countData($conn, "np_user", "user_type = '0'")?></a></div>
					<div class="text-muted">Tổng Users Đăng Ký</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<div class="panel panel-red panel-widget ">
				<div class="row no-padding">
					<em class="fa fa-xl fa-search color-red"></em>
					<div class="large"><a href="?pcid=detpd"><?=NpPermaLinkDba::countData($conn, "np_product", "1 = 1")?></a></div>
					<div class="text-muted">Tổng số sản phẩm đang bán</div>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->
</div>
<div class="row">
	<div class="col-md-12"></div>
</div>
<!--/.row-->

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default ">
			<div class="panel-heading">Hướng dẫn sử dụng phần quản trị admin (<a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/NganPhat_Guideline.xlsx">download</a>)</div>
			<div class="panel-body timeline-container">
				<ul class="">
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/2-1. Tag sản phẩm.pdf">1. Chức năng Tag sản phẩm</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/2-2. Brand sản phẩm.pdf">2. Chức năng Brand sản phẩm</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/2-3. Ảnh Brand.pdf">3. Chức năng Ảnh Brand</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/2-4. Group sản phẩm.pdf">4. Chức năng Group sản phẩm</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/2-5. Ảnh Group sản phẩm.pdf">5. Chức năng Ảnh Group sản phẩm</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/2-6. Bộ lọc thương hiệu Group.pdf">6. Chức năng Bộ lọc thương hiệu Group</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/2-7. Sản phẩm.pdf">7. Chức năng Sản phẩm</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/2-8. Ảnh sản phẩm.pdf">8. Chức năng Ảnh sản phẩm</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/3-1. Nhóm bài viết.pdf">9. Chức năng Nhóm bài viết</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/3-2. Bài viết.pdf">10. Chức năng Bài viết</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/3-3. Lading Page.pdf">11. Chức năng Lading Page</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/4. Quản lý ảnh Banner.pdf">12. Chức năng Quản lý ảnh Banner</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/5. Quản lý comment.pdf">13. Chức năng Quản lý comment</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/6. Quản lý đơn hàng.pdf">14. Chức năng Quản lý đơn hàng</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/7. Quản lý user.pdf">15. Chức năng Quản lý user</a></li>
					<li><a target="_blank" href="<?=Common::$_HOME_PAGE?>/npad/help/8. Logout.pdf">16. Chức năng Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!--/.col-->



	<!--/.col-->
</div>
<!--/.row-->