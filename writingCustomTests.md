# Extending the base QuailTest class #

To write a test for Quail, you need to extend the base class `QuailTest`. This class contains common helper functions for working with PHP's DOMDocument objects, plus a handy method to integrate with the reporting layers.

Once you have created your test and loaded it, you then need to add it to a guideline so that Quail will be able to include it. For running tests, however, you can use a method in Quail called `getTest` which runs a single test and returns the report array the test generated.

## Required implementation ##

Once you have your class created, it must implement the method `check()`. That is the only required method which Quail will use to run a test. Test classes inherit the following variables:

  * `dom` : Includes a full DOMDocument object of the page we are running tests against
  * `css` : An instance of the `QuailCSS` object, which you can use to get CSS information about a element. Typically the only helper method used is `getStyle($dom_element)`.
  * `path` : An array of path information. If this is a test run against a local file or a URL, this will contain an array of the heirarchy to that path.
  * `base_path` : The string representation of the above `path` variable.
  * `report` : An empty report array which will contain the results of your test. You shouldn't need to touch this.
  * `default_severity` : The severity level of the test


## Adding to a report ##
Once you have run across an accessiblity error on a page, typically by walking the DOM or using Xpath queries, you can then add problems using the `addReport()` method. The first argument should be the DOMElement that contains the problem (optional) and then contains other parameters that are optional like a plain string message and a boolean operator representing if the test passed or failed (useful if the test applies to an entire page instead of a specific element).

## Example ##
This is a test to find all images that lack an 'alt' attribute:

```
class imgHasAlt extends quailTest {

	var $default_severity = QUAIL_TEST_SEVERE;
	
	/**
	*	@var int The OAC test Number
	*/
	var $oac_test = 1;

	/**
	*	@var int The test severity
	*/	
	var $severity = QUAIL_TEST_SEVERE;
	
	/**
	*	The check method of this test. We are iterating through all img
	*	elements and tagging any without an ALT attribute.
	*/
	function check() {
		foreach($this->getAllElements('img') as $img) {
			if(!$img->hasAttribute('alt'))
				$this->addReport($img);
		}
	
	}
}

```
## Helper Methods ##

### getAllElemeents ###
Returns an array of all elements. The first param can be a tag name, or you can instead opt to find all HTML elements that fall into a predefined group (param 2) as defined in the file `common/elements.php`class imgHasAlt extends quailTest {

	var $default_severity = QUAIL_TEST_SEVERE;
	
	/**
	*	@var int The OAC test Number
	*/
	var $oac_test = 1;

	/**
	*	@var int The test severity
	*/	
	var $severity = QUAIL_TEST_SEVERE;
	
	/**
	*	The check method of this test. We are iterating through all img
	*	elements and tagging any without an ALT attribute.
	*/
	function check() {
		foreach($this->getAllElements('img') as $img) {
			if(!$img->hasAttribute('alt'))
				$this->addReport($img);
		}
	
	}
}

}}}```