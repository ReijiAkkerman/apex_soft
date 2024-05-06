<?php
    namespace project\model;

    use project\control\parent\Page;
    use project\model\enum\Regex;
    use project\model\interfaces\iAdminForm;

    class AdminForm implements iAdminForm {
        private string $title;
        private string $themeTitle;
        private string $themeDescrition;
        private string $imageFormat;

        public string $error_message;

        private array $functions_for_validationAdminForm;

        public function __construct() {
            $this->functions_for_validationAdminForm = [
                'validateTitle',
                'validateThemeTitle',
                'validateThemeDescription',
                'checkImageErrors',
                'validateImageFormat'
            ];

        }

        public function createProduct(): void {
            foreach($this->functions_for_validationAdminForm as $function) {
                $validated = $this->$function();
                if(!$validated) {
                    $this->sendData();
                    exit;
                }
            }

            $dirname = __DIR__ . '/../../../images/';
            $filename = (string)($this->getProductID() + 1);
            $full_path = $dirname . $filename . '.' . $this->imageFormat;
            if(move_uploaded_file($_FILES['image']['tmp_name'], $full_path)) {
                echo exec('whoami');
                exit;
            }
            else {
                $this->getImageError();
                $this->sendData();
                exit;
            }
        }

        public function updateProduct(): void {

        }

        public function deleteProduct(): void {

        }





        /**
         * Методы для проверки получаемых данных
         */

        private function validateTitle(): bool {
            if($_POST['title']) {
                $regex = Regex::title->value;
                $result = preg_match($regex, $_POST['title']);
                if($result === 1) {
                    $this->title = $_POST['title'];
                    return true;
                }
                else if($result === 0) {
                    $this->error_message = 'title|Наименование товара не соответствует допустимому шаблону!';
                    return false;
                }
                else {
                    $this->error_message = 'Произошла ошибка во время проверки наименования товара!';
                    return false;
                }
            }
            else if($_POST['title'] === '0') {
                $this->error_message = 'title|Наименование товара не соответствует допустимому шаблону!';
                return false;
            }
            else {
                $this->error_message = 'title|Наименование товара отсутствует!';
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

        private function validateThemeTitle(): bool {
            if($_POST['theme_title']) {
                $regex = Regex::theme_title->value;
                $result = preg_match($regex, $_POST['theme_title']);
                if($result === 1) {
                    $this->themeTitle = $_POST['theme_title'];
                    return true;
                }
                else if($result === 0) {
                    $this->error_message = 'theme_title|Наиманование темы не соответствует допустимому шаблону!';
                    return false;
                }
                else {
                    $this->error_message = 'Произошла ошибка во время проверки наименования темы!';
                    return false;
                }
            }
            else if($_POST['theme_title'] === '0') {
                $this->error_message = 'theme_title|Наиманование темы не соответствует допустимому шаблону!';
                return false;
            }
            else {
                $this->error_message = 'theme_title|Наиманование темы отсутствует!';
                return false;
            }
        }

        private function validateThemeDescription(): bool {
            if($_POST['theme_description']) {
                $regex = Regex::theme_description->value;
                $result = preg_match($regex, $_POST['theme_description']);
                if($result === 1) {
                    $this->themeDescription = $_POST['theme_description'];
                    return true;
                }
                else if($result === 0) {
                    $this->error_message = 'theme_description|Описание товара на тему {} не соответствует допустимому шаблону!';
                    return false;
                }
                else {
                    $this->error_message = 'Произошла ошибка во время проверки описания товара на тему {}!';
                    return false;
                }
            }
            else if($_POST['theme_description'] === '0') {
                $this->error_message = 'theme_description|Описание товара на тему {} не соответствует допустимому шаблону!';
                return false;
            }
            else {
                $this->error_message = 'theme_description|Описание товара на тему {} отсутствует!';
                return false;
            }
        }





        /**
         * Вспомогательные функции
         */

        private function getProductID(): int {
            $mysql = new \mysqli(Page::MYSQL_SERVER, 'Visitor', 'secret_of_Visitor', 'Products');
            $query = "SELECT COUNT(*) as products_amount FROM all_products";
            $result = $mysql->query($query);
            foreach($result as $row) {
                $products_amount = $row['products_amount'];
            }
            return $products_amount;
        }

        private function getImageError(): void {
            $this->error_message = match($_FILES['image']['error']) {
                6 => 'Отсутствует временная папка! Обратитесь к администратору сайта!',
                7 => 'Не удалось записать файл на диск! Обратитесь к администратору сайта!',
                8 => 'По неизвестным причинам сервер отстановил загрузку файла!',
                default => 'Фатальная ошибка!'
            };
        }

        private function sendData(): void {
            $data = json_encode($this, JSON_UNESCAPED_UNICODE);
            echo $data;
        }
    }