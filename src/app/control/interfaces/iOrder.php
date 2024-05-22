<?php
    namespace project\control\interfaces;

    interface iOrder {
        public function createOrder(): void;
        public function cancelOrder(): void;
        public function deleteProductFromOrder(): void;
    }