<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?if(is_array($arResult["PROPERTIES"]["COMPLEX"]["VALUE"])):?>
	<div style="overflow: auto">
	  <table class="table table-bordered">
		<tbody>
		<?foreach($arResult["PROPERTIES"]["COMPLEX"]["VALUE"] as $complex):?>
		
		<?if($complex["SUB_VALUES"]["FIELD"]["~VALUE"]["TEXT"]=="") continue;?>
		
		<tr>
			<td colspan="1">
			   <b><?=$complex["SUB_VALUES"]["NAME"]["~VALUE"]?></b>
			</td>
			<td colspan="1">
				 <div <?=$complex["SUB_VALUES"]["TAG"]["~VALUE"]?>>
				   <?=$complex["SUB_VALUES"]["FIELD"]["~VALUE"]["TEXT"]?>
				 </div>

			</td>
		</tr>
		<?endforeach;?>
		</tbody>
	   </table>
	</div>
<?endif;?>



<?if(is_array($arResult["PROPERTIES"]["DOCS"]["VALUE"])):?>

	<script>
	$(document).ready(function() {
		$(".f-g").fancybox({
			openEffect	: 'none',
			closeEffect	: 'none'
		});
	});
	</script>

  <div class="doc-list">
    <?foreach($arResult["PROPERTIES"]["DOCS"]["VALUE"] as $key => $complexDoc):?>
	
	 <?if($complexDoc["SUB_VALUES"]["FILE"]["VALUE"] == "") continue;?>
	 
	 <?$arItem = $complexDoc["SUB_VALUES"]["FILE"]["VALUE"];?>
	 
      <div class="row">
        <div class="col-xs-2 col-md-1 text-center">
            <i class="fa fa-<?=$arItem["ICON"]["TYPE"]?> fa-3x" style="color:<?=$arItem["ICON"]["COLOR"]?>"></i>
        </div>
        <div class="col-xs-10 col-md-11">
                <h4 class="section-title no-border-header-doc">
                    <a target="_blank"
                        href="http://docs.google.com/viewer?url=http://<?=SITE_SERVER_NAME?><?=$arItem["DOC_SRC"]?>" 
                        class="link_underline dark">
                            <?=$complexDoc["SUB_VALUES"]["NAME_DOCS"]["VALUE"]?>
                    </a>
                </h4>
                <div class="mt-5 mb-20">
                    <i class="fa fa-download c-base"></i>
                    <a target="_blank" <?=$complexDoc["SUB_VALUES"]["TAG_FILE"]["VALUE"]?> href="<?=$arItem["DOC_SRC"]?>" class="link_underline"> <?=getMessage("DOWNLOAD")?></a> 
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
                </div>   
            <?endif?>    
        </div>
    </div>
	
    <?endforeach?>
  </div>
<?endif;?>