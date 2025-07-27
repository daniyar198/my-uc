<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$curPage=$this->GetFolder();
require_once ($_SERVER["DOCUMENT_ROOT"] .$curPage . "/library.php");
$arBXCSiteSettings=$arResult["arBXCSiteSettings"];
if(!isset($arBXCSiteSettings["ACTIVE"]))$arBXCSiteSettings["ACTIVE"]="Y";
$APPLICATION->SetPageProperty("show_title", "N");
$APPLICATION->SetPageProperty("show_breadcrumb", "N");

?> 
<?$APPLICATION->AddChainItem($APPLICATION->GetTitle(),$arResult["FOLDER"]);?>
<style>
 #titlepage{display:none;}
 section.slice.bb {display: none }
 div.wp-tabs div.tab-content{border:none !important;}
</style>
<script type="text/javascript"> 
   $(".content .col-md-<?=$GLOBALS["main_column_width"]?>").removeClass("col-md-<?=$GLOBALS["main_column_width"]?>").addClass("col-md-12");
   $(".left-column").hide();
    $(document).ready(function(){
    	$(".fancybox").fancybox({
            'openEffect'    : 'none',
            'closeEffect'   : 'none',
            'showNavArrows': true,
            'showCloseButton': false
        });
    })
</script>
<?$APPLICATION->AddChainItem($arBXCSiteSettings["NAME"], "");?>
<?$APPLICATION->SetTitle($arBXCSiteSettings["NAME"]);?>

</div></div></section>

<section class="slice relative" style="background-image: url('<?=$arResult["arBXCSiteSettings"]["CAPTURE"]["src"]?>'); background-size: cover; ">
	<div class=" mask bg-dark-60"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1 class="mt-40 c-white">
					<?=$arResult["arBXCSiteSettings"]["NAME"]?>
				</h1>
				<div class="lead c-white hidden-sm hidden-xs">
					<?=$arResult["arBXCSiteSettings"]["SHORT_DESCRIPTION"]["TEXT"]?>
				</div>
			</div>
			<div class="col-md-6 light-back">
				<?$APPLICATION->IncludeComponent(
					"simai:feedback.all.string",
					"feedback-banner",
					Array(
						"IBLOCK_TYPE" => "forms",
						"IBLOCK_ID" => $arParams["IBLOCK_ID_FEEDBACK"],
						"EMAIL" => COption::GetOptionString($GLOBALS["moduleName"],"email",""),
						"EMAIL_SUBJ" => getMessage("ORDER_NOW"),
						"OK_MSG" => getMessage("ORDER_SUBMIT"),
						"USE_GOOGLE_CAPTCHA" => COption::GetOptionString($GLOBALS["moduleName"],"use_google_captcha",""),
						"PUBLIC_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"public_key",""),
						"PRIVATE_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"private_key",""),	
						"THEME_SENDER" => $arParams["THEME_SENDER"],
		                "MESSAGE_SENDER" => $arParams["MESSAGE_SENDER"],
					)
				);?>
			</div>
		</div>
	</div>
</section>

<section class="slice">
<div class="wp-tabs">
<div class="container">	


<?if(!isset($arParams["TEMPLATE_DEF"])||$arParams["TEMPLATE_DEF"]=="") $arParams["TEMPLATE_DEF"] = "tabs";?>


<?require_once ($_SERVER["DOCUMENT_ROOT"] .$curPage . "/".$arParams["TEMPLATE_DEF"].".php");?>


	
<script>
  $('.stacktable').stacktable(); 
</script>

<script>
 $("textarea").val("<?=getMessage("ORDER")?> <?=$arBXCSiteSettings["~NAME"]?>");
</script>
<script>
	$(document).ready(function(){
		var step = 250,
		widthCont = 0,
		left = 0,
		heightSl,
		view,
		cont,
		stop;

		function inicial(){
			stop = 0;
			cont = 0;
			view = 0;
			widthCont = 0;
			heightSl = $('.slider-viewport .slider-container .sli-pic').outerHeight();
			$('.slider-viewport').height(heightSl);

			$('.slider-viewport .slider-container .sli-pic').each(function(indx){
				widthCont+=$(this).outerWidth();
				widthCont+=parseInt($(this).css('margin-right'), 10);
			});
			$('.slider-viewport .slider-container').width(widthCont+1);
			view = $('.slider-viewport').width();
			cont = $('.slider-container').width();
			stop = cont - view;
		}
		$(window).on( "resize", inicial );
		inicial();
		nextSlide(0);

		$('.control.next').click(function(){
			if ((left + step >= stop)||(left + step*1.3 >= stop)){
				left = stop;
				nextSlide(left);
			}else if (left + step < stop){
				left +=step;
				nextSlide(left);
			} 
		})
		$('.control.prev').click(function(){
			if ((left - step <= 0)||(left - step*1.3 <= 0)){
				left = 0;
				nextSlide(left);
			}else if (left - step > 0){
				left -=step;
				nextSlide(left);
			}
		})
		function nextSlide(left){
			left*=-1;
			$('.slider-container').css("left", left);
		}

		$('.slider-viewport').on('mouseover', function(){
			$('.slider-viewport').addClass('sl-hover');
		})
		$('.slider-viewport').on('mouseout', function(){
			$('.slider-viewport').removeClass('sl-hover');
		})

	})
</script>

