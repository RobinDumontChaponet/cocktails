<?php

namespace Transitive\Utils;

abstract class Model {
	protected $id;

	function __construct ($id = -1) {
		$this->$id = $id;
	}

	public function getId () {
		return $this->id;
	}

	public function setId ($id = -1) {
		$this->id = $id;
	}

	public function __toString () {
		return  get_class().' [ id: '.$this->id.(((!get_parent_class()))?' ]':';  ');
	}
}

?>