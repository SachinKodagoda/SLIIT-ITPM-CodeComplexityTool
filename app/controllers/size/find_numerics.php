<?php
function num_numerics($val)
{
    preg_match_all("/[^\w]\d+\.?\d*/", $val , $numericArray);
    return count($numericArray[0]);
}
