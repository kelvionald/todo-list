<?php

namespace App\Controller;


use App\Model\Task;
use Exception;

class HomeController
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    public function index()
    {
        $page = getRequestParam('page', 1);
        $sortField = getRequestParam('sort_field', 'status');
        $sortOrder = getRequestParam('sort_order', 'ASC');

        shouldBeInt($page);
        shouldBeGrater($page, 0);
        shouldBeInArray($sortField, ['user_name', 'email', 'status']);
        shouldBeInArray($sortOrder, ['ASC', 'DESC']);

        $taskResult = $this->taskModel->getByParams([
            'pagination' => [
                'page' => $page,
                'count' => 3,
            ],
            'sorting' => [
                'field' => $sortField,
                'order' => $sortOrder,
            ],
        ]);

        $sortUrlParams = 'sort_field=' . $sortField . '&sort_order=' . $sortOrder;

        return view('front/home.php', compact(
            'taskResult',
            'sortField',
            'sortOrder',
            'sortUrlParams',
        ));
    }

    public function addTaskView()
    {
        return view('front/addTask.php');
    }

    public function saveTask()
    {
        $userName = getRequestParam('user_name', '');
        $email = getRequestParam('email', '');
        $content = getRequestParam('content', '');

        try {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                throw new Exception('Поле "Email" должно быть заполнено.');
            }
            shouldBeFilled($userName, 'Поле "Имя пользователя" должно быть заполнено.');
            shouldBeFilled($content, 'Поле "Задание" должно быть заполнено.');
        } catch (Exception $exception) {
            $error = $exception->getMessage();
            return view('front/addTask.php', compact('userName', 'email', 'content', 'error'));
        }

        $this->taskModel->insert([
            'user_name' => addslashes($userName),
            'email' => addslashes($email),
            'content' => addslashes($content),
        ]);

        $_SESSION['message'] = 'Задание успешно добавлено.';

        header('Location: ' . url('/'));
    }
}
