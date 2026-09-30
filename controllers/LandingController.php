<?php
class LandingController extends Controller
{
    public function index($parametro = null): void
    {
        $this->render('landing', ['titulo' => 'app-estacion']);
    }
}
