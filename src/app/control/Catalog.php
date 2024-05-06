<?php
    namespace project\control;

    use project\control\parent\Page;
    use project\control\traits\View;

    use project\model\AdminForm;
    use project\model\interfaces\iAdminForm;

    final class Catalog extends Page implements iAdminForm {
        public string $error_message;

        public function __construct() {
            $this->constructor();
        }

        use View;

        public function createProduct(): void {
            $access_permitted = $this->checkAccessRights();
            if($access_permitted) 
                (new AdminForm)->createProduct();
            else {
                $this->sendData();
                exit;
            }
        }

        public function updateProduct(): void {
            $access_permitted = $this->checkAccessRights();
            if($access_permitted) 
                (new AdminForm)->updateProduct();
            else {
                $this->sendData();
                exit;
            }
        }

        public function deleteProduct(): void {
            $access_permitted = $this->checkAccessRights();
            if($access_permitted) 
                (new AdminForm)->deleteProduct();
            else {
                $this->sendData();
                exit;
            }
        }





        /**
         * Вспомогательные функции
         */

        private function checkAccessRights(): bool {
            if(1)
                return true;
            else 
                return false;
        }
    }