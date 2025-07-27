<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($_REQUEST["inf"] == "ok"):?>
<p style="color:green"><?=GetMessage("SB_O_TEMP_OK")?></p>
<?elseif (count($arResult["ERRORS"]) > 0):?>
<p style="color:red"><?=implode("<br>",$arResult["ERRORS"])?></p>
<?endif;?>

<?if (empty($arResult["ITEMS"])):?>
<p><?=GetMessage("SB_O_TEMP_EMPTY")?></p>
<?else:

/*
 echo "<pre>";		 
 print_r($arResult);
 echo "</pre>";*/

?>

<script type="text/javascript">
function SimaiBasketChangeCount(what, tid,key)
{
	var cnt = what.value;
	if ((isNaN(cnt)) || (cnt < 1) || (cnt > 1000))
	{
		cnt = 1;
		alert('<?=GetMessage("SB_O_TEMP_CNT_NAN")?>');
	}
	else
	{		
		cnt = Math.round(cnt - 0.5);
	}
	what.value = cnt;
	jsAjaxUtil.InsertDataToNode('<?=$templateFolder."/change_item_count.php?item_id="?>' + tid +'&key='+key+ '&count=' + cnt + '&property_price=<?=$arParams["CATALOG_PRICE_PROPERTY"]?>&display_cents=<?=($arParams["DISPLAY_CENTS"] ? "y" : "n")?>', 'simai_basket_order_sum', true);	
}

function SimaiSendCoupon()
{
	var coupon = $('#coupon').val();
	$('#cont-coupon').val(coupon);
	jsAjaxUtil.InsertDataToNode('<?=$templateFolder."/set_coupon.php?coupon="?>' + coupon + '&property_price=<?=$arParams["CATALOG_PRICE_PROPERTY"]?>&display_cents=<?=($arParams["DISPLAY_CENTS"] ? "y" : "n")?>', 'simai_basket_order_sum', true);
}


<?if ($arParams["CONT_SESSION"]):?>
function SimaiBasketOrderSessionCheck()
{
	jsAjaxUtil.InsertDataToNode('<?=$templateFolder."/session_check.php"?>', 'simai_basket_order_session_checker', false);	
}
setInterval(SimaiBasketOrderSessionCheck, 200000);
<?endif;?>
</script>
<form name="items_form" method="get" action="<?=$_SERVER["PHP_SELF"]?>">
<table class="table">
<tr>
<th width="50"></th>
<th><?=GetMessage("SB_O_TEMP_HEAD_NAME")?></th>
<th width="100"><?=GetMessage("SB_O_TEMP_HEAD_PRICE")?></th>
<th width="100"><?=GetMessage("SB_O_TEMP_HEAD_QUANT")?></th>

</tr>
	<?foreach ($arResult["ITEMS"] as $item):?>
	   <?foreach ($item["FORMS"] as $form):?>
		 <tr>
		  <td><a class="c-red" href="?action=delete&id=<?=$item["ID"]?>&key=<?=$form["KEY"]?>"><i class="fa fa-times-circle fa-2x"></i></a></td>
		   <td>
			 <?if ($arParams["ITEMS_LINKS"]):?>
					<a class="c-black" href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?> (<?=mb_strtolower($form["NAME"])?>, <?=mb_strtolower($form["TYPE"])?>)</a>
			 <?else:?>
				 <?=$item["NAME"]?> (<?=mb_strtolower($form["NAME"])?>, <?=mb_strtolower($form["TYPE"])?>)
			 <?endif?>
		    </td>
		    <td>
			   <?=number_format($form["COST"], ($arParams["DISPLAY_CENTS"] ? 2 : 0), ".", " ")?>
			</td>
			<td>
			  <input type="number" min="0" step="1" name="c_<?=$item["ID"]?>_<?=$form["KEY"]?>" value="<?=$form["COUNT"]?>" style="width: 40px;" 
			  onChange="SimaiBasketChangeCount(this,<?=$item["ID"]?>,<?=$form["KEY"]?>)">
			</td>
		  </tr>
		<?endforeach;?>
	<?endforeach;?>
	<tr><th><?=GetMessage("SB_O_TEMP_SUM")?></th><td colspan="3" bgcolor="#fafafa" align="right"><div id="simai_basket_order_sum" class="mr-4"><?=number_format($arResult["SUM"], ($arParams["DISPLAY_CENTS"] ? 2 : 0), ".", " ")?></div></td></tr>
	
    
</table>
</form>

<br> 
  <div class="mt-2">
     <a href='/order/make/' class="btn btn-success btn-outline waves-effect waves-light float-right"><?=GetMessage("SB_O_TEMP_SUBMIT")?></a> 
  </div>
<?endif;?>