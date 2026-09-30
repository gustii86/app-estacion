<?php
class DetalleController extends Controller
{
    public function index($chipid = null): void
    {
        // Valida el parámetro antes de usarlo en la vista
        if (!Estacion::chipidValido($chipid)) {
            $this->noEncontrado();
            return;
        }

        $this->render('detalle', [
            'titulo' => 'Detalle de estación',
            'chipid' => $chipid,
        ]);
    }
}
