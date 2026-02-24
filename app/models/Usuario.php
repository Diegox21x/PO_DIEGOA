<?php

//CLase que representa a un usuario/aficinado del real madrid
//registra el incio de sesión de los usuarios.





	
    //--------------------------------------------------------------


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
