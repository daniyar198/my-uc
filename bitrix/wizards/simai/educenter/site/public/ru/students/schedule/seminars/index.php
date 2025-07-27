<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Расписание семинаров");
?><?$APPLICATION->IncludeComponent("bitrix:catalog.filter", "seminar", Array(
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",	// Имя выходящего массива для фильтрации
		"IBLOCK_ID" => "#shedule_sem#",	// Инфоблок
		"IBLOCK_ID_COURSE" => "#seminars#",
		"IBLOCK_TYPE" => "organization",	// Тип инфоблока
		"LIST_HEIGHT" => "5",	// Высота списков множественного выбора
		"NUMBER_WIDTH" => "5",	// Ширина полей ввода для числовых интервалов
		"PAGER_PARAMS_NAME" => "arrPager",	// Имя массива с переменными для построения ссылок в постраничной навигации
		"PRICE_CODE" => "",	// Тип цены
		"PROPERTY_CODE" => array(	// Свойства
			0 => "COURSE",
			1 => "",
		),
		"SAVE_IN_SESSION" => "N",	// Сохранять установки фильтра в сессии пользователя
		"TEXT_WIDTH" => "20",	// Ширина однострочных текстовых полей ввода
		"COMPONENT_TEMPLATE" => "course"
	),
	false
);?>
<?
 if(!isset($GLOBALS['arrFilter']))
	  $GLOBALS['arrFilter']=array();
 if(isset($_REQUEST["DATE_START"]) || isset($_REQUEST["DATE_END"])){
	 
	if(isset($_REQUEST["DATE_START"])&&$_REQUEST["DATE_START"]!="")
	    $GLOBALS['arrFilter'][">=PROPERTY_DATE"] = ConvertDateTime($_REQUEST["DATE_START"], "YYYY-MM-DD");
	
	if(isset($_REQUEST["DATE_END"])&&$_REQUEST["DATE_END"]!="")
	 $GLOBALS['arrFilter']["<=PROPERTY_DATE"] = ConvertDateTime($_REQUEST["DATE_END"], "YYYY-MM-DD");
 }
 else
   $GLOBALS['arrFilter'][">PROPERTY_DATE"] = ConvertDateTime(date('d.m.Y'), "YYYY-MM-DD");
?>

<div class="wp-tabs">
	<div class="row">
		<div class="tabs-framed">
			<ul class="tabs clearfix">
				<li class="active"><a data-toggle="tab" href="#future">Будущие</a></li>
				<li><a data-toggle="tab" href="#present">Текущие</a></li>
			</ul>
			<div class="tab-content">
				<div id="future" class="tab-pane fade in active">



<?$APPLICATION->IncludeComponent("bitrix:news.list", "schedule_table_seminar", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "#shedule_sem#",	// Код информационного блока
		"IBLOCK_TYPE" => "organization",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "100",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => "boomerang",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "DATE",
			1 => "PRICE",
			2 => "DISCOUNT",
			3 => "HOUR",
			4 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "PROPERTY_DATE",	// Поле для первой сортировки новостей
		"SORT_BY2" => "",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"COMPONENT_TEMPLATE" => "schedule_table"
	),
	false
);?>

</div>
    <div id="present" class="tab-pane fade">
	<?
	 $GLOBALS['arrFilterPresent']["<PROPERTY_DATE"] = ConvertDateTime(date('d.m.Y'), "YYYY-MM-DD");
	 $GLOBALS['arrFilterPresent'][">PROPERTY_DATE_END"] = ConvertDateTime(date('d.m.Y'), "YYYY-MM-DD");
	  if(isset($_REQUEST["arrFilter_pf"])){
		 
		 foreach($_REQUEST["arrFilter_pf"] as $code => $val):
		   $GLOBALS['arrFilterPresent']["PROPERTY_".$code] = $val;
		 endforeach;
	 }
	?>
	
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"schedule_table_seminar",
			Array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"COMPONENT_TEMPLATE" => "schedule_table_seminar",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(0=>"",1=>"",),
				"FILTER_NAME" => "arrFilterPresent",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "#shedule_sem#",
				"IBLOCK_TYPE" => "organization",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "100",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "boomerang",
				"PAGER_TITLE" => "",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(0=>"DATE",1=>"PRICE",2=>"DISCOUNT",3=>"HOUR",4=>"",5=>"",),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "Y",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "PROPERTY_DATE",
				"SORT_BY2" => "",
				"SORT_ORDER1" => "ASC",
				"SORT_ORDER2" => "",
				"STRICT_SECTION_CHECK" => "N"
			)
		);?>
   </div>
   
   </div>
   </div>  
  </div> 
 </div>	

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>