<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?if(!empty($arResult["SECTIONS"])):?>


 <?
 $prevCode = 0;
 $prevDepth = $arResult["SECTIONS"][0]["DEPTH_LEVEL"];
 foreach($arResult["SECTIONS"] as $code => $arSection):
  
   if($prevDepth < $arSection["DEPTH_LEVEL"])
	   $arResult["SECTIONS"][$prevCode]["IS_PARENT"] = "Y";
   
   $prevCode = $code;
   $prevDepth = $arSection["DEPTH_LEVEL"];

 endforeach;?>
 
 <ul class="simple-tree" style="width:100%">
 <?$count =1;?>
 <?foreach($arResult["SECTIONS"] as $code => $arSection):
 
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
 ?>
 
   <?if($prevDepthLevel == $arSection["DEPTH_LEVEL"]):?>
    </li>
   <?elseif($prevDepthLevel > $arSection["DEPTH_LEVEL"]):?>
     <?=str_repeat("</ul></li>", $prevDepthLevel - $arSection["DEPTH_LEVEL"])?>
   <?endif;?>
    
	<li id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="d-flex align-items-center justify-content-between flex-wrap pt-5 pb-5" style="position:relative">
	  <?if($arSection["IS_PARENT"] == "Y"):?>
	  
	    <input type="checkbox" checked="checked" id="tree-item-<?=$count?>"/>
        <label for="tree-item-<?=$count?>" style="width:100%"><a itemprop="Name" class="t-1 l-black  pr-10" style="flex:1;" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></label>
		<div class="hide-show hidden">
			<a href="#" class="hide-show-btn hide t--1"><?=getMessage("HIDE")?></a>
			<a href="#" class="hide-show-btn show t--1"><?=getMessage("SHOW")?></a>
		<div class="hide-show-block pl-3">
		
		<?if($arSection["UF_FIO"]!=""):?>
		  <p><?=getMessage("HEAD")?>: <span itemprop="Fio"><?=$arSection["~UF_FIO"]?></span></p>
		<?endif;?>
		
		<?if($arSection["UF_ADDRESS"]!=""):?>
		   <p><?=getMessage("PLACE")?>: <span itemprop="AddressStr"><?=$arSection["~UF_ADDRESS"]?></span></p>
		<?endif;?>
		
		<?if($arSection["UF_SITE"]!=""):?>
		   <p><a target="_blank" href="<?=$arSection["~UF_SITE"]?>" itemprop="Site"><?=$arSection["~UF_SITE"]?></a></p>
		<?endif?>
		
		<?if($arSection["UF_EMAIL"]!=""):?>
		   <p><a target="_blank" href="mailto: <?=$arSection["~UF_EMAIL"]?>" itemprop="E-mail"><?=$arSection["~UF_EMAIL"]?></a></p>
	    <?endif?>
		
		<?if($arSection["UF_DIVISION"]!=""):?>
		   <p><i class="fa fa-check"></i> <a target="_blank" href="<?=CFile::GetPath($arSection["~UF_DIVISION"])?>" itemprop="DivisionClause_DocLink"><?=getMessage("FOUNDATION")?></a></p>
		<?endif?>
		 </div>
		 </div>
	
        <ul style="width:100%">
	  <?$count = $count+1;?>
	  <?else:?>
			<div class="d-flex align-items-center justify-content-between flex-wrap" style="width:100%">
	     <a itemprop="Name" class="t-1 l-black pr-10" style="flex:1;" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
			 <?$index = 0;?>
			 <?if($arSection["UF_FIO"]!=""):?>
			 	<?$index++;?>
			 <?endif?>
			 <?if($arSection["UF_ADDRESS"]!=""):?>
			 	<?$index++;?>
			 <?endif?>
			 <?if($arSection["UF_SITE"]!=""):?>
			 <?$index++;?>			 
			 <?endif?>
			 <?if($arSection["UF_EMAIL"]!=""):?>
			 <?$index++;?>			 
			 <?endif?>
			 <?if($arSection["UF_DIVISION"]!=""):?>
			 <?$index++;?>			 
			 <?endif?>
			 <?if($index != 0):?>		 
		 		<span data-toggle="collapse" data-target="#more<?=$code?>" class="c-base cursor-pointer right mt-10 mb-10 btn btn-base"><?=getMessage("SHOW")?></span>
			 <?endif?>
 			</div>
		 <div id="more<?=$code?>" class="collapse p-20" style="background-color: rgba(0,0,0,0.05);width:100%;">
         <?if($arSection["UF_FIO"]!=""):?>
			  <p><?=getMessage("HEAD")?>: <span itemprop="Fio"><?=$arSection["~UF_FIO"]?></span></p>
			<?endif;?>
			
			<?if($arSection["UF_ADDRESS"]!=""):?>
			   <p><?=getMessage("PLACE")?>: <span itemprop="AddressStr"><?=$arSection["~UF_ADDRESS"]?></span></p>
			<?endif;?>
			
			<?if($arSection["UF_SITE"]!=""):?>
			   <p><a target="_blank" href="<?=$arSection["~UF_SITE"]?>" itemprop="Site"><?=$arSection["~UF_SITE"]?></a></p>
			<?endif?>
			
			<?if($arSection["UF_EMAIL"]!=""):?>
			   <p><a target="_blank" href="mailto: <?=$arSection["~UF_EMAIL"]?>" itemprop="E-mail"><?=$arSection["~UF_EMAIL"]?></a></p>
			<?endif?>
			
			<?if($arSection["UF_DIVISION"]!=""):?>
			   <p><i class="fa fa-check"></i> <a target="_blank" href="<?=CFile::GetPath($arSection["~UF_DIVISION"])?>" itemprop="DivisionClause_DocLink"><?=getMessage("FOUNDATION")?></a></p>
			<?endif?>
		 </div>

      <?endif;?>
	  
	 <?
	  $prevDepthLevel = $arSection["DEPTH_LEVEL"];
	 ?>
 
 <?endforeach;?>

 <?if($prevDepthLevel == $arResult["SECTIONS"][0]["DEPTH_LEVEL"]):?>
   </li>
 <?else:?>
   <?=str_repeat("</ul></li>", $prevDepthLevel - $arResult["SECTIONS"][0]["DEPTH_LEVEL"])?>
 <?endif;?>
 </ul>
<?endif?>




