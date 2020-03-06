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
            <select id="fileSelectedOption">
                <option value="test1">test1.java</option>
                <option value="test2">test2.java</option>
                <option value="test2">test3.java</option>
            </select>
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
                    <thead>
                        <tr>
                            <th>Line no</th>
                            <th>Program Statements</th>
                            <th>No of direct <br /> inheritances</th>
                            <th>No of indirect <br /> inheritances</th>
                            <th>Total <br /> inheritances</th>
                            <th>Ci</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['complexity_values'] as $item) : ?>
                            <tr>
                                <?php
                                echo "<td>" . ($item['LineNo'] + 1) . "</td>";
                                echo "<td class='javaHigh'>" . $item['Code'] . "</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- All Factor Table -->
            <div class="customTableInnerCover" id="table_7">
                <table class="customTable" id="table_7_inner">
                    <thead>
                        <tr>
                            <th>Line no</th>
                            <th>Program Statements</th>
                            <th>Cs</th>
                            <th>Cv</th>
                            <th>Cm</th>
                            <th>Ci</th>
                            <th>Ccp</th>
                            <th>Ccs</th>
                            <th>TCps</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['complexity_values'] as $item) : ?>
                            <tr>
                                <?php
                                echo "<td>" . ($item['LineNo'] + 1) . "</td>";
                                echo "<td class='javaHigh'>" . $item['Code'] . "</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                ?>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <?php
                            echo "<td colspan='2' style='text-align:center; font-weight: 900'> Total</td>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="selector" onclick="showModal('uploadModal_upload')">
                <img src="<?php echo URLROOT ?>/img/upload.svg" alt="">
            </div>

            <div class="commonModal" id="commonModal">
                <div class="uploadModalBack" onclick="" id="uploadModalBack"></div>
                <div class="uploadModal" id="uploadModal_upload">
                    <form action="<?php echo URLROOT; ?>/admin" method="post" enctype="multipart/form-data" class="fileSubmitForm">
                        <input type="file" name="fileToUpload" id="fileToUpload" class="fileSubmitForm_item">
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
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>A class inheritance (directly or indirectly) from one user-defined class</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>A class inheritance (directly or indirectly) from two user-defined class</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>A class inheritance (directly or indirectly) from three user-defined class</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>A class inheritance (directly or indirectly) from more than three user-defined class</td>
                                <td>4</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modalTableSave">Save</div>
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
        <?php
        $php_array = $data['complexity_values'];
        $js_array = json_encode($php_array);
        echo "javascript_array = " . $js_array . ";\n";
        ?>

        var table_1 = document.getElementById('table_1_inner');
        var table_1_headerArray = [
            "Line no ",
            "Program Statements",
            "<div class='tooltip'>Nkw <span class='tooltiptext'>Number of Keywords</span></div>",
            "<div class='tooltip'>Nid <span class='tooltiptext'>Number of Identifiers</span></div>",
            "<div class='tooltip'>Nop <span class='tooltiptext'>Number of Operators</span></div>",
            "<div class='tooltip'>Nnv <span class='tooltiptext'>Number of Numerical Values</span></div>",
            "<div class='tooltip'>Nsl <span class='tooltiptext'>Number of String Literals</span></div>",
            "<div class='tooltip'>Cs  <span class='tooltiptext'>Complexity of Size</span></div>"
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
            "<div class='tooltip'>Ngv<span class='tooltiptext'>Number of Global Variables</span></div>",
            "<div class='tooltip'>Nlv<span class='tooltiptext'>Number of Local Variables</span></div>",
            "<div class='tooltip'>Npdtv<span class='tooltiptext'>Number of Primitive Data type Variables</span></div>",
            "<div class='tooltip'>Ncdtv<span class='tooltiptext'>Number of Composite Data type Variables</span></div>",
            "<div class='tooltip'>Cv<span class='tooltiptext'>Complexity of Variables</span></div>"
        ];

        var table_2_bodyArray = ["LineNo", "Code", "Ngv", "Nlv", "Npdtv", "Ncdtv", "Cv"];
        var table_2_weight = ["", "", 1, 1, 1, 1, ""];

        if (sessionStorage.getItem("table_2_weight")) {
            // table_2_weight = JSON.parse(sessionStorage.getItem("table_2_weight"));
        }

        var table_3 = document.getElementById('table_3_inner');
        var table_3_headerArray = ["Line no", "Program Statements", "Wmrt", "Npdtp", "Ncdtp", "Cm"];
        var table_3_bodyArray = ["LineNo", "Code", "Wmrt", "Npdtp", "Ncdtp", "Cm"];
        var table_3_weight = ["", "", 1, 1, 1, ""];

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
        var table_6_headerArray = ["Line no", "Program Statements", "No of direct inheritances", "No of indirect inheritances", "Total inheritances", "Ci"];
        var table_6_bodyArray = ["LineNo", "Code", "", "", "", ""];
        var table_6_weight = ["", "", 1, 1, 1, 1, 1, ""];


        if (sessionStorage.getItem("table_6_weight")) {
            table_6_weight = JSON.parse(sessionStorage.getItem("table_6_weight"));
        }

        var table_7 = document.getElementById('table_7_inner');
        var table_7_headerArray = ["Line no", "Program Statements", "Cs", "Cv", "Cm", "Ci", "Ccp", "Ccs", "TCps"];
        var table_7_bodyArray = ["LineNo", "Code", "", "", "", "", "", "", ""];
        var table_7_weight = ["", "", 1, 1, 1, 1, 1, ""];





        function tableCreate(xtable, xheaderArray, xbodyArray, xweightArray) {

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

            for (var i = 0; i < javascript_array.length; i++) {
                var tbody_tr = document.createElement('tr');
                var totCs = 0;
                for (var j = 0; j < xheaderArray.length; j++) {
                    var tbody_tr_td = document.createElement('td');
                    if (
                        (j != 0) &&
                        (j != 1) &&
                        (j != xweightArray.length - 1)
                    ) {
                        totCs += parseInt(javascript_array[i][xbodyArray[j]], 10) * xweightArray[j];
                    }

                    switch (j) {
                        case 0:
                            tbody_tr_td.classList.add("customTable1Counter");
                            tbody_tr_td.innerHTML = parseInt(javascript_array[i][xbodyArray[j]], 10) + 1;
                            break;
                        case 1:
                            tbody_tr_td.classList.add("javaHigh");
                            tbody_tr_td.classList.add("customTable1Code");
                            tbody_tr_td.innerHTML = javascript_array[i][xbodyArray[j]];
                            break;
                        case (xweightArray.length - 1):
                            tbody_tr_td.classList.add("customTable1Total");
                            tbody_tr_td.innerHTML = totCs;
                            break;
                        default:
                            tbody_tr_td.classList.add("customTable1DataCount");
                            if (parseInt(javascript_array[i][xbodyArray[j]], 10) > 0) {
                                tbody_tr_td.innerHTML = javascript_array[i][xbodyArray[j]];
                            } else {
                                tbody_tr_td.innerHTML = "";
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

                    if (i + 1 == javascript_array.length) {
                        tbody_tr_td.classList.add("finalRowBorder");
                    }
                    tbody_tr.appendChild(tbody_tr_td);
                }
                tbody.appendChild(tbody_tr);
            }
            xtable.appendChild(tbody);
        }

        function createAllTables() {
            table_1.innerHTML = "";
            table_2.innerHTML = "";
            table_3.innerHTML = "";
            table_4.innerHTML = "";
            table_5.innerHTML = "";
            table_6.innerHTML = "";
            table_7.innerHTML = "";
            tableCreate(table_1, table_1_headerArray, table_1_bodyArray, table_1_weight);
            tableCreate(table_2, table_2_headerArray, table_2_bodyArray, table_2_weight);
            tableCreate(table_3, table_3_headerArray, table_3_bodyArray, table_3_weight);
            tableCreate(table_4, table_4_headerArray, table_4_bodyArray, table_4_weight);
            tableCreate(table_5, table_5_headerArray, table_5_bodyArray, table_5_weight);
            codeColor();
        }

        function setWeightItems() {
            document.getElementById('1_keyword_value').value = table_1_weight[2];
            document.getElementById('1_identifier_value').value = table_1_weight[3];
            document.getElementById('1_operator_value').value = table_1_weight[4];
            document.getElementById('1_numerical_value').value = table_1_weight[5];
            document.getElementById('1_string_value').value = table_1_weight[6];

            document.getElementById('2_global_variables').value = table_2_weight[2];
            document.getElementById('2_local_variables').value = table_2_weight[3];
            document.getElementById('2_primitive_variables').value = table_2_weight[4];
            document.getElementById('2_composite_variables').value = table_2_weight[5];

            document.getElementById('3_primitive_return').value = table_3_weight[2];
            document.getElementById('3_composite_return').value = table_3_weight[3];
            document.getElementById('3_void_return').value = table_3_weight[4];
            document.getElementById('3_primitive_parameter').value = table_3_weight[5];
            document.getElementById('3_composite_parameter').value = table_3_weight[6];
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
                    table_2_weight[2] = parseInt(document.getElementById('2_global_variables').value, 10);
                    table_2_weight[3] = parseInt(document.getElementById('2_local_variables').value, 10);
                    table_2_weight[4] = parseInt(document.getElementById('2_primitive_variables').value, 10);
                    table_2_weight[5] = parseInt(document.getElementById('2_composite_variables').value, 10);
                    break;
                case "complexityOfMethods":
                    table_3_weight[2] = parseInt(document.getElementById('3_primitive_return').value, 10);
                    table_3_weight[3] = parseInt(document.getElementById('3_composite_return').value, 10);
                    table_3_weight[4] = parseInt(document.getElementById('3_void_return').value, 10);
                    table_3_weight[5] = parseInt(document.getElementById('3_primitive_parameter').value, 10);
                    table_3_weight[6] = parseInt(document.getElementById('3_composite_parameter').value, 10);
                    break;
                default:
                    break;

            }
            createAllTables();
            hideModal();
            sessionStorage.setItem("table_1_weight", JSON.stringify(table_1_weight));
            sessionStorage.setItem("table_2_weight", JSON.stringify(table_2_weight));
            sessionStorage.setItem("table_3_weight", JSON.stringify(table_3_weight));
        };

        createAllTables();
        setWeightItems();
    </script>

    <script src="<?php echo URLROOT ?>/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo URLROOT ?>/js/script.js" type="text/javascript"></script>

</body>

</html>