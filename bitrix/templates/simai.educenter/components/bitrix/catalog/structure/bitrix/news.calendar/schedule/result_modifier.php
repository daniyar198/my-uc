<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arParams["PAGE_CALENDAR"]) && $arParams["SHOW_YEAR"]=="Y" && empty($arResult["PREV_YEAR_URL"]))
{
    $arResult["PREV_YEAR_URL"]=$arParams["PAGE_CALENDAR"]."?".$arParams["YEAR_VAR_NAME"]."=".($arResult["currentYear"]-1)."&".$arParams["MONTH_VAR_NAME"]."=".$arResult["currentMonth"];
}
if(!empty($arParams["PAGE_CALENDAR"]) && $arParams["SHOW_YEAR"]=="Y" && empty($arResult["NEXT_YEAR_URL"]))
{
    $arResult["NEXT_YEAR_URL"]=$arParams["PAGE_CALENDAR"]."?".$arParams["YEAR_VAR_NAME"]."=".($arResult["currentYear"]+1)."&".$arParams["MONTH_VAR_NAME"]."=".$arResult["currentMonth"];;
}
if(intval($arParams["SPECIALIST_ID"]))
{
    $arSelect = Array("ID", "IBLOCK_ID");
    $arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "PROPERTY_SPECIALIST"=>intval($arParams["SPECIALIST_ID"]), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    if($ob = $res->GetNextElement())
    {
          $arFields = $ob->GetFields();
          $arProps = $ob->GetProperties();
          $arResult["SCHEDULE_INFO"]["WEEK"]=$arProps["WEEK"];
    }
    if(!empty($arProps["DATE_FROM"]["VALUE"]))
    {
        $arResult["SCHEDULE_START"]["DATE"]=$arProps["DATE_FROM"]["VALUE"];
        $arResult["SCHEDULE_START"]["MAKETIMESTAMP"]=MakeTimeStamp($arProps["DATE_FROM"]["VALUE"], FORMAT_DATE);
    }
    if(!empty($arProps["DATE_TO"]["VALUE"]))
    {
        $arResult["SCHEDULE_END"]["DATE"]=$arProps["DATE_TO"]["VALUE"];
        $arResult["SCHEDULE_END"]["MAKETIMESTAMP"]=MakeTimeStamp($arProps["DATE_TO"]["VALUE"], FORMAT_DATE);
    }
    switch($arParams["WEEK_START"]):
        case 2:
            $arResult["SCHEDULE_INFO"]["DAYS"]=array(0=>$arProps["TUESDAY"], 1=>$arProps["WENSDAY"], 2=>$arProps["THURSDAY"], 3=>$arProps["FRIDAY"], 4=>$arProps["SATURDAY"], 5=>$arProps["SUNDAY"], 6=>$arProps["MONDAY"]);
        break;
        case 3:
            $arResult["SCHEDULE_INFO"]["DAYS"]=array(0=>$arProps["WENSDAY"], 1=>$arProps["THURSDAY"], 2=>$arProps["FRIDAY"], 3=>$arProps["SATURDAY"], 4=>$arProps["SUNDAY"], 5=>$arProps["MONDAY"], 6=>$arProps["TUESDAY"]);
        break;
        case 4:
            $arResult["SCHEDULE_INFO"]["DAYS"]=array(0=>$arProps["THURSDAY"], 1=>$arProps["FRIDAY"], 2=>$arProps["SATURDAY"], 3=>$arProps["SUNDAY"], 4=>$arProps["MONDAY"], 5=>$arProps["TUESDAY"], 6=>$arProps["WENSDAY"]);
        break;
        case 5:
            $arResult["SCHEDULE_INFO"]["DAYS"]=array(0=>$arProps["FRIDAY"], 1=>$arProps["SATURDAY"], 2=>$arProps["SUNDAY"], 3=>$arProps["MONDAY"], 4=>$arProps["TUESDAY"], 5=>$arProps["WENSDAY"], 6=>$arProps["THURSDAY"]);
        break;
        case 6:
            $arResult["SCHEDULE_INFO"]["DAYS"]=array(0=>$arProps["SATURDAY"], 1=>$arProps["SUNDAY"], 2=>$arProps["MONDAY"], 3=>$arProps["TUESDAY"], 4=>$arProps["WENSDAY"], 5=>$arProps["THURSDAY"], 6=>$arProps["FRIDAY"]);
        break;
        case 7:
            $arResult["SCHEDULE_INFO"]["DAYS"]=array(0=>$arProps["SUNDAY"], 1=>$arProps["MONDAY"], 2=>$arProps["TUESDAY"], 3=>$arProps["WENSDAY"], 4=>$arProps["THURSDAY"], 5=>$arProps["FRIDAY"], 6=>$arProps["SATURDAY"]);
        break;
        default:
            $arResult["SCHEDULE_INFO"]["DAYS"]=array(0=>$arProps["MONDAY"], 1=>$arProps["TUESDAY"], 2=>$arProps["WENSDAY"], 3=>$arProps["THURSDAY"], 4=>$arProps["FRIDAY"], 5=>$arProps["SATURDAY"], 6=>$arProps["SUNDAY"]);
    endswitch;
}
if($arParams["TODAY_DATE"])
{
    $arResult["TODAY"]=$arParams["TODAY_DATE"];
    $arResult["MAKETIMESTAMP"]=MakeTimeStamp($arResult["TODAY"], "DD.MM.YYYY");
}

$arYear=$arResult["currentYear"];
$arYearPrev=$arResult["currentYear"]-1;
$arYearNext=$arResult["currentYear"]+1;
$arMonth=$arResult["currentMonth"];
$arMonthPrev=($arMonth-1<1?12:$arMonth-1);
$arMonthNext=($arMonth+1>12?1:$arMonth+1);
if($arMonth<10)$arMonth="0".$arMonth;
if($arMonthPrev<10)$arMonthPrev="0".$arMonthPrev;
if($arMonthNext<10)$arMonthNext="0".$arMonthNext;
$arFilterForOrder=array();
if($arResult["MAKETIMESTAMP"])
{
    foreach($arResult["MONTH"] as $key=>$arWeek)
    {
        foreach($arWeek as $cell=>$arDay)
        {
            $arMonthTemporary=$arMonth;
            $arYearTemporary=$arYear;
            if($arDay["td_class"]=="NewsCalOtherMonth")
            {
                if($arDay["day"]>6)
                {
                    $arMonthTemporary=$arMonthPrev;
                    if($arMonthTemporary==12)
                    {
                        $arYearTemporary=$arYearPrev;
                    }
                }
                else
                {
                    $arMonthTemporary=$arMonthNext;
                    if($arMonthTemporary=="01")
                    {
                        $arYearTemporary=$arYearNext;
                    }
                }
            }
            if($arDay["day"]<10)$arDay["day"]="0".$arDay["day"];
            $arResult["MONTH"][$key][$cell]["DATE"]=$arFilterForOrder["PROPERTY_DATE"][]=$arDay["day"].".".$arMonthTemporary.".".$arYearTemporary;
            $arCurrentMake=MakeTimeStamp($arResult["MONTH"][$key][$cell]["DATE"], "DD.MM.YYYY");
            if(empty($arResult["SCHEDULE_START"]) && empty($arResult["SCHEDULE_END"]))
            {
                if($arResult["MAKETIMESTAMP"]<=$arCurrentMake)$arResult["MONTH"][$key][$cell]["FUTURE"]="Y";
            }
            else
            {
                if(!empty($arResult["SCHEDULE_START"]) && !empty($arResult["SCHEDULE_END"]))
                {
                    if($arResult["SCHEDULE_START"]["MAKETIMESTAMP"]<=$arCurrentMake && $arResult["MAKETIMESTAMP"] <= $arCurrentMake && $arResult["SCHEDULE_END"]["MAKETIMESTAMP"]>=$arCurrentMake)$arResult["MONTH"][$key][$cell]["FUTURE"]="Y";
                }
                elseif(!empty($arResult["SCHEDULE_START"]))
                {
                    if($arResult["SCHEDULE_START"]["MAKETIMESTAMP"]<=$arCurrentMake && $arResult["MAKETIMESTAMP"] <= $arCurrentMake)$arResult["MONTH"][$key][$cell]["FUTURE"]="Y";
                }
                elseif(!empty($arResult["SCHEDULE_END"]))
                {
                    if($arResult["SCHEDULE_END"]["MAKETIMESTAMP"]>=$arCurrentMake && $arResult["MAKETIMESTAMP"] <= $arCurrentMake)$arResult["MONTH"][$key][$cell]["FUTURE"]="Y";
                }
            }

        }
    }
}
if(!empty($arFilterForOrder) && intVal($arParams["IBLOCK_ID_ORDER"]))
{

        $arResult["ORDER_LIST"]=array();
        $arSelect = Array("ID","PROPERTY_DATE","PROPERTY_TIME", "PROPERTY_FIO","PROPERTY_PHONE");
        $arFilterForOrder["IBLOCK_ID"] = intVal($arParams["IBLOCK_ID_ORDER"]);
        $arFilterForOrder["ACTIVE"] = "Y";
        $res = CIBlockElement::GetList(Array(), $arFilterForOrder, false, false, $arSelect);
        while($ob = $res->GetNext())
        {
            if(!isset($arResult["ORDER_LIST"][$ob["PROPERTY_DATE_VALUE"]]))$arResult["ORDER_LIST"][$ob["PROPERTY_DATE_VALUE"]]=array();
            $arResult["ORDER_LIST"][$ob["PROPERTY_DATE_VALUE"]][]=$ob["PROPERTY_TIME_VALUE"];
        }
}
if(intval($arParams["IBLOCK_ID_HOLIDAYS"]) && $arResult["currentMonth"])
{
    $arFilter = Array("IBLOCK_ID"=> intval($arParams["IBLOCK_ID_HOLIDAYS"]),"PROPERTY_MONTH"=>array(), "ACTIVE"=>"Y");
    $property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>intval($arParams["IBLOCK_ID_HOLIDAYS"]) , "CODE"=>"MONTH"));
    while($enum_fields = $property_enums->GetNext())
    {
        if($enum_fields["VALUE"]==$arMonth || $enum_fields["VALUE"]==$arMonthPrev || $enum_fields["VALUE"]==$arMonthNext)
        {
            $arFilter["PROPERTY_MONTH"][]=$enum_fields["ID"];
        }
    }
    if(!empty($arFilter["PROPERTY_MONTH"]))
    {
        $arResult["HOLIDAYS"]=array();
        $arSelect = Array("ID","NAME","PROPERTY_DAY","PROPERTY_MONTH");
        $resDate = CIBlockElement::GetList(Array("PROPERTY_DAY"=>"ASC"), $arFilter, false, false, $arSelect);
        while($obDate = $resDate->GetNext())
        {
            if($arMonth==$obDate["PROPERTY_MONTH_VALUE"])$arResult["HOLIDAYS"][$obDate["PROPERTY_DAY_VALUE"]]=$obDate;
            elseif($arMonthPrev==$obDate["PROPERTY_MONTH_VALUE"] && $obDate["PROPERTY_DAY_VALUE"]>6)$arResult["HOLIDAYS_OTHERMONTH"][$obDate["PROPERTY_DAY_VALUE"]]=$obDate;
            elseif($arMonthNext==$obDate["PROPERTY_MONTH_VALUE"] && $obDate["PROPERTY_DAY_VALUE"]<7)$arResult["HOLIDAYS_OTHERMONTH"][$obDate["PROPERTY_DAY_VALUE"]]=$obDate;
        }
    }
}
if($arResult["SCHEDULE_INFO"]["WEEK"]["VALUE_XML_ID"]!="week_all")
{
    $arResult["WEEK_IDENTIFIER"]=array();
    $arMonthTemporary=$arMonth;
    $arYearTemporary=$arYear;
    foreach($arResult["MONTH"] as $key=>$arWeek)
    {
        $arDay=$arWeek[0]["day"];
        if($arWeek[0]["td_class"]=="NewsCalOtherMonth")
        {
            if($arDay>6)
            {
                $arMonthTemporary=$arMonthPrev;
                if($arMonthTemporary==12)
                {
                    $arYearTemporary=$arYearPrev;
                }
            }
            else
            {
                $arMonthTemporary=$arMonthNext;
                if($arMonthTemporary=="01")
                {
                    $arYearTemporary=$arYearNext;
                }
            }
        }
        $arDate=$arYearTemporary."-".$arMonthTemporary."-".$arDay;
        $stmp = MakeTimeStamp($arDate, "YYYY-MM-DD");
        if(is_int(intval(date("W",$stmp))/2))$arResult["WEEK_IDENTIFIER"][$key]="even";
        else $arResult["WEEK_IDENTIFIER"][$key]="odd";
    }
}
foreach($arResult["MONTH"] as $key=>$arWeek)
{
    $arWeekFlag=true;
    if($arResult["SCHEDULE_INFO"]["WEEK"]["VALUE_XML_ID"]!="week_all" && !empty($arResult["WEEK_IDENTIFIER"][$key]))
    {
        $arWeekFlag=false;
        if($arResult["SCHEDULE_INFO"]["WEEK"]["VALUE_XML_ID"]=="week_even" && $arResult["WEEK_IDENTIFIER"][$key]=="even")
        {
            $arWeekFlag=true;
        }
        elseif($arResult["SCHEDULE_INFO"]["WEEK"]["VALUE_XML_ID"]=="week_odd" && $arResult["WEEK_IDENTIFIER"][$key]=="odd")
        {
            $arWeekFlag=true;
        }
    }
    if(!$arWeekFlag)continue;
    foreach($arWeek as $cell=>$arDay)
    {
        $arValuesTime=array();
        if($arDay["td_class"]!="NewsCalOtherMonth")
        {
            if(!empty($arResult["SCHEDULE_INFO"]["DAYS"][$cell]["VALUE"]) && empty($arResult["HOLIDAYS"][$arDay["day"]]) && !empty($arDay["FUTURE"]))
            {
                if(!empty($arResult["ORDER_LIST"][$arDay["DATE"]]))
                {
                    $arValuesTime=$arResult["SCHEDULE_INFO"]["DAYS"][$cell]["VALUE"];
                    foreach($arValuesTime as $key1=>$time)
                    {
                        if(in_array($time, $arResult["ORDER_LIST"][$arDay["DATE"]]))
                        {
                            $arValuesTime[$key1]=0;
                        }
                    }
                }
                $arResult["MONTH"][$key][$cell]["events"]["VALUE"]=(!empty($arValuesTime)?$arValuesTime:$arResult["SCHEDULE_INFO"]["DAYS"][$cell]["VALUE"]);
            }
            elseif(!empty($arResult["HOLIDAYS"][$arDay["day"]]))
            {
                $arResult["MONTH"][$key][$cell]["td_class"]="NewsCalHoliday";
                $arResult["MONTH"][$key][$cell]["td_title"]=$arResult["HOLIDAYS"][$arDay["day"]]["NAME"];
            }
        }
        else
        {
            if(!empty($arResult["SCHEDULE_INFO"]["DAYS"][$cell]["VALUE"]) && empty($arResult["HOLIDAYS_OTHERMONTH"][$arDay["day"]]) && !empty($arDay["FUTURE"]))
            {
                if(!empty($arResult["ORDER_LIST"][$arDay["DATE"]]))
                {
                    $arValuesTime=$arResult["SCHEDULE_INFO"]["DAYS"][$cell]["VALUE"];
                    foreach($arValuesTime as $key1=>$time)
                    {
                        if(in_array($time, $arResult["ORDER_LIST"][$arDay["DATE"]]))
                        {
                            $arValuesTime[$key1]=0;
                        }
                    }
                }
                $arResult["MONTH"][$key][$cell]["events"]["VALUE"]=(!empty($arValuesTime)?$arValuesTime:$arResult["SCHEDULE_INFO"]["DAYS"][$cell]["VALUE"]);
            }
            elseif(!empty($arResult["HOLIDAYS_OTHERMONTH"][$arDay["day"]]))
            {
                $arResult["MONTH"][$key][$cell]["td_class"]="NewsCalHoliday";
                $arResult["MONTH"][$key][$cell]["td_title"]=$arResult["HOLIDAYS_OTHERMONTH"][$arDay["day"]]["NAME"];
            }
        }
    }
}