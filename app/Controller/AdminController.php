<?php

namespace App\Controller;


use App\Model\Task;
use Exception;

class AdminController
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    public function loginView()
    {
        return view('admin/login.php');
    }

    public function login()
    {
        $login = getRequestParam('login', '');
        $password = getRequestParam('password', '');

        try {
            shouldBeFilled($login, 'Поле "Логин" обязательно для заполнения.');
            shouldBeFilled($password, 'Поле "Пароль" обязательно для заполнения.');
        } catch (Exception $exception) {
            $error = $exception->getMessage();
            return view('admin/login.php', compact('login', 'password', 'error'));
        }

        if ($login === env('ADMIN_LOGIN') && $password === env('ADMIN_PASSWORD')) {
            $_SESSION['login'] = $login;
            header('Location: ' . url('/'));
        } else {
            $error = 'Неправильные реквизиты доступа.';
            return view('admin/login.php', compact('login', 'password', 'error'));
        }
    }

    public function logout()
    {
        shouldBeAdmin();

        unset($_SESSION['login']);
        header('Location: ' . url('/'));
    }

    public function updateTaskView()
    {
        shouldBeAdmin();

        $taskId = getRequestParam('id', '');

        $task = $this->getTaskSafe($taskId);

        return view('admin/editTask.php', compact('task'));
    }

    public function updateTask()
    {
        shouldBeAdmin();

        $taskId = getRequestParam('id', '');

        $content = getRequestParam('content', '');
        $status = getRequestParam('status', null);

        try {
            shouldBeInt($taskId);
            shouldBeGrater($taskId, 0);
            shouldBeFilled($content, 'Поле "Задание" должно быть заполнено.');
            shouldBeInArray($status, ['on', null], 'Поле "Выполнено" некорректно заполнено.');
        } catch (Exception $exception) {
            $task = $this->getTaskSafe($taskId);
            $error = $exception->getMessage();
            return view('front/editTask.php', compact('task', 'error'));
        }

        $this->taskModel->update($taskId, [
            'content' => addslashes($content),
            'status' => $status == 'on' ? 1 : 0,
        ]);

        header('Location: ' . url('/'));
        return '';
    }

    private function getTaskSafe($taskId): array
    {
        shouldBeInt($taskId);
        shouldBeGrater($taskId, 0);

        return $this->taskModel->getById($taskId);
    }
}
