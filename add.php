<?php
    $password = "223611039";

    //mengenkripsi password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    echo "$hash";
?>