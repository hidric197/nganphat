<form action="" method="GET" name="form_filter_price" id="form_filter_price">
<?php 
$filter_brand = '';
if (isset($_GET['filter_brand']) && !empty($_GET['filter_brand'])) {
    $filter_brand = $_GET['filter_brand'];
}

$filter_price = '';
if (isset($_GET['filter_price']) && !empty($_GET['filter_price'])) {
    $filter_price = $_GET['filter_price'];
}

$filter_type = '';
if (isset($_GET['filter_type']) && !empty($_GET['filter_type'])) {
    $filter_type = $_GET['filter_type'];
}
$group_type_sql = "SELECT pg.group_name, pg.data_id, pl.permalink, pg.group_level_up FROM np_prod_group AS pg INNER JOIN  np_permalink AS pl ON pg.data_id = pl.data_id WHERE pg.group_level = $home_level_group+1 AND pg.group_level_up = $home_group_id";
$group_type = $conn->query($group_type_sql);
?>
<div class="body-left-box filter-price">
	<?php if($home_level_group == 1) { ?>
	<div class="body-left-box-title">Lọc theo loại sản phẩm</div>
	<?php } elseif ($home_level_group == 2) { ?>
	<div class="body-left-box-title">Danh mục khác</div>
	<?php } ?>
	<div class="body-left-box-inner">
		<ul class="list-filter" style="">
			<?php while ($value =  $group_type->fetch_assoc()) { ?>
			<li class="filter-item">
				<label for="filter_price_<?= $value['data_id']?>" class="select-filter-item" onclick="submitFormFilterType(<?= $value['data_id']?>, '<?= $value['permalink']?>');">
					<input class="chk-price-select" id="filter_price_<?= $value['data_id']?>" type="checkbox" name="filter_price_<?= $value['data_id']?>">
					<span title="Dưới 100 Ngàn" class="price-checker-link filter-check"></span>
					<span class="filter-link"><?= $value['group_name']?>
					</span>
				</label>
			</li>
		<?php  } ?>
		</ul>
	</div>
</div>
	<!-- <input type="hidden" name="filter_price" id="filter_price" value="<?=$filter_price?>">
	<input type="hidden" name="filter_brand" value="<?=$filter_brand?>"> -->
</form>
<script language="JavaScript" type="text/javascript">
	function submitFormFilterType(groupId, permalink) {
		let url = '/'+permalink;
		location.href = url
	}	
</script>