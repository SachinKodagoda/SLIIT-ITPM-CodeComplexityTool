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
        <div class="selectionItem" onclick="openTab(event, 'table_1')" id="size_selected">size</div><br/>
        <div class="selectionItem" onclick="openTab(event, 'table_2')" id="variable_selected">variables</div><br/>
        <div class="selectionItem" onclick="openTab(event, 'table_3')" id="methods_selected">methods</div><br/>
        <div class="selectionItem" onclick="openTab(event, 'table_4')" id="coupling_selected">coupling</div><br/>
        <div class="selectionItem" onclick="openTab(event, 'table_5')" id="controlStructure_selected">control structures</div><br/>
        <div class="selectionItem" onclick="openTab(event, 'table_6')" id="Inheritance_selected">Inheritance</div><br/>
        <div class="selectionItem" onclick="openTab(event, 'table_7')" id="allFactor_selected">all factors</div><br/>
    </div>


    <div class="customTableCover">

        <!-- Size Table -->
        <div class="customTableInnerCover" id="table_1">
            <table class="customTable">
                <thead>
                    <tr>
                        <th>Line no</th>
                        <th>Program Statements</th>
                        <th>Nkw</th>
                        <th>Nid</th>
                        <th>Nop</th>
                        <th>Nnv</th>
                        <th>Nsl</th>
                        <th>Cs</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['complexity_values'] as $item) : ?>
                        <tr>
                            <?php
                                echo "<td>" . ($item['lineNo']+1) . "</td>";
                                echo "<td class='javaHigh'>" . $item['code'] . "</td>";
                                echo $item['nkw'] > 0 ? "<td  class='customTable1DataCount' style='color:#005cc5;'>". $item['nkw'] ."</td>" : "<td></td>";
                                echo $item['nid'] > 0 ? "<td  class='customTable1DataCount' style='color:#000;'>". $item['nid'] ."</td>" : "<td></td>";
                                echo $item['nop'] > 0 ? "<td  class='customTable1DataCount' style='color:#BF4EFF;'>". $item['nop'] ."</td>" : "<td></td>";
                                echo $item['nnv'] > 0 ? "<td  class='customTable1DataCount' style='color:#D00F2C;'>". $item['nnv'] ."</td>" : "<td></td>";
                                echo $item['nsl'] > 0 ? "<td  class='customTable1DataCount' style='color:#088C00;'>". $item['nsl'] ."</td>" : "<td></td>";
                                echo "<td>". $item['cs'] . "</td>";

                            ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Variable Table -->
        <div class="customTableInnerCover" id="table_2">
            <table class="customTable">
                <thead>
                    <tr>
                        <th>Line no</th>
                        <th>Program Statements</th>
                        <th>Wvs</th>
                        <th>Npdtv</th>
                        <th>Ncdtv</th>
                        <th>Cv</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['complexity_values'] as $item) : ?>
                        <tr>
                            <?php
                                echo "<td>" . ($item['lineNo'] + 1) . "</td>";
                                echo "<td class='javaHigh'>" . $item['code'] . "</td>";
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

        <!-- Method Table -->
        <div class="customTableInnerCover" id="table_3">
            <table class="customTable">
                <thead>
                    <tr>
                        <th>Line no</th>
                        <th>Program Statements</th>
                        <th>Wmrt</th>
                        <th>Npdtp</th>
                        <th>Ncdtp</th>
                        <th>Cm</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['complexity_values'] as $item) : ?>
                        <tr>
                            <?php
                                echo "<td>" . ($item['lineNo'] + 1) . "</td>";
                                echo "<td class='javaHigh'>" . $item['code'] . "</td>";
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


        <!-- Coupling Table -->
        <div class="customTableInnerCover" id="table_4">
            <table class="customTable">
                <thead>
                    <tr>
                        <th>Line no</th>
                        <th>Program Statements</th>
                        <th><span class="rotatedWord">Nr</span></th>
                        <th><span class="rotatedWord">Nmcms</span></th>
                        <th><span class="rotatedWord">Nmcmd</span></th>
                        <th><span class="rotatedWord">Nmcrms</span></th>
                        <th><span class="rotatedWord">Nmcrmd</span></th>
                        <th><span class="rotatedWord">Nrmcrms</span></th>
                        <th><span class="rotatedWord">Nrmcrmd</span></th>
                        <th><span class="rotatedWord">Nrmcms</span></th>
                        <th><span class="rotatedWord">Nrmcmd</span></th>
                        <th><span class="rotatedWord">Nmrgvs</span></th>
                        <th><span class="rotatedWord">Nmrgvd</span></th>
                        <th><span class="rotatedWord">Nrmrgvs</span></th>
                        <th><span class="rotatedWord">Nrmrgvd</span></th>
                        <th><span class="rotatedWord">Ccp</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['complexity_values'] as $item) : ?>
                        <tr>
                            <?php
                                echo "<td>" . ($item['lineNo'] + 1) . "</td>";
                                echo "<td class='javaHigh'>" . $item['code'] . "</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
                                echo "<td>0</td>";
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
                </tbody>
            </table>
        </div>

        <!-- Control Structure Table -->
        <div class="customTableInnerCover" id="table_5">
            <table class="customTable">
                <thead>
                    <tr>
                        <th>Line no</th>
                        <th>Program Statements</th>
                        <th>Wtcs</th>
                        <th>NC</th>
                        <th>Ccspps</th>
                        <th>Ccs</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['complexity_values'] as $item) : ?>
                        <tr>
                            <?php
                                echo "<td>" . ($item['lineNo'] + 1) . "</td>";
                                echo "<td class='javaHigh'>" . $item['code'] . "</td>";
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

        <!-- Inheritance Table -->
        <div class="customTableInnerCover" id="table_6">
            <table class="customTable">
                <thead>
                    <tr>
                        <th>Line no</th>
                        <th>Program Statements</th>
                        <th>No of direct <br/> inheritances</th>
                        <th>No of indirect <br/> inheritances</th>
                        <th>Total <br/> inheritances</th>
                        <th>Ci</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['complexity_values'] as $item) : ?>
                        <tr>
                            <?php
                                echo "<td>" . ($item['lineNo'] + 1) . "</td>";
                                echo "<td class='javaHigh'>" . $item['code'] . "</td>";
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
            <table class="customTable">
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
                                echo "<td>" . ($item['lineNo'] + 1) . "</td>";
                                echo "<td class='javaHigh'>" . $item['code'] . "</td>";
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
            <div class="uploadModalBack" onclick="hideModal()" id="uploadModalBack"></div>
            <div class="uploadModal" id="uploadModal_upload" >
                <form action="<?php echo URLROOT; ?>/admin" method="post" enctype="multipart/form-data" class="fileSubmitForm" >
                    <input type="file" name="fileToUpload" id="fileToUpload" class="fileSubmitForm_item">
                    <input type="submit" value="Upload Code" name="submit" class="fileSubmitForm_item fileSubmitForm_item-btn">
                </form>
            </div>
            <div class="uploadModal" id="uploadModal_size" >
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
                            <td>Numerical value</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>String literal</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
                <div class="modalTableSave">Save</div>
            </div>
            <div class="uploadModal" id="uploadModal_variable" >
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
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>Local Variable</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Primitive data type variable</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Composite data type variable</td>
                            <td>2</td>
                        </tr>
                    </tbody>
                </table>
                <div class="modalTableSave">Save</div>
            </div>  
            <div class="uploadModal" id="uploadModal_methods" >
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
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Method with a composite return type</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>Method with a void return type</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Primitive data type parameter</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Composite data type parameter</td>
                            <td>2</td>
                        </tr>
                    </tbody>
                </table>
                <div class="modalTableSave">Save</div>
            </div>
            <div class="uploadModal" id="uploadModal_coupling" >
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
            <div class="uploadModal" id="uploadModal_controlStructures" >
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
            <div class="uploadModal" id="uploadModal_inheritance" >
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
            <div class="uploadModal" id="uploadModal_allfactor" >
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

    <script src="<?php echo URLROOT ?>/js/jquery.js" type="text/javascript" ></script>
    <script src="<?php echo URLROOT ?>/js/script.js" type="text/javascript" ></script>
    <script src="<?php echo URLROOT ?>/js/color.js" type="text/javascript" ></script>
</body>

</html>