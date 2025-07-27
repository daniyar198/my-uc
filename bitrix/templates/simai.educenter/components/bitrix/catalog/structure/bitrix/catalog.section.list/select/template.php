<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["SECTIONS"]);
if($countItems<1)return;

?>

<?

?>
<div class="form-group row">
    <label for="section" class="col-md-3 control-label"><?=getMessage("SECTION_LABEL")?></label>
	<div class="col-md-9">
		<select id="section" name="structure" class="form-control mb-10">
			<option value=""><?=getMessage("NOT_CHOOSE")?></option>
		<?foreach($arResult["SECTIONS"] as $cell=>$arElement):
		?>
			<option value="<?=$arElement["CODE"]?>" <?if($arParams["ELEMENT_CODE"]==$arElement["CODE"]):?> selected <?endif?>>
			<?switch($arElement["DEPTH_LEVEL"])
			{
			  case 2:echo ".";break;
			  case 3:echo "..";break;
			  case 4:echo "...";break;
			  case 5:echo "....";break;
			}
			?>
			<?=$arElement["NAME"]?></option>
			<?endforeach?>
		</select>
		
		<select name="program" id="program" class="form-control mb-10">
         <option value=""><?=getMessage("NOT_CHOOSE_PROGRAM")?></option>
		 <?foreach($arResult["FILIAL"] as $cell=>$arElement):?>
			<option value="<?=$cell?>"><?=$arElement?></option>
		 <?endforeach?>
	  </select>
	</div>
</div>

