<style>
	.tab-content.fix-299{
		padding: 0 !important;
		/* padding-top: 10px !important; */
	}

	.social-tabs .tab-pane{
		padding: 0 !important;
	}
</style>


<?
$key=0;
?>
<div class="wp-tabs social-tabs">
    <ul class="nav nav-tabs nav-justified">
		<?if(COption::GetOptionString($GLOBALS["moduleName"], "vk_widget", "")=="Y"):
			$key += 1; 
			$vk = $key;
			?>
			<li class="<?=($key==1 ? "active" : "")?>"><a href="#tab5-<?=$key?>" data-toggle="tab"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
		<?endif;?>
		<?if(COption::GetOptionString($GLOBALS["moduleName"], "fb_widget", "")=="Y"):
			$key += 1;
			$fb = $key;
			?>
			<li class="<?=($key==1 ? "active" : "")?>"><a href="#tab5-<?=$key?>" data-toggle="tab"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
		<?endif;?>	
		<?if(COption::GetOptionString($GLOBALS["moduleName"], "tw_widget", "")=="Y"):
			$key += 1;
			$tw = $key;
			?>
			<li class="<?=($key==1 ? "active" : "")?>"><a href="#tab5-<?=$key?>" data-toggle="tab"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
		<?endif;?>	
		<?if(COption::GetOptionString($GLOBALS["moduleName"], "ok_widget", "")=="Y"):
			$key += 1;
			$ok = $key;
			?>
			<li class="<?=($key==1 ? "active" : "")?>"><a href="#tab5-<?=$key?>" data-toggle="tab"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></a></li>
		<?endif;?>			
    </ul>
    <div class="tab-content fix-299" style="min-height: 400px">
		<?if(COption::GetOptionString($GLOBALS["moduleName"], "vk_widget", "")=="Y"):?>
			<div class="tab-pane <?=($vk==1 ? "active" : "")?>" id="tab5-<?=$vk?>">
				<script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script> <!-- VK Widget -->
				<div id="vk_groups"></div>
				<script type="text/javascript">
					VK.Widgets.Group("vk_groups", {mode: 0, width: "360", height: "400", color1: 'FFFFFF', color2: '333', color3: 'f9a30e'}, <?=COption::GetOptionString($GLOBALS["moduleName"], "vk_id", "")?>);
				</script>
			</div>
		<?endif;?>
		<?if(COption::GetOptionString($GLOBALS["moduleName"], "fb_widget", "")=="Y"):?>
			<div class="tab-pane <?=($fb==1 ? "active" : "")?>" id="tab5-<?=$fb?>">
			<iframe src="https://www.facebook.com/plugins/page.php?href=<?=COption::GetOptionString($GLOBALS["moduleName"], "fb_address", "")?>&tabs=timeline&
			width=360&height=400&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="360" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
			</div>
		<?endif;?>	
		<?if(COption::GetOptionString($GLOBALS["moduleName"], "tw_widget", "")=="Y"):?>
			<div class="tab-pane pre-scrollable p-15<?=($tw==1 ? "active" : "")?>" id="tab5-<?=$tw?>" style="width: 360px">
				<a class="twitter-timeline" href="<?=COption::GetOptionString($GLOBALS["moduleName"], "tw_address", "")?>"></a> 
			<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
		<?endif;?>		
		<?if(COption::GetOptionString($GLOBALS["moduleName"], "ok_widget", "")=="Y"):?>
			<div class="tab-pane p-15<?=($ok==1 ? "active" : "")?>" id="tab5-<?=$ok?>">
				<div id="ok_group_widget" style="min-height: 380px"></div>
				<script>
					!function (d, id, did, st) {
					  var js = d.createElement("script");
					  js.src = "https://connect.ok.ru/connect.js";
					  js.onload = js.onreadystatechange = function () {
					  if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
						if (!this.executed) {
						  this.executed = true;
						  setTimeout(function () {
							OK.CONNECT.insertGroupWidget(id,did,st);
						  }, 0);
						}
					  }}
					  d.documentElement.appendChild(js);
					}(document,"ok_group_widget"," <?=COption::GetOptionString($GLOBALS["moduleName"], "ok_id", "")?>","{width:360,height:400}");
				</script>
			</div>
		<?endif;?>
	</div>
</div>



