<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
if($countItems<1)return;?>
<?if($arParams["AJAX_PAGE"]!="Y"):?>
<script type="text/javascript">
    $(function(){
        if($(window).scrollTop()+$(window).height()+50>$("footer").offset().top){
            $(".modern-page-next").parent().append('<div class="row"><div class="col-md-12 text-center"><i class="fa fa-spinner"></i></div></div>').end().trigger("click");
        }

    });
    $(window).scroll(function(){
        if($(window).scrollTop()+$(window).height()>$("footer").offset().top)
        {
            $(".modern-page-next").parent().append('<div class="row"><div class="col-md-12 text-center"><i class="fa fa-spinner"></i></div></div>').end().trigger("click").remove();
        }
    });
</script>
    <div id="ulSorList">
<?endif?>

<style>
    .border-gray{
        border: 1px solid gainsboro;
    }
</style>
        <div class="row">
        <?foreach($arResult["ITEMS"] as $cell=>$arElement):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        if($cell && $cell%2==0) echo"</div><div class='row'>";
            ?>
            <div class="col-lg-6 col-md-6 col-sm-6" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                <div class="wp-block inverse">
                    <div class="figure">
				<?if($arElement["PROPERTIES"]["LINK"]["VALUE"]!=""):?>	
                   <a href="<?=$arElement["PROPERTIES"]["LINK"]["VALUE"]?>">
				<?endif;?>
                 <?if(is_array($arElement["PICTURE"])):?>
                     <img class="img-responsive border-gray" src="<?=$arElement["PICTURE"]["src"]?>" alt="<?=$arElement["NAME"]?>">
                <?else:?>
                    <img class="img-responsive border-gray" src="<?=SITE_TEMPLATE_PATH?>/images/no_client.jpg" alt="<?=$arElement["NAME"]?>">
                <?endif?>
				<?if($arElement["PROPERTIES"]["LINK"]["VALUE"]!=""):?>	
				 </a>
				 <?endif?>
                </div>
				<?if($arElement["PROPERTIES"]["LINK"]["VALUE"]!=""):?>	
					<a href="<?=$arElement["PROPERTIES"]["LINK"]["VALUE"]?>">
			    <?endif?>
					<h2><?=$arElement["NAME"]?></h2>
				<?if($arElement["PROPERTIES"]["LINK"]["VALUE"]!=""):?>
					</a>
				<?endif?>
                <?if(isset($arResult["SECTIONS"][$arElement['IBLOCK_SECTION_ID']])):?>
                   <small><?=$arResult["SECTIONS"][$arElement['IBLOCK_SECTION_ID']]?></small>
                <?endif?>
             </div>
             </div>
        <?endforeach?>
        </div>
        <?=$arResult["NAV_STRING"]?>
        <?if($arParams["AJAX_PAGE"]=="Y")exit();?>
</div>



