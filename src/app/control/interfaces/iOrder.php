<?php
    namespace project\control\interfaces;

    interface iOrder {
        public function createOrder(): void;
        public function cancelOrder(array $args): void;
        public function changeProductAmount(array $args): void;
        public function deleteProductFromOrder(array $args): void;
    }