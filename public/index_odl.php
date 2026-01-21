<?php

// REAL MADRID FAN CLUB - PLATAFORMA DE GESTIÓN
// 
// TEMÁTICA: Sistema web para gestión del Real Madrid CF
// 
// DESCRIPCIÓN:
// Plataforma que permite a aficionados registrarse y acceder
// a información exclusiva del equipo. Combina funciones de
// red social deportiva con gestión técnica del club.
// 
// FUNCIONALIDADES:
// - Registro e inicio de sesión de aficionados
// - Gestión de jugadores por posiciones específicas
// - Cálculo de rendimiento y estadísticas
// - Control de nóminas y bonuses
// - Seguimiento de lesiones y títulos
// 
// ESTRUCTURA DE CLASES:
// Usuario: Gestión de aficionados y socios
// Jugador: Clase abstracta base para especializaciones  
// Delantero, Centrocampista, Defensa: Posiciones específicas
// Entrenador: Gestión del cuerpo técnico
// Equipo: Composición completa del la plantilla



include $_SERVER ['DOCUMENT_ROOT'] . '/app/models/Usuario.php';
include $_SERVER ['DOCUMENT_ROOT'] . '/app/models/Jugador.php';
include $_SERVER ['DOCUMENT_ROOT'] . '/app/models/Delantero.php';
include $_SERVER ['DOCUMENT_ROOT'] . '/app/models/Centrocampista.php';
include $_SERVER ['DOCUMENT_ROOT'] . '/app/models/Defensa.php';
include $_SERVER ['DOCUMENT_ROOT'] . '/app/models/Entrenador.php';
include $_SERVER ['DOCUMENT_ROOT'] . '/app/models/Equipo.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Real Madrid - POO</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Real Madrid - Práctica 2 POO</h1>
    <hr>

    <h2>Usuarios</h2>
    <?php
    $socio = new Usuario("Carlos Madridista", "carlos@realmadrid.com", "HalaMadrid2024", "2024-01-01", true);
    $aficionado = new Usuario("Ana García", "ana@email.com", "password123", "2024-01-15", false);
    
    echo "<p>" . $socio . "</p>";
    echo "<p>Username: " . Usuario::generarUsuario("carlos@realmadrid.com") . "</p>";
    echo "<p>Antigüedad: " . $socio->calcularAntiguedad() . " días</p>";
    echo "<p>Contraseña correcta: " . ($socio->verificarContraseña("HalaMadrid2024") ? "Sí" : "No") . "</p>";
    ?>

    <h2>Entrenador</h2>
    <?php
    $ancelotti = new Entrenador("Carlo Ancelotti", 64, 800000, 25);
    $ancelotti->anadirTitulo("Champions League 2022");
    $ancelotti->anadirTitulo("Liga Española 2022");
    
    echo "<p>" . $ancelotti . "</p>";
    echo "<p>Bonus: " . $ancelotti->calcularBonus() . "€</p>";
    echo "<p>Sueldo total: " . $ancelotti->calcularSueldoTotal() . "€</p>";
    echo "<p>Títulos: " . implode(", ", $ancelotti->obtenerTitulos()) . "</p>";
    ?>

    <h2>Jugadores</h2>
    <?php
    $benzema = new Delantero("Karim Benzema", 35, 500000, 25);
    $kroos = new Centrocampista("Toni Kroos", 33, 400000, 15);
    $alaba = new Defensa("David Alaba", 30, 350000, 8);
    
    $jugadores = [$benzema, $kroos, $alaba];
    
    foreach ($jugadores as $jugador) {
        echo "<p>" . $jugador . "</p>";
        echo "<p>Rendimiento: " . $jugador->calcularRendimiento() . "</p>";
        echo "<p>Sueldo con bonus: " . $jugador->calcularSueldoConBonus() . "€</p>";
        
        $jugador->anadirLesion("Lesión leve");
        echo "<p>Lesiones: " . implode(", ", $jugador->obtenerLesiones()) . "</p><br>";
    }
    ?>

    <h2>Equipo</h2>
    <?php
    $realMadrid = new Equipo("Real Madrid", $ancelotti);
    
    foreach ($jugadores as $jugador) {
        $realMadrid->anadirJugador($jugador);
    }
    
    echo "<p>" . $realMadrid . "</p>";
    echo "<p>Nómina total: " . $realMadrid->calcularNominaTotal() . "€</p>";
    echo "<p>Edad promedio: " . $realMadrid->calcularEdadPromedio() . " años</p>";
    echo "<p>Rendimiento promedio: " . $realMadrid->calcularRendimientoPromedio() . "</p>";
    
    $encontrado = $realMadrid->buscarJugador("Toni Kroos");
    echo "<p>Jugador encontrado: " . $encontrado->getNombre() . "</p>";
    
    echo "<p>Nombre válido: " . (Equipo::esNombreValido("Real Madrid") ? "Sí" : "No") . "</p>";
    ?>

    <h2>Array de Objetos</h2>
    <?php
    $arrayJugadores = [
        new Delantero("Vinicius Jr", 23, 300000, 18),
        new Centrocampista("Luka Modric", 38, 450000, 12),
        new Defensa("Eder Militao", 25, 280000, 5)
    ];
    
    foreach ($arrayJugadores as $jugador) {
        echo "<p>" . $jugador->getNombre() . " - " . $jugador->getPosicion() . "</p>";
    }
    ?>
</body>
</html>