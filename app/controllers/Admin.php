<?php
class Admin extends BaseController
{
    public function __construct()
    {

    }

    // ADMIN PAGE -----------------------------------------------
    public function index()
    {

        $data = [];
        $this->view('admin/index', $data);
    }

    public function upload()
    {
        $data = [];
        if (isset($_FILES["fileToUpload"]["name"])) {
            $target_file = basename($_FILES["fileToUpload"]["name"]);
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if( $fileType == 'java'){
                $file = $_FILES["fileToUpload"]["tmp_name"];

                // Following variable will be used for full words search
                $convertedTostring = file_get_contents($file);

                // Remove Comments
                // $convertedTostring = preg_replace('!/\*.*?\*/!s', '', $convertedTostring);
                // $convertedTostring = preg_replace('/\n\s*\n/', "\n", $convertedTostring);

                //  Removes multi-line comments and does not create a blank line, also treats white spaces/tabs 
                $convertedTostring = preg_replace('!^[ \t]*/\*.*?\*/[ \t]*[\r\n]!s', '', $convertedTostring);

                //  Removes single line '//' comments, treats newline
                $convertedTostring = preg_replace('![ \t]*//.*[ \t]*[\r\n]!', "\n", $convertedTostring);

                //  Strip blank lines
                $convertedTostring = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $convertedTostring);

                // Followings are not used for search
                $stringWithSpaces = str_replace(' ', '&nbsp;',$convertedTostring);
                $stringWithSpacesAndTabs = str_replace("\t", '&nbsp;&nbsp;',$stringWithSpaces);

                // Following will be used for display purposes
                $fixedStringArr = explode("\n", $stringWithSpacesAndTabs);
                // foreach($fixedStringArr as $val){
                //     echo $val . "<br/>";
                // }


                //Following is using for line by line search
                $sanitiedArray = explode("\n", $convertedTostring);

                

                // Creating the Final 3D Data Array
                $dataArr = array();
                $keyworArr = ["class", "public", "void", "true", "else", "default", "return", "null", "break", "this"];
                $wkw = 1;
                $nkw = 0;
                for ($i=0; $i < count($sanitiedArray); $i++) { 
                    foreach($keyworArr as $keyword){
                        $temp = substr_count($sanitiedArray[$i], $keyword);
                        $nkw += $temp > 0 ? $temp : 0;
                    }
                    $dataArr[$i] = array(
                        "lineNo" => $i,
                        "code" => $fixedStringArr[$i],
                        "nkw" => $nkw,
                        "wkw" => $wkw,
                        "cskw" => $wkw * $nkw
                    );
                    $nkw = 0;
                }

                foreach($dataArr as $nano){
                    // echo $nano['lineNo'];
                    echo "&nbsp;&nbsp;";
                    echo "<span style='color: red'>";
                    echo $nano["nkw"];
                    echo "</span>";
                    echo "&nbsp;&nbsp;";
                    echo $nano["wkw"];
                    echo "&nbsp;&nbsp;";
                    echo $nano["cskw"];
                    echo "&nbsp;&nbsp;";
                    echo $nano["code"];
                    echo "<br/>";
                }
                // for ($i=0; $i count($dataArr) < ; $i++) { 
                //     for ($x=0; $x < count($dataArr[$i]); $x++) { 
                //         echo $$dataArr[$i];
                //         // echo $nano["code"];
                //         // echo $nano["wkw"];
                //         // echo $nano["nkw"];
                //         // echo $nano["cskw"];
                //         // echo "\t";
                //     }
                // }
            }



        }else{
            $this->view('admin/index', $data);
        }
    }
    // ONLINE STATUS CHANGER ------------------------------------------------------------------------
    public function status_change()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->adminModel->update_a_user_onlineStatus($_SESSION['user_id'], $_POST['onlineStatus'])) {
                $this->index();
            } else {
                $this->index();
            }
        }
    }

}
