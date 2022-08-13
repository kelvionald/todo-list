<?php

function dbConnection()
{
    static $dbConnection;
    if (is_null($dbConnection)) {
        $host = env('DATABASE_HOST');
        $dbname = env('DATABASE_NAME');
        $user = env('DATABASE_USER');
        $password = env('DATABASE_PASSWORD');
        $dbConnection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $dbConnection;
}

function dbSelect($sql)
{
    $query = dbConnection()->query($sql);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $rows = [];
    while ($row = $query->fetch()) {
        $rows[] = $row;
    }
    return $rows;
}

function dbQuery($sql)
{
    $query = dbConnection()->prepare($sql);
    $query->execute();
}

function dbInsert($tableName, $data)
{
    $fields = array_map(function ($fieldName) {
        return "`$fieldName`";
    }, array_keys($data));
    $fields = implode(',', $fields);

    $values = array_map(function ($value) {
        return "'$value'";
    }, array_values($data));
    $values = implode(',', $values);

    dbQuery("INSERT INTO `$tableName` ($fields) values ($values)");
}
