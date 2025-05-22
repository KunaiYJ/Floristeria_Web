<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="reportes">
    <div class="reporte reporte-ventas">
        <i class="fa-solid fa-money-bills dashboard__icono"></i>
        <h2>Ventas -  Pedidos</h2>
        <p>Genera un reporte detallado de las ventas y pedidos.</p>

        <form action="/admin/reportes/generarPDF" method="GET" class="fecha-form">
            <label for="tipo">Selecciona el tipo de reporte:</label>
            <select id="tipo" name="tipo" required>
                <option value="ventas">Ventas</option>
                <option value="pedidos">Pedidos</option>
            </select>
            
            <label for="fechaInicio">Fecha de Inicio:</label>
            <input type="date" id="fechaInicio" name="fechaInicio" required>

            <label for="fechaFin">Fecha de Fin:</label>
            <input type="date" id="fechaFin" name="fechaFin" required>

            <button type="submit"><i class="fas fa-file-pdf pdf-icon"></i> PDF</button>
        </form>
    </div>

    <div class="reporte reporte-ventas">
        <i class="fa-solid fa-tag dashboard__icono"></i>
        <h2>Productos</h2>
        <p>Genera un reporte general de todos los productos registrados.</p>

        <form action="/admin/reportes/generarPDF" method="GET" class="fecha-form">
            <input type="hidden" name="tipo" value="productos">
            <button type="submit"><i class="fas fa-file-pdf pdf-icon"></i> PDF</button>
        </form>
    </div>
</div>
