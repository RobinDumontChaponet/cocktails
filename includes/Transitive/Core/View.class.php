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
	private $scriptTags;
	private $script;
	private $linkTags;
	private $style;
	private $title;
	public $data;
	public $content;

	public function __construct () {
		$this->script = '';
		$this->style  = '';
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

		// @TODO
		// ... event...
	}
	public function addScript ($content) {
		$this->script .= $content.PHP_EOL;
	}
	public function importScript ($filename) {
		$this->addScript(get_include_contents($filename));
	}

	public function getScripts () {
		$scripts  = $this->scriptTags;
		$scripts[]= '<script type="text/javascript">'.$this->script.'</script>';
		return $scripts;
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

	public function getLinkTags () {
		return $this->linkTags;
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
	public function setData ($data) {
		$this->data = $data;
	}

	private function _display($content) {
		switch(gettype($content)) {
			case 'string' : case 'integer' : case 'double' :
				echo $content;
			break;
			case 'object' :
				if(get_class($content)=='Closure')
					$content($this->data);
				elseif(isset($content->content))
					echo $content->content;
			break;
			default:
				echo 'wrong view content type';
		}
		echo PHP_EOL;
	}

	public function displayContent ($key=NULL) {
		if(isset($this->content)) {
			$content = $this->content;

			if(gettype($content)=='array')
				if(isset($key)) {
					if(isset($content[$key]))
						$this->_display($content[$key]);
				} else
					foreach($content as $item)
						$this->_display($item);
			else
				$this->_display($content);

		} else
			echo 'default content';
	}
	private function _getContentForJson () {
		$content = array();
		if(isset($this->content)) {
			if(gettype($this->content)=='array')
				foreach($this->content as $key => $item) {
					ob_start();
					ob_clean();
					$this->_display($item);
					$content[$key] = ob_get_clean();
				}
			else {
				ob_start();
				ob_clean();
				$this->displayContent();
				$content['content'] = ob_get_clean();
			}
		}

		return $content;
	}
	public function outputJson () {
		$array = array(
			'metaTags' => $this->getMetaTags(),
			'scripts' => $this->getScripts(),
			'linkTags' => $this->getLinkTags(),
			'style' => $this->getStyle(),
			'title' => $this->getTitle()
		);

		$content = $this->_getContentForJson();
		if(count($content)>1)
			$array['content'] = $content;
		else
			$array['content'] = $content['content'];

		echo json_encode($array);
	}
	public function displayJsonContent () {
		echo json_encode($this->_getContentForJson());
	}
}

?>