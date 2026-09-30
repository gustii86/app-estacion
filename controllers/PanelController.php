<?php
class PanelController extends Controller
{
    public function index($parametro = null): void
    {
        $this->render('panel', ['titulo' => 'Panel de estaciones']);
    }
}
