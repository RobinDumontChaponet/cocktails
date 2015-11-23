<?php

namespace Transitive\Utils;

abstract class Optimization {

	public static function minify($src) {
		// Nothing there (but us chickens) anymore... for now.
		// It didn't work well anyway...
	}

	public static function newTimer () {
		return new Timed();
	}
}

class Timed {
	private $start;

	public function __construct () {
		$this->start = getrusage();
	}

	private static function _getrtime($ru, $rus, $index) {
		return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
		 - ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
	}

	public function printResult () {
		$ru = getrusage();
		$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

		echo '<b>Memory :</b> '.memory_get_peak_usage().'<br />';
	    echo '<b>Process Time :</b> '.($time*1000).' ms<br />';

		echo 'This process used '.self::_getrtime($ru, $this->start, "utime").' ms for its computations<br />';
		echo 'It spent '.self::_getrtime($ru, $this->start, "stime").' ms in system calls';
	}
}

?>