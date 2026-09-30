<?php
class Controller
{
    // Carga una vista dentro del layout y le pasa variables
    protected function render(string $vista, array $datos = []): void
    {
        extract($datos);
        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . "/../views/$vista.php";
        require __DIR__ . '/../views/layout/footer.php';
    }

    public function noEncontrado(): void
    {
        http_response_code(404);
        $this->render('404', ['titulo' => 'No encontrado']);
    }
}
