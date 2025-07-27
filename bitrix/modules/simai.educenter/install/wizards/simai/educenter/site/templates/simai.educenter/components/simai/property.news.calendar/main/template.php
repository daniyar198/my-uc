<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
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
    <div class="control-news-calendar">
        <div class="selected-month">
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
        </div>
        <?if($arParams["SHOW_YEAR"]):?>
            <div class="prev-year-btn">
                <?if($arResult["PREV_YEAR_URL"]):?>
					<i class="fa fa-angle-left c-primary mr-10"></i> 
                    <a href="<?=$arResult["PREV_YEAR_URL"]?>" class="" title="<?=$arResult["PREV_YEAR_URL_TITLE"]?>">
                        <?=$arResult["PREV_YEAR_URL_TITLE"]?>
                    </a>
                <?endif?>
            </div>
            <div class="year-btn">
                <b><?=$arResult["currentYear"]?></b>
            </div>
            <div class="next-year-btn">
                <?if($arResult["NEXT_YEAR_URL"]):?>
                    <a href="<?=$arResult["NEXT_YEAR_URL"]?>" class="" title="<?=$arResult["NEXT_YEAR_URL_TITLE"]?>">
                        <?=$arResult["NEXT_YEAR_URL_TITLE"]?>                       
                    </a>
					<i class="fa fa-angle-right c-primary ml-10"></i>
                <?endif?>
            </div>
        <?endif?>
    </div>

	<table class="table table-bordered text-center">
	<tr>
	<?foreach($arResult["WEEK_DAYS"] as $WDay):?>
		<th class='t-center'><?=$WDay["SHORT"]?></th>
	<?endforeach?>
	</tr>
	<?foreach($arResult["MONTH"] as $arWeek):?>
	<tr>
		<?foreach($arWeek as $arDay):?>
		<td class='<?=$arDay["td_class"]?>' width="14%"  <?if(!empty($arDay["events"])):?>style="padding: 0"<?endif?>>
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
						?>
                        <a data-href="<?=$arResult["LIST_PAGE_URL"]?>?date=<?=($arDay["day"]>9?$arDay["day"]:"0".$arDay["day"])?>.<?=($current_month>9?$current_month:"0".$current_month)?>.<?=$arResult["currentYear"]?>" href="javascript:void(0);" class="<?=$arDay["day_class"]?>events btn-primary" style="padding: 0.75rem" href=""><?=$arDay["day"]?></a>
                    <?else:?>
                        <span class="<?=$arDay["day_class"]?>events"><?=$arDay["day"]?></span>
                    <?endif?>
            <?if(!empty($arDay["events"])):?>
                <div class="NewsCalNews">
			<?foreach($arDay["events"] as $key=>$arEvent):?>
				<?=$arEvent["time"]?><a href="<?=$arEvent["url"]?>" title="<?=$arEvent["preview"]?>" class="t--1 mb-10"><?=$arEvent["title"]?></a>
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


