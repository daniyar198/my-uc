<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<style>
.news-calendar {position: relative;}
.NewsCalNews {
    position: absolute;
    padding: 10px 15px;
    z-index: 1010;
    display: none;
    max-width: 276px;
    text-align: left;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 6px;
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
}
.NewsCalOtherMonth {background: #fcf8e3;}
.table .NewsCalDefault {padding: 0;}
a.dotted-link {border-bottom: 1px dashed #1F7BC6;text-decoration: none;}
</style>

<script type="text/javascript">
    $(function(){
        $(".news-calendar .events-block > a").each(function(){
            var href=$(this).attr("data-href");
            if(typeof href !== "undefined")
            {
                $(this).attr({"href":href,"onclick":""});
            }
        });
        $(".news-calendar .events-block").on({
            "mouseover": function(){
            $(this).children(".NewsCalNews").css("display","block");
        },
            "mouseout": function(){
            $(this).children(".NewsCalNews").css("display","none");
        }});
    });
</script>
<div class="news-calendar">
	<table class="table" style="width: 100%;margin-bottom: 15px;">
        <?if($arParams["SHOW_YEAR"]):?>
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
	<?foreach($arResult["MONTH"] as $arWeek):?>
	<tr>
		<?foreach($arWeek as $arDay):?>
		<td class='<?=$arDay["td_class"]?>' width="14%">
            <?if(!empty($arDay["events"])):?>
                <div class="events-block">
            <?endif;?>
                    <?if(!empty($arDay["events"])):?>
					    <?
						   if($arDay["td_class"]=="NewsCalOtherMonth"){
							   if($arDay["day"]>20)
								   $current_month=$arResult["currentMonth"]-1;
							   else
								   $current_month=$arResult["currentMonth"]+1;
						   }else
						       $current_month=$arResult["currentMonth"];
						       $currentDate=$arDay["day"].".".$current_month.".".$arResult["currentYear"];?>
                        <a data-href="<?=$arParams["FILTER_URL"]?>?DATE_START=<?=$currentDate?>&DATE_END=<?=$currentDate?>" href="javascript:void(0);" class="<?=$arDay["day_class"]?>events btn btn-base" href=""><?=$arDay["day"]?></a>
                    <?else:?>
                        <span class="<?=$arDay["day_class"]?>events"><?=$arDay["day"]?></span>
                    <?endif?>
            <?if(!empty($arDay["events"])):?>
                <div class="NewsCalNews">
			<?foreach($arDay["events"] as $key=>$arEvent):?>
				<?=$arEvent["time"]?><a href="<?=$arEvent["url"]?>" title="<?=$arEvent["preview"]?>"><?=$arEvent["title"]?></a>
                <?if($key+1!=count($arDay["events"])):?><hr/><?endif?>
			<?endforeach?>
                </div>
                </div>
            <?endif?>
		</td>
		<?endforeach?>
	</tr >
	<?endforeach?>
	</table>
</div>


