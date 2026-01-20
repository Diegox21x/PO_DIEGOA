<?php

//CLase que representa a un usuario/aficinado del real madrid
//registra el incio de sesión de los usuarios.


class Usuario{

    //atributos privados(datsos protegidos)
    private string $nombre;
    private string $email;
    private string $contraseña;
    private string $fechadeRegistro;
    private bool $esSocio;

    

    public function __construct(string $nombre , string $email , string $contraseña , $fechadeRegistro , bool $esSocio){

        $this->nombre = $nombre;
        $this->email = $email;
        $this->contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
        $this->fechadeRegistro = $fechadeRegistro;
        $this->esSocio = $esSocio;
        

        //password_hash para realizar una contraseña hasheada, tipo si es 123 te dara un tetxo largo , a 123 le aplica un algortimo.



    }

	
    //--------------------------------------------------------------
     //------------------------------METODOS-----------------------
        public function verificarContraseña(string $contraseñIntroducida):bool{

            return password_verify($contraseñIntroducida, $this->contraseña);
       
       
        }

    // password_verify compara la contraseña introducida.

        public static function generarUsuario(string $email):string
        {
            $parteUsuario = explode('@' , $email)[0];
            return $parteUsuario . '_madridista';


        }


        public function calcularAntiguedad(): int{
             $fechadeRegistro = new DateTime($this->fechadeRegistro);
             $fechaActual = new DateTime();
             $diferencia = $fechaActual->diff($fechadeRegistro);
             return abs($diferencia->days);
        }


        public function __toString():string{
            $tipos = $this->esSocio ? "Es socio del Real Madrid" : "Aficionado";
            
            return  "Ususario: {$this->nombre} ({$this->email}) - {$tipos}- {$this->fechadeRegistro}";

        }




     //--------------------------------------------------------------

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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of contraseña
     */ 
    public function getContraseña()
    {
        return $this->contraseña;
    }

    /**
     * Set the value of contraseña
     *
     * @return  self
     */ 
    public function setContraseña($contraseña)
    {
        $this->contraseña = $contraseña;

        return $this;
    }

    /**
     * Get the value of fechadeRegistro
     */ 
    public function getFechadeRegistro()
    {
        return $this->fechadeRegistro;
    }

    /**
     * Set the value of fechadeRegistro
     *
     * @return  self
     */ 
    public function setFechadeRegistro($fechadeRegistro)
    {
        $this->fechadeRegistro = $fechadeRegistro;

        return $this;
    }

    /**
     * Get the value of esSocio
     */ 
    public function getEsSocio()
    {
        return $this->esSocio;
    }

    /**
     * Set the value of esSocio
     *
     * @return  self
     */ 
    public function setEsSocio($esSocio)
    {
        $this->esSocio = $esSocio;

        return $this;
    }
}