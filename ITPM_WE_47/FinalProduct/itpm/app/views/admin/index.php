<?php
// print_r ($data['cs_values']);
?>

<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title><?php echo SITENAME ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google" content="notranslate">
    <meta http-equiv="Content-Language" content="en">
    <!-- icon -->
    <link rel="icon" href="<?php echo URLROOT ?>/img/global/sliit.png" type="image/png" sizes="16x16" />
    <!-- styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT ?>/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT ?>/css/style.css" />
</head>

<body>

    <div class="overallCover">


        <div class="topSettingBar">
            <div class="setWeight" onclick="showWeightTable()">Set Weight</div>
            <select id="fileSelectedOption" onchange="selectChanged(this)"></select>
            <div class="programComplexity" id="programComplexity">Program Complexity<span class="programComplexitySpan">1</span></div>
        </div>
        <div class="selectionItemCover">
            <div class="selectionItem" onclick="openTab(event, 'table_1')" id="size_selected">size</div><br />
            <div class="selectionItem" onclick="openTab(event, 'table_2')" id="variable_selected">variables</div><br />
            <div class="selectionItem" onclick="openTab(event, 'table_3')" id="methods_selected">methods</div><br />
            <div class="selectionItem" onclick="openTab(event, 'table_4')" id="coupling_selected">coupling</div><br />
            <div class="selectionItem" onclick="openTab(event, 'table_5')" id="controlStructure_selected">control structures</div><br />
            <div class="selectionItem" onclick="openTab(event, 'table_6')" id="Inheritance_selected">Inheritance</div><br />
            <div class="selectionItem" onclick="openTab(event, 'table_7')" id="allFactor_selected">all factors</div><br />
        </div>


        <div class="customTableCover">

            <!-- Size Table -->
            <div class="customTableInnerCover" id="table_1">
                <table class="customTable" id="table_1_inner">

                </table>
            </div>

            <!-- Variable Table -->
            <div class="customTableInnerCover" id="table_2">
                <table class="customTable" id="table_2_inner">
                </table>
            </div>

            <!-- Method Table -->
            <div class="customTableInnerCover" id="table_3">
                <table class="customTable" id="table_3_inner">
                </table>
            </div>


            <!-- Coupling Table -->
            <div class="customTableInnerCover" id="table_4">
                <table class="customTable" id="table_4_inner">
                </table>
            </div>

            <!-- Control Structure Table -->
            <div class="customTableInnerCover" id="table_5">
                <table class="customTable" id="table_5_inner">
                </table>
            </div>

            <!-- Inheritance Table -->
            <div class="customTableInnerCover" id="table_6">
                <table class="customTable" id="table_6_inner">
                </table>
            </div>

            <!-- All Factor Table -->
            <div class="customTableInnerCover" id="table_7">
                <table class="customTable" id="table_7_inner">
                </table>
            </div>

            <div class="selector" onclick="showModal('uploadModal_upload')">
                <img src="<?php echo URLROOT ?>/img/upload.svg" alt="">
            </div>

            <div class="commonModal" id="commonModal">
                <div class="uploadModalBack" onclick="" id="uploadModalBack"></div>
                <div class="uploadModal" id="uploadModal_upload">
                    <form action="<?php echo URLROOT; ?>/admin" method="post" enctype="multipart/form-data" class="fileSubmitForm">
                        <input type="file" name="upload[]" id="fileToUpload" class="fileSubmitForm_item" multiple="multiple">
                        <input type="submit" value="Upload Code" name="submit" class="fileSubmitForm_item fileSubmitForm_item-btn">
                    </form>
                </div>
                <div class="uploadModal" id="uploadModal_size">
                    <div class="modalTableTopic">Weight related to the size factor</div>
                    <table class="modalTable">
                        <thead>
                            <tr>
                                <th>Program Component</th>
                                <th>Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Keyword</td>
                                <td><input type="number" value="1" class="inputNumbrs" id="1_keyword_value" min="0"></td>
                            </tr>
                            <tr>
                                <td>Identifier</td>
                                <td><input type="number" value="1" class="inputNumbrs" id="1_identifier_value" min="0"></td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td><input type="number" value="1" class="inputNumbrs" id="1_operator_value" min="0"></td>
                            </tr>
                            <tr>
                                <td>Numerical value</td>
                                <td><input type="number" value="1" class="inputNumbrs" id="1_numerical_value" min="0"></td>
                            </tr>
                            <tr>
                                <td>String literal</td>
                                <td><input type="number" value="1" class="inputNumbrs" id="1_string_value" min="0"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modalTableSave" onclick="inputChanged('complexityOfSizes')">Save</div>
                </div>
                <div class="uploadModal" id="uploadModal_variable">
                    <div class="modalTableTopic">Weight related to the variable factor</div>
                    <table class="modalTable">
                        <thead>
                            <tr>
                                <th>Program Component</th>
                                <th>Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Global Variable</td>
                                <td><input type="number" value="2" class="inputNumbrs" id="2_global_variables" min="0"></td>
                            </tr>
                            <tr>
                                <td>Local Variable</td>
                                <td><input type="number" value="1" class="inputNumbrs" id="2_local_variables" min="0"></td>
                            </tr>
                            <tr>
                                <td>Primitive data type variable</td>
                                <td><input type="number" value="1" class="inputNumbrs" id="2_primitive_variables" min="0"></td>
                            </tr>
                            <tr>
                                <td>Composite data type variable</td>
                                <td><input type="number" value="2" class="inputNumbrs" id="2_composite_variables" min="0"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modalTableSave" onclick="inputChanged('complexityOfVariables')">Save</div>
                </div>
                <div class="uploadModal" id="uploadModal_methods">
                    <div class="modalTableTopic">Weight related to the method factor</div>
                    <table class="modalTable">
                        <thead>
                            <tr>
                                <th>Program Component</th>
                                <th>Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Method with a primitive return type</td>
                                <td><input type="number" value="1" class="inputNumbrs" id="3_primitive_return" min="0"></td>
                            </tr>
                            <tr>
                                <td>Method with a composite return type</td>
                                <td><input type="number" value="2" class="inputNumbrs" id="3_composite_return" min="0"></td>
                            </tr>
                            <tr>
                                <td>Method with a void return type</td>
                                <td><input type="number" value="0" class="inputNumbrs" id="3_void_return" min="0"></td>
                            </tr>
                            <tr>
                                <td>Primitive data type parameter</td>
                                <td><input type="number" value="1" class="inputNumbrs" id="3_primitive_parameter" min="0"></td>
                            </tr>
                            <tr>
                                <td>Composite data type parameter</td>
                                <td><input type="number" value="2" class="inputNumbrs" id="3_composite_parameter" min="0"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modalTableSave" onclick="inputChanged('complexityOfMethods')">Save</div>
                </div>
                <div class="uploadModal" id="uploadModal_coupling">
                    <div class="modalTableTopic">Weight related to the coupling factor</div>
                    <table class="modalTable">
                        <thead>
                            <tr>
                                <th>Coupling Type</th>
                                <th>Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>A recursive call</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>A regular method calling another regular method in the same file</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>A regular method calling another regular method in the different file</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>A regular method calling recursive method in the same file</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>A regular method calling recursive method in the different file</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>A recursive method calling recursive method in the same file</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>A recursive method calling recursive method in the different file</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>A recursive method calling regular method in the same file</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>A recursive method calling regular method in the different file</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>A regular method referencing a global variable in the same file</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>A regular method referencing a global variable in the different file</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>A recursive method referencing a global variable in the same file</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>A recursive method referencing a global variable in the different file</td>
                                <td>2</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modalTableSave">Save</div>
                </div>
                <div class="uploadModal" id="uploadModal_controlStructures">
                    <div class="modalTableTopic">Weight related to the control structure factor</div>
                    <table class="modalTable">
                        <thead>
                            <tr>
                                <th>Control Structure Type</th>
                                <th>Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>A conditional control structure such as an 'if' or 'else-if' condition</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>An iterative lcontrol struture such as a 'for', 'while', or 'do-while' loop</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>The 'switch' statement in a 'switch-case' control structure</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Each 'case' statement in a 'switch-case' control structure</td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modalTableSave">Save</div>
                </div>
                <div class="uploadModal" id="uploadModal_inheritance">
                    <div class="modalTableTopic">Weight related to the inheritance factor</div>
                    <table class="modalTable">
                        <thead>
                            <tr>
                                <th>Inherited Pattern</th>
                                <th>Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>A class with no inheritance (direct or indirect)</td>
                                <td><input type="number" value="0" class="inputNumbrs" id="6_no_inheritance" min="0"></td>
                            </tr>
                            <tr>
                                <td>A class inheritance (directly or indirectly) from one user-defined class</td>
                                <td><input type="number" value="1" class="inputNumbrs" id="6_one_inheritance" min="0"></td>
                            </tr>
                            <tr>
                                <td>A class inheritance (directly or indirectly) from two user-defined class</td>
                                <td><input type="number" value="2" class="inputNumbrs" id="6_two_inheritance" min="0"></td>
                            </tr>
                            <tr>
                                <td>A class inheritance (directly or indirectly) from three user-defined class</td>
                                <td><input type="number" value="3" class="inputNumbrs" id="6_three_inheritance" min="0"></td>
                            </tr>
                            <tr>
                                <td>A class inheritance (directly or indirectly) from more than three user-defined class</td>
                                <td><input type="number" value="4" class="inputNumbrs" id="6_four_inheritance" min="0"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modalTableSave" onclick="inputChanged('complexityOfInheritance')">Save</div>
                </div>
                <div class="uploadModal" id="uploadModal_allfactor">
                    <div class="modalTableTopic">Weight related to the size factor</div>
                    <table class="modalTable">
                        <thead>
                            <tr>
                                <th>Program Component</th>
                                <th>Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Keyword</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>Identifier</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>Numerical Value</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>String Value</td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modalTableSave">Save</div>
                </div>
            </div>
        </div><!-- EndOfThe customTableCover -->
    </div>
    <script src="<?php echo URLROOT ?>/js/color.js" type="text/javascript"></script>
    <script type='text/javascript'>
        var javascript_array = [];
        var javascript_fullData = [];
        var javascript_filenames = [];
        <?php
        if (count($data["complexity_values"]) > 0) {
            $php_complexity_values = $data["complexity_values"];
            $php_file_names = $data["file_names"];
            $php_complexity_values_encoded = json_encode($php_complexity_values);
            $php_file_names_encoded = json_encode($php_file_names);
            echo "javascript_fullData = " . $php_complexity_values_encoded . ";\n";
            echo "javascript_filenames = " . $php_file_names_encoded . ";\n";
        } else {
            echo "javascript_fullData = [];\n";
            echo "javascript_filenames = [];\n";
        }
        ?>

        function addSelection(item) {
            var dropdown = document.getElementById("fileSelectedOption");
            dropdown.innerHTML = "";
            for (let x = 0; x < javascript_filenames.length; x++) {
                var option = document.createElement("option");
                option.text = javascript_filenames[x];
                option.value = x;
                dropdown.add(option);
            }
            dropdown.selectedIndex = item;
        }

        function selectChanged(item) {
            createAllTables(item.value);
        }

        javascript_array = javascript_fullData[0];

        var table_1 = document.getElementById('table_1_inner');
        var table_1_headerArray = [
            "Line no ",
            "Program Statements",
            "<div class='tooltip'>(Nkw) * Wkw <span class='tooltiptext'>(Number of Keywords)<br/>*<br/> Weight of Keywords </span></div>",
            "<div class='tooltip'>(Nid) * Wid <span class='tooltiptext'>(Number of Identifiers)<br/>*<br/> Weight of Identifiers </span></div>",
            "<div class='tooltip'>(Nop) * Wop <span class='tooltiptext'>(Number of Operators)<br/>*<br/> Weight of Operators </span></div>",
            "<div class='tooltip'>(Nnv) * Wnv <span class='tooltiptext'>(Number of Numerical Values)<br/>*<br/> Weight of Numerical Values </span></div>",
            "<div class='tooltip'>(Nsl) * Wsl <span class='tooltiptext'>(Number of String Literals)<br/>*<br/> Weight of String Literals </span></div>",
            "<div class='tooltip'>Cs<span class='tooltiptext'>Complexity of Size</span></div>"
        ];
        var table_1_bodyArray = ["LineNo", "Code", "Nkw", "Nid", "Nop", "Nnv", "Nsl", "Cs"];
        var table_1_weight = ["", "", 1, 1, 1, 1, 1, ""];

        if (sessionStorage.getItem("table_1_weight")) {
            // table_1_weight = JSON.parse(sessionStorage.getItem("table_1_weight"));
        }

        var table_2 = document.getElementById('table_2_inner');
        var table_2_headerArray = [
            "Line no",
            "Program Statements",
            "<div class='tooltip'>(Npdtv) * Wpdtv * Wvs<span class='tooltiptext'>(Number of Primitive Data type Variables)<br/>*<br/> Weight of primitive data type variables <br/>*<br/>Weight due to variable scope</span></div>",
            "<div class='tooltip'>(Ncdtv) * Wcdtv * Wvs<span class='tooltiptext'>(Number of Composite Data type Variables)<br/>*<br/> Weight of composite data type variables <br/>*<br/>Weight due to variable scope</span></div>",
            "<div class='tooltip'>Cv<span class='tooltiptext'>Complexity of Variables</span></div>"
        ];

        var table_2_bodyArray = ["LineNo", "Code", "Npdtv", "Ncdtv", "Cv"];
        // ["Ngv 0", "Nlv 1", "Npdtv 2", "Ncdtv 3"]
        var table_2_weight = [2, 1, 1, 2];

        if (sessionStorage.getItem("table_2_weight")) {
            // table_2_weight = JSON.parse(sessionStorage.getItem("table_2_weight"));
        }

        var table_3 = document.getElementById('table_3_inner');
        var table_3_headerArray = [
            "Line no",
            "Program Statements",
            "<div class='tooltip'>(Nvr) * Wvr + (Npr) * Wpr + (Ncr) * Wcr<span class='tooltiptext'>(Number of void returns)<br/>*<br/>Weight of void returns<br/>+<br/>(Number of primitive returns)<br/>*<br/>Weight of primitive returns<br/>+<br/>(Number of composite returns)<br/>*<br/>Weight of composite returns</span></div>",
            "<div class='tooltip'>(Npdtp) * Wpdtp<span class='tooltiptext'>(Number of primitive data type parameters)<br/>*<br/>Weight of primitive data type parameters</span></div>",
            "<div class='tooltip'>(Ncdtp) * Wcdtp<span class='tooltiptext'>(Number of composite data type parameters)<br/>*<br/>Weight of composite data type parameters</span></div>",
            "<div class='tooltip'>Cm<span class='tooltiptext'>Complexity of a line which includes a method signature</span></div>"
        ];
        var table_3_bodyArray = ["LineNo", "Code", "Wmrt", "Npdtp", "Ncdtp", "Cm"];
        // ["NOfVoidReturns" 0, "NOfPrimitiveReturns" 1, "NOfCompositeReturns" 2, "Npdtp" 3, "Ncdtp" 4]
        var table_3_weight = [0, 1, 2, 1, 2];

        if (sessionStorage.getItem("table_3_weight")) {
            // table_3_weight = JSON.parse(sessionStorage.getItem("table_3_weight"));
        }

        var table_4 = document.getElementById('table_4_inner');
        var table_4_headerArray = [
            "Line no",
            "Program Statements",
            "<span class='rotatedWord'>Nr</span>",
            "<span class='rotatedWord'>Nmcms</span>",
            "<span class='rotatedWord'>Nmcmd</span>",
            "<span class='rotatedWord'>Nmcrms</span>",
            "<span class='rotatedWord'>Nmcrmd</span>",
            "<span class='rotatedWord'>Nrmcrms</span>",
            "<span class='rotatedWord'>Nrmcrmd</span>",
            "<span class='rotatedWord'>Nrmcms</span>",
            "<span class='rotatedWord'>Nrmcmd</span>",
            "<span class='rotatedWord'>Nmrgvs</span>",
            "<span class='rotatedWord'>Nmrgvd</span>",
            "<span class='rotatedWord'>Nrmrgvs</span>",
            "<span class='rotatedWord'>Nrmrgvd</span>",
            "<span class='rotatedWord'>Ccp</span>"
        ];
        var table_4_bodyArray = ["LineNo", "Code", "Nr", "Nmcms", "Nmcmd", "Nmcrms", "Nmcrmd", "Nrmcrms", "Nrmcrmd", "Nrmcms", "Nrmcmd", "Nmrgvs", "Nmrgvd", "Nrmrgvs", "Nrmrgvd", "Ccp"];
        var table_4_weight = ["", "", 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, ""];

        if (sessionStorage.getItem("table_4_weight")) {
            table_4_weight = JSON.parse(sessionStorage.getItem("table_4_weight"));
        }

        var table_5 = document.getElementById('table_5_inner');
        var table_5_headerArray = ["Line no", "Program Statements", "Wtcs", "NC", "Ccspps", "Ccs"];
        var table_5_bodyArray = ["LineNo", "Code", "Wtcs", "NC", "Ccspps", "Ccs"];
        var table_5_weight = ["", "", 1, 1, 1, ""];

        if (sessionStorage.getItem("table_5_weight")) {
            table_5_weight = JSON.parse(sessionStorage.getItem("table_5_weight"));
        }

        var table_6 = document.getElementById('table_6_inner');

        var table_6_headerArray = [
            "Count",
            "Class Name",
            "<div class='tooltip'>Ndi<span class='tooltiptext'>No of direct inheritances</span></div>",
            "<div class='tooltip'>Nidi<span class='tooltiptext'>No of indirect inheritances</span></div>",
            "<div class='tooltip'>Ti<span class='tooltiptext'>Total inheritances</span></div>",
            "<div class='tooltip'>Ci<span class='tooltiptext'>Complexity of inheritances</span></div>",
        ];
        var table_6_bodyArray = ["LineNo", "Code", "", "", "", ""];
        var table_6_weight = [0, 1, 2, 3, 4];


        if (sessionStorage.getItem("table_6_weight")) {
            // table_6_weight = JSON.parse(sessionStorage.getItem("table_6_weight"));
        }

        var table_7 = document.getElementById('table_7_inner');
        var table_7_headerArray = ["Line no", "Program Statements", "Cs", "Cv", "Cm", "Ci", "Ccp", "Ccs", "TCps"];
        var table_7_bodyArray = ["LineNo", "Code", "", "", "", "", "", "", ""];
        var table_7_weight = ["", "", 1, 1, 1, 1, 1, 1, ""];

        function giveMeFileNo(Citems) {
            var selectedFile = parseInt(sessionStorage.getItem("fileNo"), 10);
            var machingExtendingClasses = [];
            for (var z = 0; z < javascript_fullData.length; z++) {
                for (var x = 0; x < javascript_fullData[z]['class_data']['class_names'].length; x++) {
                    if (Citems.toLowerCase() == javascript_fullData[z]['class_data']['class_names'][x].toLowerCase()) {
                        machingExtendingClasses.push(Citems); // maching class
                        machingExtendingClasses.push(javascript_filenames[z]); // file names
                        machingExtendingClasses.push(javascript_fullData[z]['class_data']['extended_list']); // extending classes for the maching class
                    }
                }
            }
            return machingExtendingClasses;
        }

        function tableCreate(xtable, xheaderArray, xbodyArray, xweightArray, tableNum) {
            var thead = document.createElement('thead');
            var thead_tr = document.createElement('tr');
            var tbody = document.createElement('tbody');

            for (var i = 0; i < xheaderArray.length; i++) {
                var thead_tr_th = document.createElement('th');
                thead_tr_th.classList.add("centerHeader");
                thead_tr_th.innerHTML = xheaderArray[i];
                thead_tr.appendChild(thead_tr_th);
            }

            thead.appendChild(thead_tr);
            xtable.appendChild(thead);
            var final_tot = 0;


            if (tableNum == 6) {
                // var selectedFile = parseInt(sessionStorage.getItem("fileNo"), 10);
                var counterx = 0;
                var firstClass = 0;
                for (var x = 0; x < javascript_array['class_data']['class_names'].length; x++) {

                    for (var y = 0; y < javascript_array['class_data']['extended_list'].length; y++) {
                        firstClass = 1;
                        var tbody_tr = document.createElement('tr');
                        var numbrOfDirectInheritance = 0;
                        var numbrOfIndirectInheritance = 0;
                        // var complexityWeightOfIneritance = table_6_weight[0];
                        var finalString = "";
                        var temp1 = giveMeFileNo(javascript_array['class_data']['extended_list'][y]);
                        if (temp1.length > 0) {
                            counterx++;
                            finalString = javascript_array['class_data']['class_names'][x];
                            numbrOfDirectInheritance++;
                            // complexityWeightOfIneritance = table_6_weight[1];
                            finalString += " → "
                            finalString += temp1[0];
                            finalString += "(";
                            finalString += temp1[1];
                            finalString += ")";
                            for (let m = 0; m < temp1[2].length; m++) {
                                var temp2 = giveMeFileNo(temp1[2][m]);
                                if (temp2.length > 0) {
                                    if (m > 0) {
                                        finalString += "<br/>";
                                        finalString += javascript_array['class_data']['class_names'][x];
                                        finalString += " → "
                                        finalString += temp1[0];
                                        finalString += "(";
                                        finalString += temp1[1];
                                        finalString += ")";
                                    }
                                    numbrOfIndirectInheritance++;
                                    // complexityWeightOfIneritance = table_6_weight[2];
                                    finalString += " → "
                                    finalString += temp2[0];
                                    finalString += "(";
                                    finalString += temp2[1];
                                    finalString += ")";
                                    for (let n = 0; n < temp2[2].length; n++) {
                                        var temp3 = giveMeFileNo(temp2[2][n]);
                                        if (temp3.length > 0) {
                                            numbrOfIndirectInheritance++;
                                            // complexityWeightOfIneritance = table_6_weight[3];
                                            finalString += " → "
                                            finalString += temp3[0];
                                            finalString += "(";
                                            finalString += temp3[1];
                                            finalString += ")";
                                            for (let p = 0; p < temp3[2].length; p++) {
                                                var temp4 = giveMeFileNo(temp3[2][n]);
                                                if (temp4.length > 0) {
                                                    numbrOfIndirectInheritance++;
                                                    // complexityWeightOfIneritance = table_6_weight[4];
                                                    finalString += " → "
                                                    finalString += temp4[0];
                                                    finalString += "(";
                                                    finalString += temp4[1];
                                                    finalString += ")";
                                                    for (let q = 0; q < temp4[2].length; q++) {
                                                        var temp5 = giveMeFileNo(temp4[2][n]);
                                                        if (temp5.length > 0) {
                                                            numbrOfIndirectInheritance++;
                                                            // complexityWeightOfIneritance = table_6_weight[4];
                                                            finalString += " → "
                                                            finalString += temp5[0];
                                                            finalString += "(";
                                                            finalString += temp5[1];
                                                            finalString += ")";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if (finalString != "") {
                            var tempComplexity = table_6_weight[0];
                            switch (numbrOfDirectInheritance + numbrOfIndirectInheritance) {
                                case 0:
                                    tempComplexity = table_6_weight[0];
                                    break;
                                case 1:
                                    tempComplexity = table_6_weight[1];
                                    break;
                                case 2:
                                    tempComplexity = table_6_weight[2];
                                    break;
                                case 3:
                                    tempComplexity = table_6_weight[3];
                                    break;
                                case 4:
                                    tempComplexity = table_6_weight[4];
                                    break;
                                default:
                                    tempComplexity = table_6_weight[4];
                                    break;
                            }
                            for (var i = 0; i < xheaderArray.length; i++) {
                                var tbody_tr_td = document.createElement('td');
                                if (i == 0) {
                                    tbody_tr_td.innerHTML = counterx;
                                } else if (i == 1) {
                                    tbody_tr_td.innerHTML = finalString;
                                } else if (i == 2) {
                                    tbody_tr_td.innerHTML = numbrOfDirectInheritance;
                                } else if (i == 3) {
                                    tbody_tr_td.innerHTML = numbrOfIndirectInheritance;
                                } else if (i == 4) {
                                    // tbody_tr_td.innerHTML = (numbrOfDirectInheritance + numbrOfIndirectInheritance) + " * (" + complexityWeightOfIneritance + ")";

                                    tbody_tr_td.innerHTML = (numbrOfDirectInheritance + numbrOfIndirectInheritance) + " * (" + tempComplexity + ")";
                                } else if (i == 5) {
                                    // tbody_tr_td.innerHTML = (numbrOfDirectInheritance + numbrOfIndirectInheritance) * complexityWeightOfIneritance;
                                    tbody_tr_td.innerHTML = (numbrOfDirectInheritance + numbrOfIndirectInheritance) * tempComplexity;
                                }
                                tbody_tr.appendChild(tbody_tr_td);
                            }
                        }

                        finalString = "";
                        numbrOfDirectInheritance = 0;
                        numbrOfIndirectInheritance = 0;
                        // complexityWeightOfIneritance = table_6_weight[0];
                        tbody.appendChild(tbody_tr);
                    }
                    if (firstClass == 0) {
                        var tbody_tr = document.createElement('tr');
                        for (var i = 0; i < xheaderArray.length; i++) {
                            var tbody_tr_td = document.createElement('td');
                            if (i == 0) {
                                tbody_tr_td.innerHTML = counterx + 1;
                            } else if (i == 1) {
                                tbody_tr_td.innerHTML = javascript_array['class_data']['class_names'][x];
                            } else if (i == 2) {
                                tbody_tr_td.innerHTML = 0;
                            } else if (i == 3) {
                                tbody_tr_td.innerHTML = 0;
                            } else if (i == 4) {
                                tbody_tr_td.innerHTML = "0  * (" + table_6_weight[0] + ")";
                            } else if (i == 5) {
                                tbody_tr_td.innerHTML = 0;
                            }
                            tbody_tr.appendChild(tbody_tr_td);
                        }
                        tbody.appendChild(tbody_tr);
                    }
                    firstClass = 0;
                    counterx++;
                }

            } else {
                for (var i = 0; i < javascript_array['linebyline_data'].length; i++) {
                    var tbody_tr = document.createElement('tr');
                    var totCs = 0;
                    var table_2_tot = 0;
                    var table_3_tot = 0;
                    var wmrt_tot = 0;

                    if (tableNum == "2") {
                        // ["Ngv 0", "Nlv 1", "Npdtv 2", "Ncdtv 3"]
                        // Wvs [(Wpdtv * Npdtv) + (Wcdtv * Ncdtv)]
                        var premitive = (parseInt(javascript_array['linebyline_data'][i]['Npdtv'], 10) * xweightArray[2]) * (parseInt(javascript_array['linebyline_data'][i]['Ngv'], 10) > 0 ? xweightArray[0] : xweightArray[1]);
                        var composite = (parseInt(javascript_array['linebyline_data'][i]['Ncdtv'], 10) * xweightArray[3]) * (parseInt(javascript_array['linebyline_data'][i]['Ngv'], 10) > 0 ? xweightArray[0] : xweightArray[1]);
                        table_2_tot = premitive + composite;
                    }

                    if (tableNum == "3") {
                        // ["NOfVoidReturns" 0, "NOfPrimitiveReturns" 1, "NOfCompositeReturns" 2, "Npdtp" 3, "Ncdtp" 4]
                        // Wmrt + (Wpdtp * Npdtp) + (Wcdtp * Ncdtp)
                        var voidReturns = parseInt(javascript_array['linebyline_data'][i]['NOfVoidReturns'], 10) * xweightArray[0];
                        var primaryReturns = parseInt(javascript_array['linebyline_data'][i]['NOfPrimitiveReturns'], 10) * xweightArray[1];
                        var compositeReturns = parseInt(javascript_array['linebyline_data'][i]['NOfCompositeReturns'], 10) * xweightArray[2];
                        wmrt_tot = voidReturns + primaryReturns + compositeReturns;
                        var premitiveParas = parseInt(javascript_array['linebyline_data'][i]['Npdtp'], 10) * xweightArray[3];
                        var compositeParas = parseInt(javascript_array['linebyline_data'][i]['Ncdtp'], 10) * xweightArray[4];
                        table_3_tot = wmrt_tot + premitiveParas + compositeParas;
                    }


                    for (var j = 0; j < xheaderArray.length; j++) {
                        var tbody_tr_td = document.createElement('td');
                        if (tableNum == "2") {

                        } else if (tableNum == "6") {

                        } else {
                            if (
                                (j != 0) &&
                                (j != 1) &&
                                (j != xweightArray.length - 1)
                            ) {
                                totCs += parseInt(javascript_array['linebyline_data'][i][xbodyArray[j]], 10) * xweightArray[j];
                            }
                        }

                        switch (j) {
                            case 0:
                                if (tableNum == "6") {

                                } else {
                                    tbody_tr_td.classList.add("customTable1Counter");
                                    tbody_tr_td.innerHTML = parseInt(javascript_array['linebyline_data'][i][xbodyArray[j]], 10) + 1;
                                }
                                break;
                            case 1:
                                if (tableNum == "6") {

                                } else {
                                    tbody_tr_td.classList.add("javaHigh");
                                    tbody_tr_td.classList.add("customTable1Code");
                                    tbody_tr_td.innerHTML = javascript_array['linebyline_data'][i][xbodyArray[j]];
                                }
                                break;
                            case (xbodyArray.length - 1):
                                tbody_tr_td.classList.add("customTable1Total");
                                if (tableNum == "2") {
                                    tbody_tr_td.innerHTML = table_2_tot;
                                    final_tot += table_2_tot;
                                } else if (tableNum == "3") {
                                    tbody_tr_td.innerHTML = table_3_tot;
                                    final_tot += table_3_tot;
                                } else {
                                    tbody_tr_td.innerHTML = totCs;
                                    final_tot += totCs;
                                }
                                break;
                            default:
                                tbody_tr_td.classList.add("customTable1DataCount");
                                if (tableNum == "2") {
                                    if (j == 2) {
                                        // ["Ngv 0", "Nlv 1", "Npdtv 2", "Ncdtv 3"]
                                        if (parseInt(javascript_array['linebyline_data'][i]['Npdtv'], 10) > 0) {
                                            tbody_tr_td.innerHTML = "( " + javascript_array['linebyline_data'][i]['Npdtv'] + " ) * " + xweightArray[2] + " * ";
                                            tbody_tr_td.innerHTML += parseInt(javascript_array['linebyline_data'][i]['Ngv'], 10) > 0 ? xweightArray[0] : xweightArray[1];
                                        } else {
                                            tbody_tr_td.innerHTML = "";
                                        }
                                    } else if (j == 3) {
                                        // ["Ngv 0", "Nlv 1", "Npdtv 2", "Ncdtv 3"]
                                        if (parseInt(javascript_array['linebyline_data'][i]['Ncdtv'], 10) > 0) {
                                            tbody_tr_td.innerHTML = "( " + javascript_array['linebyline_data'][i]['Ncdtv'] + " ) * " + xweightArray[3] + " * ";
                                            tbody_tr_td.innerHTML += parseInt(javascript_array['linebyline_data'][i]['Ngv'], 10) > 0 ? xweightArray[0] : xweightArray[1];
                                        } else {
                                            tbody_tr_td.innerHTML = "";
                                        }
                                    }
                                } else if (tableNum == "3") {
                                    if (j == 2) {
                                        if (
                                            parseInt(javascript_array['linebyline_data'][i]['NOfVoidReturns'], 10) > 0 ||
                                            parseInt(javascript_array['linebyline_data'][i]['NOfPrimitiveReturns'], 10) > 0 ||
                                            parseInt(javascript_array['linebyline_data'][i]['NOfCompositeReturns'], 10) > 0
                                        ) {
                                            tbody_tr_td.innerHTML = "( " + parseInt(javascript_array['linebyline_data'][i]['NOfVoidReturns'], 10) + " ) * " + xweightArray[0];
                                            tbody_tr_td.innerHTML += " + ( " + parseInt(javascript_array['linebyline_data'][i]['NOfPrimitiveReturns'], 10) + " ) * " + xweightArray[1];
                                            tbody_tr_td.innerHTML += " + ( " + parseInt(javascript_array['linebyline_data'][i]['NOfCompositeReturns'], 10) + " ) * " + xweightArray[2];
                                        } else {
                                            tbody_tr_td.innerHTML = "";
                                        }
                                    } else if (j == 3) {
                                        if (parseInt(javascript_array['linebyline_data'][i]['Npdtp'], 10) > 0) {
                                            tbody_tr_td.innerHTML = "( " + javascript_array['linebyline_data'][i]['Npdtp'] + " ) * " + xweightArray[3];
                                        } else {
                                            tbody_tr_td.innerHTML = "";
                                        }
                                    } else if (j == 4) {
                                        if (parseInt(javascript_array['linebyline_data'][i]['Ncdtp'], 10) > 0) {
                                            tbody_tr_td.innerHTML = "( " + javascript_array['linebyline_data'][i]['Ncdtp'] + " ) * " + xweightArray[4];
                                        } else {
                                            tbody_tr_td.innerHTML = "";
                                        }
                                    }


                                } else {
                                    if (parseInt(javascript_array['linebyline_data'][i][xbodyArray[j]], 10) > 0) {
                                        tbody_tr_td.innerHTML = "( " + javascript_array['linebyline_data'][i][xbodyArray[j]] + " ) * " + xweightArray[j];
                                    } else {
                                        tbody_tr_td.innerHTML = "";
                                    }
                                }
                                break;
                        }

                        switch (xbodyArray[j]) {
                            case "Nkw":
                                tbody_tr_td.classList.add("customTable1_Nkw");
                                break;
                            case "Nid":
                                tbody_tr_td.classList.add("customTable1_Nid");
                                break;
                            case "Nop":
                                tbody_tr_td.classList.add("customTable1_Nop");
                                break;
                            case "Nnv":
                                tbody_tr_td.classList.add("customTable1_Nnv");
                                break;
                            case "Nsl":
                                tbody_tr_td.classList.add("customTable1_Nsl");
                                break;
                            default:
                                break;
                        }

                        if (i + 1 == javascript_array['linebyline_data'].length) {
                            tbody_tr_td.classList.add("finalRowBorder");
                        }
                        tbody_tr.appendChild(tbody_tr_td);
                    }
                    tbody.appendChild(tbody_tr);
                    if (i + 1 == javascript_array['linebyline_data'].length) {
                        if (true) {
                            var tbody_tr = document.createElement('tr');
                            for (let m = 0; m < xheaderArray.length; m++) {
                                var tbody_tr_td = document.createElement('td');
                                if (m + 1 == xheaderArray.length) {
                                    tbody_tr_td.innerHTML = final_tot;
                                    tbody_tr_td.classList.add("bonus_table");
                                } else {
                                    tbody_tr_td.innerHTML = "";
                                    tbody_tr_td.classList.add("bonus_table");
                                }
                                tbody_tr.appendChild(tbody_tr_td);
                            }
                            tbody.appendChild(tbody_tr);
                        }
                    }
                }
            }

            xtable.appendChild(tbody);
            final_tot = 0;
        }



        function createAllTables(item) {
            if (javascript_fullData.length > 0) {
                javascript_array = javascript_fullData[item];
                sessionStorage.setItem("fileNo", item);
                table_1.innerHTML = "";
                table_2.innerHTML = "";
                table_3.innerHTML = "";
                table_4.innerHTML = "";
                table_5.innerHTML = "";
                table_6.innerHTML = "";
                table_7.innerHTML = "";
                tableCreate(table_1, table_1_headerArray, table_1_bodyArray, table_1_weight, "1");
                tableCreate(table_2, table_2_headerArray, table_2_bodyArray, table_2_weight, "2");
                tableCreate(table_3, table_3_headerArray, table_3_bodyArray, table_3_weight, "3");
                tableCreate(table_4, table_4_headerArray, table_4_bodyArray, table_4_weight, "4");
                tableCreate(table_5, table_5_headerArray, table_5_bodyArray, table_5_weight, "5");
                tableCreate(table_6, table_6_headerArray, table_6_bodyArray, table_6_weight, "6");
                tableCreate(table_7, table_7_headerArray, table_7_bodyArray, table_7_weight, "7");
                codeColor();
                setWeightItems();
            }
        }

        function setWeightItems() {
            document.getElementById('1_keyword_value').value = table_1_weight[2];
            document.getElementById('1_identifier_value').value = table_1_weight[3];
            document.getElementById('1_operator_value').value = table_1_weight[4];
            document.getElementById('1_numerical_value').value = table_1_weight[5];
            document.getElementById('1_string_value').value = table_1_weight[6];

            document.getElementById('2_global_variables').value = table_2_weight[0];
            document.getElementById('2_local_variables').value = table_2_weight[1];
            document.getElementById('2_primitive_variables').value = table_2_weight[2];
            document.getElementById('2_composite_variables').value = table_2_weight[3];

            // ["NOfVoidReturns" 0, "NOfPrimitiveReturns" 1, "NOfCompositeReturns" 2, "Npdtp" 3, "Ncdtp" 4]
            document.getElementById('3_void_return').value = table_3_weight[0];
            document.getElementById('3_primitive_return').value = table_3_weight[1];
            document.getElementById('3_composite_return').value = table_3_weight[2];
            document.getElementById('3_primitive_parameter').value = table_3_weight[3];
            document.getElementById('3_composite_parameter').value = table_3_weight[4];

            document.getElementById('6_no_inheritance').value = table_6_weight[0];
            document.getElementById('6_one_inheritance').value = table_6_weight[1];
            document.getElementById('6_two_inheritance').value = table_6_weight[2];
            document.getElementById('6_three_inheritance').value = table_6_weight[3];
            document.getElementById('6_four_inheritance').value = table_6_weight[4];

        }

        function inputChanged(item) {
            switch (item) {
                case "complexityOfSizes":
                    table_1_weight[2] = parseInt(document.getElementById('1_keyword_value').value, 10);
                    table_1_weight[3] = parseInt(document.getElementById('1_identifier_value').value, 10);
                    table_1_weight[4] = parseInt(document.getElementById('1_operator_value').value, 10);
                    table_1_weight[5] = parseInt(document.getElementById('1_numerical_value').value, 10);
                    table_1_weight[6] = parseInt(document.getElementById('1_string_value').value, 10);
                    break;
                case "complexityOfVariables":
                    table_2_weight[0] = parseInt(document.getElementById('2_global_variables').value, 10);
                    table_2_weight[1] = parseInt(document.getElementById('2_local_variables').value, 10);
                    table_2_weight[2] = parseInt(document.getElementById('2_primitive_variables').value, 10);
                    table_2_weight[3] = parseInt(document.getElementById('2_composite_variables').value, 10);
                    break;
                case "complexityOfMethods":
                    table_3_weight[0] = parseInt(document.getElementById('3_void_return').value, 10);
                    table_3_weight[1] = parseInt(document.getElementById('3_primitive_return').value, 10);
                    table_3_weight[2] = parseInt(document.getElementById('3_composite_return').value, 10);
                    table_3_weight[3] = parseInt(document.getElementById('3_primitive_parameter').value, 10);
                    table_3_weight[4] = parseInt(document.getElementById('3_composite_parameter').value, 10);
                    break;
                case "complexityOfInheritance":
                    table_6_weight[0] = parseInt(document.getElementById('6_no_inheritance').value, 10);
                    table_6_weight[1] = parseInt(document.getElementById('6_one_inheritance').value, 10);
                    table_6_weight[2] = parseInt(document.getElementById('6_two_inheritance').value, 10);
                    table_6_weight[3] = parseInt(document.getElementById('6_three_inheritance').value, 10);
                    table_6_weight[4] = parseInt(document.getElementById('6_four_inheritance').value, 10);
                    break;
                default:
                    break;

            }
            createAllTables(document.getElementById("fileSelectedOption").value);
            hideModal();
            sessionStorage.setItem("table_1_weight", JSON.stringify(table_1_weight));
            sessionStorage.setItem("table_2_weight", JSON.stringify(table_2_weight));
            sessionStorage.setItem("table_3_weight", JSON.stringify(table_3_weight));
            sessionStorage.setItem("table_6_weight", JSON.stringify(table_6_weight));
        };
        sessionStorage.setItem("fileNo", 0);
        createAllTables(0);
        addSelection(0);
        // console.log(javascript_fullData);
    </script>

    <script src="<?php echo URLROOT ?>/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo URLROOT ?>/js/script.js" type="text/javascript"></script>

</body>

</html>