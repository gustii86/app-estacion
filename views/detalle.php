<section class="detalle">
    <a href="<?= BASE_URL ?>/panel">&larr; Volver al panel</a>

    <h1 id="apodo">Cargando…</h1>
    <p><strong>Ubicación:</strong> <span id="ubicacion">…</span></p>
    <p><strong>Chip ID:</strong> <?= htmlspecialchars($chipid, ENT_QUOTES, 'UTF-8') ?></p>
    <p id="estado"></p>
</section>

<script>
const API_URL = 'https://mattprofe.com.ar/proyectos/app-estacion/';
const CHIPID  = <?= json_encode($chipid) ?>;

async function cargarDetalle() {
    const estado = document.getElementById('estado');
    try {
        const respuesta = await fetch(API_URL);
        if (!respuesta.ok) {
            throw new Error('HTTP ' + respuesta.status);
        }
        const datos = await respuesta.json();
        const estaciones = Array.isArray(datos)
            ? datos
            : (datos.estaciones ?? datos.data ?? Object.values(datos));

        const est = estaciones.find((e) => String(e.chipid) === CHIPID);
        if (!est) {
            document.getElementById('apodo').textContent = 'Estación no encontrada';
            return;
        }
        document.getElementById('apodo').textContent     = est.apodo;
        document.getElementById('ubicacion').textContent = est.ubicacion;
    } catch (error) {
        console.error(error);
        estado.textContent = 'No se pudo cargar la información de la estación.';
    }
}

cargarDetalle();
</script>
