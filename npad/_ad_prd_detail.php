<?php 
$table_name = 'np_product';
$fieldCondidtonName = 'product_id';
$fieldConditionValue = '';
$fieldEditName = 'product_name';
$fieldEditValue = '';
$permalinkValue = '';
    
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
    	$("#product_flash_sale_time").datepicker({
            format: 'yyyy-mm-dd'
		});
    } );
</script>

<script language="JavaScript" type="text/javascript">
    // AJAX call for autocomplete 
    $(document).ready(function(){
    	$("#suggest_tag_id").keyup(function(){
    		$.ajax({
    		type: "POST",
    		url: "_api_search_tag.php",
    		data:'keyword='+$(this).val(),
    		beforeSend: function(){
    			// $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    		},
    		success: function(data){
    			$("#suggesstion-tag-box").show();
    			$("#suggesstion-tag-box").html(data);
    		}
    		});
    	});
    });
    
    $(document).ready(function(){
    	$( "#suggest_set_tag_id" ).click(function() {
    		var addTag = $( "#suggest_tag_id" ).val();
    		var nowTag = $( "#tag_id" ).val();
          	
          	// set cai o suggest la trong
          	$( "#suggest_tag_id" ).val('');
          	
          	// truong hop chua add
          	if (nowTag == null || nowTag == '') {
          		$( "#tag_id" ).append(addTag);
          	} else {
          		var listNowTags = nowTag.split(',');
          		var i;
          		var isExits = '0';
                for (i = 0; i < listNowTags.length; i++) {
                  if(listNowTags[i] == addTag) {
                  	isExits = '1';
                  }
                }
                if (isExits == '0') {
              		$( "#tag_id" ).append(',');
              		$( "#tag_id" ).append(addTag);
          		}
          	}
        });
    });
    
</script>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?php  echo Common::$_HOME_PAGE .'/npad/' ?>"> <em class="fa fa-home"></em>
		</a></li>
		<li class="active">Qu???n l?? S???n Ph???m</li>
	</ol>
</div>
<!--/.row-->
<div class="row">
	<div class="col-lg-12">
		</br> <a href="?pcid=<?=$_REQUEST['pcid']?>&display=list"><button
				type="button" class="btn btn-sm btn-primary">Danh s??ch S???n Ph???m</button></a>
		<a href="?pcid=<?=$_REQUEST['pcid']?>&display=addnew"><button
				type="button" class="btn btn-sm btn-success">Th??m S???n Ph???m</button></a> </br>
		</br>
	</div>
</div>
<!--/.row-->

<?php
if (isset($_REQUEST['display']) && $_REQUEST['display'] == "addnew") {

    $message = "";

    if (isset($_POST['submit'])) {
        $resultOK = 1;
        if (!isset($_POST['product_name']) || "" == $_POST['product_name']){
            $resultOK = 0;
        }
        if (!isset($_POST['permalink']) || "" == $_POST['permalink']){
            $resultOK = 0;
        }
        if (!isset($_POST['product_code']) || "" == $_POST['product_code']){
            $resultOK = 0;
        }
        if (!isset($_POST['product_sell_price']) || "" == $_POST['product_sell_price']){
            $resultOK = 0;
        }
        if (!isset($_POST['group_id']) || "" == $_POST['group_id']){
            $resultOK = 0;
        }
        if (!isset($_POST['brand_id']) || "" == $_POST['brand_id']){
            $resultOK = 0;
        }
        
        if (false){
            $message = $ERROR_FIELD_NULL;
        } else {
            $permalinkValue = $_POST['permalink'];            
            $resultOK = NpPermaLinkDba::insertData($conn, $permalinkValue, $table_name);
            if (false) {
                $message = $ERROR_DUPLICATE_SLUG;
            } else {
                $data_id = NpPermaLinkDba::getMaxDataId($conn);
                $group_id = $_POST['group_id'];
                $prod_filter_id = $_POST['prod_filter_id'];
                $brand_id = $_POST['brand_id'];
                $product_name = $_POST['product_name'];
                $product_code = $_POST['product_code'];
                $product_old_price = $_POST['product_old_price'];
                $product_down_price = $_POST['product_down_price'];
                $product_sell_price = $_POST['product_sell_price'];
                $product_status = $_POST['product_status'];
                $product_function = $_POST['product_function'];
                $product_color = $_POST['product_color'];
                $product_size = $_POST['product_size'];
                $product_material = $_POST['product_material'];
                $product_style = $_POST['product_style'];
                $product_made_in = $_POST['product_made_in'];
                $product_other_info = $_POST['product_other_info'];
                $product_save = $_POST['product_save'];
                $product_flash_sale = $_POST['product_flash_sale'];
                $product_hot = $_POST['product_hot'];
                $product_detail = $_POST['product_detail'];
                $product_seo = $_POST['product_seo'];
                $tag_id = $_POST['tag_id'];
                $product_flash_sale_time = $_POST['product_flash_sale_time'];
                $product_video = $_POST['product_video'];
                $data = [
                	':data_id' => (int)$data_id ?? null,
	                ':group_id' => (int)$group_id ?? null,
	                ':filter_id' => $prod_filter_id ?? null,
	                ':brand_id' => (int)$brand_id ?? null,
	                ':product_name' => $product_name ?? null,
	                ':product_code' => $product_code ?? null,
	                ':product_old_price' => (int)$product_old_price ?? null,
	                ':product_down_price' => (int)$product_down_price ?? null,
	                ':product_sell_price' => (int)$product_sell_price ?? null,
	                ':product_status' => (int)$product_status ?? 0,
	                ':product_function' => $product_function ?? null,
	                ':product_color' => $product_color ?? null,
	                ':product_size' => $product_size ?? null,
	                ':product_material' => $product_material ?? null,
	                ':product_style' => $product_style ?? null,
	                ':product_made_in' => $product_made_in ?? null,
	                ':product_other_info' => $product_other_info ?? null,
	                ':product_save' => $product_save ?? null,
	                ':product_flash_sale' => $product_flash_sale ?? 1,
	                ':product_hot' => $product_hot ?? 1,
	                ':product_detail' => $product_detail ?? null,
	                ':product_seo' => $product_seo ?? null,
	                ':insert_user' => $login_user_id ?? 'NP',
	                ':product_flash_sale_time' => $product_flash_sale_time ?? current_timestamp(),
	                ':product_video' => $product_video ?? null
                ];
                $conn_pdo = DBManager::getConnectionPDO();
                $sql = "INSERT INTO `np_product` (`data_id`, `group_id`, `brand_id`, `product_name`, `product_code`, `product_old_price`, `product_down_price`, `product_sell_price`, `product_status`, `product_function`, `product_color`, `product_size`, `product_material`, `product_style`, `product_made_in`, `product_other_info`, `product_save`, `product_flash_sale`, `product_hot`, `product_detail`, `insert_user`, `product_seo`, `filter_id`, `product_flash_sale_time`, `product_video`) VALUES (:data_id, :group_id, :brand_id, :product_name, :product_code,:product_old_price, :product_down_price, :product_sell_price, :product_status, :product_function,:product_color, :product_size, :product_material, :product_style, :product_made_in,:product_other_info, :product_save, :product_flash_sale, :product_hot, :product_detail,:insert_user,:product_seo, :filter_id, :product_flash_sale_time, :product_video)";
                $stmt = $conn_pdo->prepare($sql);
                $stmt->execute($data);
                if (!empty($tag_id)) {
                    $id = NpPermaLinkDba::getMaxProductId($conn);
                    $arrTag = explode(",", $tag_id);
                    foreach ($arrTag as $str) {
                        $slug = Common::convertSlug(trim($str));
                        NpPermaLinkDba::insertTagProduct($conn, trim($str), trim($slug), $id);
                    }
                }
                DBManager::closeConnPDO();
                $message = $INFO_INSERT_DATA_OK;
            }
        }
    }
    ?>
<script type="text/javascript">
    $(document).ready( function() {
        $("#product_name").change(function() {
              $("#permalink").val(slug($('#product_name').val()));
        });
	});
</script>
<form action="" method="post" name="formProduct" id="formProduct">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Th??m Th??ng Tin S???n Ph???m <?=$message?></div>
				<div class="panel-body">
					<div class="col-md-6">
						<div class="form-group">
							<label>Product Name(<span style='color: red'>*</span>)
							</label>  _Max: 300 k?? t??? <input type="text" class="form-control"
								name="product_name" id="product_name" value="" />
						</div>
						<div class="form-group">
							<label>Product Name Permalink(<span style='color: red'>*</span>)
							</label> _ Permalink l?? duy nh???t. Kh??ng c?? d???u '.'  _Max: 300 k?? t??? <input type="text"
								class="form-control" name="permalink" id="permalink" value="" />
						</div>
						<div class="form-group">
							<label>M?? S???n Ph???m(<span style='color: red'>*</span>)
							</label> _Max: 50 k?? t??? <input type="text" class="form-control"
								name="product_code" value="" id="product_code"/>
						</div>
						<hr>
						<div class="form-group">
							<label>Gi?? S???n Ph???m </label> _Max: 50 k?? t??? <input type="text"
								class="form-control" name="product_old_price" value="" id="product_old_price"/>
						</div>
						<div class="form-group">
							<label>Gi?? B??n(<span style='color: red'>*</span>)
							</label> _Max: 50 k?? t??? <input type="text" class="form-control"
								name="product_sell_price" value="" onblur="discount()" id="product_sell_price"/>
						</div>
						<div class="form-group">
							<label>Gi?? Chi???t Kh???u (%) </label> _Max: 50 k?? t??? <input type="text"
								class="form-control" name="product_down_price" value="" id="product_down_price"/>
						</div>
						<hr>
						<div class="form-group">
							<label>Ch???c N??ng C?? B???n </label> _Max: 200 k?? t???<input type="text"
								class="form-control" name="product_function" value="" id="product_function"/>
						</div>
						<div class="form-group">
							<label>M??u S???c </label> _Max: 200 k?? t???<input type="text" class="form-control"
								name="product_color" value="" id="product_color"/>
						</div>
						<div class="form-group">
							<label>Ch???t Li???u </label> _Max: 200 k?? t???<input type="text" class="form-control"
								name="product_material" value="" id="product_material"/>
						</div>
						<div class="form-group">
							<label>K??ch Th?????c </label> _Max: 200 k?? t???<input type="text"
								class="form-control" name="product_size" value="" id="product_size"/>
						</div>
						<div class="form-group">
							<label>Nh??ng Video C???a S???n Ph???m </label> _Max: 2000 k?? t???
							<textarea rows="8" class="form-control" name="product_video" id="product_video" ></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Group s???n ph???m (<span style='color: red'>*</span>)</label> 
							<select class="form-control" name="group_id" id="group_id">
								<option value="">---- Ch???n Group ----</option>
								<?php 
								for ($i = 1; $i < 4; $i++) {					    
								?>
								<option value="">
									<?php 
									if ($i == 1){
									    echo "G1. Thi???t b??? v??? sinh";    
									} else if ($i == 2) {
									    echo "G2. Thi???t b??? nh?? b???p";  
									} else if ($i == 3) {
									    echo "G3. Thi???t b??? ??i???n";  
									}
									?>
												</option>
								<?php 
    								$sql = "SELECT group_id, group_name FROM np_prod_group ";
    								$sql .= " WHERE group_type = '" .$i. "' AND group_level = '1' AND delete_flag = '0'";
    								$result = $conn->query($sql);
    								if ($result->num_rows > 0) {
                        				while ($row = $result->fetch_assoc()) {
                				?>
    									<option value="<?=$row['group_id']?>">&nbsp;&nbsp;&nbsp;|---(<?=$row['group_name']?>)</option>
    									<?php 
    									$sql1 = "SELECT group_id, group_name FROM np_prod_group ";
    									$sql1 .= " WHERE group_level_up = '" .$row['group_id']. "' AND delete_flag = '0'";
    									$result1 = $conn->query($sql1);
    									if ($result1->num_rows > 0) {
    									    while ($row1 = $result1->fetch_assoc()) {
    									?>
    										<option value="<?=$row1['group_id']?>">&nbsp;&nbsp;&nbsp;
    														&nbsp;&nbsp;&nbsp;
    														|---(<?=$row1['group_name']?>)</option>
    									<?php 
            								}
        								}
        								?>
								<?php 
                        				}
    								}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>B??? l???c th????ng hi???u Group (<span style='color: red'>*</span>)</label> 
							<?php 
    							$sql = "SELECT prod_filter_id, prod_filter_name FROM np_prod_filter WHERE delete_flag = '0'";
    							$result = $conn->query($sql);
    							if ($result->num_rows > 0) {
							?>
							<select class="form-control" name="prod_filter_id" id="prod_filter_id">
								<option value="">---- Th????ng hi???u group ----</option>
								<?php 
                    				while ($row = $result->fetch_assoc()) {
                				?>
								<option value="<?=$row['prod_filter_id']?>"><?=$row['prod_filter_name']?></option>
								<?php 
                    				}
								?>
							</select>
							<?php 
    							}
							?>
						</div>
						<div class="form-group">
							<label>Brand s???n ph???m (<span style='color: red'>*</span>)</label> 
							<?php 
    							$sql = "SELECT brand_id, brand_name FROM np_prod_brand WHERE delete_flag = '0'";
    							$result = $conn->query($sql);
    							if ($result->num_rows > 0) {
							?>
							<select class="form-control" name="brand_id" id="brand_id">
								<option value="">---- Ch???n Brand ----</option>
								<?php 
                    				while ($row = $result->fetch_assoc()) {
                				?>
								<option value="<?=$row['brand_id']?>"><?=$row['brand_name']?></option>
								<?php 
                    				}
								?>
							</select>
							<?php 
    							}
							?>
						</div>
						<div class="form-group">
							<label>Tr???ng Th??i
							</label> <select class="form-control" name="product_status" id="product_status">
								<option value="0">C??n H??ng</option>
								<option value="1">H???t H??ng</option>
							</select>
						</div>
						<div class="form-group">
							<label>S???n Ph???m Flash Sale
							</label> <select class="form-control" name="product_flash_sale" id="product_flash_sale">
								<option value="0" selected="selected">H???t Sale</option>
								<option value="1">??ang Flash Sale</option>
							</select>
						</div>
						<div class="form-group">
							<label>Th???i gian Flash Sale (Ch??? ch???n khi s???n ph???m l?? Flash Sale)
							</label> 
							<input type="text" class="form-control"
								name="product_flash_sale_time" value="" id="product_flash_sale_time"/>
						</div>
						<div class="form-group">
							<label>S???n Ph???m N???i B???t
							</label> <select class="form-control" name="product_hot" id="product_hot">
								<option value="0" selected="selected">S???n Ph???m B??nh Th?????ng</option>
								<option value="1">S???n Ph???m Hot</option>
								
							</select>
						</div>
						<div class="form-group">
							<label>Tag s???n ph???m</label> _ C?? th??? th??m nhi???u tag c??ch nhau b???i d???u ',' ( VD: tag1, tag2, ... )
							<input list="browsers-tag" name="suggest_tag_id" id="suggest_tag_id" value="" placeholder="H??? tr??? t??m ki???n Tag" style="width: 300px"/>
							<input type="button" id="suggest_set_tag_id" value="Th??m Tag"/>
							<div id="suggesstion-tag-box"></div>
							<textarea rows="5" class="form-control" name="tag_id" id="tag_id" ></textarea>
						</div>
						<hr>
						<div class="form-group">
							<label>Ki???u S???n Ph???m </label> _Max: 200 k?? t??? <input type="text"
								class="form-control" name="product_style" value="" id="product_style"/>
						</div>
						<div class="form-group">
							<label>N??i S???n Xu???t </label> _Max: 200 k?? t??? <input type="text"
								class="form-control" name="product_made_in" value="" id="product_made_in"/>
						</div>
						<div class="form-group">
							<label>Th???i Gian B???o H??nh </label> _Max: 200 k?? t???<input type="text"
								class="form-control" name="product_save" value="" id="product_save"/>
						</div>
						<div class="form-group">
							<label>Th??ng S??? Kh??c </label> _Max: 1000 k?? t???<input type="text"
								class="form-control" name="product_other_info" value="" id="product_other_info"/>
						</div>
						<div class="form-group">
							<label>Seo Product </label> _Th??ng tin Header, Title, Meta ... ????? SEO _Max: 4000 k?? t???
							<textarea rows="10" class="form-control" name="product_seo" id="product_seo" ><title>  </title>
<meta name="description" content="  "/>
<meta name=robots content=INDEX,FOLLOW,ALL />
							</textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
						<label>B??i Vi???t V??? S???m Ph???m
						</label> <textarea rows="20" class="form-control" name="product_detail"  id="editor"></textarea>
				</div>
				</br>
				<label>(<span style='color: red'>*</span>)
					</label> Tr?????ng c???n ph???i nh???p th??ng tin
					<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' /> 
					<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
					<input type="submit" id="submit" name="submit" value="Th??m s???n ph???m" class="btn btn-primary" onclick="validProduct()"/> 
					<input type="reset"
						class="btn btn-default" value="Reset" />
					</br></br></br>	
			</div>
	</div>
</div>
</form>
<?php
} else if (isset($_REQUEST['display']) && $_REQUEST['display'] == "edit") {
    $message = "";
    if (isset($_REQUEST['submit']))
    {
        $permalink = $_POST['permalink'];
        
        $id = $_POST['id'];
        $group_id = $_POST['group_id'];
        $prod_filter_id = $_POST['prod_filter_id'];
        $brand_id = $_POST['brand_id'];
        $product_name = $_POST['product_name'];
        $product_code = $_POST['product_code'];
        $product_old_price = $_POST['product_old_price'];
        $product_down_price = $_POST['product_down_price'];
        $product_sell_price = $_POST['product_sell_price'];
        $product_status = $_POST['product_status'];
        $product_function = $_POST['product_function'];
        $product_color = $_POST['product_color'];
        $product_size = $_POST['product_size'];
        $product_material = $_POST['product_material'];
        $product_style = $_POST['product_style'];
        $product_made_in = $_POST['product_made_in'];
        $product_other_info = $_POST['product_other_info'];
        $product_save = $_POST['product_save'];
        $product_flash_sale = $_POST['product_flash_sale'];
        $product_hot = $_POST['product_hot'];
        $product_detail = $_POST['product_detail'];
        $product_seo = $_POST['product_seo'];
        $tag_id = $_POST['tag_id'];
        $product_flash_sale_time = $_POST['product_flash_sale_time'];
        $product_video = $_POST['product_video'];
        
        // update permakling
        $sql = "UPDATE np_permalink SET permalink = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE data_id IN (SELECT data_id FROM np_product WHERE product_id = ? )";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $permalink, $id);
        $stmt->execute();
        
        // update product
        $sql = "UPDATE np_product SET ";
        $sql .= " group_id = ? ";
        $sql .= " ,filter_id = ? ";
        $sql .= " ,brand_id = ? ";
        $sql .= " ,product_name = ? ";
        $sql .= " ,product_code = ? ";
        $sql .= " ,product_old_price = ? ";
        $sql .= " ,product_down_price = ? ";
        $sql .= " ,product_sell_price = ? ";
        $sql .= " ,product_status = ? ";
        $sql .= " ,product_function = ? ";
        $sql .= " ,product_color = ? ";
        $sql .= " ,product_size = ? ";
        $sql .= " ,product_material = ? ";
        $sql .= " ,product_style = ? ";
        $sql .= " ,product_made_in = ? ";
        $sql .= " ,product_other_info = ? ";
        $sql .= " ,product_save = ? ";
        $sql .= " ,product_flash_sale = ? ";
        $sql .= " ,product_hot = ? ";
        $sql .= " ,product_detail = ? ";
        $sql .= " ,product_seo = ? ";
        $sql .= " ,product_flash_sale_time = ? ";
        $sql .= " ,product_video = ? ";
        $sql .= $sql_common_update;
        $sql .= " WHERE product_id = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssssssssssssi", $group_id, $prod_filter_id, $brand_id, $product_name, $product_code
            , $product_old_price, $product_down_price, $product_sell_price, $product_status, $product_function
            , $product_color, $product_size, $product_material, $product_style, $product_made_in, $product_other_info
            , $product_save, $product_flash_sale, $product_hot, $product_detail, $product_seo, $product_flash_sale_time, $product_video
            , $id);
        $stmt->execute();
        
        // Delete all tag list for this product
        $delId = $conn->real_escape_string($id);
        $sql = "DELETE FROM tag_product WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delId);
        $stmt->execute();
        
        if (!empty($tag_id)) {
            // Delete all tag list for this product
            $delId = $conn->real_escape_string($id);
            $sql = "DELETE FROM tag_product WHERE product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $delId);
            $stmt->execute();
            
            $arrTag = explode(",", $tag_id);
            foreach ($arrTag as $str) {
                $slug = Common::convertSlug(trim($str));
                NpPermaLinkDba::insertTagProduct($conn, trim($str), trim($slug), $id);
            }
        }
        
        $message = $INFO_UPDATE_DATA_OK;
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql45 = "SELECT * FROM np_product A";
        $sql45 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
        $sql45 .= " WHERE A.product_id = '$id' AND B.delete_flag = '0'";
        $result45 = $conn->query($sql45);
        if ($result45->num_rows > 0) {
            while ($row45 = $result45->fetch_assoc()) {
?>
<form action="" method="post" name="formProduct" id="formProduct">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">S???a Th??ng Tin S???n Ph???m <?=$message?></div>
				<div class="panel-body">
					<div class="col-md-6">
						<div class="form-group">
							<label>Product Name(<span style='color: red'>*</span>)
							</label> _Max: 300 k?? t???  <input type="text" class="form-control"
								name="product_name" id="product_name" value="<?=$row45['product_name']?>" />
						</div>
						<div class="form-group">
							<label>Product Name Permalink(<span style='color: red'>*</span>)
							</label> _ Permalink l?? duy nh???t . Kh??ng c?? k?? t??? '.' _Max: 300 k?? t??? <input type="text"
								class="form-control" name="permalink" id="permalink" value="<?=$row45['permalink']?>" />
						</div>
						<div class="form-group">
							<label>M?? S???n Ph???m(<span style='color: red'>*</span>)
							</label> _Max: 50 k?? t???  <input type="text" class="form-control"
								name="product_code" value="<?=$row45['product_code']?>" id="product_code"/>
						</div>
						<hr>
						<div class="form-group">
							<label>Gi?? S???n Ph???m </label> _Max: 50 k?? t??? <input type="text"
								class="form-control" name="product_old_price" value="<?=$row45['product_old_price']?>" id="product_old_price"/>
						</div>
						<div class="form-group">
							<label>Gi?? B??n(<span style='color: red'>*</span>)
							</label> _Max: 50 k?? t???  <input type="text" class="form-control"
								name="product_sell_price" value="<?=$row45['product_sell_price']?>" onblur="discount()" id="product_sell_price"/>
						</div>
						<div class="form-group">
							<label>Gi?? Chi???t Kh???u (%) </label> _Max: 50 k?? t???  <input type="text"
								class="form-control" name="product_down_price" value="<?=$row45['product_down_price']?>" id="product_down_price"/>
						</div>
						<hr>
						<div class="form-group">
							<label>Ch???c N??ng C?? B???n </label> _Max: 200 k?? t???  <input type="text"
								class="form-control" name="product_function" value="<?=$row45['product_function']?>" id="product_function"/>
						</div>
						<div class="form-group">
							<label>M??u S???c </label> _Max: 200 k?? t???  <input type="text" class="form-control"
								name="product_color" value="<?=$row45['product_color']?>" id="product_color"/>
						</div>
						<div class="form-group">
							<label>Ch???t Li???u </label> _Max: 200 k?? t???  <input type="text" class="form-control"
								name="product_material" value="<?=$row45['product_material']?>" id="product_material"/>
						</div>
						<div class="form-group">
							<label>K??ch Th?????c </label> _Max: 200 k?? t???  <input type="text"
								class="form-control" name="product_size" value="<?=$row45['product_size']?>" id="product_size"/>
						</div>
						<div class="form-group">
							<label>Nh??ng Video C???a S???n Ph???m </label> _Max: 2000 k?? t???
							<textarea rows="8" class="form-control" name="product_video" id="product_video" ><?=$row45['product_video']?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Group s???n ph???m(<span style='color: red'>*</span>)</label> 
							<select class="form-control" name="group_id" id="group_id">
								<option value="">---- Ch???n Group ----</option>
								<?php 
								for ($i = 1; $i < 4; $i++) {					    
								?>
								<option value="">
									<?php 
									if ($i == 1){
									    echo "G1. Thi???t b??? v??? sinh";    
									} else if ($i == 2) {
									    echo "G2. Thi???t b??? nh?? b???p";  
									} else if ($i == 3) {
									    echo "G3. Thi???t b??? ??i???n";  
									}
									?>
								 </option>
								<?php 
    								$sql = "SELECT group_id, group_name FROM np_prod_group ";
    								$sql .= " WHERE group_type = '" .$i. "' AND group_level = '1' AND delete_flag = '0'";
    								$result = $conn->query($sql);
    								if ($result->num_rows > 0) {
                        				while ($row = $result->fetch_assoc()) {
                				?>
    									<option <?php if ($row45['group_id'] == $row['group_id']) {echo "selected='selected'";}?> value="<?=$row['group_id']?>">&nbsp;&nbsp;&nbsp;|---(<?=$row['group_name']?>)</option>
    									<?php 
    									$sql1 = "SELECT group_id, group_name FROM np_prod_group ";
    									$sql1 .= " WHERE group_level_up = '" .$row['group_id']. "' AND delete_flag = '0'";
    									$result1 = $conn->query($sql1);
    									if ($result1->num_rows > 0) {
    									    while ($row1 = $result1->fetch_assoc()) {
    									?>
    										<option <?php if ($row45['group_id'] == $row1['group_id']) {echo "selected='selected'";}?> value="<?=$row1['group_id']?>">&nbsp;&nbsp;&nbsp;
    														&nbsp;&nbsp;&nbsp;
    														|---(<?=$row1['group_name']?>)</option>
    									<?php 
            								}
        								}
        								?>
								<?php 
                        				}
    								}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>B??? l???c th????ng hi???u Group (<span style='color: red'>*</span>)</label> 
							<?php 
    							$sql = "SELECT prod_filter_id, prod_filter_name FROM np_prod_filter WHERE delete_flag = '0'";
    							$result = $conn->query($sql);
    							if ($result->num_rows > 0) {
							?>
							<select class="form-control" name="prod_filter_id" id="prod_filter_id">
								<option value="">---- Th????ng hi???u group ----</option>
								<?php 
                    				while ($row = $result->fetch_assoc()) {
                				?>
								<option <?php if ($row45['filter_id'] == $row['prod_filter_id']) {echo "selected='selected'";}?> value="<?=$row['prod_filter_id']?>"><?=$row['prod_filter_name']?></option>
								<?php 
                    				}
								?>
							</select>
							<?php 
    							}
							?>
						</div>
						<div class="form-group">
							<label>Brand s???n ph???m (<span style='color: red'>*</span>)</label> 
							<?php 
    							$sql = "SELECT brand_id, brand_name FROM np_prod_brand WHERE delete_flag = '0'";
    							$result = $conn->query($sql);
    							if ($result->num_rows > 0) {
							?>
							<select class="form-control" name="brand_id" id="brand_id">
								<option value="">---- Ch???n Brand ----</option>
								<?php 
                    				while ($row = $result->fetch_assoc()) {
                				?>
								<option <?php if ($row45['brand_id'] == $row['brand_id']) {echo "selected='selected'";}?> value="<?=$row['brand_id']?>"><?=$row['brand_name']?></option>
								<?php 
                    				}
								?>
							</select>
							<?php 
    							}
							?>
						</div>
						<div class="form-group">
							<label>Tr???ng Th??i
							</label> <select class="form-control" name="product_status" id="product_status">
								<option <?php if ($row45['product_status'] == '0') {echo "selected='selected'";}?> value="0">C??n H??ng</option>
								<option <?php if ($row45['product_status'] == '1') {echo "selected='selected'";}?> value="1">H???t H??ng</option>
							</select>
						</div>
						<div class="form-group">
							<label>S???n Ph???m Flash Sale
							</label> <select class="form-control" name="product_flash_sale" id="product_flash_sale">
								<option <?php if ($row45['product_flash_sale'] == '0') {echo "selected='selected'";}?> value="0">H???t Sale</option>
								<option <?php if ($row45['product_flash_sale'] == '1') {echo "selected='selected'";}?> value="1">??ang Flash Sale</option>
							</select>
						</div>
						<div class="form-group">
							<label>Th???i gian Flash Sale (Ch??? ch???n khi s???n ph???m l?? Flash Sale)
							</label> 
							<input type="text" class="form-control" name="product_flash_sale_time" value="<?=$row45['product_flash_sale_time']?>" id="product_flash_sale_time"/>
						</div>
						<div class="form-group">
							<label>S???n Ph???m N???i B???t
							</label> <select class="form-control" name="product_hot" id="product_hot">
								<option <?php if ($row45['product_hot'] == '0') {echo "selected='selected'";}?> value="0">S???n Ph???m B??nh Th?????ng</option>
								<option <?php if ($row45['product_hot'] == '1') {echo "selected='selected'";}?> value="1">S???n Ph???m Hot</option>
								
							</select>
						</div>
						<div class="form-group">
							<label>Tag s???n ph???m</label> _ C?? th??? th??m nhi???u tag c??ch nhau b???i d???u ',' ( VD: tag1, tag2, ... )
							<input list="browsers-tag" name="suggest_tag_id" id="suggest_tag_id" value="" placeholder="H??? tr??? t??m ki???n Tag" style="width: 300px"/>
							<input type="button" id="suggest_set_tag_id" value="Th??m Tag"/>
							<div id="suggesstion-tag-box"></div>
							<?php 
							    $tagList = '';
        						$sql = " SELECT tag_name FROM np_prod_tag A";
        						$sql .= " INNER JOIN tag_product B ON A.tag_id = B.tag_id ";
        						$sql .= " WHERE B.product_id = '" . $row45['product_id'] . "'";
        						$result = $conn->query($sql);
        						if ($result->num_rows > 0) {
        						    while ($row = $result->fetch_assoc()) {
        						        $tagList .= $row['tag_name'] . ',';
        						    }
        						}
    						?>
							<textarea rows="5" class="form-control" name="tag_id" id="tag_id" ><?=substr($tagList, 0, -1)?></textarea>
						</div>
						<hr>
						<div class="form-group">
							<label>Ki???u S???n Ph???m </label> _Max: 200 k?? t???  <input type="text"
								class="form-control" name="product_style" value="<?=$row45['product_style']?>" id="product_style"/>
						</div>
						<div class="form-group">
							<label>N??i S???n Xu???t </label> _Max: 200 k?? t???  <input type="text"
								class="form-control" name="product_made_in" value="<?=$row45['product_made_in']?>" id="product_made_in"/>
						</div>
						<div class="form-group">
							<label>Th???i Gian B???o H??nh </label> _Max: 200 k?? t???  <input type="text"
								class="form-control" name="product_save" value="<?=$row45['product_save']?>" id="product_save"/>
						</div>
						<div class="form-group">
							<label>Th??ng S??? Kh??c </label> _Max: 1000 k?? t???  <input type="text"
								class="form-control" name="product_other_info" value="<?=$row45['product_other_info']?>" id="product_other_info"/>
						</div>
						<div class="form-group">
							<label>Seo Product </label> _Th??ng tin Header, Title, Meta ... ????? SEO _Max: 4000 k?? t???
							<textarea rows="10" class="form-control" name="product_seo" id="product_seo" ><?=$row45['product_seo']?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
						<label>B??i Vi???t V??? S???m Ph???m(<span style='color: red'>*</span>)
						</label> <textarea rows="20" class="form-control" name="product_detail"  id="editor"><?=$row45['product_detail']?></textarea>
				</div>
				</br>
				<label>(<span style='color: red'>*</span>)
					</label> Tr?????ng c???n ph???i nh???p th??ng tin
					<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' /> 
					<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
					<input type="hidden" name='id' value='<?=$_REQUEST['id']?>' /> 
					<input type="submit" name="submit" value="S???a s???n ph???m" id="submit"
						class="btn btn-primary" /> 
					<input type="reset"
						class="btn btn-default" value="Reset" />
					</br></br></br>	
			</div>
	</div>
</div>
<?php
        }
      }
    }
    ?>
<?php
} else if (isset($_REQUEST['display']) && $_REQUEST['display'] == "clone") {
    $message = "";
    
    if (isset($_POST['submit'])) {
        $resultOK = 1;
        if (!isset($_POST['product_name']) || "" == $_POST['product_name']){
            $resultOK = 0;
        }
        if (!isset($_POST['permalink']) || "" == $_POST['permalink']){
            $resultOK = 0;
        }
        if (!isset($_POST['product_code']) || "" == $_POST['product_code']){
            $resultOK = 0;
        }
        if (!isset($_POST['product_sell_price']) || "" == $_POST['product_sell_price']){
            $resultOK = 0;
        }
        if (!isset($_POST['group_id']) || "" == $_POST['group_id']){
            $resultOK = 0;
        }
        if (!isset($_POST['brand_id']) || "" == $_POST['brand_id']){
            $resultOK = 0;
        }
        
        if ($resultOK == 0){
            $message = $ERROR_FIELD_NULL;
        } else {
            $permalinkValue = $_POST['permalink'];
            $resultOK = NpPermaLinkDba::insertData($conn, $permalinkValue, $table_name);
            if ($resultOK == 0) {
                $message = $ERROR_DUPLICATE_SLUG;
            } else {
                $data_id = NpPermaLinkDba::getMaxDataId($conn);
                $group_id = $_POST['group_id'];
                $prod_filter_id = $_POST['prod_filter_id'];
                $brand_id = $_POST['brand_id'];
                $product_name = $_POST['product_name'];
                $product_code = $_POST['product_code'];
                $product_old_price = $_POST['product_old_price'];
                $product_down_price = $_POST['product_down_price'];
                $product_sell_price = $_POST['product_sell_price'];
                $product_status = $_POST['product_status'];
                $product_function = $_POST['product_function'];
                $product_color = $_POST['product_color'];
                $product_size = $_POST['product_size'];
                $product_material = $_POST['product_material'];
                $product_style = $_POST['product_style'];
                $product_made_in = $_POST['product_made_in'];
                $product_other_info = $_POST['product_other_info'];
                $product_save = $_POST['product_save'];
                $product_flash_sale = $_POST['product_flash_sale'];
                $product_hot = $_POST['product_hot'];
                $product_detail = $_POST['product_detail'];
                $product_seo = $_POST['product_seo'];
                $tag_id = $_POST['tag_id'];
                $product_flash_sale_time  = $_POST['product_flash_sale_time'];
                $product_video = $_POST['product_video'];
                
                $sql = "INSERT INTO np_product (";
                $sql .= " data_id, group_id, filter_id, brand_id, product_name, product_code, ";
                $sql .= " product_old_price, product_down_price, product_sell_price, product_status, product_function, ";
                $sql .= " product_color, product_size, product_material, product_style, product_made_in, ";
                $sql .= " product_other_info, product_save, product_flash_sale, product_hot, product_detail, product_seo, insert_user, product_flash_sale_time, product_video";
                $sql .= ") ";
                $sql .= " VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'$login_user_id',?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssssssssssssssssssss", $data_id, $group_id, $prod_filter_id, $brand_id,
                    $product_name, $product_code, $product_old_price, $product_down_price, $product_sell_price,
                    $product_status, $product_function, $product_color, $product_size, $product_material, $product_style,
                    $product_made_in, $product_other_info, $product_save, $product_flash_sale, $product_hot, $product_detail, $product_seo,$product_flash_sale_time, $product_video);
                $stmt->execute();
                
                if (!empty($tag_id)) {
                    $id = NpPermaLinkDba::getMaxProductId($conn);
                    $arrTag = explode(",", $tag_id);
                    foreach ($arrTag as $str) {
                        $slug = Common::convertSlug(trim($str));
                        NpPermaLinkDba::insertTagProduct($conn, trim($str), trim($slug), $id);
                    }
                }
                
                $message = $INFO_INSERT_DATA_OK;
            }
        }
    }
    if (!isset($_REQUEST['id']))
    {
        $message = $ERROR_UPDATE_DATA_FAIL;
    } else {
        $id = $conn->real_escape_string($_REQUEST['id']);
        $sql45 = "SELECT * FROM np_product A";
        $sql45 .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
        $sql45 .= " WHERE A.product_id = '$id' AND B.delete_flag = '0'";
        $result45 = $conn->query($sql45);
        if ($result45->num_rows > 0) {
            while ($row45 = $result45->fetch_assoc()) {
?>
<script type="text/javascript">
    $(document).ready( function() {
        $("#product_name").change(function() {
              $("#permalink").val(slug($('#product_name').val()));
        });
	});
</script>
<form action="" method="post" name="formProduct" id="formProduct">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Copy S???n Ph???m M???i (Ch?? ?? thay ?????i t??n s???n ph???m) <?=$message?></div>
				<div class="panel-body">
					<div class="col-md-6">
						<div class="form-group">
							<label>Product Name(<span style='color: red'>*</span>)
							</label> _Max: 300 k?? t???  <input type="text" class="form-control"
								name="product_name" id="product_name" value="<?=$row45['product_name']?>" />
						</div>
						<div class="form-group">
							<label>Product Name Permalink(<span style='color: red'>*</span>)
							</label> _ Permalink l?? duy nh???t . Kh??ng c?? k?? t??? '.' _Max: 300 k?? t??? <input type="text"
								class="form-control" name="permalink" id="permalink" value="<?=$row45['permalink']?>" />
						</div>
						<div class="form-group">
							<label>M?? S???n Ph???m(<span style='color: red'>*</span>)
							</label> _Max: 50 k?? t???  <input type="text" class="form-control"
								name="product_code" value="<?=$row45['product_code']?>" id="product_code"/>
						</div>
						<hr>
						<div class="form-group">
							<label>Gi?? S???n Ph???m </label> _Max: 50 k?? t??? <input type="text"
								class="form-control" name="product_old_price" value="<?=$row45['product_old_price']?>" id="product_old_price"/>
						</div>
						<div class="form-group">
							<label>Gi?? B??n(<span style='color: red'>*</span>)
							</label> _Max: 50 k?? t???  <input type="text" class="form-control"
								name="product_sell_price" value="<?=$row45['product_sell_price']?>" onblur="discount()" id="product_sell_price"/>
						</div>
						<div class="form-group">
							<label>Gi?? Chi???t Kh???u (%) </label> _Max: 50 k?? t???  <input type="text"
								class="form-control" name="product_down_price" value="<?=$row45['product_down_price']?>" id="product_down_price"/>
						</div>
						<hr>
						<div class="form-group">
							<label>Ch???c N??ng C?? B???n </label> _Max: 200 k?? t???  <input type="text"
								class="form-control" name="product_function" value="<?=$row45['product_function']?>" id="product_function"/>
						</div>
						<div class="form-group">
							<label>M??u S???c </label> _Max: 200 k?? t???  <input type="text" class="form-control"
								name="product_color" value="<?=$row45['product_color']?>" id="product_color"/>
						</div>
						<div class="form-group">
							<label>Ch???t Li???u </label> _Max: 200 k?? t???  <input type="text" class="form-control"
								name="product_material" value="<?=$row45['product_material']?>" id="product_color"/>
						</div>
						<div class="form-group">
							<label>K??ch Th?????c </label> _Max: 200 k?? t???  <input type="text"
								class="form-control" name="product_size" value="<?=$row45['product_size']?>" id="product_size"/>
						</div>
						<div class="form-group">
							<label>Nh??ng Video C???a S???n Ph???m </label> _Max: 2000 k?? t???
							<textarea rows="8" class="form-control" name="product_video" id="product_video" ><?=$row45['product_video']?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Group s???n ph???m (<span style='color: red'>*</span>)</label> 
							<select class="form-control" name="group_id" id="group_id">
								<option value="">---- Ch???n Group ----</option>
								<?php 
								for ($i = 1; $i < 4; $i++) {					    
								?>
								<option value="">
									<?php 
									if ($i == 1){
									    echo "G1. Thi???t b??? v??? sinh";    
									} else if ($i == 2) {
									    echo "G2. Thi???t b??? nh?? b???p";  
									} else if ($i == 3) {
									    echo "G3. Thi???t b??? ??i???n";  
									}
									?>
								 </option>
								<?php 
    								$sql = "SELECT group_id, group_name FROM np_prod_group ";
    								$sql .= " WHERE group_type = '" .$i. "' AND group_level = '1' AND delete_flag = '0'";
    								$result = $conn->query($sql);
    								if ($result->num_rows > 0) {
                        				while ($row = $result->fetch_assoc()) {
                				?>
    									<option <?php if ($row45['group_id'] == $row['group_id']) {echo "selected='selected'";}?> value="<?=$row['group_id']?>">&nbsp;&nbsp;&nbsp;|---(<?=$row['group_name']?>)</option>
    									<?php 
    									$sql1 = "SELECT group_id, group_name FROM np_prod_group ";
    									$sql1 .= " WHERE group_level_up = '" .$row['group_id']. "' AND delete_flag = '0'";
    									$result1 = $conn->query($sql1);
    									if ($result1->num_rows > 0) {
    									    while ($row1 = $result1->fetch_assoc()) {
    									?>
    										<option <?php if ($row45['group_id'] == $row1['group_id']) {echo "selected='selected'";}?> value="<?=$row1['group_id']?>">&nbsp;&nbsp;&nbsp;
    														&nbsp;&nbsp;&nbsp;
    														|---(<?=$row1['group_name']?>)</option>
    									<?php 
            								}
        								}
        								?>
								<?php 
                        				}
    								}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>B??? l???c th????ng hi???u Group (<span style='color: red'>*</span>)</label> 
							<?php 
    							$sql = "SELECT prod_filter_id, prod_filter_name FROM np_prod_filter WHERE delete_flag = '0'";
    							$result = $conn->query($sql);
    							if ($result->num_rows > 0) {
							?>
							<select class="form-control" name="prod_filter_id" id="prod_filter_id">
								<option value="">---- Th????ng hi???u group ----</option>
								<?php 
                    				while ($row = $result->fetch_assoc()) {
                				?>
								<option <?php if ($row45['filter_id'] == $row['prod_filter_id']) {echo "selected='selected'";}?> value="<?=$row['prod_filter_id']?>"><?=$row['prod_filter_name']?></option>
								<?php 
                    				}
								?>
							</select>
							<?php 
    							}
							?>
						</div>
						<div class="form-group">
							<label>Brand s???n ph???m (<span style='color: red'>*</span>)</label> 
							<?php 
    							$sql = "SELECT brand_id, brand_name FROM np_prod_brand WHERE delete_flag = '0'";
    							$result = $conn->query($sql);
    							if ($result->num_rows > 0) {
							?>
							<select class="form-control" name="brand_id" id="brand_id">
								<option value="">---- Ch???n Brand ----</option>
								<?php 
                    				while ($row = $result->fetch_assoc()) {
                				?>
								<option <?php if ($row45['brand_id'] == $row['brand_id']) {echo "selected='selected'";}?> value="<?=$row['brand_id']?>"><?=$row['brand_name']?></option>
								<?php 
                    				}
								?>
							</select>
							<?php 
    							}
							?>
						</div>
						<div class="form-group">
							<label>Tr???ng Th??i
							</label> <select class="form-control" name="product_status" id="product_status">
								<option <?php if ($row45['product_status'] == '0') {echo "selected='selected'";}?> value="0">C??n H??ng</option>
								<option <?php if ($row45['product_status'] == '1') {echo "selected='selected'";}?> value="1">H???t H??ng</option>
							</select>
						</div>
						<div class="form-group">
							<label>S???n Ph???m Flash Sale
							</label> <select class="form-control" name="product_flash_sale" id="product_flash_sale">
								<option <?php if ($row45['product_flash_sale'] == '0') {echo "selected='selected'";}?> value="0">H???t Sale</option>
								<option <?php if ($row45['product_flash_sale'] == '1') {echo "selected='selected'";}?> value="1">??ang Flash Sale</option>
							</select>
						</div>
						<div class="form-group">
							<label>Th???i gian Flash Sale (Ch??? ch???n khi s???n ph???m l?? Flash Sale)
							</label> 
							<input type="text" class="form-control" name="product_flash_sale_time" value="<?=$row45['product_flash_sale_time']?>" id="product_flash_sale_time"/>
						</div>
						<div class="form-group">
							<label>S???n Ph???m N???i B???t
							</label> <select class="form-control" name="product_hot" id="product_hot">
								<option <?php if ($row45['product_hot'] == '0') {echo "selected='selected'";}?> value="0">S???n Ph???m B??nh Th?????ng</option>
								<option <?php if ($row45['product_hot'] == '1') {echo "selected='selected'";}?> value="1">S???n Ph???m Hot</option>
								
							</select>
						</div>
						<div class="form-group">
							<label>Tag s???n ph???m</label> _ C?? th??? th??m nhi???u tag c??ch nhau b???i d???u ',' ( VD: tag1, tag2, ... )
							<input list="browsers-tag" name="suggest_tag_id" id="suggest_tag_id" value="" placeholder="H??? tr??? t??m ki???n Tag" style="width: 300px"/>
							<input type="button" id="suggest_set_tag_id" value="Th??m Tag"/>
							<div id="suggesstion-tag-box"></div>
							<?php 
							    $tagList = '';
        						$sql = " SELECT tag_name FROM np_prod_tag A";
        						$sql .= " INNER JOIN tag_product B ON A.tag_id = B.tag_id ";
        						$sql .= " WHERE B.product_id = '" . $row45['product_id'] . "'";
        						$result = $conn->query($sql);
        						if ($result->num_rows > 0) {
        						    while ($row = $result->fetch_assoc()) {
        						        $tagList .= $row['tag_name'] . ',';
        						    }
        						}
    						?>
							<textarea rows="5" class="form-control" name="tag_id" id="tag_id" ><?=substr($tagList, 0, -1)?></textarea>
						</div>
						<hr>
						<div class="form-group">
							<label>Ki???u S???n Ph???m </label> _Max: 200 k?? t???  <input type="text"
								class="form-control" name="product_style" value="<?=$row45['product_style']?>" id="product_style"/>
						</div>
						<div class="form-group">
							<label>N??i S???n Xu???t </label> _Max: 200 k?? t???  <input type="text"
								class="form-control" name="product_made_in" value="<?=$row45['product_made_in']?>" id="product_made_in"/>
						</div>
						<div class="form-group">
							<label>Th???i Gian B???o H??nh </label> _Max: 200 k?? t???  <input type="text"
								class="form-control" name="product_save" value="<?=$row45['product_save']?>" id="product_save"/>
						</div>
						<div class="form-group">
							<label>Th??ng S??? Kh??c </label> _Max: 1000 k?? t???  <input type="text"
								class="form-control" name="product_other_info" value="<?=$row45['product_other_info']?>" id="product_other_info"/>
						</div>
						<div class="form-group">
							<label>Seo Product </label> _Th??ng tin Header, Title, Meta ... ????? SEO _Max: 4000 k?? t???
							<textarea rows="10" class="form-control" name="product_seo" id="product_seo" ><?=$row45['product_seo']?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
						<label>B??i Vi???t V??? S???m Ph???m(<span style='color: red'>*</span>)
						</label> <textarea rows="20" class="form-control" name="product_detail"  id="editor"><?=$row45['product_detail']?></textarea>
				</div>
				</br>
				<label>(<span style='color: red'>*</span>)
					</label> Tr?????ng c???n ph???i nh???p th??ng tin
					<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' /> 
					<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
					<input type="submit" name="submit" value="Copy s???n ph???m" id="submit"
						class="btn btn-primary" /> 
					<input type="reset"
						class="btn btn-default" value="Reset" />
					</br></br></br>	
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
    $message = "";
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' && isset($_REQUEST['id']))
    {
        $id = $_REQUEST['id'];
        $sql = "UPDATE np_permalink SET delete_flag = '1' ";
        $sql .= $sql_common_update;
        $sql .= " WHERE data_id IN (SELECT data_id FROM np_product WHERE product_id = ? )";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $sql = "UPDATE np_product SET delete_flag = '1' ";
        $sql .= $sql_common_update;
        $sql .= " WHERE product_id = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
//         NpPermaLinkDba::delPermalink($conn, $table_name, $fieldCondidtonName, $id);
        
//         // X??a ???nh
//         $id = $conn->real_escape_string($_REQUEST['id']);
//         $sql = "SELECT image_url FROM np_prod_image WHERE product_id = '$id'";
//         $result = $conn->query($sql);
//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 if (file_exists($row['image_url'])) {
//                     unlink($row['image_url']);
//                 }
//             }
//         }
//         $sql = "DELETE FROM np_prod_image WHERE product_id = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("i", $id);
//         $stmt->execute();
        
        $message = $INFO_DELETE_DATA_OK;
    }
    $filter_group_id = '';
    $filter_filter_group_id = '';
    $search_productCode = '';
    
    $sql = "SELECT A.product_id, A.product_name, A.product_code, A.product_old_price, A.product_down_price, A.product_sell_price, B.permalink ";
    $sql .= " FROM np_product A ";
    $sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id WHERE B.delete_flag = '0' ";
    
    // Khi filter group
    if (isset($_POST['filter_group_id']) && !empty($_POST['filter_group_id'])) {
        $filter_group_id = $_POST['filter_group_id'];
        $sql .= " AND A.group_id = '" . $filter_group_id . "'";
    }
    
    // Khi filter B??? l???c Th????ng Hi???u
    if (isset($_POST['filter_filter_group_id']) && !empty($_POST['filter_filter_group_id'])) {
        $filter_filter_group_id = $_POST['filter_filter_group_id'];
        $sql .= " AND A.filter_id = '" . $filter_filter_group_id . "'";
    }
    
    // Khi T??m ki???m theo m?? s???n ph???m
    if (isset($_POST['search_productCode']) && !empty($_POST['search_productCode'])) {
        $search_productCode = $_POST['search_productCode'];
        $sql .= " AND A.product_code LIKE '%" . $search_productCode . "%'";
    }
    
    $sql .= " ORDER BY A.product_id DESC ";
    
    // =======================paging ============================
    // lay so so luong ban ghi
    $resultCount = $conn->query($sql);
    $totalRecord = $resultCount->num_rows;
    $totalPage =  intdiv($totalRecord, 100);
    if ($totalRecord - ($totalPage * 100) > 0) {
        $totalPage ++;
    }
    $currentPage = 1;
    if (isset($_POST['paging_group']) && !empty($_POST['paging_group'])) {
        $currentPage = $_POST['paging_group'];
        if (empty($currentPage)) {
            $currentPage = 1;
        }
    }
    $startR = ($currentPage - 1) * 100;
    
    $sql .= " Limit " .$startR. ", 100 ";
    
    // =======================paging ============================
    
    $result = $conn->query($sql);
    ?>
<form action="" method="post" name="list_product_form" id="list_product_form">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Danh s??ch S???n Ph???m (<?=($currentPage -1) * 100 ?> ~ <?=$currentPage * 100 ?>/<?=$totalRecord ?>s???n ph???m) <?=$message?></div>
			<div class="panel-body">
				<div class="col-md-6">
					<div class="form-group">
    					<input type="text" name="search_productCode" id="search_productCode" value="<?=$search_productCode?>" placeholder="T??m ki???m theo m?? s???n ph???m" style="width: 250px; height: 30px" />
    					<input type="submit" name="search_productCode_submit" value="T??m Ki???m"/>
    				</div>
    				
    				<div class="form-group">
    					<select class="form-control" name="filter_filter_group_id" id="filter_filter_group_id"  onchange="filter_group();">
    						<option value="">---- L???c s???n ph???m theo B??? l???c Th????ng Hi???u ----</option>
    						<?php 
    							$sql11 = "SELECT * FROM np_prod_filter ";
    							$result11 = $conn->query($sql11);
    							if ($result11->num_rows > 0) {
    							    while ($row11 = $result11->fetch_assoc()) {
            				?>
            					<option value="<?=$row11['prod_filter_id']?>" <?php if ($filter_filter_group_id == $row11['prod_filter_id']) echo "selected = 'selected'"; ?>><?=$row11['prod_filter_name']?></option>
            				<?php 
    							    }
    							}
            				?>
    					</select>
    				</div>
    			</div>
    			
				<div class="col-md-6">
					<div class="form-group">
    					<select class="form-control" name="paging_group" id="paging_group" onchange="filter_group();">
    						<?php 
    						for ($i = 1; $i <= $totalPage; $i++) {
    						?>
    							<option value="<?=$i?>" <?php if($currentPage == $i) echo 'selected=selected';?>>Page <?=$i?></option>
    						<?php 
    						}
    						?>
    					</select>
    				</div>
    				<div class="form-group">
    					<select class="form-control" name="filter_group_id" id="filter_group_id" onchange="filter_group();">
    						<option value="">---- L???c s???n ph???m theo nh??m ----</option>
    						<?php 
    						for ($i = 1; $i < 4; $i++) {					    
    						?>
    						<option value="">
    							<?php 
    							if ($i == 1){
    							    echo "A. Thi???t b??? v??? sinh";    
    							} else if ($i == 2) {
    							    echo "B. Thi???t b??? nh?? b???p";  
    							} else if ($i == 3) {
    							    echo "C. Thi???t b??? ??i???n";  
    							}
    							?>
    						 </option>
    						<?php 
    							$sql0 = "SELECT group_id, group_name FROM np_prod_group ";
    							$sql0 .= " WHERE group_type = '" .$i. "' AND group_level = '1' AND delete_flag = '0'";
    							$result0 = $conn->query($sql0);
    							if ($result0->num_rows > 0) {
    							    while ($row0 = $result0->fetch_assoc()) {
            				?>
    								<option <?php if($filter_group_id == $row0['group_id']) echo "selected = 'selected'"; ?> value="<?=$row0['group_id']?>">&nbsp;&nbsp;&nbsp;|---(<?=$row0['group_name']?>)</option>
    								<?php 
    								$sql1 = "SELECT group_id, group_name FROM np_prod_group ";
    								$sql1 .= " WHERE group_level_up = '" .$row0['group_id']. "' AND delete_flag = '0'";
    								$result1 = $conn->query($sql1);
    								if ($result1->num_rows > 0) {
    								    while ($row1 = $result1->fetch_assoc()) {
    								?>
    									<option <?php if($filter_group_id == $row1['group_id']) echo "selected = 'selected'"; ?> value="<?=$row1['group_id']?>">&nbsp;&nbsp;&nbsp;
    													&nbsp;&nbsp;&nbsp;
    													|---(<?=$row1['group_name']?>)</option>
    									<?php 
    									$sql2 = "SELECT group_id, group_name FROM np_prod_group ";
    									$sql2 .= " WHERE group_level_up = '" .$row1['group_id']. "' AND delete_flag = '0'";
    									$result2 = $conn->query($sql2);
    									if ($result2->num_rows > 0) {
    									    while ($row2 = $result2->fetch_assoc()) {
    									?>
    										<option <?php if($filter_group_id == $row2['group_id']) echo "selected = 'selected'"; ?> value="<?=$row2['group_id']?>">
    														&nbsp;&nbsp;&nbsp;
    														&nbsp;&nbsp;&nbsp;
    														&nbsp;&nbsp;&nbsp;
    														|---<?=$row2['group_name']?></option>
    									<?php 
            								}
        								}
        								?>
    								<?php 
        								}
    								}
    								?>
    						<?php 
                    				}
    							}
    						}
    						?>
    					</select>
    				</div>
    			</div>
    			<div class="col-md-6">
    				<input type="hidden" name='pcid' value='<?=$_REQUEST['pcid']?>' /> 
					<input type="hidden" name='display' value='<?=$_REQUEST['display']?>' /> 
					<a href="?pcid=importCSV" ><button type="button" class="btn btn-sm btn-primary">Update Nhi???u S???n Ph???m T??? File</button></a>
            		<button type="button" onclick="export_csv();" class="btn btn-sm btn-success">Export Csv ????? S???a H??ng Lo???t S???n Ph???m</button>
    			</div>
    			<script type="text/javascript" lang="javascript">
    				function export_csv() {
    					document.getElementById("list_product_form").action = "exportCSV.php";
						document.getElementById("list_product_form").submit();
    				}
    				
    				function filter_group() {
    					document.getElementById("list_product_form").action = "";
						document.getElementById("list_product_form").submit();
    				}
    			</script>
			</div>
			<div class="panel-body">
				<table class="table">
				<tr>
					<td>No</td>
					<td>Product Id</td>
					<td>Product Name</td>
					<td>M?? S???n Ph???m</td>
					<td>Gi??</td>
					<td>Gi???m Gi??</td>
					<td>Gi?? B??n</td>
					<td>Th??m ???nh</td>
					<td>S???a | Clone</td>
					<td>X??a</td>
					<td>View</td>
				</tr>
				<?php 
				if ($result->num_rows > 0) {
				    $n = 0;
    				while ($row = $result->fetch_assoc()) {
    				    $n ++;
				?>
				<tr>
					<td><?=$n?></td>
					<td><?=$row['product_id']?></td>
					<td><?=$row['product_name']?></td>
					<td><?=$row['product_code']?></td>
					<td><?=Common::convertMoney($row['product_old_price'])?></td>
					<td><?=$row['product_down_price']?> %</td>
					<td><?=Common::convertMoney($row['product_sell_price'])?></td>
					<td><a href="?pcid=imgpd&display=addnew&id=<?=$row['product_id']?>&prdcode=<?=$row['product_code']?>&table=np_product">Add</a></td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=edit&id=<?=$row['product_id']?>">S???a </a>
					| <a href="?pcid=<?=$_REQUEST['pcid']?>&display=clone&id=<?=$row['product_id']?>">clone </a>
					</td>
					<td><a href="?pcid=<?=$_REQUEST['pcid']?>&display=list&action=delete&id=<?=$row['product_id']?>"
							onclick="return confirm('<?=$CONFIRM_DELETE?>');">X??a</a></td>
					<td><a target="blank" href="<?=Common::$_HOME_PAGE .'/'. $row['permalink']?>">View</a></td>
				</tr>
				<?php 
				    }
				}
				?>
				</table>
			</div>
		</div>
	</div>
</div>
</form>
<?php 
}
?>
<script language="JavaScript" type="text/javascript">
	function discount() {
		var price = document.forms['formProduct']['product_sell_price'].value;
		var oldprice = document.forms['formProduct']['product_old_price'].value;
        
        if (price != "" && oldprice != "") {
        	var discount = Math.round(((oldprice - price) / oldprice) * 100);
        	
            document.getElementById("product_down_price").value = discount;
        }
	}
</script>
<script language="JavaScript" type="text/javascript">

	function validProduct() {
		var str = '';
	
        var val = document.forms['formProduct']['product_name'].value;
        if (val == "") {
            str += 'Product Name';
        }
        
        val = document.forms['formProduct']['permalink'].value;
        if (val == "") {
            str += '\nProduct Name Permalink';
        }
        
        val = document.forms['formProduct']['product_code'].value;
        if (val == "") {
            str += '\nM?? S???n Ph???m';
        }
        
        val = document.forms['formProduct']['product_sell_price'].value;
        if (val == "") {
            str += '\nGi?? B??n';
        }
        
        val = document.forms['formProduct']['group_id'].value;
        if (val == "") {
            str += '\nGroup s???n ph???m';
        }
        
        val = document.forms['formProduct']['brand_id'].value;
        if (val == "") {
            str += '\nBrand s???n ph???m';
        }
        
        if (str != '') {
        	alert('C??c tr?????ng b??n d?????i c???n ph???i nh???p : \n' + str);
        	return false;
        } else {
        	document.getElementById("formProduct").submit();
        }
	}
</script>
<script language="JavaScript" type="text/javascript">
	CKEDITOR.replace( 'editor' , {
		height: 300,
    	filebrowserUploadUrl: 'ckUpload.php'
	} );
</script>