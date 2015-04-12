# Setup of QUAIL #

Right now we are using some glob stuff that in some instnaces requires absolute file paths. To set this up, use the QUAIL\_PATH definition on the top of the quail.php file.

## Include the quail.php file and create quail object ##

Using quail is pretty straightforward, you just build a new quail object with the specified content and ask for a report back. Future versions will include additional configuration options. Just include the resource to check, the guideline to use, the type of resource it is, and the name of the reporter to use.

```
require_once('quail/quail.php');

//Checking a remote URI:
$quail = new quail('http://example.com/', 'wcag', 'uri', 'demo');

//Checking a string:
$quail = new quail('<img src="rex.jpg">', 'wcag', 'string', 'demo');

$quail->runCheck();
print $quail->getReport();


```

## CMS Integration: Adding CSS Files ##

Many folks trying to integrate quail with a CMS will find it easier to toss Quail all your CSS files or a string of your stored CSS sytlesheet. To do this, just create an array of file names and use the AddCSS method:

```
require_once('quail/quail.php');

//Checking a string (maybe the body area of a page)
$quail = new quail($body, 'wcag', 'string', 'array');
//Adding CSS information:
$quail->addCSS(array('/path/to/css/file.css', 'http://example.com/style/style.css'));
$quail->runCheck();
print_r($quail->getReport());

```