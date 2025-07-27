<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult["ITEMS"])<1)return;
?>
<script>
$(function(){
    $(".accordion-block li div.sp-name").parent().css("display","none");
	$(".vacancy-list .plan-header a").on("click",function(){
        var element=$(this).toggleClass("active").parents(".plan-header").next("ul").find(".sp-name").parent();
        if(element.length > 0)
        {
            element.toggle();
            /*if(element.css("display") == "none")
            {
                $(this).text("<?=getMessage("MORE_INFO")?>");
            }
            else
            {
                $(this).text("<?=getMessage("HIDE_BLOCKS")?>");
            }*/
        }
	});
});
</script>
<div class="vacancy-list">
    <?foreach($arResult["ITEMS"] as $key=>$arItem):
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div id="<?=$this->GetEditAreaId($arItem['ID'])?>" class="row mb-20">
		<div class="col-sm-9">
			<h3 class=""><?=$arItem["NAME"]?></h3>
			<?if (is_array($arItem["DISPLAY_PROPERTIES"]["SPECIALITY_DEMAND"])) :?>
				<h5><?=$arItem["DISPLAY_PROPERTIES"]["SPECIALITY_DEMAND"]["NAME"]?></h5>
				<p><?=$arItem["DISPLAY_PROPERTIES"]["SPECIALITY_DEMAND"]["DISPLAY_VALUE"]?></p>
			<?endif;?>

			<?if (is_array($arItem["DISPLAY_PROPERTIES"]["SPECIALITY_REQUEST"])) :?>
				<h5><?=$arItem["DISPLAY_PROPERTIES"]["SPECIALITY_REQUEST"]["NAME"]?></h5>
				<p><?echo $arItem["DISPLAY_PROPERTIES"]["SPECIALITY_REQUEST"]["DISPLAY_VALUE"]?></p>
			<?endif;?>

			<?if (is_array($arItem["DISPLAY_PROPERTIES"]["RESPONSIBILITY"])) :?>
				<h5><?=$arItem["DISPLAY_PROPERTIES"]["RESPONSIBILITY"]["NAME"]?></h5>
				<p><?echo $arItem["DISPLAY_PROPERTIES"]["RESPONSIBILITY"]["DISPLAY_VALUE"]?></p>
			<?endif;?>
			<?if (is_array($arItem["DISPLAY_PROPERTIES"]["CONDITIONS"])) :?>
				<h5><?=$arItem["DISPLAY_PROPERTIES"]["CONDITIONS"]["NAME"]?></h5>
				<p><?echo $arItem["DISPLAY_PROPERTIES"]["CONDITIONS"]["DISPLAY_VALUE"]?></p>
			<?endif;?>
			<?if($arItem["PREVIEW_TEXT"]):?>
				<p><?=$arItem["PREVIEW_TEXT"]?></p>
			<?endif?>
		</div>	
		<div class="col-sm-3 text-right">
			<p><a href="./add/" class="btn btn-base"><?=getMessage("VACANCY_ADD")?></a>
		</div>
	</div>
	<hr class="mb-20">
    <?endforeach;?>
</div>