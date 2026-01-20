<?php

require_once 'Jugador.php';

//Clase FINAL Defensa - Hereda de Jugador
//Implementa el método abstracto calcularRendimiento()
//Especializado en defensa y recuperación de balón

final class Defensa extends Jugador
{
    // Atributo específico de Defensa
    private int $tapones;

    
    public function __construct(string $nombre, int $edad, float $sueldo, int $tapones)
    {
        // Llamamos al constructor del padre (Jugador)
        parent::__construct($nombre, $edad, "Defensa", $sueldo);
        $this->tapones = $tapones;
    }

    // MÉTODO OBLIGATORIO - Implementación específica para Defensa
    public function calcularRendimiento(): float
    {
        // Fórmula específica para DEFENSAS:
        // - Cada tapón vale 6 puntos
        // - La edad aporta 0.4 puntos por año
        return ($this->tapones * 6) + ($this->edad * 0.4);
    }

    // MÉTODO ESPECÍFICO de Defensa
    public function getTapones(): int
    {
        return $this->tapones;
    }

    public function __toString(): string
    {
        return parent::__toString() . " - Tapones: {$this->tapones} - Rendimiento: " . $this->calcularRendimiento();
    }
}