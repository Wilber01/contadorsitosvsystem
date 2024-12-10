<?php
session_start();
if ($_SESSION['userName'] == "") {
    header("Location: ../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- jQuery (must be before DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Additional CSS -->
    <link rel="stylesheet" href="../../resources/index.css">

    <title>Index</title>
</head>

<body>
    <!-- Menu -->
    <nav id="slide-menu">
        <ul>
            <li>
                <a class="navbar-brand" href="#">
                    <i class="bi bi-person-circle"></i>
                    <?php echo "Bienvenido " . $_SESSION['userName']; ?>
                </a>
            </li>
            <li>
                <a class="nav-link" href="../template/index.php">Dashboard</a>
            </li>
            <hr>
            <li>
                <a class="nav-link" href="../company/company.php">Compañias</a>
            </li>
            <?php
            // Verificar el rol del usuario antes de mostrar el enlace
            if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] == 'Administrator') :
            ?>
                <li>
                    <a class="nav-link" href="../user/user.php">Usuarios</a>
                </li>
            <?php
            endif;
            ?>
            <hr>
            <li class="nav-item">
                <a class="nav-link" href="../purchaseReceipts/purchaseReceipts.php">Comprobantes de compras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../salesReceipts/salesReceipts.php">Comprobantes de ventas</a>
            </li>
            <li>
                <a class="nav-link" href="../reports/report.php?action=purchaseReports">Reportes de compras</a>
            </li>
            <li>
                <a class="nav-link" href="../reports/report.php?action=salesReports">Reportes de ventas</a>
            </li>
            <hr>
            <li>
                <a class="nav-link" href="../../config/exit.php">Salir</a>
            </li>
        </ul>
    </nav>
    <!-- Content -->
    <div id="content">
        <div class="menu-trigger"></div>
        <h1>Side Bar Menu</h1>
        <br><br>