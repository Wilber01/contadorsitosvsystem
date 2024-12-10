<?php
include '../template/header.php';

require_once __DIR__ . '/../../models/CompanyModel.php';
$companyModel = new CompanyModel((new Database())->getConnection());
$companies = $companyModel->getAll()->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Registrar Comprobante de Compra</h2>
        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="company_id" class="form-label">Empresa:</label>
                <select id="company_id" name="company_id" class="form-control" required>
                    <option value="">Seleccione una Empresa</option>
                    <?php foreach ($companies as $company): ?>
                        <option value="<?= $company['company_id']; ?>"><?= htmlspecialchars($company['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="receipt_type" class="form-label">Tipo de Comprobante:</label>
                <select 
                    id="receipt_type" 
                    name="receipt_type" 
                    class="form-select" 
                    required>
                    <option value="" disabled selected>Seleccione tipo de comprobante</option>
                    <option value="Tax Invoice">Tax Invoice</option>
                    <option value="Final Consumer">Final Consumer</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="receipt_number" class="form-label">Número de Comprobante:</label>
                <input type="text" id="receipt_number" name="receipt_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="receipt_date" class="form-label">Fecha:</label>
                <input type="date" id="receipt_date" name="receipt_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="supplier" class="form-label">Proveedor:</label>
                <input type="text" id="supplier" name="supplier" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Monto:</label>
                <input type="number" id="amount" name="amount" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="attachment" class="form-label">Adjuntar Archivo:</label>
                <input type="file" id="attachment" name="attachment" class="form-control">
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Registrar</button>
                <a href="?" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    function validateForm() {
        const companyId = document.getElementById('company_id').value;
        const receiptType = document.getElementById('receipt_type').value;
        const receiptNumber = document.getElementById('receipt_number').value.trim();
        const receiptDate = document.getElementById('receipt_date').value;
        const supplier = document.getElementById('supplier').value.trim();
        const amount = document.getElementById('amount').value;
        const attachment = document.getElementById('attachment').files[0]; // Archivo cargado

        if (!companyId) {
            alert('Debe seleccionar una empresa.');
            return false;
        }

        if (!receiptType) {
            alert('Debe seleccionar un tipo de comprobante.');
            return false;
        }

        if (receiptNumber === '') {
            alert('El número de comprobante no puede estar vacío.');
            return false;
        }

        if (!receiptDate) {
            alert('Debe seleccionar una fecha.');
            return false;
        }

        if (supplier === '') {
            alert('El nombre del proveedor no puede estar vacío.');
            return false;
        }

        if (amount <= 0) {
            alert('El monto debe ser mayor a cero.');
            return false;
        }

        // Validación del archivo: Solo se permiten PDF o JSON
        if (attachment) {
            const allowedTypes = ['application/pdf', 'application/json'];
            const fileType = attachment.type;

            if (!allowedTypes.includes(fileType)) {
                alert('Solo se permiten archivos PDF o JSON.');
                return false;
            }
        } else {
            alert('Debe adjuntar un archivo PDF o JSON.');
            return false;
        }

        return true;
    }
</script>

<?php include '../template/footer.php'; ?>
