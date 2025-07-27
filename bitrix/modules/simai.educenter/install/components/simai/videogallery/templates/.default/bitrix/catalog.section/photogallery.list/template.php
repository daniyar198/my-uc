<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
if($countItems>0)
{
?>
<style>
 .width-video{
	 width:<?=$arParams["IMG_LIST_WIDTH"]?>px;
 }
</style>

    <div class="row row-photogallery">
        <?
        foreach($arResult["ITEMS"] as $cell=>$arElement):
        if(is_array($arElement["PREVIEW_PICTURE"])):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		    <?=($cell && $cell%3==0 ? "</div><div class='row row-photogallery'>" : "")?>
			<div class="col-md-4 col-sm-4">
			<div class="">
              <a  
			  class="theater  fancybox.iframe" 
			  title="<?=($arParams["SHOW_PHOTO_TITLE"]=="N"?$arResult["NAME"]:$arElement["NAME"])?>" 
			  href="http://www.youtube.com/embed/<?=$arElement["PROPERTIES"]["LINK"]["VALUE"]?>?autoplay=1">
			  <img id="<?=$this->GetEditAreaId($arElement['ID'])?>" 
			  src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" 
			  width="100%<?//=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" 
			  height="100%<?//=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" 
			  alt="<?=$arElement["NAME"]?>" style="border: 0px solid black"></a>
			  <small><?=$arElement["~ACTIVE_FROM"]?></small>
			  <a  
			  class="theater  fancybox.iframe" 
			  title="<?=($arParams["SHOW_PHOTO_TITLE"]=="N"?$arResult["NAME"]:$arElement["NAME"])?>" 
			  href="http://www.youtube.com/embed/<?=$arElement["PROPERTIES"]["LINK"]["VALUE"]?>?autoplay=1">
			  <p><?=$arElement["NAME"]?></p></a>
			  </a>
			</div>
			</div>


	   <?endif?>
        <?endforeach?>
        </div>
        <div class="clearfix"></div>
		<?=$arResult["NAV_STRING"]?>


<?
}
?>
