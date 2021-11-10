<ol class="breadcrum-cat-box">
	<li class="breadcrum-cat-item home">
		<a href="<?=Common::$_HOME_PAGE?>" title="Về trang chủ">
			<img align="top" height="18px" alt="Trang chủ"
				src="template/images/icon-home.png">
		</a>
		<i class="fa fa-angle-right"></i>
	</li>
<?php
    $listBrandId = '';
    $name_group = '';
    $pmk_group = '';
    $sql0 = "SELECT D.permalink, A.brand_id, A.brand_name ";
    $sql0 .= " FROM np_prod_brand A ";
    $sql0 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
    $sql0 .= " WHERE D.permalink = '$home_estr_pmk' AND A.delete_flag = '0'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {
            $name_group = $row0['brand_name'];
            $listBrandId = $row0['brand_id'];
            $pmk_group = $row0['permalink'];
        }
    }
?>
	<li class="breadcrum-cat-item nav1 has-chidren" data-prevent="1">
		<a href="<?=$pmk_group?>" title="<?=$name_group?>"><?=$name_group?></a>
		<i class="fa fa-angle-right"></i>  
	</li>
</ol>
