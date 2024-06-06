<?php
    namespace project\control\parent\enum;

    enum Regex: string {
        case login = '#^[A-Za-z0-9_]{3,50}$#';
        case name = '#^[A-Za-z0-9А-Яа-я]{3,100}$#u';
        case password = '#^[A-Za-z0-9_.]{5,50}$#';
    }