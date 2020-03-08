<?php
class Admin extends BaseController
{
    // ADMIN PAGE
    public function index()
    {
        if (isset($_FILES["fileToUpload"]["name"])) {
            $target_file = basename($_FILES["fileToUpload"]["name"]);
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($fileType == 'java') {
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Initializing Variables------------------------------------------------------------------------------------Start

                // Keywords or Reserve Words
                $keyworArr = [
                    "true", "false", "NaN", "null", "void", "enum",
                    "import", "export", "function", "class", "new", "this", "return", "super",
                    "try", "catch", "finally", "throw", "throws",
                    "public", "private", "protected", "default", //Access Modifiers
                    "final", "abstract", "transient", "synchronized", "native", "strictfp", "volatile", "static", //NonAccess Modifiers
                    "const", "var", "let",
                    "break", "continue",  "goto",
                    "else",
                    "instanceof", "typeof",
                    "implements", "extends", "interface",
                    "delete", "package", "arguments", "yield", "event", "debugger"
                    // "eval","in", "with"
                ];

                $dataTypeArr = ["boolean", "char", "byte", "short", "int", "long", "float", "double", "string"]; // TO DO: outside ones are not taken as identifiers
                $controlStructures = ["for", "while", "do", "if", "switch", "case"]; // TO DO: ask about do while loop


                $Nkw = 0; // Number of keywords
                $Nid = 0; // Number of identifiers
                $Nop = 0; // Number of operators
                $Nnv = 0; // Number of numerical values
                $Nsl = 0; // Number of string literals


                $Ngv = 0; // Number of global Variables
                $Nlv = 0; // Number of local Variables
                $Npdtv = 0; // Number of primitive data type Variables
                $Ncdtv = 0; // Number of compositive data type Variables

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
                $stringWithSpaces = str_replace(' ', '&nbsp;', $convertedTostring);
                $stringWithSpacesAndTabs = str_replace("\t", '&nbsp;&nbsp;', $stringWithSpaces);
                $fixedStringArr = explode("\n", $stringWithSpacesAndTabs);

                //Following is using for line by line search
                $sanitiedArray = explode("\n", strtolower($convertedTostring));

                // Sanitization Variables-------------------------------------------------------------------------------------Done
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Croping Identifiers---------------------------------------------------------------------------------------Start

                $spReplaceArr = [
                    "[", "]", "(", ")", "{", "}", ";", "=", "+", "-", "<", ">", "!", "~", "^", "%", "\/", "\\", ".", "\,", "\"", "\'",
                ];

                $spWordsArr = [
                    "true", "false", "NaN", "null", "void", "enum",
                    "import", "export", "function", "class", "new", "this", "return", "super",
                    "try", "catch", "finally", "throw", "throws",
                    "public", "private", "protected", "default", //Access Modifiers
                    "final", "abstract", "transient", "synchronized", "native", "strictfp", "volatile", "static", //NonAccess Modifiers
                    "const", "var", "let",
                    "break", "continue",  "goto",
                    "else",
                    "instanceof", "typeof",
                    "implements", "extends", "interface",
                    // "debugger","delete", "eval", "event","in", "with", "yield","package","arguments",
                    "boolean", "char", "byte", "short", "int", "long", "float", "double", "string",
                    "for", "while", "do", "if", "switch", "case", "main"
                ];


                


                $digitalRemovedString = preg_replace('/\d/', '', $convertedTostring);
                $finalCutForSpWords = strtolower($digitalRemovedString);

                foreach ($spReplaceArr as $spReplaceItem) {
                    $finalCutForSpWords = str_replace($spReplaceItem, ' ', $finalCutForSpWords);
                };

                foreach ($spWordsArr as $spWord) {
                    $finalCutForSpWords = preg_replace("/\b$spWord\b/", ' ', $finalCutForSpWords);
                };

                $nonwordCharRemovedArray = explode("\n", $finalCutForSpWords);




                // Croping Identifiers----------------------------------------------------------------------------------------Done
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Croping variable Declarations-----------------------------------------------------------------------------Start

                $otherExceptVarRemovingArrSp = [
                    "[", "]", "(", ")", "{", "}", ";", "=", "+", "-", "<", ">", "!", "~", "^", "%", "\/", "\\", ".", "\,", "\"", "\'", ":", "*"
                ];

                $otherExceptVarRemovingArr = [
                    "boolean", "char", "byte", "short", "int", "long", "float", "double", "string",
                ];

                $otherExceptVar = preg_replace('/\d/', '', $convertedTostring);
                $otherExceptVarLower = strtolower($otherExceptVar);


                foreach ($otherExceptVarRemovingArrSp as $otherExceptVarRemovingArrSpItem) {
                    $otherExceptVarLower = str_replace($otherExceptVarRemovingArrSpItem, ' ', $otherExceptVarLower);
                };

                $regIdea = '';

                foreach ($otherExceptVarRemovingArr as $otherExceptVarRemovingArrWord) {
                    $regIdea .= "(?!" . $otherExceptVarRemovingArrWord . ")";
                };
                $otherExceptVarLower = preg_replace("/\b$regIdea.*?\b/", ' ', $otherExceptVarLower);
                $otherExceptVarLowerFinalArr = explode("\n", $otherExceptVarLower);


                // Croping variable Declarations------------------------------------------------------------------------------Done
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Scope finding method--------------------------------------------------------------------------------------Start

                $OpenBracketCount = 0;
                $CloseBracketCount = 0;
                $ScopeCount = 0;
                $scopeArray = [];
                $scopeMapArray = [];
                $newOrderScopeArr = [];
                for ($i = 0; $i < count($sanitiedArray); $i++) {
                    if (substr_count($sanitiedArray[$i], "{") == true) {
                        array_push($scopeArray, "{");
                        array_push($scopeMapArray, $i);
                        $OpenBracketCount++;
                    }
                    if (substr_count($sanitiedArray[$i], "}") == true) {
                        array_push($scopeArray, "}");
                        array_push($scopeMapArray, $i);
                        $CloseBracketCount++;
                    }

                    if ((substr_count($sanitiedArray[$i], "for") == true) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i + 1], "{") == false)) {
                        array_push(
                            $newOrderScopeArr,
                            array(
                                "start" => $i,
                                "end"   => $i + 1,
                                "scope" => "for"
                            )
                        );
                    }
                    if ((substr_count($sanitiedArray[$i], "if") == true) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i + 1], "{") == false)) {
                        array_push(
                            $newOrderScopeArr,
                            array(
                                "start" => $i,
                                "end"   => $i + 1,
                                "scope" => "if"
                            )
                        );
                    }
                    if ((substr_count($sanitiedArray[$i], "else") == true) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i + 1], "{") == false)) {
                        array_push(
                            $newOrderScopeArr,
                            array(
                                "start" => $i,
                                "end"   => $i + 1,
                                "scope" => "else"
                            )
                        );
                    }
                    if ((substr_count($sanitiedArray[$i], "while") == true) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i + 1], "{") == false)) {
                        array_push(
                            $newOrderScopeArr,
                            array(
                                "start" => $i,
                                "end"   => $i + 1,
                                "scope" => "while"
                            )
                        );
                    }
                }


                if ($OpenBracketCount != $CloseBracketCount) {
                    echo "Program Opening Closeing are wrong";
                } else {
                    $ScopeCount = $OpenBracketCount;
                }
                $scopedString = implode("", $scopeArray);
                $scopePosArrStart = [];
                $scopePosArrEnd = [];
                $searchStringLeft = "{";
                $searchStringCenter = "";
                $searchStringRight = "}";
                $replaceLength = 2;
                $replaceSring = "00";
                $totalRounds = $ScopeCount;

                for ($i = 1; $i <= $totalRounds; $i++) {
                    $replacePos = strpos($scopedString, ($searchStringLeft . $searchStringCenter . $searchStringRight));
                    if ($replacePos > -1) {
                        array_push($scopePosArrStart, $replacePos);
                        $scopedString = substr_replace($scopedString, $replaceSring, $replacePos, $replaceLength);
                        array_push($scopePosArrEnd, ($replacePos + $replaceLength - 1));
                    } else {
                        $searchStringCenter = $searchStringCenter . "00";
                        $replaceSring = $replaceSring . "00";
                        $replaceLength += 2;
                        $totalRounds++;
                    }
                }

                for ($x = 0; $x < count($scopePosArrStart); $x++) {
                    array_push(
                        $newOrderScopeArr,
                        array(
                            "start" => $scopeMapArray[$scopePosArrStart[$x]],
                            "end"   => $scopeMapArray[$scopePosArrEnd[$x]],
                            "scope" => ""
                        )
                    );
                }

                sort($newOrderScopeArr);
                $troubleStructures = ["class", "main", "for", "if", "else",  "switch", "case", "while", "do"];
                $skipWhileOnece = false;
                for ($y = 0; $y < count($newOrderScopeArr); $y++) {
                    if ($newOrderScopeArr[$y]['scope'] == "") {


                        if (
                            preg_match_all('/\b' . $troubleStructures[0] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[1] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[2] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[3] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[4] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[5] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[6] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[7] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[8] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']])
                        ) {

                            $scopeStringFinal = "";
                            foreach ($troubleStructures as $troubleKey) {
                                if (
                                    preg_match_all('/\b' . $troubleKey . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']])
                                ) {
                                    $scopeStringFinal = $scopeStringFinal . " " . $troubleKey;
                                }
                            }
                            $newOrderScopeArr[$y]['scope'] = $scopeStringFinal;
                        } else if (
                            preg_match_all('/\b' . $troubleStructures[0] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[1] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[2] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[3] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[4] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[5] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[6] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[7] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                            preg_match_all('/\b' . $troubleStructures[8] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']])
                        ) {
                            $scopeStringFinal = "";
                            foreach ($troubleStructures as $troubleKey) {
                                if (
                                    preg_match_all('/\b' . $troubleKey . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']])
                                ) {
                                    $scopeStringFinal = $scopeStringFinal . " " . $troubleKey;
                                }
                            }
                            $newOrderScopeArr[$y - 1]['scope'] = $scopeStringFinal;
                        }
                    }
                }


                foreach ($newOrderScopeArr as $key => $value) {
                    if (
                        preg_match_all('/\b' . $troubleStructures[8] . '\b/', $value['scope'])
                    ) {
                        if (preg_match_all('/\b' . $troubleStructures[7] . '\b/', $value['scope'])) {
                            $newOrderScopeArr[$key]['scope'] = preg_replace('/\b' . $troubleStructures[7] . '\b/', "", $newOrderScopeArr[$key]['scope']);
                            unset($newOrderScopeArr[$key]);
                        } else if (preg_match_all('/\b' . $troubleStructures[7] . '\b/', $newOrderScopeArr[$key + 1]['scope'])) {
                            $newOrderScopeArr[$key + 1]['scope'] = preg_replace('/\b' . $troubleStructures[7] . '\b/', "", $newOrderScopeArr[$key + 1]['scope']);
                            unset($newOrderScopeArr[$key + 1]);
                        }
                    }
                }

                // Scope finding method---------------------------------------------------------------------------------------Done
                // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Main Loop-------------------------------------------------------------------------------------------------Start

                for ($i = 0; $i < count($sanitiedArray); $i++) {
                    // Calculate Number of Keywords ################################################################
                    foreach ($keyworArr as $keyword) {
                        $temp = substr_count($sanitiedArray[$i], $keyword);
                        $Nkw += $temp > 0 ? $temp : 0;
                    }


                    // Calculate Number of Identifiers #############################################################
                    $addNid = false;

                    foreach ($newOrderScopeArr as $newItm) {
                        if (substr_count($newItm['scope'], "for")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNid = true;
                            }
                        }

                        if (substr_count($newItm['scope'], "if")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNid = true;
                            }
                        }

                        if (substr_count($newItm['scope'], "while")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNid = true;
                            }
                        }

                        if (substr_count($newItm['scope'], "do")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNid = true;
                            }
                        }

                        if (substr_count($newItm['scope'], "switch")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNid = true;
                            }
                        }

                        if (substr_count($newItm['scope'], "case")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNid = true;
                            }
                        }
                    }


                    if (
                        substr_count($sanitiedArray[$i], "main") ||
                        substr_count($sanitiedArray[$i], "class")
                    ) {
                        $addNid = true;
                    }

                    if ($addNid) {
                        $Nid = str_word_count($nonwordCharRemovedArray[$i], 0);
                    }


                    // Calculate Number of Global Variables #######################################################

                    $addNgv = false;
                    $addNlv = false;

                    if (
                        substr_count($sanitiedArray[$i], "boolean") ||
                        substr_count($sanitiedArray[$i], "char") ||
                        substr_count($sanitiedArray[$i], "byte") ||
                        substr_count($sanitiedArray[$i], "short") ||
                        substr_count($sanitiedArray[$i], "int") ||
                        substr_count($sanitiedArray[$i], "long") ||
                        substr_count($sanitiedArray[$i], "float") ||
                        substr_count($sanitiedArray[$i], "double") ||
                        substr_count($sanitiedArray[$i], "string")
                    ) {
                        $addNgv = true;
                        $addNlv = true;
                    }

                    foreach ($newOrderScopeArr as $newItm) {

                        if (substr_count($newItm['scope'], "class")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNgv = true;
                                $addNlv = false;
                            }
                        }

                        if (substr_count($newItm['scope'], "for")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNgv = false;
                                $addNlv = false;
                            }
                        }

                        if (substr_count($newItm['scope'], "if")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNgv = false;
                                $addNlv = false;
                            }
                        }

                        if (substr_count($newItm['scope'], "while")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNgv = false;
                                $addNlv = false;
                            }
                        }

                        if (substr_count($newItm['scope'], "do")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNgv = false;
                                $addNlv = false;
                            }
                        }

                        if (substr_count($newItm['scope'], "switch")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNgv = false;
                                $addNlv = false;
                            }
                        }

                        if (substr_count($newItm['scope'], "case")) {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNgv = false;
                                $addNlv = false;
                            }
                        }
                        
                        if ($newItm['scope'] == "") {
                            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                                $addNgv = false;
                                $addNlv = true;
                            }

                            if(!($newItm['start'] == $newItm['end'])){
                                if( $newItm['start'] == $i){
                                    $addNlv = false;
                                }
                            }


                        }
                    }




                    if (
                        substr_count($sanitiedArray[$i], "main") ||
                        substr_count($sanitiedArray[$i], "class")
                    ) {
                        $addNgv = false;
                        $addNlv = false;
                    }


                    if ($addNgv) {
                        $Ngv = str_word_count($otherExceptVarLowerFinalArr[$i], 0);
                    }

                    if ($addNlv) {
                        $Nlv = str_word_count($otherExceptVarLowerFinalArr[$i], 0);
                    }




                    // Calculate Number of Operators ##############################################################

                    // +  -  *  /  %  =  !  >   <   |        ^   .  ,  ~ 
                    // += -= *= /= %= == != >=  <=  || && :: ^= 
                    // ++ --                >>  <<  |= &=
                    //    ->                >>> <<<
                    //                      >>= <<=

                    preg_match_all("/[^\+]\+[^\+\=]/", $sanitiedArray[$i], $operatorArr);                       // +
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\+\=/", $sanitiedArray[$i], $operatorArr);                                 // +=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\+\+/", $sanitiedArray[$i], $operatorArr);                                 // ++
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[^\-]\-[^\-\=\>]/", $sanitiedArray[$i], $operatorArr);                     // -
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\-\=/", $sanitiedArray[$i], $operatorArr);                                 // -=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\-\-/", $sanitiedArray[$i], $operatorArr);                                 // --
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\-\>/", $sanitiedArray[$i], $operatorArr);                                 // ->
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\*[^\=]/", $sanitiedArray[$i], $operatorArr);                              // *
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\*\=/", $sanitiedArray[$i], $operatorArr);                                 // *=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\/[^\=]/", $sanitiedArray[$i], $operatorArr);                              // /
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\/\=/", $sanitiedArray[$i], $operatorArr);                                 // /=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\%[^\=]/", $sanitiedArray[$i], $operatorArr);                              // %
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\%\=/", $sanitiedArray[$i], $operatorArr);                                 // %=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[^\=\+\-\*\/\%\!\>\<\^\|\&]\=[^\=]/", $sanitiedArray[$i], $operatorArr);   // =
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\=\=/", $sanitiedArray[$i], $operatorArr);                                 // ==
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\![^\=]/", $sanitiedArray[$i], $operatorArr);                              // !
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\!\=/", $sanitiedArray[$i], $operatorArr);                                 // !=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[^\-\>]\>[^\=\>]/", $sanitiedArray[$i], $operatorArr);                     // >
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[^\>]\>\=/", $sanitiedArray[$i], $operatorArr);                            // >=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[^\>]\>\>[^\>\=]/", $sanitiedArray[$i], $operatorArr);                     // >>
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\>\>\>[^=]/", $sanitiedArray[$i], $operatorArr);                           // >>>
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[^\>]\>\>\=/", $sanitiedArray[$i], $operatorArr);                          // >>=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[^\-\<]\<[^\=\<]/", $sanitiedArray[$i], $operatorArr);                     // <
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[^\<]\<\=/", $sanitiedArray[$i], $operatorArr);                            // <=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[^\<]\<\<[^\<\=]/", $sanitiedArray[$i], $operatorArr);                     // <<
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\<\<\<[^=]/", $sanitiedArray[$i], $operatorArr);                           // <<<
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[^\<]\<\<\=/", $sanitiedArray[$i], $operatorArr);                          // <<=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[^\|]\|[^\|\=]/", $sanitiedArray[$i], $operatorArr);                       // |
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\|\|/", $sanitiedArray[$i], $operatorArr);                                 // ||
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\|\=/", $sanitiedArray[$i], $operatorArr);                                 // |=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\&\&/", $sanitiedArray[$i], $operatorArr);                                 // &&
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\&\=/", $sanitiedArray[$i], $operatorArr);                                 // &=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\:\:/", $sanitiedArray[$i], $operatorArr);                                 // ::
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\^[^=]/", $sanitiedArray[$i], $operatorArr);                               // ^
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\^\=/", $sanitiedArray[$i], $operatorArr);                                 // ^=
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/[\w]*?\.[\w]*?/", $sanitiedArray[$i], $operatorArr);                       // .
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\,/", $sanitiedArray[$i], $operatorArr);                                   // ,
                    $Nop += count($operatorArr[0]);
                    preg_match_all("/\~/", $sanitiedArray[$i], $operatorArr);                                   // ~
                    $Nop += count($operatorArr[0]);

                    // Calculate Number of Numerical Values ##############################################################
                    preg_match_all("/[^\w]\d+\.?\d*/", $sanitiedArray[$i], $numericArray);
                    $Nnv = count($numericArray[0]);

                    // Calculate Number of String Literals Values ########################################################
                    preg_match_all("/\"[\w \s \. \* \+ \? \$ \^ \/ \\ \' \- \: \| \~ \` \> \< \>> \<< \>>>]*\"/", $sanitiedArray[$i], $stringLiteralArray);
                    $Nsl = count($stringLiteralArray[0]);

                    // Final Data in a 3D array ##########################################################################
                    $dataArr[$i] = array(
                        "LineNo" => $i,
                        "Code" => $fixedStringArr[$i],
                        // "Code" => $nonwordCharRemovedArray[$i],
                        // "Code" => $otherExceptVarLowerFinalArr[$i],
                        "Nkw" => $Nkw,
                        "Nid" => $Nid,
                        "Nop" => $Nop,
                        "Nnv" => $Nnv,
                        "Nsl" => $Nsl,
                        "Cs" => 0,

                        //Thses are mannually added
                        "Ngv" => $Ngv,
                        "Nlv" => $Nlv,
                        "Npdtv" => $Npdtv,
                        "Ncdtv" => $Ncdtv,
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
                    $Nkw = 0;
                    $Nid = 0;
                    $Nop = 0;
                    $Nnv = 0;
                    $Nsl = 0;

                    $Ngv = 0;
                    $Nlv = 0;
                    $Npdtv = 0;
                    $Ncdtv = 0;
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
        } else {
            $data = [
                "complexity_values" => []
            ];
            $this->view('admin/index', $data);
        }
    }
}
