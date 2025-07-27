<?
$countItems=count($arResult["ITEMS"]);
if($countItems>0)
{?>
    <div id="ulSorList">
        <div class="row">
        <?foreach($arResult["ITEMS"] as $cell=>$arElement):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        if($cell && $cell%3==0) echo"</div><div class='row'>";
            ?>
            <div class="col-sm-4" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                <div class="wp-block inverse">
                    <div class="figure">
                 <?if(is_array($arElement["PICTURE"])):?>
                     <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img class="img-responsive" src="<?=$arElement["PICTURE"]["src"]?>" alt="<?=$arElement["NAME"]?>"></a>
                <?else:?>
                    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/images/no_client.jpg" alt="<?=$arElement["NAME"]?>"></a>
                <?endif?>
                </div>
                <h4 class=" mt-15"><a class="hover-wrap overlay-portfolio" href="<?=$arElement['DETAIL_PAGE_URL']?>"><?=$arElement["NAME"]?></a></h4>
				<div class="small"><?=TruncateText(strip_tags($arElement['~PREVIEW_TEXT']),80)?></div>							
             </div>
             </div>
        <?endforeach?>
        </div>     
    </div>
<?}?>