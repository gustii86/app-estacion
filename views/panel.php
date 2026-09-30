<section class="panel">
    <h1>Estaciones meteorológicas</h1>
    <p id="estado">Cargando estaciones…</p>
    <div id="contenedor-estaciones" class="lista-estaciones"></div>

    <!-- Plantilla: estructura vacía que se clona una vez por estación -->
    <template id="tpl-estacion">
        <button type="button" class="estacion">
            <strong class="apodo"></strong>
            <span class="ubicacion"></span>
            <small class="visitas"></small>
        </button>
    </template>
</section>

<script>
const BASE_URL = <?= json_encode(BASE_URL) ?>;

const estado     = document.getElementById('estado');
const contenedor = document.getElementById('contenedor-estaciones');
const plantilla  = document.getElementById('tpl-estacion');

async function cargarEstaciones() {
    try {
        const respuesta = await fetch('/app-estacion/proxy.php');
        
        if (!respuesta.ok) {
            throw new Error('HTTP ' + respuesta.status);
        }
        const datos = await respuesta.json();

        // Acepta un array directo o un objeto que lo contenga
        const estaciones = Array.isArray(datos)
            ? datos
            : (datos.estaciones ?? datos.data ?? Object.values(datos));

        if (estaciones.length === 0) {
            estado.textContent = 'No hay estaciones disponibles.';
            return;
        }
        estado.remove();

        estaciones.forEach((est) => {
            const clon   = plantilla.content.cloneNode(true);
            const boton  = clon.querySelector('.estacion');

            clon.querySelector('.apodo').textContent     = est.apodo;
            clon.querySelector('.ubicacion').textContent = est.ubicacion;
            clon.querySelector('.visitas').textContent   = 'Visitas: ' + est.visitas;

            boton.addEventListener('click', () => {
                window.location.href = BASE_URL + '/detalle/' + encodeURIComponent(est.chipid);
            });

            contenedor.appendChild(clon);
        });
    } catch (error) {
        console.error(error);
        estado.textContent = 'No se pudieron cargar las estaciones.';
    }
}

cargarEstaciones();
</script>