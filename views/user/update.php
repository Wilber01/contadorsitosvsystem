<?php
include '../template/header.php';
?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center">Actualizar usuario</h2>
        <form action="" method="POST" name="frmUpdate" novalidate>
            <!-- Nombre -->
            <div class="mb-3">
                <label for="user_name" class="form-label">Nombre:</label>
                <input type="text" id="user_name" name="name" value="<?= htmlspecialchars($users->name) ?>" class="form-control" required minlength="3" maxlength="50">
                <div class="invalid-feedback">Por favor ingrese un nombre válido.</div>
            </div>

            <!-- Correo -->
            <div class="mb-3">
                <label for="user_email" class="form-label">Correo:</label>
                <input type="email" id="user_email" name="email" value="<?= htmlspecialchars($users->email) ?>" class="form-control" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                <div class="invalid-feedback">Por favor ingrese un correo electrónico válido.</div>
            </div>

            <!-- Nombre de usuario -->
            <div class="mb-3">
                <label for="user_login_name" class="form-label">Nombre de usuario:</label>
                <input type="text" id="user_login_name" name="username" value="<?= htmlspecialchars($users->username) ?>" class="form-control" required pattern="^\S+$" title="No se permiten espacios" minlength="4" maxlength="20">
                <div class="invalid-feedback">El nombre de usuario debe ser único y no contener espacios.</div>
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label for="user_password" class="form-label">Contraseña:</label>
                <input type="password" id="user_password" name="password" value="<?= htmlspecialchars($users->password) ?>" class="form-control" required minlength="6" maxlength="20">
                <div class="invalid-feedback">La contraseña debe tener entre 6 y 20 caracteres.</div>
                <button type="button" class="password-toggle" onclick="togglePassword()">
                    <i id="password-icon" class="fa fa-eye"></i>
                </button>
            </div>

            <!-- Rol -->
            <div class="mb-3">
                <label for="id_rol" class="form-label">Rol:</label>
                <select id="id_rol" name="role" class="form-select" required>
                    <option value="">Seleccione un rol</option>
                    <option value="Administrator" <?= ($users->role == 'Administrator') ? 'selected' : '' ?>>Administrador</option>
                    <option value="Assistant" <?= ($users->role == 'Assistant') ? 'selected' : '' ?>>Asistente</option>
                </select>
                <div class="invalid-feedback">Por favor seleccione un rol.</div>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar cambios</button>
                <a href="?" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        var passwordInput = document.getElementById('user_password');
        var icon = document.getElementById('password-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Función para habilitar la validación de formularios HTML5
    document.querySelector('form').addEventListener('submit', function(event) {
        var form = event.target;
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
        }
    });
</script>

<?php include '../template/footer.php'; ?>
