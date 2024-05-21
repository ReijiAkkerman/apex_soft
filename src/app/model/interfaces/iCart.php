<?php
    namespace project\model\interfaces;

    interface iCart {
        public function setProductAmount(string $user, int $product_id, int $amount = 1): void;
        public function deleteProduct(string $user, int $product_id): void;
        public function getProductAmount(string $user, int $product_id): int;
        public function getAllProducts(string $user): void;
    }