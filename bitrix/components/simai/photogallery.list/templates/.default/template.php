<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
if($countItems>0)
{
?>
<div class="am-container">
    <div class="row row-photogallery">
        <div class="col-md-12">
        <?
        foreach($arResult["ITEMS"] as $cell=>$arElement):
        if(is_array($arElement["PICTURE"])):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
              <a rel="group"  class="theater" title="<?=($arParams["SHOW_PHOTO_TITLE"]=="N"?$arResult["NAME"]:$arElement["NAME"])?>" href="<?=$arElement["PICTURE"]["old_src"]?>"><img id="<?=$this->GetEditAreaId($arElement['ID'])?>" src="<?=$arElement["PICTURE"]["SRC"]?>" width="<?=$arElement["PICTURE"]["WIDTH"]?>" height="<?=$arElement["PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>"></a>
        <?endif?>
        <?endforeach?>
        </div>
        <div class="clearfix"></div>
		<?=$arResult["NAV_STRING"]?>
    </div>
</div>
<?
}
?>
