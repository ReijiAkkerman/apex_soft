<?php
    namespace project\model;

    use project\control\parent\Page;
    use project\model\enum\Regex;
    use project\model\interfaces\iProduct;

    class Product implements iProduct {
        private const DEFAULT_IMAGE_NAME = '0.png';

        public int $ID;
        public string $name;
        public string $type;
        public string $description;
        public string $imageName;

        private string $imageFormat;
        private array $data = [];

        public string $error_message;

        private array $mainFunctions_for_validationAdminForm;
        private array $additionalFunctions_for_validationAdminForm;

        public function __construct() {
            $this->mainFunctions_for_validationAdminForm = [
                'validateProductName',
                'validateProductType',
                'checkImageErrors'
            ];
            $this->additionalFunctions_for_validationAdminForm = [
                'validateImageFormat'
            ];
        }

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
            foreach($this->mainFunctions_for_validationAdminForm as $function) {
                $validated = $this->$function();
                if(!$validated) {
                    $this->unsetProductData();
                    $this->sendData();
                    exit;
                }
            }
            $this->description = $_POST['product_description'];
            if(!isset($this->imageName) || ($this->imageName != Product::DEFAULT_IMAGE_NAME)) {
                foreach($this->additionalFunctions_for_validationAdminForm as $function) {
                    $validated = $this->$function();
                    if(!$validated) {
                        $this->unsetProductData();
                        $this->sendData();
                        exit;
                    }
                }
            }

            try {
                $mysql = new \mysqli(Page::MYSQL_SERVER, 'Admin', 'secret_of_Admin', 'Products');
            }
            catch(\mysqli_sql_exception $e) {
                echo $e->getMessage();
                exit;
            }
            $this->ID = ($this->getLastProductID($mysql) + 1);
            if(isset($this->imageName) && ($this->imageName == Product::DEFAULT_IMAGE_NAME))
                $imageSaved = true;
            else 
                $imageSaved = $this->saveGotImageToFilesystem($mysql);
            $nameIsBusy = $this->validateProductNameExistence($mysql);
            if($imageSaved && ($nameIsBusy == false)) {
                $this->writeProductData($mysql);
                $mysql->close();
                $this->sendData();
                exit;
            }
            else {
                $mysql->close();
                $this->unsetProductData();
                $this->sendData();
                exit;
            }
        }

        public function updateProduct(int $id): void {
            if($id) {
                foreach($this->mainFunctions_for_validationAdminForm as $function) {
                    $validated = $this->$function();
                    if(!$validated) {
                        $this->unsetProductData();
                        $this->sendData();
                        exit;
                    }
                }
                $this->description = $_POST['product_description'];
                if(!isset($this->imageName) || ($this->imageName != Product::DEFAULT_IMAGE_NAME)) {
                    foreach($this->additionalFunctions_for_validationAdminForm as $function) {
                        $validated = $this->$function();
                        if(!$validated) {
                            $this->unsetProductData();
                            $this->sendData();
                            exit;
                        }
                    }
                }

                try {
                    $mysql = new \mysqli(Page::MYSQL_SERVER, 'Admin', 'secret_of_Admin', 'Products');
                }
                catch(\mysqli_sql_exception $e) {
                    echo $e->getMessage();
                    exit;
                }
                if(isset($this->imageName) && ($this->imageName == Product::DEFAULT_IMAGE_NAME)) {
                    $this->imageName = $this->getImageName($mysql, $id);
                    $imageSaved = true;
                }
                else {
                    $this->deleteImageFromFilesystem($id);
                    $imageSaved = $this->saveGotImageToFilesystem($mysql, $id);
                }
                $nameIsBusy = $this->validateProductNameExistence($mysql, $id);
                if($imageSaved && ($nameIsBusy == false)) {
                    $this->rewriteProductData($mysql, $id);
                    $mysql->close();
                    $this->sendData();
                    exit;
                }
                else {
                    $mysql->close();
                    $this->unsetProductData();
                    $this->sendData();
                    exit;
                }
            }
        }

        public function deleteProduct(int $id): void {
            if($id) {
                $this->deleteImageFromFilesystem($id);
                $mysql = new \mysqli(Page::MYSQL_SERVER, 'Admin', 'secret_of_Admin', 'Products');
                $query = "DELETE FROM all_products WHERE ID=$id";
                $mysql->query($query);
            }
            $mysql->close();
            exit;
        }

        public function getAllProducts(): void {
            $GLOBALS['products'] = [];
            $mysql = new \mysqli(Page::MYSQL_SERVER, 'Visitor', 'secret_of_Visitor', 'Products');
            $query = "SELECT * FROM all_products";
            $result = $mysql->query($query);
            if($result->num_rows) {
                foreach($result as $row) {
                    $this->ID = (int)$row['ID'];
                    $this->name = $row['product_name'];
                    $this->type = $row['product_type'];
                    $this->imageName = $row['image_name'];
                    $GLOBALS['products'][] = clone $this;
                }
            }
            $mysql->close();
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

        private function saveGotImageToFilesystem(\mysqli $mysql, int $id = 0): bool {
            if($id)
                $filename = (string)$id;
            else 
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

        private function deleteImageFromFilesystem(int $id): void {
            $dirname = __DIR__ . '/../../../images/';
            $mysql = new \mysqli(Page::MYSQL_SERVER, 'Visitor', 'secret_of_Visitor', 'Products');
            $query = "SELECT image_name FROM all_products WHERE ID=$id";
            $result = $mysql->query($query);
            if($result->num_rows) {
                foreach($result as $row) {
                    $filename = $row['image_name'];
                }
            }
            else {
                echo 'Данные для указанного товара не обнаружены!';
                exit;
            }
            if($filename == Product::DEFAULT_IMAGE_NAME)
                return;
            $fullname = $dirname . $filename;
            if(file_exists($fullname)) 
                unlink($fullname);
        }

        // private function getImageError(): void {
        //     $this->error_message = match($_FILES['image']['error']) {
        //         6 => 'Отсутствует временная папка! Обратитесь к администратору сайта!',
        //         7 => 'Не удалось записать файл на диск! Обратитесь к администратору сайта!',
        //         8 => 'По неизвестным причинам сервер отстановил загрузку файла!',
        //     };
        // }





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
                switch($_FILES['image']['error']) {
                    case 1:
                        $this->error_message = "Размер принятого файла превысил максимально допустимый размер который может принять сервер!";
                        return false;
                        break;
                    case 2:
                        $this->error_message = "Размер принятого файла превысил допустимый для загрузки размер в {$_POST['MAX_FILE_SIZE']} байт";
                        return false;
                        break;
                    case 3:
                        $this->error_message = "Загружаемый файл был получен только частично!";
                        return false;
                        break;
                    case 6:
                    case 7:
                    case 8:
                        $this->error_message = "Ошибка в работе сервера, повторите попытку позднее!";
                        break;
                    case 4:
                    default:
                        $this->imageName = Product::DEFAULT_IMAGE_NAME;
                        return true;
                        break;
                }
            }
            else 
                return true;
        }

        private function validateProductNameExistence(\mysqli $mysql, int $id = 0): bool {
            if($id)
                $query = "SELECT product_name FROM all_products WHERE product_name='{$this->name}' && ID!=$id";
            else 
                $query = "SELECT product_name FROM all_products WHERE product_name='{$this->name}'";
            $result = $mysql->query($query);
            if($result->num_rows) {
                $this->error_message = "Товар с таким наименованием уже существует!";
                return true;
            }
            else 
                return false;
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

        private function rewriteProductData(\mysqli $mysql, int $id): void {
            $query = "UPDATE LOW_PRIORITY all_products SET 
                product_name = ?,
                product_type = ?,
                product_description = ?,
                image_name = ?
            WHERE ID=?";
            $stmt = $mysql->prepare($query);
            $stmt->bind_param(
                'ssssi',
                $this->name,
                $this->type,
                $this->description,
                $this->imageName,
                $id
            );
            $stmt->execute();
        }

        private function getLastProductID(\mysqli $mysql): int {
            $query = "SELECT max(ID) as last_ID FROM all_products";
            $result = $mysql->query($query);
            if($result->num_rows) {
                foreach($result as $row) {
                    $lastProductID = (int)$row['last_ID'];
                }
            }
            else 
                $lastProductID = 0;
            return $lastProductID;
        }

        private function getImageName(\mysqli $mysql, int $id): string {
            $query = "SELECT image_name FROM all_products WHERE ID=$id";
            $result = $mysql->query($query);
            foreach($result as $row['image_name']) {
                return $row['image_name']['image_name'];
            }
        }

        private function unsetProductData(): void {
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