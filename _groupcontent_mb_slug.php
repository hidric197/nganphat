<?php 
if ($home_pmk == Common::$_GROUP_THIET_BI_VE_SINH) {
?>

<ol class="breadcrum-cat-box">
<?php 
$name_group = 'Thiết bị vệ sinh';

?>
	<li class="breadcrum-cat-item home">
		<a href="<?=Common::$_HOME_PAGE?>" title="Về trang chủ">
			<img align="top" height="18px" alt="Trang chủ"
				src="template/images/icon-home.png">
		</a>
		<i class="fa fa-angle-right"></i>
	</li>
	<li class="breadcrum-cat-item nav1 has-chidren" data-prevent="1">
		<span title="<?=$name_group?>"><?=$name_group?></span>
		<i class="fa fa-angle-right"></i>  
	</li>
</ol>

<?php 
} else if ($home_pmk == Common::$_GROUP_THIET_BI_DIEN) {
?>

<ol class="breadcrum-cat-box">
<?php 
$name_group = 'Thiết bị điện';

?>
	<li class="breadcrum-cat-item home">
		<a href="<?=Common::$_HOME_PAGE?>" title="Về trang chủ">
			<img align="top" height="18px" alt="Trang chủ"
				src="template/images/icon-home.png">
		</a>
		<i class="fa fa-angle-right"></i>
	</li>
	<li class="breadcrum-cat-item nav1 has-chidren" data-prevent="1">
		<span title="<?=$name_group?>"><?=$name_group?></span>
		<i class="fa fa-angle-right"></i>  
	</li>
</ol>

<?php 
} else if ($home_pmk == Common::$_GROUP_THIET_BI_NHA_BEP) {
    ?>

<ol class="breadcrum-cat-box">
<?php 
$name_group = 'Thiết bị nhà bếp';

?>
	<li class="breadcrum-cat-item home">
		<a href="<?=Common::$_HOME_PAGE?>" title="Về trang chủ">
			<img align="top" height="18px" alt="Trang chủ"
				src="template/images/icon-home.png">
		</a>
		<i class="fa fa-angle-right"></i>
	</li>
	<li class="breadcrum-cat-item nav1 has-chidren" data-prevent="1">
		<span title="<?=$name_group?>"><?=$name_group?></span>
		<i class="fa fa-angle-right"></i>  
	</li>
</ol>

<?php 
} else if ($home_pmk == 'flash-sale') {
    ?>

<ol class="breadcrum-cat-box">
<?php 
$name_group = 'Sản phẩm Flash sale';

?>
	<li class="breadcrum-cat-item home">
		<a href="<?=Common::$_HOME_PAGE?>" title="Về trang chủ">
			<img align="top" height="18px" alt="Trang chủ"
				src="template/images/icon-home.png">
		</a>
		<i class="fa fa-angle-right"></i>
	</li>
	<li class="breadcrum-cat-item nav1 has-chidren" data-prevent="1">
		<span title="<?=$name_group?>"><?=$name_group?></span>
		<i class="fa fa-angle-right"></i>  
	</li>
</ol>

<?php 
} else if ($home_pmk == 'tim-kiem'){
    ?>

<ol class="breadcrum-cat-box">
<?php 
$name_group = '';
if (isset($_POST['txtQuerySearch'])) {
    $name_group = $_POST['txtQuerySearch'];
}

?>
	<li class="breadcrum-cat-item home">
		<a href="<?=Common::$_HOME_PAGE?>" title="Về trang chủ">
			<img align="top" height="18px" alt="Trang chủ"
				src="template/images/icon-home.png">
		</a>
		<i class="fa fa-angle-right"></i>
	</li>
	<li class="breadcrum-cat-item nav1 has-chidren" data-prevent="1">
		<span title="<?=$name_group?>"><?=$name_group?></span>
		<i class="fa fa-angle-right"></i>  
	</li>
</ol>

<?php 
} else if ($home_table_name == Common::$_TABLE_NP_PROD_GROUP || $home_table_name == Common::$_TABLE_NP_PROD_FILTER){
?>
<ol class="breadcrum-cat-box">
<?php
    $name_group = '';
    $pmk_group = '';
    $sql0 = "SELECT D.permalink, A.group_id, A.group_name ";
    $sql0 .= " FROM np_prod_group A ";
    $sql0 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
    if ($home_table_name == Common::$_TABLE_NP_PROD_GROUP) {
        $sql0 .= " WHERE D.permalink = '$home_estr_pmk' AND A.delete_flag = '0'";
    } else if ($home_table_name == Common::$_TABLE_NP_PROD_FILTER) {
        $sql0 .= " WHERE A.group_id = '$home_group_id' AND A.delete_flag = '0'";
    }
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {
            $name_group = $row0['group_name'];
            $pmk_group = $row0['permalink'];
        }
    }
    ?>
    	<li class="breadcrum-cat-item nav1 has-chidren" data-prevent="1"><a
    			href="<?=$pmk_group?>" title="<?=$name_group?>"><?=$name_group?></a>
    				<i class="fa fa-angle-right"></i>  
    		</li>
    	
    </ol>
    <?php 
} else if ($home_table_name == Common::$_TABLE_NP_PROD_BRAND) {

?>
<ol class="breadcrum-cat-box">
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
<?php 
} else if ($home_table_name == Common::$_TABLE_NP_PROD_TAG) {
    
    ?>
<ol class="breadcrum-cat-box">
<?php
    $name_group = '';
    $pmk_group = '';
    $listTagId = '';
    $sql0 = "SELECT D.permalink, A.tag_id, A.tag_name ";
    $sql0 .= " FROM np_prod_tag A ";
    $sql0 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
    $sql0 .= " WHERE D.permalink = '$home_estr_pmk' AND A.delete_flag = '0'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {
            $name_group = $row0['tag_name'];
            $pmk_group = $row0['permalink'];
            $listTagId = $row0['tag_id'];
        }
    }
?>
	<li class="breadcrum-cat-item nav1 has-chidren" data-prevent="1">
		<a href="<?=$pmk_group?>" title="<?=$name_group?>"><?=$name_group?></a>
		<i class="fa fa-angle-right"></i>  
	</li>
</ol>
<?php 
} 
?>
