<?php
function num_stringLiterals($val)
{
    // preg_match_all("/\"[\w \s \. \* \+ \? \$ \^ \/ \\ \' \- \: \| \~ \` \> \< \>> \<< \>>>]*\"/", $val, $stringLiteralArray);
    preg_match_all("/\"(.*?)\"/", $val, $stringLiteralArray);
    return count($stringLiteralArray[0]);
}
