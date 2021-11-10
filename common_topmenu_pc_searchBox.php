
<div class="box-search">
	<div id="searchBox" class="frmsearch">
		<form id="frmsearch" action="tim-kiem" title="Tìm kiếm sản phẩm" method="post">
			<input type="text" name="txtQuerySearch" tabindex="-1" id="txtQuerySearch" style="padding-left: 20px; width: 95%"
				class="txtQuerySearch search-txt txtsearch" autocomplete="off" size="40"
				value="" title="Nhập từ khóa liên quan đến sản phẩm"
				placeholder="Bạn cần tìm kiếm sản phẩm gì?"
				oninvalid="this.setCustomValidity('Nhập từ khóa liên qua đến sản phẩm')"
				required /><span class="head-icon-search"></span>
			<div class="btnSearch" id="FindSubmit">
				<input type="submit" value="Tìm kiếm" id="btnFindSearch"
					class="btnFindSearch">
			</div>
			<div id="suggesstion-box"></div>
		</form>
	</div>
</div>

<!-- 
<div class="ac_results" style="position: absolute; width: 540px; top: 53.5px; left: 295.45px; display: block;"></div>
 -->

<script language="JavaScript" type="text/javascript">

	function changeColorRow(id) {
		$("#" + id).css("background-color", "gray");
	}
	
	function changeBackColor(id, color) {
		$("#" + id).css("background-color", color);
	}
	
	$(document).mouseup(function(e) 
    {
        var container = $("#suggesstion-box");
        if (!container.is(e.target) && container.has(e.target).length === 0) 
        {
            container.hide();
        }
    });
	
// AJAX call for autocomplete 
    $(document).ready(function(){
    	$("#txtQuerySearch").keyup(function(){
    		$.ajax({
    		type: "POST",
    		url: "_api_search.php",
    		data:'keyword='+$(this).val(),
    		beforeSend: function(){
    			// $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    		},
    		success: function(data){
    			$("#suggesstion-box").show();
    			$("#suggesstion-box").html(data);
    		}
    		});
    	});
    	
    	$("#txtQuerySearch").click(function(){
    		$.ajax({
    		type: "POST",
    		url: "_api_search.php",
    		data:'keyword='+$(this).val(),
    		beforeSend: function(){
    			// $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    		},
    		success: function(data){
    			$("#suggesstion-box").show();
    			$("#suggesstion-box").html(data);
    		}
    		});
    	});
    });
</script>

