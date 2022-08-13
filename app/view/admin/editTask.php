<?= view('common/header.php') ?>

<main>
    <form action="<?= url('/task/edit?id=' . $task['task_id']) ?>" method="POST">
        <div class="mb-2">
            <label for="fieldUsername" class="form-label">Имя пользователя:</label>
            <input disabled type="text" class="form-control" id="fieldUsername" value="<?= $task['user_name'] ?>">
        </div>
        <div class="mb-2">
            <label for="fieldEmail" class="form-label">Email:</label>
            <input disabled type="email" class="form-control" id="fieldEmail" value="<?= $task['email'] ?>">
        </div>
        <div class="mb-2">
            <label for="fieldContent" class="form-label">Задание</label>
            <textarea class="form-control" name="content" id="fieldContent" rows="3"><?= $task['content'] ?></textarea>
        </div>
        <div class="mb-2">
            <input class="form-check-input" name="status" type="checkbox" <?= $task['status'] ? 'checked' : '' ?>
                   id="fieldStatus">
            <label for="fieldStatus" class="form-label">Выполнено</label>
        </div>
        <button class="btn btn-primary mt-3">Сохранить</button>
    </form>

    <?= view('common/error_alert.php', ['error' => $error ?? null]) ?>
</main>

<?= view('common/footer.php') ?>
