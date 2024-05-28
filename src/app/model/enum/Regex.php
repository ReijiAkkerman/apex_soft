<?php
    namespace project\model\enum;

    enum Regex: string {
        case product_name = '#^[a-zA-Z0-9а-яА-Я\040_\-:.,()]{5,100}$#u';
        case product_type = '#^[a-zA-Z0-9а-яА-Я\040]{3,50}$#u';
        case product_articul = '#^[a-zA-Z0-9]{1,100}$#';
        case product_price = '#^(0|[1-9]([0-9]{1,10})?)$#';
        case image_format = '#^(jpg|jpeg|gif|bmp|webp|png|svg)$#';
    }