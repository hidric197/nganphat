<div class="s-detail-breadcrumb">
	<ol class="list-s-breadcrumb">
		<li class="s-breadcrumb-item home">
			<a href="<?=Common::$_HOME_PAGE?>">
				<span class="icon-home-s"></span>
				<span class="txt-icon-home-s"></span>
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<?php
        $name_group = '';
        $sql0 = "SELECT B.page_group_name ";
        $sql0 .= " FROM np_page A ";
        $sql0 .= " INNER JOIN np_page_group B ON A.page_group_id = B.page_group_id ";
        $sql0 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
        $sql0 .= " WHERE D.permalink = '$home_estr_pmk' AND A.delete_flag = '0'";
        $result0 = $conn->query($sql0);
        if ($result0->num_rows > 0) {
            while ($row0 = $result0->fetch_assoc()) {
                $name_group = $row0['page_group_name'];
            }
        }
    ?>
		<li class="s-breadcrumb-item">
			<span title="<?=$name_group?>"><?=$name_group?></span>
			<i class="fa fa-angle-right"></i>
		</li>
	</ol>
</div>