<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<script type="text/javascript">
 function show(obj,what)
 {
  if (document.getElementById(obj).style.display == 'none') document.getElementById(obj).style.display = 'block';
  else document.getElementById(obj).style.display = 'none';

  var element$=$(what).children();
  if(element$<1)return false;
  if (element$.attr("class") == "fa fa-plus-square") {
        element$.attr("class","fa fa-minus-square")
  }
  else {
        element$.attr("class","fa fa-plus-square")
	}

element$.blur();
}
</script>
<div class="pull-left" id="block_structure">
<?



$margin_subtree = 15; // величина отступа у каждого следующего уровня древа

$SECTION_ID = $arResult["SECTION_ID"];

$min_depth = 999;
$current_depth = 0;
$current_id = 0;
$i = 0;

foreach ($arResult["SECTIONS"] as $sid=>$section)
{
 $i++;
 if (($section["DEPTH_LEVEL"] > $current_depth) and ($i > 1))
 {
  $arResult["SECTIONS"][$current_id]["tree"] = '+';
 }
 $current_depth = $section["DEPTH_LEVEL"];
 $current_id = $sid;
  if ($section["DEPTH_LEVEL"] < $min_depth) $min_depth = $section["DEPTH_LEVEL"];
}

$current_depth = 0;
$i = 0;

foreach ($arResult["SECTIONS"] as $section)
{
 $i++;
 if (($section["DEPTH_LEVEL"] < $current_depth) and ($i > 1))
 {
  $close_count = $current_depth - $section["DEPTH_LEVEL"];
  for ($j = 1; $j <= $close_count; $j++)
  {
   ?>
   </div>
   <?
  }
 }
 $current_depth = $section["DEPTH_LEVEL"];
 echo "<div style='margin-left:".(($current_depth - $min_depth) * $margin_subtree)."px'>";

 if ($section["tree"] == "+")
 {
  if (in_array($section["ID"],$arResult["chain_sections"]))
   $show_sub_current = 'minus-square';
  else
   $show_sub_current = 'plus-square';
  ?>
  <div>
  <table >
  <tr><td style="width: 20px;"><a onclick="show('sub<?=$i?>',this)" href="javascript:void(0);"><i class="fa fa-<?=$show_sub_current?>"></i></a></td><td>
  <?
 }
 else
 {
  ?>
  <div>
   <table>
  	<tr><td style="width: 20px;"></td><td>
  <?
 }
 if ($section["ID"] == $SECTION_ID)
 {
  echo "<a href='".$section['SECTION_PAGE_URL']."'><i class='fa fa-angle-right'></i> ".$section['NAME']."</a>";
  if ($arParams['COUNT_ELEMENTS'])
   echo " (".$section["ELEMENT_CNT"].")";
 }
 else
 {
  echo "<span class='b-section-list-element'><a href='".$section['SECTION_PAGE_URL']."'>".$section['NAME']."</a></span>";
  if ($arParams['COUNT_ELEMENTS'])
   echo " (".$section["ELEMENT_CNT"].")";
 }
 ?>
 </td></tr></table>

 </div>
 </div>
 <?
 if ($section["tree"] == "+")
 {
  if (in_array($section["ID"],$arResult["chain_sections"]))
   $show_sub_current = 'block';
  else
   $show_sub_current = 'none';
  ?>
  <div id='sub<?=$i?>' style="display: <?=$show_sub_current?>">
  <?
 }

}

if ($current_depth > max($arResult["SECTION"]["DEPTH_LEVEL"],1))
{
 $close_count = $current_depth - max($arResult["SECTION"]["DEPTH_LEVEL"],1);
 for ($j = 1; $j <= $close_count; $j++)
 {
  ?>
  </div>
  <?
 }
}
?>
</div>