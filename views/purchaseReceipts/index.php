<?php
include '../template/header.php';
?>

<div class="container">
   <div class="card mt-5 p-4">
       <h2 class="mb-4">Lista de Comprobantes de Compra</h2>
       <div class="d-flex justify-content-between mb-3">
           <a href="?action=create" class="btn btn-success">Registrar Comprobante</a>
       </div>
       <div class="table-responsive">
           <table id="genericTable" class="table table-striped table-bordered">
               <thead class="table-dark">
                   <tr>
                       <th scope="col">ID</th>
                       <th scope="col">Empresa</th>
                       <th scope="col">Tipo Comprobante</th>
                       <th scope="col">Número Comprobante</th>
                       <th scope="col">Fecha</th>
                       <th scope="col">Proveedor</th>
                       <th scope="col">Monto</th>
                       <th scope="col" class="text-center">Opciones</th>
                   </tr>
               </thead>
               <tbody>
                   <?php foreach ($purchaseReceipts as $receipt): ?>
                       <tr>
                           <td><?= htmlspecialchars($receipt['purchase_receipt_id']); ?></td>
                           <td><?= htmlspecialchars($receipt['name']); ?></td>
                           <td><?= htmlspecialchars($receipt['receipt_type']); ?></td>
                           <td><?= htmlspecialchars($receipt['receipt_number']); ?></td>
                           <td><?= htmlspecialchars($receipt['receipt_date']); ?></td>
                           <td><?= htmlspecialchars($receipt['supplier']); ?></td>
                           <td><?= htmlspecialchars(number_format($receipt['amount'], 2)); ?></td>
                           <td class="text-center">
                               <a href="?action=edit&id=<?= $receipt['purchase_receipt_id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                               <a href="?action=delete&id=<?= $receipt['purchase_receipt_id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                           </td>
                       </tr>
                   <?php endforeach; ?>
               </tbody>
           </table>
       </div>
   </div>
</div>

<?php include '../template/footer.php'; ?>
