<?php
    namespace project\control;

    use project\control\parent\Page;
    use project\control\traits\View;

    use project\model\Products;

    final class Catalog extends Page {
        public string $error_message;

        public function __construct() {
            $this->constructor();
        }

        use View;
    }