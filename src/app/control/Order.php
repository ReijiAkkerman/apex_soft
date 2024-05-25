<?php
    namespace project\control;

    use project\control\parent\Page;
    use project\control\interfaces\iOrder;
    use project\control\traits\View;
    use project\model\Order as model_Order;

    class Order extends Page implements iOrder {
        public function __construct(){
            $this->constructor();
        }

        // use View;

        public function view(): void {
            (new model_Order)->getAllOrders($this->ID);
            $classname = __CLASS__;
            $class_array = explode('\\', $classname);
            $class = end($class_array);
            require_once __DIR__ . '/../view/pages/' . lcfirst($class) . '.php';
        }

        public function createOrder(): void {
            (new model_Order)->createOrder($this->ID);
        }

        public function cancelOrder(): void {

        }

        public function changeProductAmount(): void {

        }

        public function deleteProductFromOrder(): void {
            
        }
    }