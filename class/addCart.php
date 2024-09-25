<?php
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['cart'])){
        print_r($_POST['cart'][1]);
        exit;
        /*
        $query = "";
        if ($result = $mysqli -> query("")) {
            echo "Returned rows are: " . $result -> num_rows;
            // Free result set
            $result -> free_result();
          }
        */
    }

}



?>