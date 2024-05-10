<?php
    namespace project\control;

    use project\control\parent\Page;
    use project\control\traits\View;
    use project\control\interfaces\iProduct;
    use project\model\Product as model_Product;


    class Product extends Page implements iProduct {
        public function __construct() {
            $this->constructor();
        }

        public function view(): void {
            if(isset($_GET['id']) && $_GET['id']) {
                $product_id = (int)$_GET['id'];
                $product = new model_Product();
                $product->getProduct($product_id);
                if(isset($_GET['default_action']) && $_GET['default_action'])
                    $product->default_action = $_GET['default_action'];
                else 
                    $product->default_action = 'create';
            }
            $classname = __CLASS__;
            $class_array = explode('\\', $classname);
            $class = end($class_array);
            require_once __DIR__ . '/../view/pages/' . lcfirst($class) . '.php';
        }

        public function createProduct(): void {
            $access_permitted = $this->checkAccessRights();
            if($access_permitted) 
                (new model_Product)->createProduct();
            else {
                $this->sendData();
                exit;
            }
        }

        public function updateProduct(array $args): void {
            $id = (int)$args[0];
            $access_permitted = $this->checkAccessRights();
            if($access_permitted) 
                (new model_Product)->updateProduct($id);
            else {
                $this->sendData();
                exit;
            }
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