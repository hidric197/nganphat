<ol class="breadcrum-cat-box">

<?php
    $pmk_group_link = '';
    $name_group_link = '';
    $pmk_group = '';
    $name_group = '';
    $prod_brand_id = '';
    $sql0 = "SELECT E.permalink, A.group_id, A.group_name, F.brand_id, G.permalink AS list_brandpremalink ";
    $sql0 .= " FROM np_prod_group A ";
    $sql0 .= " INNER JOIN np_product B ON A.group_id = B.group_id ";
    $sql0 .= " INNER JOIN np_permalink D ON B.data_id = D.data_id ";
    $sql0 .= " LEFT OUTER JOIN np_prod_brand F ON B.brand_id = F.brand_id ";
    $sql0 .= " LEFT OUTER JOIN np_permalink G ON F.data_id = G.data_id ";
    $sql0 .= " INNER JOIN np_permalink E ON A.data_id = E.data_id ";
    $sql0 .= " WHERE D.permalink = '$home_estr_pmk' AND A.delete_flag = '0'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {
            $name_group = $row0['group_name'];
            $pmk_group = $row0['permalink'];
            $prod_brand_id = $row0['brand_id'];
        }
    }
    $pmk_group_link = $pmk_group;
    $name_group_link = $name_group;
?>

	<li class='breadcrum-cat-item nav2 has-chidren' data-prevent="2">
		<a href="<?=$pmk_group?>" title="<?=$name_group?>"><?=$name_group?></a>
		<i class="fa fa-angle-right"></i>
	</li>
		
<?php
    $pmk_group = '';
    $name_group = '';
    $sql0 = "SELECT D.permalink, A.product_name, A.product_id";
    $sql0 .= " FROM np_product A ";
    $sql0 .= " INNER JOIN np_permalink D ON A.data_id = D.data_id ";
    $sql0 .= " WHERE D.permalink = '$home_estr_pmk' AND A.delete_flag = '0'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {
            $name_group = $row0['product_name'];
            $pmk_group = $row0['permalink'];
        }
    }
?>
	<li class='breadcrum-cat-item nav3' data-prevent="3">
		<a href="<?=$pmk_group?>" title="<?=$name_group?>"><?=$name_group?></a>
		<i class="fa fa-angle-right"></i>
	</li>
</ol>