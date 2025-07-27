<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
if($countItems<1)return;?>

<div>
 <div class="col-md-6">
    <select name="specialty" class="form-control">
        <option value=""><?=getMessage("NOT_CHOOSE")?></option>
    <?foreach($arResult["ITEMS"] as $cell=>$arElement):
    ?>
        <option value="<?=$arElement["ID"]?>"><?=$arElement["NAME"]?></option>

        <?endforeach?>
    </select>
	</div>
<div class="col-md-6">
	<select name="filial" class="form-control">
        <option value=""><?=getMessage("NOT_CHOOSE_FILIAL")?></option>
    <?foreach($arResult["FILIAL"] as $cell=>$arElement):
    ?>
        <option value="<?=$cell?>"><?=$arElement?></option>

    <?endforeach?>
    </select>

	</div>
</div>