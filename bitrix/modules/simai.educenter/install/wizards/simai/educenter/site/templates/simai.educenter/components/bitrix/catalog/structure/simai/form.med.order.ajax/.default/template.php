<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
CAjax::Init();
?>
<div id="modal_order" class="modal fade modal-center">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?=getMessage("TITLE_MODAL")?></h4>
            </div>
            <div class="modal-body">
                    <?if($arResult["DOCTOR_NAME"]):?>
                        <div class="alert alert-info"><?=getMessage("DOCTOR")?>:  <b><?=$arResult["DOCTOR_NAME"]?></b></div>
                    <?endif?>
<?=CAjax::GetForm('method="POST"', $arResult["AJAX_ID"], '1')?>
<input type="hidden" name="ajax" value="y">

<div id="<?=$arResult["AJAX_ID"]?>">
<?if ($_POST["FB_SUBMIT_".$arResult["AJAX_ID"]] && $_POST["ajax"] == "y"):
	$APPLICATION->RestartBuffer();
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
endif;?>
<?if (count($arResult["ERRORS"]) > 0):?>
	<div class="alert alert-danger">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <h4><?=GetMessage("SIMAI_FORM_ERROR")?></h4>
        <?=implode("<br>- ",$arResult["ERRORS"])?>
	</div>
<?elseif ($arResult["OK"]):?>
	<div class="alert alert-success">
	  <?=$arParams["OK_MSG"]?>
	</div>
<div id="textButton_id" class="hidden"><?=getMessage("RESERVED")?></div>
<?endif;?>

	<?
    if(!$arResult["OK"]):
    foreach($arResult["FIELDS"] as $field_code => $field_name):
        if($arParams["PROPERTY_DATE"]==$field_code)echo "<div class='row'>";
        ?>
        <div class="form-group<?if($arParams["PROPERTY_DATE"]==$field_code || $arParams["PROPERTY_TIME"]==$field_code):?> col-md-6<?endif?>">
            <label><?=$field_name?><?if (array_key_exists($field_code,$arResult["FIELDS_REQ"])):?> <span style="color:red">*</span><?endif;?>:</label>
            <?if (array_key_exists($field_code, $arResult["FIELDS_TXT"])):?>
                <textarea name="PROP[<?=$field_code?>]" rows="5" class="form-control"><?=($arResult["OK"] ? "" : htmlspecialchars(strip_tags($_POST["PROP"][$field_code]),ENT_QUOTES))?></textarea>
            <?else:?>
                <input class="form-control" <?if($arParams["PROPERTY_DATE"]==$field_code || $arParams["PROPERTY_TIME"]==$field_code):?>readonly=""<?endif?> name="PROP[<?=$field_code?>]" type="text" value="<?=($arResult["OK"] ? "" : htmlspecialchars(strip_tags($_POST["PROP"][$field_code]),ENT_QUOTES))?>" class="input-large">
            <?endif?>
        </div>
	<?
        if($arParams["PROPERTY_TIME"]==$field_code) echo"</div>";
    endforeach;?>
	<?if (isset($arResult["CAP_CODE"])):?>
		<div class="form-group">
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialchars($arResult["CAP_CODE"])?>" width="180" height="40">
				<input type="hidden" name="CAPTCHA_SID" value="<?=htmlspecialchars($arResult["CAP_CODE"])?>">
		</div>
		<div class="form-group">
			<label><?=GetMessage("SIMAI_FORM_CAPTCHA_INPUT")?><span style="color:red">*</span></label>
            <input class="form-control" type="text" name="CAPTCHA_WORD" maxlength="50" value="">
		</div>
	<?endif;?>
    <div class="noJSForm">
        <input type="hidden" name="js" value=""/>
    </div>

            <input type="hidden" value="Y" name="FB_SUBMIT_<?=$arResult["AJAX_ID"]?>"/>
            <button type="submit" class="btn btn-block btn-base btn-icon fa-check" ><span><?=GetMessage("SIMAI_FORM_SEND")?></span></button>


<?
    endif;
if ($_POST["FB_SUBMIT_".$arResult["AJAX_ID"]] && $_POST["ajax"] == "y"):
	exit();
endif;?>
</div>
</form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->