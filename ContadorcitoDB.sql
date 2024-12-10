CREATE DATABASE ContadorcitoDB;
USE ContadorcitoDB;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('Administrator', 'Assistant') NOT NULL,
    email VARCHAR(100)
);

CREATE TABLE companies (
    company_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    company_type ENUM('Natural', 'Legal') NOT NULL,
    address TEXT,
    phone VARCHAR(20),
    email VARCHAR(100)
);

CREATE TABLE purchase_receipts (
    purchase_receipt_id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT,
    receipt_type ENUM('Tax Invoice', 'Final Consumer') NOT NULL,
    receipt_number VARCHAR(50) NOT NULL,
    receipt_date DATE NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    supplier VARCHAR(200) NOT NULL,
    attachment LONGBLOB,
    FOREIGN KEY (company_id) REFERENCES companies(company_id)
);

CREATE TABLE sales_receipts (
    sales_receipt_id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT,
    receipt_type ENUM('Tax Invoice', 'Final Consumer') NOT NULL,
    receipt_number VARCHAR(50) NOT NULL,
    receipt_date DATE NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    customer VARCHAR(200) NOT NULL,
    attachment LONGBLOB,
    FOREIGN KEY (company_id) REFERENCES companies(company_id)
);

-- Users
INSERT INTO users (name, username, password, role, email) VALUES 
('Juan Pérez', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrator', 'juan.perez@contadorcito.com'),
('María González', 'Assistant', '202cb962ac59075b964b07152d234b70', 'Assistant', 'maria.gonzalez@contadorcito.com');

-- Companies
INSERT INTO companies (name, company_type, address, phone, email) VALUES 
('Tienda El Rocío', 'Natural', 'Av. Central 123, San Salvador', '2222-3333', 'ventas@elrocio.com'),
('Distribuidora ALPHA', 'Legal', 'Zona Industrial Norte, Santa Tecla', '2111-4444', 'contacto@alpha.sv'),
('Café Don Manuel', 'Natural', 'Barrio El Centro, San Miguel', '2333-5555', 'info@cafedonmanuel.com'),
('Importaciones GlobalTrade', 'Legal', 'Edificio Empresarial, San Salvador', '2444-6666', 'comercial@globaltrade.sv'),
('Panadería La Francesa', 'Natural', 'Colonia Escalón, San Salvador', '2555-7777', 'ventas@lafrancesa.com'),
('Ferretería El Constructor', 'Natural', 'Boulevard del Ejército, San Miguel', '2666-8888', 'contacto@elconstructor.com'),
('Mueblería Diseño Total', 'Legal', 'Zona Rosa, San Salvador', '2777-9999', 'ventas@disenototal.com'),
('Vivero Las Orquídeas', 'Natural', 'Antiguo Cuscatlán, La Libertad', '2888-0000', 'info@lasorquideas.com'),
('Taller Mecánico Rodríguez', 'Natural', 'Soyapango, San Salvador', '2999-1111', 'servicio@tallermecanicorodriguez.com'),
('Librería Ciencia y Arte', 'Natural', 'Santa Ana Centro', '2000-2222', 'ventas@cienciaarte.com'),
('Laboratorios Médicos VIDA', 'Legal', 'Edificio Médico, San Salvador', '2111-3333', 'contacto@laboratariosvida.com'),
('Restaurante El Sabor', 'Natural', 'Centro Histórico, Santa Ana', '2222-4444', 'reservas@elsabor.com'),
('Transportes Rápidos SA', 'Legal', 'Zona Industrial, San Miguel', '2333-5555', 'operaciones@transportesrapidos.com'),
('Pastelería Sweet Dreams', 'Natural', 'Colonia Escalón, San Salvador', '2444-6666', 'pedidos@sweetdreams.com');

-- Sample Purchase Receipt
INSERT INTO purchase_receipts (company_id, receipt_type, receipt_number, receipt_date, amount, supplier, attachment) VALUES
(2, 'Tax Invoice', 'CF-2024-0001', '2024-12-01', 5500.75, 'Proveedores Unidos SA', NULL),
(3, 'Tax Invoice', 'CF-2024-0002', '2024-12-02', 4300.50, 'Proveedora ABC', NULL),
(4, 'Tax Invoice', 'CF-2024-0003', '2024-12-03', 1200.20, 'Comercial Internacional', NULL),
(5, 'Tax Invoice', 'CF-2024-0004', '2024-12-04', 7000.00, 'Distribuciones Delta', NULL),
(6, 'Tax Invoice', 'CF-2024-0005', '2024-12-05', 3250.40, 'Importaciones XYZ', NULL),
(7, 'Tax Invoice', 'CF-2024-0006', '2024-12-06', 1500.00, 'Proveedora Global', NULL),
(8, 'Tax Invoice', 'CF-2024-0007', '2024-12-07', 2100.75, 'Tecnología y Comercio', NULL),
(9, 'Tax Invoice', 'CF-2024-0008', '2024-12-08', 5500.60, 'Distribuciones Central', NULL),
(10, 'Tax Invoice', 'CF-2024-0009', '2024-12-09', 6300.00, 'Proveedora Internacional', NULL),
(2, 'Final Consumer', 'CF-2024-0010', '2024-12-01', 850.90, 'Cliente Local', NULL),
(3, 'Final Consumer', 'CF-2024-0011', '2024-12-02', 1200.50, 'Cliente Empresarial', NULL),
(4, 'Final Consumer', 'CF-2024-0012', '2024-12-03', 900.00, 'Compras Directas', NULL),
(5, 'Final Consumer', 'CF-2024-0013', '2024-12-04', 1100.75, 'Electrodomésticos SA', NULL),
(6, 'Final Consumer', 'CF-2024-0014', '2024-12-05', 2100.60, 'Distribuidora Mega', NULL),
(7, 'Final Consumer', 'CF-2024-0015', '2024-12-06', 1450.30, 'ElectroPlus', NULL),
(8, 'Final Consumer', 'CF-2024-0016', '2024-12-07', 1225.20, 'Servicios Eléctricos', NULL),
(9, 'Final Consumer', 'CF-2024-0017', '2024-12-08', 1900.50, 'Venta al por Mayor', NULL),
(10, 'Final Consumer', 'CF-2024-0018', '2024-12-09', 500.00, 'Distribuciones Rápidas', NULL);


INSERT INTO sales_receipts (company_id, receipt_type, receipt_number, receipt_date, amount, customer, attachment) VALUES
(1, 'Tax Invoice', 'VT-2024-0001', '2024-12-01', 1200.50, 'Comercial San José', NULL),
(2, 'Final Consumer', 'VT-2024-0002', '2024-12-02', 350.25, 'Cliente Contado', NULL),
(3, 'Tax Invoice', 'VT-2024-0003', '2024-12-03', 2750.80, 'Distribuidora Central', NULL),
(4, 'Final Consumer', 'VT-2024-0004', '2024-12-04', 650.00, 'Consumidor Directo', NULL),
(5, 'Tax Invoice', 'VT-2024-0005', '2024-12-05', 1500.40, 'Comercial Internacional', NULL),
(6, 'Final Consumer', 'VT-2024-0006', '2024-12-06', 980.75, 'Cliente Regular', NULL),
(7, 'Tax Invoice', 'VT-2024-0007', '2024-12-07', 3400.30, 'Mega Distribuciones', NULL),
(8, 'Final Consumer', 'VT-2024-0008', '2024-12-08', 2050.15, 'Cliente Frecuente', NULL),
(9, 'Tax Invoice', 'VT-2024-0009', '2024-12-09', 4300.00, 'Electrodomésticos Rápidos', NULL),
(1, 'Tax Invoice', 'VT-2024-0010', '2024-12-01', 1750.00, 'Comercial San José', NULL),
(2, 'Final Consumer', 'VT-2024-0011', '2024-12-02', 2100.25, 'Distribuidora Mega', NULL),
(3, 'Tax Invoice', 'VT-2024-0012', '2024-12-03', 2850.90, 'Distribuidora Central', NULL),
(4, 'Final Consumer', 'VT-2024-0013', '2024-12-04', 850.50, 'Cliente Contado', NULL),
(5, 'Tax Invoice', 'VT-2024-0014', '2024-12-05', 2400.75, 'Tecnología y Comercio', NULL),
(6, 'Final Consumer', 'VT-2024-0015', '2024-12-06', 1100.00, 'Cliente Directo', NULL),
(7, 'Tax Invoice', 'VT-2024-0016', '2024-12-07', 3200.60, 'Distribuidora Rápida', NULL),
(8, 'Final Consumer', 'VT-2024-0017', '2024-12-08', 1900.30, 'Cliente Mayorista', NULL),
(9, 'Tax Invoice', 'VT-2024-0018', '2024-12-09', 2900.20, 'Comercial Internacional', NULL),
(1, 'Final Consumer', 'VT-2024-0019', '2024-12-01', 1800.45, 'Cliente Corporativo', NULL);
