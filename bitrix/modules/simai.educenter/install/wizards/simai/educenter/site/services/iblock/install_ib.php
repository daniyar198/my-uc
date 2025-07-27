<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

IncludeModuleLangFile(__FILE__);

use Bitrix\Iblock\InheritedProperty;
if(!CModule::IncludeModule("iblock"))
	return;
	
if(!CModule::IncludeModule('highloadblock'))
	return;

if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/highloadelems.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/highloadelems.php");

if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/highload.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/highload.php");

if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/highloadprops.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/highloadprops.php");

COption::SetOptionString("iblock","property_features_enabled","N");

//получаем список  блоков
     global $DB;
	 $strSql = "SELECT NAME FROM b_hlblock_entity";
		$res = $DB->Query($strSql, false, $err_mess.__LINE__);

    $highload = array();
	while($row = $res->Fetch()){
		$highload[$row["NAME"]] = $row["NAME"];
	}


	// необходимые классы
	use Bitrix\Highloadblock as HL;
	use Bitrix\Main\Entity;

    //add highoload blocks
	$id_highload=array();
	foreach($highloadblocks as $highloadblock):

	
	   if(!isset($highload[$highloadblock["NAME"]])){
		   $result = HL\HighloadBlockTable::add($highloadblock);
		   $id_highload[$highloadblock["NAME"]] = $result->getId();
	   }
	endforeach;
	
	 //add highoload fields
	foreach($highloadprops as $highloadprop):
	
	
       if(!isset($highload[$highloadblock["NAME_BLOCK"]])){
	  
			   $highloadprop["ENTITY_ID"] = 'HLBLOCK_'.$id_highload[$highloadprop['NAME_BLOCK']];
			   unset($highloadprop['NAME_BLOCK']);
			   
			   $oUserTypeEntity    = new CUserTypeEntity();
			   $oUserTypeEntity->Add($highloadprop); 
     }
	endforeach;
	//add highoload elems
	
	$arHLBlock = array();
	$obEntity = array();
	$strEntityDataClass = array();

	foreach($id_highload as $code => $id):
	
	   $arHLBlock[$code] = Bitrix\Highloadblock\HighloadBlockTable::getById($id)->fetch();
	   $obEntity[$code] = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock[$code]);
	   $strEntityDataClass[$code] = $obEntity[$code]->getDataClass();	
   
    endforeach;
	
	
	foreach($highlistelems as $highlistelem){
		
		 if(isset($highload[$highlistelem["NAME_BLOCK"]])) continue;
		
		$codeHighload=$highlistelem['NAME_BLOCK'];
		unset($highlistelem['NAME_BLOCK']);
		
		if($highlistelem["UF_FILE"]!=""){
			
		    $arr = CFile::MakeFileArray(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/files/".$highlistelem["UF_FILE"]);
			if (is_array($arr)){
				
				$arr["MODULE_ID"] = "iblock";
				$highlistelem["UF_FILE"] = $arr;
			}
		}
		$obResult = $strEntityDataClass[$codeHighload]::add($highlistelem);
	}	
  
	
		
	
//	
$ib_types = Array();
$iblocks = Array();
$ib_props = Array();
$ib_forms = Array();

if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/types.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/types.php");
if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/iblocks.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/iblocks.php");
if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/props.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/props.php");
if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/forms.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/forms.php");
if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/seo.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/seo.php");
if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/fields.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/fields.php");
	
$arSites = Array();
$rsSites = CSite::GetList($by = "sort", $order = "desc", Array());
while ($arSite = $rsSites->Fetch())
	$arSites[] = $arSite["LID"];

foreach ($ib_types as $ib_type)
{
	$res = CIBlockType::GetByID($ib_type["ID"]);
	if($res->GetNext())
		$res = true;
	else
	{
		$ob = new CIBlockType;
		$res = $ob->Add($ib_type);
	}
}

$iblock_ids = Array();
foreach ($iblocks as $iblock)
{
	$res = CIBlock::GetList(
		Array("sort" => "asc"), 
		Array(
			"TYPE" => $iblock["IBLOCK_TYPE_ID"], 
			"CODE" => $iblock["CODE"]
		), false
	);
	if($arr = $res->Fetch())
		$iblock_ids[$iblock["CODE"]] = $arr["ID"];
	else
	{
		$iblock["SITE_ID"] = $arSites;
		$iblock["GROUP_ID"] = Array("2" => "R");	
		$ob = new CIBlock;		
		$iblock_ids[$iblock["CODE"]] = $ob->Add($iblock);
	}
}
$iblock_ids["SITEDIR"] = WIZARD_SITE_DIR;

$prop_ids = Array();
foreach ($ib_props as $ib_prop)
{
	$prop_id = false;
	$res = CIBlockProperty::GetList(
		Array("sort" => "asc", "name" => "asc"), 
		Array(
			"IBLOCK_ID" => $iblock_ids[$ib_prop["IBLOCK_CODE"]],
			"CODE" => $ib_prop["CODE"],
		)
	);
	if($arr = $res->Fetch())
	{
		$prop_id = $arr["ID"];
		$ib_prop["IBLOCK_ID"] = $arr["IBLOCK_ID"];
	}
	else
	{
		$ib_prop["IBLOCK_ID"] = $iblock_ids[$ib_prop["IBLOCK_CODE"]];
		unset($ib_prop["IBLOCK_CODE"]);
		if($ib_prop["USER_TYPE"]=="simai_complex"){
			foreach($ib_prop["USER_TYPE_SETTINGS"]["SUBPROPS"] as $key => $code){
				$ib_prop["USER_TYPE_SETTINGS"]["SUBPROPS"][$key] = $prop_ids[$ib_prop["IBLOCK_ID"]][$code];
			}	
		}
		

		if ($ib_prop["LINK_IBLOCK_CODE"])
			$ib_prop["LINK_IBLOCK_ID"] = $iblock_ids[$ib_prop["LINK_IBLOCK_CODE"]];
		unset($ib_prop["LINK_IBLOCK_CODE"]);
		$ob = new CIBlockProperty;
		$prop_id = $ob->Add($ib_prop);
	}
	if ($prop_id)
		$prop_ids[$ib_prop["IBLOCK_ID"]][$ib_prop["CODE"]] = $prop_id;
	if ($prop_id && is_array($ib_prop["VALUES"]))
	{
		foreach ($ib_prop["VALUES"] as $ib_prop_value)
		{
			$res = CIBlockPropertyEnum::GetList(
				Array("sort" => "asc"), 
				Array("PROPERTY_ID" => $prop_id, "VALUE" => $ib_prop_value["VALUE"])
			);
			if(!($res->Fetch()))
			{
				$ib_prop_value["PROPERTY_ID"] = $prop_id;
				$ob = new CIBlockPropertyEnum;
				$ob->Add($ib_prop_value);
			}			
		}
	}	
}

foreach ($ib_forms as $ib_form)
{
	if ($iblock_ids[$ib_form["CODE"]] && $ib_form["TABS"])
	{		
		$prop_replaces_ids = $prop_ids[$iblock_ids[$ib_form["CODE"]]];
		if (is_array($prop_replaces_ids))
		{
			foreach ($prop_replaces_ids as $code => $id)
				$ib_form["TABS"] = str_replace("-PROPERTY_".$code."-", "-PROPERTY_".$id."-", $ib_form["TABS"]);
		}
		CUserOptions::SetOption("form", "form_element_".$iblock_ids[$ib_form["CODE"]], Array("tabs" => $ib_form["TABS"]), $bCommon=true, $userId=false);
	}
}
//устанавливаем сео
foreach ($seo as $ib_seo)
{
	if ($iblock_ids[$ib_seo["IBLOCK_CODE"]])
	{	   
	     $ipropTemplates = new InheritedProperty\IblockTemplates($iblock_ids[$ib_seo["IBLOCK_CODE"]]);
    	 $ipropTemplates->set(array($ib_seo["CODE"] => $ib_seo["TEMPLATE"]));
	}
}
//устанавливаем поля
foreach ($ib_fields as $ib_field)
{
	if ($iblock_ids[$ib_field["IBLOCK_CODE"]])
	{	   
       CIBlock::setFields($iblock_ids[$ib_field["IBLOCK_CODE"]], $ib_field["FIELDS"]);
	}
}




$wizard =& $this->GetWizard();
if ($wizard->GetVar("siteInstallPublic") == "Y")
{
	$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID;
	$public_dirs_files = @scandir(WIZARD_ABSOLUTE_PATH."/site/public/".LANGUAGE_ID);
	if (!is_array($public_dirs_files))
		$public_dirs_files = Array();
	$public_files = Array();
	$public_dirs = Array();
	foreach ($public_dirs_files as $i => $file_dir)
	{
		if (is_file(WIZARD_ABSOLUTE_PATH."/site/public/".LANGUAGE_ID."/".$file_dir) && $file_dir != "urlrewrite.php")
			$public_files[] = $file_dir;
		elseif (is_dir(WIZARD_ABSOLUTE_PATH."/site/public/".LANGUAGE_ID."/".$file_dir) && substr($file_dir,0,1) != ".")
			$public_dirs[] = $file_dir;
	}
    ReplaceMacros($bitrixTemplateDir."/header.php", $iblock_ids);
	ReplaceMacros($bitrixTemplateDir."/footer.php", $iblock_ids);
    ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/bitrix/components/simai/template.header/templates/simai.fund/template.php", $iblock_ids);

	
	foreach ($public_files as $file) ReplaceMacros(WIZARD_SITE_PATH.$file, $iblock_ids);
	foreach ($public_dirs as $dir) ReplaceMacrosRecursive(WIZARD_SITE_PATH.$dir, $iblock_ids);
	
}
	function ReplaceMacros($filePath, $arReplace, $skipSharp = false)
    {
        clearstatcache();

        if (!is_file($filePath) || !is_writable($filePath) || !is_array($arReplace))
            return;

        @chmod($filePath, BX_FILE_PERMISSIONS);

        if (!$handle = @fopen($filePath, "rb"))
            return;

        $content = @fread($handle, filesize($filePath));
        @fclose($handle);

        if (!($handle = @fopen($filePath, "wb")))
            return;

        if (flock($handle, LOCK_EX))
        {
            $arSearch = array();
            $arValue = array();

            foreach ($arReplace as $search => $replace)
            {
                if ($skipSharp)
                    $arSearch[] = $search;
                else
                    $arSearch[] = "#".$search."#";

                $arValue[] = $replace;
            }

            $content = str_ireplace($arSearch, $arValue, $content);
            @fwrite($handle, $content);
            @flock($handle, LOCK_UN);
        }
        @fclose($handle);
    }
	 
	function ReplaceMacrosRecursive($filePath, $arReplace)
    {
        clearstatcache();
        if ((!is_dir($filePath) && !is_file($filePath)) || !is_array($arReplace))
            return;

        if ($handle = @opendir($filePath))
        {
        	
            while (($file = readdir($handle)) !== false)
            {
            	
                if ($file == "." || $file == ".." || (trim($filePath, "/") == trim($_SERVER["DOCUMENT_ROOT"], "/") && ($file == "bitrix" || $file == "upload"))) 
                    continue;
                   
                if (is_dir($filePath."/".$file))
                {
                  
                   ReplaceMacrosRecursive($filePath."/".$file."/", $arReplace);
                  
                }
                elseif (is_file($filePath."/".$file))
                {
                    if(GetFileExtension($file) <> "php")
                        continue;

                    if (!is_writable($filePath."/".$file))
                        continue;

                    @chmod($filePath."/".$file, BX_FILE_PERMISSIONS);
                    if(filesize($filePath."/".$file)==0) continue;
					
                    if (!$handleFile = @fopen($filePath."/".$file, "rb"))
                        continue;

                    $content = @fread($handleFile, filesize($filePath."/".$file));
                    @fclose($handleFile);

                    if (!($handleFile = @fopen($filePath."/".$file, "wb")))
                        continue;

                    if (flock($handleFile, LOCK_EX))
                    {
                        $arSearch = array();
                        $arValue = array();

                        foreach ($arReplace as $search => $replace)
                        {
                            $arSearch[] = "#".$search."#";
                            $arValue[] = $replace;
                        }
                        $content = str_ireplace($arSearch, $arValue, $content);
                        @fwrite($handleFile, $content);
                        @flock($handleFile, LOCK_UN);
                    }
                    @fclose($handleFile);

                }
            }
            @closedir($handle);
        }
    }
	
	
	//список инфоблоков
	$iblock_ids = Array();
	$res = CIBlock::GetList(Array(), Array());
	while ($arr = $res->GetNext())
		$iblock_ids[$arr["CODE"]] = $arr["ID"];
	
	$oUserTypeEntity = new CUserTypeEntity();

	$aUserFields= array(

		'ENTITY_ID'         => 'IBLOCK_'.$iblock_ids["courses"].'_SECTION',
		'FIELD_NAME'        => 'UF_ICON',
		'USER_TYPE_ID'      => 'string',
		'SORT'              => 500,
		'MULTIPLE'          => 'N',
		'MANDATORY'         => 'N',
		'SHOW_FILTER'       => 'N',
		'SHOW_IN_LIST'      => '',
		'EDIT_IN_LIST'      => '',
		'IS_SEARCHABLE'     => 'N',
		'SETTINGS'          => array(
			'SIZE' => '20',
			'ROWS' => 1,
			'MIN_LENGTH' => 0,
			'MAX_LENGTH'=> 0,
			'DEFAULT_VALUE'=> '',

	),
		'EDIT_FORM_LABEL'   => array(
			'ru'    => GetMessage("UF_ICON"),
			'en'    => 'icon',
		),
		'LIST_COLUMN_LABEL' => array(
			'ru'    => GetMessage("UF_ICON"),
			'en'    => 'icon',
		),
		'LIST_FILTER_LABEL' => array(
			'ru'    => GetMessage("UF_ICON"),
			'en'    => 'icon',
	),
		'HELP_MESSAGE'      => array(
			'ru'    => '',
			'en'    => '',
		),
	);	
	$oUserTypeEntity->Add($aUserFields);
	
	$oUserTypeEntity = new CUserTypeEntity();
	$aUserFields= array(

		'ENTITY_ID'         => 'IBLOCK_'.$iblock_ids["organization"].'_SECTION',
		'FIELD_NAME'        => 'UF_FIO',
		'USER_TYPE_ID'      => 'string',
		'SORT'              => 100,
		'MULTIPLE'          => 'N',
		'MANDATORY'         => 'N',
		'SHOW_FILTER'       => 'N',
		'SHOW_IN_LIST'      => '',
		'EDIT_IN_LIST'      => '',
		'IS_SEARCHABLE'     => 'N',
		'SETTINGS'          => array(
				'SIZE' => '20',
				'ROWS' => 1,
				'MIN_LENGTH' => 0,
				'MAX_LENGTH'=> 0,
				'DEFAULT_VALUE'=> '',

		),
		'EDIT_FORM_LABEL'   => array(
			'ru'    => GetMessage("UF_FIO"),
			'en'    => 'surname',
		),
		'LIST_COLUMN_LABEL' => array(
			'ru'    => GetMessage("UF_FIO"),
			'en'    => 'surname',
		),
		'LIST_FILTER_LABEL' => array(
			'ru'    => GetMessage("UF_FIO"),
			'en'    => 'surname',
	),
		'HELP_MESSAGE'      => array(
			'ru'    => '',
			'en'    => '',
		),
	);
	$oUserTypeEntity->Add($aUserFields);
	
    $oUserTypeEntity = new CUserTypeEntity();
	$aUserFields= array(

		'ENTITY_ID'         => 'IBLOCK_'.$iblock_ids["organization"].'_SECTION',
		'FIELD_NAME'        => 'UF_ADDRESS',
		'USER_TYPE_ID'      => 'string',
		'SORT'              => 200,
		'MULTIPLE'          => 'N',
		'MANDATORY'         => 'N',
		'SHOW_FILTER'       => 'N',
		'SHOW_IN_LIST'      => '',
		'EDIT_IN_LIST'      => '',
		'IS_SEARCHABLE'     => 'N',
		'SETTINGS'          => array(
				'SIZE' => '20',
				'ROWS' => 1,
				'MIN_LENGTH' => 0,
				'MAX_LENGTH'=> 0,
				'DEFAULT_VALUE'=> '',

		),
		'EDIT_FORM_LABEL'   => array(
			'ru'    => GetMessage("UF_ADDRESS"),
			'en'    => 'address',
		),
		'LIST_COLUMN_LABEL' => array(
			'ru'    => GetMessage("UF_ADDRESS"),
			'en'    => 'address',
		),
		'LIST_FILTER_LABEL' => array(
			'ru'    => GetMessage("UF_ADDRESS"),
			'en'    => 'address',
	),
		'HELP_MESSAGE'      => array(
			'ru'    => '',
			'en'    => '',
		),
	);
	$oUserTypeEntity->Add($aUserFields);
	
	$oUserTypeEntity = new CUserTypeEntity();
	$aUserFields= array(

		'ENTITY_ID'         => 'IBLOCK_'.$iblock_ids["organization"].'_SECTION',
		'FIELD_NAME'        => 'UF_ADDRESS',
		'USER_TYPE_ID'      => 'string',
		'SORT'              => 200,
		'MULTIPLE'          => 'N',
		'MANDATORY'         => 'N',
		'SHOW_FILTER'       => 'N',
		'SHOW_IN_LIST'      => '',
		'EDIT_IN_LIST'      => '',
		'IS_SEARCHABLE'     => 'N',
		'SETTINGS'          => array(
				'SIZE' => '20',
				'ROWS' => 1,
				'MIN_LENGTH' => 0,
				'MAX_LENGTH'=> 0,
				'DEFAULT_VALUE'=> '',

		),
		'EDIT_FORM_LABEL'   => array(
			'ru'    => GetMessage("UF_ADDRESS"),
			'en'    => 'address',
		),
		'LIST_COLUMN_LABEL' => array(
			'ru'    => GetMessage("UF_ADDRESS"),
			'en'    => 'address',
		),
		'LIST_FILTER_LABEL' => array(
			'ru'    => GetMessage("UF_ADDRESS"),
			'en'    => 'address',
	),
		'HELP_MESSAGE'      => array(
			'ru'    => '',
			'en'    => '',
		),
	);
	$oUserTypeEntity->Add($aUserFields);
	
	$oUserTypeEntity = new CUserTypeEntity();
	$aUserFields= array(

		'ENTITY_ID'         => 'IBLOCK_'.$iblock_ids["organization"].'_SECTION',
		'FIELD_NAME'        => 'UF_SITE',
		'USER_TYPE_ID'      => 'string',
		'SORT'              => 300,
		'MULTIPLE'          => 'N',
		'MANDATORY'         => 'N',
		'SHOW_FILTER'       => 'N',
		'SHOW_IN_LIST'      => '',
		'EDIT_IN_LIST'      => '',
		'IS_SEARCHABLE'     => 'N',
		'SETTINGS'          => array(
				'SIZE' => '20',
				'ROWS' => 1,
				'MIN_LENGTH' => 0,
				'MAX_LENGTH'=> 0,
				'DEFAULT_VALUE'=> '',

		),
		'EDIT_FORM_LABEL'   => array(
			'ru'    => GetMessage("UF_SITE"),
			'en'    => 'site',
		),
		'LIST_COLUMN_LABEL' => array(
			'ru'    => GetMessage("UF_SITE"),
			'en'    => 'site',
		),
		'LIST_FILTER_LABEL' => array(
			'ru'    => GetMessage("UF_SITE"),
			'en'    => 'site',
	),
		'HELP_MESSAGE'      => array(
			'ru'    => '',
			'en'    => '',
		),
	);
	$oUserTypeEntity->Add($aUserFields);
	
    $oUserTypeEntity = new CUserTypeEntity();
	$aUserFields= array(

		'ENTITY_ID'         => 'IBLOCK_'.$iblock_ids["organization"].'_SECTION',
		'FIELD_NAME'        => 'UF_EMAIL',
		'USER_TYPE_ID'      => 'string',
		'SORT'              => 300,
		'MULTIPLE'          => 'N',
		'MANDATORY'         => 'N',
		'SHOW_FILTER'       => 'N',
		'SHOW_IN_LIST'      => '',
		'EDIT_IN_LIST'      => '',
		'IS_SEARCHABLE'     => 'N',
		'SETTINGS'          => array(
				'SIZE' => '20',
				'ROWS' => 1,
				'MIN_LENGTH' => 0,
				'MAX_LENGTH'=> 0,
				'DEFAULT_VALUE'=> '',

		),
		'EDIT_FORM_LABEL'   => array(
			'ru'    => 'E-mail',
			'en'    => 'E-mail',
		),
		'LIST_COLUMN_LABEL' => array(
			'ru'    => 'E-mail',
			'en'    => 'E-mail',
		),
		'LIST_FILTER_LABEL' => array(
			'ru'    => 'E-mail',
			'en'    => 'E-mail',
	),
		'HELP_MESSAGE'      => array(
			'ru'    => '',
			'en'    => '',
		),
	);
	$oUserTypeEntity->Add($aUserFields);
	
	
	$oUserTypeEntity = new CUserTypeEntity();
	$aUserFields= array(

		'ENTITY_ID'         => 'IBLOCK_'.$iblock_ids["organization"].'_SECTION',
		'FIELD_NAME'        => 'UF_DIVISION',
		'USER_TYPE_ID'      => 'file',
		'SORT'              => 400,
		'MULTIPLE'          => 'N',
		'MANDATORY'         => 'N',
		'SHOW_FILTER'       => 'N',
		'SHOW_IN_LIST'      => 'Y',
		'EDIT_IN_LIST'      => 'Y',
		'IS_SEARCHABLE'     => 'N',
		'SETTINGS'          => array(
				'SIZE' => '20',
				'LIST_WIDTH' => 200,
				'LIST_HEIGHT' => 200,
				'MAX_SHOW_SIZE'=> 0,
				'MAX_ALLOWED_SIZE'=> 0,
				'EXTENSIONS' => array(),

		),
		'EDIT_FORM_LABEL'   => array(
			'ru'    => GetMessage("UF_DIVISION"),
			'en'    => 'division',
		),
		'LIST_COLUMN_LABEL' => array(
			'ru'    => GetMessage("UF_DIVISION"),
			'en'    => 'division',
		),
		'LIST_FILTER_LABEL' => array(
			'ru'    => GetMessage("UF_DIVISION"),
			'en'    => 'division',
	),
		'HELP_MESSAGE'      => array(
			'ru'    => '',
			'en'    => '',
		),
	);
	$oUserTypeEntity->Add($aUserFields);
	

function GetGroupByCode($code)
{
   $rsGroups = CGroup::GetList ($by = "c_sort", $order = "asc", Array ("STRING_ID" => $code)); 
   $array=$rsGroups->Fetch();
   return $array["ID"];
}

$NEW_GROUP_ID=GetGroupByCode("CONTENT-MANAGER");
if(!$NEW_GROUP_ID){
	$group = new CGroup;
	$arFields = Array(
	  "ACTIVE"       => "Y",
	  "C_SORT"       => 100,
	  "NAME"         => GetMessage("CONTENT_MANAGER"),
	  "DESCRIPTION"  =>GetMessage("DESCRIPTION_GROUP"),
	  "USER_ID"      => array(),
	  "STRING_ID"      => "CONTENT-MANAGER"
	  );
	$NEW_GROUP_ID = $group->Add($arFields);
	global $DB;
	$DB->Query("INSERT INTO b_group_task (GROUP_ID, TASK_ID) VALUES(".$NEW_GROUP_ID.",2)");
	$DB->Query("INSERT INTO b_group_task (GROUP_ID, TASK_ID) VALUES(".$NEW_GROUP_ID.",17)");
}
$IBLOCK_ID="";
foreach ($iblock_ids as $id){
	$IBLOCK_ID = $id;
	break;
}
$gr_res = CIBlock::GetGroupPermissions($IBLOCK_ID);
$permissions = Array();
foreach($gr_res as $group_id=>$perm)
      $permissions[$group_id] = $perm;
	  
$permissions[$NEW_GROUP_ID] = "W";

foreach ($iblock_ids as $id)
   CIBlock::SetPermission($id, $permissions);
   
COption::SetOptionString("iblock","combined_list_mode","Y");
?>