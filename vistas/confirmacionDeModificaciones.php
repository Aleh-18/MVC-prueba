<?php

echo "<h2>¡Hobbies actualizados correctamente!</h2>";

echo "<form method='post' action='pLogin.php?id=" . $filaUsuario['id']. "'>";
echo "<button type='submit' name='accion' value='login'>Ver mis datos en la pantalla de sesion Iniciada</button>";
echo "</form>";
?>