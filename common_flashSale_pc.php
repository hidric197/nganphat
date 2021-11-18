<?php
$sql = "SELECT B.permalink AS prd_permalink, B.data_table";
$sql .= ", A.product_id, A.product_name, A.product_code ";
$sql .= " , A.product_old_price, A.product_down_price, A.product_sell_price ";
$sql .= " , A.brand_id, C.brand_name, A.product_flash_sale_time";
$sql .= " , D.permalink AS brand_permalink ";
$sql .= " , E.image_title, E.image_url ";
$sql .= " FROM np_product A ";
$sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
$sql .= " LEFT OUTER JOIN np_prod_brand C ON A.brand_id = C.brand_id ";
$sql .= " LEFT OUTER JOIN np_permalink D ON C.data_id = D.data_id ";
$sql .= " INNER JOIN np_prod_image E ON A.product_id = E.product_id AND E.image_type = '1' ";
$sql .= " WHERE  A.product_flash_sale = '1' ";
$sql .= " AND  A.delete_flag = '0' ";
$sql .= " Limit 5 ";

$flashsaleproduct_result = $conn->query($sql);
if ($flashsaleproduct_result->num_rows > 0) {
    ?>

<div id="catalog-fs" class="box-catalog">
	<div class="box-cat-bar">
		<div class="box-cat-title">
			<h2>
				<a href="flash-sale" title="Săn Flash Sale">Flash Sale</a>
			</h2>
		</div>
		<div class="box-cat-all">
			<a href="flash-sale" title="Xem tất cả sản phẩm Flash sale"> Xem tất
				cả<i class="fa fa-chevron-right" aria-hidden="true"></i>
			</a>
		</div>
	</div>
	<div class="cat-product-highlight">
		<div class="list-product-highlight spotlight-products"
			data-ctrl="home.flashSaleProduct" data-start="0" data-pagenum="1"
			data-pages="0" data-max="65" data-length="6" data-maxpage="11">
			<ul class="product-highlight-wrap" data-pagecount="11"
				data-curpos="0">
				<?php
    while ($row = $flashsaleproduct_result->fetch_assoc()) {
        ?>
				<li class="product-highlight-item prod-item  _list_ico_6216"
					data-pid="9833">
					<?php 
					   if ($row['product_down_price'] > 0) {
    				?>
					<div class="prod-hl-discount">
						<span>-<?=$row['product_down_price']?>%</span>
					</div>
					<?php 
    				    }
    				?>
					<div class="prod-hl-thumb">
						<a href="<?=$row['prd_permalink']?>"
							title="<?=$row['product_name']?>">
							<?php
        if ($isMobile == 'True') {
            ?>
							<img src="npad/<?=$row['image_url']?>" width="140" height="140"
							class="thumb-list is-thumb">
							<?php
        } else {
            ?>
							<img src="npad/<?=$row['image_url']?>" width="200" height="200"
							class="thumb-list is-thumb">
							<?php
        }
        ?>
						</a>
					</div>
					<div class="prod-hl-name">
						<a title="<?=$row['product_name']?>"
							href="<?=$row['prd_permalink']?>">
							<?=$row['product_name']?>
						</a>
					</div>
					<div class="prod-hl-brand">
						<a href="<?=$row['brand_permalink']?>"><?=$row['brand_name']?></a>
					</div>

					<div class="countdown-product  end-fs">
						<div class="cdown-pro-left">
							<div class="fs-price">
								<span class="fs-price-main"><?=Common::convertMoney($row['product_sell_price'])?></span>
								<div class="sale-fs">
									<span class="percent-fs">-<?$row['product_down_price']?>%</span><span
										class="old-price-fs"><?=Common::convertMoney($row['product_old_price'])?></span>
								</div>
							</div>
						</div>
						<?php 
						    $mesg = 'Còn hàng';
						    $today = time();
						    $timeSale = strtotime($row['product_flash_sale_time']);
						    
						    $downday = round(($timeSale - $today)/86400);
						    
						    if ($downday < 0) {
						        $downday = 0;
						        $downday = 0;
						        $mesg = 'Hết hàng';
						    } else if (($downday * 86400) > ($timeSale - $today)) {
						        $downday --;
						    }
						?>
						<div class="cdown-pro-right">
							<div class="flashsale-box">
								<div class="time-box-left">
									<span class="timeleft">Kết thúc sau</span>
								</div>
								<div class="time-flash running">
									<div class="time-box-first">
										<span class="ngay days"> <?=$downday ?> </span> ngày
									</div>
<!-- 									<div class="time-box-item"> -->
<!-- 										<span class="gio hours">37</span> -->
<!-- 									</div> -->
<!-- 									<div class="time-box-item"> -->
<!-- 										<span class="phut minutes">24</span> -->
<!-- 									</div> -->
<!-- 									<div class="time-box-item"> -->
<!-- 										<span class="giay seconds">07</span> -->
<!-- 									</div> -->
								</div>
								<div class="time-box-left">
									<span class="seconds"><?=$mesg?></span>
								</div>
							</div>
						</div>
					</div>
				</li>
				<?php
    }
    ?>
			</ul>
			<!-- 			<nav> -->
			<!-- 				<div class='arrow-preview-product' data-page='0'> -->
			<!-- 					<label class='arrow-left prev'><i class='fa fa-angle-left'></i></label> -->
			<!-- 					<label class='arrow-right next'><i -->
			<!-- 						class='fa fa-angle-right'></i></label> -->
			<!-- 				</div> -->
			<!-- 			</nav> -->
		</div>
	</div>
</div>
<?php 
}
?>