<?= view('common/header.php') ?>

<main>
    <form action="<?= url('/task/add') ?>" method="POST">
        <div class="mb-2">
            <label for="fieldUsername" class="form-label">Имя пользователя:</label>
            <input type="text" name="user_name" class="form-control" id="fieldUsername" value="<?= $userName ?? '' ?>">
        </div>
        <div class="mb-2">
            <label for="fieldEmail" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" id="fieldEmail" value="<?= $email ?? '' ?>">
        </div>
        <div class="mb-2">
            <label for="fieldContent" class="form-label">Задание</label>
            <textarea class="form-control" name="content" id="fieldContent" rows="3"><?= $content ?? '' ?></textarea>
        </div>
        <button class="btn btn-primary mt-3">Сохранить</button>
    </form>

    <?= view('common/error_alert.php', ['error' => $error ?? null]) ?>
</main>

<?= view('common/footer.php') ?>
