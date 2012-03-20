$(document).ready(function(){    
      
            $("input:first").focus();

            $.ajaxSetup ({
                cache: false
            });

            var ajax_load = "<img src='assets/img/load-ball.gif' alt='loading...' />";
                
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
                passageRef = ref.capitalize();
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
                $(".passage h3").html(passage.getRef() + " - Level " + level.get());
                $("input.blank:first").focus().toggleClass("focus");
            });
            
            $("#prev").click(function(e) {
                e.preventDefault();
                level.decrement();
                passage.refresh();
                if(level.get() > 0) {
                    $("#content").empty();
                    $("#content").append(passage.getVerses());
                    $(".passage h3").html(passage.getRef() + " - Level " + level.get());
                    $("input.blank:first").focus().toggleClass("focus");
                }                
            });
            
            $("#refresh").click(function(e) {
                e.preventDefault();
                passage.refresh();
                $("#content").empty();
                $("#content").append(passage.getVerses());;
                $(".passage h3").html(passage.getRef() + " - Level " + level.get());
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
                $('.passage').show();
                content.html(ajax_load);
				$.post('index.php/passage/get_passage', {ref:ref},
                    function(data){                           
                        content.empty();                                    
                        if(data) {      
                          passage.set(data.ref, data.verses);
                          content.append( passage.getVerses() );
                          $(".passage h3").html(passage.getRef() + " - Level " + level.get());
                          $("input.blank:first").focus().toggleClass("focus");   
                        } else {
                          content.html("Please enter a valid bible reference.");
                        }
                      }, "json")
                  $("footer").show();
        
                });
             
            String.prototype.capitalize = function(){
             return this.replace( /(^|\s)([a-z])/g , function(m,p1,p2){ 
                     return p1+p2.toUpperCase(); 
                 } );
              }; 
		});
			
