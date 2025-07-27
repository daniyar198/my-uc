<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);

if($countItems<1)return;?>
<div class="link-underline">	 
	<?foreach($arResult["ITEMS"] as $cell=>$arElement):
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<div id="<?=$this->GetEditAreaId($arElement['ID']);?>" class="mt-15">
		   <p><?=$arElement['NAME']?></p>
		   <a class="" data-toggle="collapse" data-target="#text<?=$arElement['ID']?>" href="#"><?=getMessage("MORE_INFO")?></a>
		   <div id="text<?=$arElement['ID']?>" class="collapse"><div class=" mt-10 p-10 light-gray"><?=$arElement["PREVIEW_TEXT"]?></div></div>
		 </div>
	<?endforeach?>
 </div>
	  <?=$arResult["NAV_STRING"]?>
    