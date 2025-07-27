<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// настройки форм инфоблоков
// указывается символьный код инфоблока и настройки вкладок для класса CUserOptions
// вместо числовых идентификаторов свойств "PROPERTY_DATE" используются символьные "PROPERTY_ABC"
$ib_forms = Array(Array(
		"CODE" => "VACANCY",
		"TABS" => "edit1--#--Вакансия--,--ACTIVE--#--Активность--,--SORT--#--Сортировка--,--NAME--#--*Название--,--PROPERTY_SPECIALITY_DEMAND--#--Требования к специалисту--,--PROPERTY_SPECIALITY_REQUEST--#--Приветствуется--,--PROPERTY_RESPONSIBILITY--#--Обязанности--,--PROPERTY_CONDITIONS--#--Условия работы--;--",
	),Array(
		"CODE" => "REQUEST_VACANCY",
		"TABS" => "edit1--#--Заявка--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--SORT--#--Сортировка--,--PROPERTY_NAME--#--*Ваше имя--,--PROPERTY_POSITION--#--*Желаемая должность--,--PROPERTY_EXPERIENCE--#--Опыт работы--,--PROPERTY_PHONE0--#--*E-mail или Телефон--,--PROPERTY_PHONERESPONSIBILITY--#--Прикрепить резюме--;--",
	),
	
	array (
    'CODE' => 'organization',
    'TABS' => 'edit1--#--Специалист--,--ACTIVE--#--Активность--,--SORT--#--Сортировка--,--NAME--#--*ФИО--,--CODE--#--*Символьный код--,--PREVIEW_PICTURE--#--Фото--,--PROPERTY_USER--#--Пользователь--,--PROPERTY_POSITION--#--*Должность--,--PROPERTY_CHIEF--#--Руководитель--,--PROPERTY_ADMINISTRATION--#--Администрация--,--PROPERTY_SPECIALIST--#--Преподаватель--,--PROPERTY_EDUCATION--#--Образование--,--PROPERTY_QUALIFICATION--#--Квалификация--,--PROPERTY_DEGREE--#--Ученая степень--,--PROPERTY_RANK--#--Ученое звание--,--PROPERTY_RETRAINING--#--Повышение квалификации / Профессиональная переподготовка--,--PROPERTY_PRACTICE--#--Опыт работы--,--PROPERTY_EXPERIENCE--#--Общий стаж работы--,--PROPERTY_PROFEXPIRIENCE--#--Cтаж работы по специальности--,--PROPERTY_PHONE--#--Контактный телефон--,--PROPERTY_EMAIL--#--Адрес электронной почты--,--PROPERTY_DISCIPLINE--#--Дисциплины--,--PROPERTY_PROGRAM--#--Образовательные программы--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--',
   ),
	Array(
		"CODE" => "school_NEWS",
		"TABS" => "edit1--#--Новость--,--ACTIVE--#--Активность--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--NAME--#--*Название--,--CODE--#--*Символьный код--,--PROPERTY_HOME_NEWS--#--Главная страница--,--PROPERTY_YOUTUBE--#--Ссылка на YouTube--,--PREVIEW_PICTURE--#--Картинка--,--PROPERTY_MORE_PHOTO--#--Дополнительные фотографии--,--PREVIEW_TEXT--#--Описание для анонса--,--DETAIL_TEXT--#--Детальное описание--,--PROPERTY_FILE--#--*Документ--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--editPHONE--#--SEO--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--Шаблон META TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--Шаблон META KEYWORDS--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--Шаблон META DESCRIPTION--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--Заголовок элемента--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#----Настройки для картинок анонса элементов--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--Шаблон имени файла--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#----Настройки для детальных картинок элементов--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--Шаблон имени файла--,--SEO_ADDITIONAL--#----Дополнительно--,--TAGS--#--Теги--;--",
	),Array(
		"CODE" => "gallery",
		"TABS" => "edit1--#--Фотография--,--ACTIVE--#--Активность--,--SORT--#--Сортировка--,--NAME--#--*Название--,--CODE--#--Символьный код--,--PROPERTY_REAL_PICTURE--#--*Изображение--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--editPHONE--#--SEO--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--Шаблон META TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--Шаблон META KEYWORDS--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--Шаблон META DESCRIPTION--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--Заголовок элемента--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#----Настройки для картинок анонса элементов--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--Шаблон имени файла--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#----Настройки для детальных картинок элементов--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--Шаблон имени файла--,--SEO_ADDITIONAL--#----Дополнительно--,--TAGS--#--Теги--;--",
	),Array(
		"CODE" => "DOCUMENTS",
		'TABS' => 'edit1--#--Документ--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--NAME--#--*Название--,--SORT--#--Сортировка--,--IBLOCK_ELEMENT_PROP_VALUE--#----Значения свойств--,--PROPERTY_FILE--#--Документ--,--PROPERTY_LINKS_FILE--#--Ссылка на документ--;--cedit1--#--Подпись--,--PROPERTY_SHOW_SIGN--#--Выводить информацию о подписи--,--PROPERTY_DATE_SIGNED--#--Дата подписания--,--PROPERTY_SIGNATURE_FILE--#--Электронно-цифровая подпись--,--PROPERTY_CERTIFICATE--#--Электронно-цифровой сертификат--;--edit2--#--Разделы--,--SECTIONS--#--Разделы--;--',
	),Array(
		"CODE" => "AD",
		"TABS" => "edit1--#--Объявление--,--ACTIVE--#--Активность--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--NAME--#--*Название--,--CODE--#--*Символьный код--,--PREVIEW_TEXT--#--Текст--;--editPHONE--#--SEO--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--Шаблон META TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--Шаблон META KEYWORDS--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--Шаблон META DESCRIPTION--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--Заголовок элемента--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#----Настройки для картинок анонса элементов--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--Шаблон имени файла--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#----Настройки для детальных картинок элементов--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--Шаблон имени файла--,--SEO_ADDITIONAL--#----Дополнительно--,--TAGS--#--Теги--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--",
	),Array(
		"CODE" => "FAQ",
		"TABS" => "edit1--#--Вопрос--,--ACTIVE--#--Активность--,--SORT--#--Сортировка--,--ACTIVE_FROM--#--Дата--,--PROPERTY_TITLE--#--*Тема--,--NAME--#--*Вопрос--,--PREVIEW_TEXT--#--Ответ--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--editPHONE--#--SEO--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--Шаблон META TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--Шаблон META KEYWORDS--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--Шаблон META DESCRIPTION--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--Заголовок элемента--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#----Настройки для картинок анонса элементов--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--Шаблон имени файла--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#----Настройки для детальных картинок элементов--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--Шаблон имени файла--,--SEO_ADDITIONAL--#----Дополнительно--,--TAGS--#--Теги--;--",
	),Array(
		"CODE" => "FEEDBACK",
		"TABS" => "edit1--#--Заявка--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--PROPERTY_NAME--#--*Ваше имя--,--PROPERTY_PHONE--#--Телефон или E-mail--,--PROPERTY_MESSAGE--#--*Сообщение--,--PROPERTY_DOCUMENT--#--Документ--;--",
	),Array(
		"CODE" => "COMPANYES",
		"TABS" => "edit1--#--Компания--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--SORT--#--Сортировка--,--PREVIEW_PICTURE--#--Логотип--,--PROPERTY_PHONE--#--Телефон--,--PROPERTY_SITE--#--Адрес сайта--,--PREVIEW_TEXT--#--Описание--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--",
	),Array(
		"CODE" => "REVIEWS",
		"TABS" => "edit1--#--Отзыв--,--ACTIVE--#--Активность--,--SORT--#--Сортировка--,--NAME--#--*Название--,--PROPERTY_NAME--#--*Имя--,--PROPERTY_REVIEW--#--*Отзыв--;--editPHONE--#--SEO--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--Шаблон META TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--Шаблон META KEYWORDS--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--Шаблон META DESCRIPTION--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--Заголовок элемента--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#----Настройки для картинок анонса элементов--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--Шаблон имени файла--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#----Настройки для детальных картинок элементов--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--Шаблон имени файла--,--SEO_ADDITIONAL--#----Дополнительно--,--TAGS--#--Теги--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--",
	),Array(
		"CODE" => "banners_section",
		"TABS" => "edit1--#--Баннер--,--ACTIVE--#--Активность--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--SORT--#--Сортировка--,--NAME--#--*Название--,--PROPERTY_PICTURE--#--*Изображение--,--PROPERTY_LINK--#--Ссылка--;--",
	),Array(
		"CODE" => "BANNERS_INFO",
		"TABS" => "edit1--#--Баннер--,--ACTIVE--#--Активность--,--SORT--#--Сортировка--,--NAME--#--*Название--,--PROPERTY_PICTURE--#--*Изображение--,--PROPERTY_LINK--#--Ссылка--;--",
	),Array(
		"CODE" => "ARTICLES",
		"TABS" => "edit1--#--Статья--,--ACTIVE--#--Активность--,--SORT--#--Сортировка--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--NAME--#--*Название--,--CODE--#--*Символьный код--,--PREVIEW_PICTURE--#--Картинка--,--PREVIEW_TEXT--#--Описание--;--",
	),Array(
		"CODE" => "ROOMS",
		"TABS" => "edit1--#--Элемент--,--ACTIVE--#--Активность--,--SORT--#--Сортировка--,--NAME--#--*Название--,--CODE--#--*Символьный код--,--IBLOCK_ELEMENT_PROP_VALUE--#----Значения свойств--,--PROPERTY_RESPONSIBLE--#--Ответственный--,--PROPERTY_DISCIPLINE--#--Дисциплина--,--PREVIEW_PICTURE--#--Изображение для списка--,--DETAIL_PICTURE--#--Детальная картинка--,--DETAIL_TEXT--#--Описание--;--",
	),Array(
		"CODE" => "DISCIPLINE",
		"TABS" => "edit1--#--Дисциплина--,--ACTIVE--#--Активность--,--SORT--#--Сортировка--,--NAME--#--*Название--,--CODE--#--*Символьный код--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--editPHONE--#--SEO--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--Шаблон META TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--Шаблон META KEYWORDS--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--Шаблон META DESCRIPTION--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--Заголовок элемента--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#----Настройки для картинок анонса элементов--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--Шаблон имени файла--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#----Настройки для детальных картинок элементов--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--Шаблон имени файла--,--SEO_ADDITIONAL--#----Дополнительно--,--TAGS--#--Теги--;--",
	),Array(
		"CODE" => "OTHER_DOCUMENTS",
		'TABS' => 'edit1--#--Документ--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--NAME--#--*Название--,--SORT--#--Сортировка--,--IBLOCK_ELEMENT_PROP_VALUE--#----Значения свойств--,--PROPERTY_FILE--#--Документ--,--PROPERTY_LINKS_FILE--#--Ссылка на документ--;--cedit1--#--Подпись--,--PROPERTY_SHOW_SIGN--#--Выводить информацию о подписи--,--PROPERTY_DATE_SIGNED--#--Дата подписания--,--PROPERTY_SIGNATURE_FILE--#--Электронно-цифровая подпись--,--PROPERTY_CERTIFICATE--#--Электронно-цифровой сертификат--;--edit2--#--Разделы--,--SECTIONS--#--Разделы--;--',
	),Array(
		"CODE" => "branches",
		"TABS" => "edit1--#--Адрес--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--SORT--#--Сортировка--,--IBLOCK_ELEMENT_PROP_VALUE--#----Значения свойств--,--PROPERTY_ADDRESS--#--Адрес филиала--,--PROPERTY_PHONE--#--Телефон--,--PROPERTY_EMAIL--#--E-mail--,--PROPERTY_MAP--#--На карте--;--",
	),Array(
		"CODE" => "GREETINGS",
		"TABS" => "edit1--#--Благодарность--,--ACTIVE--#--Активность--,--NAME--#--*Адресат--,--CODE--#--*Символьный код--,--PROPERTY_DATE--#--Дата--,--SORT--#--Сортировка--,--PREVIEW_TEXT--#--Описание--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--",
	),Array(
		"CODE" => "educational",
		"TABS" => "edit1--#--Документ--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--SORT--#--Сортировка--,--PROPERTY_AUTHOR--#--Автор--,--PROPERTY_COURSE--#--Курс--;--",
	),Array(
		"CODE" => "video",
		"TABS" => "",
	),Array(
		"CODE" => "anti_cor_docs",
		'TABS' => 'edit1--#--Документ--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--NAME--#--*Название--,--SORT--#--Сортировка--,--IBLOCK_ELEMENT_PROP_VALUE--#----Значения свойств--,--PROPERTY_FILE--#--Документ--,--PROPERTY_LINKS_FILE--#--Ссылка на документ--;--cedit1--#--Подпись--,--PROPERTY_SHOW_SIGN--#--Выводить информацию о подписи--,--PROPERTY_DATE_SIGNED--#--Дата подписания--,--PROPERTY_SIGNATURE_FILE--#--Электронно-цифровая подпись--,--PROPERTY_CERTIFICATE--#--Электронно-цифровой сертификат--;--edit2--#--Разделы--,--SECTIONS--#--Разделы--;--',
	),Array(
		"CODE" => "events",
		"TABS" => "edit1--#--Мероприятие--,--ACTIVE--#--Активность--,--SORT--#--Сортировка--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--NAME--#--*Название--,--CODE--#--*Символьный код--,--PROPERTY_DATE--#--*Дата--,--IBLOCK_ELEMENT_PROP_VALUE--#----Значения свойств--,--PROPERTY_YOUTUBE--#--Ссылка на YouTube--,--PREVIEW_PICTURE--#--Картинка для анонса--,--PROPERTY_MORE_PHOTO--#--Дополнительные фотографии--,--PROPERTY_FILE--#--Документ--,--PREVIEW_TEXT--#--Описание для анонса--;--edit6--#--Подробно--,--DETAIL_PICTURE--#--Детальная картинка--,--DETAIL_TEXT--#--Детальное описание--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--editPHONE--#--SEO--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--Шаблон META TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--Шаблон META KEYWORDS--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--Шаблон META DESCRIPTION--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--Заголовок элемента--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#----Настройки для картинок анонса элементов--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--Шаблон имени файла--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#----Настройки для детальных картинок элементов--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--Шаблон ALT--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--Шаблон TITLE--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--Шаблон имени файла--,--SEO_ADDITIONAL--#----Дополнительно--,--TAGS--#--Теги--;--",
	),Array(
		"CODE" => "courses",
		"TABS" => "edit1--#--Курс--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--SORT--#--Сортировка--,--NAME--#--*Название--,--CODE--#--*Символьный код--,--PROPERTY_SPECIAL_OFFER--#--Спецпредложение--,--PROPERTY_POPULAR--#--Популярные--,--PROPERTY_SERVICE--#--Платные услуги--,--PROPERTY_DIRECTION--#--Направление--,--PROPERTY_FOR_WHOM--#--Для кого--,--PREVIEW_PICTURE--#--Картинка--,--PROPERTY_CAPTURE--#--Картинка для услуги--,--PROPERTY_SHORT_DESCRIPTION--#--Описание баннера--,--PREVIEW_TEXT--#--Описание--,--PROPERTY_PROGRAM--#--Программа--,--PROPERTY_REVIEWS--#--Отзывы--,--PROPERTY_TEACHERS--#--Преподаватели--,--PROPERTY_FORM--#--Стоимость--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--",
	),Array(
		"CODE" => "for-whom",
		"TABS" => "edit1--#--Элемент--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--SORT--#--Сортировка--,--PROPERTY_ICON--#--Иконка--,--PREVIEW_TEXT--#--Описание для анонса--;--",
	),Array(
		"CODE" => "share",
		"TABS" => "edit1--#--Акция--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--PROPERTY_DATE_FROM--#--Дата начала--,--ACTIVE_TO--#--Дата окончания--,--NAME--#--*Название--,--CODE--#--*Символьный код--,--SORT--#--Сортировка--,--PREVIEW_TEXT--#--Описание--,--PROPERTY_COURSE--#--Курсы--,--PROPERTY_SEMINAR--#--Семинары--;--",
	),Array(
		"CODE" => "consulting",
		"TABS" => "edit1--#--Услуга--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--CODE--#--*Символьный код--,--SORT--#--Сортировка--,--PREVIEW_PICTURE--#--Картинка--,--PROPERTY_CAPTURE--#--Картинка для услуги--,--PROPERTY_SHORT_DESCRIPTION--#--Описание баннера--,--PROPERTY_DESCRIPTION--#--Описание--,--PROPERTY_FORM--#--Форма обучения--,--PROPERTY_SERVICE--#--Платные услуги--;--",
	),Array(
		"CODE" => "shedule",
		"TABS" => "edit1--#--Элемент--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--NAME--#--*Форма обучения--,--PROPERTY_DATE--#--Дата--,--PROPERTY_DATE_END--#--Дата окончания--,--PROPERTY_TIME--#--Время обучения--,--PROPERTY_PLACE--#--Место проведения--,--PROPERTY_TEACHER--#--Преподаватель--,--PROPERTY_COURSE--#--Курс--;--",
	),Array(
		"CODE" => "seminars",
		"TABS" => "edit1--#--Семинар--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--NAME--#--*Название--,--CODE--#--*Символьный код--,--SORT--#--Сортировка--,--PROPERTY_POPULAR--#--Популярные--,--PROPERTY_SPECIAL_OFFER--#--Спецпредложение--,--PROPERTY_SERVICE--#--Платные услуги--,--PREVIEW_PICTURE--#--Картинка для анонса--,--PROPERTY_CAPTURE--#--Баннер--,--PROPERTY_SHORT_DESCRIPTION--#--Описание баннера--,--PROPERTY_FOR_WHOM--#--Для кого--,--PREVIEW_TEXT--#--Описание--,--PROPERTY_FORM--#--Форма обучения--,--PROPERTY_PROGRAM--#--Программа--,--PROPERTY_TEACHERS--#--Преподаватели--,--PROPERTY_REVIEWS--#--Отзывы--,--PROPERTY_DATES--#--Даты семинара--,--PROPERTY_DATE_FORM--#--Дата начала--;--editSPECIALITY_DEMAND--#--Разделы--,--SECTIONS--#--Разделы--;--",
	),Array(
		"CODE" => "shedule_sem",
		"TABS" => "edit1--#--Элемент--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--PROPERTY_COURSE--#--Семинар--,--PROPERTY_DATE--#--Дата--,--PROPERTY_DATE_END--#--Дата окончания--,--PROPERTY_TIME--#--Время обучения--,--PROPERTY_PLACE--#--Место проведения--,--PROPERTY_TEACHER--#--Преподаватель--;--",
	),Array(
		"CODE" => "sf-banner-main",
		"TABS" => "edit1--#--Баннер--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--SORT--#--Сортировка--,--NAME--#--*Название--,--IBLOCK_ELEMENT_PROPERTY--#--Значения свойств--,--IBLOCK_ELEMENT_PROP_VALUE--#----Подложка баннера--,--PROPERTY_BANNER_COLOR--#--Цвет фона--,--PROPERTY_BANNER_IMAGE--#--Фоновое изображение--,--PROPERTY_BANNER_VIDEO--#--Фоновое видео--,--edit1_csection1--#----Маска--,--PROPERTY_MASK_COLOR--#--Маска (цвет)--,--PROPERTY_MASK_OPACITY--#--Маска (прозрачность)--,--PROPERTY_MASK_PATTERN--#--Маска (узор)--,--edit1_csectionSPECIALITY_DEMAND--#----Ссылка на весь баннер--,--PROPERTY_BANNER_LINK--#--Баннер (ссылка)--;--cedit1--#--Контент--,--cedit1_csection1--#----Описание--,--PROPERTY_DESCRIPTION_TITLE--#--Описание (заголовок)--,--PROPERTY_DESCRIPTION_TITLE_COLOR--#--Описание (цвет заголовка)--,--PROPERTY_DESCRIPTION_TEXT--#--Описание (текст)--,--PROPERTY_DESCRIPTION_TEXT_COLOR--#--Описание (цвет текста)--,--PROPERTY_DESCRIPTION_POSITION--#--Описание (расположение)--,--PROPERTY_BUTTONS--#--Кнопки--,--cedit1_csectionSPECIALITY_DEMAND--#----Изображение--,--PROPERTY_IMAGE--#--Изображение (файл)--,--PROPERTY_IMAGE_POSITION--#--Изображение (выравнивание)--;--ceditSPECIALITY_DEMAND--#--Анимация--,--ceditSPECIALITY_DEMAND_csection1--#----Заголовок текста--,--PROPERTY_ANIMATE_TITLE_IN--#--Анимация заголовка (появление)--,--PROPERTY_ANIMATE_TITLE_DELAY--#--Анимация заголовка (задержка), мс--,--ceditSPECIALITY_DEMAND_csectionSPECIALITY_DEMAND--#----Текст--,--PROPERTY_ANIMATE_TEXT_IN--#--Анимация текста (появление)--,--PROPERTY_ANIMATE_TEXT_DELAY--#--Анимация текста (задержка), мс--,--ceditSPECIALITY_DEMAND_csectionSPECIALITY_REQUEST--#----Изображение--,--PROPERTY_ANIMATE_IMAGE_IN--#--Анимация изображения (появление)--,--PROPERTY_ANIMATE_IMAGE_DELAY--#--Анимация изображения (задержка), мс--,--ceditSPECIALITY_DEMAND_csectionRESPONSIBILITY--#----Кнопка--,--PROPERTY_ANIMATE_BUTTONS_IN--#--Анимация кнопок (появление)--,--PROPERTY_ANIMATE_BUTTONS_DELAY--#--Анимация изображения (задержка), мс--;--",
	),Array(
		"CODE" => "course_feedback",
		"TABS" => "",
	),Array(
		"CODE" => "seminar_feedback",
		"TABS" => "",
	),Array(
		"CODE" => "consult_feedback",
		"TABS" => "",
	),Array(
		"CODE" => "SERVICES",
		"TABS" => "",
	),
	Array(
		"CODE" => "error_content",
		"TABS" => "",
	),
	Array(
		"CODE" => "PRICE_LIST",
		"TABS" => "",
	),Array(
		"CODE" => "simai_client",
		"TABS" => "edit1--#--Клиент--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--ACTIVE_FROM--#--Начало активности--,--ACTIVE_TO--#--Окончание активности--,--NAME--#--*Название--,--CODE--#--Символьный код--,--SORT--#--Сортировка--,--IBLOCK_ELEMENT_PROP_VALUE--#----Значения свойств--,--PROPERTY_LINK--#--Адрес сайта--;--editCONDITIONS--#--Анонс--,--PREVIEW_PICTURE--#--Картинка для анонса--,--PREVIEW_TEXT--#--Описание для анонса--;--edit6--#--Подробно--,--DETAIL_PICTURE--#--Детальная картинка--,--DETAIL_TEXT--#--Детальное описание--;--",
	),Array(
		"CODE" => "metodical",
		"TABS" => "",
	),Array(
		"CODE" => "info",
		"TABS" => "edit1--#--Элемент--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--CODE--#--Символьный код--,--PROPERTY_COMPLEX--#--Поля--,--PROPERTY_DOCS--#--Документы--;--",
	),Array(
		"CODE" => "eduProgram",
		"TABS" => "edit1--#--Образовательная программа--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--SORT--#--Сортировка--,--PROPERTY_LEVEL--#--Уровень образования--,--PROPERTY_CODE--#--Код специальности, направления подготовки--,--PROPERTY_DESCRIPTION--#--Информация об описании образовательной программы--,--PROPERTY_PLAN--#--Информация об учебном плане--,--PROPERTY_ANNOUNCE--#--Информация об аннотации к рабочим программам дисциплин (по каждой дисциплине в составе образовательной программы)--,--PROPERTY_CALENDAR--#--Информация о календарном учебном графике--,--PROPERTY_METODICAL--#--Информация о методических и об иных документах, разработанных образовательной организацией для обеспечения образовательного процесса--,--PROPERTY_PRACTICE--#--Информация о практиках, предусмотренных соответствующей образовательной программой--;--",
	),
	Array(
		"CODE" => "payment",
		"TABS" => "edit1--#--Элемент--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--PROPERTY_CLIENT--#--Клиент--,--PROPERTY_NOMER--#--Номер счёта--,--PROPERTY_FIO--#--ФИО--,--PROPERTY_PRODUCT--#--Товар--,--PROPERTY_ADDITIONAL--#--Дополнительные поля--;--",
	),Array(
		"CODE" => "methods_paid",
		"TABS" => "edit1--#--Способ--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--CODE--#--Символьный код--,--SORT--#--Сортировка--,--PROPERTY_TYPE--#--*Тип плательщика--,--PROPERTY_FIELDS--#--Поля--;--",
	),
	
	 array (
		'CODE' => 'eduProgram',
		'TABS' => 'edit1--#--Образовательная программа--,--ID--#--ID--,--DATE_CREATE--#--Создан--,--TIMESTAMP_X--#--Изменен--,--ACTIVE--#--Активность--,--NAME--#--*Название--,--SORT--#--Сортировка--;--cedit1--#--Описание--,--DETAIL_TEXT--#--Описание--;--cedit2--#--Документы--,--PROPERTY_DOCS--#--Документы--;--',
	  ),
	  array (
		'CODE' => 'sf-certificate',
		'TABS' =>'editADDRESS--#--Элемент--,--ACTIVE--#--Активность--,--SORT--#--Сортировка--,--NAME--#--*ФИО--,--PROPERTY_WORK_POSITION--#--*Должность--,--PROPERTY_ORGANIZATION--#--*Организация--,--PROPERTY_RELEASED_BY--#--*Кем выдан--,--PROPERTY_DATE_VALIDITY_BEGIN--#--*Начало периода действия сертификата--,--PROPERTY_DATE_VALIDITY_END--#--*Конец периода действия сертификата--,--PROPERTY_SERIAL--#--*Серийный номер--;--',
	   )
	
	
	);

?>