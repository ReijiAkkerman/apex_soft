<?php
    namespace project\control;

    interface i_Cart {
        public function setProductAmount(array $args): void;
        public function deleteProduct(array $args): void;
    }