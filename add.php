<?php
    $password = "100206";

    //mengenkripsi password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    echo "$hash";
?>