<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ToDo List</title>
    <link href="<?= url('/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>
<div class="container py-3">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="/">Задания</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="/task/add">Добавить задание</a>
                <?php if (isset($sessionLogin)): ?>
                    <form action="<?= url('/admin/logout') ?>" method="POST">
                        <button class="btn btn-primary">Выйти</button>
                    </form>
                <?php else: ?>
                    <a class="py-2 text-dark text-decoration-none" href="/admin">Админка</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
