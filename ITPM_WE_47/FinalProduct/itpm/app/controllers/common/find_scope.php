<?php
function scope_arr($sanitiedArray)
{
    $OpenBracketCount = 0;
    $CloseBracketCount = 0;
    $ScopeCount = 0;
    $scopeArray = [];
    $scopeMapArray = [];
    $newOrderScopeArr = [];
    for ($i = 0; $i < count($sanitiedArray); $i++) {
        if (substr_count($sanitiedArray[$i], "{") == true) {
            array_push($scopeArray, "{");
            array_push($scopeMapArray, $i);
            $OpenBracketCount++;
        }
        if (substr_count($sanitiedArray[$i], "}") == true) {
            array_push($scopeArray, "}");
            array_push($scopeMapArray, $i);
            $CloseBracketCount++;
        }
        preg_match_all('/\bfor/', $sanitiedArray[$i], $for_arr);
        preg_match_all('/\bif/', $sanitiedArray[$i], $if_arr);
        preg_match_all('/\belse/', $sanitiedArray[$i], $else_arr);
        preg_match_all('/\bwhile/', $sanitiedArray[$i], $while_arr);

        if ((count($for_arr[0]) > 0) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i + 1], "{") == false)) {
            array_push(
                $newOrderScopeArr,
                array(
                    "start" => $i,
                    "end"   => $i + 1,
                    "scope" => "for"
                )
            );
        }
        if ((count($if_arr[0]) > 0) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i + 1], "{") == false)) {
            array_push(
                $newOrderScopeArr,
                array(
                    "start" => $i,
                    "end"   => $i + 1,
                    "scope" => "if"
                )
            );
        }
        if ((count($else_arr[0]) > 0) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i + 1], "{") == false)) {
            array_push(
                $newOrderScopeArr,
                array(
                    "start" => $i,
                    "end"   => $i + 1,
                    "scope" => "else"
                )
            );
        }
        if ((count($while_arr[0]) > 0) && (substr_count($sanitiedArray[$i], "{") == false)  && (substr_count($sanitiedArray[$i + 1], "{") == false)) {
            array_push(
                $newOrderScopeArr,
                array(
                    "start" => $i,
                    "end"   => $i + 1,
                    "scope" => "while"
                )
            );
        }
    }

    if ($OpenBracketCount != $CloseBracketCount) {
        echo "Program Opening Closeing are wrong";
    } else {
        $ScopeCount = $OpenBracketCount;
    }
    $scopedString = implode("", $scopeArray);
    $scopePosArrStart = [];
    $scopePosArrEnd = [];
    $searchStringLeft = "{";
    $searchStringCenter = "";
    $searchStringRight = "}";
    $replaceLength = 2;
    $replaceSring = "00";
    $totalRounds = $ScopeCount;

    for ($i = 1; $i <= $totalRounds; $i++) {
        $replacePos = strpos($scopedString, ($searchStringLeft . $searchStringCenter . $searchStringRight));
        if ($replacePos > -1) {
            array_push($scopePosArrStart, $replacePos);
            $scopedString = substr_replace($scopedString, $replaceSring, $replacePos, $replaceLength);
            array_push($scopePosArrEnd, ($replacePos + $replaceLength - 1));
        } else {
            $searchStringCenter = $searchStringCenter . "00";
            $replaceSring = $replaceSring . "00";
            $replaceLength += 2;
            $totalRounds++;
        }
    }

    for ($x = 0; $x < count($scopePosArrStart); $x++) {
        array_push(
            $newOrderScopeArr,
            array(
                "start" => $scopeMapArray[$scopePosArrStart[$x]],
                "end"   => $scopeMapArray[$scopePosArrEnd[$x]],
                "scope" => ""
            )
        );
    }

    sort($newOrderScopeArr);
    $troubleStructures = ["class", "main", "for", "if", "else",  "switch", "case", "while", "do"];
    $skipWhileOnece = false;
    for ($y = 0; $y < count($newOrderScopeArr); $y++) {
        if ($newOrderScopeArr[$y]['scope'] == "") {


            if (
                preg_match_all('/\b' . $troubleStructures[0] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[1] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[2] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[3] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[4] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[5] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[6] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[7] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[8] . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']])
            ) {

                $scopeStringFinal = "";
                foreach ($troubleStructures as $troubleKey) {
                    if (
                        preg_match_all('/\b' . $troubleKey . '\b/', $sanitiedArray[$newOrderScopeArr[$y]['start']])
                    ) {
                        $scopeStringFinal = $scopeStringFinal . " " . $troubleKey;
                    }
                }
                $newOrderScopeArr[$y]['scope'] = $scopeStringFinal;
            } else if (
                preg_match_all('/\b' . $troubleStructures[0] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[1] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[2] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[3] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[4] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[5] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[6] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[7] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']]) ||
                preg_match_all('/\b' . $troubleStructures[8] . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']])
            ) {
                $scopeStringFinal = "";
                foreach ($troubleStructures as $troubleKey) {
                    if (
                        preg_match_all('/\b' . $troubleKey . '\b/', $sanitiedArray[$newOrderScopeArr[$y - 1]['start']])
                    ) {
                        $scopeStringFinal = $scopeStringFinal . " " . $troubleKey;
                    }
                }
                $newOrderScopeArr[$y - 1]['scope'] = $scopeStringFinal;
            }
        }
    }


    foreach ($newOrderScopeArr as $key => $value) {
        if (
            preg_match_all('/\b' . $troubleStructures[8] . '\b/', $value['scope'])
        ) {
            if (preg_match_all('/\b' . $troubleStructures[7] . '\b/', $value['scope'])) {
                $newOrderScopeArr[$key]['scope'] = preg_replace('/\b' . $troubleStructures[7] . '\b/', "", $newOrderScopeArr[$key]['scope']);
                unset($newOrderScopeArr[$key]);
            } else if (preg_match_all('/\b' . $troubleStructures[7] . '\b/', $newOrderScopeArr[$key + 1]['scope'])) {
                $newOrderScopeArr[$key + 1]['scope'] = preg_replace('/\b' . $troubleStructures[7] . '\b/', "", $newOrderScopeArr[$key + 1]['scope']);
                unset($newOrderScopeArr[$key + 1]);
            }
        }
    }

    return $newOrderScopeArr;

}
