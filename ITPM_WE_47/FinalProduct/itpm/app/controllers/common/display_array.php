<?php
function displayArray($string)
{
    $stringWithSpaces = str_replace(' ', '&nbsp;', $string);
    $stringWithSpacesAndTabs = str_replace("\t", '&nbsp;&nbsp;', $stringWithSpaces);
    $removedSpChars = str_replace("<", '&lt;', $stringWithSpacesAndTabs);
    $removedSpChars = str_replace(">", '&gt;', $removedSpChars);
    return explode("\n", $removedSpChars);
}
