<?php
include '../template/header.php';

// Asumimos que ya tienes las empresas cargadas en el controlador
require_once __DIR__ . '/../../models/CompanyModel.php';
$companyModel = new CompanyModel((new Database())->getConnection());
$companies = $companyModel->getAll()->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center">Editar Comprobante de Venta</h2>
        <form action="" method="POST" name="frmEdit" enctype="multipart/form-data" onsubmit="return validateForm()" novalidate>
            <input type="hidden" name="sales_receipt_id" value="<?= $salesReceipt->sales_receipt_id ?>">

            <div class="mb-3">
                <label for="company_id" class="form-label">Empresa:</label>
                <select
                    id="company_id"
                    name="company_id"
                    class="form-select"
                    required>
                    <option value="" disabled>Seleccione una empresa</option>
                    <?php foreach ($companies as $company): ?>
                        <option value="<?= $company['company_id'] ?>"
                            <?= $salesReceipt->company_id == $company['company_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($company['name']) ?>
                        </option>
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
                    <option value="" disabled>Seleccione tipo de comprobante</option>
                    <option value="Tax Invoice" <?= $salesReceipt->receipt_type == 'Tax Invoice' ? 'selected' : '' ?>>Tax Invoice</option>
                    <option value="Final Consumer" <?= $salesReceipt->receipt_type == 'Final Consumer' ? 'selected' : '' ?>>Final Consumer</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="receipt_number" class="form-label">Número de Comprobante:</label>
                <input
                    type="text"
                    id="receipt_number"
                    name="receipt_number"
                    class="form-control"
                    value="<?= htmlspecialchars($salesReceipt->receipt_number) ?>"
                    required>
            </div>

            <div class="mb-3">
                <label for="receipt_date" class="form-label">Fecha:</label>
                <input
                    type="date"
                    id="receipt_date"
                    name="receipt_date"
                    class="form-control"
                    value="<?= $salesReceipt->receipt_date ?>"
                    required>
            </div>

            <div class="mb-3">
                <label for="customer" class="form-label">Cliente:</label>
                <input
                    type="text"
                    id="customer"
                    name="customer"
                    class="form-control"
                    value="<?= htmlspecialchars($salesReceipt->customer) ?>"
                    required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Monto:</label>
                <input
                    type="number"
                    id="amount"
                    name="amount"
                    step="0.01"
                    class="form-control"
                    value="<?= $salesReceipt->amount ?>"
                    required>
            </div>

            <div class="mb-3">
                <label for="attachment" class="form-label">Archivo Adjunto (PDF o JSON):</label>
                <input
                    type="file"
                    id="attachment"
                    name="attachment"
                    class="form-control"
                    accept=".pdf,.json">
                <small class="form-text text-muted">Dejar en blanco si no deseas cambiar el archivo adjunto</small>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="../salesReceipts/salesReceipts.php" class="btn btn-danger">Cancelar</a>
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
        const customer = document.getElementById('customer').value.trim();
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

        if (customer === '') {
            alert('El nombre del cliente no puede estar vacío.');
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