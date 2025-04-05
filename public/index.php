<?php

/*********** INIT (DB Y DEMÁS) ***********/
require_once("../src/init.php");

// ********* INFO PARA EL TEMPLATE **********
$tituloHead = "Index";
$content;

// ********* COMIENZO BUFFER **********
ob_start();

?>

<h1 class="text-center">Index (página principal)</h1>

<p>
  Lorem ipsum, dolor sit amet consectetur adipisicing elit.
  Adipisci eveniet minus dolorem, dolore facilis magnam deleniti ad est iusto nesciunt, 
  necessitatibus et amet enim perferendis quidem. Quos id sed laborum praesentium totam recusandae,
  esse eveniet sit itaque saepe aperiam vero dolorem, facere libero, assumenda explicabo voluptas quidem?
  Earum, quasi cupiditate!
</p>

<?php

// ********* FIN BUFFER + LLAMADA AL TEMPLATE **********
$content = ob_get_contents();
ob_end_clean();
require("template.php");

?>