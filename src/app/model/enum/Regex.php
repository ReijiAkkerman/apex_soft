<?php
    namespace project\model\enum;

    enum Regex: string {
        case title = '#^[a-zA-Z0-9а-яА-Я _.,-]{5,100}$#';
        case image_format = '#^(jpg|jpeg|bmp|png|gif)$#';
        case theme_title = '#^[a-zA-Z0-9А-Яа-я _.,-]{5,100}$#';
        case theme_description = '#^[a-zA-Z0-9А-Яа-я _.,-]{10,2000}$#';
    }