<?php
    $password = password_hash('admin_password', PASSWORD_DEFAULT);
    echo $password . "\n";
    echo time() . "\n";

    // INSERT INTO users(login,name,password,creation_date,admin_rights) VALUES ('superuser','Admin','$2y$10$jbrftjoQCHhZ6XsJDRnm5O.LEc5Dr35ZP5QuQchChOSZ6POAN4Qrq',1715005000,1);
    // create table superuser(productID BIGINT UNSIGNED NOT NULL, amount INT, FOREIGN KEY(productID) REFERENCES Products.all_products(productID));