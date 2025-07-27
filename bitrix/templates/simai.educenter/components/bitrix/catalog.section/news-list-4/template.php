<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="row" >
<?
foreach($arResult["ITEMS"] as $key=>$arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    if($key && $key%3==0) echo"</div><div class='row'>";
	if(isset($arParams["SEF_FOLDER"]))
		$arItem["DETAIL_PAGE_URL"]=str_replace(SITE_DIR."news/",$arParams["SEF_FOLDER"],$arItem["DETAIL_PAGE_URL"]);
    ?>
		<div class="col-md-4 col-sm-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="wp-block article grid">
				<div class="article-image">
					<?if(is_array($arItem["PREVIEW_IMG"])):?>
							 <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img alt="<?=$arItem["~NAME"]?>" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>" class="img-responsive"></a>
					<?else:?>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/images/no_photo.png" alt="<?=$arItem["~NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
					<?endif?>
				</div>

                    <?if($arItem["DISPLAY_ACTIVE_FROM"]):?>
                        <small><?=$arItem["DISPLAY_ACTIVE_FROM"]?></small>
                    <?endif?>
					<h3 class="title">
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" hidefocus="true"><?echo truncateText($arItem["~NAME"],75)?></a>
					</h3>
					<p>
                        <?$arNum=mb_strlen($arItem["~NAME"]);
                        if($arNum>75)$arNum=75;
                        $length=(250-intval($arNum*1.2));
                        ?>
					<?if($arItem["PREVIEW_TEXT"]):?>
						<?=truncateText(strip_tags($arItem["~PREVIEW_TEXT"]),$length)?></a>
					<?else:?>
						<?=truncateText(strip_tags($arItem["~DETAIL_TEXT"]),$length)?>
					<?endif;?>
					</p>

			</div>
		</div>
<?
endforeach;?>
</div>