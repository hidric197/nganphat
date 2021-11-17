
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<?php 
if (isset($_REQUEST['pmk']) && ! empty($_REQUEST['pmk'])) {
    if (! empty($home_table_name)) {
        $sql999 = '';
        
        $dataId = $conn->real_escape_string($home_data_id);
        
        if ($home_table_name == Common::$_TABLE_NP_PROD) {
            $sql999 = "SELECT product_seo AS seo FROM  np_product WHERE data_id = '$dataId'";
            
        } else if ($home_table_name == Common::$_TABLE_NP_PROD_TAG) {
            $sql999 = "SELECT tag_seo AS seo FROM  np_prod_tag WHERE data_id = '$dataId'";
            
        } else if ($home_table_name == Common::$_TABLE_NP_PROD_GROUP) {
            $sql999 = "SELECT group_seo AS seo FROM  np_prod_group WHERE data_id = '$dataId'";
            
        } else if ($home_table_name == Common::$_TABLE_NP_PROD_BRAND) {
            $sql999 = "SELECT brand_seo AS seo FROM  np_prod_brand WHERE data_id = '$dataId'";
            
        } else if ($home_table_name == Common::$_TABLE_NP_PAGE) {
            $sql999 = "SELECT page_seo AS seo FROM  np_page WHERE data_id = '$dataId'";
            
        } else if ($home_table_name == Common::$_TABLE_NP_LANDING_PAGE) {
            $sql999 = "SELECT landing_page_seo AS seo FROM  np_landing_page WHERE data_id = '$dataId'";
       
        } else if ($home_table_name == Common::$_TABLE_NP_PROD_FILTER) {
            $sql999 = "SELECT prod_filter_seo AS seo FROM  np_prod_filter WHERE data_id = '$dataId'";
        }

        $result999 = $conn->query($sql999);
        if ($result999->num_rows > 0) {
            while ($row999 = $result999->fetch_assoc()) {
                echo $row999['seo'];
            }
        }
    }
} else {
?>
<title>Thiết bị vệ sinh cao cấp Ngân Phát</title>
<!-- This site is optimized with the Yoast SEO plugin v5.2 - https://yoast.com/wordpress/plugins/seo/ -->
<meta name="description" content="Thiết bị vệ sinh Ngân Phát. Chuyên cung cấp các sản phẩm thiết bị vệ sinh cao cấp - Thiết bị nhà bếp - Thiết bị điện - Gạch ốp lát được nhập khẩu chính hãng với giá cả hợp lý và chất lượng tốt nhất Việt Nam. Miễn phí vận chuyển nội thành Hà Nội. Hotline: 04 3633 1159 – 0983 573 166 – 0916 950 756"/>
<link rel="canonical" href="http://nganphat.com.vn/" />
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Thiết bị vệ sinh phòng tắm cao cấp chính hãng - Ngân Phát" />
<meta property="og:description" content="Thiết bị vệ sinh Ngân Phát. Chuyên cung cấp các sản phẩm thiết bị vệ sinh cao cấp - Thiết bị nhà bếp - Thiết bị điện - Gạch ốp lát được nhập khẩu chính hãng với giá cả hợp lý và chất lượng tốt nhất Việt Nam. Miễn phí vận chuyển nội thành Hà Nội. Hotline: 04 3633 1159 – 0983 573 166 – 0916 950 756" />
<meta property="og:url" content="http://nganphat.com.vn/" />
<meta property="og:site_name" content="Thiết bị vệ sinh Ngân Phát" />
<meta property="og:image" content="http://nganphat.com.vn/wp-content/uploads/2019/03/anh-slider2.jpg" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="Thiết bị vệ sinh Ngân Phát. Chuyên cung cấp các sản phẩm thiết bị vệ sinh cao cấp - Thiết bị nhà bếp - Thiết bị điện - Gạch ốp lát được nhập khẩu chính hãng với giá cả hợp lý và chất lượng tốt nhất Việt Nam. Miễn phí vận chuyển nội thành Hà Nội. Hotline: 04 3633 1159 – 0983 573 166 – 0916 950 756" />
<meta name="twitter:title" content="Thiết bị vệ sinh cao cấp Ngân Phát" />
<meta name="twitter:image" content="http://nganphat.com.vn/wp-content/uploads/2019/03/anh-slider2.jpg" />
<script type='application/ld+json'>{"@context":"http:\/\/schema.org","@type":"WebSite","@id":"#website","url":"http:\/\/nganphat.com.vn\/","name":"Thi\u1ebft b\u1ecb v\u1ec7 sinh Ng\u00e2n Ph\u00e1t","potentialAction":{"@type":"SearchAction","target":"http:\/\/nganphat.com.vn\/?s={search_term_string}","query-input":"required name=search_term_string"}}</script>
<?php 
}
?>

<!-- / Yoast SEO plugin. -->
<link rel="shortcut icon"
	href="<?=Common::$_HOME_PAGE?>/template/images/favicon.ico">
	

<script language="JavaScript" type="text/javascript">
(function(n){
	n._zn=function(n){
		return(n==null||typeof n=="undefined"||n=="")&&(n="primary"),n
	};
	n._initfx=function(t){
		var i=n._zn(t);
		return n._embeds=n._embeds||[],n._embeds[i]=n._embeds[i]||[],i
	};
	n._queuefx=function(t,i){
		var r=n._initfx(i);n._embeds[r].push(t)
	};
	n._runfx=function(t){
		for(var i=n._initfx(t),r;typeof n._embeds[i]!="undefined"&&n._embeds[i].length>0;){
			r=n._embeds[i].shift();
			try{
				typeof r!="undefined"&&r()
			}catch(u){
				console.log('_runfx("'+i+'"):'+u.message);console.log(u.stack)
			}
		}
	};
	n._loadJs=function(t,i){
		var u=n.document,r=u.createElement("script");
		r.async=!0;
		r.src=t;
		i!=null&&typeof i=="function"&&(r.onload=i);
		u.body.appendChild(r)
	};
	n._loadJsLs=function(t,i){
		var r=t[0],u=t.length==1?i:function(){
			n._loadJsLs(t.slice(1),i)
		};n._loadJs(r,u)
	};
	n._queueLoadJs=function(n,t,i){
		_queuefx(function(){
			_loadJs(n,i)
			},t)
	};
	var t={};
	t.isTouch=!!("ontouchstart"in n)||!!("onmsgesturechange"in n);
	t.windowWidth=n.innerWidth;
	t.isPhone=/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Opera Mobile|Kindle|Windows Phone|PSP|AvantGo|Atomic Web Browser|Blazer|Chrome Mobile|Dolphin|Dolfin|Doris|GO Browser|Jasmine|MicroB|Mobile Firefox|Mobile Safari|Mobile Silk|Motorola Internet Browser|NetFront|NineSky|Nokia Web Browser|Obigo|Openwave Mobile Browser|Palm Pre web browser|Polaris|PS Vita browser|Puffin|QQbrowser|SEMC Browser|Skyfire|Tear|TeaShark|UC Browser|uZard Web|wOSBrowser|Yandex.Browser/i.test(navigator.userAgent);
	t.isMobile=t.isTouch||t.isPhone||t.windowWidth<800;
	n._device=t
})(window)

</script>

<script language="JavaScript" type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="template/js/js.js"></script>

