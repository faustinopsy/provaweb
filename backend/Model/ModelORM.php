<?php
namespace App\Model;
use ReflectionClass;
use ReflectionProperty;
class ModelORM {

private $conn;

public function __construct($conn) {
    $this->conn = $conn;
}

public function createTableFromModel($model) {
    
    $reflection = new ReflectionClass($model);
    $properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);
    $columns = [];
    $placeholders = [];
    foreach ($properties as $property) {
        $columnName = $property->getName();
        if ($columnName == "id") {
            $columns[] = "{$columnName} INT AUTO_INCREMENT PRIMARY KEY";
        } else {
            $columns[] = "{$columnName} VARCHAR(255)";
            $placeholders[] = ":{$columnName}";
        }
    }
    
    $tableName = str_replace('App','',str_replace('Model','',str_replace('\\','',$reflection->getName())));
    $columnsSql = implode(', ', $columns);
    $createTableSql = "CREATE TABLE IF NOT EXISTS {$tableName} ({$columnsSql})";
    $this->conn->exec($sql);

    $this->createInsertProcedure($tableName, $columns, $placeholders);
    $this->createUpdateProcedure($tableName, $columns);
    $this->createDeleteProcedure($tableName);
}

private function createInsertProcedure($tableName, $columns, $placeholders) {
    $columnsWithoutId = array_filter($columns, function($col) { return !str_starts_with($col, "id"); });
    $columnsStr = implode(', ', $columnsWithoutId);
    $placeholdersStr = implode(', ', $placeholders);

    $sql = "
    DELIMITER //
    CREATE IF NOT EXIST PROCEDURE Insert{$tableName}({$columnsStr})
    BEGIN
        INSERT INTO {$tableName} ({$columnsStr}) VALUES ({$placeholdersStr});
    END //
    DELIMITER ;
    ";

    $this->conn->exec($sql);
}

private function createUpdateProcedure($tableName, $columns) {
    $columnsWithoutId = array_filter($columns, function($col) { return !str_starts_with($col, "id"); });
    $updateStatements = array_map(function($col) { return "{$col} = :{$col}"; }, $columnsWithoutId);
    $updateStr = implode(', ', $updateStatements);

    $sql = "
    DELIMITER //
    CREATE IF NOT EXIST PROCEDURE Update{$tableName}(id INT, {$updateStr})
    BEGIN
        UPDATE {$tableName} SET {$updateStr} WHERE id = :id;
    END //
    DELIMITER ;
    ";

    $this->conn->exec($sql);
}

private function createDeleteProcedure($tableName) {
    $sql = "
    DELIMITER //
    CREATE IF NOT EXIST PROCEDURE Delete{$tableName}(id INT)
    BEGIN
        DELETE FROM {$tableName} WHERE id = :id;
    END //
    DELIMITER ;
    ";

    $this->conn->exec($sql);
}
}