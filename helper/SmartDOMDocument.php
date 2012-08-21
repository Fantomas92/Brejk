<?php

/**
* This class overcomes a few common annoyances with the DOMDocument class,
* such as saving partial HTML without automatically adding extra tags
* and properly recognizing various encodings, specifically UTF-8.
*
* @author Artem Russakovskii
* @version 0.4
* @link http://beerpla.net
* @link http://www.php.net/manual/en/class.domdocument.php
*/

class SmartDOMDocument extends DOMDocument {

	  public function __toString() {
		  return $this->saveHTMLExact();
	  }

	  public function loadHTML($html, $encoding = "UTF-8") {
		  $html = mb_convert_encoding($html, 'HTML-ENTITIES', $encoding);
		  @parent::loadHTML($html); // suppress warnings
	  }

	  public function saveHTMLExact() {
      $content = preg_replace(array("/^\<\!DOCTYPE.*?<html><body>/si",
                                    "!</body></html>$!si"),
                              "",
                              $this->saveHTML());

		  return $content;
	  }

}