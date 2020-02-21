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

    <form action="<?php echo URLROOT; ?>/admin" method="post" enctype="multipart/form-data" class="fileSubmitForm" >
        <input type="file" name="fileToUpload" id="fileToUpload" class="fileSubmitForm_item">
        <input type="submit" value="Upload Code" name="submit" class="fileSubmitForm_item fileSubmitForm_item-btn">
    </form>
    <div class="selectionITemCover">
        <div class="selectionITem selectionITemSize">size</div><br/>
        <div class="selectionITem">variables</div><br/>
        <div class="selectionITem">methods</div><br/>
        <div class="selectionITem">coupling</div><br/>
        <div class="selectionITem">control structures</div><br/>
        <div class="selectionITem">all the factors</div><br/>
    </div>


    <div class="customTableCover">
        <table id="customTable">
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
                <?php foreach ($data['cs_values'] as $item) : ?>
                    <tr>
                        <?php
                            echo "<td>" . ($item['lineNo'] + 1) . "</td>";
                            echo "<td class='javaHigh'>" . $item['code'] . "</td>";
                            echo $item['nkw'] > 0 ? "<td  class='customTable1DataCount' style='color:#005cc5;'>". $item['nkw'] ."</td>" : "<td></td>";
                            echo $item['nid'] > 0 ? "<td  class='customTable1DataCount' style='color:#000;'>". $item['nid'] ."</td>" : "<td></td>";
                            echo $item['nop'] > 0 ? "<td  class='customTable1DataCount' style='color:#000;'>". $item['nop'] ."</td>" : "<td></td>";
                            echo $item['nnv'] > 0 ? "<td  class='customTable1DataCount' style='color:#D00F2C;'>". $item['nnv'] ."</td>" : "<td></td>";
                            echo $item['nsl'] > 0 ? "<td  class='customTable1DataCount' style='color:#088C00;'>". $item['nsl'] ."</td>" : "<td></td>";
                            echo "<td>". $item['cs'] . "</td>";

                        ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="<?php echo URLROOT ?>/js/jquery.js" type="text/javascript" ></script>
    <script src="<?php echo URLROOT ?>/js/script.js" type="text/javascript" ></script>
    <script src="<?php echo URLROOT ?>/js/color.js" type="text/javascript" ></script>
</body>

</html>