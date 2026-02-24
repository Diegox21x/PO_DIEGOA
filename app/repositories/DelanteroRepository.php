<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Delantero.php';

class DelanteroRepository
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Database::getConnection();
    }

    /**
     * Guarda un delantero en la base de datos y actualiza su id.
     */
    public function crear(Delantero $delantero): Delantero
    {
        $sql = 'INSERT INTO delanteros (nombre, edad, sueldo, goles)
                VALUES (:nombre, :edad, :sueldo, :goles)';
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $delantero->getNombre(),
            ':edad' => $delantero->getEdad(),
            ':sueldo' => $delantero->getSueldo(),
            ':goles' => $delantero->getGoles(),
        ]);

        $delantero->setId((int) $this->conexion->lastInsertId());

        return $delantero;
    }

    /**
     * Devuelve todos los delanteros almacenados.
     *
     * @return Delantero[]
     */
    public function obtenerTodos(): array
    {
        $sql = 'SELECT * FROM delanteros ORDER BY id DESC';
        $stmt = $this->conexion->query($sql);
        $delanteros = [];

        foreach ($stmt->fetchAll() as $fila) {
            $delanteros[] = new Delantero(
                $fila['nombre'],
                (int) $fila['edad'],
                (float) $fila['sueldo'],
                (int) $fila['goles'],
                (int) $fila['id']
            );
        }

        return $delanteros;
    }

    /**
     * Elimina un delantero por su id.
     */
    public function eliminarPorId(int $id): bool
    {
        $sql = 'DELETE FROM delanteros WHERE id = :id';
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->rowCount() > 0;
    }
}
