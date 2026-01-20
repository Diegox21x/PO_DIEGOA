<?php 

abstract class Jugador {

    protected string $nombre;
    protected int $edad;
    protected string $posicion;
    protected float $sueldo;
    protected array $lesiones;

    

    function __construct(string $nombre, int $edad, string $posicion, float $sueldo, ) {
    	$this->nombre = $nombre;
    	$this->edad = $edad;
    	$this->posicion = $posicion;
    	$this->sueldo = $sueldo;
    	$this->lesiones = [];
    
    }

     //------------------------------------------------------------------
    //---------------------------Metodos--------------------------------

    //MÉTODO ABSTRACTO - Las clases hijas DEBEN implementarlo
     //Calcula el rendimiento del jugador según su posición
    abstract public function calcularRendimiento(): float;

    //añade una lesion
    public function añadirLesion(string $lesion):void{
         $this->lesiones[] = $lesion;
    }

    //eliminar lesion

    public function eliminarLesion(string $lesion):bool{
        $indice = array_search($lesion,$this->lesiones);
        if($indice !== false ){
            unset($this->lesiones[$indice]);
            $this->lesiones = array_values($this->lesiones);
            return true;


        }

        return false;

    }

    //buscar lesion 


    public function buscarLesion(string $lesion): bool
    {
        return in_array($lesion, $this->lesiones);
    }

    
    //OBtener las lesiones

    public function obtenerLesiones(): array
    {
        return $this->lesiones;
    }

    //-----------------BONUS------------------

    //Bonus de sueldo 

    public function calcularSueldoConBonus(): float
    {
        return $this->sueldo + ($this->sueldo * 0.10);
    }


    //Edad valida


    public static function esEdadValida(int $edad): bool
    {
        return $edad >= 16 && $edad <= 40;
    }


    //Represetar jugador

    public function __toString(): string
    {
        return "Jugador: {$this->nombre} - Posición: {$this->posicion} - Edad: {$this->edad} - Sueldo: {$this->sueldo}€";
    }




     //------------------------------------------------------------------
    //----------------------------------------------------------------
   
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
    * @return int
    */
    public function getEdad(): int {
    	return $this->edad;
    }

    /**
    * @param int $edad
    */
    public function setEdad(int $edad): void {
    	$this->edad = $edad;
    }

    /**
    * @return string
    */
    public function getPosicion(): string {
    	return $this->posicion;
    }

    /**
    * @param string $posicion
    */
    public function setPosicion(string $posicion): void {
    	$this->posicion = $posicion;
    }

    /**
    * @return float
    */
    public function getSueldo(): float {
    	return $this->sueldo;
    }

    /**
    * @param float $sueldo
    */
    public function setSueldo(float $sueldo): void {
    	$this->sueldo = $sueldo;
    }

    /**
    * @return array
    */
    public function getLesiones(): array {
    	return $this->lesiones;
    }

    /**
    * @param array $lesiones
    */
    public function setLesiones(array $lesiones): void {
    	$this->lesiones = $lesiones;
    }
}