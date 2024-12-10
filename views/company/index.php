<?php
include '../template/header.php';
?>

<div class="container">
   <div class="card mt-5 p-4">
       <h2 class="mb-4">Lista de Empresas</h2>
       <div class="d-flex justify-content-between mb-3">
           <a href="?action=create" class="btn btn-success">Crear Empresa</a>
       </div>
       <div class="table-responsive">
           <table id="genericTable" class="table table-striped table-bordered">
               <thead class="table-dark">
                   <tr>
                       <th scope="col">ID</th>
                       <th scope="col">Nombre</th>
                       <th scope="col">Tipo</th>
                       <th scope="col">Dirección</th>
                       <th scope="col">Teléfono</th>
                       <th scope="col">Correo</th>
                       <th scope="col" class="text-center">Opciones</th>
                   </tr>
               </thead>
               <tbody>
                   <?php foreach ($companies as $company): ?>
                       <tr>
                           <td><?= htmlspecialchars($company['company_id']); ?></td>
                           <td><?= htmlspecialchars($company['name']); ?></td>
                           <td><?= htmlspecialchars($company['company_type']); ?></td>
                           <td><?= htmlspecialchars($company['address']); ?></td>
                           <td><?= htmlspecialchars($company['phone']); ?></td>
                           <td><?= htmlspecialchars($company['email']); ?></td>
                           <td class="text-center">
                               <a href="?action=edit&id=<?= $company['company_id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                               <a href="?action=delete&id=<?= $company['company_id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                           </td>
                       </tr>
                   <?php endforeach; ?>
               </tbody>
           </table>
       </div>
   </div>
</div>

<?php include '../template/footer.php'; ?>