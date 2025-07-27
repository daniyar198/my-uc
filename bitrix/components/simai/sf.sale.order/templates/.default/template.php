<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
 .starrequired{color:#FF0000;}
</style>
<?if(!empty($arResult["ERRORS"])):?>
   <p style="color:red"><?=implode("<br>",$arResult["ERRORS"])?></p>
<?endif;?>
	<table class="table">
		<tr>
			<th><?=GetMessage("SB_O_TEMP_HEAD_NAME")?></th>
			<th width="100"><?=GetMessage("SB_O_TEMP_HEAD_PRICE")?></th>
			<th width="100"><?=GetMessage("SB_O_TEMP_HEAD_QUANT")?></th>
			<th width="100"><?=GetMessage("SB_SUM")?></th>

		</tr>
		<?foreach ($arResult["ITEMS"] as $item):?>
			 <?foreach ($item["FORMS"] as $form):?>
				 <tr>
				   <td>
					 <?=$item["NAME"]?> (<?=mb_strtolower($form["NAME"])?>, <?=mb_strtolower($form["TYPE"])?>)
					</td>
					<td>
					   <?=number_format($form["COST"], 2, ".", " ")?>
					</td>
					<td>
					  <?=$form["COUNT"]?>
					</td>
					<td>
					 <?=number_format($form["COST"]*$form["COUNT"], 2, ".", " ")?>
					</td>
				  </tr>
			<?endforeach;?>
		<?endforeach;?>
		<tr><th><?=GetMessage("SB_O_TEMP_SUM")?></th><td colspan="3" bgcolor="#fafafa" align="right"><div class="mr-4"><?=number_format($arResult["SUM"], 2, ".", " ")?></div></td></tr>
	</table>


<form name="items_form" method="post" action="<?=$_SERVER["PHP_SELF"]?>">


  <input type="hidden" name="ORDER_SUBMIT" value="Y">
  <div class="mt-2 ml-2">
  
    <div class="mb-3">
		<div><?=GetMessage("TYPE_PAIDS")?></div>
		<?
		 $paymentKey = key($arResult["PAYMENT"]);
		?>
	   <?foreach($arResult["PAYMENT"] as $key => $type):?>
	 
		<div>
		   <input type="radio" id="<?=$key?>" name="type" value="<?=$key?>" <?if($paymentKey==$key):?> checked<?endif?>>
		   <label for="<?=$key?>"><?=$type["NAME"]?></label>
		</div>
	 
	   <?endforeach;?>
     </div>
	 
 <div id="method-paid">
	 <?
	  $keyMethod = key($arResult["PAYMENT"][$paymentKey]["METHOD"]);
	  $method = $arResult["PAYMENT"][$paymentKey]["METHOD"][$keyMethod];
	 ?>
	 
	 <?
	 // echo "<pre>";print_r($arResult["PAYMENT"][$paymentKey]["METHOD"]);echo "</pre>";
	 ?>
	   <div class="mt-3"><?=GetMessage("METHOD_PAIDS")?></div>
	 <?foreach($arResult["PAYMENT"][$paymentKey]["METHOD"] as $key=> $value):?>
		 
		<div>
		   <input type="radio" id="<?=$value["CODE"]?>" name="method" value="<?=$value["CODE"]?>" <?if($keyMethod==$key):?> checked<?endif?>>
		   <label for="<?=$value["CODE"]?>"><?=$value["NAME"]?></label>
		</div>
	 
	  <?endforeach;?>
	  
	  
	  
	<div id="method-fields"> 
		 <?foreach($method["PROPERTIES"]["FIELDS"]["VALUE"] as $value):?>
		 
			<div class="form-group mt-3">
			   <label for="<?=$value["SUB_VALUES"]["FIELD_CODE"]["VALUE"]?>" class=""><?if($value["SUB_VALUES"]["FIELD_REQUIRED"]["VALUE"]!=""):?><span class="starrequired">*</span><?endif?> <?=$value["SUB_VALUES"]["FIELD_NAME"]["VALUE"]?></label>
			   <input type="text" 
					  name="PROP[<?=$value["SUB_VALUES"]["FIELD_CODE"]["VALUE"]?>]" 
					  value="" 
					  id="<?=$value["SUB_VALUES"]["FIELD_CODE"]["VALUE"]?>"
					  class="form-control" 
					  placeholder="<?=$value["SUB_VALUES"]["FIELD_NAME"]["VALUE"]?>" <?if($value["SUB_VALUES"]["FIELD_REQUIRED"]["VALUE"]!=""):?> required<?endif?>>
			</div>
		 
		 <?endforeach;?>
	 </div>
  </div>
</div>

  <input type='submit' class="btn btn-success btn-outline waves-effect waves-light float-right" value="<?=GetMessage("SB_O_TEMP_SUBMIT")?>">
</form>
<script>

  $( "[name='type']" ).change(function(){
	  
	var type = $(this).val();
	$.ajax({ type: "POST",
			  url: "<?=$templateFolder?>/ajax.php",
			  data: "type="+type+"&iblock=<?=$arParams["IBLOCK_ID_PAYMENT"]?>",
		success: function(data){
			$("#method-paid").html(data);
		}
    });
	
	
});
</script>