<?php
include '../template/header.php';
?>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar Comprobante de Compra</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="receiptId" class="form-label">ID del Comprobante:</label>
                <input type="text" id="receiptId" name="receiptId" value="<?= htmlspecialchars($purchaseReceipt->purchase_receipt_id) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="receiptType" class="form-label">Tipo de Comprobante:</label>
                <input type="text" id="receiptType" name="receiptType" value="<?= htmlspecialchars($purchaseReceipt->receipt_type) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="receiptNumber" class="form-label">Número de Comprobante:</label>
                <input type="text" id="receiptNumber" name="receiptNumber" value="<?= htmlspecialchars($purchaseReceipt->receipt_number) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="receiptDate" class="form-label">Fecha:</label>
                <input type="text" id="receiptDate" name="receiptDate" value="<?= htmlspecialchars($purchaseReceipt->receipt_date) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="supplier" class="form-label">Proveedor:</label>
                <input type="text" id="supplier" name="supplier" value="<?= htmlspecialchars($purchaseReceipt->supplier) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Monto:</label>
                <input type="text" id="amount" name="amount" value="<?= htmlspecialchars($purchaseReceipt->amount) ?>" class="form-control" disabled>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                <label class="form-check-label" for="confirmDelete">
                    He leído que esta acción no es reversible.
                </label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger" id="deleteButton" disabled>Eliminar</button>
                <a href="../purchaseReceipts/purchaseReceipts.php" class="btn btn-secondary">Cancelar</a>
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
