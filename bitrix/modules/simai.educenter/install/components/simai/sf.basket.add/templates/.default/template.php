<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="simai_add2basket"><noindex><div class="simai_add2basket_<?=$arParams["ITEM_ID"]?>"><a rel="nofollow" href="javascript:SimaiAdd2Basket(<?=$arParams["ITEM_ID"]?>)"><?=GetMessage("SB_A_TEMP_ADD2BASKET")?></a></div></noindex>
<script type="text/javascript">
if (typeof SimaiBasketDisableAddLink != 'function')
{
	function SimaiBasketDisableAddLink(item_id)
	{
		var f_res = false;
		var simai_basket_all_divs = document.getElementsByTagName("div");
		for(var key in simai_basket_all_divs)
		{			
			simai_basket_current_div = simai_basket_all_divs[key];
			if (simai_basket_current_div.className == "simai_add2basket_" + item_id)
			{
				simai_basket_current_div.innerHTML = '<span><?=GetMessage("SB_A_TEMP_ADDED2BASKET")?></span>';
				f_res = true;				
			}
		}
		return f_res;
	}
}
var simai_basket_item_checker = document.getElementById('simai_basket_item_checker_<?=$arParams["ITEM_ID"]?>');
if (simai_basket_item_checker != null) 
{
	SimaiBasketDisableAddLink(<?=$arParams["ITEM_ID"]?>);
}
</script></div>