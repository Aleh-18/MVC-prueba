<?php

echo "<h2>¡Hobbies actualizados correctamente!</h2>";

echo "<form method='post' action='comenzar.php?id=" . $filaUsuario['id']. "'>";
echo "<button type='submit' name='accion' value='login'>Ver mis datos</button>";
echo "</form>";
?>