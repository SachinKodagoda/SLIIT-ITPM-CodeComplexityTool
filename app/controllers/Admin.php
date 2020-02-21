<?php
class Admin extends BaseController
{
    // ADMIN PAGE -----------------------------------------------
    public function index()
    {
        if (isset($_FILES["fileToUpload"]["name"])) {
            $target_file = basename($_FILES["fileToUpload"]["name"]);
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if( $fileType == 'java'){
                $file = $_FILES["fileToUpload"]["tmp_name"];

                // Following variable will be used for full words search
                $convertedTostring = file_get_contents($file);

                //  Removes multi-line comments and does not create a blank line, also treats white spaces/tabs 
                $convertedTostring = preg_replace('!^[ \t]*/\*.*?\*/[ \t]*[\r\n]!s', '', $convertedTostring);

                //  Removes single line '//' comments, treats newline
                $convertedTostring = preg_replace('![ \t]*//.*[ \t]*[\r\n]!', "\n", $convertedTostring);

                //  Strip blank lines
                $convertedTostring = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $convertedTostring);

                $digitalRemovedString = preg_replace('/\d/', '', $convertedTostring);
                $nonwordCharRemovedString = preg_replace('/\d/', '', $digitalRemovedString);

                // Following will be used for display purposes
                $stringWithSpaces = str_replace(' ', '&nbsp;',$convertedTostring);
                $stringWithSpacesAndTabs = str_replace("\t", '&nbsp;&nbsp;',$stringWithSpaces);
                $fixedStringArr = explode("\n", $stringWithSpacesAndTabs);
                // foreach($fixedStringArr as $val){
                //     echo $val . "<br/>";
                // }

                //Following is using for line by line search
                $sanitiedArray = explode("\n", strtolower($convertedTostring));                
                

                // Creating the Final 3D Data Array---------------------
                $dataArr = array();
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
                    // "debugger","delete", "eval", "event","in", "with", "yield","package","arguments",
                ];


                $validSpArr = [
                    "class", "for", "main"
                ];

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

                $finalCutForSpWords = strtolower($nonwordCharRemovedString);

                foreach($spReplaceArr as $spReplaceItem){
                    $finalCutForSpWords = str_replace($spReplaceItem, ' ', $finalCutForSpWords);
                };

                foreach($spWordsArr as $spWord){
                    $finalCutForSpWords = preg_replace("/\b$spWord\b/", ' ', $finalCutForSpWords);
                };

                $nonwordCharRemovedArray = explode("\n", strtolower($finalCutForSpWords));


                // Identifiers
                $dataTypeArr = ["boolean","char","byte","short","int","long","float","double","string"]; // TO DO: outside ones are not taken as identifiers
                $controlStructures = ["for", "while", "do", "if", "switch","case"]; // TO DO: ask about do while loop
                // Operators
                $arithmaticOperators = ['+', '-', '*', '/', '%','++', '--'];
                $relationalOperators = ["==", "!=", ">", "<", ">=","<="];
                $logicalOperators = ["&&", "||", "!"];
                $bitwiseOperators = ["|", "^", "~", "<<", ">>",">>>", "<<<"];
                $miscellaneousOperators = [",", "->", ".", "::"];
                $assignmentOperators = ["+=", "-=", "*=", "/=", "=",">>>=", "|=" , "&=", "%=","<<=",">>=","^="];

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

                // print_r($sanitiedArray[0]);
                

                for ($i=0; $i < count($sanitiedArray); $i++) { 
                    // Calculate Number of Keywords----------------------------
                    foreach($keyworArr as $keyword){
                        $temp = substr_count($sanitiedArray[$i], $keyword);
                        $nkw += $temp > 0 ? $temp : 0;
                    }

                    //Calculate Number of Special Words to Calculate Identifiers--------------------------


                    // foreach($validSpArr as $valArr){
                    //     if (strpos($sanitiedArray[$i], $valArr) !== false) {
                    //         $nid = str_word_count($nonwordCharRemovedArray[$i],0);
                    //     }
                    // }
                    $nid = str_word_count($nonwordCharRemovedArray[$i],0);

    

                    

                    //Calculate Number of Operators-----------------------------------------------------
                    $arithmaticOperators = [ "+" , "-" , "*" , "/" , "%" , "++" , "--"];
                    $relationalOperators = ["==", "!=", ">", "<", ">=","<="];
                    $logicalOperators = ["&&", "||", "!"];
                    $bitwiseOperators = ["|", "^", "~", "<<", ">>",">>>", "<<<"];
                    $miscellaneousOperators = [",", "->", ".", "::"];
                    $assignmentOperators = ["+=", "-=", "*=", "/=", "=",">>>=", "|=" , "&=", "%=","<<=",">>=","^="];


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

                    //TODO: Check about the dot opertator

                    // Calculate Number of Numerical Values----------------------------
                    preg_match_all( "/[^\w]\d+\.?\d*/", $sanitiedArray[$i] , $numericArray );
                    $nnv = count($numericArray[0]);

                    // Calculate Number of Numerical Values----------------------------
                    preg_match_all( "/\"[\w \s \. \* \+ \? \$ \^ \/ \\ \' \- \: \| \~ \` \> \< \>> \<< \>>>]*\"/", $sanitiedArray[$i] , $stringLiteralArray ); //TODO: "" check
                    $nsl = count($stringLiteralArray[0]);

                    // Final Data in a 3D array----------------------------------------
                    $dataArr[$i] = array(
                        "lineNo" => $i,
                        "code" => $fixedStringArr[$i],
                        // "code" => $nonwordCharRemovedArray[$i],
                        "cs" => ($wkw * $nkw) + ($wid * $nid) + ($wop * $nop) + ($wnv * $nnv) + ($wsl * $nsl),

                        "nkw" => $nkw,
                        "wkw" => $wkw,
                        "cskw" => $wkw * $nkw,

                        "nid" => $nid,
                        "wid" => $wid,
                        "csid" => $wid * $nid,

                        "nop" => $nop,
                        "wop" => $wop,
                        "csop" => $wop * $nop,

                        "nnv" => $nnv,
                        "wnv" => $wnv,
                        "csnv" => $wnv * $nnv,

                        "nsl" => $nsl,
                        "wsl" => $wsl,
                        "cssl" => $wsl * $nsl
                        
                    );
                    $nkw = 0;
                    $nid = 0;
                    $nop = 0;
                    $nnv = 0;
                    $nsl = 0;
                }

                // foreach($dataArr as $nano){
                //     echo $nano["nkw"];
                //     echo $nano["nid"];
                //     echo $nano["nop"];
                //     echo $nano["nnv"];
                //     echo $nano["nsl"];
                //     echo "&nbsp;&nbsp;";
                //     echo $nano["code"];
                //     echo "<br/>";
                // }
                $data = [
                    "cs_values" => $dataArr
                ];
                $this->view('admin/index', $data);
            }
            // End Of Java Code Testing 
            $data = [
                "cs_values" => []
            ];
            $this->view('admin/index', $data);  

        }else{
            $data = [
                "cs_values" => []
            ];
            $this->view('admin/index', $data);  
        }
    }
}
