<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!CModule::IncludeModule("iblock"))
	return;?>
<script>
/*$( "select" )
  .change(function() {
    $( "select option:selected" ).each(function() {
         $("#default_value").hide(); 	 
    });
   $( "#default" ).select(function() {
      $("#default_value").show();
   });
  });*/
    function Default()
	 {
	  if($("#SECTION_ID option:selected").val()!=-1) return true;
		else if($("#default_value").val()==""){
				alert("¬ведите название нового альбома");
				return false;
			}
	return true;
	 }
	$(function () {
		$( "#SECTION_ID" ).change(function() {
          if($(this).val()!=-1) $("#default_value").hide();
		   else $("#default_value").show();
	});
	<?if(isset($_REQUEST["SECTION_CODE"])):?> $("#default_value").hide();<?endif;?>
  });
	 
</script>
<form method="post" class="form-inline">
	<div class="row">
		<div class="col-md-12 mb-15">
			<div class="form-group">
				<label for="exampleInputEmail1"><?=getMessage("CHOOSE")?></label>
				<select name="SECTION_ID" id="SECTION_ID" class="form-control">
				<option id="default" value="-1"><?=getMessage("CREATE")?></option>
			<?
					$arSection = Array();
					$db_section = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" =>$arParams["IBLOCK_ID"]),array("ID","CODE","NAME") );
					while($arRes = $db_section->Fetch()): ?>
					  <option value="<?=$arRes["ID"]?>" <?if($arRes["CODE"]==$_REQUEST["SECTION_CODE"]):?> selected <?endif;?>><?=$arRes["NAME"]?></option><?
					endwhile;
			?>
			   </select>
			</div>
			<div class="form-group">
				<input type="text" id="default_value" class="form-control" placeholder="<?=getMessage("NAME")?>" name="SECTION_NAME" size="40">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
		    <div class="form-group">
			    <label for="NAME"><?=getMessage("NAME_VIDEO")?></label>
				<input type="text" class="form-control" placeholder="<?=getMessage("NAME_VIDEO")?>" name="NAME" size="40">
			</div>
			 <br><br>
			<div class="form-group">
			    <label for="NAME"><?=getMessage("LINK")?></label>
				<input type="text" class="form-control" placeholder="<?=getMessage("LINK")?> (youtube)" name="LINK" size="40">
			</div>
            <br>
			<input type="submit" class="btn btn-base mt-20"  OnClick="return Default()">
		</div>
	</div>			
</form>