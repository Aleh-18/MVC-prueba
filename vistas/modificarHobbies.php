<?php
echo "<h1>Modificar Hobbies de " . $filaUsuario['usuario'] . "</h1>";

// Mostrar hobbies actuales (los que vienen desde el controlador)
echo "<h3>Hobbies actuales:</h3>";
if (!empty($hobbiesdeUsuario)) {
    foreach ($hobbiesdeUsuario as $h) {
        echo "<p>" . $h['hobby'] . "</p>";
    }
} else {
    echo "<p>No tienes hobbies asignados.</p>";
}

// Formulario simple para cambiar hobbies (checkboxes abajo)
echo "<form method='post' action='pGuardarHobbies.php?id=" . $filaUsuario['id'] . "'>";


echo "<h3>Selecciona tus hobbies:</h3>";
foreach ($todosHobbies as $hobby) {

    echo "<input type='checkbox' name='hobbies[]' value='" . $hobby['id']."' >". $hobby['hobby'];
    echo "<br><br>";
}

echo "<input type='submit' name='accion' value='guardarHobbies'>";
echo " <a href='pLogin.php?id=" . $filaUsuario['id']. "'>Cancelar</a>";
echo "</form>";
?>
