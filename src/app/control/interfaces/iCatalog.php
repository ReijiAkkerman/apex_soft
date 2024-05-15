<?php
    namespace project\control\interfaces;

    interface iCatalog {
        public function deleteProduct(array $args): void;
        public function setProductAmount(array $args): void;
    }