<?php

namespace Transitive\Core;

abstract class Data {
	public static function rearrangeArray ($arr) {
	    $new=null;
	    foreach($arr as $key => $all) {
	        foreach($all as $i => $val) {
	            $new[$i][$key] = $val;
	        }
	    }
	    return $new;
	}

	public static function sort_by_index ($a, $b) {
		return (int) $a->getIndex() - (int) $b->getIndex();
	}

	public static function sort_by_rindex ($a, $b) {
		return self::sort_by_index($b, $a);
	}

	public static function sort_by_alphabetical_attr ($a, $b) {
		if(ord(substr(strtolower($a->getName()),0,1)) == ord(substr(strtolower($b->getName()),0,1)))
			return 0;
		return (ord(substr(strtolower($a->getName()),0,1)) < ord(substr(strtolower($b->getName()),0,1))) ? -1 : 1;
	}

	public static function sort_by_alphabetical_attr_alt ($a, $b) {
		$aAttr=($a->getOrderByName())?$a->getOrderByName():$a->getName();
		$bAttr=($b->getOrderByName())?$b->getOrderByName():$b->getName();
		if(ord(substr(strtolower($aAttr),0,1)) == ord(substr(strtolower($bAttr),0,1)))
			return 0;
		return (ord(substr(strtolower($aAttr),0,1)) < ord(substr(strtolower($bAttr),0,1))) ? -1 : 1;
	}

	public static function contentEditableParse ($content) {
		$content = str_replace('<br>', '<br />', trim($content));
		$content = str_replace('<div><br />', '<br /><br />', $content);
		$content = str_replace(array('<div>', '</div>'), '', $content);

		preg_match_all("/<div[^>]+>(.*?)<\\/div>/m", $content, $matches);

		preg_match("/^(<br \\/>)+$/", $content, $matches);

		if($matches)
			$content='';

		return $content;
	}
}

?>
