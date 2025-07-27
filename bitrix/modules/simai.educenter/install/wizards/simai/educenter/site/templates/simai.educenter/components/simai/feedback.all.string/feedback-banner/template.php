<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<div>
<?
if (count($arResult["ERRORS"]) > 0):?>
    <div class="alert alert-danger">
<p style="color:red"><?=implode("<br>",$arResult["ERRORS"])?></p>
    </div>
<?elseif ($_REQUEST["inf"] == "ok"):?>
    <div class="alert alert-success">
<p style="color:green"><?=$arParams["OK_MSG"]?></p>
    </div>
<?endif;?>
<form method="post" class="form-light" id="form-proverka" action="" enctype="multipart/form-data">
<div class="form-cont">
<h4 class="t-center" style="font-weight: 500;"><?=getMessage("SEND_REQUEST")?></h4>
<?foreach($arResult["FIELDS"] as $field_code=>$field_name):
	if (array_key_exists($field_code,$arResult["FIELDS_DIV"])):?>
    <div class="form-group"><label><?=$field_name["NAME"]?></label></div>
	<?else:?>
        <div class="form-group">
             <label><?=$field_name["NAME"]?><?if (array_key_exists($field_code,$arResult["FIELDS_REQ"])):?><span style="color:red">*</span><?endif;?>:</label>
            
			<?if($field_name["PROPERTY_TYPE"]=="S"):?>
			
				<?if (array_key_exists($field_code,$arResult["FIELDS_TXT"])):?>
					<textarea class="form-control" name="PROP[<?=$field_code?>]"  <?if (array_key_exists($field_code,$arResult["FIELDS_REQ"])):?>required<?endif;?>><?=htmlspecialchars(strip_tags($_POST["PROP"][$field_code]),ENT_QUOTES)?></textarea>
				<?else:?>
				   <input class="form-control" name="PROP[<?=$field_code?>]" type="text" value="<?=htmlspecialchars(strip_tags($_POST["PROP"][$field_code]),ENT_QUOTES)?>"<?if (array_key_exists($field_code,$arResult["FIELDS_REQ"])):?>required<?endif;?>>
				<?endif?>
			<?elseif($field_name["PROPERTY_TYPE"]=="F"):?>
			   <input type="file" name="PROP[<?=$field_code?>]" <?if (array_key_exists($field_code,$arResult["FIELDS_REQ"])):?>required<?endif;?>>
			<?endif?>
        </div>
	<?endif;
endforeach;?>
<?if($arParams["USE_GOOGLE_CAPTCHA"] !="Y"):?>
	<?if (isset($arResult["CAP_CODE"])):?>
		<div class="form-group bg-lgrey ba p-15">
			<label for=""><?=getMessage("FORM_ENTER_CODE");?><span style="color:red">*</span>:</label>
			<div class="row mt-15 mb-15">
				<div class="col-md-6">
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialchars($arResult["CAP_CODE"])?>" width="180" height="40">
				</div>
				<div class="col-md-6">
					<input class="form-control bg-white" type="text" required name="CAPTCHA_WORD" maxlength="50" value="">
					<input type="hidden" name="CAPTCHA_SID" value="<?=htmlspecialchars($arResult["CAP_CODE"])?>">
				</div>
			</div>
		</div>
	<?endif;?>
<?endif;?>	
<?$APPLICATION->IncludeComponent(
	"bitrix:main.userconsent.request",
	"",
	Array(
		"AUTO_SAVE" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ID" => "1",
		"IS_CHECKED" => "N",
		"IS_LOADED" => "Y",
		"REPLACE" => array('button_caption' => getMessage("SEND")),
	)
);?>


<?if($arParams["USE_GOOGLE_CAPTCHA"] =="Y"):?>

   <button
	class="g-recaptcha btn btn-base"
	data-sitekey="<?=$arParams["PUBLIC_KEY"]?>"
	data-callback="YourOnSubmitFn">
	<?=getMessage("SEND");?>
	</button>
	
<?else:?>	
	<input class="btn btn-base" type='submit' name='FB_SUBMIT' value=' <?=getMessage("SEND");?>'>
<?endif;?>
</div>
</form>
</div>

 <script>
       function YourOnSubmitFn(token) {
         $("#form-proverka").submit();
	   }
	   
  </script>
