<?php
// app/models/Delantero.php

include $_SERVER ['DOCUMENT_ROOT'] . '/app/models/Jugador.php';
///Clase FINAL Delantero - Hereda de Jugador
 // NO puede tener más clases hijas (final)
 //Implementa el método abstracto calcularRendimiento()
 //
final class Delantero extends Jugador
{
    private ?int $id;
    // Atributo específico de Delantero (no existe en Jugador)
    private int $goles;

    // CONSTRUCTOR
    public function __construct(string $nombre, int $edad, float $sueldo, int $goles, ?int $id = null)
    {
        // Llamamos al constructor del padre (Jugador)
        // Le pasamos "Delantero" como posición automáticamente
        parent::__construct($nombre, $edad, "Delantero", $sueldo);
        $this->id = $id;
        $this->goles = $goles;
    }

    // MÉTODO OBLIGATORIO - Implementación del método abstracto del padre
    /**
     * Calcula el rendimiento del delantero.
     */
    public function calcularRendimiento(): float
    {
        // Fórmula específica para DELANTEROS: 
        // - Cada gol vale 10 puntos
        // - La edad aporta 0.5 puntos por año
        return ($this->goles * 10) + ($this->edad * 0.5);
    }

    // MÉTODO ESPECÍFICO de Delantero (no existe en Jugador)
    /**
     * Obtiene los goles anotados por el delantero.
     */
    public function getGoles(): int
    {
        return $this->goles;
    }

    // MÉTODO ESPECIAL mejorado - Muestra información completa
    /**
     * Representación en texto del delantero.
     */
    public function __toString(): string
    {
        // Usamos el __toString del padre y añadimos info del delantero
        return parent::__toString() . " - Goles: {$this->goles} - Rendimiento: " . $this->calcularRendimiento();
    }

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(?int $id)
    {
        $this->id = $id;

        return $this;
    }
}
