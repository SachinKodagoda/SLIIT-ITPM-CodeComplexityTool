<?php
function num_operators($val)
{
    // +  -  *  /  %  =  !  >   <   |        ^   .  ,  ~ 
    // += -= *= /= %= == != >=  <=  || && :: ^= 
    // ++ --                >>  <<  |= &=
    //    ->                >>> <<<
    //                      >>= <<=
    
    $Nop = 0;
    preg_match_all("/[^\+]\+[^\+\=]/", $val, $operatorArr);                       // +
    $Nop += count($operatorArr[0]);
    preg_match_all("/\+\=/", $val, $operatorArr);                                 // +=
    $Nop += count($operatorArr[0]);
    preg_match_all("/\+\+/", $val, $operatorArr);                                 // ++
    $Nop += count($operatorArr[0]);
    preg_match_all("/[^\-]\-[^\-\=\>]/", $val, $operatorArr);                     // -
    $Nop += count($operatorArr[0]);
    preg_match_all("/\-\=/", $val, $operatorArr);                                 // -=
    $Nop += count($operatorArr[0]);
    preg_match_all("/\-\-/", $val, $operatorArr);                                 // --
    $Nop += count($operatorArr[0]);
    preg_match_all("/\-\>/", $val, $operatorArr);                                 // ->
    $Nop += count($operatorArr[0]);
    preg_match_all("/\*[^\=]/", $val, $operatorArr);                              // *
    $Nop += count($operatorArr[0]);
    preg_match_all("/\*\=/", $val, $operatorArr);                                 // *=
    $Nop += count($operatorArr[0]);
    preg_match_all("/\/[^\=]/", $val, $operatorArr);                              // /
    $Nop += count($operatorArr[0]);
    preg_match_all("/\/\=/", $val, $operatorArr);                                 // /=
    $Nop += count($operatorArr[0]);
    preg_match_all("/\%[^\=]/", $val, $operatorArr);                              // %
    $Nop += count($operatorArr[0]);
    preg_match_all("/\%\=/", $val, $operatorArr);                                 // %=
    $Nop += count($operatorArr[0]);
    preg_match_all("/[^\=\+\-\*\/\%\!\>\<\^\|\&]\=[^\=]/", $val, $operatorArr);   // =
    $Nop += count($operatorArr[0]);
    preg_match_all("/\=\=/", $val, $operatorArr);                                 // ==
    $Nop += count($operatorArr[0]);
    preg_match_all("/\![^\=]/", $val, $operatorArr);                              // !
    $Nop += count($operatorArr[0]);
    preg_match_all("/\!\=/", $val, $operatorArr);                                 // !=
    $Nop += count($operatorArr[0]);
    preg_match_all("/[^\-\>]\>[^\=\>]/", $val, $operatorArr);                     // >
    $Nop += count($operatorArr[0]);
    preg_match_all("/[^\>]\>\=/", $val, $operatorArr);                            // >=
    $Nop += count($operatorArr[0]);
    preg_match_all("/[^\>]\>\>[^\>\=]/", $val, $operatorArr);                     // >>
    $Nop += count($operatorArr[0]);
    preg_match_all("/\>\>\>[^=]/", $val, $operatorArr);                           // >>>
    $Nop += count($operatorArr[0]);
    preg_match_all("/[^\>]\>\>\=/", $val, $operatorArr);                          // >>=
    $Nop += count($operatorArr[0]);
    preg_match_all("/[^\-\<]\<[^\=\<]/", $val, $operatorArr);                     // <
    $Nop += count($operatorArr[0]);
    preg_match_all("/[^\<]\<\=/", $val, $operatorArr);                            // <=
    $Nop += count($operatorArr[0]);
    preg_match_all("/[^\<]\<\<[^\<\=]/", $val, $operatorArr);                     // <<
    $Nop += count($operatorArr[0]);
    preg_match_all("/\<\<\<[^=]/", $val, $operatorArr);                           // <<<
    $Nop += count($operatorArr[0]);
    preg_match_all("/[^\<]\<\<\=/", $val, $operatorArr);                          // <<=
    $Nop += count($operatorArr[0]);
    preg_match_all("/[^\|]\|[^\|\=]/", $val, $operatorArr);                       // |
    $Nop += count($operatorArr[0]);
    preg_match_all("/\|\|/", $val, $operatorArr);                                 // ||
    $Nop += count($operatorArr[0]);
    preg_match_all("/\|\=/", $val, $operatorArr);                                 // |=
    $Nop += count($operatorArr[0]);
    preg_match_all("/\&\&/", $val, $operatorArr);                                 // &&
    $Nop += count($operatorArr[0]);
    preg_match_all("/\&\=/", $val, $operatorArr);                                 // &=
    $Nop += count($operatorArr[0]);
    preg_match_all("/\:\:/", $val, $operatorArr);                                 // ::
    $Nop += count($operatorArr[0]);
    preg_match_all("/\^[^=]/", $val, $operatorArr);                               // ^
    $Nop += count($operatorArr[0]);
    preg_match_all("/\^\=/", $val, $operatorArr);                                 // ^=
    $Nop += count($operatorArr[0]);
    preg_match_all("/[\w]*?\.[\w]*?/", $val, $operatorArr);                       // .
    $Nop += count($operatorArr[0]);
    preg_match_all("/\,/", $val, $operatorArr);                                   // ,
    $Nop += count($operatorArr[0]);
    preg_match_all("/\~/", $val, $operatorArr);                                   // ~
    $Nop += count($operatorArr[0]);
    return $Nop;
}
