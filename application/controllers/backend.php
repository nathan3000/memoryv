<?php

require_once('config.php');

$key = "IP";
$passage = urlencode("john 3:16");
$options = "output-format=plain-text&&include-passage-references=false&&include-first-verse-numbers=false&&include-verse-numbers=false&&include-footnotes=false&&include-short-copyright=false&&include-passage-horizontal-lines=false&&include-heading-horizontal-lines=false&&include-headings=false&&include-subheadings=falseinclude-selahs=false&&include-content-type=false";

$url = "http://www.esvapi.org/v2/rest/passageQuery?key=$key&passage=$passage&$options";
$ch = curl_init($url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$response = curl_exec($ch);
curl_close($ch);

$words = str_word_count($response, 1);


//Make word objects out of words in text
foreach ($words as $key => $value) {
	$verseWords[] = new Word($key, $value, 0);
//	echo "<span id=\"$key\" class=\"asdf\">$value</span>\n";
}

$n = count($words);
$f = 5;

for ($i = 0; $i <= $n; $i=$i+$f+1) {
	$r = rand($i, $i+$f);
	if ($r < 24) {
		$verseWords[$r]->setState(1);
	}
}

foreach ($verseWords as $key => $word) {
	if($word->getState() == 1) {
		$blankedWords[] = $word;
	}
}

shuffle($blankedWords);

?>

