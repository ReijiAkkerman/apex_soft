<?php
    namespace project\model\interfaces;

    interface iOrder {
        public function createOrder($user): void;
        public function cancelOrder(): void;
        public function deleteProductFromOrder(): void;
        public function getAllOrders($userID): void;
        public function deleteProductAtAll(): void;
    }