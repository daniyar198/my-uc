<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult["SECTIONS"])<1)return;
?>
<div class="photogallery-list">
<?foreach($arResult["SECTIONS"] as $cell=>$arSection):
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
?>

    <div class="row" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
        <div class="col-md-12">
            <h4><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></h4>
            <?if($arResult["DESCRIPTION"]):?><p><?=$arResult["DESCRIPTION"]?></p><?endif?>
            <?if(is_array($arSection["SECTIONS"])):
            $arCount=count($arSection["SECTIONS"]);
            foreach($arSection["SECTIONS"] as $arSect):
            $this->AddEditAction($arSect['ID'], $arSect['EDIT_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_EDIT"));
            $this->AddDeleteAction($arSect['ID'], $arSect['DELETE_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="pl-section"><a href="<?=$arSect["SECTION_PAGE_URL"]?>"><?=$arSect["NAME"]?></a></div>
            <?
            endforeach;
            endif?>
        </div>
        </div>
            <div class="row bottom-photogallery">
               <?foreach($arSection["ITEMS"] as $key=>$arItem):
                   if($key && $key%6==0) echo "<div><div class='row bottom-photogallery'>";
                   ?>
                   <?if($arItem["TYPE"]=="img"):?>
                   <div class="col-xs-2"><a title="<?=$arSection["NAME"]?>" class="theater" rel="group<?=$cell?>" href="<?=$arItem["PREVIEW_IMG"]["REAL_FILE_SRC"]?>"><img class="img-responsive" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>" alt="<?=$arElement["NAME"]?>"/></a></div>
                   <?else:?>
                   <div class="col-xs-2"><a target="_blank" href="<?=$arItem["DOC_SRC"]?>"><i class="fa fa-<?=$arItem["ICON"]?>"></i></a></div>
                   <?endif;?>
               <?endforeach?>
            </div>
   <?endforeach?>
</div>