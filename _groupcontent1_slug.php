<ol class="breadcrum-cat-box">
			<li class="breadcrum-cat-item home"><a href="<?=Common::$_HOME_PAGE?>"
	title="Về trang chủ"><img align="top" height="18px"
		alt="Trang chủ" src="template/images/icon-home.png"></a><i
	class="fa fa-angle-right"></i></li>
	<?php
        $name_group = '';
        $pmk_group = '';
        if ($home_pmk == Common::$_GROUP_THIET_BI_VE_SINH || $home_group_type == '1') {
            $name_group = 'Thiết bị vệ sinh';
            $pmk_group = Common::$_GROUP_THIET_BI_VE_SINH;
        } else if ($home_pmk == Common::$_GROUP_THIET_BI_NHA_BEP || $home_group_type == '2') {
            $name_group = 'Thiết bị nhà bếp';
            $pmk_group = Common::$_GROUP_THIET_BI_NHA_BEP;
        } else if ($home_pmk == Common::$_GROUP_THIET_BI_DIEN || $home_group_type == '3') {
            $name_group = 'Thiết bị điện';
            $pmk_group = Common::$_GROUP_THIET_BI_DIEN;
        } 
    ?>
		<li class="breadcrum-cat-item nav1 has-chidren" data-prevent="1"><a
				href="<?=$pmk_group?>" title="<?=$name_group?>"><?=$name_group?></a>
				<i class="fa fa-angle-right"></i>  
	<?php
	   if ($home_pmk == Common::$_GROUP_THIET_BI_VE_SINH || $home_group_type == '1') {
		    $sql1 = "SELECT D.permalink, A.group_id, A.group_name ";
		    $sql1 .= " FROM np_prod_group A ";
		    $sql1 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
		    $sql1 .= " WHERE A.group_type = '1' AND A.group_level = '1' AND A.delete_flag = '0'";
	   } else if($home_pmk == Common::$_GROUP_THIET_BI_NHA_BEP || $home_group_type == '2') {
		    $sql1 = "SELECT D.permalink, A.group_id, A.group_name ";
		    $sql1 .= " FROM np_prod_group A ";
		    $sql1 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
		    $sql1 .= " WHERE A.group_type = '2' AND A.group_level = '1' AND A.delete_flag = '0'";
	   } else if($home_pmk == Common::$_GROUP_THIET_BI_DIEN  || $home_group_type == '3'){
		    $sql1 = "SELECT D.permalink, A.group_id, A.group_name ";
		    $sql1 .= " FROM np_prod_group A ";
		    $sql1 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
		    $sql1 .= " WHERE A.group_type = '3' AND A.group_level = '1' AND A.delete_flag = '0'";
		} 
		$result1 = $conn->query($sql1);
		if ($result1->num_rows > 0) {
	?>
		<div class="breadcrum-cat-menu parent">
			<ul>
				<?php 
				while ($row1 = $result1->fetch_assoc()) {
				?>
				<li class="breadcrum-cat-menu-item">
					<a href="<?=$row1['permalink']?>"><?=$row1['group_name']?></a>
				</li>
				<?php 
				}
				?>
			</ul>
		</div>
	<?php 
		}
	?>
	</li>
</ol>