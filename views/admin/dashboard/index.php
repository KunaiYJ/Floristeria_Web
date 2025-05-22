<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard">
    <h1>Panel de Control</h1>
    <div class="dashboard__indicadores">
        <div class="indicador">
            <i class="fa-solid fa-circle-user"></i>
            <h3>USUARIOS</h3>
            <p><?php echo $totalRegistrados; ?></p>
        </div>
        <div class="indicador">
            <i class="fa-solid fa-user-group"></i>
            <h3>CLIENTES</h3>
            <p><?php echo $totalClientes; ?></p>
        </div>
        <div class="indicador">
            <i class="fa-solid fa-tag"></i>
            <h3>PRODUCTOS</h3>
            <p><?php echo $totalProductos; ?></p>
        </div>
        <div class="indicador">
            <i class="fa-solid fa-handshake"></i>
            <h3>PROVEEDORES</h3>
            <p><?php echo $totalProveedores; ?></p>
        </div>
        <div class="indicador">
            <i class="fa-solid fa-truck dashboard__icono"></i>
            <h3>PEDIDOS</h3>
            <p><?php echo $totalPedidos; ?></p>
        </div>
        <div class="indicador">
            <i class="fa-solid fa-money-bills"></i>
            <h3>VENTAS TOTALES</h3>
            <p><?php echo $totalVentas; ?></p>
        </div>
    </div>
</div>
