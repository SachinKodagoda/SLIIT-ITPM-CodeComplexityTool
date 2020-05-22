<?php
include 'java_calc.php';
class Admin extends BaseController
{
    // ADMIN PAGE
    public function index()
    {
        if (isset($_FILES["upload"]["name"])) {
            
            $total = count($_FILES['upload']['name']);
            $data = array("complexity_values" => [] , "file_names" => []);
            $file_names = array();
            $data_subarr = array();



            for ($i = 0; $i < $total; $i++) {
                $tmpFile = basename($_FILES['upload']['name'][$i]);
                array_push($file_names, $tmpFile);

                if ($tmpFile != "") {
                    $fileType = strtolower(pathinfo($tmpFile, PATHINFO_EXTENSION));
                    if ($fileType == 'java') {
                        $file = $_FILES['upload']['tmp_name'][$i];
                        array_push($data_subarr, java_calc($file));
                    }
                }
            }
            $data["complexity_values"] = $data_subarr;
            $data["file_names"] = $file_names;
            $this->view('admin/index', $data);
        } else {
            $data = [
                "complexity_values" => []
            ];
            $this->view('admin/index', $data);
        }
    }
}
