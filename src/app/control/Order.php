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

        public function cancelOrder(array $args): void {
            $orderID = (int)$args[0];
            (new model_Order)->cancelOrder($orderID);
        }

        public function changeProductAmount(array $args): void {
            $orderID = (int)$args[0];
            $productID = (int)$args[1];
            $product_amount = (int)$args[2];
            (new model_Order)->changeProductAmount($orderID, $productID, $product_amount);
        }

        public function deleteProductFromOrder(array $args): void {
            $orderID = (int)$args[0];
            $productID = (int)$args[1];
            (new model_Order)->deleteProductFromOrder($orderID, $productID);
        }
    }