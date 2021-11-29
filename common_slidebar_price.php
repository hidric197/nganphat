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
?>
<div class="body-left-box filter-price">
	<div class="body-left-box-title">Lọc theo giá</div>
	<div class="body-left-box-inner">
		<ul class="list-filter" style="">
			<li class="filter-item" title="Dưới 100 Ngàn">
				<label for="filter_price_1" class="select-filter-item" onclick="submitFormFilterPrice('01', 'filter_price_1');">
					<input class="chk-price-select" id="filter_price_1" type="checkbox" name="filter_price_1" value="01" <?php if($filter_price == '01') echo "checked='checked'"; ?> >
					<span title="Dưới 100 Ngàn" class="price-checker-link filter-check"></span>
					<span class="filter-link">Dưới 100 Ngàn
					</span>
				</label>
			</li>
			<li class="filter-item" title="Từ 100 - 500 Ngàn">
				<label for="filter_price_2" class="select-filter-item" onclick="submitFormFilterPrice('02', 'filter_price_2');">
					<input class="chk-price-select" id="filter_price_2" type="checkbox" name="filter_price_2" value="02"  <?php if($filter_price == '02') echo "checked='checked'"; ?> >
					<span title="Từ 100 - 500 Ngàn" class="price-checker-link filter-check"></span>
					<span class="filter-link">Từ 100 - 500 Ngàn
					</span>
				</label>
			</li>
			<li class="filter-item" title="Từ 500K - 1 Triệu">
				<label for="filter_price_3" class="select-filter-item" onclick="submitFormFilterPrice('03', 'filter_price_3');">
					<input class="chk-price-select" id="filter_price_3" type="checkbox" name="filter_price_3" value="03"  <?php if($filter_price == '03') echo "checked='checked'"; ?> >
					<span title="Từ 500K - 1 Triệu" class="price-checker-link filter-check"></span>
					<span class="filter-link">Từ 500K - 1 Triệu
					</span>
				</label>
			</li>
			<li class="filter-item" title="Từ 1 - 2 Triệu">
				<label for="filter_price_4" class="select-filter-item" onclick="submitFormFilterPrice('04', 'filter_price_4');">
					<input class="chk-price-select" id="filter_price_4" type="checkbox" name="filter_price_4" value="04" <?php if($filter_price == '04') echo "checked='checked'"; ?> >
					<span title="Từ 1 - 2 Triệu" class="price-checker-link filter-check"></span>
					<span class="filter-link">Từ 1 - 2 Triệu
					</span>
				</label>
			</li>
			<li class="filter-item" title="Từ 2 - 5 Triệu">
				<label for="filter_price_5" class="select-filter-item" onclick="submitFormFilterPrice('05', 'filter_price_5');">
					<input class="chk-price-select" id="filter_price_5" type="checkbox" name="filter_price_5" value="05" <?php if($filter_price == '05') echo "checked='checked'"; ?> >
					<span title="Từ 2 - 5 Triệu" class="price-checker-link filter-check"></span>
					<span class="filter-link">Từ 2 - 5 Triệu
					</span>
				</label>
			</li>
			<li class="filter-item" title="Từ 5 - 10 Triệu">
				<label for="filter_price_6" class="select-filter-item" onclick="submitFormFilterPrice('06', 'filter_price_6');">
					<input class="chk-price-select" id="filter_price_6" type="checkbox" name="filter_price_6" value="06" <?php if($filter_price == '06') echo "checked='checked'"; ?> >
					<span title="Từ 5 - 10 Triệu" class="price-checker-link filter-check"></span>
					<span class="filter-link">Từ 5 - 10 Triệu
					</span>
				</label>
			</li>
			<li class="filter-item" title="Từ 10 - 20 triệu">
				<label for="filter_price_7" class="select-filter-item" onclick="submitFormFilterPrice('07','filter_price_7');">
					<input class="chk-price-select" id="filter_price_7" type="checkbox" name="filter_price_7" value="07" <?php if($filter_price == '07') echo "checked='checked'"; ?> >
					<span title="Từ 10 - 20 triệu" class="price-checker-link filter-check"></span>
					<span class="filter-link">Từ 10 - 20 triệu
					</span>
				</label>
			</li>
			<li class="filter-item" title="Trên 20 Triệu">
				<label for="filter_price_8" class="select-filter-item" onclick="submitFormFilterPrice('08', 'filter_price_8');">
					<input class="chk-price-select" id="filter_price_8" type="checkbox" name="filter_price_8" value="08" <?php if($filter_price == '08') echo "checked='checked'"; ?> >
					<span title="Trên 20 Triệu" class="price-checker-link filter-check"></span>
					<span class="filter-link">Trên 20 Triệu
					</span>
				</label>
			</li>
		</ul>
	</div>
</div>
	<!-- <input type="hidden" name="filter_price" id="filter_price" value="<?=$filter_price?>">
	<input type="hidden" name="filter_brand" value="<?=$filter_brand?>"> -->
</form>
<script language="JavaScript" type="text/javascript">
	function submitFormFilterPrice(priceId, domId) {
		var dom = document.getElementById(domId);
		const params = new URLSearchParams(window.location.search)
		let filter_price = dom.checked ? "filter_price=" + priceId : ''
		let url = dom.checked ? ("?filter_price=" + priceId) : "?"
		if (params.has('filter_brand')) {
			url = "?filter_brand="+ params.get('filter_brand') + (filter_price ? "&" + filter_price : '')
		} 
		location.href = url
		// document.getElementById("filter_price").value = priceId;
		// document.getElementById("form_filter_price").submit();
	}	
</script>