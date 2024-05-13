<?php
    namespace project\control\parent\interfaces;

    interface Auth {
        public function registrate(): void;
        public function login(): void;
        public function exit(): void;
    }