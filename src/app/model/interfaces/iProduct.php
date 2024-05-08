<?php
    namespace project\model\interfaces;

    interface iProduct {
        public function createProduct(): void;
        public function updateProduct(): void;
        public function deleteProduct(): void;
        public function getAllProducts(): void;
        public function getProduct(): void;
    }