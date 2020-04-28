<?php
function num_keywords($val)
{
    $Nkw = 0;
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
    ]; // Keywords or Reserve Words

    foreach ($keyworArr as $keyword) {
        $temp = substr_count($val, $keyword);
        $Nkw += $temp > 0 ? $temp : 0;
    }
    //TODO: this mehod shoud change to regix
    return $Nkw;
}
