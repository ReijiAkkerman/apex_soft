<?php
    namespace project\model\interfaces;

    interface iProduct {
        public function createProduct(): void;
        public function updateProduct(int $id): void;
        public function deleteProduct(int $id): void;
        public function getAllProducts(string $user): void;
        public function getProduct(int $id): void;
        // public function setAmount(int $id): void;
    }