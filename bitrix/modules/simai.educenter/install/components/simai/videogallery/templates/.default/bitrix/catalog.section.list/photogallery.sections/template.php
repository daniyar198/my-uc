<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult["SECTIONS"])<1)return;
?>

<style>
 .width-video{
	 width:<?=$arParams["IMG_LIST_WIDTH"]?>px;
 }
</style>
<div class="photogallery-list">
<?foreach($arResult["SECTIONS"] as $cell=>$arSection):
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
?>

    <div id="<?=$this->GetEditAreaId($arSection['ID'])?>">
            <h4><a class="link-gallery" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>  <a class="link-gallery float-right" style="font-size:14px;" href="<?=$arSection["SECTION_PAGE_URL"]?>"><i class="fa fa-arrow-circle-right mr-2 c-primary" aria-hidden="true"></i><?=getMessage("SHOW_ALL")?></a></h4>
                <?if($arSection["DESCRIPTION"]):?>
                    <p><a class="link-gallery" class="btn btn-base btn-xs pull-right descr_trigger" href="javascript:void(0);"><?=getMessage("SHOW_HIDE_DESCR")?></a></p>
                <?endif?>
            <?if($arSection["DESCRIPTION"]):?>
               <p style="display: none;"><?=$arSection["DESCRIPTION"]?></p>
            <?endif?>
            <?if(is_array($arSection["SECTIONS"])):
                $arCount=count($arSection["SECTIONS"]);
                $i=1;
            foreach($arSection["SECTIONS"] as $arSect):
              $this->AddEditAction($arSect['ID'], $arSect['EDIT_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_EDIT"));
              $this->AddDeleteAction($arSect['ID'], $arSect['DELETE_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
            ?>
                <div <?/*if($i>3 && $arCount>5):?>style="display: none;"<?endif*/?>class="pl-section"><a class="link-gallery" href="<?=$arSect["SECTION_PAGE_URL"]?>"><?=$arSect["NAME"]?></a></div>
            <?
            $i++;
            endforeach;
            if($i>3 && $arCount>5):
            ?>
                <a class="open_links_id" href="javascript:void(0);"><small>...<br/><?=getMessage("TITLE_ALL_SECTION")?><i class="icon-sort-down"></i></small></a>
            <?
            endif;
            endif?>
        </div>
            <?if(!empty($arSection["ITEMS"])):?>
            <div class="bottom-photogallery bottom-photogallery<?=$cell?>">
			<div class="am-container">
				<div class="row row-photogallery">

               <?foreach($arSection["ITEMS"] as $key => $arItem):
			      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        
			   ?>
				<?=($key && $key%3==0 ? "</div><div class='row row-photogallery'>" : "")?>
				<div class="col-md-4 col-sm-4">			   
                 <div class="">
                   <a title="<?=$arSection["NAME"]?>" class="theater fancybox.iframe" href="http://www.youtube.com/embed/<?=$arItem["PROPERTY_LINK_VALUE"]?>?autoplay=1">
				    <img id="<?=$this->GetEditAreaId($arItem['ID'])?>"
                        src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>"
                        alt="<?=$arItem["NAME"]?>" width="100%" height="100%"
                        style="border: 0px solid black; padding: 0px;"/>
                    </a>
			         <small><?=$arItem["~DATE_ACTIVE_FROM"]?></small>
			         <a title="<?=$arSection["NAME"]?>" class="theater fancybox.iframe" href="http://www.youtube.com/embed/<?=$arItem["PROPERTY_LINK_VALUE"]?>?autoplay=1">
					 <p><?=$arItem["NAME"]?></p>
					</a>
				 </div>
				 </div>
				<?endforeach?>
				
            </div>
			</div>
			</div>
            <?endif?>
			
 <!-- <script type="text/javascript">
            $(".bottom-photogallery<?//=$cell?>").each(function(){
              var positionTop=0;
                $(this).find("img").each(function(){
                    if(positionTop<1)
                    {
                        positionTop=parseInt($(this).position().top);
                    }
                    else if(positionTop+10<parseInt($(this).position().top))
                    {
                        $(this).parent().css("display","none");	
                    }

                });
            });
    </script>-->
			
			
			
   <?endforeach?>
  <!--  <script type="text/javascript">
	 // positionTop=0;
            $(".descr_trigger").on("click", function(){
                $(this).parent().next("p").toggle();
            });
            $(".open_links_id").on("click", function(){
                $(this).prevAll(".pl-section").css("display","block").end().css("display","none");
            });
      
    </script>-->
</div>