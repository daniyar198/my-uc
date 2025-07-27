<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\IO\File;

$certs = array();
$arUserId = array();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
	    $arUserId[$arItem["CREATED_BY"]] = $arItem["CREATED_BY"];
        if($arItem["DISPLAY_PROPERTIES"]["FILE"])
        {
            $info=substr($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"], strrpos($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"], '.') + 1);
            $arResult["ITEMS"][$key]["TYPE"]=$info;
            $doc=array("pdf"=>array("icon"=>"pdf","color"=>"#FF9800"),"doc"=>array("icon"=>"word","color"=>"#3F51B5"),"docx"=>array("icon"=>"word","color"=>"#3F51B5"),"xls"=>array("icon"=>"excel","color"=>"#4CAF50"),"xml"=>array("icon"=>"excel","color"=>"#4CAF50"),"jpg" => array("icon"=>"image","color"=>"#E91E63"),"jpeg" => array("icon"=>"image","color"=>"#E91E63"),"png" => array("icon"=>"image","color"=>"#E91E63"),"bmp" => array("icon"=>"image","color"=>"#E91E63"),"gif" => array("icon"=>"image","color"=>"#E91E63"),"zip" => array("icon"=>"archive","color"=>"#3F51B5"),"rar" => array("icon"=>"archive","color"=>"#3F51B5"));
            if(array_key_exists($info,$doc)){
				$arResult["ITEMS"][$key]["ICON"]["TYPE"]="file-".$doc[$info]["icon"]."-o";
				$arResult["ITEMS"][$key]["ICON"]["COLOR"] = $doc[$info]["color"];
			}
            else{
				$arResult["ITEMS"][$key]["ICON"]["TYPE"]="file-o";
				$arResult["ITEMS"][$key]["ICON"]["COLOR"]="#607D8B";
			}
            $arResult["ITEMS"][$key]["DOC_SRC"]=$arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"];
            $arResult["ITEMS"][$key]["DOC_SIZE"]=number_format(intVal($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["FILE_SIZE"])/1000, 0, '.', '');
        }
	  // signature
		if (!empty($arItem['PROPERTIES']['SIGNATURE_FILE']['VALUE']))
		{
			$content = file_get_contents(\Bitrix\Main\Application::getDocumentRoot().CFile::GetPath($arItem['PROPERTIES']['SIGNATURE_FILE']['VALUE']));
			if (!empty($content))
				$arResult["ITEMS"][$key]['PROPERTIES']['SIGNATURE_FILE']['CONTENT'] = $content;
		}

		// certificates collecting
		if (!empty($arItem['PROPERTIES']['CERTIFICATE']['VALUE']))
			$certs[$key] = $arItem['PROPERTIES']['CERTIFICATE']['VALUE'];
}

// certificates
if (!empty($certs))
{
    $arSelect = ['ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_ORGANIZATION', 'PROPERTY_FILE', 'PROPERTY_RELEASED_BY',
        'PROPERTY_DATE_VALIDITY_BEGIN', 'PROPERTY_DATE_VALIDITY_END', 'PROPERTY_SERIAL','PROPERTY_WORK_POSITION'];
    $res = CIBlockElement::GetList([], ['ID' => $certs], false, false, $arSelect);
    while($ob = $res->GetNextElement())
        $arResult['CERTIFICATES'][ $ob->GetFields()['ID'] ] = $ob->GetFields();
}

$arResult["USER"] = array();

if(!empty($arUserId)){
	
		$result = \Bitrix\Main\UserTable::getList(array(
		'select' => array('*'), 
		'order' => array('id'=>'desc'), 
		'filter' => array(
			'=ID' => $arUserId,
		),
	));

	   while ($arUser = $result->fetch()) {
		
		$name="";
		if($arUser["LAST_NAME"]!="")
		   $name.=$arUser["LAST_NAME"]." ";
		   
		 if($arUser["NAME"]!="")
		   $name.=$arUser["NAME"]." ";
		   
		 if($arUser["SECOND_NAME"]!="")
		   $name.=$arUser["SECOND_NAME"]; 
		   
		$arResult["USER"][$arUser['ID']] = array("NAME" => $name, "WORK_POSITION" => $arUser['WORK_POSITION']);
	}
	
}

?>