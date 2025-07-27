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
					<?=$arResult["arBXCSiteSettings"]["SHORT_DESCRIPTION"]["TEXT"] ?>
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
<div class="wp-section">
<div class="container">	
	
<?if($arBXCSiteSettings["DESCRIPTION"]):?>
    <div class="row">
        <div class="col-md-12">	
		<div class="section-title-wr mp">
				<h2 class="section-title"><span><?=getMessage("DESCRIPTION")?></span></h2>
		</div>		
            <?=$arBXCSiteSettings["DESCRIPTION"]["TEXT"]?>
		</div>
	</div>
<?endif?>


<?if(!empty($arBXCSiteSettings["FORM"])):?>
    <div class="row">
        <div class="col-md-12">
			<div class="section-title-wr mp">
				<h2 class="section-title" id="PRICE"><span><?=getMessage("PRICE")?></span></h2>
			</div>
	   <table class="table table-bordered">
        <thead>
          <tr>
            <th><?=GetMessage("SERVICE")?></th>
            <th><?=GetMessage("PRICE")?></th>
          </tr>
          </thead>
	     <tbody>			
        <?foreach($arBXCSiteSettings["FORM"] as $value):?>
			  <tr>
            <td><?=$value["SUB_VALUES"]["NAME_FORM"]["VALUE"]?></td>
            <td><?=$value["SUB_VALUES"]["COST_FORM"]["VALUE"]?></td>
          </tr>
	    <?endforeach;?>
	  </tbody>
      </table>		



      
		</div>
	</div>
<?endif;?>

<div class="row">
<div class="col-md-6">
	<div class="section-title-wr mp">
		<h2 class="section-title" id="ORDER"><span><?=getMessage("BUY")?></span></h2>
	</div>
	<div class="ba">	
		<?$APPLICATION->IncludeComponent(
		"simai:feedback.all.string",
		"feedback",
		Array(
			"IBLOCK_TYPE" => "forms",
			"IBLOCK_ID" => $arParams["IBLOCK_ID_FEEDBACK"],
			"EMAIL" =>  COption::GetOptionString($GLOBALS["moduleName"],"email",""),
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
<div class="col-md-6">
	<div class="section-title-wr mp">
		<h2 class="section-title" id="CONTACTS"><span><?=getMessage("OUR_CONTACTS")?></span></h2>
	</div>
   <?
	if (CModule::IncludeModule("iblock")):
			$arSelect = Array("ID", "NAME");
			            $arFilter = Array("IBLOCK_ID" => $arParams["IBLOCK_ID_FILIAL"],"ACTIVE"=>"Y");
			            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
			            if($ob = $res->GetNextElement())$scale="8";
			else $scale="17";
			$MAP_DATA = "a:4:{s:10:\"yandex_lat\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lat", "").";s:10:\"yandex_lon\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lng", "").";s:12:\"yandex_scale\";i:".$scale.";s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lng", "").";s:3:\"LAT\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lat", "").";s:4:\"TEXT\";s:".count(str_split(COption::GetOptionString($GLOBALS["moduleName"], "address", ""))).":\"".COption::GetOptionString($GLOBALS["moduleName"], "address", "")."\";}}}";
	endif;
			?>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	"points", 
	array(
		"COMPONENT_TEMPLATE" => "points",
		"CONTROLS" => array(
		),
		"IBLOCK_ID" => $arParams["IBLOCK_ID_FILIAL"],
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => $MAP_DATA,
		"MAP_HEIGHT" => "200",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(
		),
		"SHOW_INFO" => "Y"
	),
	false
);?>



<script>
 $("textarea").val("<?=getMessage("ORDER")?> <?=$arBXCSiteSettings["NAME"]?>");
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

