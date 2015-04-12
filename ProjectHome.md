# QUAIL 2 is here #
QUAIL has moved to being a jQuery plugin for speedier tests on the client side. Check it out at our [new home at GitHub](http://github.com/kevee/quail).

# What's happening to QUAIL 1? #
QUAIL 1 hit massive road blocks due to the poor DOM implementation (is there ever a good one!?) in PHP as well as the need to write our own CSS and JavaScript interpreters, which was daunting and cumbersome. At this point we would consider QUAIL 0.x track stable yet unsupported.

-About QUAIL-
QUAIL is a PHP library that lets you easily check HTML for adherence to accessibility standards. It comes with [over 200 tests](http://php.csumb.edu/projects/quail/group__tests.html) which implement [Open Accessibility Tests](http://www.atutor.ca/achecker/oac.php) and comes with WCAG 1.0, WCAG 2.0, and Section 508 guidelines.

Developers can build their own guidelines, or easily build a custom guideline that integrates with a database back-end or CMS. While the project supports checking entire HTML pages, integration with a CMS to check partial HTML content is probably the most popular use case.



## Requirements ##

Quail requires [cURL](http://php.net/manual/en/book.curl.php)  and [DOMdocument](http://php.net/manual/en/class.domdocument.php). Because of DOMDocument, QUAIL **requires PHP version 5 or higher**.

## Projects that use QUAIL ##
Check out the [Accessible Content](http://drupal.org/project/accessible_content) Drupal module, which is maintained by the author of QUAIL and is considered a test implementation of the project.

_Development work supported by [California State University, Monterey Bay](http://csumb.edu)_