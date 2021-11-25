<?php
namespace App\Models\simpleHtmlDom;
//use App\Models\simpleHtmlDom\simpleHtmlDom;

class htmlScraper {

CONST HDOM_TYPE_ELEMENT = 1;
CONST HDOM_TYPE_COMMENT = 2;
CONST HDOM_TYPE_TEXT = 3;
CONST HDOM_TYPE_ENDTAG = 4;
CONST HDOM_TYPE_ROOT = 5;
CONST HDOM_TYPE_UNKNOWN = 6;
CONST HDOM_QUOTE_DOUBLE = 0;
CONST HDOM_QUOTE_SINGLE = 1;
CONST HDOM_QUOTE_NO = 3;
CONST HDOM_INFO_BEGIN = 0;
CONST HDOM_INFO_END = 1;
CONST HDOM_INFO_QUOTE = 2;
CONST HDOM_INFO_SPACE = 3;
CONST HDOM_INFO_TEXT = 4;
CONST HDOM_INFO_INNER = 5;
CONST HDOM_INFO_OUTER = 6;
CONST HDOM_INFO_ENDSPACE = 7;

CONST DEFAULT_TARGET_CHARSET = 'UTF-8' ;
CONST DEFAULT_BR_TEXT = "\r\n" ;
CONST DEFAULT_SPAN_TEXT = ' ';
CONST MAX_FILE_SIZE = 600000;


	function file_get_html(
		$url,
		$use_include_path = false,
		$context = null,
		$offset = 0,
		$maxLen = -1,
		$lowercase = true,
		$forceTagsClosed = true,
		$target_charset = 'UTF-8',
		$stripRN = true,
		$defaultBRText = "\r\n",
		$defaultSpanText = ' ')
	{
		if($maxLen <= 0) { $maxLen = self::MAX_FILE_SIZE; }
		$dom = new \App\Models\simpleHtmlDom\simpleHtmlDom(
			false,
			$lowercase,
			$forceTagsClosed,
			$target_charset,
			$stripRN,
			$defaultBRText,
			$defaultSpanText
		);
		/**
		 * For sourceforge users: uncomment the next line and comment the
		 * retrieve_url_contents line 2 lines down if it is not already done.
		 */
		$contents = file_get_contents(
			$url,
			$use_include_path,
			$context,
			$offset,
			$maxLen
		);

		if (empty($contents) || strlen($contents) > $maxLen) {
			$dom->clear();
			return false;
			}
		return $dom->load($contents, $lowercase, $stripRN);
	}

	function str_get_html(
		$str,
		$lowercase = true,
		$forceTagsClosed = true,
		$target_charset = self::DEFAULT_TARGET_CHARSET,
		$stripRN = true,
		$defaultBRText = self::DEFAULT_BR_TEXT,
		$defaultSpanText = self::DEFAULT_SPAN_TEXT)
	{
		$dom = new simpleHtmlDom(
			null,
			$lowercase,
			$forceTagsClosed,
			$target_charset,
			$stripRN,
			$defaultBRText,
			$defaultSpanText
		);

		if (empty($str) || strlen($str) > self::MAX_FILE_SIZE) {
			$dom->clear();
			return false;
		}

		return $dom->load($str, $lowercase, $stripRN);
	}

	function dump_html_tree($node, $show_attr = true, $deep = 0)
	{
		$node->dump($node);
	}

}