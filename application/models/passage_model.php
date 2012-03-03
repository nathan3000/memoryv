<?php

class Passage_model extends CI_Model {
	
	var $passage;
	var $words;
  var $verses;
	var $reference;
	var $blanks;
  var $punctuation;

	function __construct() 
	{
		parent::__construct();
	}

	function initialize($book, $chapter, $start_verse, $end_verse)
	{
		$key = "IP";
		if($end_verse != NULL) {
			$ref = $book." ".$chapter.":".$start_verse."-".$end_verse;
		} else {
			$ref = $book." ".$chapter.":".$start_verse;
		}
		$passage = urlencode($ref);
		$options = "output-format=plain-text&&include-passage-references=false&&include-first-verse-numbers=false&&include-verse-numbers=true&&include-footnotes=false&&include-short-copyright=false&&include-passage-horizontal-lines=false&&include-heading-horizontal-lines=false&&include-headings=false&&include-subheadings=falseinclude-selahs=false&&include-content-type=false";
		$url = "http://www.esvapi.org/v2/rest/passageQuery?key=$key&passage=$passage&$options";
		$ch = curl_init($url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		$response = curl_exec($ch);
		curl_close($ch);    
    
    $this->passage = $this->clean_string($response);    
    
    
    $this->verses = $this->parse_verses2($this->passage, $ref);   
            
    //$this->words = explode(" ", $this->passage);      
    
		return $this->passage;
	}	
  
  private function parse_punctuation($passage) {
    foreach($passage as $verse) {
      $words = $verse[1];
      foreach($words as $word) {
        echo $word;
      }
    }
  }

  private function parse_verses2($string, $ref) 
  {    
    $pattern = '/(\w)([[:punct:]])/';
    $replacement = '${1} ${2}';
    $string = preg_replace($pattern, $replacement, $string);    
    
    $pattern = '/\n/';
    $replacement = ' ';
    $string = preg_replace($pattern, $replacement, $string);
    
    $pattern = '/([0-9]+ \])/';
    $replacement = ' ';
    $string = preg_replace($pattern, $replacement, $string);
    
    $pattern = '/\[ /';
    $replacement = '#';
    $string = preg_replace($pattern, $replacement, $string);
        
    //$verses = explode("[", $string);
    $verses = preg_split('/#/', $string, -1, PREG_SPLIT_NO_EMPTY);     

    $tmp = array();
    
    $tmp['ref'] = $ref;
    
    $tmp['verses'] = array();
        
    for($i=0;$i<count($verses);$i++) {     
      $tmp['verses'][$i] = preg_split('/ /', $verses[$i], -1, PREG_SPLIT_NO_EMPTY);
    }
        
    return $tmp;
  }
  
  private function parse_verses($string) 
  {    
    $pattern = '/(\w)([[:punct:]])/';
    $replacement = '${1} ${2}';
    $string = preg_replace($pattern, $replacement, $string);
    
    $pattern = '/\n/';
    $replacement = ' ';
    $string = preg_replace($pattern, $replacement, $string);
    
    $verses = explode("[", $string);
    $verses = array_filter($verses);
    for($i=1;$i<=count($verses);$i++) {
      $verses[$i] = explode("]", $verses[$i]);
      $verses[$i][1] = explode(" ", $verses[$i][1]);
    }
    
    return $verses;
  }
  
  private function clean_string($string)
  {  
    $string = trim($string);
    $string = str_replace("\"", "", $string);    
    return $string;
  }  

	function get_words()
	{
    return $this->words;
	}
  
  function get_verses()
	{
    return $this->verses;
	}
  
  function get_punctuation($tokens) 
  {
    $i = 0;    
    foreach($tokens as $token) {
      $charlist = array(',', '.', '?', '!', '"');
      for($k = 0; $k < strlen($token); $k++) {        
        if(in_array($token[$k], $charlist)) {          
          $punctuation[$i] = $token[$k];
        }        
      }      
      $i++;
    }
    return $punctuation;
  }
  
  function remove_punctuation($token)
  {         
    return preg_replace("/[^a-z]+/i", "", $token);      
  }

}

?>
