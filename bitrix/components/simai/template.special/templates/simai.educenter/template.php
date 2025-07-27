<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$module="simai.educenter";
?>

<script type="text/javascript">
	$(function() {
		$(".image-on").on("click",function(){
			  $(".image-on").hide();
			  $(".image-off").show();
			  $.ajax(
				{type: "POST",
				url: "<?=$templateFolder?>/set_setting.php",
				data: "type=MAIN&param=IMAGE&value=special-image-on",
});
			  
		});
		$(".image-off").on("click",function(){
			  $(".image-off").hide();
			  $(".image-on").show();
			   $.ajax(
				{type: "POST",
				url: "<?=$templateFolder?>/set_setting.php",
				data: "type=MAIN&param=IMAGE&value=special-image-off",
});
		});			
		$(".return-normal").on("click",function(){
			  $(".return-normal").hide();
			  $(".return-eye").show();
			   $.ajax(
				{
			     type: "POST",
				 url: "<?=$templateFolder?>/set_setting.php",
				 data: "type=MAIN&param=SPECIAL&value=off",
                });
		});	
		$(".return-eye").on("click",function(){
			  $(".return-eye").hide();
			  $(".return-normal").show();
			  
			  $.ajax(
				{type: "POST",
				 url: "<?=$templateFolder?>/set_setting.php",
				 data: "type=MAIN&param=SPECIAL&value=on",
});
		});
		
		
	$("[data-aa-on]").on("click",function(){	  
		$.ajax(
			{type: "POST",
			url: "<?=$templateFolder?>/set_setting.php",
			data: "type=MAIN&param=SPECIAL&value=on",});
									
		var specdefault="special-aaVersion-on special-color-white special-font-small special-image-on";
		console.log(specdefault);
        $('body').addClass(specdefault);
        $("#WpStyle").attr("href", "/bitrix/templates/<?=$module?>/framework/color/white.css");
		$.ajax(
			{type: "POST",
			 url: "<?=$templateFolder?>/set_setting.php",
			data: "type=MAIN&param=special-color&value=white",
});

      	$.ajax(
			{type: "POST",
			 url: "<?=$templateFolder?>/set_setting.php",
			data: "type=MAIN&param=special-font&value=small",
});

       	$.ajax(
			{type: "POST",
			 url: "<?=$templateFolder?>/set_setting.php",
			data: "type=MAIN&param=special-image&value=on",
});
		return false;
    });

	$("[data-aa-off]").on("click",function(){
		$('.switch-vision.return-eye').show();
			  $.ajax(
				{type: "POST",
				 url: "<?=$templateFolder?>/set_setting.php",
				data: "type=MAIN&param=SPECIAL&value=off",
});

    	var htmlCurrentClass = $('body').prop('class'),
		clearSpecialClasses = htmlCurrentClass.replace(/special-([a-z,A-Z,-]+)/g, '');
		$('body').prop('class', clearSpecialClasses);
		$("#WpStyle").attr("href", "/bitrix/templates/<?=$module?>/framework/color/color.css");
		$(".image-on").hide();
		$(".image-off").show();
	    return false;
		});	
		
		
		
		$(".special-settings a").on("click",function(){	
		     data=$(this).data();
			 console.log(data);
             $html = $('body');
			 htmlCurrentClass = $html.prop('class');
             for (var key in data) {
				var reg = new RegExp("special-"+key+"-[^ ]{1,}", "g");
				htmlCurrentClass=htmlCurrentClass.replace(reg, "special-"+key+"-"+data[key]);
				  $.ajax(
						{type: "POST",
						 url: "<?=$templateFolder?>/set_setting.php",
						data: "type=MAIN&param=special-"+key+"&value="+data[key],});
				if(key=="color")
				{
					if(data[key]=="white")  $("#WpStyle").attr("href", "/bitrix/templates/<?=$module?>/framework/color/white.css");
				    if(data[key]=="black")$("#WpStyle").attr("href", "/bitrix/templates/<?=$module?>/framework/color/black.css");
				    if(data[key]=="yellow")$("#WpStyle").attr("href", "/bitrix/templates/<?=$module?>/framework/color/yellow.css");
				    if(data[key]=="blue")$("#WpStyle").attr("href", "/bitrix/templates/<?=$module?>/framework/color/blue.css");
				}
			}
        
        $html.prop('class',htmlCurrentClass);
	    return false;
		});	
		
	});	
</script>
<div class="special-settings bg-lgrey">
<div class="row pt-10 pb-5 f-18" style="letter-spacing:normal !important;">
		<div class="col-md-2 lh-40 text-center">
			<div><span style="font-size: 16px !important;"><?=getMessage("SCHEME_COLOR")?></span></div>
			<div>
			  <a href="#" style="font-size: 16px !important;" class="theme white" data-color="white">C</a>
			  <a href="#" style="font-size: 16px !important;" class="theme black" data-color="black">C</a>
			  <a href="#" style="font-size: 16px !important;" class="theme yellow" data-color="yellow">C</a>	
			  <a href="#" style="font-size: 16px !important;" class="theme blue" data-color="blue">C</a>
			</div>
		</div>
	    <div class="col-md-2 lh-40 text-center">
		   <div>
			 <span style="font-size: 16px !important;"><?=getMessage("SPECIAL_FONT")?></span>
		   </div>
		   <div>
		     <a href="#" data-fonttype="arial" class="theme white" style="font-size: 12px;">Arial</a>
		     <a href="#" data-fonttype="times" class="theme white" style="font-size: 12px;">Times New Roman</a>
		   </div>
		</div>		
		<div class="col-md-2 lh-40 text-center">
			    <div>
				  <span style="font-size: 16px !important;"><?=getMessage("FONT_SIZE")?></span>
				</div>
			   <div>
				<a href="#" data-font="small" style="font-size: 20px !important;" title="<?=getMessage("FONT_SIZE_SMALL")?>">A</a>
				<a href="#" data-font="medium" style="font-size: 24px !important;"  title="<?=getMessage("FONT_SIZE_MEDIUM")?>">A</a>
				<a href="#" data-font="big" style="font-size: 28px !important;"  title="<?=getMessage("FONT_SIZE_BIG")?>">A</a>		
              </div>				
		</div>
		<div class="col-md-2 lh-40 text-center">
		   <div>
			 <span style="font-size: 16px !important;"><?=GetMessage('KERNING')?></span>
		   </div>
		   <div>
		     <a href="#" data-kerning="small" style="font-size: 20px;">1</a>
		     <a href="#" data-kerning="normal" style="font-size: 20px;">2</a>
			 <a href="#" data-kerning="big" style="font-size: 20px;">3</a>
		   </div>
		</div>
	
		<div class="col-md-2 lh-40 text-center">
		  <div>
			 <span style="font-size: 16px !important;"> <?=getMessage("PICTURES")?></span>
		  </div>
		  <div>
			  <a class="image-on a-current" data-image="on" href="#" <?if(strstr ($_COOKIE["aaSet"],"\"image\":\"on\"")|| (!strstr ($_COOKIE["aaSet"],"image"))){?> style="display: none;"<? } ?>> <i class="fa fa-toggle-off f-24"></i></a>
			  <a class="image-off" data-image="off" href="#" <?if(strstr ($_COOKIE["aaSet"],"\"image\":\"off\"")){?> style="display: none;"<? } ?> ><i class="fa fa-toggle-on f-24"></i></a>
		  </div>
		</div>	
		<div class="col-md-2 text-left">
			  <a href="<?=SITE_DIR?>?set-aa=normal" data-aa-off class="btn btn-base return-normal f-18 mt-35"><?=getMessage("COMMON_VERSION")?></a>
		</div>	
 </div>	
</div>