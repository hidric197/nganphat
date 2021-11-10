<div id="wBanner">
	<div class="swiper-container">
		<div class="swiper-wrapper slide-list">
            <?php 
        		$sql = "SELECT A.banner_image_id, A.banner_image_type, A.banner_image_title, A.banner_image_url, A.banner_image_link FROM np_banner_image A ";
        		$sql .= " WHERE A.banner_image_type = '5' AND A.delete_flag = '0' ";
        		$result = $conn->query($sql);
        		if ($result->num_rows > 0) {
        		    while ($row = $result->fetch_assoc()) {
    		?>
			<div class="swiper-slide" id="slide-1967" data-id="1967">
				<a href="<?=$row['banner_image_link']?>"> <img class="slide-thumb"
					src="npad/<?=$row['banner_image_url']?>"
					data-idsrc="template/js/0.gif" alt="<?=$row['banner_image_title']?>">
				</a>
			</div>

			<?php 
    		    }
    		}
            ?>

		</div>

		<div class="swiper-pagination"></div>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>
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
                //autoplay: {
                //    delay: 4000,
                //    disableOnInteraction: false,
                //},
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
                    //$th.prop('src', _thumbPrefix + '/' + '0x0x0' + src);
                    $th.prop('src', src);
                });
                $('.swiper-pagination, .swiper-button-next, .swiper-button-prev').css('visibility', 'visible');

                swiper.params.autoplay = {
                    delay: 3500,
                    disableOnInteraction: false
                };
                swiper.autoplay.start();

            }, _device.isMobile ? 3500 : 3500);
        });
    });
</script>

	<!-- @end .slider -->
</div>