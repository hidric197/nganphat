<!--cid:1013-rid:20-->
<div id="catalog-1013" class="box-catalog">
	<div class="box-cat-bar">
		<div class="box-cat-title">
			<h2>
				<a href="<?=Common::$_GROUP_THIET_BI_DIEN?>"
					data-ssid="10130dien-may-dien-lanh" title="THIẾT BỊ ĐIỆN">Thiết bị
					điện</a>
			</h2>
		</div>
		<div class="box-cat-all">
			<?php 
				$sqlgr = "SELECT A.group_name, B.permalink ";
				$sqlgr .= " FROM np_prod_group A";
				$sqlgr .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
				$sqlgr .= " WHERE  A.group_type = '" .Common::$_GROUP_THIET_BI_DIEN_TYPE. "' AND A.group_level_up = '" .Common::$_GROUP_THIET_BI_DIEN_TYPE. "' ";
				$sqlgr .= " AND  A.delete_flag = '0' ";
				$sqlgr .= " GROUP BY A.product_id ";
				$sqlgr .= " ORDER BY A.group_id ";
				$sqlgr .= " Limit 5 ";
				
				
				$group_result = $conn->query($sqlgr);
				if ($group_result->num_rows > 0) {
				    while ($rowgr = $group_result->fetch_assoc()) {
			?>

			<a class="link_group" href="<?=$rowgr['permalink'] ?>"
				title="<?=$rowgr['group_name'] ?>"><?=$rowgr['group_name'] ?></a>
			&nbsp;			
			<?php
				    }
				}
			?>
			
			<a class="link_group" href="<?=Common::$_GROUP_THIET_BI_DIEN?>"
				title="Xem tất cả sản phẩm Thiết Bị Điện">Xem tất cả<i
				class="fa fa-chevron-right" aria-hidden="true"></i></a>
		</div>
	</div>
	<div class="cat-product-highlight">
		<ul class="product-highlight-wrap">
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
    			$sql .= " INNER JOIN np_prod_group P ON A.group_id = P.group_id ";
    			
				$sql .= " WHERE  P.group_type = '" .Common::$_GROUP_THIET_BI_DIEN_TYPE. "' ";
				$sql .= " AND  A.delete_flag = '0' ";
				$sql .= " GROUP BY A.product_id ";
				$sql .= " ORDER BY A.product_id DESC ";
				$sql .= " Limit 10 ";
				
				$suggestproduct_result = $conn->query($sql);
				if ($suggestproduct_result->num_rows > 0) {
				    while ($row = $suggestproduct_result->fetch_assoc()) {
				        $sum_vote = 0;
				        $vote = 0;
				        $sum_vote = $row['one_star'] + $row['two_star'] + $row['three_star'] + $row['four_star'] + $row['five_star'];
				        if ($sum_vote != 0){
				            $vote = ($row['one_star'] * 1 + $row['two_star'] * 2 + $row['three_star'] * 3 + $row['four_star'] * 4 + $row['five_star'] * 5 )
				            / $sum_vote;
				        }
			?>
    				<li class="product-highlight-item prod-item">
    				<?php 
					   if ($row['product_down_price'] > 0) {
    				?>
    				<div
    					class="prod-hl-discount">
    					<span>-<?=$row['product_down_price']?>%</span>
    				</div>
    				<?php 
					   }
    				?>
    				<div class="prod-hl-thumb">
    					<a href="<?=$row['prd_permalink']?>" title="<?=$row['product_name']?>"><img
    							src="npad/<?=$row['image_url']?>"
    							width="200" height="200" class="thumb-list is-thumb"></a>
    				</div>
    				<div class="prod-hl-name">
    					<a title="<?=$row['product_name']?>" href="<?=$row['prd_permalink']?>">
    						<?=$row['product_name']?>
    					</a>
    				</div>
    				<div class="prod-hl-brand">
    					<a href="<?=$row['brand_permalink']?>"><?=$row['brand_name']?></a>
    				</div>
    				<div class="product-rate">
    					<span class="rating-box" title="<?=$vote?> sao">
    						<?php 
    						  for ($i = 1; $i < 6; $i++) {
    						      if ($i < $vote) {
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
    					<span class="amount-rate"><?=$sum_vote?> đánh giá</span>
    				</div>
    				<div class="product-price list-product-price">
    					<span class="product-price-meta"><?=Common::convertMoney($row['product_sell_price'])?></span>
    					<span class="product-price-old"><?=Common::convertMoney($row['product_old_price'])?></span>
    				</div>
    			</li>
				<?php 
				    }
				}
				?>
			</ul>
	</div>
	<div class="cat-product-highlight">
		<div class="title-bar-hl">
			<div class="title-bar-left">Thiết bị điện nổi bật</div>
			<div class="title-bar-right">
				<a href="<?=Common::$_GROUP_THIET_BI_DIEN_NOI_BAT?>"
					title="Thiết bị điện nổi bật">Xem tất cả sản phẩm</a>
			</div>
		</div>
		<div class="list-product-highlight spotlight-products"
			id="spotlight-prod-20" data-spotlight="20" data-start="8"
			data-pagenum="1" data-pages="8" data-max="30" data-length="5"
			data-maxpage="6">
			<ul class="owl-carousel product-highlight-wrap" data-pagecount="6"
				data-curpos="0">
				<?php 
        		$sql = "SELECT B.permalink AS prd_permalink, B.data_table";
        		$sql .= ", A.product_id, A.product_name, A.product_code ";
        		$sql .= " , A.product_old_price, A.product_down_price, A.product_sell_price ";
        		$sql .= " , A.brand_id, C.brand_name ";
        		$sql .= " , D.permalink AS brand_permalink ";
        		$sql .= " , E.image_title, E.image_url ";
        		$sql .= " , F.one_star, F.two_star, F.three_star, F.four_star, F.five_star ";
        		$sql .= " FROM np_prod_group P ";
        		$sql .= " INNER JOIN np_product A ON P.group_id = A.group_id ";
        		$sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
        		$sql .= " LEFT OUTER JOIN np_prod_brand C ON A.brand_id = C.brand_id ";
        		$sql .= " LEFT OUTER JOIN np_permalink D ON C.data_id = D.data_id ";
        		$sql .= " INNER JOIN np_prod_image E ON A.product_id = E.product_id AND E.image_type = '1' ";
        		$sql .= " LEFT OUTER JOIN np_prod_vote F ON A.product_id = F.product_id ";
        		$sql .= " WHERE  P.group_type = '" .Common::$_GROUP_THIET_BI_DIEN_TYPE. "' ";
        		$sql .= " AND  A.delete_flag = '0' ";
        		$sql .= " GROUP BY A.product_id ";
        		$sql .= " ORDER BY A.product_count_view DESC ";
        		$sql .= " Limit 5 ";
        		
        		$group2_2_result = $conn->query($sql);
        		if ($group2_2_result->num_rows > 0) {
        		    while ($row = $group2_2_result->fetch_assoc()) {
        		        $sum_vote = 0;
        		        $vote = 0;
        		        $sum_vote = $row['one_star'] + $row['two_star'] + $row['three_star'] + $row['four_star'] + $row['five_star'];
        		        if ($sum_vote != 0){
            		        $vote = ($row['one_star'] * 1 + $row['two_star'] * 2 + $row['three_star'] * 3 + $row['four_star'] * 4 + $row['five_star'] * 5 )
            		              / $sum_vote;
        		        }
        		?>
				<li class="product-highlight-item prod-item " data-pid="44679">
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
						<a href="<?=$row['prd_permalink']?>" title="<?=$row['product_name']?>">
							<img src="npad/<?=$row['image_url']?>"
							width="200" height="200" class="thumb-list is-thumb">
						</a>
					</div>
					<div class="prod-hl-name">
						<a title="<?=$row['product_name']?>" href="<?=$row['prd_permalink']?>">
    						<?=$row['product_name']?>
    					</a>
					</div>
					<div class="prod-hl-brand">
						<a href="<?=$row['brand_permalink']?>"><?=$row['brand_name']?></a>
					</div>
					<div class="product-rate">
						<span class="rating-box" title="<?=$vote?> sao">
    						<?php 
    						  for ($i = 1; $i < 6; $i++) {
    						      if ($i < $vote) {
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
    					<span class="amount-rate"><?=$sum_vote?> đánh giá</span>
					</div>
					<div class="product-price list-product-price">
						<span class="product-price-meta list-product-meta-price"><?=Common::convertMoney($row['product_sell_price'])?></span>
						<span class="product-price-old list-product-old-price"><?=Common::convertMoney($row['product_old_price'])?></span>
					</div>
				</li>
				<?php 
        			    }
        			}
        		?>
			</ul>
<!-- 			<nav> -->
<!-- 				<div class="arrow-preview-product" data-page="8"> -->
<!-- 					<label class="arrow-left prev"> -->
<!-- 						<i class="fa fa-angle-left"></i> -->
<!-- 					</label> -->
<!-- 					<label class="arrow-right next"> -->
<!-- 						<i class="fa fa-angle-right"></i> -->
<!-- 					</label> -->
<!-- 				</div> -->
<!-- 			</nav> -->
		</div>
	</div>
</div>