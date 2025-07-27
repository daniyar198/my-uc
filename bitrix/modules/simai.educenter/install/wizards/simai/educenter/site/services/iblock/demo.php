<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(!CModule::IncludeModule("iblock"))
	return;

if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/types.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/types.php");
if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/sections.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/sections.php");
if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/elements.php"))
	include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/elements.php");

$wizard =& $this->GetWizard();
if ($wizard->GetVar("siteInstallDD") == "Y")
{
	$iblock_ids = Array();
	$sectionArray=array();
	$res = CIBlock::GetList(Array(), Array());
	while ($arr = $res->GetNext())
		$iblock_ids[$arr["CODE"]] = $arr["ID"];
	
	
	    $str="";
		$section_ids = Array();
		$sectionID=Array();
		foreach ($sections as $section)
		{
			$section["IBLOCK_ID"] = $iblock_ids[$section["IBLOCK_CODE"]];
			if(isset($sectionID[$section["IBLOCK_SECTION_ID"]]) && $section["IBLOCK_SECTION_ID"]!="")
			        $section["IBLOCK_SECTION_ID"] = $sectionID[$section["IBLOCK_SECTION_ID"]];
			unset($section["IBLOCK_CODE"]);
			if ($section["PICTURE"])
			{
				$arr = CFile::MakeFileArray(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/files/".$section["PICTURE"]);
				if (is_array($arr))
				{
					$arr["MODULE_ID"] = "iblock";
					$section["PICTURE"] = $arr;
				}
			}
			$ob = new CIBlockSection;
			$res = $ob->Add($section);
			if ($res){
				$section_ids[$section["XML_ID"]] = $res;
				$sectionID[$section["CODE"]]=$res;
			}

		}
		$props = Array();	
		$res = CIBlockProperty::GetList(Array("ID" => "asc"), Array());
		while ($arr = $res->GetNext())
			$props[$arr["IBLOCK_ID"]][$arr["CODE"]] = $arr;
		
		$element_ids = Array();
		foreach ($elements as $element)
		{
			//обновление даты
			if($element["IBLOCK_CODE"]=="NEWS") $element["ACTIVE_FROM"]= date("d.m.o");
	
			$sect=array();
			$element["IBLOCK_ID"] = $iblock_ids[$element["IBLOCK_CODE"]];
			unset($element["IBLOCK_CODE"]);
			if ($element["SECTION_XML_ID"])
			{
				if(is_array($element["SECTION_XML_ID"]))
				{
					for($i=0;$i<count($element["SECTION_XML_ID"]);$i++)
					{
                        $sect[]= $section_ids[$element["SECTION_XML_ID"][$i]];
					}
					
				}
				else
				{
				 $element["SECTION_ID"] = $section_ids[$element["SECTION_XML_ID"]];
				 $element["IBLOCK_SECTION_ID"] = $section_ids[$element["SECTION_XML_ID"]];
				}
			}
			unset($element["SECTION_XML_ID"]);
			if ($element["PREVIEW_PICTURE"])
			{
				$arr = CFile::MakeFileArray(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/files/".$element["PREVIEW_PICTURE"]);
				if (is_array($arr))
				{
					$arr["MODULE_ID"] = "iblock";
					$element["PREVIEW_PICTURE"] = $arr;
				}
			}
			if ($element["DETAIL_PICTURE"])
			{
				$arr = CFile::MakeFileArray(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/files/".$element["DETAIL_PICTURE"]);
				if (is_array($arr))
				{
					$arr["MODULE_ID"] = "iblock";
					$element["DETAIL_PICTURE"] = $arr;
				}
			}		
			foreach ($element["PROPERTY_VALUES"] as $code => $val)
			{
				$prop = $props[$element["IBLOCK_ID"]][$code];
				if ($prop["PROPERTY_TYPE"] == "L")
				{			
					if (is_array($val))
					{
						foreach ($val as $i => $val_c)
						{
							$res = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID" => $element["IBLOCK_ID"], "CODE" => $code, "VALUE" => $val_c));
							if ($arr = $res->GetNext())
								$element["PROPERTY_VALUES"][$code][$i] = $arr["ID"];
						}
					}
					else
					{
						$res = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID" => $element["IBLOCK_ID"], "CODE" => $code, "VALUE" => $val));
						if ($arr = $res->GetNext())
							$element["PROPERTY_VALUES"][$code] = $arr["ID"];
					}
				}
				elseif ($prop["PROPERTY_TYPE"] == "F")
				{
					if (is_array($val))
					{
						foreach ($val as $i => $val_c)
						{
							$arr = CFile::MakeFileArray(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/files/".$val_c);
							if (is_array($arr))
							{
								$arr["MODULE_ID"] = "iblock";
								$element["PROPERTY_VALUES"][$code][$i] = $arr;
							}						
						}
					}
					else
					{	
						$arr = CFile::MakeFileArray(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/".LANGUAGE_ID."/files/".$val);
						if (is_array($arr))
						{
							$arr["MODULE_ID"] = "iblock";
							$element["PROPERTY_VALUES"][$code] = $arr;
						}
					}
				}
				elseif ($prop["PROPERTY_TYPE"] == "G")
				{
					if (is_array($val))
					{
						foreach ($val as $i => $val_c)
							$element["PROPERTY_VALUES"][$code][$i] = $section_ids[$val_c];
					}
					else
						$element["PROPERTY_VALUES"][$code] = $section_ids[$val];
				}
				elseif ($prop["PROPERTY_TYPE"] == "E")
				{
					if (is_array($val))
					{
						foreach ($val as $i => $val_c)
							$element["PROPERTY_VALUES"][$code][$i] = $element_ids[$val_c];
					}
					else
						$element["PROPERTY_VALUES"][$code] = $element_ids[$val];
				}
				elseif ($prop["USER_TYPE"] == "HTML")
				{
					if (strlen($val[0][1]) > 2)
					{
						foreach ($val as $i => $val_c)
						{
							$element["PROPERTY_VALUES"][$i][$code] = Array("VALUE" => Array(
									"TEXT" => $val_c[0],
									"TYPE" => $val_c[1]
								)
							);
						}
					}
					else
					{
						$element["PROPERTY_VALUES"][$code] = Array("VALUE" => Array(
								"TEXT" => $val[0],
								"TYPE" => $val[1]
							)
						);
					}
				}
			}
			$ob = new CIBlockElement;
			$res = $ob->Add($element);
			if ($res)
			{				
		        $element_ids[$element["XML_ID"]] = $res;
				if(count($sect)>0)$sectionArray[$res]=$sect;
			}
		}
		foreach ($sectionArray as $code => $val)
		{
            CIBlockElement::SetElementSection($code, $val);	
		}
		
	
}
 
?>