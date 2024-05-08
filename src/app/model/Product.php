<?php
    namespace project\model;

    use project\control\parent\Page;
    use project\model\enum\Regex;
    use project\model\interfaces\iProduct;

    class Product implements iProduct {
        public int $ID;
        public string $name;
        public string $type;
        public string $description;
        public string $imageName;

        private string $imageFormat;

        public string $error_message;

        private array $functions_for_validationAdminForm;

        public function __construct() {
            $this->functions_for_validationAdminForm = [
                'validateProductName',
                'validateProductType',
                'checkImageErrors',
                'validateImageFormat'
            ];
        }

        public function createProduct(): void {
            foreach($this->functions_for_validationAdminForm as $function) {
                $validated = $this->$function();
                if(!$validated) {
                    $this->unsetProductData();
                    $this->sendData();
                    exit;
                }
            }
            $this->description = $_POST['product_description'];

            try {
                $mysql = new \mysqli(Page::MYSQL_SERVER, 'Admin', 'secret_of_Admin', 'Products');
            }
            catch(\mysqli_sql_exception $e) {
                echo $e->getMessage();
                exit;
            }
            $this->ID = ($this->getLastProductID($mysql) + 1);
            $imageSaved = $this->saveGotImageToFilesystem($mysql);
            if($imageSaved) {
                $this->writeProductData($mysql);
                $mysql->close();
                $this->sendData();
                exit;
            }
            else {
                $mysql->close();
                $this->getImageError();
                $this->sendData();
                exit;
            }
        }

        public function updateProduct(): void {

        }

        public function deleteProduct(): void {

        }

        public function getAllProducts(): void {

        }

        public function getProduct(int $product_id): void {
            $mysql = new \mysqli(Page::MYSQL_SERVER, 'Visitor', 'secret_of_Visitor', 'Products');
            $query = "SELECT * FROM all_products WHERE ID=$product_id";
            $result = $mysql->query($query);
            if($result->num_rows) {
                foreach($result as $row) {
                    $this->ID = (int)$row['ID'];
                    $this->name = $row['product_name'];
                    $this->type = $row['product_type'];
                    $this->description = $row['product_description'];
                    $this->imageName = $row['image_name'];
                }
            }
            else {
                $this->error_message = "Запрашиваемый товар не найден!";
            }
            $mysql->close();
        }




        /**
         * Вспомогательные функции для работы с изображением
         */

        private function saveGotImageToFilesystem(\mysqli $mysql): bool {
            $filename = (string)$this->ID;
            $this->imageName = $filename . '.' . $this->imageFormat;
            $dirname = __DIR__ . '/../../../images/';
            $full_path = $dirname . $filename . '.' . $this->imageFormat;
            try {
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $full_path);
            }
            catch(\ErrorException $e) {
                echo $e;
                exit;
            }
            $this->ID = $filename;
            return $result;
        }

        private function getImageError(): void {
            $this->error_message = match($_FILES['image']['error']) {
                6 => 'Отсутствует временная папка! Обратитесь к администратору сайта!',
                7 => 'Не удалось записать файл на диск! Обратитесь к администратору сайта!',
                8 => 'По неизвестным причинам сервер отстановил загрузку файла!',
                default => 'Фатальная ошибка!'
            };
        }





        /**
         * Функции для проверки правильности заполения полей
         */

         private function validateProductName(): bool {
            if($_POST['product_name']) {
                $regex = Regex::product_name->value;
                $result = preg_match($regex, $_POST['product_name']);
                if($result === 1) {
                    $this->name = $_POST['product_name'];
                    return true;
                }
                else if($result === 0) {
                    $this->error_message = 'product_name|Наименование товара не соответствует допустимому шаблону!';
                    return false;
                }
                else {
                    $this->error_message = 'Произошла ошибка во время проверки наименования товара!';
                    return false;
                }
            }
            else if($_POST['product_name'] === '0') {
                $this->error_message = 'product_name|Наименование товара не соответствует допустимому шаблону!';
                return false;
            }
            else {
                $this->error_message = 'product_name|Наименование товара отсутствует!';
                return false;
            }
        }

        private function validateProductType(): bool {
            if($_POST['product_type']) {
                $regex = Regex::product_type->value;
                $result = preg_match($regex, $_POST['product_type']);
                if($result === 1) {
                    $this->type = $_POST['product_type'];
                    return true;
                }
                else if($result === 0) {
                    $this->error_message = 'product_type|Наименование товара не соответствует допустимому шаблону!';
                    return false;
                }
                else {
                    $this->error_message = 'Произошла ошибка во время проверки наименования товара!';
                    return false;
                }
            }
            else if($_POST['product_type'] === '0') {
                $this->error_message = 'product_type|Наименование товара не соответствует допустимому шаблону!';
                return false;
            }
            else {
                $this->error_message = 'product_type|Наименование товара отсутствует!';
                return false;
            }
        }

        private function validateImageFormat(): bool {
            $image_format = (explode('/', $_FILES['image']['type']))[1];
            $regex = Regex::image_format->value;
            $result = preg_match($regex, $image_format);
            if($result === 1) {
                $this->imageFormat = $image_format;
                return true;
            }
            else if($result === 0) {
                $this->error_message = 'image|Формат изображения не соответствует допустимому!';
                return false;
            }
            else {
                $this->error_message = 'Произошла ошибка во время проверки формата изображения!';
                return false;
            }
        }

        private function checkImageErrors(): bool {
            if($_FILES['image']['error']) {
                $this->error_message = match($_FILES['image']['error']) {
                    1 => 'Размер изображения превысил максимально допустимый размер для сервера! Обратитесь к администратору сайта!',
                    2 => 'Размер изображения больше допустимого!',
                    3 => 'Изображение было получено только частично! Повторите загрузку!',
                    4 => 'Файл не был загружен!',
                };
                return false;
            }
            else 
                return true;
        }





        /**
         * Общие вспомогательные функции
         */

        private function writeProductData(\mysqli $mysql): void {
            $query = "INSERT INTO all_products(
                product_name,
                product_type,
                product_description,
                image_name
            ) VALUES (
                ?,
                ?,
                ?,
                ?
            )";
            $stmt = $mysql->prepare($query);
            $stmt->bind_param(
                'ssss',
                $this->name,
                $this->type,
                $this->description,
                $this->imageName
            );
            $stmt->execute();
        }

        private function getLastProductID(\mysqli $mysql): int {
            $query = "SELECT COUNT(*) as products_amount FROM all_products";
            $result = $mysql->query($query);
            foreach($result as $row) {
                $lastProductID = $row['products_amount'];
            }
            return $lastProductID;
        }

        private function unsetProductData(): void {
            unset($this->productID);
            unset($this->productName);
            unset($this->productType);
        }

        private function sendData(): void {
            $data = json_encode($this, JSON_UNESCAPED_UNICODE);
            echo $data;
        }
    }