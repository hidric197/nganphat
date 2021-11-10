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
<header id="header-m" data-ismobile="True" class="header-index">
	<div class="box-header pos-relative">
		<div class="wrap">
			<div class="box-top-menu">
				<nav class="block button-home-nav ">
					<a id="icon_home" class="button-home-inner"
						href="<?=Common::$_HOME_PAGE?>"><i class="icon-home"></i><span
						class="title-menu-nav">Danh mục sản phẩm</span></a>
				</nav>
        		
        		<?php include 'common_topmenu_mb_menubox.php';?>
        		
				<div class="block logo-m" style="position: relative;">
					<div class="logo-back"></div>
					<a class="logo" href="<?=Common::$_HOME_PAGE?>"
						title="Về trang chủ"></a>
				</div>
				<div class="block cart-and-account">
					<div class="notications-box">
						<div class="notica-link">
<?php
    if (isset($_SESSION[Common::$_SESSION_USER_INFO] )) {
?>
							<a href="dang-xuat"> 
								<i class="fa fa-user" aria-hidden="true"> </i>
								<span class="title-icon-top"> <span class="title-icon-top">
									Đăng nhập</span>
							</span>
							</a>
<?php
} else {
?>
							<a href="dang-nhap"> 
								<i class="fa fa-user" aria-hidden="true"> </i>
								<span class="title-icon-top"> <span class="title-icon-top">
									Đăng nhập</span>
							</span>
							</a>
<?php
}

?>
						</div>
					</div>
					<!--Cart--->
					<div class="cart-box">
						<a href="mua-hang" class="popup-cart-lnk">
							<div class="cart-link">
								<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span
									class="title-icon-top">Giỏ hàng</span>
									<?php 
    									if (isset($_SESSION[Common::$_SESSION_CHECKOUT_INFO])) {
    									    $checkout_info = $_SESSION[Common::$_SESSION_CHECKOUT_INFO];
    									    $totalPrd = 0;
    									    for ($i = 0; $i < sizeof($checkout_info); $i++) {
    									        $totalPrd += $checkout_info[$i][1];
    									    }
    									    echo "<div class='count-cart'>";
    									    echo $totalPrd;
    									    echo "</div>";
    									} 
                    					?>
							</div>
						</a>
					</div>
					<div class="phone-box">
						<div class="phone-hover">
							<i class="fa fa-phone"></i><span class="title-icon-top">Hotline</span>
						</div>
						<div class="phone-hover-bg"></div>
						<div class="phone-list">
							<div class="phone-list-item hotlines">
								<div class="hotline-title">
									<i class="fa fa-phone-square"></i>Thiết bị vệ sinh :
								</div>
								<div class="number-phone">
									<a class="number-phone" href="tel:0983573166">0983 573 166</a>
								</div>
							</div>
							<div class="phone-list-item">
								<div class="hotline-title timer">
									<i class="fa fa-clock-o"></i>Thời gian:
								</div>
								<div class="txt-timer">8h00 - 19h00</div>
							</div>
							<div class="phone-list-item">
								<div class="hotline-title email">
									<i class="fa fa-email"></i>Email:
								</div>
								<div class="txt-timer"><?=Common::$_NP_MAIL?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-search">
            	<div id="searchBox" class="frmsearch">
            		<form id="frmsearch" action="tim-kiem" title="Tìm kiếm sản phẩm" method="post">
            			<input type="text" name="txtQuerySearch" tabindex="-1" id="txtQuerySearch"
            				class="txtQuerySearch search-txt txtsearch" autocomplete="off" size="40"
            				value="" title="Nhập từ khóa liên quan đến sản phẩm"
            				placeholder="Bạn cần tìm kiếm sản phẩm gì?"
            				oninvalid="this.setCustomValidity('Nhập từ khóa liên qua đến sản phẩm')"
            				required /> <span class="head-icon-search"></span>
            			<div class="btnSearch" id="FindSubmit">
            				<input type="submit" value="Tìm kiếm" id="btnFindSearch"
            					class="btnFindSearch">
            			</div>
            			<div id="suggesstion-box"></div>
            		</form>
            	</div>
            </div>
	<script language="JavaScript" type="text/javascript">
        // AJAX call for autocomplete 
        $(document).ready(function(){
        	$("#txtQuerySearch").keyup(function(){
        		$.ajax({
        		type: "POST",
        		url: "_api_search.php",
        		data:'keyword='+$(this).val(),
        		beforeSend: function(){
        			// $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        		},
        		success: function(data){
        			$("#suggesstion-box").show();
        			$("#suggesstion-box").html(data);
        		}
        		});
        	});
        });
        $(document).ready(function(){
        
        });
   </script>
		</div>
	</div>
</header>
<script language="JavaScript" type="text/javascript">
   // Load data khi click vao mot nhom san pham nao do
   var topBannerHeight = 60;
    $(document).ready(function () {
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
                        loading($pad, { text: 'Đang tải...' });
                        var postData = {
//                             request: 'leftNavMenu',
                            subid: $item.data('id')
                        };
                        var timeid = window.setTimeout(function () {
                            $pad.attr('data-load', '1');
                            $.post('_api_getmenu_mb.php', postData, function (result) {
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
                                $('.menu-box').animate({ scrollTop: 100 }, 160);
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
        var hidx = 0;
        $items.each(function () {
            var $item = $(this);
            if ($('ul.pure-menu-children', $item).length > 0) {
                if ($item.data('id') != '0') {
                    var $firstLink = $('a', $item).first();
                    //$firstLink.click(function (e) {
                    //    e.preventDefault();
                    //});
                    $item.click(function (e) {
                        e.stopPropagation();
                        $item.addClass('x-hover').addClass("mobile").trigger('subload');
                    });
                }
            } else {
                //var $firstLink = $('a', $item);
                //location.href = $firstLink.prop('href');
            }
        });
        $('.l1-menu-item').click(function (e) {
            if (_device.isMobile && !$(this).hasClass('no-child') && $(this).prop('href') != '#') {
                e.preventDefault();
                $(this).next().show();
                $(this).parent('.item-depth-1').first().addClass('x-hover');
                $('.menu-box').animate({ scrollTop: 0 }, 150);
            }
        });
        $('.pure-menu-children .first .home').click(function (e) {
            if (_device.isMobile) {
                e.preventDefault();
                $('.pure-menu-children.parent-level2', $('#' + $(this).data('parentid'))).hide();
            }
        });
        //mở Menu cấp 2
        $('ul.pure-menu-children.parent-level2').on('click', 'a.pure-menu-link.navlink2 ', function (e) {
            if ($(this).data('id')) {
                var $parent = $('#left-menu-' + $(this).data('id'));
                // console.log($parent);
                if (_device.isMobile && $parent.hasClass('pure-menu-has-children')) {
                    e.preventDefault();
                    var $ul = $('ul', $parent);
                    if ($ul.data('display')) {
                        $ul.data('display', false);
                        $ul.hide();
                        $('.fa-plus', $parent).fadeIn();
                        $('.fa-minus', $parent).hide();
                    } else {
                        $ul.data('display', true);
                        $ul.show();
                        $('.fa-minus', $parent).fadeIn();
                        $('.fa-plus', $parent).hide();

                        var topBannerHeight = $('.top-banner').first().outerHeight();
                        if (!topBannerHeight) topBannerHeight = 0;
                        var nextScrollTop = $parent.offset().top
                            - 43
                            - ($('#header-m').hasClass('active') ? 0 : 40)
                            + $('.menu-box').scrollTop()
                            - topBannerHeight;
                        setTimeout(function () {
                            $('.menu-box').animate(
                                { scrollTop: nextScrollTop }
                                , 500);
                        }, 250);
                    }
                }
            }
        });
    });

// Hien thi menu khi click vao memu homepage

$("#icon_home").bind('touch click', function (e) {
    if (_device.isMobile) {
        e.preventDefault();
        $('#txtQuery').blur();
        if ($(".menu-box").data('display')) {
            $(".pure-menu-list>.pure-menu-item.first>a>.close-item", ".menu-box").trigger('click');
            $('body').css({ 'overflow': 'auto', 'height': 'auto' });
        } else {
            $(".menu-box").fadeIn();
            $(".menu-box").data('display', true);
            $('body').css({ 'overflow': 'hidden', 'height': '100vh' });
            $('img[data-src]', '.menu-box').each(function () {
                if ($(this).prop('src').indexOf($(this).data('src')) < 0)
                    $(this).prop('src', $(this).data('src'));
            });

            $(".phone-box").data("display", false);
            $(".phone-list").fadeOut();
        }
    }
});

$("a>.close-item", ".menu-box").bind('touch click', function (e) {
    if (_device.isMobile) {
        e.preventDefault();
        if ($(".menu-box").data('display')) {
            $('.menu-box').scrollTop(0);
            $(".menu-box").fadeOut();
            $(".menu-box").data('display', false);
            $('.pure-menu-children.parent-level2').fadeOut();
            $('body').css({ 'overflow': 'auto', 'height': 'auto' });
        }
    }
});

// Scroll chuot thi menu cung chay theo
$(document).ready(function () {
    if ($('body').prop("id").indexOf("searchpage") >= 0) {
        $('.button-home-nav').detach().prependTo('.box-top-menu');
    }

    if ($('.menu-box').length > 0) {
        var lastScrollTop = 0;
        var headerHeight = $('.box-header').outerHeight();
        var limitHeight = $('.menu-box').outerHeight() + headerHeight + topBannerHeight + 20; //$('.home-catalog').offset().top;
        
        $(window).scroll(function (event) {
            var st = $(this).scrollTop();
            
            // truong hop scroll down thi hien thi icon
            if (st > lastScrollTop && st >= headerHeight + topBannerHeight) {
                $('.box-header', '#header-m').removeClass("pos-relative");
                $('#header-m').addClass("pos-fixed");
                if (st >= limitHeight) {
                    if (!$('#header-m').hasClass('active')) {
                        $('#header-m').addClass('active');
                        $('.button-home-nav').addClass('active');
                        setTimeout(function () { $('#header-m').addClass('show'); }, 150);

                        if ($('body').prop("id").indexOf("searchpage") < 0)
                            $('.button-home-nav').detach().prependTo('.box-top-menu');
                    }
                }
            } else if (st < lastScrollTop && st <= limitHeight) {
                // scroll up thi hien hi nhu binh thuong
               
                if (st <= headerHeight + topBannerHeight) {
                    $('.box-header', '#header-m').addClass("pos-relative");
                    $('#header-m').removeClass("pos-fixed");
                }

                $('#header-m').removeClass('show').removeClass('active');
                $('.button-home-nav').removeClass('active');

//                 if ($('body').prop("id").indexOf("searchpage") < 0) {
//                     $('.button-home-nav').detach().appendTo('#menu-container');
// 					}
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

                    if ($('body').prop("id").indexOf("searchpage") < 0)
                        $('.button-home-nav').detach().prependTo('.box-top-menu');
                }
            }
        }
    }
});
</script>