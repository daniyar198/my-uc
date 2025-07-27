<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arParams["IBLOCK_ID"])
{
    if(CModule::IncludeModule("iblock"))
    {
        $res = CIBlock::GetByID($arParams["IBLOCK_ID"]);
        if($ar_res = $res->GetNext())
        {
            if($ar_res["LIST_PAGE_URL"])
            {
                $arResult["LIST_PAGE_URL"] = CComponentEngine::MakePathFromTemplate(
                    $ar_res["LIST_PAGE_URL"],
                    array(
                        "SITE_DIR" => SITE_DIR
                    )
                );
            }
        }
    }
}
if(!$arResult["LIST_PAGE_URL"])$arResult["LIST_PAGE_URL"]=SITE_DIR;
/*
echo "<pre>";
print_r($arResult);
echo "</pre>";
*/