<?
 if(isset($_SESSION["SITE_SETTINGS"]["MAIN"]["HEADER"]))$arResult["style_template"]=$_SESSION["SITE_SETTINGS"]["MAIN"]["HEADER"];
 else{
	 $typeBack=COption::GetOptionString($GLOBALS["moduleName"], "headerMode", "");
		if($typeBack=="N"){
			$style_background=COption::GetOptionString($GLOBALS["moduleName"], "headerpath", "");
			$color_background=COption::GetOptionString($GLOBALS["moduleName"], "headercolorpicker", "");
			if($color_background!="")$color_background='background-color:'. $color_background.';';
			if($style_background!="")
			{
				$bakpos="";
				if(COption::GetOptionString($GLOBALS["moduleName"], "headerlayout", "")=="no-repeat")$bakpos=" background-size:cover;";
					else $bakpos=" background-size:auto;";
				$style_background='background-image: url(\''.$style_background.'\');'.$bakpos.' background-repeat:'.COption::GetOptionString($GLOBALS["moduleName"], "headerlayout", "").';';					  
			}
			$arResult["styleBackground"]='style="'.$style_background.$color_background.'"';	
		}
		elseif($typeBack=="Y")  $arResult["style_template"].=" ".COption::GetOptionString($GLOBALS["moduleName"], "header", ""); 
 }
?>
