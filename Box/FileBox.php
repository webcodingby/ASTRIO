<?php
class FileBox extends AbstractBox {
    private static $instance;

    private function __construct() {
        // Приватный конструктор для предотвращения создания новых экземпляров
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function save()
    {
        $data = serialize($this->data);
        file_put_contents('data.txt', $data);
    }

    public function load()
    {
        if (file_exists('data.txt')) {
            $data = file_get_contents('data.txt');
            $this->data = unserialize($data);
        }
    }
}
