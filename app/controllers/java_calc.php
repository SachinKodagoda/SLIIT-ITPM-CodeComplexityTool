<?php
include 'common/format_string.php';
include 'common/display_array.php';
include 'common/find_scope.php';
include 'common/specialItemKeepArray.php';
include 'common/specialItemRemovedArr.php';

include 'size/find_keywords.php';
include 'size/find_identifiers.php';
include 'size/find_operators.php';
include 'size/find_numerics.php';
include 'size/find_stringLiterals.php';

include 'variables/find_variables.php';

function java_calc($file)
{
    $convertedTostring = format_string(file_get_contents($file));
    $Nkw = 0; // Number of keywords
    $Nid = 0; // Number of identifiers
    $Nop = 0; // Number of operators
    $Nnv = 0; // Number of numerical values
    $Nsl = 0; // Number of string literals

    $Ngv = 0; // Number of global Variables
    $Nlv = 0; // Number of local Variables
    $Npdtv = 0; // Number of primitive data type Variables
    $Ncdtv = 0; // Number of compositive data type Variables
    $Npdtp = 0; // Number of primitive data type parameters
    $Ncdtp = 0; // Number of composite data type parameters
    $NOfVoidReturns = 0;
    $NOfPrimitiveReturns = 0;
    $NOfCompositeReturns = 0;

    $dataArr = array();
    $displayArray = displayArray($convertedTostring);
    $specialItemRemovedArr = specialItemRemovedArr(strtolower($convertedTostring));
    $specialItemKeepArray = specialItemKeepArray(strtolower($convertedTostring));
    $sanitiedArray = explode("\n", strtolower($convertedTostring));
    $scopedArr = scope_arr($sanitiedArray);

    for ($i = 0; $i < count($sanitiedArray); $i++) {
        $Nkw = num_keywords($sanitiedArray[$i]);
        $Nid = num_identifiers($i, $sanitiedArray, $scopedArr, $specialItemRemovedArr);
        $Nop = num_operators($sanitiedArray[$i]);
        $Nnv = num_numerics($sanitiedArray[$i]);
        $Nsl = num_stringLiterals($sanitiedArray[$i]);

        $variables_arr = num_variables($i, $sanitiedArray, $scopedArr,  $specialItemKeepArray, $specialItemRemovedArr);
        $Ngv = $variables_arr[0];
        $Nlv = $variables_arr[1];
        $Npdtv = $variables_arr[2];
        $Ncdtv = $variables_arr[3];
        $Npdtp = $variables_arr[4];
        $Ncdtp = $variables_arr[5];
        $NOfVoidReturns = $variables_arr[6];
        $NOfPrimitiveReturns = $variables_arr[7];
        $NOfCompositeReturns = $variables_arr[8];

        // Final Data in a 3D array
        $dataArr[$i] = array(
            "LineNo" => $i,
            "Code" => $displayArray[$i],
            // "Code" => $specialItemRemovedArr[$i],
            // "Code" => $specialItemKeepArray[$i],
            "Nkw" => $Nkw,
            "Nid" => $Nid,
            "Nop" => $Nop,
            "Nnv" => $Nnv,
            "Nsl" => $Nsl,
            "Cs" => 0,

            "Ngv" => $Ngv,
            "Nlv" => $Nlv,
            "Npdtv" => $Npdtv,
            "Ncdtv" => $Ncdtv,
            "Cv" => 0,

            "NOfVoidReturns" => $NOfVoidReturns,
            "NOfPrimitiveReturns" => $NOfPrimitiveReturns,
            "NOfCompositeReturns" => $NOfCompositeReturns,
            "Npdtp" => $Npdtp,
            "Ncdtp" => $Ncdtp,
            "Cm" => 0,

            //Thses are mannually added
            "Nr" => 0,
            "Nmcms" => 0,
            "Nmcmd" => 0,
            "Nmcrms" => 0,
            "Nmcrmd" => 0,
            "Nrmcrms" => 0,
            "Nrmcrmd" => 0,
            "Nrmcms" => 0,
            "Nrmcmd" => 0,
            "Nmrgvs" => 0,
            "Nmrgvd" => 0,
            "Nrmrgvs" => 0,
            "Nrmrgvd" => 0,
            "Ccp" => 0,

            "Wtcs" => 0,
            "NC" => 0,
            "Ccspps" => 0,
            "Ccs" => 0,

            "Ci" => 0,

            "Cs" => 0,
            "Cv" => 0,
            "Cm" => 0,
            "Ci" => 0,
            "Ccp" => 0,
            "Ccs" => 0,
            "TCps" => 0,
        );
        $Nkw = 0; // Number of keywords
        $Nid = 0; // Number of identifiers
        $Nop = 0; // Number of operators
        $Nnv = 0; // Number of numerical values
        $Nsl = 0; // Number of string literals

        $Ngv = 0; // Number of global Variables
        $Nlv = 0; // Number of local Variables
        $Npdtv = 0; // Number of primitive data type Variables
        $Ncdtv = 0; // Number of compositive data type Variables
        $Npdtp = 0; // Number of primitive data type parameters
        $Ncdtp = 0; // Number of composite data type parameters
        $NOfVoidReturns = 0;
        $NOfPrimitiveReturns = 0;
        $NOfCompositeReturns = 0;
    }

    return $dataArr;
}
