<?php
    namespace project\model\interfaces;

    interface iOrder {
        public function createOrder(int $userID, string $user): void;
        public function cancelOrder(int $orderID): void;
        public function changeProductAmount(int $orderID, int $productID, int $product_amount): void;
        public function deleteProductFromOrder(int $orderID, int $productID): void;
        public function getAllOrders(int $userID): void;
        public function deleteProductAtAll(int $productID): void;
    }