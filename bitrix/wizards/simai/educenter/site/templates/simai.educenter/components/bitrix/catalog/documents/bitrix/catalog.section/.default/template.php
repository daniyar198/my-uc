<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
if($countItems<1 && !$arResult["DESCRIPTION"])return;?>
<?if($arResult["DESCRIPTION"]):?>
<p><?=$arResult["DESCRIPTION"]?></p>
<?endif?>
    <div class="row doc-list">
    <?foreach($arResult["ITEMS"] as $cell=>$arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        if($cell && $cell%4==0) echo "<div><div class='row bottom-photogallery'>";
    ?>
    <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="col-xs-3 text-center">
    <?if($arItem["TYPE"]=="img"):?>
        <a title="<?=$arSection["NAME"]?>" class="theater" rel="group<?=$cell?>" href="<?=$arItem["PREVIEW_IMG"]["REAL_FILE_SRC"]?>"><img class="img-responsive" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>" alt="<?=$arElement["NAME"]?>"/>
        </a>
        <hr/>
        <a target="_blank" href="<?=$arItem["PREVIEW_IMG"]["REAL_FILE_SRC"]?>"><?=getMessage("DOWNLOAD")?> <i class="fa fa-download"></i></a>
    <?else:?>
        <a class="main-icon" target="_blank" href="<?=$arItem["DOC_SRC"]?>"><i class="fa fa-<?=$arItem["ICON"]?>"></i></a>
        <hr/>
        <a target="_blank" href="<?=$arItem["DOC_SRC"]?>"><?=$arItem["NAME"]?></a><br/>
        <a target="_blank" href="<?=$arItem["DOC_SRC"]?>"><?=getMessage("DOWNLOAD")?> <i class="fa fa-download"></i></a>
    <?endif;?>
    </div>
    <?endforeach?>
</div>
<?=$arResult["NAV_STRING"]?>