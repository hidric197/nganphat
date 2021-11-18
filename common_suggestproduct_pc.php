<div class="trend-product-catalog trend-home-page">
	<div class="trend-list-product-title">
		<h2>Gợi ý cho bạn</h2>
	</div>
	<div class="cat-product-highlight">
		<ul class="product-highlight-wrap">
		<?php
    		$sqlod = "SELECT product_id, sum(order_quality) AS sum_order FROM `order_product`
                    GROUP BY product_id
                    ORDER BY sum_order DESC
                    Limit 5 ";
    		$resultod = $conn->query($sqlod);
    		$productIdList = '';
    		if ($resultod->num_rows > 0) {
    		    while ($rowod = $resultod->fetch_assoc()) {
    		        $productIdList .= "'" .$rowod['product_id']. "',";
    		    }
    		}
    		if (!empty($productIdList)) {
    		  $productIdList = substr($productIdList, 0, -1);
    		}
		      
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
    		$sql .= " WHERE  A.delete_flag = '0' AND A.product_id IN (" .$productIdList. ") ";

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
			<li class="product-highlight-item prod-item" data-pid="70853">
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
</div>