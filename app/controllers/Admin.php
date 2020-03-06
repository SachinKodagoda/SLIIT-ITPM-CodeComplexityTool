<?php
class Admin extends BaseController
{
    // ADMIN PAGE
    public function index()
    {
        if (isset($_FILES["fileToUpload"]["name"])) {
            $target_file = basename($_FILES["fileToUpload"]["name"]);
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if( $fileType == 'java'){
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Initializing Variables------------------------------------------------------------------------------------Start

                // Keywords or Reserve Words
                $keyworArr = [ 
                    "true","false", "NaN","null","void","enum",
                    "import", "export", "function" , "class", "new" , "this", "return", "super",
                    "try" , "catch", "finally", "throw","throws",
                    "public","private","protected", "default", //Access Modifiers
                    "final", "abstract", "transient","synchronized","native", "strictfp", "volatile","static", //NonAccess Modifiers
                    "const", "var", "let",
                    "break","continue",  "goto",
                    "else", 
                    "instanceof","typeof",
                    "implements","extends", "interface",
                    "delete","package","arguments","yield","event","debugger"
                    // "eval","in", "with"
                ];

                $dataTypeArr = ["boolean","char","byte","short","int","long","float","double","string"]; // TO DO: outside ones are not taken as identifiers
                $controlStructures = ["for", "while", "do", "if", "switch","case"]; // TO DO: ask about do while loop

                $wkw = 1; // Weight of keywords
                $wid = 1; // Weight of identifiers
                $wop = 1; // Weight of operators
                $wnv = 1; // Weight of numerical values
                $wsl = 1; // Weight of string literals

                $nkw = 0; // Number of keywords
                $nid = 0; // Number of identifiers
                $nop = 0; // Number of operators
                $nnv = 0; // Number of numerical values
                $nsl = 0; // Number of string literals

                $file = $_FILES["fileToUpload"]["tmp_name"];

                $dataArr = array(); // Final 3D Data Array

                // Initializing Variables-------------------------------------------------------------------------------------Done
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Sanitization Variables------------------------------------------------------------------------------------Start

                // Following variable will be used for full words search
                $convertedTostring = file_get_contents($file);

                //  Removes multi-line comments and does not create a blank line, also treats white spaces/tabs 
                $convertedTostring = preg_replace('!^[ \t]*/\*.*?\*/[ \t]*[\r\n]!s', '', $convertedTostring);

                //  Removes single line '//' comments, treats newline
                $convertedTostring = preg_replace('![ \t]*//.*[ \t]*[\r\n]!', "\n", $convertedTostring);

                //  Strip blank lines
                $convertedTostring = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $convertedTostring);

                // Following will be used for display purposes
                $stringWithSpaces = str_replace(' ', '&nbsp;',$convertedTostring);
                $stringWithSpacesAndTabs = str_replace("\t", '&nbsp;&nbsp;',$stringWithSpaces);
                $fixedStringArr = explode("\n", $stringWithSpacesAndTabs);
                // $fixedStringArr  = explode("\n", $convertedTostring);

                //Testing
                $bugTest = explode("\n", strtolower($convertedTostring));

                //Following is using for line by line search
                $sanitiedArray = explode("\n", strtolower($convertedTostring));                

                // Sanitization Variables-------------------------------------------------------------------------------------Done
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Croping Identifiers---------------------------------------------------------------------------------------Start

                $spReplaceArr =[
                    "[", "]" , "(" , ")" , "{" , "}" , ";" , "=" , "+" , "-" , "<" , ">" , "!", "~", "^", "%","\/", "\\", ".", "\,", "\"", "\'",
                ];

                $spWordsArr = [
                    "true","false", "NaN","null","void","enum",
                    "import", "export", "function" , "class", "new" , "this", "return", "super",
                    "try" , "catch", "finally", "throw","throws",
                    "public","private","protected", "default", //Access Modifiers
                    "final", "abstract", "transient","synchronized","native", "strictfp", "volatile","static", //NonAccess Modifiers
                    "const", "var", "let",
                    "break","continue",  "goto",
                    "else", 
                    "instanceof","typeof",
                    "implements","extends", "interface",
                    // "debugger","delete", "eval", "event","in", "with", "yield","package","arguments",
                    "boolean","char","byte","short","int","long","float","double","string",
                    "for", "while", "do", "if", "switch","case", "main" 
                ];

                
                $digitalRemovedString = preg_replace('/\d/', '', $convertedTostring);
                $finalCutForSpWords = strtolower($digitalRemovedString);

                foreach($spReplaceArr as $spReplaceItem){
                    $finalCutForSpWords = str_replace($spReplaceItem, ' ', $finalCutForSpWords);
                };

                foreach($spWordsArr as $spWord){
                    $finalCutForSpWords = preg_replace("/\b$spWord\b/", ' ', $finalCutForSpWords);
                };

                $nonwordCharRemovedArray = explode("\n", $finalCutForSpWords);

                // Croping Identifiers----------------------------------------------------------------------------------------Done
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Scope finding method--------------------------------------------------------------------------------------Start

                $OpenBracketCount = 0;
                $CloseBracketCount = 0;
                $ScopeCount= 0;
                $scopeArray = [];
                $scopeMapArray = [];
                $newOrderScopeArr = [];
                for ($i=0; $i < count($sanitiedArray); $i++) {
                    if(substr_count($sanitiedArray[$i], "{") == true) {
                        array_push($scopeArray,"{");
                        array_push($scopeMapArray,$i);
                        $OpenBracketCount++;
                    }
                    if(substr_count($sanitiedArray[$i], "}") == true) {
                        array_push($scopeArray,"}");
                        array_push($scopeMapArray,$i);
                        $CloseBracketCount++;
                    }

                    if((substr_count($sanitiedArray[$i], "for") == true) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i+1], "{") == false)){
                        array_push($newOrderScopeArr,
                            array(
                                "start" => $i,
                                "end"   => $i + 1,
                                "scope" => "for"
                            )
                        );
                    }
                    if((substr_count($sanitiedArray[$i], "if") == true) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i+1], "{") == false)){
                        array_push($newOrderScopeArr,
                            array(
                                "start" => $i,
                                "end"   => $i + 1,
                                "scope" => "if"
                            )
                        );
                    }
                    if((substr_count($sanitiedArray[$i], "else") == true) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i+1], "{") == false)){
                        array_push($newOrderScopeArr,
                            array(
                                "start" => $i,
                                "end"   => $i + 1,
                                "scope" => "else"
                            )
                        );
                    }
                    if((substr_count($sanitiedArray[$i], "while") == true) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i+1], "{") == false)){
                        array_push($newOrderScopeArr,
                            array(
                                "start" => $i,
                                "end"   => $i + 1,
                                "scope" => "else"
                            )
                        );
                    }
                }


                if($OpenBracketCount != $CloseBracketCount){
                    echo "Program Opening Closeing are wrong";
                }else{
                    $ScopeCount = $OpenBracketCount;
                }
                $scopedString = implode("",$scopeArray);
                $scopePosArrStart = [];
                $scopePosArrEnd = [];
                $searchStringLeft = "{";
                $searchStringCenter = "";
                $searchStringRight = "}";
                $replaceLength = 2;
                $replaceSring = "00";
                $totalRounds = $ScopeCount;

                for($i = 1 ; $i <= $totalRounds; $i++){
                    $replacePos = strpos($scopedString,($searchStringLeft.$searchStringCenter.$searchStringRight));
                    if($replacePos > -1){
                        array_push ($scopePosArrStart, $replacePos);
                        $scopedString = substr_replace($scopedString,$replaceSring,$replacePos,$replaceLength);
                        array_push ($scopePosArrEnd, ($replacePos + $replaceLength - 1));
                    }else{
                        $searchStringCenter = $searchStringCenter."00";
                        $replaceSring = $replaceSring."00";
                        $replaceLength += 2;
                        $totalRounds++;
                    }

                }

                for ($x=0; $x < count($scopePosArrStart); $x++) {
                    array_push($newOrderScopeArr,
                        array(
                            "start" => $scopeMapArray[$scopePosArrStart[$x]],
                            "end"   => $scopeMapArray[$scopePosArrEnd[$x]],
                            "scope" => ""
                        )
                    );
                }

                sort($newOrderScopeArr);
                $troubleStructures = ["class", "main", "for", "if", "else" , "while", "switch", "case", "do"];
                for ($y=0; $y < count($newOrderScopeArr); $y++) {
                    if($newOrderScopeArr[$y]['scope'] == ""){
                        if(
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y]['start']], $troubleStructures[0])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y]['start']], $troubleStructures[1])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y]['start']], $troubleStructures[2])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y]['start']], $troubleStructures[3])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y]['start']], $troubleStructures[4])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y]['start']], $troubleStructures[5])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y]['start']], $troubleStructures[6])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y]['start']], $troubleStructures[7])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y]['start']], $troubleStructures[8]))
                        ) 
                        {
                            
                            $scopeStringFinal = "";
                            foreach($troubleStructures as $troubleKey){
                                if(substr_count($sanitiedArray[$newOrderScopeArr[$y]['start']], $troubleKey)){
                                    $scopeStringFinal = $scopeStringFinal . " " . $troubleKey;
                                }
                            }
                            $newOrderScopeArr[$y]['scope'] = $scopeStringFinal;
                        }else if(
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y - 1]['start']], $troubleStructures[0])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y - 1]['start']], $troubleStructures[1])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y - 1]['start']], $troubleStructures[2])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y - 1]['start']], $troubleStructures[3])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y - 1]['start']], $troubleStructures[4])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y - 1]['start']], $troubleStructures[5])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y - 1]['start']], $troubleStructures[6])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y - 1]['start']], $troubleStructures[7])) ||
                            (substr_count($sanitiedArray[$newOrderScopeArr[$y - 1]['start']], $troubleStructures[8]))
                        ){
                            $scopeStringFinal = "";
                            foreach($troubleStructures as $troubleKey){
                                if(substr_count($sanitiedArray[$newOrderScopeArr[$y-1]['start']], $troubleKey)){
                                    $scopeStringFinal = $scopeStringFinal . " " . $troubleKey;
                                }
                            }
                            $newOrderScopeArr[$y-1]['scope'] = $scopeStringFinal;
                        }
                    }
                }

                // Scope finding method---------------------------------------------------------------------------------------Done
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Main Loop-------------------------------------------------------------------------------------------------Start

                for ($i=0; $i < count($sanitiedArray); $i++) { 
                    // Calculate Number of Keywords ################################################################
                    foreach($keyworArr as $keyword){
                        $temp = substr_count($sanitiedArray[$i], $keyword);
                        $nkw += $temp > 0 ? $temp : 0;
                    }


                    // Calculate Number of Identifiers #############################################################
                    $addNid = false;
                    foreach($newOrderScopeArr as $newItm){
                        if(substr_count($newItm['scope'], "for")){
                            if(($newItm['start'] <= $i) && ($newItm['end'] >= $i)){
                                $addNid = true;
                            }                            
                        }

                        if(substr_count($newItm['scope'], "if")){
                            if(($newItm['start'] <= $i) && ($newItm['end'] >= $i)){
                                $addNid = true;
                            }                            
                        }

                        if(substr_count($newItm['scope'], "while")){
                            if(($newItm['start'] <= $i) && ($newItm['end'] >= $i)){
                                $addNid = true;
                            }                            
                        }

                        if(substr_count($newItm['scope'], "do")){
                            if(($newItm['start'] <= $i) && ($newItm['end'] >= $i)){
                                $addNid = true;
                            }                            
                        }

                        if(substr_count($newItm['scope'], "switch")){
                            if(($newItm['start'] <= $i) && ($newItm['end'] >= $i)){
                                $addNid = true;
                            }                            
                        }

                        if(substr_count($newItm['scope'], "case")){
                            if(($newItm['start'] <= $i) && ($newItm['end'] >= $i)){
                                $addNid = true;
                            }                            
                        }
                    }

                    if(
                        substr_count($sanitiedArray[$i], "main") ||
                        substr_count($sanitiedArray[$i], "class")
                    ){
                        $addNid = true;
                    }

                    if($addNid){
                        $nid = str_word_count($nonwordCharRemovedArray[$i],0);
                    }  
                    
                    // Calculate Number of Operators ##############################################################

                    // +  -  *  /  %  =  !  >   <   |        ^   .  ,  ~ 
                    // += -= *= /= %= == != >=  <=  || && :: ^= 
                    // ++ --                >>  <<  |= &=
                    //    ->                >>> <<<
                    //                      >>= <<=
 
                    preg_match_all("/[^\+]\+[^\+\=]/", $sanitiedArray[$i] , $operatorArr );                       // +
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\+\=/", $sanitiedArray[$i] , $operatorArr );                                 // +=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\+\+/", $sanitiedArray[$i] , $operatorArr );                                 // ++
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[^\-]\-[^\-\=\>]/", $sanitiedArray[$i] , $operatorArr );                     // -
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\-\=/", $sanitiedArray[$i] , $operatorArr );                                 // -=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\-\-/", $sanitiedArray[$i] , $operatorArr );                                 // --
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\-\>/", $sanitiedArray[$i] , $operatorArr );                                 // ->
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\*[^\=]/", $sanitiedArray[$i] , $operatorArr );                              // *
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\*\=/", $sanitiedArray[$i] , $operatorArr );                                 // *=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\/[^\=]/", $sanitiedArray[$i] , $operatorArr );                              // /
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\/\=/", $sanitiedArray[$i] , $operatorArr );                                 // /=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\%[^\=]/", $sanitiedArray[$i] , $operatorArr );                              // %
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\%\=/", $sanitiedArray[$i] , $operatorArr );                                 // %=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[^\=\+\-\*\/\%\!\>\<\^\|\&]\=[^\=]/", $sanitiedArray[$i] , $operatorArr );   // =
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\=\=/", $sanitiedArray[$i] , $operatorArr );                                 // ==
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\![^\=]/", $sanitiedArray[$i] , $operatorArr );                              // !
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\!\=/", $sanitiedArray[$i] , $operatorArr );                                 // !=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[^\-\>]\>[^\=\>]/", $sanitiedArray[$i] , $operatorArr );                     // >
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[^\>]\>\=/", $sanitiedArray[$i] , $operatorArr );                            // >=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[^\>]\>\>[^\>\=]/", $sanitiedArray[$i] , $operatorArr );                     // >>
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\>\>\>[^=]/", $sanitiedArray[$i] , $operatorArr );                           // >>>
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[^\>]\>\>\=/", $sanitiedArray[$i] , $operatorArr );                          // >>=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[^\-\<]\<[^\=\<]/", $sanitiedArray[$i] , $operatorArr );                     // <
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[^\<]\<\=/", $sanitiedArray[$i] , $operatorArr );                            // <=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[^\<]\<\<[^\<\=]/", $sanitiedArray[$i] , $operatorArr );                     // <<
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\<\<\<[^=]/", $sanitiedArray[$i] , $operatorArr );                           // <<<
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[^\<]\<\<\=/", $sanitiedArray[$i] , $operatorArr );                          // <<=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[^\|]\|[^\|\=]/", $sanitiedArray[$i] , $operatorArr );                       // |
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\|\|/", $sanitiedArray[$i] , $operatorArr );                                 // ||
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\|\=/", $sanitiedArray[$i] , $operatorArr );                                 // |=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\&\&/", $sanitiedArray[$i] , $operatorArr );                                 // &&
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\&\=/", $sanitiedArray[$i] , $operatorArr );                                 // &=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\:\:/", $sanitiedArray[$i] , $operatorArr );                                 // ::
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\^[^=]/", $sanitiedArray[$i] , $operatorArr );                               // ^
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\^\=/", $sanitiedArray[$i] , $operatorArr );                                 // ^=
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/[\w]*?\.[\w]*?/", $sanitiedArray[$i] , $operatorArr );                       // .
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\,/", $sanitiedArray[$i] , $operatorArr );                                   // ,
                    $nop += count($operatorArr[0]);
                    preg_match_all( "/\~/", $sanitiedArray[$i] , $operatorArr );                                   // ~
                    $nop += count($operatorArr[0]);

                    // Calculate Number of Numerical Values ##############################################################
                    preg_match_all( "/[^\w]\d+\.?\d*/", $sanitiedArray[$i] , $numericArray );
                    $nnv = count($numericArray[0]);

                    // Calculate Number of String Literals Values ########################################################
                    preg_match_all( "/\"[\w \s \. \* \+ \? \$ \^ \/ \\ \' \- \: \| \~ \` \> \< \>> \<< \>>>]*\"/", $sanitiedArray[$i] , $stringLiteralArray );
                    $nsl = count($stringLiteralArray[0]);

                    // Final Data in a 3D array ##########################################################################
                    $dataArr[$i] = array(
                        "LineNo" => $i,
                        "Code" => $fixedStringArr[$i],                  
                        // "code" => $nonwordCharRemovedArray[$i],

                        "Cs" => ($wkw * $nkw) + ($wid * $nid) + ($wop * $nop) + ($wnv * $nnv) + ($wsl * $nsl),

                        "Nkw" => $nkw,
                        "Wkw" => $wkw,
                        "Cskw" => $wkw * $nkw,

                        "Nid" => $nid,
                        "Wid" => $wid,
                        "Csid" => $wid * $nid,

                        "Nop" => $nop,
                        "Wop" => $wop,
                        "Csop" => $wop * $nop,

                        "Nnv" => $nnv,
                        "Wnv" => $wnv,
                        "Csnv" => $wnv * $nnv,

                        "Nsl" => $nsl,
                        "Wsl" => $wsl,
                        "Cssl" => $wsl * $nsl,

                        //Thses are mannually added
                        "Wvs" => 0,
                        "Npdtv" => 0,
                        "Ncdtv" => 0,
                        "Cv" => 0,

                        "Wmrt" => 0,
                        "Npdtp" => 0,
                        "Ncdtp" => 0,
                        "Cm" => 0,
                        
                        "Nr" => 0,
                        "Nmcms" => 0,
                        "Nmcmd" => 0,
                        "Nmcrms" => 0,
                        "Nmcrmd" => 0,
                        "Nrmcrms" => 0,
                        "Nrmcrmd" => 0,
                        "Nrmcms" => 0,
                        "Nrmcmd" => 0,
                        "Nmrgvs" => 0,
                        "Nmrgvd" => 0,
                        "Nrmrgvs" => 0,
                        "Nrmrgvd" => 0,
                        "Ccp" => 0,

                        "Wtcs" => 0,
                        "NC" => 0,
                        "Ccspps" => 0,
                        "Ccs" => 0,

                        "Ci" => 0,   

                        "Cs" => 0,
                        "Cv" => 0,
                        "Cm" => 0,
                        "Ci" => 0,
                        "Ccp" => 0,
                        "Ccs" => 0,
                        "TCps" => 0,
                    );
                    $nkw = 0;
                    $nid = 0;
                    $nop = 0;
                    $nnv = 0;
                    $nsl = 0;
                }
                // Main Loop--------------------------------------------------------------------------------------------------Done
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Preparing Final Data--------------------------------------------------------------------------------------Start

                $data = [
                    "complexity_values" => $dataArr
                ];
                $this->view('admin/index', $data);

                // Preparing Final Data---------------------------------------------------------------------------------------Done
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            }



            // End Of Java Code Testing 
            $data = [
                "complexity_values" => []
            ];
            $this->view('admin/index', $data);  

        }else{
            $data = [
                "complexity_values" => []
            ];
            $this->view('admin/index', $data);  
        }
    }
}
