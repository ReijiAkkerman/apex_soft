<?php
    namespace project\control;

    interface iCart {
        public function setProductAmount(array $args): void;
        public function deleteProduct(array $args): void;
    }