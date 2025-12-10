<?php
echo "<h1>Holaap " . $filaUsuario['usuario'] . "</h1>";

echo "<h2>Tus hobbies son:</h2>";
foreach ($hobbies as $h) {
    echo "<p>--- " . $h['hobby'] . "</p>";
}
/*Y usamos las variables del controlador para mostrarlas aqui gracias al require que hace que las variables
/* tmb esten en el archivo que incluye no hace falta ponerlo aqui
/*Con require dir enlazamos todo con todo
*/
echo "<form method='POST' action='pModificarHobbies.php?id=" . $filaUsuario['id'] ."'>";
/*Para mantener la sesion de forma chapuza SOLO PARA ESTA PRUEBA DE MVC*/

echo "<input type='submit' value='Modificar Hobbies'>";
echo "</form>";
?>