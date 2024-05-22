<?php
    namespace project\control;

    use project\control\parent\Page;
    use project\control\interfaces\iOrder;
    use project\control\traits\View;

    class Order extends Page implements iOrder {
        use View;

        public function createOrder(): void {

        }

        public function cancelOrder(): void {

        }

        public function deleteProductFromOrder(): void {
            
        }
    }