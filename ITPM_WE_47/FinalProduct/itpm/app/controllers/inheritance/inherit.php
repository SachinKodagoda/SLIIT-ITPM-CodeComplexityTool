<?php
function inheritance_calc($unSanitiedString,$specialItemRemovedArr)
{

    $sanitiedArray = explode("\n", strtolower($unSanitiedString));
    $unSanitiedArray = explode("\n", $unSanitiedString);
    $data = array("class_names" => [], "extended_list" => []);
    $class_names = array();
    $extended_list = array();

    for ($i = 0; $i < count($sanitiedArray); $i++) {
        if (
            count(preg_grep('/\b(class)/', explode("\n", $sanitiedArray[$i]))) > 0
        ) {
            $str_arr = getInbetweenStrings('class|Class|CLASS', $unSanitiedArray[$i]);
            if (count($str_arr)>0){
                $wordsArr = explode(" ", $specialItemRemovedArr[$i]);
                array_push($class_names,trim($str_arr[0]));
                for ($x=0; $x < count($wordsArr); $x++) { 
                    if(
                        trim(strtolower($str_arr[0])) != trim(strtolower($wordsArr[$x]))  &&
                        trim($wordsArr[$x]) != ""
                    ){
                        array_push($extended_list,trim($wordsArr[$x]));
                    }
                }
            }
        }
    }
    $data["class_names"] = $class_names;
    $data["extended_list"] = $extended_list;
    return $data;
}

function getInbetweenStrings($start, $str)
{
    $matches = array();
    $regex = "/(?<=$start)[\s]+[a-zA-Z0-9_]*/";
    preg_match_all($regex, $str, $matches);
    return $matches[0];
}

