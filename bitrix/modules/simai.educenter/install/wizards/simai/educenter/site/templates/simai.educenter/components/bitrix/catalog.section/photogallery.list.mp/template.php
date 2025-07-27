<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
if($countItems<1)return;?>
<div class="am-container">
    <div class="row row-photogallery">
        <?
       foreach($arResult["ITEMS"] as $cell=>$arElement):
        if(is_array($arElement["PICTURE"])):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
              <div id="<?=$this->GetEditAreaId($arElement['ID'])?>" class="col-md-4 col-sm-6 col-xs-6"><a rel="group" class="theater" title="<?=$arResult["NAME"]?>" href="<?=$arElement["PICTURE"]["old_src"]?>"><img class="img-responsive" src="<?=$arElement["PICTURE"]["SRC"]?>" width="<?=$arElement["PICTURE"]["WIDTH"]?>" height="<?=$arElement["PICTURE"]["HEIGHT"]?>" alt="<?=$arParams["SHOW_PHOTO_TITLE"]=="N"?"":$arElement["NAME"]?>"></a></div>
        <?endif?>
        <?endforeach?>
		<?//=$arResult["NAV_STRING"]?>
    </div>
</div>
