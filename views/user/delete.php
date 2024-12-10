<?php
include '../template/header.php';
?>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar Usuario</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="userId" class="form-label">ID del Usuario:</label>
                <input type="text" id="userId" name="userId" value="<?= htmlspecialchars($user->user_id) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="userName" class="form-label">Nombre:</label>
                <input type="text" id="userName" name="userName" value="<?= htmlspecialchars($user->name) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Correo:</label>
                <input type="text" id="userEmail" name="userEmail" value="<?= htmlspecialchars($user->email) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="userUsername" class="form-label">Nombre de Usuario:</label>
                <input type="text" id="userUsername" name="userUsername" value="<?= htmlspecialchars($user->username) ?>" class="form-control" disabled>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                <label class="form-check-label" for="confirmDelete">
                    He leído que esta acción no es reversible.
                </label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger" id="deleteButton" disabled>Eliminar</button>
                <a href="../user/user.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('confirmDelete').addEventListener('change', function() {
        document.getElementById('deleteButton').disabled = !this.checked;
    });
</script>

<?php include '../template/footer.php'; ?>
