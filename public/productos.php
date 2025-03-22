<?php


  // ********* INFO PARA EL TEMPLATE **********
  $tituloHead = "Productos de Electrónica";
  $content;

  // ********* COMIENZO BUFFER **********
  ob_start();

  $productos_electronica = [
      [
          "nombre" => "Tarjeta Gráfica NVIDIA RTX 3080",
          "descripcion" => "Potente tarjeta gráfica para gaming y diseño.",
          "precio" => 899.99
      ],
      [
          "nombre" => "Procesador AMD Ryzen 9 5900X",
          "descripcion" => "CPU de alto rendimiento con 12 núcleos.",
          "precio" => 549.99
      ],
      [
          "nombre" => "Placa Base ASUS ROG Strix B550-F",
          "descripcion" => "Placa base para gaming con soporte para Ryzen.",
          "precio" => 199.99
      ],
      [
          "nombre" => "Memoria RAM Corsair Vengeance 16GB",
          "descripcion" => "Kit de memoria DDR4 de alta velocidad.",
          "precio" => 89.99
      ],
      [
          "nombre" => "Disco Duro SSD Samsung 970 EVO 1TB",
          "descripcion" => "Almacenamiento rápido NVMe para tu PC.",
          "precio" => 129.99
      ],
      [
          "nombre" => "Fuente de Alimentación EVGA 750W",
          "descripcion" => "Fuente modular con certificación 80+ Gold.",
          "precio" => 109.99
      ],
      [
          "nombre" => "Caja NZXT H510",
          "descripcion" => "Caja compacta y moderna para PC.",
          "precio" => 79.99
      ],
      [
          "nombre" => "Refrigeración Líquida Cooler Master ML240L",
          "descripcion" => "Sistema de refrigeración líquida para CPU.",
          "precio" => 99.99
      ],
      [
          "nombre" => "Monitor LG UltraGear 27GL850",
          "descripcion" => "Monitor gaming de 27 pulgadas con 144Hz.",
          "precio" => 399.99
      ],
      [
          "nombre" => "Teclado Mecánico Logitech G Pro",
          "descripcion" => "Teclado mecánico compacto para gaming.",
          "precio" => 129.99
      ]
  ];
?>

  <h1 class="title title--l text-align-center">GÉNEROS</h1>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($productos_electronica as $producto) { ?>
        <tr>
          <td><?php echo $producto["nombre"]?></td>
          <td><?=$producto["descripcion"]?></td> <!-- ?= es igual a ?php echo, es una acortación, para printeos breves -->
          <td><?=$producto["precio"]?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

<?php

  // ********* FIN BUFFER + LLAMADA AL TEMPLATE **********
  $content = ob_get_contents();
  ob_end_clean();
  require("template.php");

?>