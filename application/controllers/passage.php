<?php
class Passage extends CI_Controller {
	
	public function index()
	{
	 	$this->load->view('index');
	}
  
  public function get_passage()
  {
    $ref = $this->validate_reference($_POST['ref']);
    $pieces = explode("/", $ref);
    if($ref != null) {
      if(count($pieces) <= 3) {
        $this->load_passage($pieces[0], $pieces[1], $pieces[2]);
      } else {
        $this->load_passage($pieces[0], $pieces[1], $pieces[2],  $pieces[3]);
      }      
    } else {
      echo "";
    }
  }
  
  public function get_verses()
  {
    $this->Passage_model->initialize("John", "3", "16", "17");
    
    $passage = $this->Passage_model->get_verses(); 
    
    echo json_encode( $passage );
    
  }

	private function validate_reference() 
	{    
    //Validate bible reference
		if(preg_match("[[a-z]+ [1-9]+:[1-9]+(\-[1-9]+)?]", $_POST['ref'])) {
			$pieces = preg_split("/[\s,:]/", $_POST['ref']);
			if(strstr($pieces[2], '-')) {
				$verses = explode('-', $pieces[2]);        
        return $pieces[0]."/".$pieces[1]."/".$verses[0]."/".$verses[1];
				//$this->load_passage($pieces[0], $pieces[1], $verses[0],  $verses[1]);
			} else {
				//$this->load_passage($pieces[0], $pieces[1], $pieces[2]);
				return $pieces[0]."/".$pieces[1]."/".$pieces[2];
			}
		} else {
      return null;
    }
	}
  
	public function load_passage($book, $chapter, $start_verse, $end_verse=NULL) 
	{
		$this->Passage_model->initialize($book, $chapter, $start_verse, $end_verse);
    //$words = $this->Passage_model->get_words();    
    //echo json_encode($words);
    $words = $this->Passage_model->get_verses();      
    echo json_encode($words);
	}

}
?>
