<?php
$message = '';
$file_csv = '';
if (isset($_POST['file_csv']) && !empty($_POST['file_csv'])) {
    $file_csv = $_POST['file_csv'];
}
?>
<form action="" method="post" name="import_CSV_form" id="import_CSV_form">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Update danh sách sản phẩm từ CSV</div>
			<div class="panel-body">
				<div class="form-group">
					<input type="text" name="file_csv" id="file_csv" size="100" placeholder="Đường dẫn tới file" value="<?=$file_csv?>"/>
					<input type="submit" name="submit-fileCSV" id="submit-fileCSV" value="Read File">	
				</div>
				<div class="form-group">
					<label>Tiêu đề ảnh	
					<?php 
					if (isset($_POST['file_csv']) && !empty($_POST['file_csv'])) {
					?>
						<input type="submit" name="update-fileCSV" id="update-fileCSV" value="Copy File CSV">
					<?php 
					}
					?>
					</label>
				</div>
				<table class="table">
				<tr>
					<td>Product Id</td>
					<td>Mã Sản phẩm</td>
					<td>Tên Sản Phẩm</td>
					<td>Giá Cũ (đ)</td>
					<td>Giảm giá (%)</td>
					<td>Giá Bán (đ)</td>
				</tr>
				<?php
                 if (isset($_POST['file_csv']) && !empty($_POST['file_csv'])) {
                     $file_csv = $_POST['file_csv'];
                     $row = 0;
                     if (($handle = fopen($file_csv, "r")) !== FALSE) {
                         while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                             $row++;
                             if ($row == 1) {
                                 continue;
                             }

                             $product_id = $data[0];
                             $product_name = $data[2];
                             $product_code = $data[1];
                             $product_old_price = $data[3];
                             $product_down_price = $data[4];
                             $product_sell_price = $data[5];
                             
                             if (isset($_POST['update-fileCSV']) && !empty($_POST['update-fileCSV'])) {
                                 // update product
                                 $sql = "UPDATE np_product SET ";
                                 $sql .= " product_name = ? ";
                                 $sql .= " ,product_code = ? ";
                                 $sql .= " ,product_old_price = ? ";
                                 $sql .= " ,product_down_price = ? ";
                                 $sql .= " ,product_sell_price = ? ";
                                 $sql .= $sql_common_update;
                                 $sql .= " WHERE product_id = ? ";
                                 $stmt = $conn->prepare($sql);
                                 $stmt->bind_param("ssssss", $product_name, $product_code , $product_old_price, $product_down_price, $product_sell_price, $product_id);
                                 $stmt->execute();
                                 
                                 $message = "(<span style='color: red'>Update thông tin thành công !</span>)";
                             }
                             
                 ?>
            				<tr>
            					<td><?=$product_id?></td>
            					<td><?=$product_code?></td>
            					<td><?=$product_name?></td>
            					<td><?=$product_old_price?></td>
            					<td><?=$product_down_price?></td>
            					<td><?=$product_sell_price?></td>
            				</tr>
				<?php       
                         }
				        fclose($handle);
                     }
                 }
				?>
				</table>
			</div>
		</div>
	</div>
</div>
</form>
<?php echo $message;?>
