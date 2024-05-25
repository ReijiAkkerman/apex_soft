<?php
    namespace project\control\interfaces;

    interface iOrder {
        public function createOrder(): void;
        public function cancelOrder($orderID): void;
        public function changeProductAmount($orderID, $prodictID, $product_amount): void;
        public function deleteProductFromOrder(): void;
    }