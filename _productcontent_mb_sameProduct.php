<?php 
	$sql = "SELECT B.permalink AS prd_permalink, B.data_table";
	$sql .= ", A.product_id, A.product_name, A.product_code ";
	$sql .= " , A.product_old_price, A.product_down_price, A.product_sell_price ";
	$sql .= " , A.brand_id, C.brand_name ";
	$sql .= " , D.permalink AS brand_permalink ";
	$sql .= " , E.image_title, E.image_url ";
	$sql .= " , F.one_star, F.two_star, F.three_star, F.four_star, F.five_star ";
	$sql .= " FROM np_product A ";
	$sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
	$sql .= " LEFT OUTER JOIN np_prod_brand C ON A.brand_id = C.brand_id ";
	$sql .= " LEFT OUTER JOIN np_permalink D ON C.data_id = D.data_id ";
	$sql .= " INNER JOIN np_prod_image E ON A.product_id = E.product_id AND E.image_type = '1' ";
	$sql .= " LEFT OUTER JOIN np_prod_vote F ON A.product_id = F.product_id ";
	$sql .= " WHERE  A.group_id = '$home_group_id' ";
	$sql .= " AND  A.delete_flag = '0' ";
	$sql .= " Limit 10 ";
	
	$result10 = $conn->query($sql);
	if ($result10->num_rows > 0) {
			
?>
<div class="top-product-related">
	<div class="title-bar-hl">
		<div class="title-bar-left">Sản Phẩm Tương Tự</div>
		<div class="title-bar-right">
			<a href="<?=$home_group_pmk?>">Xem tất cả</a>
		</div>
	</div>
	<div class="list-product-highlight" id="san-pham-tuong-tu"
		data-pid="10195" data-start="1" data-pagenum="1" data-pages="1"
		data-more="1" data-max="20" data-length="5" data-maxpage="4">
		<ul class="product-highlight-wrap" data-curpos="0">
		<?php 
		while ($row10 = $result10->fetch_assoc()) {
		    $samePrd_vote_sum = 0;
		    $samePrd_vote = 0;
		    $samePrd_vote_sum = $row10['one_star'] + $row10['two_star'] + $row10['three_star'] + $row10['four_star'] + $row10['five_star'];
		    if ($samePrd_vote_sum != 0){
		        $samePrd_vote = ($row10['one_star'] * 1 + $row10['two_star'] * 2 + $row10['three_star'] * 3 + $row10['four_star'] * 4 + $row10['five_star'] * 5 )
		        / $samePrd_vote_sum;
		    }
		
		?>
			<li class="product-highlight-item prod-item" data-pid=<?=$row10['product_id']?>>
				<?php 
				    if ($row10['product_down_price'] != '0') {
    				?>
				<div
					class="prod-hl-discount">
					<span>-<?=$row10['product_down_price']?>%</span>
				</div>
				<?php 
					   }
				?>
				<div class="prod-hl-thumb">
					<a href="<?=$row10['prd_permalink']?>" title="<?=$row10['product_name']?>"><img
						src="npad/<?=$row10['image_url']?>"
						width="200" height="200" class="thumb-list is-thumb"></a>
				</div>
				<div class="prod-hl-name">
					<a title="<?=$row10['product_name']?>" href="<?=$row10['prd_permalink']?>">
    					<?=$row10['product_name']?>
    				</a>
				</div>
				<div class="prod-hl-brand">
					<a href="<?=$row['brand_permalink']?>"><?=$row10['brand_name']?></a>
				</div>
				<div class="product-rate">
					<span class="rating-box" title="<?=$samePrd_vote?> sao">
						<?php 
						  for ($i = 1; $i < 6; $i++) {
						      if ($i < $samePrd_vote) {
						?>
						<span class="fa fa-star rated"></span>
							<?php 
						      } else {
							?>
						<span class="fa fa-star"></span>
						<?php 
						      }
						  }
						?>
					</span>
					<span class="amount-rate"><?=$samePrd_vote_sum?> đánh giá</span>
				</div>
				<div class="product-price list-product-price">
					<span class="product-price-meta"><?=Common::convertMoney($row10['product_sell_price'])?></span>
					<span class="product-price-old"><?=Common::convertMoney($row10['product_old_price'])?></span>
				</div>
			</li>
		<?php 
		}
		?>
		</ul>
<!-- 		<nav> -->
<!-- 			<div class="arrow-preview-product"> -->
<!-- 				<label class="arrow-left"><i class="fa fa-angle-left"></i></label><label -->
<!-- 					class="arrow-right"><i class="fa fa-angle-right"></i></label> -->
<!-- 			</div> -->
<!-- 		</nav> -->
	</div>
</div>
<?php 
}
?>

<!-- 

<div class="top-product-related">
				<div class="title-bar-hl">
					<div class="title-bar-left">Sản phẩm tương tự</div>
					<div class="title-bar-right">
						<a href="/may-pha-ca-phe-ban-tu-dong-c812">Xem tất cả</a>
					</div>
				</div>
				<div class="list-product-highlight" id="san-pham-tuong-tu"
					data-pid="70418" data-start="1" data-pagenum="1" data-pages="1"
					data-more="1" data-max="20" data-length="5" data-maxpage="4">
					<ul class="product-highlight-wrap" data-curpos="0">
						<li class="product-highlight-item prod-item _list_ico_3031"
							data-pid="70422"><a data-promoid="3031"
							href="/khuyenmai/mua-may-pha-ca-phe-zamboo-tang-500g-ca-phe-hat-zamboo-p3031.html"
							target="_blank" class="fast-view type-promo prod-hl-gift active"><div
									class="icon-gift"></div></a>
							<div class="prod-hl-discount">
								<span>-200K</span>
							</div>
							<div class="prod-hl-thumb">
								<a href="/may-pha-ca-phe-espresso-zamboo-zb-88cf-1-6-lit-p70422"><img
									alt="🖼️"
									src="https://s.meta.com.vn/img/thumb.ashx/200x200x95/Data/image/2020/08/08/may-pha-ca-phe-espresso-zamboo-zb-88cf-300.jpg"
									srcset="https://s.meta.com.vn/img/thumb.ashx/200x200x95/Data/image/2020/08/08/may-pha-ca-phe-espresso-zamboo-zb-88cf-300.jpg, https://s.meta.com.vn/img/thumb.ashx/300x300x95/Data/image/2020/08/08/may-pha-ca-phe-espresso-zamboo-zb-88cf-300.jpg 1.5x, https://s.meta.com.vn/img/thumb.ashx/400x400x95/Data/image/2020/08/08/may-pha-ca-phe-espresso-zamboo-zb-88cf-300.jpg 2x"
									width="200" height="200" class="thumb-list is-thumb"></a>
							</div>
							<div class="prod-hl-name">
								<a title="Máy pha cà phê Espresso Zamboo ZB-88CF (1.6 lít)"
									href="/may-pha-ca-phe-espresso-zamboo-zb-88cf-1-6-lit-p70422">Máy
									pha cà phê Espresso Zamboo ZB-88CF (1.6 lít)</a>
							</div>
							<div class="prod-hl-brand">
								<a href='/zamboo.html' data-brand-id="2420"
									data-brand-alias="zamboo">Zamboo</a>
							</div>
							<div class="product-rate">
								<span class="rating-box" title="3,0 sao"><span
									class="fa fa-star rated"></span> <span class="fa fa-star rated"></span>
									<span class="fa fa-star rated"></span> <span class="fa fa-star"></span>
									<span class="fa fa-star"></span> </span><span
									class="amount-rate">2 đánh giá</span>
							</div>
							<div class="product-price list-product-price">
								<span class="product-price-meta">2.050.000 đ</span><span
									class="product-price-old">2.250.000 đ</span>
							</div></li>
					</ul>
					<nav>
						<div class="arrow-preview-product">
							<label class="arrow-left"><i class="fa fa-angle-left"></i></label><label
								class="arrow-right"><i class="fa fa-angle-right"></i></label>
						</div>
					</nav>
				</div>
			</div>
			
			 -->