<?php
class Estacion
{
    // El chipid solo puede tener letras, números, guion y guion bajo
    public static function chipidValido(?string $chipid): bool
    {
        return $chipid !== null && preg_match('/^[A-Za-z0-9_-]{1,64}$/', $chipid) === 1;
    }
}
