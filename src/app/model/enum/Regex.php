<?php
    namespace project\model\enum;

    enum Regex: string {
        case product_name = '#^[a-zA-Z0-9а-яА-Я\040_-]{5,100}$#u';
        case product_type = '#^[a-zA-Z0-9а-яА-Я\040]{3,50}$#u';
        case image_format = '#^(jpg|jpeg|bmp|png|gif)$#';
    }