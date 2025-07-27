<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["SECTIONS"]);
if($countItems<1)return;?>

<script type="text/javascript">
  $(function(){
    $("#section").on("change",function(){
      if($("#section").val()!="")
      {
	   section=$("#section").val()+'/';
       window.location.href = "<?=$arParams["SEF_FOLDER"]?>"+section;
      }else window.location.href = "<?=$arParams["SEF_FOLDER"]?>";
     // console.log(section);
    }
   );
  });
</script>

<select id="section" class="form-control">
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

