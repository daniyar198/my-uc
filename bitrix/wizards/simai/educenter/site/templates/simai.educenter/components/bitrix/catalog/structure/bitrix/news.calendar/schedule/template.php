<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<script type="text/javascript">
    $(function(){
        $(function() {
            BX.addCustomEvent('onAjaxSuccess', function(){
                var textButton=$("#textButton_id").text();
                if(textButton.length>0)
                {
                    $("#current_menu_element").css("cursor","default").text(textButton);
                }
            });
        });
        $("a.events").on("click",function(){
            var id=$(this).attr("data-id");
            if(typeof id !== "undefined" && $.isPlainObject(adsEvent))
            {
                if($.isPlainObject(adsEvent[id]["VALUE"]) && typeof(adsEvent[id]["DATE"]) === "string")
                {
                    $("#block_buttons").html("").next().addClass("mt-20");
                    $.each(adsEvent[id]["VALUE"], function(k, val){
                        if(val)
                        {
                            $("#block_buttons").append("<a data-toggle='modal' data-date='" + adsEvent[id]["DATE"] + "' class='btn btn-base btn-lg mr-10 mb-10' href='#modal_order'>" + val + "</a>&nbsp;");
                        }
                        else
                        {
                            $("#block_buttons").append("<a class='btn btn-light btn-lg mr-10 mb-10' style='cursor: default' href='javascript:void(0);'><?=getMessage("IBL_NEWS_CAL_RESERVED");?></a>&nbsp;");
                        }
                    });
                    $("#block_buttons a.btn").on("click", function(){
                        var dataDate=$(this).attr("data-date");
                        var dataText=$(this).text();
                        var href=$(this).attr("href");
                        $(this).attr("id", "current_menu_element");
                        if(typeof(dataDate) === "string" && typeof(dataText) === "string" && typeof(href) === "string")
                        {
                            $(href+" input[name='PROP[DATE]']").val(dataDate);
                            $(href+" input[name='PROP[TIME]']").val(dataText);
                        }
                    });
                }
            }
            return true;
        });
    });
</script>
<div id="block_buttons"></div>
<div class="news-calendar">
	<?if($arParams["SHOW_CURRENT_DATE"]):?>
        <div class="alert alert-info"><b><?=$arResult["TITLE"]?></b></div>
	<?endif?>
    <div ></div>
    <div style="display: none;" id="schedule-block" class="alert alert-warning fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
	<table class="table" style="width: 100%;margin-bottom: 15px;">
        <?if($arParams["SHOW_YEAR"]=="Y"):?>
            <tr>
                <td style="width: 35%;">
                    <?if($arResult["PREV_YEAR_URL"]):?>
                        <a href="<?=$arResult["PREV_YEAR_URL"]?>" class="dotted-link" title="<?=$arResult["PREV_YEAR_URL_TITLE"]?>"><i class="fa fa-angle-left"></i> <?=$arResult["PREV_YEAR_URL_TITLE"]?></a>
                    <?endif?>
                </td>
                <td class="text-center" style="width: 30%;">
                    <b><?=$arResult["currentYear"]?></b>
                </td>
                <td style="width: 35%;">
                    <?if($arResult["NEXT_YEAR_URL"]):?>
                        <a href="<?=$arResult["NEXT_YEAR_URL"]?>" class="dotted-link pull-right" title="<?=$arResult["NEXT_YEAR_URL_TITLE"]?>"><?=$arResult["NEXT_YEAR_URL_TITLE"]?> <i class="fa fa-angle-right"></i></a>
                    <?endif?>
                </td>
            </tr>
        <?endif?>
            <tr>
                <td colspan="3" class="NewsCalMonthNav">
                    <?if($arResult["SHOW_MONTH_LIST"]):?>
                        <select onChange="b_result()" class="form-control" name="MONTH_SELECT" id="month_sel">
                            <?foreach($arResult["SHOW_MONTH_LIST"] as $month => $arOption):?>
                                <option value="<?=$arOption["VALUE"]?>" <?if($arResult["currentMonth"] == $month) echo "selected";?>><?=$arOption["DISPLAY"]?></option>
                            <?endforeach?>
                        </select>
                        <script language="JavaScript" type="text/javascript">
                        <!--
                        function b_result()
                        {
                            var idx=document.getElementById("month_sel").selectedIndex;
                            <?if($arParams["AJAX_ID"]):?>
                                BX.ajax.insertToNode(document.getElementById("month_sel").options[idx].value, 'comp_<?echo CUtil::JSEscape($arParams['AJAX_ID'])?>', <?echo $arParams["AJAX_OPTION_SHADOW"]=="Y"? "true": "false"?>);
                            <?else:?>
                                window.document.location.href=document.getElementById("month_sel").options[idx].value;
                            <?endif?>
                        }
                        -->
                        </script>
                    <?endif?>
                </td>
            </tr>
	</table>
	<table class="table table-bordered table-striped text-center">
	<tr>
	<?foreach($arResult["WEEK_DAYS"] as $WDay):?>
		<td class='NewsCalHeader'><?=$WDay["SHORT"]?></td>
	<?endforeach?>
	</tr>
	<?
    $i=0;
    foreach($arResult["MONTH"] as $arWeek):?>
	<tr>
		<?foreach($arWeek as $arDay):?>
		<td <?if($arDay["td_title"]):?>title="<?=$arDay["td_title"]?>" <?endif?>class='<?=$arDay["td_class"]?>' width="14%">
                    <?if(!empty($arDay["events"])):
                        $scheduleTrue=false;
                        foreach($arDay["events"]["VALUE"] as $time)
                        {
                            if($time)
                            {
                                $scheduleTrue=true;
                                break;
                            }
                        }
                        if($scheduleTrue)
                        {
                        $i++;
                        ?>
                        <script type="text/javascript">
                            if(typeof adsEvent==="undefined")adsEvent={};
                            adsEvent["<?=$i?>"]=<?=json_encode($arDay["events"], JSON_FORCE_OBJECT)?>;
                            adsEvent["<?=$i?>"]["DATE"]="<?=$arDay["DATE"]?>";
                        </script>
                        <a data-id="<?=$i?>" class="<?=$arDay["day_class"]?>events btn btn-success" href="javascript:void(0);"><?=$arDay["day"]?></a>
                        <?
                        }
                        else
                        {?>
                        <span title="<?=getMessage("IBL_NEWS_CAL_RESERVED_ALL")?>" style="cursor:default;" class="events btn btn-danger"><?=$arDay["day"]?></span>
                        <?
                        }?>
                    <?else:?>
                        <span class="<?=$arDay["day_class"]?>events"><?=$arDay["day"]?></span>
                    <?endif?>
		</td>
		<?endforeach?>
	</tr >
	<?endforeach?>
	</table>
</div>