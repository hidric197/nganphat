<?php 
	$sql = "SELECT A.brand_id, A.brand_name, B.permalink, A.image_title, A.image_url FROM np_prod_brand A ";
	$sql .= " INNER JOIN np_permalink B ON A.data_id = B.data_id ";
	$sql .= " WHERE A.delete_flag = '0'";
	$sql .= " LIMIT 10";
	$brandresult = $conn->query($sql);
	if ($brandresult->num_rows > 0) {
?>
<div id="catalog-14" class="box-catalog brand">
	<div class="box-cat-bar">
		<div class="box-cat-title">
			<h2>
				<a>Thương hiệu nổi bật</a>
			</h2>
		</div>
	</div>
	<div class="body-brand-highlight">
		<ul class="list-brand-highlight">
			<?php 
			        $n = 1;
    			    while ($row = $brandresult->fetch_assoc()) {
    			        if($n % 2 != 0){
    			            echo "<li class='brand-highlight-item'>";
    			        }
    			        
			?>
				
    				<a href="<?=$row['permalink']?>" class="brand-thumb" title="<?=$row['image_title']?>"> 
    					<img class="lazy-img" src="npad/<?=$row['image_url']?>"
    					data-src="npad/<?=$row['image_url']?>" alt="<?=$row['image_title']?>">
    				</a>
    			
    		<?php 
                		if($n % 2 == 0){
                		    echo "</li>";
                		}
    		          $n ++;
    			    }
    		?>
			</li>
		</ul>
	</div>
</div>
<?php 
	}
?>
	