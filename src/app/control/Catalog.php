<?php
    namespace project\control;

    use project\control\parent\Page;
    use project\control\traits\View;
    use project\control\interfaces\iCatalog;

    use project\model\Product;

    final class Catalog extends Page implements iCatalog {
        public string $error_message;

        public function __construct() {
            $this->constructor();
        }

        public function view(): void {
            (new Product)->getAllProducts();
            $classname = __CLASS__;
            $class_array = explode('\\', $classname);
            $class = end($class_array);
            require_once __DIR__ . '/../view/pages/' . lcfirst($class) . '.php';
        }

        public function deleteProduct(array $args): void {
            $id = (int)$args[0];
            $access_permitted = $this->checkAccessRights();
            if($access_permitted) 
                (new model_Product)->deleteProduct($id);
            else {
                $this->sendData();
                exit;
            }
        }





        /**
         * Вспомогательные функции
         */

        private function checkAccessRights(): bool {
            if($this->admin) {
                return true;
            }
            else {
                $this->error_message = 'У Вас нет прав на редактирование товаров!';
                return false;
            }
        }
    }