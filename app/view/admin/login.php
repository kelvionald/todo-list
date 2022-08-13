<?= view('common/header.php') ?>

<main>
    <form action="<?= url('/admin') ?>" method="POST">
        <div class="mb-2">
            <label for="fieldUsername" class="form-label">Логин:</label>
            <input type="text" name="login" class="form-control" id="fieldUsername" value="<?= $login ?? '' ?>">
        </div>
        <div class="mb-2">
            <label for="fieldEmail" class="form-label">Пароль:</label>
            <input type="text" name="password" class="form-control" id="fieldEmail" value="<?= $password ?? '' ?>">
        </div>
        <button class="btn btn-primary mt-3">Войти</button>
    </form>

    <?= view('common/error_alert.php', ['error' => $error ?? null]) ?>
</main>

<?= view('common/footer.php') ?>
