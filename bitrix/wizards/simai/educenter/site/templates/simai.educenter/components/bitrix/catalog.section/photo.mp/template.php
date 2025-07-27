<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<script>
$(document).ready(function() {
	$(".theater").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>
    <div class="row">
	<?$count=0;
	foreach($arResult["ITEMS"] as $cell=>$arElement):
		if(is_array($arElement["PREVIEW_IMG"])):
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
      <div class="col-md-2 col-xs-4 mb-20">
          <a class="theater" rel="gallery1" title="" href="<?=$arElement["PREVIEW_IMG"]["OLD_SRC"]?>"><img id="<?=$this->GetEditAreaId($arElement['ID'])?>" src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" alt="<?=$arParams["SHOW_PHOTO_TITLE"]=="N"?"":$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" height="<?=$arElement["PREVIEW_IMG"]["HEIGHT"]?>" width="<?=$arElement["PREVIEW_IMG"]["WIDTH"]?>"></a>
       </div>
	   <?$count++;if($count&&$count%6==0):?></div><div class="row"><?endif;?>
     <?
		endif;
	 endforeach?>
    </div>

	

