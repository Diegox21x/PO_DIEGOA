<?php

class Entrenador{
    private string $nombre;
    private int $edad;
    private float $sueldo;
    private int $anosExperiencia;
    private  array $titulos;

    public function __construct(string $nombre , int $edad , float $sueldo , int $anosExperiencia ) {

		$this->nombre = $nombre;
        $this->edad = $edad;
        $this->sueldo = $sueldo;
        $this->anosExperiencia = $anosExperiencia;
        $this->titulos = [];
        
	}

    //------------------------------------------------------------------
    //---------------------------Metodos--------------------------------

   // Añadir un titulo al array

    public function anadirTitulo(string $titulo):void{
        $this->titulos[] = $titulo;
    }


    //Para eliminar titulo

    public function eliminarTitulo(string $titulo):bool{

        $indice = array_search($titulo , $this->titulos);
        if($indice !== false){

            unset($this->titulos[$indice]); //unset para elimnar 
            return true;
        }

        return false;


    }


    //Buscar el titulo.

    // in_array() - Solo saber si existe
    //$existe = in_array($titulo, $this->titulos); 
    // Retorna: true o false

    // array_search() - Saber posición donde existe  
    //$posicion = array_search($titulo, $this->titulos);
    // Retorna: 0, 1, 2... o false

    

    public function buscarTitulo(string $titulo):bool{
        return in_array($titulo,$this->titulos);

    } 


    public function obtenerTitulos():array{
       return $this->titulos;
    }


    //BONUS por cada año en el club 5000 euros más

    public function calcularBonus():float{

        return $this->anosExperiencia * 5000;
    }

    public function calcularSueldoTotal():float{
        return $this->sueldo + $this->calcularBonus();

    }

    //MÉTODO ESTÁTICO - se usa SIN crear objeto


     public static function esEdadValida(int $edad): bool
    {
        return $edad >= 25 && $edad <= 75; 
    }


    public function __toString(): string
    {
        return "Entrenador: {$this->nombre} - Edad: {$this->edad} - Experiencia: {$this->anosExperiencia} años - Sueldo: {$this->sueldo}€"; // ✅ SÍ lleva return
    }


    //------------------------------------------------------------------
    //------------------------------------------------------------------


    
    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of edad
     */ 
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set the value of edad
     *
     * @return  self
     */ 
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get the value of sueldo
     */ 
    public function getSueldo()
    {
        return $this->sueldo;
    }

    /**
     * Set the value of sueldo
     *
     * @return  self
     */ 
    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;

        return $this;
    }

    /**
     * Get the value of añosExperiencia
     */ 
    public function getAnosExperiencia()
    {
        return $this->anosExperiencia;
    }

    /**
     * Set the value of añosExperiencia
     *
     * @return  self
     */ 
    public function setAnosExperiencia($anosExperiencia)
    {
        $this->anosExperiencia = $anosExperiencia;

        return $this;
    }

    /**
     * Get the value of titulos
     */ 
    public function getTitulos()
    {
        return $this->titulos;
    }

    /**
     * Set the value of titulos
     *
     * @return  self
     */ 
    public function setTitulos($titulos)
    {
        $this->titulos = $titulos;

        return $this;
    }


	
}