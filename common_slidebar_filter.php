<?php 
    
	$sqlFilter = "SELECT A.prod_filter_id, A.prod_filter_name, B.permalink AS filter_permalink FROM np_prod_filter A ";
	$sqlFilter .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
//  $sqlFilter .= " INNER JOIN np_product C ON C.Filter_id = A.Filter_id ";
	$sqlFilter .= " WHERE A.delete_flag = '0' AND A.group_id = '$home_group_id'";
	
	$resultFilter = $conn->query($sqlFilter);
	if ($resultFilter->num_rows > 0) {
?>
<div class="body-left-box filter-Filter">
	<div class="body-left-box-title">Nhóm thương Hiệu</div>
	<div class="body-left-box-inner">
		<ul class="list-filter list-Filter-check ls-Filter-check" style="">
		<?php 
    		    while ($rowFilter = $resultFilter->fetch_assoc()) {
		?>
			<li class="filter-item ">
    			<label> 
    				<span title="<?=$rowFilter['prod_filter_name']?>"></span> 
    				<a href="<?=$rowFilter['filter_permalink']?>" title="<?=$rowFilter['prod_filter_name']?>" class="filter-link" 
    				    <?php if($home_prod_filter_id == $rowFilter['prod_filter_id']) echo 'style="color:#da251c;"'; ?> >
    					<?=$rowFilter['prod_filter_name']?></a>
    			</label>
			</li>
		<?php 
    		}
		?>
		</ul>
<!-- 		<div class="view-more-filter-left"> -->
<!-- 			<a href="https://nganphat.com.vn/giadung/#">Xem thêm <i -->
<!-- 				class="fa fa-angle-double-down"></i></a> -->
<!-- 		</div> -->
	</div>
</div>
<?php 
	} else {
	    $filter_check = '0';
	}
?>