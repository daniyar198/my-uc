<?
    if(class_exists("SIMAISearch"))SIMAISearch::GetInclude("include",false);
	else{?>
		<style>.body-wrap{display:none !important;}</style><?
		CAdminNotify::Add(array('MESSAGE' => GetMessage("ATTENTION"),'TAG' => 'test_notif','MODULE_ID' => 'mymodule','ENABLE_CLOSE' => 'Y',));
	}
	global $APPLICATION;
	 include_once "include/include.php";
	 if($_SESSION["SITE_SETTINGS"]["MAIN"]["SPECIAL"]=="on")
	  {  
		 if($_SESSION["SITE_SETTINGS"]["MAIN"]["special-color"]=="black")
		 {
			 $APPLICATION->AddHeadString('<link href="'.SITE_TEMPLATE_PATH.'/framework/color/black.css" type="text/css" data-template-style="true" rel="stylesheet" id="WpStyle">');
         }
		 else if($_SESSION["SITE_SETTINGS"]["MAIN"]["special-color"]=="yellow")
		 { 
	     $APPLICATION->AddHeadString('<link href="'.SITE_TEMPLATE_PATH.'/framework/color/yellow.css" type="text/css" data-template-style="true" rel="stylesheet" id="WpStyle">');
	      }
	      else if($_SESSION["SITE_SETTINGS"]["MAIN"]["special-color"]=="blue")
		 { 
	     $APPLICATION->AddHeadString('<link href="'.SITE_TEMPLATE_PATH.'/framework/color/blue.css" type="text/css" data-template-style="true" rel="stylesheet" id="WpStyle">');
	      }
	      else if($_SESSION["SITE_SETTINGS"]["MAIN"]["special-color"]=="white")
		 { 
	     $APPLICATION->AddHeadString('<link href="'.SITE_TEMPLATE_PATH.'/framework/color/white.css" type="text/css" data-template-style="true" rel="stylesheet" id="WpStyle">');
	      }
	  }
	  else
	  {
			if($_SESSION["SITE_SETTINGS"]["MAIN"]["color"])$APPLICATION->AddHeadString('<link href="'.SITE_TEMPLATE_PATH.'/framework/color/demo/'.$_SESSION["SITE_SETTINGS"]["MAIN"]["color"].'.css" type="text/css" data-template-style="true" rel="stylesheet" id="WpStyle">');
			   else	$APPLICATION->AddHeadString('<link href="'.SITE_TEMPLATE_PATH.'/framework/color/color.css" type="text/css" data-template-style="true" rel="stylesheet" id="WpStyle">');
	       
				 
	 }	

class SIMAIMeta
  {
	
	static function opengraph($page, $type, $title, $description, $image)
	{
		global $APPLICATION;
		$APPLICATION->AddHeadString('<meta property="og:url" content="'.$page.'" />');
	    $APPLICATION->AddHeadString('<meta property="og:type" content="'.$type.'" />');
	    $APPLICATION->AddHeadString('<meta property="og:title" content="'.$title.'" />');
	    $APPLICATION->AddHeadString('<meta property="og:description" content="'.$description.'" />');
	    $APPLICATION->AddHeadString('<meta property="og:image" content="'.$image.'" />');
    }	
  }
?>
	

