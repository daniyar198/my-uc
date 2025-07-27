<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	$seo = Array( 
        Array(
		     "IBLOCK_CODE" => "school_NEWS",
             "CODE" => "SECTION_META_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "school_NEWS",
             "CODE" => "SECTION_META_KEYWORDS",
             "TEMPLATE" => "раздел {=lower this.Name} {=iblock.Name} ",
		), 
        Array(
		     "IBLOCK_CODE" => "school_NEWS",
             "CODE" => "SECTION_META_DESCRIPTION",
             "TEMPLATE" => "{=this.PreviewText}",
		), 
        Array(
		     "IBLOCK_CODE" => "school_NEWS",
             "CODE" => "SECTION_PAGE_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "school_NEWS",
             "CODE" => "ELEMENT_META_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "school_NEWS",
             "CODE" => "ELEMENT_META_KEYWORDS",
             "TEMPLATE" => "{=lower this.Name} новость {=parent.Name} ",
		), 
        Array(
		     "IBLOCK_CODE" => "school_NEWS",
             "CODE" => "ELEMENT_PAGE_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "school_NEWS",
             "CODE" => "SECTION_DETAIL_PICTURE_FILE_ALT",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "school_NEWS",
             "CODE" => "SECTION_DETAIL_PICTURE_FILE_TITLE",
             "TEMPLATE" => "{=lower this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "school_NEWS",
             "CODE" => "SECTION_DETAIL_PICTURE_FILE_NAME",
             "TEMPLATE" => "{=lower this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "ARTICLES",
             "CODE" => "SECTION_META_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "ARTICLES",
             "CODE" => "SECTION_META_KEYWORDS",
             "TEMPLATE" => "раздел {=lower this.Name} {=iblock.Name} ",
		), 
        Array(
		     "IBLOCK_CODE" => "ARTICLES",
             "CODE" => "SECTION_META_DESCRIPTION",
             "TEMPLATE" => "{=this.PreviewText}",
		), 
        Array(
		     "IBLOCK_CODE" => "ARTICLES",
             "CODE" => "SECTION_PAGE_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "ARTICLES",
             "CODE" => "ELEMENT_META_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "ARTICLES",
             "CODE" => "ELEMENT_META_KEYWORDS",
             "TEMPLATE" => "{=lower this.Name} статья {=parent.Name} ",
		), 
        Array(
		    "IBLOCK_CODE" => "events",
             "CODE" => "SECTION_META_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		    "IBLOCK_CODE" => "events",
             "CODE" => "SECTION_META_KEYWORDS",
             "TEMPLATE" => "раздел {=lower this.Name} {=iblock.Name} ",
		), 
        Array(
		    "IBLOCK_CODE" => "events",
             "CODE" => "SECTION_META_DESCRIPTION",
             "TEMPLATE" => "{=this.PreviewText}",
		), 
        Array(
		    "IBLOCK_CODE" => "events",
             "CODE" => "SECTION_PAGE_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		    "IBLOCK_CODE" => "events",
             "CODE" => "ELEMENT_META_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		    "IBLOCK_CODE" => "events",
             "CODE" => "ELEMENT_META_KEYWORDS",
             "TEMPLATE" => "{=lower this.Name} новость {=parent.Name} ",
		), 
        Array(
		    "IBLOCK_CODE" => "events",
             "CODE" => "ELEMENT_PAGE_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		    "IBLOCK_CODE" => "events",
             "CODE" => "SECTION_DETAIL_PICTURE_FILE_ALT",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		    "IBLOCK_CODE" => "events",
             "CODE" => "SECTION_DETAIL_PICTURE_FILE_TITLE",
             "TEMPLATE" => "{=lower this.Name}",
		), 
        Array(
		    "IBLOCK_CODE" => "events",
             "CODE" => "SECTION_DETAIL_PICTURE_FILE_NAME",
             "TEMPLATE" => "{=lower this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "SERVICES",
             "CODE" => "SECTION_META_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "SERVICES",
             "CODE" => "SECTION_META_KEYWORDS",
             "TEMPLATE" => "раздел {=lower this.Name} {=iblock.Name} ",
		), 
        Array(
		     "IBLOCK_CODE" => "SERVICES",
             "CODE" => "SECTION_META_DESCRIPTION",
             "TEMPLATE" => "{=this.PreviewText}",
		), 
        Array(
		     "IBLOCK_CODE" => "SERVICES",
             "CODE" => "SECTION_PAGE_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "SERVICES",
             "CODE" => "ELEMENT_META_TITLE",
             "TEMPLATE" => "{=this.Name}",
		), 
        Array(
		     "IBLOCK_CODE" => "SERVICES",
             "CODE" => "ELEMENT_META_KEYWORDS",
             "TEMPLATE" => "{=lower this.Name} услуга {=parent.Name} ",
		), 
        Array(
		     "IBLOCK_CODE" => "SERVICES",
             "CODE" => "ELEMENT_META_DESCRIPTION",
             "TEMPLATE" => "{=this.property.SHORT_DESCRIPTION}",
		),);
	?>