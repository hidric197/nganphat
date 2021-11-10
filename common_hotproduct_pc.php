<div class="trend-catalog wrap-catalog-main" id="trend-catalog-id">
	<div class="trend-catalog-title">
		<h2>Danh mục nổi bật</h2>
	</div>
	<div class="wrap-catalog-main">
			<ul class="list-catalog-main">
				<?php
				$sqlGroup = "SELECT B.permalink, A.group_id, A.group_name, A.image_title, A.image_url ";
				$sqlGroup .= " FROM np_prod_group A ";
				$sqlGroup .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
				$sqlGroup .= " WHERE A.delete_flag = '0' ";
        		$result1 = $conn->query($sqlGroup);
                
        		$displayNumber = 20;
        		if (isset($_REQUEST['displayNumber']) && !empty($_REQUEST['displayNumber'])) {
        		    $displayNumber = $_REQUEST['displayNumber'];
        		}
        		
        		$index = 0;
        		$load = 0;
        		if ($result1->num_rows > 0) {        		    
        		    while ($row1 = $result1->fetch_assoc()) {
        		        $index ++;
        		        if ($index > $displayNumber){
        		            $load ++;
        		            continue;
        		        }
        	?>
				<li class="catalog-main-item"><a href="<?=$row1['permalink']?>"
					title="<?=$row1['group_name']?>">
					<div class="icon-cat-main-thumb">
						<span>
							<img class="lazy-img lazy-loaded" alt="<?=$row1['image_title']?>"
								data-src="npad/<?=$row1['image_url']?>"
								src="npad/<?=$row1['image_url']?>"/>
						</span>
					</div>
					<div class="name-cat-main"><?=$row1['group_name']?>
					</div>
					</a>
				</li>
			<?php 
        		    }
        		}
        		
        		if ($load > 20) {
        		    $displayNumber += 20;
        		    $load = 20;
        		} else {
        		    $displayNumber += $load;
        		}
			?>
			</ul>
			<form action="?#trend-catalog-id" method="post" name="load-more-hot-product" id="load-more-hot-product">
				<input type="hidden" id="displayNumber" name="displayNumber" value="<?=$displayNumber?>">
    			<div class="view-more-page">
    			<?php
    			     if ($load > 0){
    			?>
    				<a href="#" onclick="submitLoadMoreProduct();">Xem thêm <?=$load?> danh mục</a>
    			<?php
    			     }
    			?>
    			</div>
			</form>
			
			<script language="JavaScript" type="text/javascript">
				function submitLoadMoreProduct() {
					document.getElementById("load-more-hot-product").submit();
				}	
			</script>
	</div>
</div>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function () {
        $('.trend-category.view-more-page a').click(function (e) {
            e.preventDefault();
            $('.trend-catalog ul').css('max-height', 'inherit');
            $(this).remove();

            $('.trend-catalog img').each(function () {
                if ($(this).data('src') != $(this).prop('src')) {
                    $(this).prop('src', $(this).data('src'));
                }
            });
        });
    });
</script>