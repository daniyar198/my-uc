<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="simai_basket_show c-primary">
 <i class="fa fa-shopping-cart"></i>
 <a class=" c-primary" href="<?=$arParams["BASKET_PATH"]?>"><?=GetMessage("SB_C_TEMP_BASKET")?></a>
(<div id="simai_basket_count"><?if($arResult["COUNT_ITEMS"] > 0):echo $arResult["COUNT_ITEMS"];else:
	echo GetMessage("SB_C_TEMP_EMPTY");
endif?></div>)
<script type="text/javascript">
function SimaiAdd2Basket(item_id,key) 
{
	item_id = parseInt(item_id);
	if (item_id > 0)
	{
		jsAjaxUtil.InsertDataToNode('<?=$templateFolder?>/add2basket.php?item_id=' + item_id+'&key='+key, 'simai_basket_count', true);
		if (typeof SimaiBasketDisableAddLink == 'function') 
		{
			SimaiBasketDisableAddLink(item_id);
		}
	}
}
<?if (is_array($arResult["ITEMS_IDS"])):?>
var item_ids = new Array(0, <?=implode(", ",$arResult["ITEMS_IDS"])?>);
for (var key in item_ids)
{
	var item_id = item_ids[key];
	if (item_id > 0)
	{
		var simai_basket_disable_add_link_check = false;
		if (typeof SimaiBasketDisableAddLink == 'function')
		{
			simai_basket_disable_add_link_check = SimaiBasketDisableAddLink(item_id);
		} 
		if (!simai_basket_disable_add_link_check)
		{
			document.write('<input type="hidden" id="simai_basket_item_checker_' + item_id + '">');
		}
	}
}
<?endif;?>
</script>
<?if ($arParams["CONT_SESSION"] && $arResult["COUNT_ITEMS"] > 0):?>
<div id="simai_basket_count_session_checker"></div>
<script type="text/javascript">
function SimaiBasketCountSessionCheck()
{
	jsAjaxUtil.InsertDataToNode('<?=$templateFolder."/session_check.php"?>', 'simai_basket_count_session_checker', false);
}
setInterval(SimaiBasketCountSessionCheck, 200000);
</script>
<?endif?>
</div>