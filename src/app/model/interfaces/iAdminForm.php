<?php
    namespace project\model\interfaces;

    interface iAdminForm {
        public function createProduct(): void;
        public function updateProduct(): void;
        public function deleteProduct(): void;
    }