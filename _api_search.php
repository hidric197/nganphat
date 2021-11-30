<?php
include 'npad/model/db/DBManager.php';
include 'npad/common/Common.php';

$conn = DBManager::getConnection();
$keyword = $_REQUEST['keyword'];

if (!empty($keyword)){
    
$n = 1;
?>
</style>
<div class="ac_wrapper" style="position: relative; padding-bottom: 30px; z-index: 999;">
	<ul class="ac_list" style="max-height: 360px; overflow: auto;">
	<?php 
	$sql = "SELECT B.permalink AS prd_permalink, B.data_table";
	$sql .= ", A.product_id, A.product_name, A.product_code ";
	$sql .= " , E.image_title, E.image_url ";
	$sql .= " FROM np_product A ";
	$sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
	$sql .= " INNER JOIN np_prod_image E ON A.product_id = E.product_id AND E.image_type = '1' ";
	$sql .= " WHERE  A.product_name LIKE '%". $keyword. "%' ";
	$sql .= " OR  A.product_code LIKE '%". $keyword. "%' ";
	$sql .= " GROUP BY  A.product_id ";
	$sql .= " ORDER BY product_count_view DESC ";
	$sql .= " LIMIT 20 ";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    while ($row = $result->fetch_assoc()) {
	        
	        $style = '';
	        if($n % 2 == 0){
	            $style = 'ac_odd';
	            $color = '#eee';
	        } else {
	            $style = 'ac_even';
	            $color = '#fff';
	        }
	        
	        $n ++;
	?>
		<li class="<?=$style?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr id="<?=$row['product_id']?>">
						<td width="30" class="ac-img">
						<div onmouseover="changeColorRow('<?=$row['product_id']?>');" onmouseout="changeBackColor('<?=$row['product_id']?>','<?=$color?>');">
							<a href="<?=$row['prd_permalink']?>">
								<img src="npad/<?=$row['image_url']?>" width="42" height="42" align="absmiddle">
    							<?=$row['product_name']?>
								<span style="color: red">Chi tiết</span>
							</a>
						</div>
						</td>
					</tr>
				</tbody>
			</table>
		</li>
	<?php 
	    }
	} else {
	?>
		<li class='ac_even'>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td height="40" class="ac-img" align="center" style="font-size: 20px; font-weight: bold;">
							Không tìm thấy sản phẩm nào phù hợp.
						</td>
					</tr>
				</tbody>
			</table>
		</li>
	<?php 
	    }
	?>
  </ul>
</div>
<?php 
} else {
?>
<style>
.trend-catalog {
	margin-top: 15px;
	background: #fff;
	padding-bottom: 5px
}
.trend-catalog-title {
	padding: 10px 10px 10px 40px;
	position: relative
}

.trend-catalog-title:before {
	background: url(https://meta.vn/Data/image/2021/01/13/hot-category.png)
		no-repeat;
	content: "";
	background-size: 28px;
	width: 28px;
	height: 28px;
	position: absolute;
	top: 8px;
	left: 5px
}

.trend-catalog-title h2 {
	font-weight: bold
}

</style>
<div class="ac_wrapper" style="position: relative; padding-bottom: 30px; z-index: 999;">
	<ul class="ac_list" style="max-height: 360px; overflow: auto;">
  <div class="trend-catalog wrap-catalog-main">
	<div class="trend-catalog-title">
		<h2>Danh mục nổi bật</h2>
	</div>
	<div class="wrap-catalog-main">
			<ul
				class="list-catalog-main">
				<?php
				$sqlGroup = "SELECT B.permalink, A.group_id, A.group_name, A.image_title, A.image_url ";
				$sqlGroup .= " FROM np_prod_group A ";
				$sqlGroup .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
				$sqlGroup .= " WHERE A.delete_flag = '0' ";
				$sqlGroup .= " LIMIT 12 ";
				
        		$result1 = $conn->query($sqlGroup);
        		if ($result1->num_rows > 0) {
        		    while ($row1 = $result1->fetch_assoc()) {
        	?>
				
				<li class="catalog-main-item"><a href="<?=$row1['permalink']?>"
					title="<?=$row1['group_name']?>">
					<div class="icon-cat-main-thumb">
						<span><img class="lazy-img lazy-loaded" alt="<?=$row1['image_title']?>"
								data-src="npad/<?=$row1['image_url']?>"
								src="npad/<?=$row1['image_url']?>">
						</span>
					</div>
					<div class="name-cat-main"><?=$row1['group_name']?>
					</div>
						</a>
				</li>
			<?php 
        		    }
        		}
			?>
			</ul>
		</div>
	</div>
 </ul>
 </div>
<?php 
}
?>
<?php
DBManager::closeConn($conn);
?>