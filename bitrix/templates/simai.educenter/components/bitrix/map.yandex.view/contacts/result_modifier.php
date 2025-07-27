<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
if(!is_array($arResult['POSITION']['PLACEMARKS']))$arResult['POSITION']['PLACEMARKS']=array();
if(intVal($arParams["IBLOCK_ID"]))
{
    $arResult["ITEMS"]=array();
    if(CModule::IncludeModule("iblock"))
    {
        $arSelect = Array("ID", "NAME", "PROPERTY_MAP", "PROPERTY_ADDRESS", "PROPERTY_PHONE", "PROPERTY_EMAIL");
        $arFilter = Array("IBLOCK_ID"=>intVal($arParams["IBLOCK_ID"]), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNext())
        {
            $arButtons = CIBlock::GetPanelButtons(
                intVal($arParams["IBLOCK_ID"]),
                $ob["ID"],
                0,
                array("SECTION_BUTTONS"=>false, "SESSID"=>false)
            );
            $ob["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
            $ob["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
            $arResult["ITEMS"][] = $ob;
            if($ob["PROPERTY_MAP_VALUE"])
            {
                $pieces = explode(",", $ob["PROPERTY_MAP_VALUE"]);
                $item["LAT"]=$pieces[0];
                $item["LON"]=$pieces[1];
                if($ob["PROPERTY_ADDRESS_VALUE"])
                {
                    if($ob["PROPERTY_NOT_WORK_VALUE"]){$item["TEXT"]="<div class='bg-red white'><b>".$ob["NAME"]."</b>: ".$ob["PROPERTY_ADDRESS_VALUE"]."</div>";}
                    else {$item["TEXT"]=$ob["PROPERTY_ADDRESS_VALUE"];}
                }
                $arResult['POSITION']['PLACEMARKS'][]=$item;
            }
        }
    }
}