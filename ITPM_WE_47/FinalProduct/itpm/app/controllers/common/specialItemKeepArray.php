<?php
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
