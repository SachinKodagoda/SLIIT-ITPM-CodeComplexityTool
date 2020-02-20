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

                // Followings are not used for search
                $stringWithSpaces = str_replace(' ', '&nbsp;',$convertedTostring);
                $stringWithSpacesAndTabs = str_replace("\t", '&nbsp;&nbsp;',$stringWithSpaces);

                // Following will be used for display purposes
                $fixedStringArr = explode("\n", $stringWithSpacesAndTabs);
                foreach($fixedStringArr as $arr){
                    echo $arr . "<br/>";
                }
                //Following is using for line by line search
                $sanitiedArray = file($file);

                

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
