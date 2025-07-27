<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
/*echo "<pre>";
print_r($arResult["ITEMS"]);
echo "</pre>";*/
if($countItems<1 && !$arResult["DESCRIPTION"])return;?>
<?if($arResult["DESCRIPTION"]):?>
<p><?=$arResult["DESCRIPTION"]?></p>
<?endif?>
<?/*
echo '<pre>';
print_r($arResult["ITEMS"]);
echo '</pre>';*/

?>

<script>
$(document).ready(function() {
	$(".f-g").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>
    <div class="doc-list">
    <?foreach($arResult["ITEMS"] as $cell=>$arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], 
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], 
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), 
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
    <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="row">
        
        <div class="col-xs-2 col-md-1  text-center">
        <?if($arItem['PROPERTIES']['LINKS_FILE']['VALUE']):?>
            <i class="fa fa-file fa-3x" style="color:#607D8B"></i>
        <?else:?>
            <i class="fa fa-<?=$arItem["ICON"]["TYPE"]?> fa-3x" style="color:<?=$arItem["ICON"]["COLOR"]?>"></i>
        <?endif?>
        </div>
        <div class="col-xs-10 col-md-11">
            <?if($arItem['PROPERTIES']['LINKS_FILE']['VALUE']):?>
                <h4 class="section-title no-border-header-doc">
                    <a target="_blank"
                        href="<?=$arItem['PROPERTIES']['LINKS_FILE']['VALUE']?>" 
                        class="link_underline dark">
                            <?=$arItem["NAME"]?>
                    </a>
                </h4>
                <p><?=$arItem["~PREVIEW_TEXT"]?></p>
                <div class="mt-5 mb-20">
                    
                    <?if(SITE_SERVER_NAME):?> 
                        <i class="fa fa-external-link c-base" aria-hidden="true"></i>
                        <a  target="_blank" class="various download-link link_underline" 
                        href="<?=$arItem['PROPERTIES']['LINKS_FILE']['VALUE']?>"><?=getMessage("VIEW")?></a>
                    <?endif?>
                </div>
            <?else:?>
                <h4 class="section-title no-border-header-doc">
                    <a target="_blank"
                        href="http://docs.google.com/viewer?url=http://<?=SITE_SERVER_NAME?>
                        <?= $arItem["DOC_SRC"]?>" 
                        class="link_underline dark">
                            <?=$arItem["NAME"]?>
                    </a>
                </h4>
                <p><?=$arItem["~PREVIEW_TEXT"]?></p>
                
                <div class="mt-5 mb-20">
                    <i class="fa fa-download c-base"></i>
                    <a target="_blank" href="<?=$arItem["DOC_SRC"]?>" class="link_underline"> <?=getMessage("DOWNLOAD")?></a> 
                    <?if($arItem["DOC_SIZE"]):?>
                        (<?=getMessage("SIZE")?> <?=$arItem["DOC_SIZE"]?> Kb)&nbsp;
                    <?endif?>
                    <?if(SITE_SERVER_NAME):?> 
                        <i class="fa fa-external-link c-base" aria-hidden="true"></i>
                        <?$typeFile = $arItem["TYPE"];?>
                        <?if(($typeFile == "jpg") || ($typeFile == 'jpeg') || ($typeFile == 'bmp') || ($typeFile == 'png') || ($typeFile == 'gif')):?>
                            <a class="f-g" rel="group" href="<?=$arItem["DOC_SRC"]?>">
                                <img src="<?=$arItem["DOC_SRC"]?>" style="display: none"/>
                                <?=getMessage("VIEW")?>
                            </a>
                        <?else:?>
                            <a target="_blank" 
                                class="various download-link link_underline" 
                                href="http://docs.google.com/viewer?url=http://<?=SITE_SERVER_NAME?><?=$arItem["DOC_SRC"]?>">
                                    <?=getMessage("VIEW")?>
                            </a>
                        <?endif?>
                    <?endif?>
                </div>   
            <?endif?>    
        </div>
    </div>
    <?endforeach?>
</div>
<?=$arResult["NAV_STRING"]?>