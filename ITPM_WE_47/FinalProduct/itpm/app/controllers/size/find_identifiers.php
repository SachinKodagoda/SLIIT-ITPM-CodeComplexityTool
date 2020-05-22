
<?php
function num_identifiers($i,  $sanitiedArray, $scopedArr, $specialItemRemovedArr)
{
    $Nid = 0;
    $addNid = false;

    foreach ($scopedArr as $newItm) {
        if (substr_count($newItm['scope'], "for")) {
            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                $addNid = true;
            }
        }

        if (substr_count($newItm['scope'], "if")) {
            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                $addNid = true;
            }
        }

        if (substr_count($newItm['scope'], "while")) {
            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                $addNid = true;
            }
        }

        if (substr_count($newItm['scope'], "do")) {
            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                $addNid = true;
            }
        }

        if (substr_count($newItm['scope'], "switch")) {
            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                $addNid = true;
            }
        }

        if (substr_count($newItm['scope'], "case")) {
            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                $addNid = true;
            }
        }


        if ($newItm['scope'] == "") {
            if (($newItm['start'] <= $i) && ($newItm['end'] >= $i)) {
                $addNid = true;
            }
        }
    }


    if (
        count(preg_grep('/\b(main|class)\b/', explode("\n", $sanitiedArray[$i]))) > 0
    ) {
        $addNid = true;
    }

    if ($addNid) {
        $Nid = str_word_count($specialItemRemovedArr[$i], 0);
    }
    return $Nid;
}
