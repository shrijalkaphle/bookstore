<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'a4rbookstore';

    // $host = 'sql101.epizy.com';
    // $user = 'epiz_29280548';
    // $password = 'qJ8BVC5683sJ3';
    // $dbname = 'epiz_29280548_book_database';

    $conn = mysqli_connect($host,$user,$password,$dbname) or die("DBMS Error");
?>