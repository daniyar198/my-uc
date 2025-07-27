<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?
if(count($arResult["SECTIONS"])>0)
{
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>
<div class="catalog-section-list">
    <div class="row nomargin">
<?
foreach($arResult["SECTIONS"] as $cell=>$arSection):
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    if($cell && $cell%2==0)echo"</div><div class=\"row nomargin\">";
?>

        <div  id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" class="col-md-6">
            <div class="wp-block product">
                <figure>
                    <?if(is_array($arSection["PREVIEW_IMG"])):?>
                        <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img class="img-responsive" src="<?=$arSection["PREVIEW_IMG"]["SRC"]?>" alt="<?=$arSection["NAME"]?>"></a>
                    <?else:?>
                        <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/images/no_photo.png" alt="<?=$arSection["NAME"]?>"></a>
                    <?endif;?>
                </figure>
                <h5><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?echo truncateText($arSection["NAME"],75)?></a></h5>
            </div>
        </div>
<?endforeach?>
    </div>
</div>
<?
}
?>