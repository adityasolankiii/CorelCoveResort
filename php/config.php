<?php  
    $servername = "localhost:3242";
    $username="root";
    $password="";
    $dbname="CaseStudy";
    $conn = new mysqli($servername, $username,$password,$dbname);
    if($conn->connect_error)
    {
        echo "Not Connected" . $conn->connect_error;
    }
?>