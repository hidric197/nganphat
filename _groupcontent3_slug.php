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
	   if ($home_group_type == '1') {
		    $sql1 = "SELECT D.permalink, A.group_id, A.group_name ";
		    $sql1 .= " FROM np_prod_group A ";
		    $sql1 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
		    $sql1 .= " WHERE A.group_type = '1' AND A.group_level = '1' AND A.delete_flag = '0'";
	   } else if($home_group_type == '2') {
		    $sql1 = "SELECT D.permalink, A.group_id, A.group_name ";
		    $sql1 .= " FROM np_prod_group A ";
		    $sql1 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
		    $sql1 .= " WHERE A.group_type = '2' AND A.group_level = '1' AND A.delete_flag = '0'";
	   } else if($home_group_type == '3'){
		    $sql1 = "SELECT D.permalink, A.group_id, A.group_name ";
		    $sql1 .= " FROM np_prod_group A ";
		    $sql1 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
		    $sql1 .= " WHERE A.group_type = '3' AND A.group_level = '1' AND A.delete_flag = '0'";
		} 
		$result10 = $conn->query($sql1);
		if ($result10->num_rows > 0) {
	?>
		<div class="breadcrum-cat-menu parent">
			<ul>
				<?php 
				while ($row1 = $result10->fetch_assoc()) {
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
	
	<?php
    	$name_group = '';
    	$pmk_group = '';
    	$id_group = '';
        $sql0 = "SELECT F.permalink, E.group_name, E.group_id ";
        $sql0 .= " FROM np_prod_group A ";
        $sql0 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
        $sql0 .= " INNER JOIN np_prod_group E ON E.group_id = A.group_level_up ";
        $sql0 .= " INNER JOIN np_permalink F ON E.data_id = F.data_id ";
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
                $id_group = $row0['group_id'];
            }
        }
    ?>
		<li class="breadcrum-cat-item nav1 has-chidren" data-prevent="1"><a
				href="<?=$pmk_group?>" title="<?=$name_group?>"><?=$name_group?></a>
				<i class="fa fa-angle-right"></i> 
		<?php
		    $sql1 = "SELECT D.permalink, A.group_id, A.group_name ";
		    $sql1 .= " FROM np_prod_group A ";
		    $sql1 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
		    $sql1 .= " WHERE A.group_level_up = '$id_group' AND A.delete_flag = '0'";
		    
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
	
	<?php
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
            }
        }
    ?>
		<li class="breadcrum-cat-item nav1 has-chidren" data-prevent="1"><a
				href="<?=$home_pmk?>" title="<?=$name_group?>"><?=$name_group?></a>
				<i class="fa fa-angle-right"></i>  
	</li>
</ol>