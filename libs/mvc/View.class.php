<?php

require_once './libs/smarty/Smarty.class.php';
require_once './config/config.php';

class View {

    protected Smarty $smarty;

    public function __construct() {
        $this->smarty = new Smarty();
    }

    public function render(string $templateName, array $variables = []): void {
        foreach ($variables as $name => $value) {
            $this->assign($name, $value);
        }
        $this->display($templateName);
    }

    public function renderError(Exception $e): void {
        $this->assign('error', $e->getMessage());
        $this->display('page_error');
        die();
    }

    private function assign(string $name, $var): void {
        $this->smarty->assign($name, $var);
    }

    private function display(string $templateName): void {
        $this->smarty->display(TEMPLATES_DIR . $templateName . '.tpl');
    }
}