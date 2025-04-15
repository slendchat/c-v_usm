<?php
class Database {
    private $pdo;

    public function __construct($path) {
        try {
            $this->pdo = new PDO('sqlite:' . $path);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("error db creation: " . $e->getMessage());
        }
    }

    public function Execute($sql) {
        try {
            return $this->pdo->exec($sql);
        } catch (PDOException $e) {
            echo "error executing query: " . $e->getMessage();
            return false;
        }
    }

    public function Fetch($sql) {
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "error executing query: " . $e->getMessage();
            return false;
        }
    }

    public function Create($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ':' . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "error creating record: " . $e->getMessage();
            return false;
        }
    }

    public function Read($table, $id) {
        $sql = "SELECT * FROM $table WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "error reading record: " . $e->getMessage();
            return false;
        }
    }

    public function Update($table, $id, $data) {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = :$column";
        }
        $setString = implode(", ", $set);
        $sql = "UPDATE $table SET $setString WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($data as $column => $value) {
                $stmt->bindValue(':' . $column, $value);
            }
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "error updating record: " . $e->getMessage();
            return false;
        }
    }

    public function Delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "error deleting record: " . $e->getMessage();
            return false;
        }
    }

    public function Count($table) {
        $sql = "SELECT COUNT(*) as count FROM $table";
        try {
            $stmt = $this->pdo->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            echo "error getting record count: " . $e->getMessage();
            return false;
        }
    }
}
