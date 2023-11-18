<?php
class DbBox extends AbstractBox {
    private static $instance;
    private $dbConnection;

    private function __construct() {
        // Приватный конструктор для предотвращения создания новых экземпляров
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function save($data) {
        if ($this->dbConnection) {
            // Реализация сохранения данных в базу
            $query = "INSERT INTO table_name (column1, column2, column3) VALUES ('".$data['value1']."', '".$data['value2']."', '".$data['value3']."')";
            if ($this->dbConnection->query($query) === TRUE) {
                echo "Record inserted successfully";
            } else {
                echo "Error inserting record: " . $this->dbConnection->error;
            }
        } else {
            throw new Exception("Database connection is not established");
        }
    }

    public function load($id) {
        if ($this->dbConnection) {
            // Реализация загрузки данных из базы
            $query = "SELECT * FROM table_name WHERE id = '".$id."'";
            $result = $this->dbConnection->query($query);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    return $row;
                }
            } else {
                // Обработка случая, когда данные не найдены
                return null;
            }
        } else {
            throw new Exception("Database connection is not established");
        }
    }

    public function connect($host, $username, $password, $database) {
        // Реализация подключения к базе данных
        $this->dbConnection = new mysqli($host, $username, $password, $database);

        if ($this->dbConnection->connect_error) {
            throw new Exception("Connection failed: " . $this->dbConnection->connect_error);
        }
    }
}
