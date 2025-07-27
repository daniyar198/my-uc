<?if(COption::GetOptionString($GLOBALS["moduleName"], "fb_address", "")!=""):?>
     <a target="_blank" href="<?=COption::GetOptionString($GLOBALS["moduleName"], "fb_address", "")?>"><i class="fa fa-facebook"></i></a>
<?endif;?>

<?if(COption::GetOptionString($GLOBALS["moduleName"], "vk_address", "")!=""):?>
   <a target="_blank" href="<?=COption::GetOptionString($GLOBALS["moduleName"], "vk_address", "")?>"><i class="fa fa-vk"></i></a> 
<?endif;?>

<?if(COption::GetOptionString($GLOBALS["moduleName"], "ins_address", "")!=""):?>
  <a target="_blank" href="<?=COption::GetOptionString($GLOBALS["moduleName"], "ins_address", "")?>"><i class="fa fa-instagram"></i></a>
<?endif;?>

<?if(COption::GetOptionString($GLOBALS["moduleName"], "ok_address", "")!=""):?>
  <a target="_blank" href="<?=COption::GetOptionString($GLOBALS["moduleName"], "ok_address", "")?>"><i class="fa fa-odnoklassniki"></i></a>
<?endif;?>

<?if(COption::GetOptionString($GLOBALS["moduleName"], "tw_address", "")!=""):?>
  <a target="_blank" href="<?=COption::GetOptionString($GLOBALS["moduleName"], "tw_address", "")?>"><i class="fa fa-twitter"></i></a>
<?endif;?>