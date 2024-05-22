<?php
namespace project\model;

    use project\control\parent\Page;
    use project\model\enum\Regex;
    use project\model\interfaces\iProduct;
    use project\model\ProductData;

    class Product extends ProductData implements iProduct {
        private const DEFAULT_IMAGE_NAME = '0.png';

        private string $imageFormat;
        private array $data = [];
        private \mysqli $mysql_connection;

        public string $error_message;

        public function __set($name, $value) {
            $this->data[$name] = $value;
        }

        public function __get($name) {
            return $this->data[$name];
        }

        public function __isset($name) {
            return isset($this->data[$name]);
        }

        public function createProduct(): void {
            $this->createMysqlConnection('Admin');

            $this->getName();
            $this->getType();
            $this->getDescription();
            $this->getArticul();
            $this->getPrice();
            $this->getID();
            $this->getImage();
            $this->saveData();

            $this->mysql_connection->close();
        }

        public function updateProduct(int $id): void {
            $this->createMysqlConnection('Admin');

            $this->getID($id);
            $this->getName();
            $this->getType();
            $this->getDescription();
            $this->getArticul();
            $this->getPrice();
            $this->getImage();
            $this->saveData($this->ID);

            $this->mysql_connection->close();
        }

        public function deleteProduct(int $id): void {
            $getImageName = function (\mysqli $mysql, int $id): string|false {
                $query = "SELECT image_name FROM all_products WHERE ID=$id";
                $result = $mysql->query($query);
                if ($result->num_rows) {
                    foreach ($result as $row) {
                        return $row['image_name'];
                    }
                } else
                    return false;
            };

            $this->createMysqlConnection('Admin');

            $this->getID($id);
            $this->imageName = $getImageName($this->mysql_connection, $this->ID);
            if ($this->imageName) {
                $this->deleteImage();
                $this->deleteData($id);
            } else {
                $this->error_message = "Указанный товар не найден!";
                $this->unsetData();
                $this->sendData();
                exit;
            }

            $this->mysql_connection->close();
        }

        public function getAllProducts(string $user = ''): void {
            $cart = new Cart;
            $GLOBALS['products'] = [];
            $this->createMysqlConnection('Visitor');
            $query = "SELECT * FROM all_products";
            $result = $this->mysql_connection->query($query);
            if($result->num_rows) {
                foreach($result as $row) {
                    $this->ID = (int)$row['ID'];
                    $this->name = $row['product_name'];
                    $this->type = $row['product_type'];
                    $this->imageName = $row['image_name'];
                    $this->articul = $row['product_articul'];
                    $this->price = (int)$row['product_price'];
                    if($user)
                        $this->amount = $cart->getProductAmount($user, $this->ID);
                    $GLOBALS['products'][] = clone $this;
                }
            }
            $this->mysql_connection->close();
        }

        public function getProduct(int $id): void {
            $this->createMysqlConnection('Visitor');
            $query = "SELECT * FROM all_products WHERE ID=$id";
            $result = $this->mysql_connection->query($query);
            if($result->num_rows) {
                foreach($result as $row) {
                    $this->ID = (int)$row['ID'];
                    $this->name = $row['product_name'];
                    $this->type = $row['product_type'];
                    $this->description = $row['product_description'];
                    $this->imageName = $row['image_name'];
                    $this->articul = $row['product_articul'];
                    $this->price = (int)$row['product_price'];
                }
            } else {
                $this->error_message = "Запрашиваемый товар не найден!";
            }
            $this->mysql_connection->close();
        }





        /**
         * Функции подключения к БД
         */

        private function createMysqlConnection(string $for): void {
            try {
                $this->mysql_connection = new \mysqli(Page::MYSQL_SERVER, Page::HOSTING_USER . $for, 'secret_of_' . $for, Page::HOSTING_USER . 'Products');
            } catch (\mysqli_sql_exception $e) {
                echo $e->getMessage();
                exit;
            }
        }





        /**
         * Функции для получения текстовых данных
         */

        private function getName(): void {
            $validatedName = $this->validateName();
            if ($validatedName) {
                if (isset($this->ID))
                    $nameIsBusy = $this->isNameExists($_POST['product_name'], $this->ID);
                else
                    $nameIsBusy = $this->isNameExists($_POST['product_name']);
                if ($nameIsBusy) {
                    $this->unsetData();
                    $this->sendData();
                    exit;
                } else
                    $this->name = $_POST['product_name'];
            } else {
                $this->unsetData();
                $this->sendData();
                exit;
            }
        }

        private function getType(): void {
            $validatedType = $this->validateType();
            if ($validatedType) {
                $this->type = $_POST['product_type'];
            } else {
                $this->unsetData();
                $this->sendData();
                exit;
            }
        }

        private function getDescription(): void {
            $this->description = $_POST['product_description'];
        }

        private function getArticul(): void {
            $validatedArticul = $this->validateArticul();
            if ($validatedArticul) {
                if (isset($this->ID))
                    $articulIsBusy = $this->isArticulExists($_POST['product_articul'], $this->ID);
                else
                    $articulIsBusy = $this->isArticulExists($_POST['product_articul']);
                if ($articulIsBusy) {
                    $this->unsetData();
                    $this->sendData();
                    exit;
                } else
                    $this->articul = $_POST['product_articul'];
            } else {
                $this->unsetData();
                $this->sendData();
                exit;
            }
        }

        private function getPrice(): void {
            $validatedPrice = $this->validatePrice();
            if ($validatedPrice || $validatedPrice === 0) {
                $this->price = (int) $_POST['product_price'];
            } else {
                $this->unsetData();
                $this->sendData();
                exit;
            }
        }





        /**
         * Функции для получения данных изображения
         */

        private function getImage(): void {
            $error_exists = $this->isImageErrorsExist();
            if ($error_exists) {
                $this->unsetData();
                $this->sendData();
                exit;
            } else if ($error_exists === 0) {
                $permitted_extension = $this->validateImageExtension();
                if ($permitted_extension) {
                    if (!isset($this->imageName))
                        $this->getImageName();
                    $this->saveImage();
                } else {
                    $this->unsetData();
                    $this->sendData();
                    exit;
                }
            } else {
                $this->imageName = $this->getProductImageName();
                if($this->imageName == false) 
                    $this->imageName = Product::DEFAULT_IMAGE_NAME;
            }
        }





        /**
         * Функции для получения скрытых данных
         */

        private function getID(int $id = 0): void {
            if ($id) {
                $this->ID = $id;
            } else {
                $query = "SELECT max(ID) AS lastID FROM all_products";
                $result = $this->mysql_connection->query($query);
                foreach ($result as $row) {
                    if ($row['lastID'] === null)
                        $this->ID = 0;
                    else
                        $this->ID = $row['lastID'];
                }
                $this->ID++;
            }
        }

        private function getImageName(): void {
            $this->imageName = $this->ID . '.' . $this->imageFormat;
        }





        /**
         * Функции для проверки текстовых данных
         */

        private function validateName(): bool {
            if ($_POST['product_name']) {
                $regex = Regex::product_name->value;
                $result = preg_match($regex, $_POST['product_name']);
                if ($result === 1) {
                    return true;
                } else if ($result === 0) {
                    $this->error_message = 'product_name|Наименование товара не соответствует допустимому шаблону!';
                    return false;
                } else {
                    $this->error_message = 'Произошла ошибка во время проверки наименования товара!';
                    return false;
                }
            } else if ($_POST['product_name'] === '0') {
                $this->error_message = 'product_name|Наименование товара не соответствует допустимому шаблону!';
                return false;
            } else {
                $this->error_message = 'product_name|Наименование товара отсутствует!';
                return false;
            }
        }

        private function validateType(): bool {
            if ($_POST['product_type']) {
                $regex = Regex::product_type->value;
                $result = preg_match($regex, $_POST['product_type']);
                if ($result === 1) {
                    return true;
                } else if ($result === 0) {
                    $this->error_message = 'product_type|Тип товара не соответствует допустимому шаблону!';
                    return false;
                } else {
                    $this->error_message = 'Произошла ошибка во время проверки типа товара!';
                    return false;
                }
            } else if ($_POST['product_type'] === '0') {
                $this->error_message = 'product_type|Тип товара не соответствует допустимому шаблону!';
                return false;
            } else {
                $this->error_message = 'product_type|Тип товара отсутствует!';
                return false;
            }
        }

        private function validateArticul(): bool {
            if ($_POST['product_articul']) {
                $regex = Regex::product_articul->value;
                $result = preg_match($regex, $_POST['product_articul']);
                if ($result === 1) {
                    return true;
                } else if ($result === 0) {
                    $this->error_message = "product_articul|Артикул не соответствует допустимому шаблону!";
                    return false;
                } else {
                    $this->error_message = "Во время проверки артикула возникла ошибка!";
                    return false;
                }
            } else if ($_POST['product_articul'] === '0') {
                $this->error_message = "product_articul|Артикул не соответствует допустимому шаблону!";
                return false;
            } else {
                $this->error_message = "product_articul|Артикул не указан!";
                return false;
            }
        }

        private function validatePrice(): int|false {
            if ($_POST['product_price']) {
                $regex = Regex::product_price->value;
                $result = preg_match($regex, $_POST['product_price']);
                if ($result === 1) {
                    return 0;
                } else if ($result === 0) {
                    $this->error_message = "product_price|Цена должна состоять только из цифр!";
                    return false;
                } else {
                    $this->error_message = "Во время проверки цены товара возникла ошибка";
                    return false;
                }
            } else if ($_POST['product_price'] === '0') {
                return 1;
            } else {
                $this->error_message = "product_price|Цена товара не указана!";
                return false;
            }
        }

        private function isNameExists(string $name, int $id = 0): bool {
            if ($id)
                $query = "SELECT product_name FROM all_products WHERE product_name='$name' && ID!={$this->ID}";
            else
                $query = "SELECT product_name FROM all_products WHERE product_name='$name'";
            $result = $this->mysql_connection->query($query);
            if ($result->num_rows) {
                $this->error_message = "product_name|Товар с таким именем уже существует!";
                return true;
            } else
                return false;
        }

        private function isArticulExists(string $articul, int $id = 0): bool {
            if ($id)
                $query = "SELECT product_articul FROM all_products WHERE product_articul='$articul' && ID!={$this->ID}";
            else
                $query = "SELECT product_articul FROM all_products WHERE product_articul='$articul'";
            $result = $this->mysql_connection->query($query);
            if ($result->num_rows) {
                $this->error_message = "product_articul|Товар с таким артикулом уже существует!";
                return true;
            } else
                return false;
        }





        /**
         * Функции для проверки данных изображения
         */

        private function isImageErrorsExist(): bool|int {
            switch ($_FILES['image']['error']) {
                case 1:
                    $this->error_message = "Размер принятого файла превысил максимально допустимый размер который может принять сервер!";
                    return true;
                    break;
                case 2:
                    $this->error_message = "Размер принятого файла превысил допустимый для загрузки размер в {$_POST['MAX_FILE_SIZE']} байт";
                    return true;
                    break;
                case 3:
                    $this->error_message = "Загружаемый файл был получен только частично!";
                    return true;
                    break;
                case 6:
                case 7:
                case 8:
                    $this->error_message = "Ошибка в работе сервера, повторите попытку позднее!";
                    return true;
                    break;
                case 4:
                    return false;
                    break;
                case 0:
                    return 0;
                    break;
            }
        }

        private function validateImageExtension(): bool {
            $image_extension = (explode('/', $_FILES['image']['type']))[1];
            $regex = Regex::image_format->value;
            $result = preg_match($regex, $image_extension);
            if ($result === 1) {
                $this->imageFormat = $image_extension;
                return true;
            } else if ($result === 0) {
                $this->error_message = 'image|Формат изображения не соответствует допустимому!';
                return false;
            } else {
                $this->error_message = 'Произошла ошибка во время проверки формата изображения!';
                return false;
            }
        }





        /**
         * Функции для записи данных
         */

        private function getProductImageName(): string {
            $query = "SELECT image_name FROM all_products WHERE ID={$this->ID}";
            $result = $this->mysql_connection->query($query);
            if($result->num_rows) {
                foreach($result as $row) {
                    return $row['image_name'];
                }
            }
            else {
                return false;
            }
        }

        private function saveImage(): void {
            $dirname = __DIR__ . '/../../../images/';
            $full_path = $dirname . $this->imageName;
            try {
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $full_path);
            } catch (\ErrorException $e) {
                echo $e;
                exit;
            }
        }

        private function deleteImage(): void {
            $dirname = __DIR__ . '/../../../images/';
            $full_path = $dirname . $this->imageName;
            if ($this->imageName == Product::DEFAULT_IMAGE_NAME)
                return;
            if (file_exists($full_path))
                unlink($full_path);
        }

        private function saveData(int $id = 0): void {
            if ($id) {
                $query = "UPDATE LOW_PRIORITY all_products SET 
                        product_name = ?,
                        product_type = ?,
                        product_description = ?,
                        image_name = ?,
                        product_articul = ?,
                        product_price = ?
                    WHERE ID=?";
                $stmt = $this->mysql_connection->prepare($query);
                $stmt->bind_param(
                    'sssssii',
                    $this->name,
                    $this->type,
                    $this->description,
                    $this->imageName,
                    $this->articul,
                    $this->price,
                    $this->ID
                );
            } else {
                $query = "INSERT INTO all_products(
                        product_name,
                        product_type,
                        product_description,
                        image_name,
                        product_articul,
                        product_price
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    )";
                $stmt = $this->mysql_connection->prepare($query);
                $stmt->bind_param(
                    'sssssi',
                    $this->name,
                    $this->type,
                    $this->description,
                    $this->imageName,
                    $this->articul,
                    $this->price
                );
            }
            $stmt->execute();
        }

        private function deleteData(int $id): void {
            $query = "DELETE FROM all_products WHERE ID=$id";
            $this->mysql_connection->query($query);
        }





        /**
         * Общие вспомогательные функции
         */

        private function unsetData(): void {
            unset($this->ID);
            unset($this->name);
            unset($this->type);
            unset($this->description);
            unset($this->imageName);
            unset($this->data);
        }

        private function sendData(): void {
            $data = json_encode($this, JSON_UNESCAPED_UNICODE);
            echo $data;
        }
}