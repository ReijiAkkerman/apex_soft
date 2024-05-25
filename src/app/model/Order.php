<?php
    namespace project\model;

    use project\control\parent\Page;
    use project\model\interfaces\iOrder;
    use project\model\enum\OrderRegex;
    use project\model\Product;

    class Order implements iOrder {
        private \mysqli $order_mysql_connection;
        private \mysqli $visitor_mysql_connection;

        private string $order;
        private \mysqli_result $orders;
        private array $order_products;
        
        public int $order_ID;
        public string $order_time;
        public string $order_status;
        public string $recipient_name;
        public string $recipient_email;
        public string $recipient_phone;

        public string $error_message;





        public function createOrder($user): void {
            $this->getRecipientName();
            $this->getRecipientEmail();
            $this->getRecipientPhone();
            $this->getProductsForOrder();
            $this->createMysqlConnection__order();
            $this->saveOrder($user, 'Оформлен');
            $this->order_mysql_connection->close();
            
        }

        public function cancelOrder(): void {

        }

        public function deleteProductFromOrder(): void {
            
        }

        public function getAllOrders($userID): void {
            $this->createMysqlConnection__order();
            $this->getOrders($userID);
            $Product = new Product();
            $GLOBALS['orders'] = [];
            $GLOBALS['products'] = [];
            foreach($this->orders as $order) {
                $this->order_ID = $order['orderID'];
                $this->order_status = $order['order_status'];
                $this->recipient_name = $order['recipient'];
                $this->recipient_email = $order['recipient_email'];
                $this->recipient_phone = $order['recipient_phone'];
                $time = new \DateTime();
                $time->setTimestamp($order['order_time']);
                $this->order_time = $time->format('d.m.Y');
                $GLOBALS['orders'][] = clone $this;

                $this->getOrderProducts($order['productsIDs']);
                $GLOBALS['products'][$this->order_ID] = [];
                foreach($this->order_products as $productID => $product_amount) {
                    $Product->getProduct($productID);
                    $Product->amount = $product_amount;
                    $GLOBALS['products'][$this->order_ID][] = clone $Product;
                }
            }

        }

        public function deleteProductAtAll(): void {

        }





        private function getProductsForOrder(): void {
            $productsStringIsGood = $this->validateProductsString();
            if($productsStringIsGood) 
                $this->order = $_POST['products'];
            else {
                $this->sendData();
                exit;
            }
        }

        private function validateProductsString(): bool {
            if($_POST['products']) {
                $regex = OrderRegex::products_for_order->value;
                $result = preg_match($regex, $_POST['products']);
                if($result === 1) {
                    return true;
                }
                else if($result === 0) {
                    $this->error_message = 'Данные продуктов содержат недопустимые символы';
                    return false;
                }
                else {
                    $this->error_message = 'Во время проверки строки с данными продуктов возникла ошибка';
                    return false;
                }
            }
            else {
                $this->error_message = 'Данные продуктов не получены!';
                return false;
            }
        }





        private function getOrderProducts(string $products): void {
            $temp_array = explode(',', $products);
            foreach($temp_array as $product) {
                $temp = explode('=', $product);
                $this->order_products[$temp[0]] = $temp[1];
            }
        }





        /**
         * Функции для получения данных из формы заказа
         */

        private function getRecipientName(): void {
            $nameIsGood = $this->validateRecipientName();
            if($nameIsGood) 
                $this->recipient_name = $_POST['recipient_name'];
            else {
                $this->sendData();
                exit;
            }
        }

        private function getRecipientEmail(): void {
            $emailIsGood = $this->validateRecipientEmail();
            if($emailIsGood) 
                $this->recipient_email = $_POST['recipient_email'];
            else {
                $this->sendData();
                exit;
            }
        }

        private function getRecipientPhone(): void {
            $phoneIsGood = $this->validateRecipientPhone();
            if($phoneIsGood)
                $this->recipient_phone = $_POST['recipient_phone'];
            else {
                $this->sendData();
                exit;
            }
        }





        /**
         * Функции для проверки данных из формы заказа
         */

        private function validateRecipientName(): bool {
            if($_POST['recipient_name']) {
                $regex = OrderRegex::recipient_name->value;
                $result = preg_match($regex, $_POST['recipient_name']);
                if($result === 1) {
                    return true;
                }
                else if($result === 0) {
                    $this->error_message = 'recipient_name|Имя получателя не соответствует допустимому шаблону!';
                    return false;
                }
                else {
                    $this->error_message = 'Во время обработки имени получателя возникла ошибка!';
                    return false;
                }
            }
            else if($_POST['recipient_name'] === '0') {
                $this->error_message = 'recipient_name|Имя получателя не соответствует допустимому шаблону!';
                return false;
            }
            else {
                $this->error_message = 'recipient_name|Имя получателя не заполнено!';
                return false;
            }
        }

        private function validateRecipientEmail(): bool {
            if($_POST['recipient_email']) {
                $regex = OrderRegex::recipient_email->value;
                $result = preg_match($regex, $_POST['recipient_email']);
                if($result === 1) {
                    return true;
                }
                else if($result === 0) {
                    $this->error_message = 'recipient_email|Почта получателя не соответствует допустимому шаблону!';
                    return false;
                }
                else {
                    $this->error_message = 'Во время обработки почты получателя возникла ошибка!';
                    return false;
                }
            }
            else if($_POST['recipient_email'] === '0') {
                $this->error_message = 'recipient_email|Почта получателя не соответствует допустимому шаблону!';
                return false;
            }
            else {
                $this->erorr_message = 'recipient_email|Почта получателя не указана!';
                return false;
            }
        }

        private function validateRecipientPhone(): bool {
            if($_POST['recipient_phone']) {
                $regex = OrderRegex::recipient_phone->value;
                $result = preg_match($regex, $_POST['recipient_phone']);
                if($result === 1) {
                    return true;
                }
                else if($result === 0) {
                    $this->error_message = 'recipient_phone|Номер телефона получателя не соответствует допустимому шаблону!';
                    return false;
                }
                else {
                    $this->erorr_message = 'Во время обработки номера телефона получателя возникла ошибка!';
                    return false;
                }
            }
            else if($_POST['recipient_phone'] === '0') {
                $this->error_message = 'recipient_phone|Номер телефона получателя не соответствует допустимому шаблону!';
                return false;
            }
            else {
                $this->error_message = 'recipient_phone|Номер телефона получателя не указан!';
                return false;
            }
        }





        private function createMysqlConnection__order(): void {
            $this->order_mysql_connection = new \mysqli(Page::MYSQL_SERVER, Page::HOSTING_USER . 'Orders', 'secret_of_Orders', Page::HOSTING_USER . 'Orders');
        }

        private function createMysqlConnection__visitor(): void {
            $this->visitor_mysql_connection = new \mysqli(Page::MYSQL_SERVER, Page::HOSTING_USER . 'Visitor', 'secret_of_Visitor', Page::HOSTING_USER . 'Visitor');
        }





        private function saveOrder($userID, $order_status): void {
            $order_time = time();
            $query = "INSERT INTO all_orders(
                ID,
                order_time,
                order_status,
                productsIDs,
                recipient,
                recipient_email,
                recipient_phone
            ) VALUES (
                {$userID},
                {$order_time},
                '{$order_status}',
                '{$this->order}',
                '{$this->recipient_name}',
                '{$this->recipient_email}',
                '{$this->recipient_phone}'
            )";
            $this->order_mysql_connection->query($query);
        }

        private function getOrders($userID): void {
            $query = "SELECT * FROM all_orders WHERE ID={$userID}";
            $this->orders = $this->order_mysql_connection->query($query);
        }





        private function unsetData(): void {
            unset($this->recipient_name);
            unset($this->recipient_email);
            unset($this->recipient_phone);
            unset($this->order_ID);
            unset($this->order_time);
            unset($this->order_status);
        }

        private function sendData(): void {
            $data = json_encode($this, JSON_UNESCAPED_UNICODE);
            echo $data;
        }
    }