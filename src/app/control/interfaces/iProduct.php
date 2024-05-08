<?php
    namespace project\control\interfaces;

    interface iProduct {
        public function createProduct(): void;
        public function updateProduct(): void;
        public function deleteProduct(): void;
    }