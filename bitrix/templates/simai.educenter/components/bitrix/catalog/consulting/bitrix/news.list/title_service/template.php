<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
   <section id="slider-wrapper" class="layer-slider-wrapper layer-slider-dynamic hidden-sm">
         <div id="layerslider_seminar" style="width:100%;height:440px;">
		 <div class="mask bg-dark-60 ls"></div>
          <!-- Slide 1 -->
          <div class="ls-slide" data-ls="transition2d:1;timeshift:-1000;">
        <?foreach($arResult["ITEMS"] as $cell=>$arElement):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
       ?> 
	       
            <!-- slide background -->
           <img class="ls-bg" src="<?=$arElement["PICTURE"]["src"]?>" alt=""/> 
		     
             <h3 class="ls-l title-lg c-white text-uppercase text-center light-font" style="width:100%; top:22%; left:50%;" data-ls="offsetxin:0; offsetyin:250; durationin:1000; delayin:500; offsetxout:0; offsetyout:-8; easingout:easeInOutQuart; scalexout:1.2; scaleyout:1.2;">
                <?=$arElement["NAME"]?>
             </h3> 
     
   <?endforeach?>
 <h3 class="ls-l title-xs c-white text-uppercase text-center strong" style="width:100%; top:86%; left:50%;" data-ls="offsetxin:0; offsetyin:250; durationin:1000; delayin:2000; offsetxout:0; offsetyout:-8; easingout:easeInOutQuart; scalexout:1.2; scaleyout:1.2;">
                 <a class="btn btn-lg btn-b-light scroll_link" href="#ORDER"><?=GetMessage("ORDER")?></a>
             </h3>
    </div>
     </div>
    </section>
