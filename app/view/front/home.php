<?= view('common/header.php') ?>

<main>
    <?php if (isset($successMessage)): ?>
        <div class="alert alert-success mb-3" role="alert">
            <?= $successMessage ?>
        </div>
    <?php endif; ?>
    <?= view('common/error_alert.php', ['error' => $error ?? null]) ?>

    <form action="<?= url('/') ?>">
        <div class="mb-2">
            <label for="sort_field" class="form-label">Сортировка по полю:</label>
            <select class="form-select" id="sort_field" name="sort_field">
                <option value="user_name" <?= $sortField == 'user_name' ? 'selected' : '' ?>>Имя</option>
                <option value="email" <?= $sortField == 'email' ? 'selected' : '' ?>>Email</option>
                <option value="status" <?= $sortField == 'status' ? 'selected' : '' ?>>Статус</option>
            </select>
        </div>
        <div class="mb-2">
            <label for="sort_order" class="form-label">Порядок:</label>
            <select class="form-select" id="sort_order" name="sort_order">
                <option value="ASC" <?= $sortOrder == 'ASC' ? 'selected' : '' ?>>По возрастанию</option>
                <option value="DESC" <?= $sortOrder == 'DESC' ? 'selected' : '' ?>>По убыванию</option>
            </select>
        </div>
        <button class="btn btn-primary mt-2">Применить</button>
    </form>
    <div class="mt-2">
        <?php foreach ($taskResult['rows'] as $task): ?>
            <div class="card mb-2" style="width: 18rem;">
                <div class="card-body">
                    <h6 class="card-title">Задание #<?= $task['task_id'] ?></h6>
                    <div><b>Имя:</b> <?= htmlspecialchars($task['user_name']) ?></div>
                    <div><b>Email:</b> <?= htmlspecialchars($task['email']) ?></div>
                    <div><b>Статус:</b>
                        <?php if ($task['status']): ?>
                            <span class="badge text-bg-success">Выполнено</span>
                        <?php else: ?>
                            <span class="badge text-bg-warning">Активный</span>
                        <?php endif; ?>
                    </div>
                    <p class="card-text"><?= htmlspecialchars($task['content']) ?></p>
                    <?php if (isset($sessionLogin)): ?>
                        <a class="btn btn-primary"
                           href="<?= url('/task/edit?id=' . $task['task_id']) ?>">Редактировать</a>
                    <?php endif; ?>
                </div>
            </div>
        <? endforeach; ?>
    </div>

    <?php if ($taskResult['totalPageCount'] > 1): ?>
        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $taskResult['currentPageNum'] == 1 ? 'disabled' : '' ?>">
                        <a class="page-link"
                           href="<?= url('/?page=' . ($taskResult['currentPageNum'] - 1) . '&' . $sortUrlParams) ?>"
                           aria-label="Предыдущий">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item <?= $taskResult['totalPageCount'] == $taskResult['currentPageNum'] ? 'disabled' : '' ?>">
                        <a class="page-link"
                           href="<?= url('/?page=' . ($taskResult['currentPageNum'] + 1) . '&' . $sortUrlParams) ?>"
                           aria-label="Следующий">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php endif; ?>
</main>

<?= view('common/footer.php') ?>
