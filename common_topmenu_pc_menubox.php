<div class="menu-box">
	<div class="pure-menu menu-cat">
		<ul class="pure-menu-list">
			<li class="pure-menu-item first"><a href="<?=Common::$_HOME_PAGE?>"
				class="pure-menu-link home"><span class="icon-menu-item"><img
						alt="⌂" src="template/images/icon-home.png"></span>Trang chủ</a><a
				href="#"><span class="close-item"><i class="fa fa-times"></i>Đóng</span></a></li>

			<li data-id="1" id='thietbivesinh' data-depth="1"
				class="pure-menu-item pure-menu-has-children pure-menu-allow-hover thietbivesinh item-depth-1"
				data-loaded='0' data-loading='0'>
    			<a href="<?=Common::$_GROUP_THIET_BI_VE_SINH?>"
    				title="Tìm sản thiết bị vệ sinh" id="menuLink382"
    				class="pure-menu-link one l1-menu-item "> 
    				<span
    					class="icon-menu-item"> 
    					<img class="lazy-img"
    						src="template/images/Thiet-bi-ve-sinh.png"
    						data-src="template/images/Thiet-bi-ve-sinh.png"
    						alt="Thiết bị vệ sinh">Thiết bị vệ sinh
    				</span>
    			</a>
				<ul data-load="0" class="pure-menu-children parent-level2"
					style='min-height: 100%; transition: 0.5s opacity 0.5s linear'>
					<li class="pure-menu-item first"><a href="#"
						class="pure-menu-link home" data-parentid='thietbivesinh'> <span
							class="icon-menu-item"><img alt="«"
								src="template/images/left-arrow.png"></span>Thiết bị vệ sinh
					</a><a href="#"><span class="close-item"><i class="fa fa-times"></i>Đóng</span></a></li>
					<li class="pure-menu-item all"><a href="#"
						class="pure-menu-link navlink2"><span class="icon-menu-item"><img
								alt="»" src="template//images/more.png"></span>Tất cả Thiết bị vệ sinh</a></li>
				</ul>
			</li>
<!-- ############### -->
			<?php 
			$sql = "SELECT A.group_id , A.group_name, B.permalink FROM np_prod_group A ";
			$sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
			$sql .= " WHERE A.group_type = '1' AND A.group_menu_display = '1' AND A.delete_flag = '0' ";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    while ($row = $result->fetch_assoc()) {
			?>
			<li data-id="<?=$row['group_id']?>" id='thietbivesinh' data-depth="1"
				class="pure-menu-item pure-menu-has-children pure-menu-allow-hover thietbivesinh item-depth-1"
				data-loaded='0' data-loading='0'>
    			<a href="<?=$row['permalink']?>" title="<?=$row['group_name']?>" id="<?=$row['permalink']?>" id="menuLink382"
    				class="pure-menu-link one l1-menu-item "> 
    				<span class="icon-menu-item"> 
    					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    					<?=$row['group_name']?>
    				</span>
    			</a>
				<ul data-load="0" class="pure-menu-children parent-level2"
					style='min-height: 100%; transition: 0.5s opacity 0.5s linear'>
					<li class="pure-menu-item first"><a href="#"
						class="pure-menu-link home" data-parentid='thietbivesinh'> <span
							class="icon-menu-item"><img alt="«"
								src="template/images/left-arrow.png"></span><?=$row['group_name']?>
					</a><a href="#"><span class="close-item"><i class="fa fa-times"></i>Đóng</span></a></li>
					<li class="pure-menu-item all"><a href="#"
						class="pure-menu-link navlink2"><span class="icon-menu-item"><img
								alt="»" src="template//images/more.png"></span>Tất cả <?=$row['group_name']?></a></li>
				</ul>
			</li>
			
			<?php 
			    }
			}
			?>
<!-- ############### -->

			<li data-id="2" id='congcudungcu' data-depth="1"
				class="pure-menu-item pure-menu-has-children pure-menu-allow-hover congcudungcu item-depth-1"
				data-loaded='0' data-loading='0'>
				<a href="<?=Common::$_GROUP_THIET_BI_NHA_BEP?>"
    				title="Tìm sản phẩm Thiết bị nhà bếp" id="menuLink680"
    				class="pure-menu-link one l1-menu-item "> 
    				<span class="icon-menu-item"><img class="lazy-img"
						src="template/images/Thiet-bi-nha-bep.png"
						data-src="template/images/Thiet-bi-nha-bep.png"
						alt="Thiết bị nhà bếp">Thiết bị nhà bếp</span>
				</a>
				<ul data-load="0" class="pure-menu-children parent-level2"
					style='min-height: 100%; transition: 0.5s opacity 0.5s linear'>
					<li class="pure-menu-item first"><a href="#"
						class="pure-menu-link home" data-parentid='congcudungcu'><span
							class="icon-menu-item"><img alt="«"
								src="template/images/left-arrow.png"></span>Thiết bị nhà bếp</a><a
						href="#"><span class="close-item"><i class="fa fa-times"></i>Đóng</span></a></li>
					<li class="pure-menu-item all"><a href="#"
						class="pure-menu-link navlink2"><span class="icon-menu-item"><img
								alt="»" src="template/images/more.png"></span>Tất cả Thiết bị nhà bếp</a></li>
				</ul>
			</li>
<!-- ############### -->
			<?php 
			$sql = "SELECT A.group_id , A.group_name, B.permalink FROM np_prod_group A ";
			$sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
			$sql .= " WHERE A.group_type = '2' AND A.group_menu_display = '1' AND A.delete_flag = '0' ";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    while ($row = $result->fetch_assoc()) {
			?>
			<li data-id="<?=$row['group_id']?>" id='congcudungcu' data-depth="1"
				class="pure-menu-item pure-menu-has-children pure-menu-allow-hover congcudungcu item-depth-1"
				data-loaded='0' data-loading='0'>
				<a href="<?=$row['permalink']?>" title="<?=$row['group_name']?>" id="<?=$row['permalink']?>" id="menuLink680"
    				class="pure-menu-link one l1-menu-item "> 
    				<span class="icon-menu-item"> 
    					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    					<?=$row['group_name']?>
    				</span>
				</a>
				<ul data-load="0" class="pure-menu-children parent-level2"
					style='min-height: 100%; transition: 0.5s opacity 0.5s linear'>
					<li class="pure-menu-item first"><a href="#"
						class="pure-menu-link home" data-parentid='congcudungcu'><span
							class="icon-menu-item"><img alt="«"
								src="template/images/left-arrow.png"></span><?=$row['group_name']?></a><a
						href="#"><span class="close-item"><i class="fa fa-times"></i>Đóng</span></a></li>
					<li class="pure-menu-item all"><a href="#"
						class="pure-menu-link navlink2"><span class="icon-menu-item"><img
								alt="»" src="template/images/more.png"></span>Tất cả <?=$row['group_name']?></a></li>
				</ul>
			</li>
			<?php 
			    }
			}
			?>
<!-- ############### -->
			<li data-id="3" id='ytesuckhoe' data-depth="1"
				class="pure-menu-item pure-menu-has-children pure-menu-allow-hover ytesuckhoe item-depth-1"
				data-loaded='0' data-loading='0'>
				<a href="<?=Common::$_GROUP_THIET_BI_DIEN?>"
    				title="Tìm sản phẩm thiết bị điện" id="menuLink290"
    				class="pure-menu-link one l1-menu-item ">
    				<span class="icon-menu-item"><img class="lazy-img"
						src="template/images/Thiet-bi-dien.png"
						data-src="template/images/Thiet-bi-dien.png" alt="Thiết bị điện">Thiết bị điện</span>
				</a>
				<ul data-load="0" class="pure-menu-children parent-level2"
					style='min-height: 100%; transition: 0.5s opacity 0.5s linear'>
					<li class="pure-menu-item first"><a href="#"
						class="pure-menu-link home" data-parentid='ytesuckhoe'><span
							class="icon-menu-item"><img alt="«"
								src="template//images/left-arrow.png"></span>Thiết bị điện</a><a
						href="#"><span class="close-item"><i class="fa fa-times"></i>Đóng</span></a></li>
					<li class="pure-menu-item all"><a href="#"
						class="pure-menu-link navlink2"><span class="icon-menu-item"><img
								alt="»" src="template//images/more.png"></span>Tất cả Thiết bị điện</a></li>
				</ul>
			</li>
<!-- ############### -->
			<?php 
			$sql = "SELECT A.group_id , A.group_name, B.permalink FROM np_prod_group A ";
			$sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
			$sql .= " WHERE A.group_type = '3' AND A.group_menu_display = '1' AND A.delete_flag = '0' ";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    while ($row = $result->fetch_assoc()) {
			?>
			<li data-id="<?=$row['group_id']?>" id='ytesuckhoe' data-depth="1"
				class="pure-menu-item pure-menu-has-children pure-menu-allow-hover ytesuckhoe item-depth-1"
				data-loaded='0' data-loading='0'>
				<a href="<?=$row['permalink']?>" title="<?=$row['group_name']?>" id="<?=$row['permalink']?>" id="menuLink290"
    				class="pure-menu-link one l1-menu-item ">
    				<span class="icon-menu-item"> 
    					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    					<?=$row['group_name']?>
    				</span>
				</a>
				<ul data-load="0" class="pure-menu-children parent-level2"
					style='min-height: 100%; transition: 0.5s opacity 0.5s linear'>
					<li class="pure-menu-item first"><a href="#"
						class="pure-menu-link home" data-parentid='ytesuckhoe'><span
							class="icon-menu-item"><img alt="«"
								src="template//images/left-arrow.png"></span><?=$row['group_name']?></a><a
						href="#"><span class="close-item"><i class="fa fa-times"></i>Đóng</span></a></li>
					<li class="pure-menu-item all"><a href="#"
						class="pure-menu-link navlink2"><span class="icon-menu-item"><img
								alt="»" src="template//images/more.png"></span>Tất cả <?=$row['group_name']?></a></li>
				</ul>
			</li>
			<?php 
			    }
			}
			?>
<!-- ############### -->
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		</ul>
	</div>
<script language="JavaScript" type="text/javascript">

// Click hover vao group la ra chi tiet
    $(document).ready(function () {
        if (!_device.isMobile) {
            $('img[data-src]', $('.menu-box')).each(function () {
                $(this).prop('src', $(this).data('src'));
            });
        }
        var $items = $('ul.pure-menu-list > li.pure-menu-item.item-depth-1');
         $items.on('subload', function () {
            var $item = $(this);
            $items.each(function () {
                if ($(this).data('index') != $item.data('index')) {
                    $(this).removeClass('hover').removeClass("mobile").removeClass('x-hover');
                }
            });
            if ($item.hasClass('x-hover')) {
            	result = '';
                var id = $item.data('id');
                var $pad = $('ul.pure-menu-children', $item);
                if ($pad.length > 0 && !$item.data('timeid')) {
                    if ($pad.attr('data-load') != '1') {
						
//                        loading($pad, { text: 'Đang tải...' });
                        var postData = {
//                             request: 'leftNavMenu',
                            subid: $item.data('id')
                        };

                        var timeid = window.setTimeout(function () {
                            $pad.attr('data-load', '1');
                            $.post('_api_getmenu.php', postData, function (result) {
                                try {
                                    gtag('event', 'load', {
                                        event_category: 'menu',
                                        event_label: $.trim($('a>span.icon-menu-item', $item).first().text())
                                    });
                                } catch (_e) {
                                    console.log(_e);
                                }
                                $pad.append(result);

                                $('img[data-src]', $pad).each(function () {
                                    $(this).prop('src', $(this).data('src'));
                                });
                                loading($pad, { done: true });
                            }).error(function () {
                                console.log('Không kết nối được với máy chủ, hãy thử lại!');
                                $p.attr('data-load', '0');
                                loading($pad, { done: true });
                            });
                            $item.data('timeid', 0);
                        }, 500);
                        $item.data('timeid', timeid);
                    }
                }
            }
        });
        $items.hover(function () {
            var $b = $(this);
            var elm = $b.get(0);
            if (elm._$hv_)
                window.clearTimeout(elm._$hv_);
            elm._$hv_ = window.setTimeout(function () {
                $b.addClass('x-hover').trigger('subload');
            }, 500);
        }, function () {
            var $b = $(this);
            var elm = $b.get(0);
            if (elm._$hv_)
                window.clearTimeout(elm._$hv_);
            elm._$hv_ = window.setTimeout(function () {
                $b.removeClass('x-hover');
            }, 500);
        });
    });
    
// cuon chuot thi menu chay theo
var topBannerHeight = 60;
$(document).ready(function () {
    if ($('body').prop("id").indexOf("searchpage") >= 0) {
        $('.button-home-nav').detach().prependTo('.box-top-menu');
    }

    if ($('.menu-box').length > 0) {
        var lastScrollTop = 0;
        var headerHeight = $('.box-header').outerHeight();
        var limitHeight = $('.menu-box').outerHeight() + headerHeight + topBannerHeight + 20; 
        //$('.home-catalog').offset().top;
		//console.log("limitHeight : ", limitHeight);
        $(window).scroll(function (event) {
            var st = $(this).scrollTop();
            if (st > lastScrollTop && st >= headerHeight + topBannerHeight) {
                $('.box-header', '#header-m').removeClass("pos-relative");
                $('#header-m').addClass("pos-fixed");
                if (st >= limitHeight) {
                    if (!$('#header-m').hasClass('active')) {
                        $('#header-m').addClass('active');
                        $('.button-home-nav').addClass('active');
                        $('.logo').css( { 'margin-left' : '-20px' } );
                        setTimeout(function () { $('#header-m').addClass('show'); }, 150);

                        if ($('body').prop("id").indexOf("searchpage") < 0)
                            $('.button-home-nav').detach().prependTo('.box-top-menu');
                    }
                }
            } else if (st < lastScrollTop && st <= limitHeight) {

                if (st <= headerHeight + topBannerHeight) {
                    $('.box-header', '#header-m').addClass("pos-relative");
                    $('#header-m').removeClass("pos-fixed");
                }

                $('#header-m').removeClass('show').removeClass('active');
                $('.button-home-nav').removeClass('active');
				<?php 
				if ($home_page_flg == 'true') {
				?>
				$('.logo').css( { 'margin-left' : '-70px' } );
				<?php 
				}
				?>
//                 if ($('body').prop("id").indexOf("searchpage") < 0) {
//                     $('.button-home-nav').detach().appendTo('#menu-container');
//                 }
            }
            lastScrollTop = st;
        });

        var st = $(this).scrollTop();
        if (st > lastScrollTop && st >= headerHeight + topBannerHeight) {
            $('.box-header', '#header-m').removeClass("pos-relative");
            $('#header-m').addClass("pos-fixed");
            if (st >= limitHeight) {
                if (!$('#header-m').hasClass('active')) {
                    $('#header-m').addClass('active');
                    $('.button-home-nav').addClass('active');
                  	setTimeout(function () { $('#header-m').addClass('show'); }, 150);
					$('.logo').css( { 'margin-left' : '-20px' } );
                    if ($('body').prop("id").indexOf("searchpage") < 0)
                        $('.button-home-nav').detach().prependTo('.box-top-menu');
                }
            }
        }

    }
});
</script>
</div>