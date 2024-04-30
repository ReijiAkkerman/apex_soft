<?php
    namespace project\control;

    use project\control\parent\Page;
    use project\control\traits\View;

    class Cart extends Page {
        public function __construct() {
            $this->constructor();
        }

        use View;
    }