<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?include_once (__DIR__.'/include.php');?>
<style>
.list-group-item{
		overflow: hidden;
}
</style>
<script type="text/javascript">
  		$(function() {
        var defaultData = [
		<?
		$TOP_DEPTH = $arResult["SECTIONS"][0]["DEPTH_LEVEL"];
        $CURRENT_DEPTH = $TOP_DEPTH;
		foreach($arResult["SECTIONS"] as $key=>$arSection):?>
			<?if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"]):?>
			  nodes: [
			<?elseif($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"]):?>
		},]},
			 <?elseif($key!=0):?>
			 },
			<?endif;?>
		    {
            text: '<?=$arSection["NAME"]?>',
            href: '<?=$arSection["SECTION_PAGE_URL"]?>',
            tags: ['<?=$arSection["ELEMENT_CNT"]?>'],
           
          <?$CURRENT_DEPTH =$arSection["DEPTH_LEVEL"];?>
        <?endforeach;?>
         <?if($CURRENT_DEPTH==$TOP_DEPTH){?>
			}
		 <?}?>
		<?while($CURRENT_DEPTH>$TOP_DEPTH){?>
			}]},
		 <?$CURRENT_DEPTH--;
		 }?>
	];
        $('#treeview').treeview({
          data: defaultData,
		  enableLinks:true,
		  showTags:true
        });
		});
 </script>
 <div id="treeview" class=""></div>