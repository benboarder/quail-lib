<?php


/**
*	Returns the entire document marked-up to highlight problems.
*/
class reportDemo extends quailReporter {
	
	/**
	*	@var array An array of the classnames to be associated with items
	*/	
	var $classnames = array(QUAIL_TEST_SEVERE => 'quail_severe',
							QUAIL_TEST_MODERATE => 'quail_moderate',
							QUAIL_TEST_SUGGESTION => 'quail_suggestion',
							);
	
	/**
	*	The getReport method - we iterate through every test item and
	*	add additional attributes to build the report UI.
	*	@return string A fully-formed HTML document.
	*/
	function getReport() {
		$problems = $this->guideline->getReport();
		if(is_array($problems)) {
			foreach($problems as $testname => $test) {
				if(!isset($this->options->display_level) || $this->options->display_level >= $test['severity']) {
					foreach($test as $k => $problem) {
						if($problem->element) {
							$existing = $problem->element->getAttribute('style');
							$problem->element->setAttribute('style', 
								$existing .'; border: 2px solid red;');
							if($this->options->image_url) {
								$image = $this->dom->createElement('img');
								$image = $problem->element->parentNode->insertBefore($image, $problem->element);
								$image->setAttribute('alt', $testname);
								if($problem->message) {
									$image->setAttribute('title', $problem->message);
								}
								$image->setAttribute('src', $this->options->image_url[$test['severity']]);
								
							}
							//$problem->nodeValue .= $this->guideline->getSeverity($k);
						}
					}
				}
			}
		}		

		return $this->completeURLs($this->dom->saveHTML(), implode('/', $this->path));
	}
	
	
	/**
	*	Finds the final postion of a needle in the haystack
	*/
	function strnpos($haystack, $needle, $occurance, $pos = 0) {	
		for ($i = 1; $i <= $occurance; $i++) {
			$pos = strpos($haystack, $needle, $pos) + 1;
		}
		return $pos - 1;
	}
	
	/**
	*	A helper function for completeURLs. Parses a URL into an the scheme, host, and path
	*	@param string $url The URL to parse
	*	@return array An array that includes the scheme, host, and path of the URL
	*/
	function parseURL($url) {
	//protocol(1), auth user(2), auth password(3), hostname(4), path(5), filename(6), file extension(7) and query(8)
	$pattern = "/^(?:(http[s]?):\/\/(?:(.*):(.*)@)?([^\/]+))?((?:[\/])?(?:[^\.]*?)?(?:[\/])?)?(?:([^\/^\.]+)\.([^\?]+))?(?:\?(.+))?$/i";
	preg_match($pattern, $url, $matches);
	
	$URI_PARTS["scheme"] = $matches[1];
	$URI_PARTS["host"] = $matches[4];
	$URI_PARTS["path"] = $matches[5];
	
	return $URI_PARTS;
	}
	
	/**
	*	Turns all relative links to absolute links so that the page can be rendered correctly.
	*	@param string $HTML A complete HTML document
	*	@param string $url The absolute URL to the document
	*	@return string A HTML document with all the relative links converted to absolute links
	*/
	function completeURLs($HTML, $url) {
		$URI_PARTS = $this->parseURL($url);
		$path = trim($URI_PARTS["path"], "/");
		$host_url = trim($URI_PARTS["host"], "/");
		
		//$host = $URI_PARTS["scheme"]."://".trim($URI_PARTS["host"], "/")."/".$path; //ORIGINAL
		$host = $URI_PARTS["scheme"]."://".$host_url."/".$path."/";
		$host_no_path = $URI_PARTS["scheme"]."://".$host_url."/";
		
		//Proxifies local META redirects
		$HTML = preg_replace('@<META HTTP-EQUIV(.*)URL=/@', "<META HTTP-EQUIV\$1URL=".$_SERVER['PHP_SELF']."?url=".$host_no_path, $HTML);
		
		//Make sure the host doesn't end in '//'
		$host = rtrim($host, '/')."/";
		
		//Replace '//' with 'http://'
		$pattern = "#(?<=\"|'|=)\/\/#"; //the '|=' is experimental as it's probably not necessary
		$HTML = preg_replace($pattern, "http://", $HTML);
		
		//Fully qualifies '"/'
		$HTML = preg_replace("#\"\/#", "\"".$host, $HTML);
		
		//Fully qualifies "'/"
		$HTML = preg_replace("#\'\/#", "\'".$host, $HTML);
		
		//Matches [src|href|background|action]="/ because in the following pattern the '/' shouldn't stay
		$HTML = preg_replace("#(src|href|background|action)(=\"|='|=(?!'|\"))\/#i", "\$1\$2".$host_no_path, $HTML);
		$HTML = preg_replace("#(href|src|background|action)(=\"|=(?!'|\")|=')(?!http|ftp|https|\"|'|javascript:|mailto:)#i", "\$1\$2".$host, $HTML);
		
		//Points all form actions back to the proxy
		$HTML = preg_replace('/<form.+?action=\s*(["\']?)([^>\s"\']+)\\1[^>]*>/i', "<form action=\"{$_SERVER['PHP_SELF']}\"><input type=\"hidden\" name=\"original_url\" value=\"$2\">", $HTML);
		
		//Matches '/[any assortment of chars or nums]/../'
		$HTML = preg_replace("#\/(\w*?)\/\.\.\/(.*?)>#ims", "/\$2>", $HTML);
		
		//Matches '/./'
		$HTML = preg_replace("#\/\.\/(.*?)>#ims", "/\$1>", $HTML);
		
		//Handles CSS2 imports
		if (strpos($HTML, "import url(\"http") == false && (strpos($HTML, "import \"http") == false) && strpos($HTML, "import url(\"www") == false && (strpos($HTML, "import \"www") == false)) {
		$pattern = "#import .(.*?).;#ims";
		$mainurl = substr($host, 0, $this->strnpos($host, "/", 3));
		$replace = "import '".$mainurl."\$1';";
		$HTML = preg_replace($pattern, $replace, $HTML);
		}
		
		return $HTML;
		}

}