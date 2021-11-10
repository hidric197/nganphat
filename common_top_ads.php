<?php 
if ($isMobile == 'False') {
    $banner_image_title = '';
    $banner_image_url = '';
    $banner_image_link = '';
    $banner_background = '';
    $sql = "SELECT A.banner_image_id, A.banner_image_type, A.banner_image_title, A.banner_image_url, A.banner_image_link, A.banner_background ";
    $sql .= " FROM np_banner_image A ";
    $sql .= " WHERE A.banner_image_type = '1' AND A.delete_flag = '0' ";
    $result = $conn->query($sql);
    $totalR = $result->num_rows;
    if ($totalR > 0) {
        $index = 1;
        $rndNumber = rand(1,$totalR); 
        
        if ($totalR > 1) {
            $ssNumberTopAds = 1;
            if (isset($_SESSION[Common::$SESSION_TOP_ADS])) {
                $ssNumberTopAds = $_SESSION[Common::$SESSION_TOP_ADS];
            }
            while ($rndNumber == $ssNumberTopAds) {
                $rndNumber = rand(1,$totalR); 
            }
        }
        
        $_SESSION[Common::$SESSION_TOP_ADS] = $rndNumber;
        
        while ($row = $result->fetch_assoc()) {
            if ($index == $rndNumber) {
                $banner_image_title = $row['banner_image_title'];
                $banner_image_url = $row['banner_image_url'];
                $banner_image_link = $row['banner_image_link'];
                $banner_background = $row['banner_background'];
            }
            $index ++;
        }
?>
<div class="top-banner" style="background: <?=$banner_background?>;">
	<a target="_blank" href="<?=$banner_image_link?>"> <img alt="<?=$banner_image_title?>"
		src="npad/<?=$banner_image_url?>">
	</a>
</div>
<?php 
    }
} else {
    $banner_image_title = '';
    $banner_image_url = '';
    $banner_image_link = '';
    $banner_background = '';
    $sql = "SELECT A.banner_image_id, A.banner_image_type, A.banner_image_title, A.banner_image_url, A.banner_image_link, A.banner_background ";
    $sql .= " FROM np_banner_image A ";
    $sql .= " WHERE A.banner_image_type = '4' AND A.delete_flag = '0' ";
    $result = $conn->query($sql);
    $totalR = $result->num_rows;
    if ($totalR > 0) {
        $index = 1;
        $rndNumber = rand(1,$totalR);
        if ($totalR > 1) {
            $ssNumberTopAds = 1;
            if (isset($_SESSION[Common::$SESSION_TOP_ADS])) {
                $ssNumberTopAds = $_SESSION[Common::$SESSION_TOP_ADS];
            }
            while ($rndNumber == $ssNumberTopAds) {
                $rndNumber = rand(1,$totalR);
            }
        }
        $_SESSION[Common::$SESSION_TOP_ADS] = $rndNumber;
        
        while ($row = $result->fetch_assoc()) {
            if ($index == $rndNumber) {
                $banner_image_title = $row['banner_image_title'];
                $banner_image_url = $row['banner_image_url'];
                $banner_image_link = $row['banner_image_link'];
                $banner_background = $row['banner_background'];
            }
           $index ++;
        }
    
?>
<div class="top-banner" style="background: <?=$banner_background?>;">
	<a　href="<?=$banner_image_link?>">
		<img alt="<?=$banner_image_title?>"
		src="npad/<?=$banner_image_url?>">
	</a>
</div>
<?php
    }
}
?>
