<?php
    namespace project\model;

    use project\control\parent\Page;
    use project\model\interfaces\iCart;
    use project\model\ProductData;
    use project\model\Product;

    class Cart extends ProductData implements iCart {
        private \mysqli $mysql_connection;

        public function setProductAmount(string $user, int $product_id, int $amount = 1): void {
            $this->createMysqlConnection();
            $new_product = $this->isNewProductForUser($user, $product_id);
            if($new_product) 
                $query = "INSERT INTO $user(productID, amount) VALUES ($product_id, $amount)";
            else 
                $query = "UPDATE $user SET amount=$amount WHERE productID=$product_id";
            $this->mysql_connection->query($query);
            $this->mysql_connection->close();
        }

        public function deleteProduct(string $user, int $product_id): void {
            $this->createMysqlConnection();
            $query = "DELETE FROM $user WHERE productID=$product_id";
            $this->mysql_connection->query($query);
            $this->mysql_connection->close();
        }

        public function getProductAmount(string $user, int $product_id): int {
            $this->createMysqlConnection();
            $query = "SELECT amount FROM $user WHERE productID=$product_id";
            $result = $this->mysql_connection->query($query);
            $this->mysql_connection->close();
            if($result->num_rows) {
                foreach($result as $row) {
                    return $row['amount'];
                }
            }
            else 
                return 0;
        }

        public function getAllProducts(string $user): void {
            $this->createMysqlConnection();
            $product = new Product();
            $GLOBALS['products'] = [];
            $query = "SELECT productID FROM $user";
            $result = $this->mysql_connection->query($query);
            foreach($result as $row) {
                $product->getProduct($row['productID']);
                $GLOBALS['products'][] = clone $this;
            }
        }





        private function isNewProductForUser(string $user, int $product_id): bool {
            $query = "SELECT amount FROM $user WHERE productID=$product_id";
            $result = $this->mysql_connection->query($query);
            if($result->num_rows)
                return false;
            else 
                return true;
        }

        private function createMysqlConnection(): void {
            $this->mysql_connection = new \mysqli(Page::MYSQL_SERVER, 'Cart', 'secret_of_Cart', 'Carts');
        }
    }