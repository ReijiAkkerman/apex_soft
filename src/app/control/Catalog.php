<?php
    namespace project\control;

    use project\control\parent\Page;
    use project\control\traits\View;

    use project\model\Product;

    final class Catalog extends Page {
        public string $error_message;

        public function __construct() {
            $this->constructor();
        }

        use View;

        public function view(): void {
            (new Product)->getAllProducts();
            $classname = __CLASS__;
            $class_array = explode('\\', $classname);
            $class = end($class_array);
            require_once __DIR__ . '/../view/pages/' . lcfirst($class) . '.php';
        }
    }