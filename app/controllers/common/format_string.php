<?php
function format_string($string)
{
    $convertedTostring = preg_replace('!^[ \t]*/\*.*?\*/[ \t]*[\r\n]!s', '', $string); //treat multi-line comments
    $convertedTostring = preg_replace('![ \t]*//.*[ \t]*[\r\n]!', "\n", $convertedTostring); //treat single-line comments
    $convertedTostring = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $convertedTostring); // remove blank lines
    return $convertedTostring;
}
