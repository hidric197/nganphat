<form action="" method="get" name="form_filter_brand" id="form_filter_brand">
<?php 
$filter_brand = '';
if (isset($_GET['filter_brand']) && !empty($_GET['filter_brand'])) {
    $filter_brand = $_GET['filter_brand'];
}

$filter_price = '';
if (isset($_GET['filter_price']) && !empty($_GET['filter_price'])) {
    $filter_price = $_GET['filter_price'];
}
?>
<div class="body-left-box filter-brand">
	<div class="body-left-box-title">Thương hiệu</div>
	<div class="body-left-box-inner">
		<ul class="list-filter list-brand-check ls-brand-check" style="">
		<?php 
    		$sqlBrand = "SELECT A.brand_id, A.brand_name FROM np_prod_brand A ";
       		$sqlBrand .= " WHERE A.delete_flag = '0' ";
       		
        	$resultBrand = $conn->query($sqlBrand);
    		if ($resultBrand->num_rows > 0) {
    		    while ($rowBrand = $resultBrand->fetch_assoc()) {
		?>
			<li class="filter-item" title="<?=$rowBrand['brand_name']?>">
				<label for="filter_brand_<?=$rowBrand['brand_id']?>" class="select-filter-item" onclick="submitFormFilterBrand('<?=$rowBrand['brand_id']?>');">
					<input class="chk-price-select" id="filter_brand_<?=$rowBrand['brand_id']?>" type="checkbox" name="filter_brand_<?=$rowBrand['brand_id']?>" value="" <?php if($filter_brand == $rowBrand['brand_id']) echo "checked='checked'"; ?> >
					<span title="<?=$rowBrand['brand_name']?>" class="price-checker-link filter-check"></span>
					<span class="filter-link"><?=$rowBrand['brand_name']?>
					</span>
				</label>
			</li>
		<?php 
    		  }
    		}
		?>
		</ul>
	</div>
</div>
	<input type="hidden" name="filter_brand" id="filter_brand" value="<?=$filter_brand?>">
	<input type="hidden" name="filter_price" value="<?=$filter_price?>">
</form>
<script language="JavaScript" type="text/javascript">
	function submitFormFilterBrand(brandId) {
		const params = new URLSearchParams(window.location.search)
		let url = "?filter_brand=" + brandId
		if (params.has('filter_price')) {
			url = "?filter_brand="+ brandId + "&filter_price=" + params.get('filter_price')
		}
		location.href = url
		// document.getElementById("form_filter_brand").submit();
	}	
</script>