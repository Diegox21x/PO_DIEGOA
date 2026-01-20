<?php

require_once 'Entrenador.php';
require_once 'Jugador.php';

//Clase Equipo - Representa un equipo de fútbol
 //Usa COMPOSICIÓN: un equipo tiene un entrenador y varios jugadores
 //Gestiona un array de objetos Jugador

class Equipo
{
    // ATRIBUTOS PRIVADOS
    private string $nombre;
    private array $jugadores; // Array de objetos Jugador
    private Entrenador $entrenador; 
    public function __construct(string $nombre, Entrenador $entrenador)
    {
        $this->nombre = $nombre;
        $this->jugadores = [];
        $this->entrenador = $entrenador; 
    }

     //------------------------------------------------------------------
    //---------------------------Metodos--------------------------------

    /**
     * Añade un jugador al array del equipo
     */
    public function añadirJugador(Jugador $jugador): void
    {
        $this->jugadores[] = $jugador;
    }

    /**
     * Elimina un jugador del array por nombre
     */
    public function eliminarJugador(string $nombreJugador): bool
    {
        foreach ($this->jugadores as $indice => $jugador) {
            if ($jugador->getNombre() === $nombreJugador) {
                unset($this->jugadores[$indice]);
                $this->jugadores = array_values($this->jugadores); // Reindexar
                return true;
            }
        }
        return false;
    }

    /**
     * Busca un jugador por nombre
     */
    public function buscarJugador(string $nombreJugador): ?Jugador
    {
        foreach ($this->jugadores as $jugador) {
            if ($jugador->getNombre() === $nombreJugador) {
                return $jugador; // Retorna el objeto Jugador encontrado
            }
        }
        return null; // Retorna null si no lo encuentra
    }

    /**
     * Obtiene todos los jugadores del equipo
     */
    public function obtenerJugadores(): array
    {
        return $this->jugadores;
    }

    

    /**
     * Calcula la nómina total del equipo (jugadores + entrenador)
     */
    public function calcularNominaTotal(): float
    {
        $total = 0;
        
        // Sumar sueldos de todos los jugadores
        foreach ($this->jugadores as $jugador) {
            $total += $jugador->getSueldo();
        }
        
        // Sumar sueldo del entrenador
        $total += $this->entrenador->getSueldo();
        
        return $total;
    }

    /**
     * Calcula el promedio de edad del equipo
     */
    public function calcularEdadPromedio(): float
    {
        if (empty($this->jugadores)) {
            return 0;
        }
        
        $totalEdad = 0;
        foreach ($this->jugadores as $jugador) {
            $totalEdad += $jugador->getEdad();
        }
        
        return $totalEdad / count($this->jugadores);
    }

    /**
     * Calcula el rendimiento promedio del equipo
     */
    public function calcularRendimientoPromedio(): float
    {
        if (empty($this->jugadores)) {
            return 0;
        }
        
        $totalRendimiento = 0;
        foreach ($this->jugadores as $jugador) {
            $totalRendimiento += $jugador->calcularRendimiento();
        }
        
        return $totalRendimiento / count($this->jugadores);
    }

  

    /**
     * Verifica si un nombre de equipo es válido
     * MÉTODO ESTÁTICO - se usa SIN crear objeto
     */
    public static function esNombreValido(string $nombre): bool
    {
        return strlen(trim($nombre)) >= 3 && strlen(trim($nombre)) <= 50;
    }


    /**
     * Representación en texto del equipo
     */
    public function __toString(): string
    {
        return "Equipo: {$this->nombre} - Jugadores: " . count($this->jugadores) . 
               " - Entrenador: {$this->entrenador->getNombre()} - Nómina: " . $this->calcularNominaTotal() . "€";
    }


 //------------------------------------------------------------------
//-----------------------------------------------------------



    

    /**
    * @return string
    */
    public function getNombre(): string {
    	return $this->nombre;
    }

    /**
    * @param string $nombre
    */
    public function setNombre(string $nombre): void {
    	$this->nombre = $nombre;
    }

    /**
    * @return array
    */
    public function getJugadores(): array {
    	return $this->jugadores;
    }

    /**
    * @param array $jugadores
    */
    public function setJugadores(array $jugadores): void {
    	$this->jugadores = $jugadores;
    }

    /**
    * @return Entrenador
    */
    public function getEntrenador(): Entrenador {
    	return $this->entrenador;
    }

    /**
    * @param Entrenador $entrenador
    */
    public function setEntrenador(Entrenador $entrenador): void {
    	$this->entrenador = $entrenador;
    }
}