<?php
    namespace project\control\interfaces;

    interface iProduct {
        public function createProduct(): void;
        public function updateProduct(array $args): void;
        public function deleteProduct(array $args): void;
    }