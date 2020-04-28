<?php
function num_variables($i, $sanitiedArray, $scopedArr,  $specialItemKeepArray, $specialItemRemovedArr)
{

    $Ngv = 0;  // global datatypes
    $Nlv = 0;  // local datatypes
    $addNgv = false;
    $addNlv = false;
    $Npdtv = 0; // primitive datatypes
    $Ncdtv = 0; // composite datatypes
    $addNcdtv = false;
    $Npdtp = 0; // composite parameters
    $Ncdtp = 0; // primitive parameters
    $NOfVoidReturns = 0;
    $NOfPrimitiveReturns = 0; // primitive return
    $NOfCompositeReturns = 0; // composite return
    if (count(preg_grep('/\b(public|private|protected)?\s*(void|boolean|char|byte|short|int|long|float|double|string)(.*?)[(](.*?)[)]\s*[{]/', explode("\n", $sanitiedArray[$i]))) > 0) {
        $brokenMethod = explode("(", $sanitiedArray[$i]);
        // echo $brokenMethod[0]; // for return method
        // echo $brokenMethod[1]; // for parameters
        preg_match_all('/[^\<]\s*boolean\s*\w+\s*[^\>^\[]/', $brokenMethod[1], $parra_arr);
        $Npdtp += count($parra_arr);
        preg_match_all('/[^\<]\s*char\s*\w+\s*[^\>^\[]/', $brokenMethod[1], $parra_arr);
        $Npdtp += count($parra_arr);
        preg_match_all('/[^\<]\s*byte\s*\w+\s*[^\>^\[]/', $brokenMethod[1], $parra_arr);
        $Npdtp += count($parra_arr);
        preg_match_all('/[^\<]\s*short\s*\w+\s*[^\>^\[]/', $brokenMethod[1], $parra_arr);
        $Npdtp += count($parra_arr);
        preg_match_all('/[^\<]\s*int\s*\w+\s*[^\>^\[]/', $brokenMethod[1], $parra_arr);
        $Npdtp += count($parra_arr);
        preg_match_all('/[^\<]\s*long\s*\w+\s*[^\>^\[]/', $brokenMethod[1], $parra_arr);
        $Npdtp += count($parra_arr);
        preg_match_all('/[^\<]\s*float\s*\w+\s*[^\>^\[]/', $brokenMethod[1], $parra_arr);
        $Npdtp += count($parra_arr);
        preg_match_all('/[^\<]\s*double\s*\w+\s*[^\>^\[]/', $brokenMethod[1], $parra_arr);
        $Npdtp += count($parra_arr);
        preg_match_all('/[^\<]\s*string\s*\w+\s*[^\>^\[]/', $brokenMethod[1], $parra_arr);
        $Npdtp += count($parra_arr);

        preg_match_all('/\blist/', $brokenMethod[1], $parra_arr);
        $Ncdtp += count($parra_arr);
        preg_match_all('/\bhashmap/', $brokenMethod[1], $parra_arr);
        $Ncdtp += count($parra_arr);
        preg_match_all('/\bmap/', $brokenMethod[1], $parra_arr);
        $Ncdtp += count($parra_arr);
        preg_match_all('/\bhashtable/', $brokenMethod[1], $parra_arr);
        $Ncdtp += count($parra_arr);
        preg_match_all('/\btreemap/', $brokenMethod[1], $parra_arr);
        $Ncdtp += count($parra_arr);
        preg_match_all('/\blinkedhashmap/', $brokenMethod[1], $parra_arr);
        $Ncdtp += count($parra_arr);
        preg_match_all('/\blinkedhashmap/', $brokenMethod[1], $parra_arr);
        $Ncdtp += count($parra_arr);
        preg_match_all('/\b\[\s*\d*\s*\]/', $brokenMethod[1], $parra_arr);
        $Ncdtp += count($parra_arr);

        preg_match_all('/[^\<]\s*boolean\s*\w+\s*[^\>^\[]/', $brokenMethod[0], $return_arr);
        $NOfPrimitiveReturns += count($return_arr);
        preg_match_all('/[^\<]\s*char\s*\w+\s*[^\>^\[]/', $brokenMethod[0], $return_arr);
        $NOfPrimitiveReturns += count($return_arr);
        preg_match_all('/[^\<]\s*byte\s*\w+\s*[^\>^\[]/', $brokenMethod[0], $return_arr);
        $NOfPrimitiveReturns += count($return_arr);
        preg_match_all('/[^\<]\s*short\s*\w+\s*[^\>^\[]/', $brokenMethod[0], $return_arr);
        $NOfPrimitiveReturns += count($return_arr);
        preg_match_all('/[^\<]\s*int\s*\w+\s*[^\>^\[]/', $brokenMethod[0], $return_arr);
        $NOfPrimitiveReturns += count($return_arr);
        preg_match_all('/[^\<]\s*long\s*\w+\s*[^\>^\[]/', $brokenMethod[0], $return_arr);
        $NOfPrimitiveReturns += count($return_arr);
        preg_match_all('/[^\<]\s*float\s*\w+\s*[^\>^\[]/', $brokenMethod[0], $return_arr);
        $NOfPrimitiveReturns += count($return_arr);
        preg_match_all('/[^\<]\s*double\s*\w+\s*[^\>^\[]/', $brokenMethod[0], $return_arr);
        $NOfPrimitiveReturns += count($return_arr);
        preg_match_all('/[^\<]\s*string\s*\w+\s*[^\>^\[]/', $brokenMethod[0], $return_arr);
        $NOfPrimitiveReturns += count($return_arr);

        preg_match_all('/\blist/', $brokenMethod[0], $return_arr);
        $NOfCompositeReturns += count($return_arr);
        preg_match_all('/\bhashmap/', $brokenMethod[0], $return_arr);
        $NOfCompositeReturns += count($return_arr);
        preg_match_all('/\bmap/', $brokenMethod[0], $return_arr);
        $NOfCompositeReturns += count($return_arr);
        preg_match_all('/\bhashtable/', $brokenMethod[0], $return_arr);
        $NOfCompositeReturns += count($return_arr);
        preg_match_all('/\btreemap/', $brokenMethod[0], $return_arr);
        $NOfCompositeReturns += count($return_arr);
        preg_match_all('/\blinkedhashmap/', $brokenMethod[0], $return_arr);
        $NOfCompositeReturns += count($return_arr);
        preg_match_all('/\blinkedhashmap/', $brokenMethod[0], $return_arr);
        $NOfCompositeReturns += count($return_arr);
        preg_match_all('/\b\[\s*\d*\s*\]/', $brokenMethod[0], $return_arr);
        $NOfCompositeReturns += count($return_arr);

        preg_match_all('/\bvoid/', $brokenMethod[0], $return_arr);
        $NOfVoidReturns += count($return_arr);
    } else {

        if (
            count(preg_grep('/\b(boolean|char|byte|short|int|long|float|double|string)/', explode("\n", $sanitiedArray[$i]))) > 0
        ) {
            $addNgv = true;
            $addNlv = true;
        }

        foreach ($scopedArr as $newItm) {

            if (substr_count($newItm['scope'], "class")) {
                if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                    $addNgv = true;
                    $addNlv = false;
                }
            }

            if (substr_count($newItm['scope'], "main")) {
                if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                    $addNgv = false;
                    $addNlv = true;
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
                // if (!($newItm['start'] == $newItm['end'])) {
                //     if ($newItm['start'] == $i) {
                //         $addNlv = false;
                //     }
                // }
            }
        }


        if (
            count(preg_grep('/\b(main|class)/', explode("\n", $sanitiedArray[$i]))) > 0
        ) {
            $addNgv = false;
            $addNlv = false;
        }

        $multiplePrimaryVariables = preg_grep('/\b(boolean|char|byte|short|int|long|float|double|string)\s+\w*\s*\,+/', explode("\n", $sanitiedArray[$i]));
        $composite_list = preg_grep('/^(?!new)\s*\blist\s*<\s*(boolean|char|byte|short|int|long|float|double|string)/', explode("\n", $sanitiedArray[$i]));
        $composite_hashmap = preg_grep('/^(?!new)\s*\bhashmap\s*<\s*(boolean|char|byte|short|int|long|float|double|string)/', explode("\n", $sanitiedArray[$i]));
        $composite_hashtable = preg_grep('/^(?!new)\s*\bhashtable\s*<\s*(boolean|char|byte|short|int|long|float|double|string)/', explode("\n", $sanitiedArray[$i]));
        $composite_map = preg_grep('/^(?!new)\s*\bmap\s*<\s*(boolean|char|byte|short|int|long|float|double|string)/', explode("\n", $sanitiedArray[$i]));
        $composite_treemap = preg_grep('/^(?!new)\s*\btreemap\s*<\s*(boolean|char|byte|short|int|long|float|double|string)/', explode("\n", $sanitiedArray[$i]));
        $composite_linkedhashmap = preg_grep('/^(?!new)\s*\blinkedhashmap\s*<\s*(boolean|char|byte|short|int|long|float|double|string)/', explode("\n", $sanitiedArray[$i]));
        $is_inside_parameters = preg_grep('/\((.*?)\)/', explode("\n", $sanitiedArray[$i]));
        $is_array = preg_grep('/\[(.*?)\]/', explode("\n", $sanitiedArray[$i]));

        if (
            count($is_array) > 0 &&
            count($is_inside_parameters) == 0
        ) {
            $Ncdtv++;
            $addNcdtv = true;
        }

        if (count($composite_list) > 0) {
            $Ncdtv++;
            $addNcdtv = true;
        }

        if (count($composite_hashmap) > 0) {
            $Ncdtv++;
            $addNcdtv = true;
        }

        if (count($composite_hashtable) > 0) {
            $Ncdtv++;
            $addNcdtv = true;
        }

        if (count($composite_map) > 0) {
            $Ncdtv++;
            $addNcdtv = true;
        }

        if (count($composite_treemap) > 0) {
            $Ncdtv++;
            $addNcdtv = true;
        }

        if (count($composite_linkedhashmap) > 0) {
            $Ncdtv++;
            $addNcdtv = true;
        }



        if ($addNcdtv) {
            if ($addNgv) {
                $Ngv++;
            }
            if ($addNlv) {
                $Nlv++;
            }
        } else {
            if ($addNgv) {
                if (
                    (str_word_count($specialItemKeepArray[$i], 0) == 1)  &&
                    (count($multiplePrimaryVariables) > 0)
                ) {
                    $Ngv = str_word_count($specialItemRemovedArr[$i], 0);
                    $Npdtv = $Ngv;
                } else {
                    $Ngv = str_word_count($specialItemKeepArray[$i], 0);
                    $Npdtv = $Ngv;
                }
            }

            if ($addNlv) {
                if (
                    (str_word_count($specialItemKeepArray[$i], 0) == 1)  &&
                    (count($multiplePrimaryVariables) > 0)
                ) {
                    $Nlv = str_word_count($specialItemRemovedArr[$i], 0);
                    $Npdtv = $Nlv;
                } else {
                    $Nlv = str_word_count($specialItemKeepArray[$i], 0);
                    $Npdtv = $Nlv;
                }
            }
        }
    }

    $variables = array();
    array_push($variables, $Ngv, $Nlv, $Npdtv, $Ncdtv, $Npdtp, $Ncdtp, $NOfVoidReturns, $NOfPrimitiveReturns, $NOfCompositeReturns);
    return $variables;
}


function specialItemKeepArray($string)
{
    $otherExceptVarRemovingArrSp = [
        "[", "]", "(", ")", "{", "}", ";", "=", "+", "-", "<", ">", "!", "~", "^", "%", "\/", "\\", ".", "\,", "\"", "\'", ":", "*"
    ];

    $otherExceptVarRemovingArr = [
        "boolean", "char", "byte", "short", "int", "long", "float", "double", "string"
    ];

    $otherExceptVar = preg_replace('/\d/', '', $string);


    foreach ($otherExceptVarRemovingArrSp as $item) {
        $otherExceptVar = str_replace($item, ' ', $otherExceptVar);
    };

    $regIdea = '';

    foreach ($otherExceptVarRemovingArr as $otherExceptVarRemovingArrWord) {
        $regIdea .= "(?!" . $otherExceptVarRemovingArrWord . ")";
    };

    $otherExceptVar = preg_replace("/\b$regIdea.*?\b/", ' ', $otherExceptVar);

    return explode("\n", $otherExceptVar);
}
