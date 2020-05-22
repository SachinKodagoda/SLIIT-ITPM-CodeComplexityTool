<?php
function num_operators($valx)
{
    // +  -  *  /  %  =  !  >   <   |        ^   .  ,  ~ 
    // += -= *= /= %= == != >=  <=  || && :: ^= 
    // ++ --                >>  <<  |= &=
    //    ->                >>> <<<
    //                      >>= <<=

    preg_match_all('/\bimport/', $valx, $temp);
    $val = preg_replace('/\"(.*?)\"/', '', $valx);
    $Nop = 0;
    if (count($temp[0]) <= 0) {
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
        preg_match_all("/\b(?<!list|arraylist|map|hashmap|hashtable|linkedhashmap|treemap)\s*[^\-\>]\>[^\=\>]/", $val, $operatorArr);                     // >
        $Nop += count($operatorArr[0]);
        preg_match_all("/[^\>]\>\=/", $val, $operatorArr);                            // >=
        $Nop += count($operatorArr[0]);
        preg_match_all("/[^\>]\>\>[^\>\=]/", $val, $operatorArr);                     // >>
        $Nop += count($operatorArr[0]);
        preg_match_all("/\>\>\>[^=]/", $val, $operatorArr);                           // >>>
        $Nop += count($operatorArr[0]);
        preg_match_all("/[^\>]\>\>\=/", $val, $operatorArr);                          // >>=
        $Nop += count($operatorArr[0]);
        preg_match_all("/\b(?<!list|arraylist|map|hashmap|hashtable|linkedhashmap|treemap)\s*[^-<]\<[^=<]\s*/", $val, $operatorArr);                     // <
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
    }



    return $Nop;
}
