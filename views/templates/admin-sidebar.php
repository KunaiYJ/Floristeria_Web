<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace 
        <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : '';?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>
        </a>

        <a href="/admin/registrados" class="dashboard__enlace 
        <?php echo pagina_actual('/registrados') ? 'dashboard__enlace--actual' : '';?>">
            <i class="fa-solid fa-circle-user dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Registrados
            </span>
        </a>

        <a href="/admin/clientes" class="dashboard__enlace 
        <?php echo pagina_actual('/clientes') ? 'dashboard__enlace--actual' : '';?>">
            <i class="fa-solid fa-user-group dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Clientes
            </span>
        </a>

        <a href="/admin/productos" class="dashboard__enlace 
        <?php echo pagina_actual('/productos') ? 'dashboard__enlace--actual' : '';?>">
            <i class="fa-solid fa-tag dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Productos
            </span>
        </a>

        <a href="/admin/proveedores" class="dashboard__enlace 
        <?php echo pagina_actual('/proveedores') ? 'dashboard__enlace--actual' : '';?>">
            <i class="fa-solid fa-handshake dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Proveedores
            </span>
        </a>

        <a href="/admin/pedidos" class="dashboard__enlace 
        <?php echo pagina_actual('/pedidos') ? 'dashboard__enlace--actual' : '';?>">
            <i class="fa-solid fa-truck dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Pedidos
            </span>
        </a>

        <a href="/admin/reportes" class="dashboard__enlace 
        <?php echo pagina_actual('/reportes') ? 'dashboard__enlace--actual' : '';?>">
            <i class="fa-solid fa-book"></i>
            <span class="dashboard__menu-texto">
                Reportes
            </span>
        </a>

        <a href="/admin/ventas" class="dashboard__enlace 
        <?php echo pagina_actual('/ventas') ? 'dashboard__enlace--actual' : '';?>">
            <i class="fa-solid fa-money-bills"></i>
            <span class="dashboard__menu-texto">
                Ventas
            </span>
        </a>
    </nav>
</aside>