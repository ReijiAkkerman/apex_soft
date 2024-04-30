<?php
    namespace project\control;

    use project\control\parent\Page;
    use project\control\traits\View;

    class Product extends Page {
        public function __construct() {
            $this->constructor();
        }

        use View;
    }