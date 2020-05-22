<?php
function num_keywords($val)
{
    $Nkw = 0;
    $keyworArr = [
        "true", "false", "NaN", "null", "void", "enum",
        "export", "function", "class", "new", "this", "return", "super", // "import"
        "try", "catch", "finally", "throw", "throws",
        "public", "private", "protected", "default", //Access Modifiers
        "final", "abstract", "transient", "synchronized", "native", "strictfp", "volatile", "static", //NonAccess Modifiers
        "const", "var", "let",
        "break", "continue",  "goto",
        "else",
        "instanceof", "typeof",
        "implements", "extends", "interface",
        "delete", "package", "arguments", "yield", "debugger" //"event"
    ]; // Keywords or Reserve Words

    foreach ($keyworArr as $keyword) {
        preg_match_all('/\b'.$keyword.'\b/', $val, $temp);
        $Nkw += count($temp[0]) > 0 ? count($temp[0]) : 0;
    }
    return $Nkw;
}