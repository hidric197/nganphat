<div class="row">
	<ol class="breadcrumb">
		<li><a href="index.php"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Quản lý Order Sản Phẩm</li>
	</ol>
</div>
<!--/.row-->

<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh sách Order</button></a>
		</br></br></br>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "edit") {
    $message = "";
    if (isset($_REQUEST['submit']))
    {
        $id = $_POST['id'];
        $order_status = $_POST['order_status'];
        
        $sql = "UPDATE np_order SET order_status = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE order_id = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $order_status, $id);
        $stmt->execute();
        
        $message = $INFO_UPDATE_DATA_OK;
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        
        $id = $conn->real_escape_string($_REQUEST['id']);        
        $sql = "SELECT A.order_id, A.order_full_name, A.order_phone, A.order_email ";
        $sql .= " , A.order_address, A.order_other, A.order_status FROM np_order A ";
        $sql .= " WHERE A.order_id = '$id' AND A.delete_flag = '0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Chi tiết Order <?=$message?></div>
			<div class="panel-body">
				<form action="" method="post">
					<div class="form-group">
						<label>Họ và Tên : </label> <?=$row['order_full_name']?>
					</div>
					<div class="form-group">
						<label>Số điện thoại : </label> <?=$row['order_phone']?>
					</div>
					<div class="form-group">
						<label>Email : </label> <?=$row['order_email']?>
					</div>
					<div class="form-group">
						<label>Địa chỉ : </label> <?=$row['order_address']?>
					</div>
					<div class="form-group">
						<label>Yêu cầu khác : </label> <?=$row['order_other']?>
					</div>
					<div class="form-group">
						<label>Trạng Thái : </label> 
							<input type="radio" name="order_status" id="order_status1" value="0" <?php if($row['order_status'] == '0') echo 'checked'; ?>>&nbsp;Order Mới
							&nbsp;&nbsp;&nbsp;<input type="radio" name="order_status" id="order_status2" value="1" <?php if($row['order_status'] == '1') echo 'checked'; ?>>&nbsp;Đã Gọi Cho Khách
							&nbsp;&nbsp;&nbsp;<input type="radio" name="order_status" id="order_status3" value="2" <?php if($row['order_status'] == '2') echo 'checked'; ?>>&nbsp;Giao Hàng Xong
							&nbsp;&nbsp;&nbsp;<input type="radio" name="order_status" id="order_status3" value="9" <?php if($row['order_status'] == '9') echo 'checked'; ?>>&nbsp;Khách Hủy Đặt Hàng
					</div>
					<div class="form-group">
						<label>Chi tiết đơn hàng :
					</div>
					<div class="form-group">
						<table class="table">
            				<tr>
            					<td>No</td>
            					<td>Tên sản phẩm</td>
            					<td>Số lượng</td>
            					<td>Giá</td>
            					<td>Tổng</td>					
            				</tr>
            				<?php 
            				$id = $conn->real_escape_string($_REQUEST['id']);
            				$sql1 = "SELECT A.order_quality, B.product_name, B.product_sell_price  FROM order_product A ";
            				$sql1 .= " INNER JOIN np_product B ON B.product_id = A.product_id ";
            				$sql1 .= " WHERE A.order_id = '$id' ";
            				
            				$result1 = $conn->query($sql1);
            				$sumOrder = 0;
            				if ($result1->num_rows > 0) {
            				    $n = 0;
            				    while ($row1 = $result1->fetch_assoc()) {
                                $n ++;  
                                $sumOrder += $row1['product_sell_price'] * $row1['order_quality'];
            				?>
            				<tr>
            					<td><?=$n?></td>
            					<td><?=$row1['product_name']?></td>
            					<td><?=$row1['order_quality']?></td>
            					<td><?=Common::convertMoney($row1['product_sell_price'])?></td>
            					<td><span style="color: red"><?=number_format($row1['product_sell_price'] * $row1['order_quality'])?>đ</span></td>					
            				</tr>
            				<?php 
            				    }
            				}
            				?>
        				</table>
					</div>
					<div class="form-group">
						<label>Tổng tiền đơn hàng : </label> <span style="color: red;"><b><?=number_format($sumOrder)?>đ</b></span>
					</div>
					<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' />
					<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
					<input type="hidden" name='id' value='<?=$_REQUEST['id']?>' /> 
					<input
						type="submit" name="submit" value="Update Trạng Thái Order"
						class="btn btn-primary" /> 
					<input type="button"
						class="btn btn-default" value="Quay lại" onclick="window.history.back();"/>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
        }
      }
    }
    ?>
<?php
} else {
    $sql = "SELECT A.order_id, A.order_full_name, A.order_phone, A.order_email, A.order_status FROM np_order A ";
    $sql .= " WHERE A.delete_flag = '0' ORDER BY order_status ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $n = 0;
    ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh sách Order Sản Phẩm</div>
			<div class="panel-body">
				<table class="table">
    				<tr>
    					<td>No</td>
    					<td>Họ và Tên</td>
    					<td>Số điện thoại</td>
    					<td>Email</td>
    					<td>Trang thái</td>					
    					<td>Chi Tiết</td>
    				</tr>
    				<?php 
    				while ($row = $result->fetch_assoc()) {
    				    $n ++;
    				?>
    				<tr>
    					<td><?=$n?></td>
    					<td><?=$row['order_full_name']?></td>
    					<td><?=$row['order_phone']?></td>
    					<td><?=$row['order_email']?></td>
    					<td><?php 
    					if ($row['order_status'] == '0') {
    					   echo 'Order Mới';
    					} else if ($row['order_status'] == '1') {
    					    echo 'Đã Gọi Cho Khách';
    					} else if ($row['order_status'] == '2') {
    					    echo 'Giao Hàng Xong';
    					} else if ($row['order_status'] == '9') {
    					    echo 'Khách Hủy Đặt Hàng';
    					}
    					?></td>					
    					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row['order_id']?>">Xem & Updat Trạng Thái</a></td>
    				</tr>
    				<?php 
    				}
    				?>
				</table>
			</div>
		</div>
	</div>
</div>
	<?php 
    }
	?>
<?php 
}
?>