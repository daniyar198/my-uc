<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

 
 if(is_array($arResult["PROPERTIES"]["DOCS"]["VALUE"])):
 
   foreach($arResult["PROPERTIES"]["DOCS"]["VALUE"] as $key => $complexDoc):
   
     if($complexDoc["SUB_VALUES"]["FILE"]["VALUE"] == "") continue;
		 
	 $arFile = CFile::GetFileArray($complexDoc["SUB_VALUES"]["FILE"]["VALUE"]);
	 $info=substr($arFile["SRC"], strrpos($arFile["SRC"], '.') + 1);
	 $arItem = array();
     $arItem["TYPE"]=$info;
     $doc=array("pdf"=>array("icon"=>"pdf","color"=>"#FF9800"),"doc"=>array("icon"=>"word","color"=>"#3F51B5"),"docx"=>array("icon"=>"word","color"=>"#3F51B5"),"rtf"=>array("icon"=>"word","color"=>"#3F51B5"),"xls"=>array("icon"=>"excel","color"=>"#4CAF50"),"xml"=>array("icon"=>"excel","color"=>"#4CAF50"),"jpg" => array("icon"=>"image","color"=>"#E91E63"),"jpeg" => array("icon"=>"image","color"=>"#E91E63"),"png" => array("icon"=>"image","color"=>"#E91E63"),"bmp" => array("icon"=>"image","color"=>"#E91E63"),"gif" => array("icon"=>"image","color"=>"#E91E63"),"zip" => array("icon"=>"archive","color"=>"#3F51B5"),"rar" => array("icon"=>"archive","color"=>"#3F51B5"));
     
	 $arItem["ICON"]["TYPE"]="file";
	 $arItem["ICON"]["COLOR"]="#607D8B";
	 
	 if($info!=""){
		 if(array_key_exists($info,$doc)){
			   $arItem["ICON"]["TYPE"]="file-".$doc[$info]["icon"]."-o";
			   $arItem["ICON"]["COLOR"] = $doc[$info]["color"];
		 }
	 }
 
     $arItem["DOC_SRC"]=$arFile["SRC"];
     $arItem["DOC_SIZE"]=number_format(intVal($arFile["FILE_SIZE"])/1000, 0, '.', '');

	 
     $arResult["PROPERTIES"]["DOCS"]["VALUE"][$key]["SUB_VALUES"]["FILE"]["VALUE"] = $arItem;
   endforeach;

 endif;
 
?>