<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioRepository
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Database::getConnection();
    }

    /**
     * Crea un usuario en base de datos y actualiza su id.
     */
    public function crear(Usuario $usuario): Usuario
    {
        $sql = 'INSERT INTO usuarios (nombre, email, password, fecha_registro, es_socio)
                VALUES (:nombre, :email, :password, :fecha_registro, :es_socio)';
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $usuario->getNombre(),
            ':email' => $usuario->getEmail(),
            ':password' => $usuario->getContraseña(),
            ':fecha_registro' => $usuario->getFechadeRegistro(),
            ':es_socio' => $usuario->getEsSocio() ? 1 : 0,
        ]);

        $usuario->setId((int) $this->conexion->lastInsertId());

        return $usuario;
    }

    /**
     * Busca un usuario por su email.
     */
    public function buscarPorEmail(string $email): ?Usuario
    {
        $sql = 'SELECT * FROM usuarios WHERE email = :email LIMIT 1';
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':email' => $email]);
        $fila = $stmt->fetch();

        if (!$fila) {
            return null;
        }

        return new Usuario(
            $fila['nombre'],
            $fila['email'],
            $fila['password'],
            $fila['fecha_registro'],
            (bool) $fila['es_socio'],
            true,
            (int) $fila['id']
        );
    }

    /**
     * Busca un usuario por su id.
     */
    public function buscarPorId(int $id): ?Usuario
    {
        $sql = 'SELECT * FROM usuarios WHERE id = :id LIMIT 1';
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        $fila = $stmt->fetch();

        if (!$fila) {
            return null;
        }

        return new Usuario(
            $fila['nombre'],
            $fila['email'],
            $fila['password'],
            $fila['fecha_registro'],
            (bool) $fila['es_socio'],
            true,
            (int) $fila['id']
        );
    }

    /**
     * Verifica credenciales y devuelve el usuario si son correctas.
     */
    public function verificarCredenciales(string $email, string $password): ?Usuario
    {
        $usuario = $this->buscarPorEmail($email);

        if (!$usuario) {
            return null;
        }

        if (!$usuario->verificarContraseña($password)) {
            return null;
        }

        return $usuario;
    }
}
