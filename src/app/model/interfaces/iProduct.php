<?php
    namespace project\model\interfaces;

    interface iProduct {
        public function createProduct(): void;
        public function updateProduct(int $id): void;
        public function deleteProduct(int $id): void;
        public function getAllProducts(): void;
        public function getProduct(int $product_id): void;
    }