<?
require_once "main.php";
class SIMAITemplate
  {  
  
  

	
	
    static function SetColumn($left,$right,$navbar)
	{
		$GLOBALS["show_left_column"] = ($left == "Y" ? true : false);

		// Show Right Column
		$GLOBALS["show_right_column"] = ($right == "Y" ? true : false);

		// Don't Show NavBar
		$GLOBALS["dont_show_navbar"] = ($navbar ? true : false);
		$GLOBALS["right_column_width"] = COption::GetOptionString($GLOBALS["moduleName"], "right_column", "4");
		$GLOBALS["left_column_width"] = COption::GetOptionString($GLOBALS["moduleName"], "left_column", "4");
		$GLOBALS["main_column_width"] = 12;
        if($GLOBALS["show_left_column"]) 
	    $GLOBALS["main_column_width"] = $GLOBALS["main_column_width"] - $GLOBALS["left_column_width"];
        if($GLOBALS["show_right_column"]) 
	    $GLOBALS["main_column_width"] = $GLOBALS["main_column_width"] - $GLOBALS["right_column_width"];
		
	}
	
	  static function GetStyle()
	  {
		 self::check($GLOBALS["moduleName"]);
		 
		 $typeBack=COption::GetOptionString($GLOBALS["moduleName"], "backgroundMode", "");
		 $GLOBALS["style_template"]="class=\"";
		 if($GLOBALS["demo"])
		 {
		   if($_SESSION["SITE_SETTINGS"]["MAIN"]["BOXED"]==1) $GLOBALS["body_width"]="body-boxed";
		    else $GLOBALS["body_width"]="";
			if($typeBack!="")
			  $GLOBALS["style_template"].="background-fixed ".$_SESSION["SITE_SETTINGS"]["MAIN"]["BACKGROUND"]; 
		 }
		 else {
			if(COption::GetOptionString($GLOBALS["moduleName"], "boxed", "")==1)$GLOBALS["body_width"]="body-boxed";
		    else $GLOBALS["body_width"]="";
			if($typeBack!="")
			  $GLOBALS["style_template"].="background-fixed ".COption::GetOptionString($GLOBALS["moduleName"], "background", ""); 
		 }
		   
		
		 
        
		
		if($_SESSION["SITE_SETTINGS"]["MAIN"]["SPECIAL"]=="on")
		 {
			 $GLOBALS["style_template"]="class=\"special-aaVersion-on ";
			 if(isset($_SESSION["SITE_SETTINGS"]["MAIN"]["special-color"]))  $GLOBALS["style_template"] = $GLOBALS["style_template"]."special-color-".$_SESSION["SITE_SETTINGS"]["MAIN"]["special-color"]." ";
			 if(isset($_SESSION["SITE_SETTINGS"]["MAIN"]["special-font"]))  $GLOBALS["style_template"] = $GLOBALS["style_template"]."special-font-".$_SESSION["SITE_SETTINGS"]["MAIN"]["special-font"]." ";
 			 if(isset($_SESSION["SITE_SETTINGS"]["MAIN"]["special-image"]))  $GLOBALS["style_template"] = $GLOBALS["style_template"]."special-image-".$_SESSION["SITE_SETTINGS"]["MAIN"]["special-image"]." ";
 			 if(isset($_SESSION["SITE_SETTINGS"]["MAIN"]["special-kerning"]))  $GLOBALS["style_template"] = $GLOBALS["style_template"]."special-kerning-".$_SESSION["SITE_SETTINGS"]["MAIN"]["special-kerning"]." ";
		     if(isset($_SESSION["SITE_SETTINGS"]["MAIN"]["special-fonttype"]))  $GLOBALS["style_template"] = $GLOBALS["style_template"]."special-fonttype-".$_SESSION["SITE_SETTINGS"]["MAIN"]["special-fonttype"]." ";
 			
		 }
		 $GLOBALS["style_template"]=$GLOBALS["style_template"]."\"";
		 
		 if($typeBack==""){
			 if(COption::GetOptionString($GLOBALS["moduleName"], "background", "")==$_SESSION["SITE_SETTINGS"]["MAIN"]["BACKGROUND"])
			 {
			  $style_background=COption::GetOptionString($GLOBALS["moduleName"], "path", "");
			  $color_background=COption::GetOptionString($GLOBALS["moduleName"], "backcolorpicker", "");
			  if($color_background!="")$color_background='background-color:'. $color_background.';';

			 if($style_background!="")
				{
					 $bakpos="";
					 if(COption::GetOptionString($GLOBALS["moduleName"], "layout", "")=="no-repeat")$bakpos=" background-attachment:fixed; background-size:cover;";
						  else $bakpos=" background-size:auto;";
                     $style_background='background-image: url(\''.$style_background.'\');'.$bakpos.' background-repeat:'.COption::GetOptionString($GLOBALS["moduleName"], "layout", "").';';					  
				}
				$GLOBALS["styleBackground"]='style="'.$style_background.$color_background.'"';
		 }
		}
		 
	  }
  
    static function is_session_started()
	{
	  if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
	}
	static function check($module)
	{
		if(!self::is_session_started())
		{
			session_start();
            self::setbydefault($module);
		}
		else if(!isset($_SESSION["SITE_SETTINGS"])) self::setbydefault($module);
	}
	static function setbydefault($modulename)
	{
			$_SESSION["SITE_SETTINGS"]=array();
			$_SESSION["SITE_SETTINGS"]["MAIN"]=array(
													  "BACKGROUND"=>COption::GetOptionString($modulename, "background", ""),
													  "BOXED"=> COption::GetOptionString($modulename, "boxed", true),
													  );
	        $_SESSION["SITE_SETTINGS"]["SECTIONS"]=array();
	}
	
	static function change($type,$name,$value)
	{
		$_SESSION["SITE_SETTINGS"][$type][$name]=$value;
	}
	

	
	
	
  
  }