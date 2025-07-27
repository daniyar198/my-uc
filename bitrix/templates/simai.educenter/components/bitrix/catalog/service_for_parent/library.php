<?
if($arResult["VARIABLES"]["ELEMENT_CODE"])$GLOBALS["ELEMENT_CODE"]=$arResult["VARIABLES"]["ELEMENT_CODE"];
elseif($arResult["VARIABLES"]["ELEMENT_ID"])$GLOBALS["ELEMENT_ID"]=$arResult["VARIABLES"]["ELEMENT_ID"];
$GLOBALS["IBLOCK_TYPE"]=$arParams["IBLOCK_TYPE"];
$GLOBALS["IBLOCK_ID"]=$arParams["IBLOCK_ID"];
if (!function_exists("bxc_get_site_settings"))
{
	function bxc_get_site_settings()
	{
        if (\Bitrix\Main\Loader::includeModule('iblock'))
		{
            $arFilter=array();
            if($GLOBALS["ELEMENT_ID"])
            {
                $arFilter=array("LID" => SITE_ID, "IBLOCK_TYPE" => $GLOBALS["IBLOCK_TYPE"],"IBLOCK_ID" => $GLOBALS["IBLOCK_ID"],"ID"=> $GLOBALS["ELEMENT_ID"],"IBLOCK_ACTIVE" => "Y","ACTIVE" => "Y","CHECK_PERMISSIONS" => "Y");
            }
            elseif($GLOBALS["ELEMENT_CODE"])
            {
                $arFilter=array("LID" => SITE_ID, "IBLOCK_TYPE" => $GLOBALS["IBLOCK_TYPE"],"IBLOCK_ID" => $GLOBALS["IBLOCK_ID"],"CODE"=> $GLOBALS["ELEMENT_CODE"],"IBLOCK_ACTIVE" => "Y","ACTIVE" => "Y","CHECK_PERMISSIONS" => "Y");
            }
            $rsElement = CIBlockElement::GetList(
				array(
					"SORT" => "ASC",
                    "ACTIVE_FROM" => "DESC"
				)
                ,$arFilter
				,false
				,false
				,array(
					"ID"
					,"NAME"
					,"IBLOCK_ID"
					,"IBLOCK_SECTION_ID"
					,"PREVIEW_PICTURE"
					,"DETAIL_PICTURE"
					,"ACTIVE_FROM"
					,"PROPERTY_*"
				)
			);
             
			if($obElement = $rsElement->GetNextElement())
			{
				$arResult = $obElement->GetFields();				
				$arProperties = $obElement->GetProperties();
	
				if ($arProperties)
				{
					
					$arResult["DESCRIPTION"] = $arProperties["DESCRIPTION"]["~VALUE"];
					$arResult["ADVANTAGES"] =$arProperties["ADVANTAGES"]["~VALUE"];
					$arResult["CONTRAINDICATIONS"] = $arProperties["CONTRAINDICATIONS"]["~VALUE"];
					$arResult["SPECIALISTS"] = $arProperties["SPECIALISTS"]["VALUE"];
					$arResult["PRICE"] = $arProperties["PRICE"]["VALUE"];
					$arResult["REVIEWS"] = $arProperties["REVIEWS"]["VALUE"];
                    $arResult["TESTIMONY"] = $arProperties["TESTYMONY"]["~VALUE"];
					$arResult["SHORT_DESCRIPTION"] = $arProperties["SHORT_DESCRIPTION"]["~VALUE"];
					if($arProperties["CAPTURE"]["VALUE"])
                    {
                        $file = CFile::ResizeImageGet($arProperties["CAPTURE"]["VALUE"], array('width'=> 1024, 'height'=> 400), BX_RESIZE_IMAGE_EXACT);
                        $arResult["CAPTURE"] = $file;
                    }
					$arResult["PHOTO"] = $arProperties["PHOTO"];
                    $arResult["MORE_PHOTO"]=array();
               
                    if(is_array($arProperties["MORE_PHOTO"]["VALUE"]))
                    {
                            foreach($arProperties["MORE_PHOTO"]["VALUE"] as $key=>$arItem)
                            {
                                $arFileTmp = CFile::ResizeImageGet(
                                    $arItem,
                                    array("width" => 780, "height" => 600),
                                    BX_RESIZE_IMAGE_EXACT,
                                    false
                                );
                                $arFileTmp1 = CFile::ResizeImageGet(
                                    $arItem,
                                    array("width" => 1170, "height" => 900),
                                    BX_RESIZE_IMAGE_EXACT,
                                    false
                                );
                                $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
                                $arResult["MORE_PHOTO"][]= array(
                                    "SRC" => $arFileTmp["src"],
                                    "SRC_BIG" => $arFileTmp1["src"],
                                    "WIDTH" => IntVal($arSize[0]),
                                    "HEIGHT" => IntVal($arSize[1]),
                                    "DESCRIPTION" => $arFileTmp1["DESCRIPTION"],
                                    "OLD_LINK" => $arFileTmp1["src"],
                                );
                            }
                    }
					if($arProperties["CAPTURE"]["VALUE"])
                    {
                        $arFileTmp = CFile::ResizeImageGet(
                            $arProperties["CAPTURE"]["VALUE"],
                            array("width" => 780, "height" => 600),
                            BX_RESIZE_IMAGE_EXACT,
                            false
                        );
                        $arFileTmp1 = CFile::ResizeImageGet(
                            $arProperties["CAPTURE"]["VALUE"],
                            array("width" => 1170, "height" => 900),
                            BX_RESIZE_IMAGE_EXACT,
                            false
                        );
						if(is_array($arProperties["MORE_PHOTO"]["VALUE"]))
                        {
							$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
							$arResult["MORE_PHOTO"][]= array(
								"SRC" => $arFileTmp["src"],
								"SRC_BIG" => $arFileTmp1["src"],
								"WIDTH" => IntVal($arSize[0]),
								"HEIGHT" => IntVal($arSize[1]),
								"OLD_LINK" => $arFileTmp1["src"],
							);
						}
                    }
				}
			}
			unset($obElement);
			unset($rsElement);
		}

		return $arResult;
	}
}

$arResult["arBXCSiteSettings"] = bxc_get_site_settings();