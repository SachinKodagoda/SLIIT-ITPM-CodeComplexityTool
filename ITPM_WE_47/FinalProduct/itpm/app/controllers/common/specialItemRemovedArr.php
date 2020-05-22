<?php
function specialItemRemovedArr($string,$removeDigit,$caseIgnore,$spRemoved)
{

    $spSymbolArr = [
        "[", "]", "(", ")", "{", "}", ";", "=", "+", "-", "<", ">", "!", "~", "^", "%", "\/", "\\", ".", ",", "\"", "\'", ":", "*"
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
        // "java","applet"
    ];

    if($spRemoved == 1){
        $middleRemovedString = preg_replace('/\".*?\"/', '', $string);
        $middleRemovedString = preg_replace('/\b(public)[a-zA-Z0-9\s]*\(.*?\)/', 'oneWord', $middleRemovedString);
        $middleRemovedString = preg_replace('/\w+\s+\w+\s+\=/', '', $middleRemovedString);
        // $middleRemovedString = $string;
        
    }else{
        $middleRemovedString = $string;
    }

    if($removeDigit == 1){
        $digitalRemovedString = preg_replace('/\d/', '', $middleRemovedString);
    }else{
        $digitalRemovedString = $middleRemovedString;
    }

    if($caseIgnore == 1){
        $digitalRemovedString = strtolower($digitalRemovedString);
    }
    

    foreach ($spSymbolArr as $spSymbol) {
        $digitalRemovedString = str_replace($spSymbol, ' ', $digitalRemovedString);
    };

    foreach ($spWordsArr as $spWord) {
        
        if($caseIgnore == 1){
            $digitalRemovedString = preg_replace("/\b$spWord\b/", ' ', $digitalRemovedString);
        }else{
            $digitalRemovedString = preg_replace("/\b$spWord\b/i", ' ', $digitalRemovedString);
        }
    };

    return explode("\n", $digitalRemovedString);
}
