<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);

if($countItems<1)return;?>

		<div class="mb-20">
			<a href="./ask.php" class="btn btn-base not-accent"><?=getMessage("ASK")?></a>
		</div>
        <div class="row">
		 
        <?foreach($arResult["ITEMS"] as $cell=>$arElement):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        if($cell && $cell%2==0) echo"</div><div class='row'>";
            ?>
            <div id="<?=$this->GetEditAreaId($arElement['ID']);?>" class="col-md-12">
            <div class="wp-block property grid">
                <div class="wp-block-body">
                <div class="wp-block-content clearfix" style="padding-top: 0;">
                    <?if(is_array($arElement["DISPLAY_PROPERTIES"]["TITLE"])):?>
                        <h6><?=$arElement["DISPLAY_PROPERTIES"]["TITLE"]["VALUE"]?></h6>
                    <?endif?>
                    <p><a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="not-accent fix-66"><?=$arElement['NAME']?></a></p>
                </div>
                </div>
                <div class="wp-block-footer">
                    <ul class="aux-info">
                        <?if($arElement["DATE_ACTIVE_FROM"]):?>
                            <li class="pull-left"><i class="fa fa-calendar"></i> <?=$arElement["DATE_ACTIVE_FROM"]?></li>
                        <?endif?>
                        <?if(isset($arResult["SECTIONS"][$arElement['IBLOCK_SECTION_ID']])):?>
                            <li class="pull-left"><a href="<?=$arResult["SECTIONS"][$arElement['IBLOCK_SECTION_ID']]["SECTION_PAGE_URL"]?>" class="not-accent fix-66"><?=$arResult["SECTIONS"][$arElement['IBLOCK_SECTION_ID']]["NAME"]?></a></li>
                        <?endif?>
                        <li class="pull-right"><a class="btn btn-base not-accent" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=getMessage("MORE_INFO")?></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
             </div>
             </div>
        <?endforeach?>
        </div>
        <?=$arResult["NAV_STRING"]?>
