<?php

namespace App\Model;


class Task
{
    public function getByParams(array $params): array
    {
        $currentPageNum = $params['pagination']['page'] - 1;
        $offset = $currentPageNum * $params['pagination']['count'];
        $count = $params['pagination']['count'];
        $orderByField = $params['sorting']['field'];
        $orderByOrder = $params['sorting']['order'];

        $rows = dbSelect("
            SELECT *
            FROM `task`
            ORDER BY `$orderByField` $orderByOrder
            LIMIT $offset, $count
        ");

        $rowsCountResult = dbSelect("
            SELECT COUNT(`task_id`) AS `rows_count`
            FROM `task`
        ");
        $totalPageCount = ceil($rowsCountResult[0]['rows_count'] / $count);

        $currentPageNum++;

        return compact('rows', 'currentPageNum', 'totalPageCount');
    }

    public function insert(array $data)
    {
        dbInsert('task', $data);
    }

    public function getById($taskId)
    {
        $rows = dbSelect("
            SELECT *
            FROM `task`
            WHERE `task_id` = $taskId
            LIMIT 1
        ");
        return $rows[0];
    }

    public function update($taskId, array $data)
    {
        $set = [];
        foreach ($data as $fieldName => $value) {
            $set[] = "`$fieldName` = '$value'";
        }
        $set = implode(',', $set);
        dbQuery("
            UPDATE `task`
            SET $set
            WHERE `task_id` = $taskId
        ");
    }
}
