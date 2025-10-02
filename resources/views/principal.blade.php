<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Datos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #2c3e50;
            line-height: 1.6;
        }

        .navbar {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
            color: white;
            padding: 1.5rem 2rem;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-body {
            padding: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        .form-control {
            padding: 0.75rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .btn {
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .table-container {
            overflow-x: auto;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .table th {
            background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table tbody tr:nth-child(even) {
            background-color: #fbfcfd;
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(231, 76, 60, 0.3);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            text-align: center;
            border-left: 4px solid #3498db;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #7f8c8d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
        }

        .view {
            display: none;
        }

        .view.active {
            display: block;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #7f8c8d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .navbar-content {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar-nav {
                gap: 1rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="#" class="navbar-brand">📊 Sistema de Gestión</a>
            <ul class="navbar-nav">
                <li><a href="#" class="nav-link active" onclick="showView('inicio')">Inicio</a></li>
                <li><a href="#" class="nav-link" onclick="showView('agrupados')">Datos Agrupados</a></li>
                <li><a href="#" class="nav-link" onclick="showView('no-agrupados')">Datos No Agrupados</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Vista Inicio -->
        <div id="inicio" class="view active">
            <!-- Formulario de Captura -->
            <div class="card">
                <div class="card-header">
                    📝 Captura de Datos
                </div>
                <div class="card-body">
                    <form id="dataForm">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Categoría</label>
                                <select id="categoria" class="form-control" required>
                                    <option value="">Seleccionar categoría...</option>
                                    <option value="ingresos">Ingresos</option>
                                    <option value="gastos">Gastos</option>
                                    <option value="inversiones">Inversiones</option>
                                    <option value="ahorros">Ahorros</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Valor en Pesos</label>
                                <input type="number" id="valor" class="form-control" placeholder="$0.00" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Fecha</label>
                                <input type="date" id="fecha" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">💾 Guardar Datos</button>
                    </form>
                </div>
            </div>

            <!-- Tabla de Datos -->
            <div class="card">
                <div class="card-header">
                    📋 Datos Registrados
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Categoría</th>
                                    <th>Valor</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="dataTableBody">
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        📊<br>No hay datos registrados
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vista Datos Agrupados -->
        <div id="agrupados" class="view">
            <div class="card">
                <div class="card-header">
                    📊 Análisis por Categoría
                </div>
                <div class="card-body">
                    <div class="stats-grid" id="statsGrid">
                        <div class="empty-state">
                            📈<br>No hay datos para agrupar
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Categoría</th>
                                    <th>Total</th>
                                    <th>Promedio</th>
                                    <th>Registros</th>
                                </tr>
                            </thead>
                            <tbody id="groupedTableBody">
                                <tr>
                                    <td colspan="4" class="empty-state">
                                        📊<br>No hay datos agrupados
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vista Datos No Agrupados -->
        <div id="no-agrupados" class="view">
            <div class="card">
                <div class="card-header">
                    📋 Todos los Registros
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Categoría</th>
                                    <th>Valor</th>
                                    <th>Fecha</th>
                                    <th>Registro</th>
                                </tr>
                            </thead>
                            <tbody id="ungroupedTableBody">
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        📊<br>No hay registros disponibles
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Datos almacenados
        let dataStorage = JSON.parse(localStorage.getItem('dataManagement')) || [];
        let nextId = dataStorage.length > 0 ? Math.max(...dataStorage.map(item => item.id)) + 1 : 1;

        // Inicializar fecha actual
        document.getElementById('fecha').value = new Date().toISOString().split('T')[0];

        // Manejar envío del formulario
        document.getElementById('dataForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const categoria = document.getElementById('categoria').value;
            const valor = parseFloat(document.getElementById('valor').value);
            const fecha = document.getElementById('fecha').value;
            
            if (categoria && valor && fecha) {
                const newData = {
                    id: nextId++,
                    categoria: categoria,
                    valor: valor,
                    fecha: fecha,
                    timestamp: new Date().toLocaleString()
                };
                
                dataStorage.push(newData);
                localStorage.setItem('dataManagement', JSON.stringify(dataStorage));
                
                // Limpiar formulario
                document.getElementById('dataForm').reset();
                document.getElementById('fecha').value = new Date().toISOString().split('T')[0];
                
                // Actualizar vistas
                updateAllViews();
                
                alert('✅ Datos guardados correctamente');
            }
        });

        // Función para eliminar registro
        function deleteRecord(id) {
            if (confirm('¿Estás seguro de eliminar este registro?')) {
                dataStorage = dataStorage.filter(item => item.id !== id);
                localStorage.setItem('dataManagement', JSON.stringify(dataStorage));
                updateAllViews();
            }
        }

        // Función para mostrar vista
        function showView(viewName) {
            // Ocultar todas las vistas
            document.querySelectorAll('.view').forEach(view => {
                view.classList.remove('active');
            });
            
            // Remover clase active de todos los enlaces
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            // Mostrar vista seleccionada
            document.getElementById(viewName).classList.add('active');
            
            // Activar enlace correspondiente
            event.target.classList.add('active');
            
            // Actualizar datos
            updateAllViews();
        }

        // Actualizar tabla principal
        function updateMainTable() {
            const tbody = document.getElementById('dataTableBody');
            
            if (dataStorage.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="empty-state">
                            📊<br>No hay datos registrados
                        </td>
                    </tr>
                `;
                return;
            }
            
            tbody.innerHTML = dataStorage.map(item => `
                <tr>
                    <td>${item.id}</td>
                    <td><span style="text-transform: capitalize;">${item.categoria}</span></td>
                    <td>$${item.valor.toLocaleString('es-CO', {minimumFractionDigits: 2})}</td>
                    <td>${new Date(item.fecha).toLocaleDateString('es-CO')}</td>
                    <td>
                        <button class="btn btn-danger" onclick="deleteRecord(${item.id})">
                            🗑️ Eliminar
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        // Actualizar datos agrupados
        function updateGroupedView() {
            const statsGrid = document.getElementById('statsGrid');
            const tbody = document.getElementById('groupedTableBody');
            
            if (dataStorage.length === 0) {
                statsGrid.innerHTML = `
                    <div class="empty-state">
                        📈<br>No hay datos para agrupar
                    </div>
                `;
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="empty-state">
                            📊<br>No hay datos agrupados
                        </td>
                    </tr>
                `;
                return;
            }
            
            // Agrupar datos por categoría
            const grouped = dataStorage.reduce((acc, item) => {
                if (!acc[item.categoria]) {
                    acc[item.categoria] = {
                        total: 0,
                        count: 0,
                        items: []
                    };
                }
                acc[item.categoria].total += item.valor;
                acc[item.categoria].count++;
                acc[item.categoria].items.push(item);
                return acc;
            }, {});
            
            // Actualizar estadísticas
            statsGrid.innerHTML = Object.entries(grouped).map(([categoria, data]) => `
                <div class="stat-card">
                    <div class="stat-value">$${data.total.toLocaleString('es-CO', {minimumFractionDigits: 2})}</div>
                    <div class="stat-label">${categoria}</div>
                </div>
            `).join('');
            
            // Actualizar tabla agrupada
            tbody.innerHTML = Object.entries(grouped).map(([categoria, data]) => `
                <tr>
                    <td style="text-transform: capitalize; font-weight: 600;">${categoria}</td>
                    <td>$${data.total.toLocaleString('es-CO', {minimumFractionDigits: 2})}</td>
                    <td>$${(data.total / data.count).toLocaleString('es-CO', {minimumFractionDigits: 2})}</td>
                    <td>${data.count}</td>
                </tr>
            `).join('');
        }

        // Actualizar vista no agrupada
        function updateUngroupedView() {
            const tbody = document.getElementById('ungroupedTableBody');
            
            if (dataStorage.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="empty-state">
                            📊<br>No hay registros disponibles
                        </td>
                    </tr>
                `;
                return;
            }
            
            tbody.innerHTML = dataStorage.map(item => `
                <tr>
                    <td>${item.id}</td>
                    <td><span style="text-transform: capitalize;">${item.categoria}</span></td>
                    <td>$${item.valor.toLocaleString('es-CO', {minimumFractionDigits: 2})}</td>
                    <td>${new Date(item.fecha).toLocaleDateString('es-CO')}</td>
                    <td>${item.timestamp}</td>
                </tr>
            `).join('');
        }

        // Actualizar todas las vistas
        function updateAllViews() {
            updateMainTable();
            updateGroupedView();
            updateUngroupedView();
        }

        // Cargar datos al inicio
        updateAllViews();
    </script>
</body>
</html>
