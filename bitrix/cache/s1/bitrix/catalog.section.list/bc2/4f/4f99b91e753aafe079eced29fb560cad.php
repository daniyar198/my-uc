<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001753593611';
$dateexpire = '001789593611';
$ser_content = 'a:2:{s:7:"CONTENT";s:645:"
<script type="text/javascript">
  $(function(){
    $("#section").on("change",function(){
      if($("#section").val()!="")
      {
	   section=$("#section").val()+\'/\';
       window.location.href = "/seminar/"+section;
      }else window.location.href = "/seminar/";
    }
   );
  });
</script>
<div class="form-group row">
    <label for="section" class="col-md-3 control-label">Выберите направление</label>
	<div class="col-md-9">
		<select id="section" name="section" class="form-control">
			<option value="">Все</option>
					<option value="seminary" >
						Семинары</option>
					</select>
	</div>
</div>

";s:4:"VARS";a:2:{s:8:"arResult";a:2:{s:14:"SECTIONS_COUNT";i:1;s:7:"SECTION";a:2:{s:2:"ID";i:0;s:11:"DEPTH_LEVEL";i:0;}}s:18:"templateCachedData";a:1:{s:9:"frameMode";b:1;}}}';
return true;
?>