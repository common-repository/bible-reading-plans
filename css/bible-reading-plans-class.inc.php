<?php

class BibleReadingPlans {
	/*	Shortcodes of the form [bible-reading-plan reading_plan="mcheyne" source="DBP" version="ESV"] are replaced 
		by the Scriptures from a Bible Reading Plan for the date selected.
	 */
	 /* This needs to be broken up into much smaller sections of code. */
	 
// NOTE THAT THE COPYRIGHT NOTICE FROM THE SOURCE OF THE TEXT MUST BE KEPT ON THE PAGE.
	
	protected $abs_api_key	     	= '';
	protected $abs_key_length	 	= 32;
	protected $abs_copyright     	= '';
	protected $abs_language_id	 	= '';
	protected $abs_language_ids	 	= array('eng',);
	protected $abs_sctr_src_url	 	= '<a href="https://scripture.api.bible/" target="_blank">American Bible Society API</a>';
	protected $abs_url_base		 	= 'https://api.scripture.api.bible/v1/bibles';
	protected $abs_vers_default  	= array(
										"ASV" 	=> array(
														"name"	=> "American Standard Version",
														"id"	=> "06125adad2d5898a-01",
														),
										"DRA" 	=> array(
														"name"	=> "Douay-Rheims American 1899",
														"id"	=> "179568874c45066f-01",
														),
										"EMTV" 	=> array(
														"name"	=> "English Majority Text Version",
														"id"	=> "55ec700d9e0d77ea-01",
														),
										"GNV" 	=> array(
														"name"	=> "Geneva Bible",
														"id"	=> "c315fa9f71d4af3a-01",
														),
										"OJPS" 	=> array(
														"name"	=> "JPS TaNaKH 1917 (Old Testament only)",
														"id"	=> "bf8f1c7f3f9045a5-01",
														),
										"KJV-E" 	=> array(
														"name"	=> "King James (Authorised) Version, Ecumenical",
														"id"	=> "de4e12af7f28f599-01",
														),
										"KJV-P" 	=> array(
														"name"	=> "King James (Authorised) Version, Protestant",
														"id"	=> "de4e12af7f28f599-02",
														),
										"RV" 	=> array(
														"name"	=> "Revised Version 1885",
														"id"	=> "40072c4a5aba4022-01",
														),
										"T4T" 	=> array(
														"name"	=> "Translation for Translators",
														"id"	=> "66c22495370cdfc0-01",
														),
										"WEBBE-C" 	=> array(
														"name"	=> "World English Bible British Edition, Catholic",
														"id"	=> "7142879509583d59-02",
														),
										"WEBBE-E" 	=> array(
														"name"	=> "World English Bible British Edition, Ecumenical",
														"id"	=> "7142879509583d59-01",
														),
										"WEBBE-O" 	=> array(
														"name"	=> "World English Bible British Edition, Orthodox",
														"id"	=> "7142879509583d59-03",
														),
										"WEBBE-P" 	=> array(
														"name"	=> "World English Bible British Edition, Protestant",
														"id"	=> "7142879509583d59-04",
														),
										"WEB-C" 	=> array(
														"name"	=> "World English Bible, Catholic",
														"id"	=> "9879dbb7cfe39e4d-02",
														),
										"WEB-E" 	=> array(
														"name"	=> "World English Bible, Ecumenical",
														"id"	=> "9879dbb7cfe39e4d-01",
														),
										"WEB-O" 	=> array(
														"name"	=> "World English Bible, Orthodox",
														"id"	=> "9879dbb7cfe39e4d-03",
														),
										"WEB-P" 	=> array(
														"name"	=> "World English Bible, Protestant",
														"id"	=> "9879dbb7cfe39e4d-04",
														),
										"WMB" 	=> array(
														"name"	=> "World Messianic Bible",
														"id"	=> "f72b840c855f362c-04",
														),
										"WMBBE" 	=> array(
														"name"	=> "World Messianic Bible British Edition",
														"id"	=> "04da588535d2f823-04",
														),
										"LXXup" 	=> array(
														"name"	=> "Brenton English 
											Septuagint (Updated Spelling and Formatting)",
														"id"	=> "6bab4d6c61b31b80-01",
														),
										"Brenton" 	=> array(
														"name"	=> "Brenton English translation of the Septuagint",
														"id"	=> "65bfdebd704a8324-01",
														),
										"KJVCPB" 	=> array(
														"name"	=> "Cambridge Paragraph Bible of the KJV",
														"id"	=> "55212e3cf5d04d49-01",
														),
										"FBV" 	=> array(
														"name"	=> "Free Bible Version",
														"id"	=> "65eec8e0b60e656b-01",
														),
										"F35" 	=> array(
														"name"	=> "The English New Testament According to Family 35",
														"id"	=> "2f0fd81d7b85b923-01",
														),
										); 
	protected $abs_versions		 	= array();
	protected $ajax_url          	= '';
	protected $api_request_err	 	= '';
	protected $bible_id		 		= '';
	// DBP v4 book_codes are the same as the abs_codes.
	protected $book_codes_names		= array('GEN' => 'Genesis',
											'EXO' => 'Exodus',
											'LEV' => 'Leviticus',
											'NUM' => 'Numbers',
											'DEU' => 'Deuteronomy',
											'JOS' => 'Joshua',
											'JDG' => 'Judges',
											'RUT' => 'Ruth',
											'1SA' => '1 Samuel',
											'2SA' => '2 Samuel',
											'1KI' => '1 Kings',
											'2KI' => '2 Kings',
											'1CH' => '1 Chronicles',
											'2CH' => '2 Chronicles',
											'EZR' => 'Ezra',
											'NEH' => 'Nehemiah',
											'EST' => 'Esther',
											'JOB' => 'Job',
											'PSA' => 'Psalms',
											'PRO' => 'Proverbs',
											'ECC' => 'Ecclesiastes',
											'SNG' => 'Song of Solomon',
											'ISA' => 'Isaiah',
											'JER' => 'Jeremiah',
											'LAM' => 'Lamentations',
											'EZK' => 'Ezekiel',
											'DAN' => 'Daniel',
											'HOS' => 'Hosea',
											'JOL' => 'Joel',
											'AMO' => 'Amos',
											'OBA' => 'Obadiah',
											'JON' => 'Jonah',
											'MIC' => 'Micah',
											'NAM' => 'Nahum',
											'HAB' => 'Habakkuk',
											'ZEP' => 'Zephaniah',
											'HAG' => 'Haggai',
											'ZEC' => 'Zechariah',
											'MAL' => 'Malachi',
											'1ES' => '1 Esdras',
											'2ES' => '2 Esdras',
											'TOB' => 'Tobit',
											'JDT' => 'Judith',
											'ESG' => 'Esther (Greek)',
											'WIS' => 'Wisdom',
											'SIR' => 'Ecclesiasticus',
											'BAR' => 'Baruch',
											'S3Y' => 'Song of the Three',
											'SUS' => 'Susanna',
											'BEL' => 'Bel and the Dragon',
											'MAN' => 'Manasseh',
											'1MA' => '1 Maccabees',
											'2MA' => '2 Maccabees',
											'MAT' => 'Matthew',
											'MRK' => 'Mark',
											'LUK' => 'Luke',
											'JHN' => 'John',
											'ACT' => 'Acts',
											'ROM' => 'Romans',
											'1CO' => '1 Corinthians',
											'2CO' => '2 Corinthians',
											'GAL' => 'Galatians',
											'EPH' => 'Ephesians',
											'PHP' => 'Philippians',
											'COL' => 'Colossians',
											'1TH' => '1 Thessalonians',
											'2TH' => '2 Thessalonians',
											'1TI' => '1 Timothy',
											'2TI' => '2 Timothy',
											'TIT' => 'Titus',
											'PHM' => 'Philemon',
											'HEB' => 'Hebrews',
											'JAS' => 'James',
											'1PE' => '1 Peter',
											'2PE' => '2 Peter',
											'1JN' => '1 John',
											'2JN' => '2 John',
											'3JN' => '3 John',
											'JUD' => 'Jude',
											'REV' => 'Revelation',
											);
	protected $book_codes_names_ap	= array(// Apocrypha
											'1ES' => '1 Esdras',
											'2ES' => '2 Esdras',
											'TOB' => 'Tobit',
											'JDT' => 'Judith',
											'ESG' => 'Esther (Greek)',
											'WIS' => 'Wisdom',
											'SIR' => 'Ecclesiasticus',
											'BAR' => 'Baruch',
											'S3Y' => 'Song of the Three',
											'SUS' => 'Susanna',
											'BEL' => 'Bel and the Dragon',
											'MAN' => 'Manasseh',
											'1MA' => '1 Maccabees',
											'2MA' => '2 Maccabees',
											);
	protected $bk_cds_dpp2_to_dbp4	= array('Gen'	 => 'GEN',
											'Exod'	 => 'EXO',
											'Lev'	 => 'LEV',
											'Num'	 => 'NUM',
											'Deut'	 => 'DEU',
											'Josh'	 => 'JOS',
											'Judg'	 => 'JDG',
											'Ruth'	 => 'RUT',
											'1Sam'	 => '1SA',
											'2Sam'	 => '2SA',
											'1Kgs'	 => '1KI',
											'2Kgs'	 => '2KI',
											'1Chr'	 => '1CH',
											'2Chr'	 => '2CH',
											'Ezra'	 => 'EZR',
											'Neh'	 => 'NEH',
											'Esth'	 => 'EST',
											'Job'	 => 'JOB',
											'Ps'	 => 'PSA',
											'Prov'	 => 'PRO',
											'Eccl'	 => 'ECC',
											'Song'	 => 'SNG',
											'Isa'	 => 'ISA',
											'Jer'	 => 'JER',
											'Lam'	 => 'LAM',
											'Ezek'	 => 'EZK',
											'Dan'	 => 'DAN',
											'Hos'	 => 'HOS',
											'Joel'	 => 'JOL',
											'Amos'	 => 'AMO',
											'Obad'	 => 'OBA',
											'Jonah'	 => 'JON',
											'Mic'	 => 'MIC',
											'Nah'	 => 'NAM',
											'Hab'	 => 'HAB',
											'Zeph'	 => 'ZEP',
											'Hag'	 => 'HAG',
											'Zech'	 => 'ZEC',
											'Mal'	 => 'MAL',
											'1Es'	 => '1ES',
											'2Es'	 => '2ES',
											'Tob'	 => 'TOB',
											'Jdt'	 => 'JDT',
											'EsG'	 => 'ESG',
											'Wis'	 => 'WIS',
											'Sir'	 => 'SIR',
											'Bar'	 => 'BAR',
											'S3Y'	 => 'S3Y',
											'Sus'	 => 'SUS',
											'Bel'	 => 'BEL',
											'Man'	 => 'MAN',
											'1Ma'	 => '1MA',
											'2Ma'	 => '2MA',
											'Matt'	 => 'MAT',
											'Mark'	 => 'MRK',
											'Luke'	 => 'LUK',
											'John'	 => 'JHN',
											'Acts'	 => 'ACT',
											'Rom'	 => 'ROM',
											'1Cor'	 => '1CO',
											'2Cor'	 => '2CO',
											'Gal'	 => 'GAL',
											'Eph'	 => 'EPH',
											'Phil'	 => 'PHP',
											'Col'	 => 'COL',
											'1Thess' => '1TH',
											'2Thess' => '2TH',
											'1Tim'	 => '1TI',
											'2Tim'	 => '2TI',
											'Titus'	 => 'TIT',
											'Phlm'	 => 'PHM',
											'Heb'	 => 'HEB',
											'Jas'	 => 'JAS',
											'1Pet'	 => '1PE',
											'2Pet'	 => '2PE',
											'1John'	 => '1JN',
											'2John'	 => '2JN',
											'3John'	 => '3JN',
											'Jude'	 => 'JUD',
											'Rev'	 => 'REV',
											);
	protected $book_names_ap	 	= array(); // Apocrypha
	protected $brp_prefix		 	= 'brp_';
	protected $calendar_in_text	 	= true;
	protected $cbrp_prefix		 	= 'cbrp_';
	protected $dam_id			 	= ''; 
	protected $date_format_js	 	= 'DD d MM yy';
	protected $date_format_php	 	= 'l j F Y';
	protected $dbp_api_key		 	= '';
	protected $dbp_default_bible_id	= array('ENG' => array('ENGESV' => 'English Standard Version®'),); // Overrides dynamic value.
	protected $dbp_exclude_media	= array('Dramatized Audio'				=> 'audio_drama',
											'Audio'							=> 'audio',
											'Video'							=> 'video_stream',
											'Audio HLS stream'				=> 'audio_stream',
											'Dramatized Audio HLS Stream'	=> 'audio_drama_stream',
											'USX Text Files'				=> 'text_usx',
											);
	protected $dbp_key_length_max	= 36;
	protected $dbp_key_length_min	= 36;
	protected $dbp_language_id	 	= 'ENG';
	protected $dbp_language_ids	 	= array();
	protected $dbp_language_iso	 	= 'eng';
	protected $dbp_lang_id2iso_alt 	= array();
	protected $dbp_lang_codes_excpt	= array('DEU' => 'GER', 'FRA' => 'FRN', 'TUR' => 'TRK',);
	protected $dbp_media_types	 	= array('Dramatized Audio'				=> 'audio_drama',
											'Audio'							=> 'audio',
											'Plain Text'					=> 'text_plain',
											'Formatted Text'				=> 'text_format',
											'Video'							=> 'video_stream',
											'Audio HLS stream'				=> 'audio_stream',
											'Dramatized Audio HLS Stream'	=> 'audio_drama_stream',
											'USX Text Files'				=> 'text_usx',
											'HTML Text Files'				=> 'text_html',
											);
	protected $dbp_query_string		= 'https://4.dbt.io/api/';
	protected $dbp_query_base	 	= 'v=4';
	protected $dbp_sctr_src_url	 	= '<a href="https://biblebrain.com/" target="_blank">Bible Brain (aka Digital Bible Platform) API</a>';
	protected $dbp_size_to_portions	= array();
	protected $dbp_vers_default	 	= array('ENG'  => array(
															'ESV' => 'English Standard Version',
															),
											);
	protected $dbp_versions		 	= array();
	protected $dev_screen_width	 	= 999;
	protected $display_plan_name 	= true;
	protected $display_toc			= false;
	protected $end_verse			= 999;
	protected $end_verse_name		= '';
	protected $err_flag			 	= '';
	protected $esv_api_key		 	= '';
	protected $esv_copyright	 	= '<a href="https://www.esv.org/" target="_blank">ESV</a>';
	protected $esv_key_length	 	= 40;
	protected $esv_language_id	 	= 'ENG';
	protected $esv_url_base		 	= 'https://api.esv.org/v3/passage/html/?include-headings=true&inline-styles=true&include-passage-references=true&include-chapter-numbers=true&include-first-verse-numbers=true&include-verse-numbers=true&include-audio-link=true&attach-audio-link-to=passage&include-short-copyright=false&include-footnotes=false&q=';
	protected $esv_vers_default	 	= array('ESV' => 'English Standard Version'); // Only the ESV
	protected $esv_sctr_src_url	 	= '<a href="https://api.esv.org/" target="_blank">ESV.org API</a>';
	protected $js_date_format	 	= 'DD d MM yy';
	protected $language				= 'ENG';
	protected $language_code 		= 'ENG'; // Legacy. Only used in versions prior to 2.0.
	protected $language_name		= 'English';
	protected $lng_code_iso			= 'eng';
	protected $lng_code_to_2_ltr_cd	= array('ENG' => 'en',);
	protected $lng_name_to_2_ltr_cd	= array(// Derived from https://raw.githubusercontent.com/datasets/language-codes/master/data/language-codes.csv
											'Afar'				=> 'aa',
											'Abkhazian'			=> 'ab',
											'Avestan'			=> 'ae',
											'Afrikaans'			=> 'af',
											'Akan'				=> 'ak',
											'Amharic'			=> 'am',
											'Aragonese'			=> 'an',
											'Arabic'			=> 'ar',
											'Assamese'			=> 'as',
											'Avaric'			=> 'av',
											'Aymara'			=> 'ay',
											'Azerbaijani'		=> 'az',
											'Bashkir'			=> 'ba',
											'Belarusian'		=> 'be',
											'Bulgarian'			=> 'bg',
											'Bihari'			=> 'bh',
											'Bislama'			=> 'bi',
											'Bambara'			=> 'bm',
											'Bengali'			=> 'bn',
											'Tibetan'			=> 'bo',
											'Breton'			=> 'br',
											'Bosnian'			=> 'bs',
											'Catalan'			=> 'ca',
											'Chechen'			=> 'ce',
											'Chamorro'			=> 'ch',
											'Corsican'			=> 'co',
											'Cree'				=> 'cr',
											'Czech'				=> 'cs',
											'Church Slavic'		=> 'cu',
											'Chuvash'			=> 'cv',
											'Welsh'				=> 'cy',
											'Danish'			=> 'da',
											'German'			=> 'de',
											'Maldivian'			=> 'dv',
											'Dzongkha'			=> 'dz',
											'Ewe'				=> 'ee',
											'Greek'				=> 'el',
											'English'			=> 'en',
											'Esperanto'			=> 'eo',
											'Spanish'			=> 'es',
											'Estonian'			=> 'et',
											'Basque'			=> 'eu',
											'Persian'			=> 'fa',
											'Fulah'				=> 'ff',
											'Finnish'			=> 'fi',
											'Fijian'			=> 'fj',
											'Faroese'			=> 'fo',
											'French'			=> 'fr',
											'Western Frisian'	=> 'fy',
											'Irish'				=> 'ga',
											'Gaelic'			=> 'gd',
											'Galician'			=> 'gl',
											'Guarani'			=> 'gn',
											'Gujarati'			=> 'gu',
											'Manx'				=> 'gv',
											'Hausa'				=> 'ha',
											'Hebrew'			=> 'he',
											'Hindi'				=> 'hi',
											'Hiri Motu'			=> 'ho',
											'Croatian'			=> 'hr',
											'Haitian'			=> 'ht',
											'Hungarian'			=> 'hu',
											'Armenian'			=> 'hy',
											'Herero'			=> 'hz',
											'Interlingua'		=> 'ia',
											'Indonesian'		=> 'id',
											'Interlingue'		=> 'ie',
											'Igbo'				=> 'ig',
											'Sichuan Yi'		=> 'ii',
											'Inupiaq'			=> 'ik',
											'Ido'				=> 'io',
											'Icelandic'			=> 'is',
											'Italian'			=> 'it',
											'Inuktitut'			=> 'iu',
											'Japanese'			=> 'ja',
											'Javanese'			=> 'jv',
											'Georgian'			=> 'ka',
											'Kongo'				=> 'kg',
											'Kikuyu'			=> 'ki',
											'Kuanyama'			=> 'kj',
											'Kazakh'			=> 'kk',
											'Kalaallisut'		=> 'kl',
											'Central Khmer'		=> 'km',
											'Kannada'			=> 'kn',
											'Korean'			=> 'ko',
											'Kanuri'			=> 'kr',
											'Kashmiri'			=> 'ks',
											'Kurdish'			=> 'ku',
											'Komi'				=> 'kv',
											'Cornish'			=> 'kw',
											'Kyrgyz'			=> 'ky',
											'Latin'				=> 'la',
											'Luxembourgish'		=> 'lb',
											'Ganda'				=> 'lg',
											'Limburgan'			=> 'li',
											'Lingala'			=> 'ln',
											'Lao'				=> 'lo',
											'Lithuanian'		=> 'lt',
											'Luba-Katanga'		=> 'lu',
											'Latvian'			=> 'lv',
											'Malagasy'			=> 'mg',
											'Marshallese'		=> 'mh',
											'Maori'				=> 'mi',
											'Macedonian'		=> 'mk',
											'Malayalam'			=> 'ml',
											'Mongolian'			=> 'mn',
											'Marathi'			=> 'mr',
											'Malay'				=> 'ms',
											'Maltese'			=> 'mt',
											'Burmese'			=> 'my',
											'Nauru'				=> 'na',
											'Norwegian'			=> 'nb',
											'Ndebele'			=> 'nd',
											'Nepali'			=> 'ne',
											'Ndonga'			=> 'ng',
											'Dutch'				=> 'nl',
											'Nynorsk'			=> 'nn',
											'Norwegian'			=> 'no',
											'Nouth Ndebele'		=> 'nr',
											'Navaho'			=> 'nv',
											'Chichewa'			=> 'ny',
											'Provençal'			=> 'oc',
											'Ojibwa'			=> 'oj',
											'Oromo'				=> 'om',
											'Oriya'				=> 'or',
											'Ossetian'			=> 'os',
											'Punjabi'			=> 'pa',
											'Pali'				=> 'pi',
											'Polish'			=> 'pl',
											'Pashto'			=> 'ps',
											'Portuguese'		=> 'pt',
											'Quechua'			=> 'qu',
											'Romansh'			=> 'rm',
											'Rundi'				=> 'rn',
											'Romanian'			=> 'ro',
											'Russian'			=> 'ru',
											'Kinyarwanda'		=> 'rw',
											'Sanskrit'			=> 'sa',
											'Sardinian'			=> 'sc',
											'Sindhi'			=> 'sd',
											'Northern Sami'		=> 'se',
											'Sango'				=> 'sg',
											'Sinhalese'			=> 'si',
											'Slovak'			=> 'sk',
											'Slovenian'			=> 'sl',
											'Samoan'			=> 'sm',
											'Shona'				=> 'sn',
											'Somali'			=> 'so',
											'Albanian'			=> 'sq',
											'Serbian'			=> 'sr',
											'Swati'				=> 'ss',
											'Sotho, Southern'	=> 'st',
											'Sundanese'			=> 'su',
											'Swedish'			=> 'sv',
											'Swahili'			=> 'sw',
											'Tamil'				=> 'ta',
											'Telugu'			=> 'te',
											'Tajik'				=> 'tg',
											'Thai'				=> 'th',
											'Tigrinya'			=> 'ti',
											'Turkmen'			=> 'tk',
											'Tagalog'			=> 'tl',
											'Tswana'			=> 'tn',
											'Tonga'				=> 'to',
											'Turkish'			=> 'tr',
											'Tsonga'			=> 'ts',
											'Tatar'				=> 'tt',
											'Twi'				=> 'tw',
											'Tahitian'			=> 'ty',
											'Uyghur'			=> 'ug',
											'Ukrainian'			=> 'uk',
											'Urdu'				=> 'ur',
											'Uzbek'				=> 'uz',
											'Venda'				=> 've',
											'Vietnamese'		=> 'vi',
											'Volapük'			=> 'vo',
											'Walloon'			=> 'wa',
											'Wolof'				=> 'wo',
											'Xhosa'				=> 'xh',
											'Yiddish'			=> 'yi',
											'Yoruba'			=> 'yo',
											'Zhuang'			=> 'za',
											'Chinese'			=> 'zh',
											'Zulu'				=> 'zu',
											);
	protected $loading_image	 	= '';
	protected $moveable_feasts	 	= array(
											'Ash Wednesday',
											'Maundy Thursday',
											'Good Friday',
											'Holy Saturday',
											'Easter Sunday',
											'Ascension Day',
											'Pentecost',
											);
	protected $no_versns_found				= '';
	protected $one_chapter_books 	= array('Obadiah',
											'Prayer of Manasseh',
											'Bel and the Dragon',
											'Susanna',
											'Prayer of Azariah',
											'Letter of Jeremiah',
											'Philemon',
											'2 John',
											'3 John',
											'Jude',
											); 
	protected $passage_header	 	= '';
	protected $php_date_format	 	= 'l j F Y';
	protected $plugin_url			= '';
	protected $poetic				= array('Job'				=> 'all', 
											'Psalms'			=> 'all', 
											'Proverbs'			=> 'all', 
											'Psalm'				=> 'all', 
											'Proverb'			=> 'all', 
											'Ecclesiastes'		=> 'all', 
											'Song of Solomon'	=> 'all',
											'Joel'				=> 'all',
											'Amos'				=> 'all',
											'Obadiah'			=> 'all',
											/*
											'2 Samuel'	=> array('22'	=> '2-51'),
											'2 Kings'	=> array('19'	=> '21b-28'),
											'Jeremiah'	=> array('13'	=> '15-27'),
											'Jeremiah'	=> array('12'	=> '1-13'),
											'Jeremiah'	=> array('23'	=> '9-15'),
											'Jeremiah'	=> array('23'	=> '18-22'),
											'Jeremiah'	=> array('25'	=> '30-38'),
											'Acts'		=> array('1'	=> '20'),
											'Acts'		=> array('2'	=> '16-21'),
											'Acts'		=> array('2'	=> '25-28'),
											'Acts'		=> array('2'	=> '34-35'),
											'Acts'		=> array('4'	=> '25b-26'),
											'Acts'		=> array('7'	=> '42b-43'),
											'Acts'		=> array('7'	=> '49-50'),
											'Acts'		=> array('13'	=> '33b'),
											'Acts'		=> array('13'	=> '34b'),
											'Acts'		=> array('13'	=> '35b'),
											'Acts'		=> array('13'	=> '41'),
											'Acts'		=> array('15'	=> '16-17'),
											'Acts'		=> array('17'	=> '28'),
											'Ephesians'	=> array('5'	=> '14b'),
											'Hebrews'	=> array('1'	=> '5-14'),
											'Hebrews'	=> array('2'	=> '5-8a'),
											'Hebrews'	=> array('2'	=> '12b-13'),
											'Hebrews'	=> array('3'	=> '7-11'),
											'Hebrews'	=> array('3'	=> '15b'),
											'Hebrews'	=> array('4'	=> '3b'),
											'Hebrews'	=> array('4'	=> '5b'), 
											'Hebrews'	=> array('4'	=> '7b'), 
											'Hebrews'	=> array('5'	=> '5-6'),
											'Hebrews'	=> array('7'	=> '17b'),
											'Hebrews'	=> array('7'	=> '21b'),
											'Hebrews'	=> array('8'	=> '8b-12'),
											'Hebrews'	=> array('10'	=> '5b-7'),
											'Hebrews'	=> array('10'	=> '16-17'),
											'Hebrews'	=> array('10'	=> '37b-38'),
											'Hebrews'	=> array('13'	=> '6b'),
											'1 Peter'	=> array('3'	=> '10-12'),
											'1 Peter'	=> array('4'	=> '18'),
											''	=> array(''	=> ''),
											*/
											);
	protected $powered_by		 	= 'Powered by the <a href="https://wordpress.org/extend/plugins/bible-reading-plans
	/" target="_blank" title="Bible Reading Plans">Bible Reading Plans</a> plugin for WordPress.';
	protected $reading_plan		 	= '';
	protected $reading_plans		= array();
	protected $show_poweredby	 	= false;
	protected $short_code_atts	 	= array(
											'bible_id' 		=> 'ENGESV',
											'language_code'	=> 'ENG',
										/*	'only_day' 		=> -1,*/
											'reading_plan' 	=> 'mcheyne',
											'source'		=> 'dbp',
											'version'		=> 'ESV',
											);
	protected $site_lang_default	= 'English';
	protected $site_language		= 'English';
	protected $scptr_src_prefix	 	= 'dbp_'; // default.
	protected $sources			 	= array(
											'ABS' => 'American Bible Society (API.Bible)',
											'DBP' => 'The Bible Brain aka Digital Bible Platform (DBP) version 4 (faithcomesbyhearing.com/bible-brain/developer-documentationfaithcomesbyhearing.com/audio-bible-resources/bible-brain)',
											'ESV' => 'English Standard Version (esv.org)',
											);
	protected $switch_cal_width  	= 480;
	protected $text_source		 	= '';
	protected $use_calendar			= false;
	protected $version				= '';
	
	public function __construct () {
		$this->plugin_url		= plugin_dir_url(__FILE__);
		foreach ($this->book_codes_names_ap as $key => $name) {
			$this->book_names_ap[] = $name;
		}
		$this->end_verse_name	= __('end', 'bible-reading-plans');
		$this->err_flag			= __('ERROR', 'bible-reading-plans');
		$this->api_request_err 	= __(' in request to API -- most probably due to a missing or incorrect API Key for ', 'bible-reading-plans');
		$this->text_source		= '<br />'.__('Scriptures provided by the ', 'bible-reading-plans');
		$this->no_versns_found	= __('No versions found.', 'bible-reading-plans');
		$search_prefixes		= array();
		$ary_key				= 0;
		foreach ($this->sources as $abrv => $src) {
			$source_prefix				 = strtolower($abrv).'_';
			$search_prefixes[$ary_key++] = $this->cbrp_prefix.$source_prefix;
			$search_prefixes[$ary_key++] = $this->brp_prefix.$source_prefix;
		}
		$this->move_readings_plans_arrays_to_database(); // If there are any reading plans arrays, move them to the database.
		$reading_plans_list = get_option('brp_reading_plans_list');
		if (is_array($reading_plans_list) && count($reading_plans_list)) {
			foreach ($reading_plans_list as $prefixed_shortcode => $plan_name) {
				// Remove prefixes.
				$shortcode	  = str_replace($search_prefixes, '', $prefixed_shortcode);
				$reading_plan = $this->translate_plan_names($shortcode);
				if ($reading_plan) {
					$this->reading_plans[$shortcode] = $reading_plan;
				} else {
					$this->reading_plans[$shortcode] = $plan_name;
				}
 			}
		}
		$this->loading_image = '<img title="Please wait until screen completes loading." class="brp_loading_img" src="'.$this->plugin_url.'images/ajax-loading.gif" />';
		
		$key = get_option('bible_reading_plans_abs_api_key');
		if ($key && $this->abs_key_length == strlen(trim($key))) {
            $this->abs_api_key	= $key;
			$abs_versions		= get_option('bible_reading_plans_abs_versions');
			if ($abs_versions && count($abs_versions)) {
				$this->abs_versions = $abs_versions;
			} else {
				$this->abs_versions	= $this->abs_vers_default;
			}
		} else {
			$this->abs_api_key	= '';
			$this->abs_versions = $this->return_api_error($this->err_flag.__(': Missing API Key for ABS', 'bible-reading-plans'));	
		}
		
		$key = get_option('bible_reading_plans_dbp_api_key');
		if ($key && (strlen(trim($key)) <= $this->dbp_key_length_max && strlen(trim($key)) >= $this->dbp_key_length_min)) {
            $this->dbp_api_key = $key;
		} else {
			// Try legacy dbp_api_key
			$key = get_option('bible_reading_plans_api_key');
			if ($key && (strlen(trim($key)) <= $this->dbp_key_length_max && strlen(trim($key)) >= $this->dbp_key_length_min)) {
				$this->dbp_api_key = $key;
				// Move legacy key to current key;
				update_option('bible_reading_plans_dbp_api_key', $key);
				delete_option('bible_reading_plans_api_key');
			} else {
				$this->dbp_api_key	= '';
			}
		}
		if ($this->dbp_api_key && (strlen(trim($this->dbp_api_key)) <= $this->dbp_key_length_max && strlen(trim($this->dbp_api_key)) >= $this->dbp_key_length_min)) {
  			$dbp_vers_default = get_option('bible_reading_plans_dbp_vers_default');
			if (isset($dbp_vers_default) && is_array($dbp_vers_default) && count($dbp_vers_default)) {
				$this->dbp_vers_default = $dbp_vers_default;
			} else {
				$this->dbp_vers_default	= $this->no_versns_found;
			}
			$dbp_versions = get_option('bible_reading_plans_dbp_versions');
			if (isset($dbp_versions) && is_array($dbp_versions) && count($dbp_versions)) {
				$this->dbp_versions = $dbp_versions;
			} else {
				$this->dbp_versions	= $this->dbp_vers_default;
			}
			$this->dbp_bible_id_to_iso	= get_option('bible_reading_plans_dbp_bible_id_to_iso');
			$this->lng_code_to_2_ltr_cd	= get_option('bible_reading_plans_lng_code_to_2_ltr_cd');
			$this->dbp_lang_id_to_iso	= get_option('bible_reading_plans_dbp_lang_id_to_iso');
			$this->dbp_lang_id2iso_alt	= get_option('bible_reading_plans_dbp_lang_id2iso_alt');
		} else {
			$this->dbp_api_key	= '';
			$this->dbp_versions = $this->return_api_error($this->err_flag.__(': Missing API Key for DBP', 'bible-reading-plans'));
		}
		
		$key = get_option('bible_reading_plans_esv_api_key');
		if ($key && $this->esv_key_length == strlen(trim($key))) {
			$this->esv_api_key	= $key;
			$this->esv_versions	= $this->esv_vers_default;
		} else {
			$this->esv_api_key	= '';
			$this->esv_versions = $this->return_api_error($this->err_flag.__(': Missing API Key for ESV', 'bible-reading-plans'));	
		}
		
		$this->dbp_query_base   .= "&key={$this->dbp_api_key}";
		
		$this->display_plan_name = get_option('bible_reading_plans_display_plan_name');
		if (false === $this->display_plan_name) {
			$this->display_plan_name = false;
			update_option('bible_reading_plans_display_plan_name', $this->display_plan_name);
		}
		$this->use_calendar		 = get_option('bible_reading_plans_use_calendar');
		if (false === $this->use_calendar) {
			$this->use_calendar = false;
			update_option('bible_reading_plans_use_calendar', $this->use_calendar);
		}
		$this->calendar_in_text	 = get_option('bible_reading_plans_calendar_in_text');
		if (false === $this->calendar_in_text) {
			$this->calendar_in_text = false;
			update_option('bible_reading_plans_calendar_in_text', $this->calendar_in_text);
		}
		$this->display_toc	 = get_option('bible_reading_plans_display_toc');
		if (false === $this->display_toc) {
			$this->display_toc = false;
			update_option('bible_reading_plans_display_toc', $this->display_toc);
		}
		$this->show_poweredby	 = get_option('bible_reading_plans_show_poweredby');
		if (false === $this->show_poweredby) {
			$this->show_poweredby = false;
			update_option('bible_reading_plans_show_poweredby', $this->show_poweredby);
		}
		$this->dbp_size_to_portions = array(
											'C'			=> '',
											'NT'		=> __('New Testament', 'bible-reading-plans'),
											'NTOTP'		=> __('New Testament, Old Testament Portion', 'bible-reading-plans'),
											'NTP'		=> __('New Testament Portion', 'bible-reading-plans'),
											'NTPOTP'	=> __('New Testament Portion, Old Testament Portion', 'bible-reading-plans'),
											'OT'		=> __('Old Testament', 'bible-reading-plans'),
											'OTNTP'		=> __('Old Testament, New Testament Portion', 'bible-reading-plans'),
											'OTP'		=> __('Old Testament Portion', 'bible-reading-plans'),
											'P'			=> __('Portion', 'bible-reading-plans'),
											'S'			=> __('Stories', 'bible-reading-plans'),
											);
		$this->ajax_url	= admin_url('admin-ajax.php', 'relative');
		add_shortcode('bible-reading-plan', array(&$this, 'shortcodeAttributes'));
	}

	public function addCSSAndScripts () {
		// Styles
		wp_register_style('bible-reading-plans-abs-scripture', $this->plugin_url.'css/brp-abs-scripture.css');
		wp_enqueue_style('bible-reading-plans-abs-scripture');
		wp_register_style('bible-reading-plans-abs-scripture-styles', $this->plugin_url.'css/brp-abs-scripture-styles.css');
		wp_enqueue_style('bible-reading-plans-abs-scripture-styles');
		wp_register_style('bible-reading-plans-esv-scripture-styles', $this->plugin_url.'css/brp-esv-scripture-styles.css');
		wp_enqueue_style('bible-reading-plans-esv-scripture-styles');
		wp_register_style('bible-reading-plans-jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
  		wp_enqueue_style('bible-reading-plans-jquery-ui');
		wp_register_style('bible-reading-plans-jquery-ui-smoothness', '//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css');
  		wp_enqueue_style('bible-reading-plans-jquery-ui-smoothness');
		wp_register_style('bible-reading-plans', $this->plugin_url.'css/bible-reading-plans.css', array('bible-reading-plans-abs-scripture', 'bible-reading-plans-esv-scripture-styles', 'bible-reading-plans-abs-scripture-styles', 'bible-reading-plans-jquery-ui',), null);
		wp_enqueue_style('bible-reading-plans');
		// Scripts
		wp_enqueue_script('jquery');
	}
	
	public function addLanguagesAndVersions () {
		$err_msg		= __('ERROR: Could not retrieve list of versions from the Bible Brain (aka the Digital Bible Platform) API', 'bible-reading-plans');
		$loading_image	= __('It takes a short while to load and process all of the required data from the Bible Brain (aka the Digital Bible Platform) API. Please wait.', 'bible-reading-plans').'<br />'.$this->loading_image;
		echo <<<EOS
			<script type="text/javascript" defer> 
				/* <![CDATA[ */
					var ajaxurl			= '{$this->ajax_url}';
					var err_msg 		= '{$err_msg}.';
					var loading_image	= '{$loading_image}';
					jQuery(document).ready(function($) {
						$('#brp-dbp-languages-and-versions').html(loading_image);
						$.ajax({
							timeout:	180000, // sets timeout to 3 minutes
							url:		ajaxurl,
							data: {
								action:	'put_languages_and_versions',
							},
							success: function (response) {
								$('#brp-dbp-languages-and-versions').html(response);
							},
							error: function () { 
								$('#brp-dbp-languages-and-versions').html(err_msg);
							}
						});
					});
				/* ]]> */ 
			</script>\n";
EOS;
	}
	
	public function addScriptureLoader () {
		if ('abs_' == $this->scptr_src_prefix) {
		echo '
			<script src="https://cdn.scripture.api.bible/fums/fumsv2.min.js"></script>';
		}
		$err_msg = __("TIMEOUT ERROR: Could not retrieve Scriptures from ");
		echo '
<script type="text/javascript" defer> 
	/* <![CDATA[ */';
		if ('abs_' == $this->scptr_src_prefix) {
			$err_msg .= $this->abs_sctr_src_url;
			echo "
			var ajaxurl = '{$this->ajax_url}';
			var err_msg = '{$err_msg}.';
			// Load Scriptures initially with the date set on the client's computer.
			var brp_date_obj = new Date();
			jQuery(document).ready(function($) {
				$.ajax({
					timeout:	50000, // sets timeout to 50 seconds
					url:		ajaxurl,
					data: {
						action:					'put_bible_reading_plan',
						reading_plan:			'{$this->reading_plan}',
						version:				'{$this->version}',
						source:					'ABS',
						requested_date:			brp_date_obj.toDateString(),					
						device_screen_width:	$(window).width(),
					},
					success: function (response) {
						$('#brp-scriptures').html(response);
					},
					error: function (response) { 
						$('#brp-scriptures').html(err_msg);
					},
				})
			});";
		} elseif ('dbp_' == $this->scptr_src_prefix) {
 			$err_msg .= $this->dbp_sctr_src_url;
			echo "
			var ajaxurl = '{$this->ajax_url}';
			var err_msg = '{$err_msg}.';
			// Load Scriptures initially with the date set on the client's computer.
			var brp_date_obj = new Date();
			jQuery(document).ready(function($) {
				$.ajax({
					timeout:	50000, // sets timeout to 50 seconds
					url:		ajaxurl,
					data: {
						action:					'put_bible_reading_plan',
						bible_id:				'{$this->bible_id}',
						language_code:			'{$this->language_code}',
						lng_code_iso:			'{$this->lng_code_iso}',
						reading_plan:			'{$this->reading_plan}',
						version:				'{$this->version}',
						source:					'DBP',
						requested_date:			brp_date_obj.toDateString(),					
						device_screen_width:	$(window).width(),
					},
					success: function (response) {
						$('#brp-scriptures').html(response);
					},
					error: function () { 
						$('#brp-scriptures').html(err_msg);
					}
				})
			});";
		} elseif ('esv_' == $this->scptr_src_prefix) {
 			$err_msg .= $this->esv_sctr_src_url;
			echo "
			var ajaxurl = '{$this->ajax_url}';
			var err_msg = '{$err_msg}.';
			// Load Scriptures initially with the date set on the client's computer.
			var brp_date_obj = new Date();
			jQuery(document).ready(function($) {
				$.ajax({
					timeout:	50000, // sets timeout to 50 seconds
					url:		ajaxurl,
					data: {
						action:					'put_bible_reading_plan',
						language_code:			'{$this->language_code}',
						reading_plan:			'{$this->reading_plan}',
						version:				'{$this->version}',
						source:					'ESV',
						requested_date:			brp_date_obj.toDateString(),					
						device_screen_width:	$(window).width(),
					},
					success: function (response) {
						$('#brp-scriptures').html(response);
					},
					error: function () { 
						$('#brp-scriptures').html(err_msg);
					}
				})
			});";
		}
		echo "
	/* ]]> */ 
</script>\n";
	}
		
	public function adminAddPage () {
		if (current_user_can('manage_options')) {
			add_options_page(__('Bible Reading Plans Settings', 'bible-reading-plans'), __('Bible Reading Plans', 'bible-reading-plans'), 'manage_options', 'bible_reading_plans_plugin', array(&$this, 'drawOptionsPage'));
		}
	}

	public function bibleReadingPlansAbsApiKeyValue () {
		echo '<input id="bible_reading_plans_abs_api_key_input" name="bible_reading_plans_abs_api_key" size="'.$this->abs_key_length.'" minlength="'.$this->abs_key_length.'" maxlength="'.$this->abs_key_length.'" type="text" value="'.$this->abs_api_key.'" />';
		echo '<div class="brp-access-key-note">&nbsp;&nbsp;';
		_e('To request an Access Key fill out the form at <a href="https://scripture.api.bible/signup/" target="_blank" title="API.Bible Registration">API.Bible Registration</a>. Then go to', 'bible-reading-plans');
		echo ' <a href="https://scripture.api.bible/admin/applications/new/" target="_blank" title="New Application">New Application</a>.';
		echo '<div class="brp-access-key-note-directions">';
		_e('Enter "Bible Reading Plans plugin for WordPress (https://wordpress.org/plugins/bible-reading-plans/) on our website" in the "Application Name" field and the other information the form requests.', 'bible-reading-plans');
		echo '</div><div class="brp-access-key-note-pointer">';
		_e('[The "DBL Token" is optional. It allows connection to the <a href="https://thedigitalbiblelibrary.org/" target="_blank" title="Digital Bible Library">Digital Bible Library (DBL)</a>. The DBl does, however, provide the potential for acquiring licenses for additional versions.]', 'bible-reading-plans');
		echo '</div></div>';
	}

	public function bibleReadingPlansDbpApiKeyValue () {
		echo '<input id="bible_reading_plans_dbp_api_key_input" name="bible_reading_plans_dbp_api_key" size="'.$this->dbp_key_length_max.'" minlength="'.$this->dbp_key_length_min.'" maxlength="'.$this->dbp_key_length_max.'" type="text" value="'.$this->dbp_api_key.'" />';
		echo '<div class="brp-access-key-note">&nbsp;&nbsp;';
		_e('To request an Access Key fill out the form at <a href="https://4.dbt.io/api_key/request?" target="_blank" title="Request Your API Key">Request Your API Key</a>.', 'bible-reading-plans');
		echo '<div class="brp-access-key-note-directions">';
		_e('Enter', 'bible-reading-plans');
		echo ' "The Access Key will be used in the Bible Reading Plans plugin for WordPress (https://wordpress.org/plugins/bible-reading-plans/) on our website" ';
		_e('(and any other information you feel is appropriate) in the "How will you use the key?" field.', 'bible-reading-plans');
		echo '</div>';
	}

	public function bibleReadingPlansDisplayPlanName () {
		echo '<input name="bible_reading_plans_display_plan_name" id="bible_reading_plans_display_plan_name_id" type="checkbox" value="1" class="code" '.checked(true, $this->display_plan_name, false).' />';
	}
	
	public function bibleReadingPlansDisplayToc () {
		echo '<input name="bible_reading_plans_display_toc" id="bible_reading_plans_display_toc_id" type="checkbox" value="1" class="code" '.checked(true, $this->display_toc, false).' />';
		_e('You may alter the appearance and location of the Table of Contents by overriding the styles of the "Table of Contents" and "Mobile" sections of the "css/bible-reading-plans.css" stylesheet.', 'bible-reading-plans');
	}
	
	public function bibleReadingPlansEsvApiKeyValue () {
		echo '<input id="bible_reading_plans_esv_api_key_input" name="bible_reading_plans_esv_api_key" size="'.$this->esv_key_length.'" minlength="'.$this->esv_key_length.'" maxlength="'.$this->esv_key_length.'" type="text" value="'.$this->esv_api_key.'" />';
		echo '<div class="brp-access-key-note">&nbsp;&nbsp;';
		_e('To request an Access Key <a href="https://my.crossway.org/account/register/" target="_blank" title="Create an Account">Create an Account</a> at Crossway. Then go to <a href="https://api.esv.org/account/create-application/" target="_blank" title="API.Bible Registration">Create an API Application</a>.', 'bible-reading-plans');
		echo '<div class="brp-access-key-note-directions">';
		_e('Enter', 'bible-reading-plans');
		echo ' "Bible Reading Plans plugin for WordPress (https://wordpress.org/plugins/bible-reading-plans/) on our website" ';
		_e('in the "Application Name" field and select the "Intended Use" in the dropdown field.', 'bible-reading-plans');
		echo '</div>';
	}

	public function bibleReadingPlansSectionHeading () {
		_e('', 'bible-reading-plans');
	}

	public function bibleReadingPlansShowPoweredByValue () {
		echo '<input name="bible_reading_plans_show_poweredby" id="bible_reading_plans_show_poweredby_id" type="checkbox" value="1" class="code" '.checked(true, $this->show_poweredby, false).' />';
	}
	
	public function bibleReadingPlansUseCalendarValue () {
		echo '<div class="brp-use-calendar"><input name="bible_reading_plans_use_calendar" id="bible_reading_plans_use_calendar_id" type="checkbox" value="1" class="code" '.checked(true, $this->use_calendar, false).' /></div>';
		echo '<div id="bible_reading_plans_calendar_in_text_id" class="brp-place-calendar" style="display: ';
		if ($this->use_calendar) {
			_e('inline', 'bible-reading-plans');
		} else {
			_e('none', 'bible-reading-plans');
		}
		echo ';">';
		echo '<div class="brp-in-text"><input name="bible_reading_plans_calendar_in_text" type="radio" value=1 class="code" ';
		if ($this->calendar_in_text)  echo 'checked';
		echo ' />'; 
		_e('at top of Bible text, with text wrapped', 'bible-reading-plans');
		echo '</div>';
		echo '<div class="brp-in-text"><input name="bible_reading_plans_calendar_in_text" type="radio" value=0 class="code" ';
		if (!$this->calendar_in_text) echo 'checked';
		echo ' /> '.__('above text', 'bible-reading-plans').'</div><div class="brp-in-text">'.__('(Calendar will always be above the text for screens less than ', 'bible-reading-plans').$this->switch_cal_width.__('px wide', 'bible-reading-plans').')</div></div>';
		echo '
<script type="text/javascript"> 
	/* <![CDATA[ */
		jQuery(document).ready(function($) {
			$("#bible_reading_plans_use_calendar_id").click(function() {
				$("#bible_reading_plans_calendar_in_text_id").toggle(this.checked);
			});
		});
	/* ]]> */ 
</script>
		';
	}
	
	protected function dbp_excluded_media_list () {
		$media_exclude	= '&media_exclude=';
		$nr_media_types	= count(array_keys($this->dbp_exclude_media));
		$counter		= 1;
		foreach ($this->dbp_exclude_media as $media_name => $media_code) {
			if ($counter++ < $nr_media_types) {
				$media_exclude .= $media_code.',';
			} else {
				$media_exclude .= $media_code.'&';
			}
		}
		return $media_exclude;
	}

	public function getVersionsList () {
		if (isset($_REQUEST['source']) && $_REQUEST['source']) {
			$source = $_REQUEST['source'];
		} else {
			$source = 'dbp';
		}
		$this->scptr_src_prefix = $source.'_';
		if ('abs' == $source) {
			if ($this->abs_api_key) {
				$urls_ary		= array("$this->abs_url_base",);
				$remote_bibles	= $this->remote_get_scriptures($urls_ary);
				if (is_array($remote_bibles)) {
					$bibles			= json_decode($remote_bibles[0][0]);
					$descriptions	= array('Catholic' => 'C', 'Ecumenical' => 'E', 'Protestant' => 'P', 'Orthodox' => 'O',);
					$keys_used		= array();
					$key_counter	= array();
					foreach ($bibles as $obj_ary) {
						foreach ($obj_ary as $obj) {
							if ($obj->language->id == $this->abs_language_id) {
								if (array_key_exists($obj->description, $descriptions)) {
									$key = $obj->abbreviationLocal.'-'.$descriptions[$obj->description];
									$keys_used[] = $key;
									$obj->name = $obj->name.', '.$obj->description;
								} elseif(in_array($obj->abbreviationLocal, $keys_used)) {
									$obj->name = $obj->name.', '.$obj->description;
									$keys_used[] = $obj->abbreviationLocal;
									$key = $obj->abbreviationLocal;
									if (isset($this->abs_versions[$key])) {
										$this->abs_versions[$key]['name'] = $this->abs_versions[$key]['name'].', '.$obj->description;
										$this->abs_versions[$key."-1"] = $this->abs_versions[$key];
										unset($this->abs_versions[$key]);
										$key_counter[$key] = 1;
									}
									$key_counter[$key]++;
									$key = $key.'-'.$key_counter[$key];
								} else {
									$key = $obj->abbreviationLocal;
									$keys_used[] = $key;
								}
								$this->abs_versions["$key"] = array("name" => "$obj->name", "id" => "$obj->id");
							}
						}
						if (isset($this->abs_versions['OKE'])) {
							// The Targum Onkelos Etheridge version appears to be empty.
							unset($this->abs_versions['OKE']);
						}
						if (isset($this->abs_versions['FBVNTPsalms'])) {
							// This version's data seems to be malformed.
							unset($this->abs_versions['FBVNTPsalms']);
						}
						if (isset($this->abs_versions['ASV']['name'])) {
							// This removes "The Holy Bible" from the title, since it is redundant.
							$this->abs_versions['ASV']['name']  = 'American Standard Version';
						}
						if (isset($this->abs_versions['OJPS']['name'])) {
							$this->abs_versions['OJPS']['name'] = 'JPS TaNaKH 1917 (Old Testament only)';
						}
					}
				} else {
					$this->abs_versions = $this->abs_vers_default;
				}
			} else {
				$this->abs_versions = $this->return_api_error($this->err_flag.__(': Missing API Key for ABS', 'bible-reading-plans'));
			}
		} elseif ('dbp' == $source) {
			if ($this->dbp_api_key) {
				if (isset($_REQUEST['lng_code_iso']) && $_REQUEST['lng_code_iso']) {
					$lng_code_iso = $_REQUEST['lng_code_iso'];
					if (is_array($this->dbp_versions)) {
						if (isset($this->dbp_versions[$lng_code_iso]['bible_id'])) {
							$dbp_versions[$lng_code_iso]	= $this->dbp_versions[$lng_code_iso]['bible_id'];
						} else {
							$dbp_versions['eng']			= 'ENGESV';
						}
					} else {
						$dbp_versions[$lng_code_iso] = $this->dbp_vers_default[$lng_code_iso];
					}
				} else {
					$this->dbp_versions = $this->return_api_error($this->err_flag.__(': Missing Language ID for DBP', 'bible-reading-plans'));
				}
			} else {
				$this->dbp_versions = $this->return_api_error($this->err_flag.__(': Missing API Key for DBP', 'bible-reading-plans'));
			}
			return $this->dbp_versions;
		} elseif ('esv' == $source) {
			if ($this->esv_api_key) {
				$this->esv_versions = $this->esv_vers_default; // Only one version
			} else {
				$this->esv_versions = $this->return_api_error($this->err_flag.__(': Missing API Key for ESV', 'bible-reading-plans'));
			}
		}
	}

	public function dbpVersionsList () {
		if ($this->dbp_api_key) {
			$rtn_str = $this->construct_dbp_versions_list($_REQUEST['lng_code_iso']);
		} else {
			$rtn_str = $this->return_api_error($this->err_flag.$this->api_request_err.'DBP.');
		}
		echo $rtn_str;
 		die();
	}
	
	public function drawOptionsPage () {
		$nr_plans	= count(array_keys($this->reading_plans));
		$plans_list	= '';
		asort($this->reading_plans);
		foreach ($this->reading_plans as $short_code => $plan_name) {
			if ($short_code) {
				$plans_list .= "\t<li>$short_code\t\t\t- $plan_name";
				if ('bcp19-acna-twoyear' == $short_code) {
					$plans_list .= '<br /><span style="font-size: 0.8em; margin-left: 145px;">';
					$plans_list .= __('(uses Morning Prayer readings for odd numbered years and Evening Prayer readings for even numbered years)', 'bible-reading-plans');
					$plans_list .= '</span>';
				}
				$plans_list .= "</li>\n";
			}
		}
		$plans_list .= "\t<li style=\"font-size: 0.9em;\">".__('(The mcheyne and one-year-tract are the same. The latter is available for compatibility with the Embed Bible Passages plugin.)', 'bible-reading-plans')."</li>\n";
		$plans_list .= "\t<li style=\"font-size: 0.9em;\">".__('Note that, if a plan has Scripture portions that are not available in the Bible version being used, those portions will be skipped. If instead, however, you would prefer a "no Scriptures available" message to appear, override or comment out the "display: none;" statement in the brp-no-scriptures-available class in the bible-reading-plans.css file.', 'bible-reading-plans')."</li>\n";
		if ($this->abs_versions && is_array($this->abs_versions)) {
			$abs_versions_list = '';
			asort($this->abs_versions);
			foreach ($this->abs_versions as $short_code => $ary) {
				$abs_versions_list .= "\t<li>$short_code\t\t\t- ".$ary['name']."</li>\n";
			}
		} else {
			$abs_versions_list = $this->abs_versions; // This will be the error message for no versions.
		}
		if ($this->esv_versions && is_array($this->esv_versions)) {
			$esv_versions_list = __('Naturally, the only version available from from the ESV API is the ', 'bible-reading-plans');
			foreach ($this->esv_versions as $short_code => $ver) {
				$esv_versions_list .= "$short_code\t\t\t- $ver";
			}
		} else {
			$esv_versions_list = $this->esv_versions; // This will be the error message for no versions.
		}		
		echo '<script type="text/javascript" src="'.includes_url().'js/jquery/ui/core.min.js"></script>';		
		echo '<script type="text/javascript" src="'.includes_url().'js/jquery/ui/tabs.min.js"></script>';
		echo '<div><h2>'.__('Bible Reading Plans Options', 'bible-reading-plans').'</h2>';
		_e('<h3>Shortcode Format</h3>
			<p>This plugin provides the ability to embed Bible reading plans into a post or page using shortcode of the forms: 
				<ul class="brp-plans">
					<li>ABS:<code class="brp-plans">[bible-reading-plan source="ABS" reading_plan="mcheyne" version="KJV-P"]</code></li>
					<li>DBP (<span style="color: red; font-style: italic; font-weight: bold;">New:</span> many languages): <code class="brp-plans">[bible-reading-plan source="DBP" reading_plan="mcheyne" bible_id="ENGESV"]</code></li>
					<li>DBP (Legacy: English only):<code class="brp-plans">[bible-reading-plan source="DBP" reading_plan="mcheyne" version="ESV"]</code></li>
					<li>ESV:<code class="brp-plans">[bible-reading-plan source="ESV" reading_plan="mcheyne"]</code></li>
				</ul>
			</p>
			<p>The "source", "reading_plan", "version", and "bible_id" values are listed under the following tabs:</p>', 'bible-reading-plans');
			
		echo '<div id="tabs">';
			
		_e('	<ul>
					<li><a href="#tabs-1">Sources Available</a></li>
					<li><a href="#tabs-2">Reading Plans Available</a></li>
					<li><a href="#tabs-3">Versions Available from API.Bible (ABS)</a></li>
					<li><a href="#tabs-4">Versions Available from the Bible Brain API (DBP)</a></li>
					<li><a href="#tabs-5">English Standard Version API (ESV)</a></li>
				</ul>', 'bible-reading-plans');
				
		_e("	<div id=\"tabs-1\">
					The \"source\" can be: 
					<ul class=\"brp-plans\">
						<li>ABS - {$this->abs_sctr_src_url},</li>
						<li>DBP - {$this->dbp_sctr_src_url}, or</li>
						<li>ESV - {$this->esv_sctr_src_url}.</li>
					</ul>
					The default source is DBP.
					<div style=\"font-style: italic; margin-top: 12px;\">In order to use an API, you must obtain an Access Key from the API provider. (You only need to obtain Access Keys for the APIs you actually use.) See instructions for obtaining these keys and the field for entering them <a href=\"#instructions_below\">below</a>.</div>
				</div>", 'bible-reading-plans');
				$nr_unique_plans = $nr_plans - 1;
		_e("	<div id=\"tabs-2\">
					The values of \"reading_plan\" can be $nr_unique_plans distinct plans are available at present, more may be added -- and you may also create your own Bible reading plans by purchasing the <a href=\"http://sllwi.re/p/1Il\" target=\"_blank\">Create Bible Reading Plans plugin</a>):
					<ul class=\"brp-plans\">$plans_list</ul>
					The default reading plan is mcheyne.
				</div>", 'bible-reading-plans');
				
		echo '	<div id="tabs-3">';
		_e('		The English language versions available from API.Bible (ABS) and the corresponding codes to be used for "version" in the shortcode currently are:
					<ul class="brp-plans">'.$abs_versions_list.'</ul>
					The default verson is', 'bible-reading-plans');
		echo '			 KJV-P.<div style="font-style: italic; margin-top: 12px;">';
		_e('Note that, in order to use this API, you must obtain an Access Key from the American Bible Society. See instructions for obtaining that key and the field for entering it <a href="#instructions_below">below</a>.', 'bible-reading-plans');
		echo '	</div>
			</div>
			<div id="tabs-4">
				<div id="brp-dbp-languages-and-versions"></div>
				<div style="font-style: italic; margin-top: 12px;">
							';
		_e('Note that, in order to use this API, you must obtain an Access Key from the Bible Brain (aka Digital Bible Platform -- DBP), Version 4 of their API. See instructions for obtaining that key and the field for entering it <a href="#instructions_below">below</a>.', 'bible-reading-plans');
		echo '		</div>						
				</div>
			<div id="tabs-5">
					'.$esv_versions_list.'
				<p>	';
		_e('This API has been made available separately (even though the ESV is also available from the DBP) because it is the only API for which a link to audio for the text is supplied directly with the text. Additionally, at present, the ability to format the text from the ESV API is better than that from the DBP API.', 'bible-reading-plans');
		echo '</p>
				<div style="font-style: italic; margin-top: 12px;">';
		_e('Note that, in order to use this API, you must obtain an Access Key from Crossway/ESV.org. See instructions for obtaining that key and the field for entering it <a href="#instructions_below">below</a>.', 'bible-reading-plans');
		echo '
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
				jQuery("#tabs").tabs();
	</script>
			
	<div style="clear: both; padding-top: 15px;">';
		_e('The page opens with the plan reading for the current date. A date picker calendar is available (see option below) to enable users to choose readings for other dates.<br /><br />This plugin requires JavaScript to be active.', 'bible-reading-plans');
		echo '
	</div><p>&nbsp;</p><p style="text-align: center; font-weight: bold; border: 1px solid gold; margin: 0 auto 20px 200px; padding: 15px; color: #005353; background-color: #F3E8DF; width: 50%; border-radius: 25px;">';
		_e('Create your own Bible reading plans to use with this plugin. Purchase the ', 'bible-reading-plans');
		echo '<a href="http://sllwi.re/p/1Il" target="_blank">Create Bible Reading Plans plugin</a>.<br /><br />';
		_e('Questions? <a href="https://saesolved.com/contact-us/" target="_blank">Contact us.</a>', 'bible-reading-plans');
		echo '</p><div id="instructions_below">&nbsp;</div>';
		echo '<form method="post" action="options.php">';
		settings_fields('bible_reading_plans_settings');
		do_settings_sections('bible_reading_plans_plugin');
		echo '<p><input name="Submit" type="submit" value="';
		esc_attr_e('Save Changes', 'bible-reading-plans');
		echo '" /></p>';
		echo '</form></div>';
/*		If nested tabs are desired, here is an approach which appears to work:
			https://stackoverflow.com/questions/19666976/jquery-ui-tabs-widget-and-nested-list
		echo <<<EOT
<div id="1">
    <ul>
        <li><a href="#a">A</a></li>
        <li><a href="#b">B</a></li>
        <li><a href="#c">C</a></li>
    </ul>
    <div id="a">
        <ul>
            <li><a href="#aa1">Sub A 1</a></li>
            <li><a href="#aa2">Sub A 2</a></li>
        </ul>
        <div id="aa1">
            Sub Tab A content 1
        </div>
        <div id="aa2">
            Sub Tab A content 2
        </div>
     </div>
    <div id="b">
        <ul>
            <li><a href="#bb1">Sub B 1</a></li>
            <li><a href="#bb2">Sub B 2</a></li>
        </ul>
        <div id="bb1">
            Sub Tab B content 1
        </div>
        <div id="bb2">
            Sub Tab B content 2
        </div>
     </div>
    <div id="c">
        <ul>
            <li><a href="#cc1">Sub C 1</a></li>
            <li><a href="#cc2">Sub C 2</a></li>
        </ul>
        <div id="cc1">
            Sub Tab C content 1
        </div>
        <div id="cc2">
            Sub Tab C content 2
        </div>
     </div>
</div>
<script type="text/javascript">
	jQuery("#1" ).tabs();
	jQuery("#a" ).tabs();
	jQuery("#b" ).tabs();
	jQuery("#c" ).tabs();
</script>
EOT;*/
		echo '<div class="brp-donate">'.__('If you find this plugin of value, please contribute to the cost of its development:', 'bible-reading-plans').'<div class="brp-donate-form"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <input type="hidden" name="cmd" value="_s-xclick" /> <input type="hidden" name="hosted_button_id" value="3GNC36MKM6ADC" /> <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" /> <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" /> </form><div class="brp-muzzle-not ">'.__('"Do not muzzle an ox while it is treading out the grain." and "The worker deserves his wages."', 'bible-reading-plans').' <a href="http://www.biblegateway.com/passage/?search=1%20Timothy+5:18&version='.__('NIV', 'bible-reading-plans').'" target="_blank">'.__('1 Timothy 5:18', 'bible-reading-plans').'</a></div></div></div>';
	}

	public function initializeAdmin () {
		if ((isset($_REQUEST['page']) && ('bible_reading_plans_plugin' == $_REQUEST['page'] || 'bible_reading_plans_plugin' == $_REQUEST['page'])) || (isset($_REQUEST['option_page']) && 'bible_reading_plans_settings' == $_REQUEST['option_page'])) {
			// Deal with plans created by the Create Bible Reading Plans plugin.
			$reading_plans_list = get_option('brp_reading_plans_list');
			$plan_options = array_keys($reading_plans_list);
			foreach ($plan_options as $plan_key) {
				if (strpos($plan_key, $this->cbrp_prefix) !== false) {
					$reading_plan	= get_option($plan_key);
					if (isset($reading_plan[0]['copyright']) && 'Public Domain' == $reading_plan[0]['copyright']) {
						$reading_plan[0]['copy_type'] = 'Public Domain';
						$reading_plan[0]['copyright'] = 'standardized'; 
					}
					if (strpos($plan_key, 'dbp') !== false) {
						// Only plans from the Create Bible Reading Plans plugin created for the Digital Bible Platform need conversion.
						$reading_plan = $this->if_necessary_convert_dbp2_plan_to_dbp4_plan($reading_plan, $plan_converted);
						if (!is_array($reading_plan)) {
							echo $reading_plan;
						} else {
							update_option($plan_key, $reading_plan);
						}
					}
				}
			}
		}
		if ($this->abs_api_key) {
			$this->abs_versions = get_option('bible_reading_plans_abs_versions');
		}
		if ($this->esv_api_key) {
			$this->esv_versions = get_option('bible_reading_plans_esv_versions');
		}
		if (function_exists('register_setting')) {
			$page_for_settings		= 'bible_reading_plans_plugin';
			$section_for_settings	= 'bible_reading_plans_section';
			add_settings_section($section_for_settings, __('Bible Reading Plans Settings', 'bible-reading-plans'), array(&$this, 'bibleReadingPlansSectionHeading'), $page_for_settings);
			add_settings_field('bible_reading_plans_abs_api_key_id', __('American Bible Society<br />Access Key (API Version 1)', 'bible-reading-plans'), array(&$this, 'bibleReadingPlansAbsApiKeyValue'), $page_for_settings, $section_for_settings);
			add_settings_field('bible_reading_plans_dbp_api_key_id', __('Bible Brain<br />(aka Digital Bible Platform)<br />Access Key (API Version 4)', 'bible-reading-plans'), array(&$this, 'bibleReadingPlansDbpApiKeyValue'), $page_for_settings, $section_for_settings);
			add_settings_field('bible_reading_plans_esv_api_key_id', __('English Standard Version<br />Access Key (API Version 3)', 'bible-reading-plans'), array(&$this, 'bibleReadingPlansEsvApiKeyValue'), $page_for_settings, $section_for_settings);
			add_settings_field('bible_reading_plans_display_plan_name_calendar_id', __('Display Plan Name on Pages', 'bible-reading-plans'), array(&$this, 'bibleReadingPlansDisplayPlanName'), $page_for_settings, $section_for_settings);
			add_settings_field('bible_reading_plans_use_calendar_id', __('Show Date Picker Calendar', 'bible-reading-plans'), array(&$this, 'bibleReadingPlansUseCalendarValue'), $page_for_settings, $section_for_settings);
			add_settings_field('bible_reading_plans_display_toc_id', __('Display Table of Contents on Pages', 'bible-reading-plans'), array(&$this, 'bibleReadingPlansDisplayToc'), $page_for_settings, $section_for_settings);
			add_settings_field('bible_reading_plans_show_powered_by_id', __('Show "Powered by" attribution at bottom of page', 'bible-reading-plans'), array(&$this, 'bibleReadingPlansShowPoweredByValue'), $page_for_settings, $section_for_settings);
			register_setting('bible_reading_plans_settings', 'bible_reading_plans_abs_api_key', 'wp_filter_nohtml_kses');
			register_setting('bible_reading_plans_settings', 'bible_reading_plans_dbp_api_key', 'wp_filter_nohtml_kses');
			register_setting('bible_reading_plans_settings', 'bible_reading_plans_esv_api_key', 'wp_filter_nohtml_kses');
			register_setting('bible_reading_plans_settings', 'bible_reading_plans_display_plan_name');
			register_setting('bible_reading_plans_settings', 'bible_reading_plans_display_toc');
			register_setting('bible_reading_plans_settings', 'bible_reading_plans_use_calendar');
			register_setting('bible_reading_plans_settings', 'bible_reading_plans_calendar_in_text');
			register_setting('bible_reading_plans_settings', 'bible_reading_plans_show_poweredby');
		}
	}

	public function putBibleReadingPlan () {
		if (isset($_REQUEST['reading_plan'])) {
			$this->reading_plan = sanitize_text_field($_REQUEST['reading_plan']);
			if (!array_key_exists($this->reading_plan, $this->reading_plans)) {
				$this->reading_plan = $this->short_code_atts['reading_plan'];
			}
		} else {
			$this->reading_plan = $this->short_code_atts['reading_plan'];
		}
		if (isset($_REQUEST['source'])) {
			$this->source = sanitize_text_field($_REQUEST['source']);
			if (!array_key_exists($this->source, $this->sources)) {
				$this->source = $this->short_code_atts['source'];
			}
		} else {
			$this->source = $this->short_code_atts['source'];
		}
		$this->scptr_src_prefix = strtolower($this->source).'_';
		if (isset($_REQUEST['bible_id'])) {
			$this->bible_id = sanitize_text_field($_REQUEST['bible_id']);
		} else {
			$this->bible_id = $this->short_code_atts['bible_id'];
		}
		if (isset($_REQUEST['lng_code_iso'])) {
			$this->lng_code_iso = sanitize_text_field($_REQUEST['lng_code_iso']);
		}
		if (isset($_REQUEST['version'])) {
			$this->version = sanitize_text_field($_REQUEST['version']);
			if ('abs_' == $this->scptr_src_prefix) {
				if (!is_array($this->abs_languages) || (is_array($this->abs_versions) && !array_key_exists($this->version, $this->abs_versions))) {
					$this->version = $this->default_version();
				}
			} elseif ('dbp_' == $this->scptr_src_prefix) {
				if (isset($_REQUEST['bible_id']) && $_REQUEST['bible_id']) {
					$this->bible_id = sanitize_text_field($_REQUEST['bible_id']);
				} else {
					$this->bible_id = $this->short_code_atts['bible_id'];
				}
			} elseif ('esv_' == $this->scptr_src_prefix) {
				$this->version = $this->default_version();
			}
		} else {
			$this->version = $this->default_version();
		}
		if (isset($_REQUEST['device_screen_width'])) {
			$dev_screen_width = sanitize_text_field($_REQUEST['device_screen_width']);
			if (is_numeric($dev_screen_width) && $dev_screen_width) {
				$this->dev_screen_width = $dev_screen_width;
			}
		}
		if (isset($_REQUEST['requested_date'])) {
			$scriptures_date = sanitize_text_field($_REQUEST['requested_date']);
			$date_to_time	 = strtotime($scriptures_date);
			if (!$date_to_time || !is_int($date_to_time)) {
				$scriptures_date = date($this->js_date_format);
			}
		} else {
			$scriptures_date = date($this->js_date_format);
		}
		echo $this->get_bible_reading_plan($scriptures_date);
		die();
	}

	public function removePreTags ($content) {
		$content = preg_replace("|<pre>\[bible-reading-plan (.+)\]</pre>|", "[bible-reading-plan $1]", $content);
		return $content;
	}

	public function shortcodeAttributes ($atts) {
		$combined_atts = shortcode_atts($this->short_code_atts, $atts);
		if (!array_key_exists($combined_atts['reading_plan'], $this->reading_plans)) {
			$reading_plan = $this->short_code_atts['reading_plan']; // default
		} else {
			$reading_plan = $combined_atts['reading_plan'];
		}
		if ('one-year-tract' == $reading_plan) {
			$reading_plan = $this->short_code_atts['reading_plan']; // for compatibility with the Embed Bible Passages plugin
		}
		$this->reading_plan = $reading_plan;
		if (!array_key_exists($combined_atts['source'], $this->sources)) {
			$this->source = $this->short_code_atts['source']; // default
		} else {
			$this->source = $combined_atts['source'];
		}
		$this->scptr_src_prefix = strtolower($this->source).'_';
		if ('ABS' == $this->source) {
			if (!array_key_exists($combined_atts['language_code'], $this->abs_language_ids)) {
				$this->language = strtolower($this->default_language());
			} else {
				$this->language = strtolower($combined_atts['language_code']);
			}
			$this->abs_language_id = $this->language;
			if (!is_array($this->abs_versions) || !in_array($combined_atts['version'], $this->abs_versions)) {
				$this->version = $this->default_version();
			} else {
				$this->version = $combined_atts['version'];
			}
		} elseif ('DBP' == $this->source) {
			if (isset($combined_atts['bible_id']) && $combined_atts['bible_id']) {
				$this->bible_id = $combined_atts['bible_id'];
				$lang_id		= substr($this->bible_id, 0, 3);
				if (isset($this->dbp_bible_id_to_iso[$this->bible_id]) && $this->dbp_bible_id_to_iso[$this->bible_id]) {				
					$this->lng_code_iso	= $this->dbp_bible_id_to_iso[$this->bible_id];
				} elseif (isset($this->dbp_lang_id2iso_alt[$lang_id]) && $this->dbp_lang_id2iso_alt[$lang_id]) {
					$this->lng_code_iso	= $this->dbp_lang_id2iso_alt[$lang_id];
				} else {
					$this->lng_code_iso	= $this->dbp_language_iso;
				}
				$split_bible_id 		= str_split($this->bible_id, 3);
				$language_code			= array_shift($split_bible_id);
				$this->language_name	= array_search($this->lng_code_iso, $this->dbp_language_ids);
				$this->version			= implode('', $split_bible_id);
			} elseif (isset($combined_atts['version']) && $combined_atts['version']) {
				$this->version = $combined_atts['version'];
				if (3 == strlen($this->version)) {
					$this->bible_id = 'ENG'.$this->version;
				} else {
					$this->bible_id = 'ENGESV';
				}
			} else {
				$this->bible_id = 'ENGESV';
			}
		} elseif ('ESV' == $this->source) {
			$this->version = $this->default_version();
		}
		return $this->get_bible_reading_plan();
	}

	protected function add_date_picker_ui () {
		$language_name = $this->dbp_versions[$this->lng_code_iso][0]['language_name'];
		if (isset($this->lng_name_to_2_ltr_cd[$language_name]) && $this->lng_name_to_2_ltr_cd[$language_name]) {
			$lang_code_2ltr = $this->lng_name_to_2_ltr_cd[$language_name];
		} else {
			$lang_code_2ltr = 'en';
		}
		$includes_path	 = includes_url();
		$rtn_str		 = '<script type="text/javascript" src="'.$includes_path.'js/jquery/ui/core.min.js"></script>'."\n";
		$rtn_str  		.= '<script type="text/javascript" src="'.$includes_path.'js/jquery/ui/datepicker.min.js"></script>'."\n";
		// Get language-specific datepicker parameters
		$lang_datepicker = wp_remote_get('https://raw.githubusercontent.com/jquery/jquery-ui/master/ui/i18n/datepicker-'.$lang_code_2ltr.'.js');
		if ('en' == $lang_code_2ltr  || '404: Not Found' == $lang_datepicker['body']) {
			$rtn_str .= "
<script type=\"text/javascript\">
	/* <![CDATA[ */";
			$rtn_str .= "
			jQuery(document).ready(function($){
				$.datepicker.setDefaults(\"dateFormat\":\"".$this->js_date_format."\",\"firstDay\":0});
			})";
		} else {
			$rtn_str .= "
<script type=\"text/javascript\">
	/* <![CDATA[ */\n";
			$rtn_str .= $lang_datepicker['body'];
			$rtn_str .= "
			jQuery(document).ready(function($){
				$.datepicker.setDefaults($.datepicker.regional[\"$lang_code_2ltr\"]);
				
			})";
		}
		$rtn_str .= "
	/* ]]> */ 
</script>\n";
		return $rtn_str;
	}

	protected function add_versions ($source = 'dbp') {
		$loading = '<p>'.__('Versions are loading...', 'bible-reading-plans').'</p>'.$this->loading_image;
		echo <<<EOS
<script type="text/javascript"> 
	/* <![CDATA[ */
		jQuery(document).ready(function($) {
			var ajaxurl	= '{$this->ajax_url}';
			$('#language_code_iso').on('change', function() {
				$('#brp-dbp-versions').html('$loading');
				var data = {
					'action':		'dbp_versions_list',
					'lng_code_iso':	$('#language_code_iso').val(),
				};
				$.post(ajaxurl, data, function(response) {
					$('#brp-dbp-versions').html(response);
				});
			});
		});
	/* ]]> */ 
</script>\n
EOS;
	}

	protected function bcp19_acna_twoyear_shortcode ($time) {
		// Use Morning Prayer readings for odd numbered years and Evening Prayer readings for even numbered years.
		$date_time_ary = getdate($time);
		if ($date_time_ary['year'] % 2) {
			$this->reading_plan_shortcode = 'bcp19-acna-morning';
		} else {
			$this->reading_plan_shortcode = 'bcp19-acna-evening';
		}
	}

	protected function construct_dbp_languages_list ($lng_code_iso = 'eng') {
		$dbp_languages_list  = '	<div id="brp-dbp-languages">';
		$dbp_languages_list .= '		<label for="language_code_iso">'.__('Select another language to get a list of the versions available in that language:', 'bible-reading-plans').'<br /></label>';
		$dbp_languages_list .= '		<select name="language_code_iso" id="language_code_iso">';
		$lang_name			 = '';
		if (is_array($this->dbp_language_ids) && count($this->dbp_language_ids)) {
			array_multisort(array_column($this->dbp_language_ids, 'lng_code_iso'), SORT_ASC, $this->dbp_language_ids);
			foreach ($this->dbp_language_ids as $language => $language_parms) {
				$dbp_languages_list .= "<option value=\"{$language_parms['lng_code_iso']}\"";
				if ($language_parms['lng_code_iso'] == $lng_code_iso) {
					$dbp_languages_list .= ' selected ';
				}
				$dbp_languages_list .= ">{$language_parms['lng_code_iso']} - {$language_parms['native_name']}";
				if ($language != $language_parms['native_name']) {
					$dbp_languages_list .= " ($language)";
				}
				$dbp_languages_list .= "</option>\n\t";
			}
		} else {
			$lang_name			 = __('English', 'bible-reading-plans');
			$dbp_languages_list .= '<option value="eng">'._e('English', 'bible-reading-plans')."</option>\n\t";
		}	
		$dbp_languages_list .= '</select>';
		$dbp_languages_list .= '<div class="brp-languages-sort-note">'.__('Languages are sorted by their ISO code. (If different from the native name, English or alternate names for a language are in parentheses.)', 'bible-reading-plans').'</div><br /></div>';
		$dbp_languages_list .= '<div class="brp-dbp-languages-notes">'.__('NOTES:', 'bible-reading-plans').'<ol>';
		$dbp_languages_list .= '<li>'.__('There are ~90 more languages available, but which have had to be excluded from this version of the plugin because of the format in which they are available. It is hoped that the next version will be able to include these languages.)', 'bible-reading-plans').'</li>';
		$dbp_languages_list .= '<li>'.__('There are likely formatting issues with some languages. It is hoped that the users of those languages will work with us to resolve these issues', 'bible-reading-plans').'</li>';
		$dbp_languages_list  .= '</ol>';
		return $dbp_languages_list;
	}

	protected function construct_dbp_versions_list ($lng_code_iso = 'eng') {
		$dbp_versions_list  = '<div id="brp-dbp-versions">';
		$dbp_versions_list .= __('The ', 'bible-reading-plans');
		if (isset($this->dbp_versions[$lng_code_iso][0]['language_name']) && $this->dbp_versions[$lng_code_iso][0]['language_name']) {
			$dbp_versions_list .= $this->dbp_versions[$lng_code_iso][0]['language_name'];
		} elseif (isset($this->dbp_versions[$lng_code_iso][0]['native_name']) && $this->dbp_versions[$lng_code_iso][0]['native_name']) {
			$dbp_versions_list .= $this->dbp_versions[$lng_code_iso][0]['native_name'];
		} else {
			$dbp_versions_list .= $lng_code_iso;
		}
		$dbp_versions_list .= __(' language versions available from Bible Brain (aka Digital Bible Platform -- DBP) and the corresponding codes to be used for "bible_id" in the shortcode currently are:', 'bible-reading-plans');
		$dbp_versions_list .= "\t\t".'<ul class="brp-plans">'."\n";
		if (isset($this->dbp_versions[$lng_code_iso]) && is_array($this->dbp_versions[$lng_code_iso])) {
			foreach ($this->dbp_versions[$lng_code_iso] as $vers_data) {
				if (!in_array($vers_data['bible_id'], $bible_ids)) { // Eliminate duplicates.
					$bible_ids[] 		= $vers_data['bible_id'];
					$size				= $vers_data['size'];
					$portion			= $this->dbp_size_to_portions[$size];
					$dbp_versions_list .= "\t\t\t<li>{$vers_data['bible_id']}\t\t\t- {$vers_data['dbp_version']}";
					if ($portion) {
						$dbp_versions_list .= " ($portion)";
					}
					$dbp_versions_list .= "</li>\n";
					// $dbp_versions_list .= " [{$vers_data['type']}]</li>\n";
				}
			}
			if ('eng' == $lng_code_iso) {
				$dbp_versions_list .= '<br />'.__('The default version is ', 'bible-reading-plans').'ENGESV';
			}
			$dbp_versions_list .= "\t\t</ul>\n";
			$dbp_versions_list .= "\t<span class=\"brp-available-versons-note\">".__('(If there are only portions of the Bible available for a particular version, the available portions are indicated in parentheses after the translation name.)', 'bible-reading-plans')."</span></div>\n";
		} else {
			$dbp_versions_list .= "\t\t\t<li>{$this->no_versns_found}</li>\n";
			$dbp_versions_list .= "\t\t</ul></div>\n";
		}
		return $dbp_versions_list;
	}
	
	protected function construct_urls_array_abs ($readings_querys, &$abs_passages, $version = '') {
		$urls_ary = array();
		if (!$version) {
			$version = $this->abs_versions[$this->version]['id'];
		}
		$url_base = $this->abs_url_base.'/'.$version.'/'.'verses/';
		foreach ($readings_querys as $val) {
			if (isset($val['verses'])) {
				foreach ($val['verses'] as $vrs) {
					$urls_ary[]		= $url_base.$vrs;
					$abs_passages[]	= $val['passage'];
				}
			} else {
				$urls_ary[] = $url_base.$val;
			}
		}
		return $urls_ary;
	}

	protected function construct_urls_array_dbp ($readings_querys) {
		//The bible_id is the same as what was the dam_id in earlier versions of the DBP API.
		if ($this->bible_id) {
			$this->dam_id = $this->bible_id;
		} else {
			$this->dam_id = $this->dbp_language_id.$this->version;
		}
		$urls_ary = array();
		foreach ($readings_querys as $val) {
			foreach ($val['verses'] as $qry_str) {
				$urls_ary[$val['passage']][] = $this->dbp_query_string."bibles/filesets/".$this->dam_id.'/'.$qry_str.'&'.$this->dbp_query_base;
			}
		}
		$this->dbp_language_iso = $this->lng_code_iso;
		$urls_ary['metadata'] = $this->dbp_query_string.'bibles/';
		if (isset($this->dbp_language_iso) && $this->dbp_language_iso) {
			foreach ($this->dbp_versions[$this->dbp_language_iso] as $key => $ary) {
				if (array_search($this->dam_id, $ary)) {
					$urls_ary['metadata'] .= $this->dbp_versions[$this->dbp_language_iso][$key]['bible_abbr'];
					break;
				}				
			}
		} else {
			$urls_ary['metadata'] .= $this->dam_id;
		}
		$urls_ary['metadata'] .= '/copyright?'.$this->dbp_query_base;
		return $urls_ary;
	}

	protected function construct_urls_array_esv ($readings_querys) {
		$urls_ary = array();
		foreach ($readings_querys as $val) {
			$book_chapter_and_verses = $this->parse_bk_chp_vrs($val['passage']);
			$book    				 = $book_chapter_and_verses[0];
			$chapter_and_verses		 = $book_chapter_and_verses[1];
			if (1 == trim($chapter_and_verses) && in_array($book, $this->one_chapter_books)) {
				$passage = $book;
			} else {
				$passage = $val['passage'];
			}
			$urls_ary[] = $this->esv_url_base.$passage;
		}
		return $urls_ary;
	}
	
	protected function convert_dbp4_plan_to_abs_plan ($reading_plan = array()) {
		$abs_plan				= $reading_plan;
		$plan					= array();
		$plan[0]				= array_shift($abs_plan);
		foreach ($abs_plan as $plan_date => $date_data) {
			foreach ($date_data as $nr => $data) {
				$plan["$plan_date"][$nr]['passage'] = $data['passage'];
				foreach ($data['verses'] as $dbp4_url) {
					$plan[$plan_date][$nr]['verses'][] = $this->convert_dbp4_url_to_abs_url_end($dbp4_url);
				}
			}
		}
		return $plan;
	}

	protected function convert_dbp2_plan_to_dbp4_plan ($reading_plan = array()) {
		$dbp2_plan				= $reading_plan;
		$plan					= array();
		$plan[0]				= array_shift($dbp2_plan);
		$plan[0]['dbp_v']		= 4;
		foreach ($dbp2_plan as $plan_date => $date_data) {
			foreach ($date_data as $nr => $data) {
				$plan["$plan_date"][$nr]['passage'] = $data['passage'];
				if (is_array($data['qry_str'])) {
					foreach ($data['qry_str'] as $qry_str) {
						$result = array();
						parse_str($qry_str, $result);
						$dpp2_book_id = $result['book_id'];
						// DBP v4 book_icodes are the same as the abs_codes
						$book_code							= $this->bk_cds_dpp2_to_dbp4[$dpp2_book_id]; 
						$plan[$plan_date][$nr]['verses'][]	= $book_code.'/'.$result['chapter_id'].'?verse_start='.$result['verse_start'].'&verse_end='.$result['verse_end'];
					}
				} else {
					return  $reading_plan;
				}
			}
		}
		return $plan;
	}

	protected function datekey ($reading_plan, $time) {
		$date_key = date('m-d', $time);
		if ($date_key == '02-29') {
			// If 29 February is not in the reading plan, use the last day in the plan on that day.
			$ary_kys		= array_keys($reading_plan);
			$days_in_plan	= count($ary_kys) - 1;
			if ($days_in_plan < 366) {
				$date_key = array_pop($ary_kys);
			}
		}
		return $date_key;
	}

	protected function date_picker () {
		// Datepicker to load Scriptures for dates other than today
		$rtn_str  = $this->add_date_picker_ui();
		$rtn_str .= "
<script type=\"text/javascript\"> 
	/* <![CDATA[ */
 		var datepicker_id		= '#datepicker_above';
		var calendar_in_text	= ".($this->calendar_in_text ? 'true' : 'false').";
		var switch_cal_width	= ".$this->switch_cal_width.";
		var bible_id			= encodeURI('{$this->bible_id}');
		var language			= encodeURI('{$this->language}');
		var lng_code_iso		= encodeURI('{$this->lng_code_iso}');
		var reading_plan		= encodeURI('{$this->reading_plan}');
		var source				= encodeURI('{$this->source}');
		var version				= encodeURI('{$this->version}');
		var ajaxurl				= '{$this->ajax_url}?action=put_bible_reading_plan&reading_plan=' + reading_plan + '&source=' + source + '&version=' + version + '&bible_id=' + bible_id + '&language=' + language + '&lng_code_iso=' + lng_code_iso + '&device_screen_width=' + jQuery(window).width() + '&requested_date=';
		if (calendar_in_text && switch_cal_width < jQuery(window).width()) {
			datepicker_id = '#datepicker';
		}
		jQuery(document).ready(function($) {
			$(function() {
				$(datepicker_id).datepicker({
					autoSize:	true,
					dateFormat: 'mm/dd/y',
					onSelect:	function(dateText) {
									$('#brp-scriptures').html('$this->loading_image');
									$.get(ajaxurl + encodeURI(dateText), function(data) {
										$('#brp-scriptures').html(data);
									});
								}
				})
			})
		});
	/* ]]> */ 
</script>\n";
		if ($this->calendar_in_text && $this->switch_cal_width < $this->dev_screen_width) {
			return "<div title=\"".__('Click on a date to open the readings for that day.', 'bible-reading-plans')."\" id=\"datepicker\"></div>".$rtn_str;
		} else {
			echo $rtn_str;
		}
	}

	protected function default_language () {
		if ('abs_' == $this->scptr_src_prefix) {
			return 'eng';
		} else {
			return 'ENG';
		}
	}

	protected function default_version () {
		if ('abs_' == $this->scptr_src_prefix) {
			return 'KJV-P';
		} elseif ('dbp_' == $this->scptr_src_prefix) {
			$language_code = strtoupper($this->language);
			if (isset($this->dbp_vers_default[$language_code])) {
				return $this->dbp_vers_default[$language_code];
			} else {
				return $this->dbp_default_bible_id['ENG'];
			}
		} elseif ('esv_' == $this->scptr_src_prefix) {
			return 'ESV';
		}
	}

	protected function display_copyright_info (&$rtn_str, $texts = array(), $apocrypha_copyright = '', $fumsIDs_array = '', $copyright_ary = array(), $reading_plan_0 = array()) {
		// DO NOT REMOVE THE COPYRIGHT INFORMATION FOR THE SCRIPTURE TEXTS.
		$end_texts = end($texts);
		if ('abs_' == $this->scptr_src_prefix || $apocrypha_copyright) {
			$rtn_str   .= '
				<script type=\"text/javascript\"> 
					var fumsIDarray = ['.$fumsIDs_array.']
					fumsIDarray.forEach(sendFUMSIDs);
					function sendFUMSIDs(item) {
						try {
							_BAPI.t(item);
						}
						catch {
							// alert("ERROR: Could not transmit Fair Use Management System ID:" + item + ".");
						}
					}
				</script>';
		}
		$scriptures_copyright	= '';
		if ('abs_' == $this->scptr_src_prefix) {
			$scriptures_copyright .= $this->text_source.'<br />'.__('Scriptures copyright: ', 'bible-reading-plans').$this->abs_copyright.'.';
		} elseif ('dbp_' == $this->scptr_src_prefix) {
			if ('Public Domain' == $copyright_ary['copyright']) {
				$scriptures_copyright .= $this->text_source.'<br />'.__('Scriptures Copyright: ', 'bible-reading-plans');
			} else {
				$scriptures_copyright .= $this->text_source.'<br />'.__('Scriptures &copy; Copyright: ', 'bible-reading-plans');
			}
			if ($copyright_ary['date']) {
				$scriptures_copyright .= IntlDateFormatter::formatObject(strtotime($copyright_ary['date']), " yyyy ", $this->lng_code_iso);
			}
			$scriptures_copyright .= $copyright_ary['copyright'];
		} elseif ('esv_' == $this->scptr_src_prefix) {
			$scriptures_copyright .= $this->text_source.'<br />'.__('Scriptures copyright: ', 'bible-reading-plans').$this->esv_copyright.'.';
			$rtn_str   			  .= '<br />';
		}
		$rtn_str .= '<div class="brp-copyright-small">';
		if ('standardized' == $reading_plan_0['copyright'] || 'Public Domain' == $reading_plan_0['copyright']) {
			if ('Public Domain' == $reading_plan_0['copyright']) {
				$reading_plan_0['copy_type'] = 'Public Domain';
			}						
			switch ($reading_plan_0['copy_type']) {
			
				case 'Alan Hartless':
					$rtn_str .= __('This Bible reading plan from ', 'bible-reading-plans').$reading_plan_0['plan_orgn'].__(' is licensed under the <a target="_blank" href="https://www.gnu.org/licenses/gpl-3.0.en.html">GNU General Public License v.3</a> by Alan Hartless in a plugin written for Joomla: https://github.com/alanhartless/bibleplan, &copy; HartlessByDesign 2011. All rights reserved. Licensed under GNU General Public License v.3.', 'bible-reading-plans');
					break;
					
				case 'ACNA':
					$rtn_str .= __('All not-for-profit reproduction of this Bible reading plan by churches and non-profit organizations is permitted (reference Copyright statement in <a href="https://bcp2019.anglicanchurch.net/" target="_blank">', 'bible-reading-plans').'<span style="font-style: italic;">The Book of Common Prayer</span></a>, 2019, Anglican Church in North America). '.'<span style="font-size: 0.9em;">'.__('Many thanks to ', 'bible-reading-plans').'<a href="https://www.joshuapsteele.com/" target="_blank">The Revd Joshua P Steele</a> '.__('for supplying this plan in digital form.', 'bible-reading-plans').'</span>';
					break;
					
				case 'Public Domain':
					$rtn_str .= __('This Bible reading plan by ', 'bible-reading-plans').$reading_plan_0['plan_orgn'].__(' is in the Public Domain.', 'bible-reading-plans');
					break;
					
				default:
					$rtn_str .= $reading_plan_0['copy_type'];
				
			}
		} else {
			$rtn_str .= $reading_plan_0['copyright'];
		}
		$rtn_str .= $scriptures_copyright.'<br />';
		$rtn_str .= $apocrypha_copyright.'</div>';
	}
	
	protected function display_header_items ($scriptures_date, $scptr_src_prefix = 'dbp_', &$date_key, $reading_plan_0 = array()) {
		if ($this->display_plan_name) {
			if ('bcp19-acna-twoyear' == $this->reading_plan) {
				$acna_twoyear_reading_plan	= get_option($this->brp_prefix.$scptr_src_prefix.$this->reading_plan);
				$plan_name					= $acna_twoyear_reading_plan[0]['plan_name'];
			} else {
				$plan_name					= $reading_plan_0['plan_name'];
			}
			echo "<h2>$plan_name</h2>";
		}
		if ('bcp19-acna-morning' == $this->reading_plan_shortcode || 'bcp19-acna-evening' == $this->reading_plan_shortcode) {
			$date_key = $this->moveable_feasts_dates($date_key, $scriptures_date);
			if (in_array($date_key, $this->moveable_feasts)) {
				echo "<h2>$date_key</h2>";
			}
		}
	}

	protected function get_reading_plan_for_source ($scptr_src_prefix = 'dbp_') {
		$reading_plan = get_option($this->brp_prefix.$scptr_src_prefix.$this->reading_plan_shortcode);
		if (!$reading_plan) {
			$reading_plan = get_option($this->cbrp_prefix.$scptr_src_prefix.$this->reading_plan_shortcode);
		}
		if (!$reading_plan) {
			// Use default, if plan can't be found.
			$reading_plan = get_option($this->brp_prefix.$scptr_src_prefix.$this->short_code_atts['reading_plan']);
		}
		return $reading_plan;
	}
/*
	protected function  () {
	}
*/
	protected function get_bible_reading_plan ($scriptures_date = '', $error_message = 'ERROR: Could not retrieve readings') {
		global $use_abs4apocrypha;
		$this->reading_plan_shortcode = $this->reading_plan;
		if ($scriptures_date) {
			$time = strtotime($scriptures_date);
			if ('bcp19-acna-twoyear' == $this->reading_plan) {
				$this->bcp19_acna_twoyear_shortcode($time);
			}
			if (strpos($scriptures_date, ' ') == 3) {
				$scriptures_date = date($this->php_date_format, $time);
			}
			if ('esv_' == $this->scptr_src_prefix) {
				$scptr_src_prefix = 'abs_'; // The Scripture query strings for ESV and ABS are derived from the same array.
			} else {
				$scptr_src_prefix = $this->scptr_src_prefix;
			}
			$reading_plan	= $this->get_reading_plan_for_source($scptr_src_prefix);
			$date_key		= date('m-d', $time);
			if ($date_key == '02-29') {
				// If 29 February is not in the reading plan, use the last day in the plan on that day.
				$ary_kys		= array_keys($reading_plan);
				$days_in_plan	= count($ary_kys) - 1;
				if ($days_in_plan < 366) {
					$date_key = array_pop($ary_kys);
				}
			}
			if ($this->display_plan_name) {
				if ('bcp19-acna-twoyear' == $this->reading_plan) {
					$acna_twoyear_reading_plan	= get_option($this->brp_prefix.$scptr_src_prefix.$this->reading_plan);
					$plan_name					= $acna_twoyear_reading_plan[0]['plan_name'];
				} else {
					$plan_name					= $reading_plan[0]['plan_name'];
				}
				echo "<h2>$plan_name</h2>";
			}
			if ($scriptures_date) {
				$cal					= IntlCalendar::fromDateTime($scriptures_date);
				$intl_scriptures_date	= IntlDateFormatter::formatObject($cal, "EEEE d MMMM yyyy", $this->lng_code_iso);
				echo "<h3>$intl_scriptures_date</h3>";
			}
			if ('bcp19-acna-morning' == $this->reading_plan_shortcode || 'bcp19-acna-evening' == $this->reading_plan_shortcode) {
				$date_key = $this->moveable_feasts_dates($date_key, $scriptures_date);
				if (in_array($date_key, $this->moveable_feasts)) {
					echo "<h2>$date_key</h2>";
				}
			}
			if (array_key_exists($date_key, $reading_plan)) {
				$readings_querys = $reading_plan[$date_key];
				if ('abs_' == $this->scptr_src_prefix) {
					$abs_passages = array();
					$urls_ary			= $this->construct_urls_array_abs($readings_querys, $abs_passages);
					$this->text_source .= $this->abs_sctr_src_url.'.';					
				} elseif ('dbp_' == $this->scptr_src_prefix) {
					$urls_ary			= $this->construct_urls_array_dbp($readings_querys);
					$this->text_source	= '<br />'.$this->text_source.'the '.$this->dbp_sctr_src_url.'.';
				} elseif ('esv_' == $this->scptr_src_prefix) {
					$urls_ary			= $this->construct_urls_array_esv($readings_querys);
					$this->text_source	= '<br />'.$this->text_source.' '.$this->esv_sctr_src_url.'.';
				}
				$texts = $this->remote_get_scriptures($urls_ary, $date_key);
				if (is_array($texts)) {
					$rtn_str = "";
					if ($this->use_calendar) {
						$rtn_str .= $this->date_picker();
					}
					if ($this->display_toc) {
						$toc = "\n".'<div class="brp-toc"><div class="brp-toc-header"><span class="brp-toc-title">Table of Contents</span></div><ul>'."\n";
					}
					$i						= 0;
					$n						= 0;
					$passage_prev			= '';
					$prgrph_nr				= -1;
					$apocrypha_copyright	= '';
					$scriptures_copyright	= '';
					foreach ($texts as $passage_index => $txt_ary) {
						if ('abs_' == $this->scptr_src_prefix) {
							$passage = $abs_passages[$n];
							if ($passage != $passage_prev) {
								$passage_prev	 = $passage;
								$passage_header  = $this->transform_header($passage);
								if ($this->display_toc) {
									$this->toc_list($passage_header, $rtn_str, $toc);
								}
								$rtn_str		.= "<div class=\"brp-passage\">$passage_header</div>";
							}
						} elseif ('dbp_' == $this->scptr_src_prefix) {
							if (isset($readings_querys[$n]['passage'])) {
								$passage = $readings_querys[$n]['passage'];
								if ($this->display_toc) {
									$this->toc_list($passage, $rtn_str, $toc);
								}
							} else {
								$passage = '';
							}
							if ('metadata' == $passage_index) {
								foreach ($txt_ary[0] as $sub_ary) {
									if ($sub_ary['id'] == $this->bible_id) {
											$copyright_ary = array(	'copyright'		=> $sub_ary['copyright']['copyright'],
																	'date'			=> $sub_ary['copyright']['copyright_date'],
																	);
											break;
									}
								}
								$passage_header	= '<div class="brp-passage"> </div>';
							}
						} elseif ('esv_' == $this->scptr_src_prefix) {
							if (isset($readings_querys[$n]['passage'])) {
								$passage = $readings_querys[$n]['passage'];
							} else {
								$passage = '';
							}
							if ($passage != $passage_prev) {
								$passage_prev	 = $passage;
								$passage_header  = $this->transform_header($passage);
								if ($this->display_toc) {
									$this->toc_list($passage_header, $rtn_str, $toc);
								}
								$rtn_str		.= "<div class=\"brp-passage\">$passage_header</div>";
							}
						}
						$n++;	
						if (is_array($txt_ary)) {
							foreach ($txt_ary as $key => $txt) {
								$passage1 = preg_replace('| 1$|', '', $passage);
								if (!isset($use_abs4apocrypha[$passage])) {
									$use_abs4apocrypha[$passage] = false;
								}
								if ($use_abs4apocrypha[$passage] || in_array($passage1, $this->one_chapter_books) && in_array($passage1, $this->book_names_ap)) {
									$txt					= str_replace('apocrypha', '', $txt);
									if ('dbp_' == $this->scptr_src_prefix) {
										$passage_header	 = $this->transform_header($passage_index);
										if ($this->display_toc) {
											$this->toc_list($passage_header, $rtn_str, $toc);
										}
										$rtn_str 		.= "<div class=\"brp-passage\">$passage_header</div>";
									} else {
										if ($this->display_toc) {
											$this->toc_list($passage, $rtn_str, $toc);
										}
									}
									$rtn_str			    = $this->put_verses_abs($rtn_str, $txt, $fumsIDs_array, true);
									$apocrypha_copyright   .= __('Portions from the Apocrypha are from the ', 'bible-reading-plans');
									$apocrypha_copyright   .= $this->abs_vers_default['KJV-E']['name'].', '.__('Source: ', 'bible-reading-plans').$this->abs_sctr_src_url.', ';
									$apocrypha_copyright   .= __('Copyright: ', 'bible-reading-plans');
									$apocrypha_copyright   .= $this->abs_copyright.'.';
								} elseif ('abs_' == $this->scptr_src_prefix) {
									if (0 == $passage_index) {
										$get_abs_meta = true;
									} else {
										$get_abs_meta = false;
									}
									$rtn_str = $this->put_verses_abs($rtn_str, $txt, $fumsIDs_array, $get_abs_meta);
								} elseif ('esv_' == $this->scptr_src_prefix && !$use_abs4apocrypha[$passage]) {
									$rtn_str = $this->put_verses_esv($rtn_str, $txt);
								} elseif ('dbp_' == $this->scptr_src_prefix) {
									$rtn_str = $this->put_verses_dbp($rtn_str, $txt, $passage_index, $prgrph_nr);
								}
							}
						} else {
							$rtn_str = '';
						}
					}
					if ($this->display_toc) {
						$toc	 .= "</ul></div>\n";
						$rtn_str  = $rtn_str.$toc;
					}
					// DO NOT REMOVE THE COPYRIGHT INFORMATION FOR THE SCRIPTURE TEXTS.
					$end_texts = end($texts);
					if ('abs_' == $this->scptr_src_prefix || $apocrypha_copyright) {
						$rtn_str   .= '
							<script type=\"text/javascript\"> 
								var fumsIDarray = ['.$fumsIDs_array.']
								fumsIDarray.forEach(sendFUMSIDs);
								function sendFUMSIDs(item) {
									try {
										_BAPI.t(item);
									}
									catch {
										// alert("ERROR: Could not transmit Fair Use Management System ID:" + item + ".");
									}
								}
							</script>';
					}
					if ('abs_' == $this->scptr_src_prefix) {
						$scriptures_copyright .= $this->text_source.'<br />'.__('Scriptures copyright: ', 'bible-reading-plans').$this->abs_copyright.'.';
					} elseif ('dbp_' == $this->scptr_src_prefix) {
						if ('Public Domain' == $copyright_ary['copyright']) {
							$scriptures_copyright .= $this->text_source.'<br />'.__('Scriptures Copyright: ', 'bible-reading-plans');
						} else {
							$scriptures_copyright .= $this->text_source.'<br />'.__('Scriptures &copy; Copyright: ', 'bible-reading-plans');
						}
						if ($copyright_ary['date']) {
							$scriptures_copyright .= IntlDateFormatter::formatObject(strtotime($copyright_ary['date']), " yyyy ", $this->lng_code_iso);
						}
						$scriptures_copyright .= $copyright_ary['copyright'];
					} elseif ('esv_' == $this->scptr_src_prefix) {
						$scriptures_copyright .= $this->text_source.'<br />'.__('Scriptures copyright: ', 'bible-reading-plans').$this->esv_copyright.'.';
						$rtn_str   .= '<br />';
					}
					$rtn_str .= '<div class="brp-copyright-small">';
					if ('standardized' == $reading_plan[0]['copyright'] || 'Public Domain' == $reading_plan[0]['copyright']) {
						if ('Public Domain' == $reading_plan[0]['copyright']) {
							$reading_plan[0]['copy_type'] = 'Public Domain';
						}						
						switch ($reading_plan[0]['copy_type']) {
						
							case 'Alan Hartless':
								$rtn_str .= __('This Bible reading plan from ', 'bible-reading-plans').$reading_plan[0]['plan_orgn'].__(' is licensed under the <a target="_blank" href="https://www.gnu.org/licenses/gpl-3.0.en.html">GNU General Public License v.3</a> by Alan Hartless in a plugin written for Joomla: https://github.com/alanhartless/bibleplan, &copy; HartlessByDesign 2011. All rights reserved. Licensed under GNU General Public License v.3.', 'bible-reading-plans');
								break;
								
							case 'ACNA':
								$rtn_str .= __('All not-for-profit reproduction of this Bible reading plan by churches and non-profit organizations is permitted (reference Copyright statement in <a href="https://bcp2019.anglicanchurch.net/" target="_blank">', 'bible-reading-plans').'<span style="font-style: italic;">The Book of Common Prayer</span></a>, 2019, Anglican Church in North America). '.'<span style="font-size: 0.9em;">'.__('Many thanks to ', 'bible-reading-plans').'<a href="https://www.joshuapsteele.com/" target="_blank">The Revd Joshua P Steele</a> '.__('for supplying this plan in digital form.', 'bible-reading-plans').'</span>';
								break;
								
							case 'Public Domain':
								$rtn_str .= __('This Bible reading plan by ', 'bible-reading-plans').$reading_plan[0]['plan_orgn'].__(' is in the Public Domain.', 'bible-reading-plans');
								break;
								
							default:
								$rtn_str .= $reading_plan[0]['copy_type'];
							
						}
					} else {
						$rtn_str .= $reading_plan[0]['copyright'];
					}
					$rtn_str .= $scriptures_copyright.'<br />';
					$rtn_str .= $apocrypha_copyright.'</div>';
				} else {
					$rtn_str = $this->return_api_error($texts);
				}
			} else {
				$rtn_str = '';
				if ($this->use_calendar) {
					$rtn_str .= $this->date_picker();
				}
				$rtn_str .= '<div class="brp-no-readings">'.__('No readings for this date.', 'bible-reading-plans').'</div>';
			}
		} else {
			$rtn_str = __("$error_message for $scriptures_date from ", 'bible-reading-plans').$this->text_source.'.';
		}
		if ($this->show_poweredby) {
			$rtn_str .= '<div class="brp-powered-by">';
			$rtn_str .= __($this->powered_by, 'bible-reading-plans');
			$rtn_str .= '</div>';
		}
		$scriptures_div = '<div id="brp-scriptures"><noscript><h3 style="color: #EDD400; margin: 20px auto; text-align: center; background-color: #FF0000; padding: 15px; border: 2px outset #EDD400;">This page needs JavaScript activated to work.</h3></noscript>'.$this->loading_image.'</div>';
		if ($scriptures_date) {
			return $rtn_str; // with calendar, and loaded with calendar selection 
		} elseif ($this->use_calendar) {
			 // with calendar, but loaded without calendar selection
			return  '<div title="'.__('Click on a date to open the readings for that day.', 'bible-reading-plans').'" id="datepicker_above"></div>'.$scriptures_div;
		} else {
			return $scriptures_div; // no calendar
		}
	}
	
	protected function convert_dbp4_url_to_abs_url_end ($dbp4_url = '') {
		global $book_id;
		$tmp_ary									= explode('/', $dbp4_url);
		$chapter_and_verses							= array_pop($tmp_ary);
		$book_id									= array_pop($tmp_ary);
		list($chapter, $verses)						= explode('?', $chapter_and_verses);
		list($verse_start_stmnt, $verse_end_stmnt)	= explode('&', $verses);
		list($tmp, $verse_start)					= explode('=', $verse_start_stmnt);
		list($tmp, $verse_end)						= explode('=', $verse_end_stmnt);
		$abs_url_end								= $book_id.'.'.$chapter.'.'.$verse_start.'-'.$book_id.'.'.$chapter.'.'.$verse_end;
		return $abs_url_end;
	}
	
	protected function get_from_default_apocrypha ($input = array()) {
		// Default Apocrypha is the King James Version, Ecumenical, from API.Bible (ABS).
		$version	= $this->abs_vers_default['KJV-E']['id'];
		if (isset($input['url'])) {
			$url = $input['url'];
		} else {
			$url = '';
		}
		if ('abs_' == $this->scptr_src_prefix) {
			$matches = array();
			preg_match("|\/verses\/[A-Z0-9\.-]+$|", $url, $matches);
			$abs_url = $this->abs_url_base.'/'.$version.$matches[0];
		} elseif ('dbp_' == $this->scptr_src_prefix) {
			$abs_url = $url;
		} elseif ('esv_' == $this->scptr_src_prefix) {
			$book				= $input['book'];
			$chapter_and_verses	= $input['chapter_and_verses'];
			if (false !== strpos($chapter_and_verses, ':')) {
				list($chapter_id, $verses)		= explode(':', $chapter_and_verses);
				list($verse_start, $verse_end)	= explode('-', $verses);
				if ($this->end_verse_name == $verse_end) {
					$verse_end = $this->end_verse;
				}
			} elseif ($chapter_and_verses) {
				$chapter_id  = $chapter_and_verses;
				$verse_start = 1;
				$verse_end   = $this->end_verse;
			} else {
				// Book with only one chapter.
				$chapter_id  = 1;
				$verse_start = 1;
				$verse_end   = $this->end_verse;
			}
			$passage	= $book.'.'.$chapter_id.'.'.$verse_start.'-';
			$passage   .= $book.'.'.$chapter_id.'.'.$verse_end;
			$abs_url	= $this->abs_url_base.'/'.$version.'/verses/'.urlencode($passage);
		}
		$args		= array('headers' => array("api-key" => $this->abs_api_key, "accept" => "application/json"));
		$response	= wp_remote_get($abs_url, $args);
		return $response; 
	}

	public function putLanguagesAndVersions () {
		$media_exclude	= $this->dbp_excluded_media_list();
		$base_url		= "{$this->dbp_query_string}bibles?limit=9999&v=4&key={$this->dbp_api_key}&page=";
		$ch				= curl_init();
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$bibles_pages	= array();
		$i				= 0;
		$nr_in_data_ary	= 1;
		while ($nr_in_data_ary) {
			$url 				= $base_url.$i;
			curl_setopt($ch, CURLOPT_URL, $url);
			$bibles_pages[$i]	= json_decode(trim(curl_exec($ch)), true);
			$nr_in_data_ary		= count($bibles_pages[$i++]['data']);
		}
		curl_close($ch);
		unset($bibles_pages[$i-1]);
		$this->dbp_language_ids		= array();
		$this->dbp_bible_id_to_iso	= array();
		$this->dbp_lang_id2iso_alt	= array();
		$this->dbp_versions			= array('time_created' => time());
		list($two_ltr_cd, $tmp)	= explode('', 'WPLANG');
		$this->site_language	= array_search($two_ltr_cd, $this->lng_name_to_2_ltr_cd);
		if (!$this->site_language) {
			$this->site_language = $this->site_lang_default;
		}
		foreach ($bibles_pages as $key => $bibles_group) {
			foreach ($bibles_group['data'] as $data_ary) {
				foreach ($data_ary['filesets']['dbp-prod'] as $fs_key => $filesets) {
					// The bibles query should retrieve only text versions. (See $base_url above.) 
					// However, that is apparently not correct. Therefore, the non-text versions are filtered out here.
					$not_text = preg_match("/(audio|video|film|Winfred Henson)/i", $data_ary['name']);
					if ('text_usx' == $filesets['type']) {
						// Do not use usx-formatted files for this version.
						
						/* There is, however, an xslt file available at <script src="https://gist.github.com/jonbitgood/d3eac3aa9dc25a1413cebf1c437b93ec.js"></script> which could be of use. The creator of this xslt file says "It looks nice with the css from API.bible." (https://github.com/ubsicap/usx/issues/39) This xslt file is recorded here, in case the version at GitHub goes away:
							<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
								<xsl:output indent="yes" />
								<xsl:strip-space elements="*" />

								<xsl:template match="usx">
									<html>
										<head>
											<meta content="utf-8" />
											<link rel="stylesheet" href="bible.css" />
										</head>
										<body>
											<main><xsl:apply-templates /></main>
										</body>
									</html>
								</xsl:template>

								<xsl:template match="para[@style='rem']|para[@style='ide']|verse[@eid]"></xsl:template>

								<xsl:template match="para">
									<p><xsl:apply-templates select="@*|node()" /></p>
								</xsl:template>

								<xsl:template match="char">
									<em><xsl:apply-templates select="@*|node()" /></em>
								</xsl:template>

								<xsl:template match="note">
									<span class="note"><xsl:apply-templates select="@*|node()" /></span>
								</xsl:template>

								<xsl:template match="chapter">
									<b class="c"><xsl:value-of select="@number" /></b>
								</xsl:template>

								<xsl:template match="verse[@sid]">
									<sup class="verse"><xsl:value-of select="@number" /></sup>
								</xsl:template>

								<xsl:template match="book">
									<div>
										<xsl:attribute name="id">
											<xsl:value-of select="@code" />
										</xsl:attribute>
									</div>
								</xsl:template>

								<xsl:template match="@*|node()">
									<xsl:copy><xsl:apply-templates select="@*|node()" /></xsl:copy>
								</xsl:template>
							</xsl:stylesheet>
						*/
						
						break;
					}
					if (isset($data_ary['iso']) && $data_ary['iso'] && 1 != $not_text) {
						if (strpos($filesets['type'], 'ext_')) {
							$dbp_versions[$data_ary['iso']][]			= array(
																					'bible_abbr'		=> $data_ary['abbr'],
																					'bible_id' 			=> $filesets['id'], 
																					'dbp_version' 		=> $filesets['volume'],
																					'dbp_version_natv'	=> $data_ary['vname'],
																					'size'				=> $filesets['size'],
																					'language_name' 	=> $data_ary['language'], 
																					'native_name' 		=> $data_ary['autonym'], 
																					'type'				=> $filesets['type'],
																					);
							$this->dbp_bible_id_to_iso[$filesets['id']]	= $data_ary['iso'];
							$lang_id									= substr($filesets['id'], 0, 3);
							$dbp_lang_id2iso_alt[$lang_id]				= $data_ary['iso'];
							if (isset($data_ary['language']) && $data_ary['language']) {
								$this->dbp_language_ids[$data_ary['language']]	= array( 
																						'native_name'		=> $data_ary['autonym'],
																						'lng_code_iso' 		=> $data_ary['iso'],
																						);
								if ($this->site_language == $data_ary['language']) {
									$lng_code_iso = $data_ary['iso'];
								}
							}
						}
					}
				}
			}
		}
		foreach ($dbp_versions as $iso => $ary) {
			$this->dbp_versions[$iso] = array_unique($ary, SORT_REGULAR);
		}
//		array_multisort (array_column($this->dbp_language_ids, 'native_name'), SORT_ASC, $this->dbp_language_ids);
		$this->dbp_lang_id2iso_alt = array_unique($dbp_lang_id2iso_alt);
		update_option('bible_reading_plans_dbp_bible_id_to_iso', $this->dbp_bible_id_to_iso);
		update_option('bible_reading_plans_dbp_lang_id2iso_alt', $this->dbp_lang_id2iso_alt);
		update_option('bible_reading_plans_dbp_lang_id_to_iso', $this->dbp_language_ids);
		update_option('bible_reading_plans_dbp_versions', $this->dbp_versions);
		if ($lng_code_iso) {
			$this->lng_code_iso	= $lng_code_iso;
		} else {
			$lng_code_iso		= $this->lng_code_iso;
		}
		echo '		'.$this->construct_dbp_versions_list($lng_code_iso);
		echo '		'.$this->construct_dbp_languages_list($lng_code_iso);
		$this->add_versions('dbp');
		die();
	}
	
	protected function if_necessary_convert_dbp2_plan_to_dbp4_plan ($reading_plan = array(), &$plan_converted = false) {
		if (!isset($reading_plan[0]['dbp_v']) || 4 != $reading_plan[0]['dbp_v']) {
			$reading_plan = $this->convert_dbp2_plan_to_dbp4_plan($reading_plan);
			if (!isset($reading_plan[0]['dbp_v']) || 4 != $reading_plan[0]['dbp_v']) {
				// Not able to convert dbp2 plan to dbp4 plan
				$plan_converted = false;
				return __("ERROR: ").$reading_plan[0]['plan_name'].__(" could not be formatted for version 4.");
			} else {
				$plan_converted = true;
			}
		} else {
			$plan_converted = false;
		}
		return $reading_plan;
	}
	
	protected function move_readings_plans_arrays_to_database () {
		// If there are any new reading plans arrays, move them to the database.
		$path_to_plans = plugin_dir_path(__FILE__).'plans';
		if (is_dir($path_to_plans)) {
			if ($handle = opendir($path_to_plans)) {
				$reading_plans_list = array();
				while (false !== ($entry = readdir($handle))) {
					if ($entry != "." && $entry != "..") {
						$path_and_file = $path_to_plans.'/'.$entry;
						if ((include $path_and_file) == true) {
							$reading_plan = $this->if_necessary_convert_dbp2_plan_to_dbp4_plan($reading_plan);
							if (!is_array($reading_plan)) {
								echo $reading_plan;
							}
							$nr_sources	= count($this->sources);
							$nr_moved	= 0;
							foreach ($this->sources as $key => $value) {
								$source				= strtolower($key);
								$plan_option_name	= $this->brp_prefix.$source.'_'.$reading_plan[0]['short_code'];
								$reading_plans_list[$plan_option_name] = $reading_plan[0]['plan_name'];
								if ('abs' == $source) {
									$plan_to_save = $this->convert_dbp4_plan_to_abs_plan($reading_plan);
								} elseif ('dbp' == $source) {
									$plan_to_save = $reading_plan;
								}
								delete_option($plan_option_name); // Necessary to prevent next line returning false when there is no change
								if (update_option($plan_option_name, $plan_to_save)) {
									if (++$nr_moved >= $nr_sources) {
										if(unlink($path_and_file) == false) {
											_e("ERROR: Cannot remove $path_and_file.<br />", 'bible-reading-plans');
										}
									}
								} else {
									_e("ERROR: Cannot move ".$reading_plan[0]['plan_name']." to database.<br />", 'bible-reading-plans');
								}
							}
						} else {
							_e("ERROR: Cannot retrieve ".$reading_plan[0]['plan_name']." for moving to database.<br />", 'bible-reading-plans');
						}
					}
				}
				closedir($handle);
				$reading_plans_list_0 = get_option('brp_reading_plans_list');
				if (is_array($reading_plans_list_0) && count($reading_plans_list_0)) {
					/* For testing
					foreach ($reading_plans_list_0 as $key => $val) {
						if (strpos($key, $this->brp_prefix.'dbp_') !== false) {
							 echo "$key</br>";
						}
					} */
					$reading_plans_list	= array_merge ($reading_plans_list_0, $reading_plans_list);
				}
				update_option('brp_reading_plans_list', $reading_plans_list);
				if (!rmdir($path_to_plans)) {
					_e("ERROR: Cannot remove $path_to_plans.<br />", 'bible-reading-plans');								
				}
			}
		}
	}

	protected function moveable_feasts_dates ($date_key, $scriptures_date) {
		$days_to_easter = array (
								'Ash Wednesday'		=> -46,
								'Maundy Thursday'	=> -3,
								'Good Friday'		=> -2,
								'Holy Saturday'		=> -1,
								'Easter Sunday'		=> 0,
								'Ascension Day'		=> +39,
								'Pentecost'			=> +49,
								);
		$date_key_yday	= date('z', strtotime($scriptures_date));
		if ($date_key_yday < 34 || $date_key_yday > 173) {
			// Earliest Ash Wednesday is Feb 4, latest Pentecost is June 20. Pad dates a bit...
			return $date_key;
		}
		$tmp_ary	 	= array();
		$tmp_ary	 	= explode(' ', $scriptures_date);
		$easter_yday 	= date('z', easter_date($tmp_ary[3]));
		foreach ($days_to_easter as $name => $days) {
			$yday = $easter_yday + $days;
			if ($yday == $date_key_yday) {
				return $name;
			}
		}
		return $date_key;
	}
	
	protected function parse_bk_chp_vrs ($src) {
		$tmp_ary = array();
		$tmp_ary = explode(' ', $src);
		if (is_numeric($tmp_ary[0])) {
			$book    			= $tmp_ary[0].' '.$tmp_ary[1];
			$chapter_and_verses = $tmp_ary[2];
		} else {
			$book    			= $tmp_ary[0];
			$chapter_and_verses = $tmp_ary[1];
		}
		return array($book, $chapter_and_verses);
	}
	
	protected function put_verses_abs ($rtn_str, $txt, &$fumsIDs_array, $get_abs_meta = false) {
		$decoded_text = json_decode($txt);
		$tmp_ary	  = array('',);
		if (isset($decoded_text->data)) {
			$tmp_ary	  = explode('.', $decoded_text->data->id);
			$tmp_str	  = str_replace("¶ ", "", $decoded_text->data->content);
			$fst_vrs	  = $tmp_ary[2];
			$chp_lbl	  = $tmp_ary[1].':'.$fst_vrs;
		} else {
			$tmp_str	  = '';
			$fst_vrs	  = '';
			$chp_lbl	  = '';
		}
		$rtn_str	 .= '<div id="brp-content" class="eb-container">';
		$search	  	  = '<span data-number="'.$fst_vrs.'" data-sid="'.$tmp_ary[0].' '.$chp_lbl.'" class="v">'.$fst_vrs;
		$replace  	  = '<span class="brp-chapter-nr">'.$chp_lbl.' ';
		$rtn_str 	 .= str_replace($search, $replace, $tmp_str);
		$rtn_str	 .= '</div>';
		if ($get_abs_meta) {
			if (isset($decoded_text->data)) {
				$this->abs_copyright = $decoded_text->data->copyright;
			} else {
				$this->abs_copyright = '';
			}
			$rtn_str	.= '
				<script src="https://cdn.scripture.api.bible/fums/fumsv2.min.js"></script>';
			$fumsIDs_array		 = '';
		}
		if (isset($decoded_text->meta) && isset($decoded_text->meta->fumsId)) {
			$fumsIDs_array	.= '"'.$decoded_text->meta->fumsId.'", ';
		}
		return $rtn_str;
	}
	
	protected function poetic_passage ($text = '') {
		//This may need more work...
		$search  = array("|([a-zA-Z -]+)([,;:.?!])\s+|", "|([,;:.?!”'\"])$|", "|[ ]*Selah[ ]*|");
		$replace = array('$1$2<br /><span class="brp-poetic-span">&nbsp;</span>', '$1<br />', '<span class="brp-selah">Selah</span><br />');
		return preg_replace($search, $replace, $text);
	}

	protected function transform_passage_dbp ($passage, $decoded_text) {
		// This function transforms the header from English to whatever language is being used.
		// Get book name for the language being used.
		if (isset($decoded_text['data'][0]['book_name_alt']) && $decoded_text['data'][0]['book_name_alt']) {
			$book = $decoded_text['data'][0]['book_name_alt'];
		} else {
			$book = $decoded_text['data'][0]['book_name'];
		}
		$parts = explode(' ', $passage);
		if (isset($parts[1])) {
			if (false !== strpos($book, $parts[1])) {
				$language_passage = $book;
			} else {
				$language_passage = $book.' '.$parts[1];
			}
			if (isset($parts[2])) {
				$language_passage .= ' '.$parts[2];
			}
		} else {
			$language_passage	= $book;
			if (isset($parts[1])) {
				$language_passage .= ' '.$parts[1];
			}
		}
		return $language_passage;
	}

	protected function put_verses_dbp ($rtn_str, $txt, $passage, &$prgrph_nr) {
		global $passage_prev;
		$decoded_text = json_decode($txt, true);
		if (isset($decoded_text['error']['message']) && 'No Fileset Chapters Found for the provided params' == $decoded_text['error']['message']) {
			$rtn_str .=  '<div class="brp-no-scriptures-available">'.__('No Scriptures available in this version for ', 'bible-reading-plans').$passage.'</div>';
			return $rtn_str;
		}
		$book_chapter_and_verses = explode(' ', $passage);
		if (is_numeric($book_chapter_and_verses[0])) {
			$english_book = $book_chapter_and_verses[0].' '.$book_chapter_and_verses[1];
		} else {
			$english_book = $book_chapter_and_verses[0];
		}
		if ($passage != $passage_prev) {
			$passage_prev	 = $passage;
			$passage		 = $this->transform_passage_dbp($passage, $decoded_text);
			$passage_header  = $this->transform_header($passage);
			$rtn_str		.= "<div class=\"brp-passage\">$passage_header</div>";
		}
		if (array_key_exists($english_book, $this->poetic)) {
			$is_poetic = true;
		} else {
			$is_poetic = false;
		}
		if (is_array($decoded_text)) {
			if ($prgrph_nr != -1) {
				$rtn_str  .=  "</p><p>"; 
				$prgrph_nr == -1;
			} else {
				$rtn_str  .=  "<p> </p>";
				$prgrph_nr == 1;
			}
			$chapter = -1;
			if ($is_poetic) {
				$rtn_str .=  '<div class="brp-poetic">';
			}
			foreach ($decoded_text as $data) {
				if (is_array($data)) {
					foreach ($data as $ary) {						
						if ($is_poetic) {
							if (isset($ary['verse_text'])) {
								$text = $this->poetic_passage($ary['verse_text']);
							} else {
								$text = '';
							}
						} else {
							if (isset($ary['verse_text'])) {
								$text = $ary['verse_text'];
							} else {
								$text = '';
							}
						}
						if (isset($ary['chapter']) && isset($chapter) && $ary['chapter'] > $chapter) {
							if ($prgrph_nr == -1) {
								$rtn_str .=  '<p class="brp-paragraph">';
							} else {
								$rtn_str .=  '</p><p class="brp-paragraph">';
							}
							if (isset($ary['paragraph_number'])) {
								$prgrph_nr = $ary['paragraph_number'];
							}
							$chapter = $ary['chapter'];
							$rtn_str   .= '<span class="brp-chapter-nr">'.$chapter.':'.$ary['verse_start'].'</span>&nbsp;'.$text.' ';
						} elseif (isset($ary['verse_text'])) {
							if ($is_poetic) {
								if (isset($ary['verse_start'])) {
									$rtn_str .=  '<span class="brp-verse-nr">'.$ary['verse_start'].'</span>&nbsp;';					
								}
								$rtn_str .= '&nbsp;'.$this->poetic_passage($ary['verse_text']);
							} else {
								if (isset($ary['verse_start'])) {
									$rtn_str .=  '<span class="brp-verse-nr">'.$ary['verse_start'].'</span>&nbsp;';						
								}
								$rtn_str .= '&nbsp;'.$ary['verse_text'];
							}
							$rtn_str .= ' ';
						} else {
							$rtn_str .=  ' ';
						}
					}
					if ($is_poetic) {
						$rtn_str .=  '</div>';
					}
				} else {
					$rtn_str .= $data;
				}
			}
		} else {
			$rtn_str .= '';
		}
		return $rtn_str;
	}

	protected function put_verses_esv ($rtn_str, $txt) {
		$decoded_text = json_decode($txt);
		if (!isset($decoded_text->passages)) {
			return $rtn_str;
		}
		// Remove all in h2 tag except link to audio and change h4 to div when class is psalm-title (this facilitates text wrapping).
		$pattern = array('|<h2 class="extra_text">[^(]+\([^h]+href="|m',
						 '|" title="[^)]+\)[^>]+></h2>|m',
						 '|<h3 id="([a-zA-Z0-9_-]+)">([^>]+)</h3>|',
						 '|<h3 id="([a-zA-Z0-9_-]+)" class="psalm-book">([^>]+)</h3>|',
						 '|<h4 id="([a-zA-Z0-9_-]+)" class="psalm-title">([^>]+)</h4>|',
						 '|<h4 id="([a-zA-Z0-9_-]+)" class="psalm-acrostic-title">([^>]+)</h4>|',
						 );
		$replace = array('
						<audio controls="" src="', 
						'"></audio><br />',
						'<div id="$1" class="subject-heading">$2</div>',
						'<div id="$1" class="psalm-book">$2</div>',
						'<div id="$1" class="psalm-title">$2</div>',
						'<div id="$1" class="psalm-acrostic-title">$2</div>',
						);
		$rtn_str .= '<div class="brp-container esv-text">';
		foreach ($decoded_text->passages as $passage) {
			$rtn_str .= preg_replace($pattern, $replace, $passage);
		}
		$rtn_str .= '</div><div class="passage-spacer"></div>';
		return $rtn_str;
	}

	protected function remote_get_scriptures ($urls_ary = array(), $date_key = '') {
		global $use_abs4apocrypha, $book_id;
		if ('abs_' == $this->scptr_src_prefix) {
			$args  = array('headers' => array("api-key" => $this->abs_api_key, "accept" => "application/json"));
		} elseif ('dbp_' == $this->scptr_src_prefix) {
			$args  = array('headers' => array("Authorization" => "Bearer $this->dbp_api_key", "v" => "4", "accept" => "application/json"));
		} elseif ('esv_' == $this->scptr_src_prefix) {
			$args  = array('headers' => array("Authorization" => "Token $this->esv_api_key", "accept" => "application/json"));
		}
		$texts				= array();
		$use_abs4apocrypha	= array();
		if (!empty($urls_ary)) {
			foreach ($urls_ary as $passage => $url) {
				$use_abs4apocrypha[$passage] = false;
				if (is_array($url)) {
					foreach ($url as $url_str) {
						$response_ary_1[$passage][] = wp_remote_get($url_str, $args);
					}
				} else {
					$response_ary_1[$passage][0] = wp_remote_get($url, $args);
				}
			}
			foreach ($response_ary_1 as $passage => $response_ary) {
				$i = 0;
				foreach ($response_ary as $response) {
					if (is_array($response) && !is_wp_error($response)) {
						if ('abs_' == $this->scptr_src_prefix) {
							if ('Not Found' == $response['response']['message']) {
								$args							= array('url' => $urls_ary[$passage]);
								$response						= $this->get_from_default_apocrypha($args);
								$use_abs4apocrypha[$passage]	= true;
							} elseif (strpos($response['body'], 'missing key') || strpos($response['body'], '"data":[]')) {
								return $this->err_flag.$this->api_request_err.'ABS.';
							}
						} elseif ('dbp_' == $this->scptr_src_prefix) {
							if (strpos($response['body'], "No Fileset Chapters Found for the provided params")) {
								$tmp_ary		= explode(' ', $passage);
								if (is_numeric($tmp_ary[0])) {
									$book = $tmp_ary[0].' '.$tmp_ary[1];
								} else {
									$book = $tmp_ary[0];
								}
								$book = trim($book);
								unset($tmp_ary);
								if (array_search($book, $this->book_names_ap) && $date_key) {
									if (isset($readings_querys[$date_key]) and is_array($readings_querys[$date_key])) {
										foreach ($readings_querys[$date_key] as $key => $tmp_ary) {
											if ($tmp_ary['passage'] == $passage) {
												$query_key = $key;
												break;
											}
										}
										unset($tmp_ary);
									}
									$url_end_abs  	= $this->convert_dbp4_url_to_abs_url_end($urls_ary[$passage][0]);
									$abs_passages	= array();
									$urls_ary_abs	= $this->construct_urls_array_abs(array($url_end_abs,), $abs_passages, $this->abs_vers_default['KJV-E']['id']);
									$args			= array('url' => $urls_ary_abs[0],);
									$response		= $this->get_from_default_apocrypha($args);
									if (is_wp_error($response)) {
										$texts[$passage][] = __('ERROR: Response to request for Scriptures yields an error.', 'bible-reading-plans');
									} elseif (is_array($response)) {
										if (strpos($response['body'], 'missing key') || strpos($response['body'], '"data":[]')) {
											$texts[$passage][] = $this->err_flag.$this->api_request_err.'DBP.';
										} else {
											$texts[$passage][]			 = $response['body'];
											$use_abs4apocrypha[$passage] = true;
										}
									} else {
										$texts[$passage][] = $response;
									}
									unset($response);
								} elseif (strpos($response['body'], 'Improperly formatted request')) {
									return $this->err_flag.$this->api_request_err.'DBP.';
								}
							}
							if ('metadata' == $passage) {
								$texts[$passage][0] = json_decode($response_ary[0]['body'], true);
							}
						} elseif ('esv_' == $this->scptr_src_prefix) {
							if (strpos($response['body'], 'Invalid application key in Authorization header')) {
								return $this->err_flag.$this->api_request_err.'ESV.';
							}
							$decoded_body = json_decode($response['body']);
							if (empty($decoded_body->passages)) {
								$book_chapter_and_verses = $this->parse_bk_chp_vrs($decoded_body->query);
								$book    				 = $book_chapter_and_verses[0];
								$chapter_and_verses		 = $book_chapter_and_verses[1];
								$passage				 = $decoded_body->query;
								if (in_array($book, $this->book_names_ap)) {
									$book_id	= array_search($book, $this->book_codes_names_ap);
									$args		= array('book' => $book_id, 'chapter_and_verses' => $chapter_and_verses);
									$response	= $this->get_from_default_apocrypha($args);
									if (is_wp_error($response)) {
										$texts[$passage][] = __('ERROR: Response to request for Scriptures yields an error.', 'bible-reading-plans');
									} elseif (is_array($response)) {
										if (strpos($response['body'], 'missing key') || strpos($response['body'], '"data":[]')) {
											$texts[$passage][] = $this->err_flag.$this->api_request_err.'ABS.';
										}
									}
									$texts[$passage][]				= $response['body'];
									$use_abs4apocrypha[$passage]	= true;
								} else {
									$texts[$passage][]				= $response['body'];
									$use_abs4apocrypha[$passage]	= false;
								}
							}
						} else {
							return $this->err_flag.': Neither ABS, DBP, nor ESV are specified.';
						}
						if (isset($response)) {
							if (is_array($response) && isset($response['body'])) {
								$texts[$passage][] = $response['body'];
							} else {
								$texts[$passage][] = $response;
							}
						}
					} elseif (is_wp_error($response)) {
						$texts[$passage][] = __('ERROR: Response to request for Scriptures yields an error.', 'bible-reading-plans');
					} else {
						$texts[$passage][] = __('ERROR: Response to request for Scriptures is not an array.', 'bible-reading-plans');
					}
					$i++;
				}
			}
			return $texts;
		} else {
			return __('ERROR: No URLs.', 'bible-reading-plans');
		}
	}

	protected function return_api_error ($text) {
		if (strpos($text, $this->err_flag) !== false) {
			return '<div style="font-size: 1.1em; color: #EDD400; margin: 20px auto; text-align: center; background-color: #FF0000; padding: 15px; border: 2px outset #EDD400;">'.$text.'</div>';
		} else {
			return $text;
		}
	}
	
	protected function toc_list ($passage, &$rtn_str, &$toc) {
		$anc 		 = preg_replace("|[\W]+|", '_', $passage);
		$toc 		.= '<li><a href="#'.$anc.'">'.$passage.'</a></li>'."\n";
		$rtn_str	.= '<a id="'.$anc.'"></a>'."\n";
	}

	protected function transform_header ($passage_header) {
		if (false !== strpos($passage_header, ':')) {
			$bk_cp_vr = explode(':', $passage_header);
			if (2 == count($bk_cp_vr)) {
				$book_and_chapter	= $bk_cp_vr[0];
				$verses				= $bk_cp_vr[1];
			} elseif (3 == count($bk_cp_vr)) {
				// More work needed here...
				$book_and_chapter	= $bk_cp_vr[0];
				list($verses, $next_chapter) = explode('-', $bk_cp_vr[1]);
				$verses				= $verses.'-'.$this->end_verse;
				$next_verses		= $bk_cp_vr[2];
			} else {
				// To be determined if necessary...
			}
		} else {
			$book_and_chapter	= $passage_header;
			$verses				= '1-'.$this->end_verse;
		}
		$tmp_ary = array();
		$tmp_ary = explode(' ', $book_and_chapter);
		if (is_numeric($tmp_ary[0])) {
			$book    = $tmp_ary[0].' '.$tmp_ary[1];
			$chapter = $tmp_ary[2];
		} else {
			$book    = $tmp_ary[0];
			if (isset($tmp_ary[1])) {
				$chapter = $tmp_ary[1];
			}
			if (isset($tmp_ary[2])) {
				$chapter .= ' '.$tmp_ary[2];
			}
		}
		if (in_array($book, $this->one_chapter_books)) {
			return $book;
		}
		if (isset($this->book_codes_names[$book])) {
			$book = $this->book_codes_names[$book];
		} else {
			// This was an attempt to separate book numbers from their names (e.g. 1John -> 1 John for as many languages as possible.
//			$book = preg_replace("/^([^\p{Lu}\p{Lt}]+)([\p{Lu}\p{Lt}]]?)/", "$1 $2", $book);
/*			if (false !== preg_match("|^[0-9]+[a-z-A-Z]+|", $book)) {
				$book = preg_replace("/^([0-9.]+)/", "$1 ", $book);
			}*/
		}
		if (FALSE !== strpos($verses, '-')) {
			list($start_verse, $end_verse) = explode('-', $verses);
		} else {
			$start_verse = 1;
			$end_verse	 = $this->end_verse_name;
		}
		if (1 == $start_verse && ($this->end_verse_name == $end_verse || $this->end_verse == $end_verse)) {
			$verses = str_replace(array('1-end', '1-'.$this->end_verse), '', $verses);
		}
		if (isset($next_chapter) && $next_chapter) {
			$passage_header = $book.' '.$chapter.':'.$start_verse.'-'.$next_chapter.':'.$next_verses;
		} elseif ($verses) {
			$passage_header = $book.' '.$chapter.':'.$verses;
		} elseif (isset($chapter)) {
			$passage_header = $book.' '.$chapter;
		} else {
			$passage_header = $book;
		}
		return $passage_header;
	}

	protected function translate_plan_names ($short_code) {
		$reading_plans = array(
								'back-to-the-bible-chronological'		=> __('Back to the Bible Chronological', 'bible-reading-plans'),
								'bcp19-acna-evening'					=> __('Book of Common Prayer, 2019, Anglican Church in North America -- Evening Prayer', 'bible-reading-plans'),
								'bcp19-acna-morning'					=> __('Book of Common Prayer, 2019, Anglican Church in North America -- Morning Prayer', 'bible-reading-plans'),
								'bcp19-acna-twoyear'					=> __('Book of Common Prayer, 2019, Anglican Church in North America -- Two Year Plan', 'bible-reading-plans'),
								'daily-light-on-the-daily-path-evening'	=> __('Daily Light on the Daily Path -- Evening', 'bible-reading-plans'),
								'daily-light-on-the-daily-path-morning'	=> __('Daily Light on the Daily Path -- Morning', 'bible-reading-plans'),
								'every-day-in-the-word'					=> __('Every Day In the Word', 'bible-reading-plans'),
								'heart-light-ot-and-nt'					=> __('Heartlight Old and New Testament', 'bible-reading-plans'),
								'lsb'									=> __('Literary Study Bible', 'bible-reading-plans'),
								'mcheyne'								=> __('M&#039;Cheyne One-Year Reading Plan', 'bible-reading-plans'),
								'one-year-chronological'				=> __('One Year Chronological', 'bible-reading-plans'),
								'one-year-tract'						=> __('M&#039;Cheyne One-Year Reading Plan', 'bible-reading-plans'),// for compatibility with the Embed Bible Passages plugin
								'through-the-bible'						=> __('Through the Bible in a Year', 'bible-reading-plans'),
							/*	Not yet in this plugin
								'bcp'									=> __('Book of Common Prayer, 1979', 'bible-reading-plans'),
								'esv-study-bible'						=> __('ESV Study Bible', 'bible-reading-plans'),
								'outreach'								=> __('Outreach', 'bible-reading-plans'),
								'outreach-nt'							=> __('Outreach New Testament', 'bible-reading-plans'),*/
								);
		if (isset($reading_plans[$short_code])) {
			return $reading_plans[$short_code];
		} else {
			return false;
		}
	}
	
	/* *****  Code for potential future use... *****		
	protected function sample_version_content () {
		// Currently for only the DBP. 
		// Check verses in the middle of the Old and New Testaments to see whether or not they contain content.
		// https://4.dbt.io/api/bibles/filesets/:fileset_id/:book/:chapter?verse_start=5&verse_end=5
		// $this->dbp_query_string."bibles/filesets/".$this->dam_id.$qry_str.$this->dbp_query_base;
		$sample_querys	= array(
								array(
									'passage'	=> 'Ps 50:1',
									'verses'	=> array('PSA/50?verse_start=1&verse_end=1',),
								),
								array(
									'passage'	=> '2Thess 1:12',
									'verses'	=> array('2TH/1?verse_start=12&verse_end=12',),
								)
							);
	}
	
	protected function verify_version_content ($language_code = 'ENG') {
		// Currently for only the DBP. 
		$tmp_ary				= array();
		// An element of the $version_names array is the name of the language.
		foreach ($this->dbp_versions as $version_id => $version_name) {
			$urls_ary = array($this->dbp_query_string."bibles/$language_code$version_id?v=4&key=".$this->dbp_api_key,);
			$texts = $this->remote_get_scriptures($urls_ary);
			foreach ($texts as $key  => $version_meta) {
				if (!strpos($version_meta[0], 'error')) {
					$tmp_ary[$language_code][$version_id] = $version_name;
				}
			}
		}
		unset($this->dbp_versions);
		$this->dbp_versions	= $tmp_ary;
	} */

/*
$this->debug_print('', );
*/
protected function debug_print ($label = '', $input, $print_or_dump = 'print', $die = false) {
	echo '<br />'.$label.':&nbsp;';
	if (is_array($input) || is_object($input)) {
		echo '<pre>';
		if ('print' == $print_or_dump) {
			print_r($input);
		} else {
			var_dump($input);
		}
		echo '</pre>';
	} elseif (is_bool($input)) {
		if ($input) {
			echo 'true<br />';
		} else {
			echo 'false<br />';
		}
	} else {
		echo "$input<br />";
	}
	echo "<br />";
	if (!($die === false)) {
		die($die);
	}
}

}

?>
