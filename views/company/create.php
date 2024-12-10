<?php
include '../template/header.php';
?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center">Crear Empresa</h2>
        <form action="" method="POST" name="frmCreate" onsubmit="return validateForm()" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la Empresa:</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control" 
                    required>
            </div>
            <div class="mb-3">
                <label for="company_type" class="form-label">Tipo de Empresa:</label>
                <select 
                    id="company_type" 
                    name="company_type" 
                    class="form-select" 
                    required>
                    <option value="" disabled selected>Seleccione el tipo de empresa</option>
                    <option value="Natural">Natural</option>
                    <option value="Legal">Legal</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Dirección:</label>
                <input 
                    type="text" 
                    id="address" 
                    name="address" 
                    class="form-control" 
                    required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Teléfono:</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    class="form-control" 
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo:</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="?" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    function validateForm() {
        const companyName = document.getElementById('name').value.trim();
        const companyType = document.getElementById('company_type').value;
        const companyAddress = document.getElementById('address').value.trim();
        const companyPhone = document.getElementById('phone').value.trim();
        const companyEmail = document.getElementById('email').value.trim();

        if (companyName === '') {
            alert('El nombre de la empresa no puede estar vacío.');
            return false;
        }

        if (!companyType) {
            alert('Debe seleccionar un tipo de empresa.');
            return false;
        }

        if (companyAddress === '') {
            alert('La dirección no puede estar vacía.');
            return false;
        }

        if (companyPhone === '') {
            alert('El teléfono no puede estar vacío.');
            return false;
        }

        if (companyEmail === '') {
            alert('El correo no puede estar vacío.');
            return false;
        }

        return true;
    }
</script>

<?php include '../template/footer.php'; ?>
