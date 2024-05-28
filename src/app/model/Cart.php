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

        public function deleteProductAtAll(int $id): void {
            $row_str = 'Tables_in_' . Page::HOSTING_USER . 'Carts';
            $this->createMysqlConnection();
            $query = "SHOW TABLES";
            $result = $this->mysql_connection->query($query);
            if($result->num_rows) {
                foreach($result as $row) {
                    $query = "DELETE FROM {$row[$row_str]} WHERE productID=$id";
                    $this->mysql_connection->query($query);
                }
            }
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
            $this->mysql_connection->close();
            foreach($result as $row) {
                $product->getProduct($row['productID']);
                $this->ID = $product->ID;
                $this->name = $product->name;
                $this->type = $product->type;
                $this->description = $product->description;
                $this->imageName = $product->imageName;
                $this->articul = $product->articul;
                $this->price = $product->price;
                $this->amount = $this->getProductAmount($user, $row['productID']);
                $GLOBALS['products'][] = clone $this;
            }
        }

        public function getProductsNumbers(string $user): void {
            $this->createMysqlConnection();
            $GLOBALS['products'] = [];
            $query = "SELECT * FROM $user";
            $result = $this->mysql_connection->query($query);
            foreach($result as $row) {
                $this->ID = $row['productID'];
                $this->amount = $row['amount'];
                $GLOBALS['products'][] = clone $this;
            }
            $this->mysql_connection->close();
            $this->sortProducts();
            $data = json_encode($GLOBALS['products']);
            echo $data;
            exit;
        }





        private function isNewProductForUser(string $user, int $product_id): bool {
            $query = "SELECT amount FROM $user WHERE productID=$product_id";
            $result = $this->mysql_connection->query($query);
            if($result->num_rows)
                return false;
            else 
                return true;
        }

        private function sortProducts(): void {
            for($i = 0; $i < sizeof($GLOBALS['products']) - 1; $i++) {
                $swapped = false;
                for($j = 0; $j < sizeof($GLOBALS['products']) - $i - 1; $j++) {
                    if($GLOBALS['products'][$j]->ID > $GLOBALS['products'][$j + 1]->ID) {
                        [$GLOBALS['products'][$j], $GLOBALS['products'][$j + 1]] = [$GLOBALS['products'][$j + 1], $GLOBALS['products'][$j]];
                        $swapped = true;    
                    }
                }
                if($swapped == false)
                    break;
            }
        }

        private function createMysqlConnection(): void {
            $this->mysql_connection = new \mysqli(Page::MYSQL_SERVER, Page::HOSTING_USER . 'Cart', 'secret_of_Cart', Page::HOSTING_USER . 'Carts');
        }
    }