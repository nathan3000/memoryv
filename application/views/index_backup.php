<!doctype html>
<html>
<head>
	<title>Bible Memory App</title>
	<link rel="stylesheet" href="bootstrap/assets/css/style.css" type="text/css" media="screen" />	
	<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 	
<script>
		$(document).ready(function(){    
      
            $("input:first").focus();

            $.ajaxSetup ({
                cache: false
            });

            var ajax_load = "<img src='<?=base_url();?>img/load.gif' alt='loading...' />";
                
            $("#ref").keypress(function(e) {
                if(e.which == 13) {
                    jQuery(this).blur();
                    jQuery("#get").focus().click();
                }
            });
            
            var level = (function() {
                var num = 1;
                          
                return {
                    increment : function() {
                        
                       console.log(num + " -- " + passage.totalNumberOfWords() );
                       if(num + 2 < passage.totalNumberOfWords()) {
                           return num++;
                       } else {
                            return num;
                       }
                    },
                    decrement : function() {
                       if(num > 0) {
                           return num--;
                       } else {
                            return num;
                       }
                       
                    },                    
                    get : function() {
                       return num;
                    }
                };
            })();
      
            var passage = (function() {
              var passageHTML = '';
              var passageData;
              var passageRef;
              var totalNumberOfWords = 0;
              
              function generateRandomNumbers(data, level) {
                var k = 0;
                var randomNumbers = [];
                var howManyRandomNumbers = level + 2;
                
                var numberOfWords = data.length;
                var j;
                
                while(randomNumbers.length < howManyRandomNumbers) {
                  j = Math.floor(Math.random()*(numberOfWords - 0) + 0);
                  if((jQuery.inArray(j, randomNumbers) < 0) && (!isPunctuation(data[j]))) {
                    randomNumbers.push(j);
                  }      
                }
                
                return randomNumbers;
              }
              
              function isPunctuation(word) {
                var punctuation = [',', '.', '!'];
                if(jQuery.inArray(word, punctuation) < 0) {
                  return false;
                } else {
                  return true;
                }
              }
              
              var parseRef = function(ref) {
                passageRef = ref;
                passageRef = passageRef.replace(' ', '<br />');
              }
              
              var generateHTML = function(data) {
                      var randomNumbers;  
                      passageHTML = '';   
                      totalNumberOfWords = 0;
                      
                      $.each(passageData, function(i, verses) {  
                        randomNumbers = generateRandomNumbers(verses, level.get()); 
                        $.each(verses, function(k, word) {  
                          totalNumberOfWords++;  
                          if(jQuery.inArray(k, randomNumbers) >= 0) { 
                            passageHTML += "<input id='" + word + "' class='blank' type='text' style='width:"+word.length+"em'/>";                             
                          } else {
                            passageHTML += "<span>" + word + "</span>";
                          }
                          if(!isPunctuation(verses[k+1])) {
                            passageHTML += " ";
                          } else {
                             totalNumberOfWords--;
                          }
                        });
                        
                      });
                  }
              
              return {
                  set : function(ref, verses) {
                      parseRef(ref);
                      passageData = verses;
                      generateHTML(passageData);
                  },
                  getVerses : function() {
                      return passageHTML;
                  },
                  getRef : function() {                        
                      return passageRef;
                  },
                  refresh : function() {
                      generateHTML(passageData);
                  },
                  totalNumberOfWords : function() {
                      return totalNumberOfWords;
                  }
              }
            })();
      
            $("#next").click(function(e) {
                e.preventDefault();
                level.increment();
                passage.refresh();
                $("#content").empty();
                $("#content").append(passage.getVerses());
                $("#level").html("level: " + level.get());
                $("#bible_ref").html(passage.getRef());
                $("input.blank:first").focus().toggleClass("focus");
            });
            
            $("#prev").click(function(e) {
                e.preventDefault();
                level.decrement();
                passage.refresh();
                if(level.get() > 0) {
                    $("#content").empty();
                    $("#content").append(passage.getVerses());
                    $("#level").html("level: " + level.get());
                    $("#bible_ref").html(passage.getRef());
                    $("input.blank:first").focus().toggleClass("focus");
                }                
            });
            
            $("#refresh").click(function(e) {
                e.preventDefault();
                passage.refresh();
                $("#content").empty();
                $("#content").append(passage.getVerses());;
                $("#bible_ref").html(passage.getRef());
                $("input.blank:first").focus().toggleClass("focus");
            });
            
            $('#content').delegate('input', 'keyup', function() {
                var id = $(this).attr("id");
                var value = $(this).val();
                if(id.toLowerCase() === value.toLowerCase()) {                
                    $(this).attr("readonly", "readonly");
                    $(this).addClass("done");
                    $("input.blank:not(.done):first").focus().toggleClass("focus"); 
                    $(this).css("background", "#99CC66");
                    if(/^[A-Z]+$/.test(id)) {
                      alert('Capital Letter');
                    }  
                }
                
            });
            
            //When Enter key is pressed it gives a 'hint' by adding the first letter 
            //of the expected word to the input box.
            $('#content').delegate('input', 'keydown', function(e) {
                if(e.keyCode == 13) { 
                var expectedWord = $(this).attr("id");  
                var charSoFar = $(this).val();
                var howManyCharSoFar = $(this).val().length;
                var howManyCharExpected = $(this).attr("id").length
                if( howManyCharSoFar < howManyCharExpected ) {
                  $(this).val(charSoFar + expectedWord[howManyCharSoFar]);
                }
              }   
                
            });        
      
			$("#get").click(function(e) {
				e.preventDefault();       
                var content = $("#content");
				var ref = $("#ref").val();
                content.html(ajax_load);
				$.post('index.php/passage/get_passage', {ref:ref},
                    function(data){                           
                        content.empty();                                    
                        if(data) {      
                          passage.set(data.ref, data.verses);
                          content.append( passage.getVerses() );
                          $("#level").html("level: " + level.get());
                          $("#bible_ref").html(passage.getRef());
                          $("input.blank:first").focus().toggleClass("focus");   
                        } else {
                          content.html("Please enter a valid bible reference.");
                        }
                      }, "json")
                  $("#controls").show();
                  $("#meta").show();
        
                });
        
      	
		});
			
</script>
</head>
<body>
<div id="wrap">  
<h1><img src='<?=base_url();?>img/logo.png' alt='memoryv logo' /></h1>
  <div id="search-bar">  
  <input id="ref" type="text" value="" />
	<a id="get" class="button" href="#">get</a>
  </div>	
  </div>
  <div id="wrap2">
  <div id="meta" style="display: none"> 
    <span id="bible_ref"></span>
    <span id="level"></span>
  </div>
  <div id="content">
  
  </div>   
  </div>
  <div id="controls" style="display: none">  
    <ul>
        <li><a id="next" class="button" href="#">harder</a></li>
        <li><a id="refresh" class="button" href="#">refresh</a></li>
        <li><a id="prev" class="button" href="#">easier</a></li>
    </ul>
  </div>

</body>
</html>

