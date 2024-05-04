<?php
    $password = password_hash('admin_password', PASSWORD_DEFAULT);
    echo $password . "\n";
    echo time() . "\n";