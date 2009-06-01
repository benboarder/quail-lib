<?php

class linkUsedForAlternateContent extends quailTest {

	var $default_severity = QUAIL_TEST_SUGGESTION;

	function check() {
		$head = $this->getAllElements('head');
		$head = $head[0];
		foreach($head->childNodes as $child) {
			if($child->tagName == 'link' && $child->getAttribute('rel') == 'alternate')
				return true;
		}
		$this->addReport(null, null, false);
	}
}
