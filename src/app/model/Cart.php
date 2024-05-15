<?php
    namespace project\model;

    use project\control\parent\Page;
    use project\model\interfaces\iCart;
    use project\model\ProductData;
    use project\model\Product;

    class Cart extends ProductData implements iCart {
        private \mysqli $mysql_connection;

        public function __construct() {
            $this->mysql_connection = new \mysqli(Page::MYSQL_SERVER, 'Cart', 'secret_of_Carts', 'Carts');
        }

        public function setProductAmount(string $user, int $product_id, int $amount = 1): void {
            $new_product = $this->isNewProductForUser();
            if($new_product) 
                $query = "INSERT INTO $user(amount) VALUES ($amount) WHERE productID=$product_id";
            else 
                $query = "UPDATE $user SET amount=$amount WHERE productID=$product_id";
            $this->mysql_connection->query($query);
            $this->mysql_connection->close();
        }

        public function deleteProduct(string $user, int $product_id): void {
            $query = "DELETE FROM $user WHERE productID=$product_id";
            $this->mysql_connection->query($query);
            $this->mysql_connection->close();
        }

        public function getProductAmount(string $user, int $product_id): int {
            $query = "SELECT amount FROM $user WHERE productID=$product_id";
            $result = $this->mysql_connection->query($query);
            $this->mysql_connection->close();
            if($result->num_rows) {
                foreach($result as $row['amount']) {
                    return $row['amount'];
                }
            }
            else 
                return 0;
        }

        public function getAllProducts(string $user): void {
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
    }