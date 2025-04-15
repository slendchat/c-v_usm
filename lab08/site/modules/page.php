<?php
class Page {
    private $template;

    public function __construct($template) {
        if (!file_exists($template)) {
            die("Template file not found: " . $template);
        }
        $this->template = $template;
    }

    public function Render($data) {
        $output = file_get_contents($this->template);
        foreach ($data as $key => $value) {
            $output = str_replace("{{" . $key . "}}", $value, $output);
        }
        echo $output;
    }
}
