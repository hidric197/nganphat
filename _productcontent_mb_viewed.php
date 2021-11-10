<?php 
if (isset($_SESSION[Common::$SESSION_USER_VIEW_PRODUCT]) && !empty($_SESSION[Common::$SESSION_USER_VIEW_PRODUCT])) {
    $lstProductView = $_SESSION[Common::$SESSION_USER_VIEW_PRODUCT];
    
    $strViewPrd = "";
    foreach($lstProductView as $prdid) {
        $strViewPrd .= "'$prdid'";
        $strViewPrd .= ",";
    }
    $strViewPrd = substr($strViewPrd, 0, -1);
    
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
	$sql .= " WHERE  A.product_id IN (" .$strViewPrd. ") ";
	$sql .= " AND  A.delete_flag = '0' ";
	
	$result10 = $conn->query($sql);
	if ($result10->num_rows > 0) {
			
?>
<div class="top-product-related">
	<div class="title-bar-hl">
		<div class="title-bar-left">Sản Phẩm Đã Xem</div>
		<div class="title-bar-right">
		</div>
	</div>
	<div class="list-product-highlight" id="san-pham-tuong-tu"
		data-pid="10195" data-start="1" data-pagenum="1" data-pages="1"
		data-more="1" data-max="20" data-length="5" data-maxpage="4">
		<ul class="product-highlight-wrap" data-curpos="0">
		<?php 
		while ($row10 = $result10->fetch_assoc()) {
		    $samBrd_vote_sum = 0;
		    $samBrd_vote = 0;
		    $samBrd_vote_sum = $row10['one_star'] + $row10['two_star'] + $row10['three_star'] + $row10['four_star'] + $row10['five_star'];
		    if ($samBrd_vote_sum != 0){
		        $samBrd_vote = ($row10['one_star'] * 1 + $row10['two_star'] * 2 + $row10['three_star'] * 3 + $row10['four_star'] * 4 + $row10['five_star'] * 5 )
		        / $samBrd_vote_sum;
		    }
		
		?>
			<li class="product-highlight-item prod-item" data-pid="10197">
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
					<span class="rating-box" title="<?=$samBrd_vote?> sao">
						<?php 
						  for ($i = 1; $i < 6; $i++) {
						      if ($i < $samBrd_vote) {
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
					<span class="amount-rate"><?=$samBrd_vote_sum?> đánh giá</span>
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
}
?>