<?php
    namespace project\control\interfaces;

    interface iCart {
        public function setProductAmount(array $args): void;
        public function deleteProduct(array $args): void;
    }