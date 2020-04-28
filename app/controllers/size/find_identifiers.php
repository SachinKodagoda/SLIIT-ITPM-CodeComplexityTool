<?php
function num_identifiers($i,  $sanitiedArray, $scopedArr, $specialItemRemovedArr)
{
    $Nid = 0;
    $addNid = false;

    foreach ($scopedArr as $newItm) {
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
        $Nid = str_word_count($specialItemRemovedArr[$i], 0);
    }
    return $Nid;
}


function specialItemRemovedArr($string)
{

    $spSymbolArr = [
        "[", "]", "(", ")", "{", "}", ";", "=", "+", "-", "<", ">", "!", "~", "^", "%", "\/", "\\", ".", "\,", "\"", "\'", ":", "*"
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
        "delete", "package", "arguments", "yield", "event", "debugger",
        "boolean", "char", "byte", "short", "int", "long", "float", "double", "string",
        "for", "while", "do", "if", "switch", "case", "main"
    ];

    $digitalRemovedString = preg_replace('/\d/', '', $string);

    foreach ($spSymbolArr as $spSymbol) {
        $digitalRemovedString = str_replace($spSymbol, ' ', $digitalRemovedString);
    };

    foreach ($spWordsArr as $spWord) {
        $digitalRemovedString = preg_replace("/\b$spWord\b/", ' ', $digitalRemovedString);
    };

    return explode("\n", $digitalRemovedString);
}
