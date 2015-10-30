<?php

namespace Transitive\Core;

function get_include_contents($filename) {
	if (is_file($filename)) {
		ob_start();
		ob_clean();
		include ($filename);
		return ob_get_clean();
	}
	return false;
}

class View {
	private $metaTags;
	//private $scripts;
	private $scriptTags;
	private $script;
	private $linkTags;
	//private $styleTags;
	//private $css;
	private $style;
	private $title;
	public $data;
	public $content;

	public function __construct ($test='argh') {
/*
		$this->metaTags = array();
		$this->scriptTags = array();
		$this->linkTags = array();
		$this->data = array();
*/
		$this->script = '';
		$this->style = '';
	}

	public function getTitle () {
		return $this->title;
	}
	public function setTitle ($title='') {
		$this->title = $title;
	}


	public function addRawMetaTag ($rawMetaTag) {
		$this->metaTags[] = $rawMetaTag;
	}
	public function addMetaTag ($name, $content) {
		$this->addRawMetaTag('<meta name="'.$name.'" content="'.$content.'">');
	}

	public function getMetaTags () {
		return $this->metaTags;
	}
	public function printMetaTags () {
		if(isset($this->metaTags))
			foreach($this->metaTags as $metaTag)
				echo $metaTag;
	}


	public function addRawScriptTag ($rawScriptTag) {
		$this->scriptTags[] = $rawScriptTag;
	}
	public function addScriptTag ($content, $type='text/javascript') {
		$this->addRawScriptTag('<script type="'.$type.'">'.$content.'</script>');
	}
	public function linkScript ($url, $type='text/javascript', $event=null) {
		$this->addRawScriptTag('<script type="'.$type.'" src="'.$url.'"></script>');

		// ... event...
	}
	public function addScript ($content) {
		$this->script .= $content.PHP_EOL;
	}
	public function importScript ($filename) {
		$this->addScript(get_include_contents($filename));
	}

	public function getScripts () {
		return $this->scriptTags;
	}
	public function printScripts () {
		if(isset($this->scriptTags))
			foreach($this->scriptTags as $scriptTag)
				echo $scriptTag;
		echo '<script type="text/javascript">'.$this->script.'</script>';
	}


	public function addRawLinkTag ($rawLinkTag) {
		return $this->linkTags[] = $rawLinkTag;
	}
	public function linkStylesheet ($href, $type='text/css', $rel='stylesheet') {
		$this->addRawLinkTag('<link rel="'.$rel.'" type="'.$type.'" href="'.$href.'" />');
	}
	public function addStyle ($content) {
		$this->style .= $content.PHP_EOL;
	}
	public function importStylesheet ($filename) {
		$this->addStyle(get_include_contents($filename));
	}

	public function getStyle () {
		return $this->style;
	}
	public function printStyle () {
		if(isset($this->linkTags))
			foreach($this->linkTags as $linkTag)
				echo $linkTag.PHP_EOL;
		echo '<style type="text/css">'.$this->style.'</style>';
	}


	public function getData () {
		return $this->data;
	}
	public function setData (&$data) {
		$this->data = $data;
	}


	public function displayContent () {
		if(isset($this->content)) {
			$content = $this->content;
			$content($this->data);
		} else
			echo 'default content';
	}
}

?>