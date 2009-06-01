<?php

class checkboxLabelIsNearby extends quailTest {

	var $default_severity = QUAIL_TEST_MODERATE;

	function check() {
		foreach($this->getAllElements('input') as $input) {
			if($input->getAttribute('type') == 'checkbox')
				$this->addReport($input);
			
		}
	}
}