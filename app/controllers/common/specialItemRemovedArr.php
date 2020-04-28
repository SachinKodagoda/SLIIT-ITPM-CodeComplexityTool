<?php
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
