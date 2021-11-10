<?php 
	$sqlxx = "SELECT A.banner_image_id, A.banner_image_type, A.banner_image_title, A.banner_image_url, A.banner_image_link ";
	$sqlxx .= " FROM np_banner_image A ";
	$sqlxx .= " WHERE A.banner_image_type = '3' AND A.delete_flag = '0' AND group_id = '$home_group_id' ";
	$resultxx = $conn->query($sqlxx);
	if ($resultxx->num_rows > 0) {
?>
<section id="catalog">
	<div id="wBanner">
		<div class="swiper-container swiper-container-horizontal">
			<div class="swiper-wrapper slide-list" data-count="3"
				style="transform: translate3d(-1952px, 0px, 0px); transition-duration: 0ms;">
				<?php 
        		    while ($rowxx = $resultxx->fetch_assoc()) {
        		?>
				<div class="swiper-slide" style="width: 970px; height: 270px">
					<a href="<?=$rowxx['banner_image_link']?>" title="<?=$rowxx['banner_image_title']?>"> <img
						title="<?=$rowxx['banner_image_title']?>"
						src="npad/<?=$rowxx['banner_image_url']?>"></a>
				</div>
				<?php 
        		    }
                ?>
			</div>
			</br></br>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
		<!-- Initialize Spaginationpaginationpaginationwiper -->
		<script language="JavaScript" type="text/javascript">
                $(document).ready(function () {
                    _loadJs('template/js/swiper.min.js', function () {
                        var swiper = new Swiper('.swiper-container', {
                            pagination: {
                                el: '.swiper-pagination',
                                //type: 'fraction',
                                clickable: true,
                                renderBullet: function (index, className) {
                                    return '<span class="' + className + '"></span>';
                                },
                            },
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                            loop: true,
                        });
                        var _thumbPrefix = $('meta[name="thumburl"]').attr('content');
                        setTimeout(function () {
                            $('img[data-ssrc]', $('.swiper-wrapper.slide-list')).each(function () {
                                var $th = $(this);
                                var src = $th.data('ssrc');
                                if (src.indexOf('/') != 0 && src.indexOf('http') < 0)
                                    src = '/' + src;
                                //$th.prop('src', _thumbPrefix + '/' + $('#slide-' + $th.data('id')).width() + 'x0' + src);
                                $th.prop('src', src);
                            });
                            $('.swiper-pagination, .swiper-button-next, .swiper-button-prev').css('visibility', 'visible');

                            swiper.params.autoplay = {
                                delay: 3500,
                                disableOnInteraction: false
                            };
                            swiper.autoplay.start();

                        }, _device.isMobile ? 3500 : 1500);
                    });
                });
            </script>
	</div>
</section>
<style>
.wrap-catalog-main {
    margin-bottom: 10px;
    margin-top: 20px
}
</style>
<?php 
}
?>