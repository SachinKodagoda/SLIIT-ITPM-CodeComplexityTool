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

    <form action="<?php echo URLROOT; ?>/admin/upload" method="post" enctype="multipart/form-data" class="fileSubmitForm" >
        <input type="file" name="fileToUpload" id="fileToUpload" class="fileSubmitForm_item">
        <input type="submit" value="Upload Code" name="submit" class="fileSubmitForm_item fileSubmitForm_item-btn">
        <select name="selectedLang" id="languages">
            <option value="java">JAVA</option>
            <option value="cpp">C++</option>
        </select>
    </form>
    <div class="selectionITemCover">
        <div class="selectionITem selectionITemSize">size</div><br/>
        <div class="selectionITem">variables</div><br/>
        <div class="selectionITem">methods</div><br/>
        <div class="selectionITem">coupling</div><br/>
        <div class="selectionITem">control structures</div><br/>
        <div class="selectionITem">all the factors</div><br/>
    </div>

    <table id="customTable">
        <tbody>
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
            <tr>
                <td>1</td>
                <td>class Pattern {</td>
                <td>1</td>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td>2</td>
            </tr>

            <tr>
                <td>2</td>
                <td>&nbsp;public static void main(String[] args) {</td>
                <td>3</td>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td>4</td>
            </tr>

            <tr>
                <td>3</td>
                <td>&nbsp;&nbsp;int rows = 5;</td>
                <td></td>
                <td></td>
                <td>1</td>
                <td>1</td>
                <td></td>
                <td>2</td>
            </tr>

            <tr>
                <td>4</td>
                <td>&nbsp;&nbsp;for(int i = 1; i <= rows; ++i) {</td>
                <td></td>
                <td>4</td>
                <td>3</td>
                <td>1</td>
                <td></td>
                <td>8</td>
            </tr>

            <tr>
                <td>5</td>
                <td>&nbsp;&nbsp;&nbsp;for(int j = 1; j <= i; ++j) {</td>
                <td></td>
                <td>4</td>
                <td>3</td>
                <td>1</td>
                <td></td>
                <td>8</td>
            </tr>

            <tr>
                <td>6</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;System.out.print(j + " ");</td>
                <td></td>
                <td>4</td>
                <td>3</td>
                <td></td>
                <td>1</td>
                <td>8</td>
            </tr>

            <tr>
                <td>7</td>
                <td>&nbsp;&nbsp;&nbsp;}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>0</td>
            </tr>


            <tr>
                <td>8</td>
                <td>&nbsp;&nbsp;&nbsp;System.out.println("");</td>
                <td></td>
                <td>3</td>
                <td>2</td>
                <td></td>
                <td>1</td>
                <td>6</td>
            </tr>

            <tr>
                <td>9</td>
                <td>&nbsp;&nbsp;}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>0</td>
            </tr>

            <tr>
                <td>10</td>
                <td>&nbsp;}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>0</td>
            </tr>

            <tr>
                <td>11</td>
                <td>}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>0</td>
            </tr>
        </tbody>
    </table>
    <script src="<?php echo URLROOT ?>/js/script.js" type="text/javascript" ></script>
</body>

</html>