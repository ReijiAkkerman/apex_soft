<?php
    namespace project\control\parent;

    use project\control\parent\interfaces\Auth;
    use project\control\parent\enum\Regex;

    define('EVERYWHERE', '%');

    abstract class Page implements Auth
    {
        public const MYSQL_SERVER = 'mysql';
        public const CONNECT_FROM = EVERYWHERE;
        public const HOSTING_USER = '';

        protected string $login;
        protected string $entered_password;
        protected string $hashed_password;
        protected string $password_from_DB;
        protected int $ID;
        protected int $creation_date;
        protected bool $admin;

        public string $name;
        public string $error_message;

        protected function constructor(): void
        {
            $this->admin = false;
            $this->isEnteredUser();
        }

        abstract public function view(): void;

        public function registrate(): void
        {
            $functions_for_fieldsValidation = [
                'validateLoginField',
                'validateNameField',
                'validatePasswordField'
            ];
            foreach ($functions_for_fieldsValidation as $function) {
                $validated = $this->$function();
                if (!$validated) {
                    $this->sendData();
                    exit;
                }
            }
            $this->hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $DB_has_been_used = true;
            try {
                $mysql = new \mysqli(Page::MYSQL_SERVER, Page::HOSTING_USER . 'Users', 'secret_of_Users', Page::HOSTING_USER . 'Users');
            } catch (\mysqli_sql_exception $e) {
                $this->init();
                $mysql = new \mysqli(Page::MYSQL_SERVER, Page::HOSTING_USER . 'Users', 'secret_of_Users', Page::HOSTING_USER . 'Users');
                $DB_has_been_used = false;
            }
            if ($DB_has_been_used) {
                if ($this->isExistentUser($mysql)) {
                    $this->error_message = 'login|Указанный логин уже используется!';
                    unset($this->name);
                    $this->sendData();
                    exit;
                }
            }
            $this->creation_date = time();
            $query = "INSERT INTO users(
                    login,
                    name,
                    password,
                    creation_date
                ) VALUES (
                    ?,
                    ?,
                    '{$this->hashed_password}',
                    {$this->creation_date}
                )";
            $stmt = $mysql->prepare($query);
            $stmt->bind_param('ss', $this->login, $this->name);
            $stmt->execute();
            $this->createUserCart();
            $query = "SELECT * FROM users WHERE login='{$this->login}'";
            $result = $mysql->query($query);
            foreach ($result as $row) {
                $ID = $row['ID'];
            }
            $confirmation = md5($this->login . $this->hashed_password . $this->creation_date);

            setcookie('id', $ID, time() + 3600 * 24 * 7, '/');
            setcookie('confirmation', $confirmation, time() + 3600 * 24 * 7, '/');
            $this->sendData();
        }

        public function login(): void
        {
            $functions_for_fieldsValidation = [
                'validateLoginField',
                'validatePasswordField'
            ];
            foreach ($functions_for_fieldsValidation as $function) {
                $validated = $this->$function();
                if (!$validated) {
                    $this->sendData();
                    exit;
                }
            }

            $mysql = new \mysqli(Page::MYSQL_SERVER, Page::HOSTING_USER . 'Users', 'secret_of_Users', Page::HOSTING_USER . 'Users');
            if ($this->isExistentUser($mysql, true)) {
                if (password_verify($this->entered_password, $this->password_from_DB)) {
                    $confirmation = md5($this->login . $this->password_from_DB . $this->creation_date);
                    setcookie('id', $this->ID, time() + 3600 * 24 * 7, '/');
                    setcookie('confirmation', $confirmation, time() + 3600 * 24 * 7, '/');
                    if($this->admin)
                        setcookie('is_admin', $this->admin, time() + 3600 * 24 * 7, '/');
                    $this->sendData();
                } else {
                    goto go_to_error_message;
                }
            } else {
                go_to_error_message:
                $this->error_message = 'login&password|Введен неверный логин или пароль!';
                unset($this->name);
                $this->sendData();
                exit;
            }
        }

        public function exit(): void {
            $this->unsetCookie();
        }





        /**
         * Проверяет активен ли пользователь и если нет удаляет все куки с браузера клиента
         */

        protected function isEnteredUser(): void
        {
            if (isset($_COOKIE['id']))
                if ($_COOKIE['id'])
                    if (isset($_COOKIE['confirmation']))
                        if ($_COOKIE['confirmation']) {
                            $this->ID = (int) $_COOKIE['id'];
                            $mysql = new \mysqli(Page::MYSQL_SERVER, Page::HOSTING_USER . 'Users', 'secret_of_Users', Page::HOSTING_USER . 'Users');
                            $query = "SELECT * FROM users WHERE ID={$this->ID}";
                            $result = $mysql->query($query);
                            if ($result->num_rows) {
                                foreach ($result as $row) {
                                    $this->login = $row['login'];
                                    $this->password_from_DB = $row['password'];
                                    $this->name = $row['name'];
                                    $this->creation_date = (int)$row['creation_date'];
                                    $this->admin = (bool)$row['admin_rights'];
                                }
                                $confirmation = md5($this->login . $this->password_from_DB . $this->creation_date);
                                if ($_COOKIE['confirmation'] != $confirmation) {
                                    unset($this->name);
                                    $this->unsetCookie();
                                }
                            } else
                                $this->unsetCookie();
                        } else
                            $this->unsetCookie();
                    else
                        $this->unsetCookie();
                else
                    $this->unsetCookie();
            else
                $this->unsetCookie();
        }





        private function init(): void
        {
            $functions_of_init = [
                'createUsersDB',
                'createProductsDB',
                'createCartsDB',
                'createOrdersDB'
            ];
            $mysql = new \mysqli(Page::MYSQL_SERVER, 'root', 'secret');
            foreach ($functions_of_init as $function) {
                $this->$function($mysql);
            }
            $mysql->close();
        }





        /**
         * Функции для работы init() метода
         */

        private function createUsersDB(\mysqli $mysql): void
        {
            $connect_from = Page::CONNECT_FROM;
            $hosting_user = Page::HOSTING_USER;
            $queries = [
                "CREATE DATABASE IF NOT EXISTS {$hosting_user}Users",
                "CREATE USER IF NOT EXISTS '{$hosting_user}Users'@'$connect_from' IDENTIFIED WITH mysql_native_password BY 'secret_of_Users'",
                "GRANT SELECT, INSERT ON {$hosting_user}Users.* TO '{$hosting_user}Users'@'$connect_from'",
                "USE {$hosting_user}Users",
                'CREATE TABLE IF NOT EXISTS users(
                        ID SERIAL,
                        login VARCHAR(255) UNIQUE NOT NULL,
                        name VARCHAR(255) NOT NULL,
                        password VARCHAR(255) NOT NULL,
                        creation_date INT NOT NULL,
                        admin_rights BOOLEAN DEFAULT 0 NOT NULL
                    )'
            ];
            foreach ($queries as $query) {
                $mysql->query($query);
            }
        }

        private function createProductsDB(\mysqli $mysql): void {
            $connect_from = Page::CONNECT_FROM;
            $hosting_user = Page::HOSTING_USER;
            $queries = [
                "CREATE DATABASE IF NOT EXISTS {$hosting_user}Products",
                "CREATE USER IF NOT EXISTS '{$hosting_user}Admin'@'$connect_from' IDENTIFIED WITH mysql_native_password BY 'secret_of_Admin'",
                "USE Products",
                'CREATE TABLE IF NOT EXISTS all_products(
                    productID SERIAL,
                    product_name VARCHAR(255) UNIQUE NOT NULL,
                    product_type VARCHAR(255) NOT NULL,
                    product_description TEXT,
                    product_articul VARCHAR(255) UNIQUE NOT NULL,
                    product_price INT NOT NULL,
                    image_name TEXT NOT NULL
                )',
                "GRANT SELECT, INSERT, UPDATE, DELETE ON {$hosting_user}Products.* TO '{$hosting_user}Admin'@'$connect_from'",
                "CREATE USER IF NOT EXISTS '{$hosting_user}Visitor'@'$connect_from' IDENTIFIED WITH mysql_native_password BY 'secret_of_Visitor'",
                "GRANT SELECT ON {$hosting_user}Products.all_products TO '{$hosting_user}Visitor'@'$connect_from'"
            ];
            foreach($queries as $query) {
                $mysql->query($query);
            }
        }

        private function createCartsDB(\mysqli $mysql): void {
            $connect_from = Page::CONNECT_FROM;
            $hosting_user = Page::HOSTING_USER;
            $queries = [
                "CREATE DATABASE IF NOT EXISTS {$hosting_user}Carts",
                "CREATE USER IF NOT EXISTS '{$hosting_user}Cart'@'$connect_from' IDENTIFIED WITH mysql_native_password BY 'secret_of_Cart'",
                "GRANT SELECT, INSERT, UPDATE, DELETE, CREATE ON {$hosting_user}Carts.* TO '{$hosting_user}Cart'@'$connect_from'",
                "GRANT REFERENCES ON {$hosting_user}Products.all_products TO '{$hosting_user}Cart'@'$connect_from'"
            ];
            foreach($queries as $query) {
                $mysql->query($query);
            }
        }

        private function createOrdersDB(\mysqli $mysql): void {
            $connect_from = Page::CONNECT_FROM;
            $hosting_user = Page::HOSTING_USER;
            $queries = [
                "CREATE DATABASE IF NOT EXISTS {$hosting_user}Orders",
                "CREATE USER IF NOT EXISTS '{$hosting_user}Orders'@'$connect_from' IDENTIFIED WITH mysql_native_password BY 'secret_of_Orders'",
                "USE Orders",
                "CREATE TABLE all_orders(
                    ID BIGINT UNSIGNED NOT NULL,
                    orderID SERIAL,
                    order_time INT,
                    order_status VARCHAR(255),
                    productsIDs TEXT,
                    recipient VARCHAR(255),
                    recipient_email VARCHAR(255),
                    recipient_phone VARCHAR(20)
                    -- FOREIGN KEY (ID) REFERENCES Users.users(ID)
                )",
                "GRANT SELECT, INSERT, UPDATE, DELETE, CREATE ON {$hosting_user}Orders.all_orders TO '{$hosting_user}Orders'@'$connect_from'"
            ];
            foreach($queries as $query) {
                $mysql->query($query);
            }
        }





        /**
         * Методы отвечающие за создание таблиц для новых пользователей 
         */

        private function createUserCart(): void {
            $hosting_user = Page::HOSTING_USER;
            $mysql = new \mysqli(Page::MYSQL_SERVER, Page::HOSTING_USER . 'Cart', 'secret_of_Cart', Page::HOSTING_USER . 'Carts');
            $query = "CREATE TABLE {$this->login}(
                productID BIGINT UNSIGNED NOT NULL,
                amount INT NOT NULL
                -- FOREIGN KEY(productID) REFERENCES {$hosting_user}Products.all_products(productID)
            )";
            $mysql->query($query);
            $mysql->close();
        }





        /**
         * Функции для проверки правильности заполнения полей
         */

        private function validateLoginField(): bool
        {
            if ($_POST['login']) {
                $regex = Regex::login->value;
                $result = preg_match($regex, $_POST['login']);
                if ($result === 1) {
                    $this->login = $_POST['login'];
                    return true;
                } else if ($result === 0) {
                    $this->error_message = 'login|Введенный логин не соответствует допустимому шаблону!';
                    return false;
                } else {
                    $this->error_message = 'Произошла ошибка во время проверки логина!';
                    return false;
                }
            } else if ($_POST['login'] === '0') {
                $this->error_message = 'login|Введенный логин не соответствует допустимому шаблону!';
                return false;
            } else {
                $this->error_message = 'login|Логин не введен!';
                return false;
            }
        }

        private function validateNameField(): bool
        {
            if ($_POST['name']) {
                $regex = Regex::name->value;
                $result = preg_match($regex, $_POST['name']);
                if ($result === 1) {
                    $this->name = $_POST['name'];
                    return true;
                } else if ($result === 0) {
                    $this->error_message = 'name|Введенное имя не соответствует допустимому шаблону!';
                    return false;
                } else {
                    $this->error_message = 'Произошла ошибка во время проверки имени!';
                    return false;
                }
            } else if ($_POST['name'] === '0') {
                $this->error_message = 'name|Введенное имя не соответствует допустимому шаблону!';
                return false;
            } else {
                $this->error_message = 'name|Имя не введено!';
                return false;
            }
        }

        private function validatePasswordField(): bool
        {
            if ($_POST['password']) {
                $regex = Regex::password->value;
                $result = preg_match($regex, $_POST['password']);
                if ($result === 1) {
                    $this->entered_password = $_POST['password'];
                    return true;
                } else if ($result === 0) {
                    $this->error_message = 'password|Введенный пароль не соответствует допустимому шаблону!';
                    return false;
                } else {
                    $this->error_message = 'Произошла ошибка во время проверки пароля!';
                    return false;
                }
            } else if ($_POST['password'] === '0') {
                $this->error_message = 'password|Введенный пароль не соответствует допустимому шаблону!';
                return false;
            } else {
                $this->error_message = 'password|Пароль не введен!';
                return false;
            }
        }





        /**
         * Вспомогательные функции 
         */

        private function isExistentUser(\mysqli $mysql, bool $password_needed = false): bool
        {
            if($password_needed)
                $query = "SELECT * FROM users WHERE BINARY login='{$this->login}'";
            else 
                $query = "SELECT * FROM users WHERE login='{$this->login}'";
            $result = $mysql->query($query);

            if ($result->num_rows) {
                if ($password_needed) {
                    foreach ($result as $row) {
                        $this->password_from_DB = $row['password'];
                        $this->name = $row['name'];
                        $this->ID = (int)$row['ID'];
                        $this->creation_date = (int)$row['creation_date'];
                        $this->admin = (bool)$row['admin_rights'];
                    }
                }
                return true;
            } else
                return false;
        }

        private function unsetCookie(): void
        {
            setcookie('id', '', time() - 1, '/');
            setcookie('confirmation', '', time() - 1, '/');
            setcookie('is_admin', '', time() - 1, '/');
        }

        protected function sendData(): void
        {
            $data = json_encode($this, JSON_UNESCAPED_UNICODE);
            echo $data;
        }
    }