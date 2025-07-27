<?
  require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
  use Bitrix\Main\Config as Conf;
  
  class SIMAIMain
  {
	//параметры цвет и ширина
	static function editStyle($color, $altcolor)
	{

		require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/simai.educenter/include/lessc.inc.php";	
		$mainColor=$color;
        $path=$_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/simai.educenter";
		$file = file_get_contents($path.'/framework/color/color.less', true);
		$oldColor = substr($file, strpos($file,'#'), strpos($file,';') - strpos($file,'#')); 
		$oldaltColor = substr($file, strpos($file,'@alt : #')+7, 7);
		$file=str_replace("@base : ".$oldColor,"@base : ".$mainColor, $file);
		$file=str_replace(trim("@alt : ".$oldaltColor),trim("@alt : ".$altcolor), $file);
		file_put_contents($path.'/framework/color/color.less',$file);	
		$less = new lessc;
        $less->checkedCompile($path.'/framework/color/color.less', $path.'/framework/color/color.css');
	}
	
	static function getModuleName()
	{
		$path=substr(__DIR__,0,strlen(__DIR__)-16);
		return substr($path,strripos($path,"/")+1,strlen($path));
	}
  }
  
?>