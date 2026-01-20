<?php
// app/models/Centrocampista.php
require_once 'Jugador.php';

//Clase FINAL Centrocampista - Hereda de Jugador
 //Implementa el método abstracto calcularRendimiento()
 //Especializado en asistencias y creación de juego

final class Centrocampista extends Jugador
{
    // Atributo específico de Centrocampista
    private int $asistencias;

    // CONSTRUCTOR
    public function __construct(string $nombre, int $edad, float $sueldo, int $asistencias)
    {
        // Llamamos al constructor del padre (Jugador)
        parent::__construct($nombre, $edad, "Centrocampista", $sueldo);
        $this->asistencias = $asistencias;
    }

    // MÉTODO OBLIGATORIO - Implementación específica para Centrocampista
    public function calcularRendimiento(): float
    {
        // Fórmula específica para CENTROCAMPISTAS:
        // - Cada asistencia vale 8 puntos
        // - La edad aporta 0.3 puntos por año (menos que delanteros)
        return ($this->asistencias * 8) + ($this->edad * 0.3);
    }

    // MÉTODO ESPECÍFICO de Centrocampista
    public function getAsistencias(): int
    {
        return $this->asistencias;
    }

    // MÉTODO ESPECIAL mejorado
    public function __toString(): string
    {
        return parent::__toString() . " - Asistencias: {$this->asistencias} - Rendimiento: " . $this->calcularRendimiento();
    }
}