<?php
    namespace project\model\enum;

    enum OrderRegex: string {
        case recipient_name = '#^[a-zA-Z0-9а-яА-Я\040]{3,100}$#u';
        case recipient_email = '#^[a-z][a-z0-9]{1,99}@[a-z]{2,20}\.[a-z]{2,10}$#';
        case recipient_phone = '#^\+[0-9]{1,3}[0-9]{10}$#';
        case products_for_order = '#[0-9=,]#';
    }