<?
 if(isset($_SESSION["SITE_SETTINGS"]["MAIN"]["FOOTER"]))$arResult["style_template"]=$_SESSION["SITE_SETTINGS"]["MAIN"]["FOOTER"];
 else{
	 $typeBack=COption::GetOptionString($GLOBALS["moduleName"], "footerMode", "");
		if($typeBack==""){
			$style_background=COption::GetOptionString($GLOBALS["moduleName"], "footerpath", "");
			$color_background=COption::GetOptionString($GLOBALS["moduleName"], "footercolorpicker", "");
			if($color_background!="")$color_background='background-color:'. $color_background.';';
			if($style_background!="")
			{
				$bakpos="";
				if(COption::GetOptionString($GLOBALS["moduleName"], "footerlayout", "")=="no-repeat")$bakpos=" background-size:cover;";
					else $bakpos=" background-size:auto;";
				$style_background='background-image: url(\''.$style_background.'\');'.$bakpos.' background-repeat:'.COption::GetOptionString($GLOBALS["moduleName"], "footerlayout", "").';';					  
			}
			$arResult["styleBackground"]='style="'.$style_background.$color_background.'"';	
		}
		else  $arResult["style_template"].=" ".COption::GetOptionString($GLOBALS["moduleName"], "footer", ""); 
 }
?>
