<?php
require_once('../config.php');
global $CFG, $OUTPUT, $PAGE, $DB;
$redirect = $CFG->wwwroot.'/paymentmethods/payments.php';
echo $OUTPUT->header();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formas de Pago</title>
    <!-- Agregar enlaces a los archivos de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>
    <div class="container">
        <h1 class="text-center">Formas de Pago</h1>
        <div class="row">
            <!-- Sección de Yape -->
            <div class="col-md-6">
                <h2 class="text-center">Yape</h2>
                <p>Yape es una forma de pago rápida y segura a través de tu teléfono móvil. Puedes usarlo para hacer transferencias de dinero de manera conveniente.</p>
                <img src="./code.png" class="img-fluid" alt="Logo de Yape">
            </div>

            <!-- Sección de Visa -->
            <div class="col-md-6">
                <h2 class="text-center">Visa</h2>
                <p>Visa es una tarjeta de crédito ampliamente aceptada en todo el mundo. Con Visa, puedes realizar pagos seguros en línea y en tiendas físicas.</p>
                <img src="./card.png" class="img-fluid" alt="Logo de Visa">
            </div>
        </div>
        <hr>
        <h1 class="text-center">Instrucciones de Pago</h1>
        <div class="row">
            <p>Lalala</p>
        </div>
        <h1 class="text-center">Cursos posibles</h1>
        <div class="row">
            <p>Lalala</p>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS (opcional, si necesitas funcionalidad específica de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$courses = get_courses();

if (!empty($courses)) {
    foreach ($courses as $course) {
        if ($course->id == 1) {
            // Saltar el curso con ID 1
            continue;
        }
        // Comienza una nueva fila si es el primer botón de la fila
        if ($buttonCount % 2 == 0) {
            echo '<div class="row">';
        }

        // Crea un botón que enlace al curso con estilos de Bootstrap y margen inferior.
        echo '<div class="col-md-6" style="margin-bottom: 10px;">';
        echo '<form action="http://127.0.0.1/moodleacatdemi/course/view.php" method="GET">';
        echo '<input type="hidden" name="id" value="' . $course->id . '">';
        echo '<button type="submit" class="btn btn-primary btn-block">' . $course->fullname . '</button>';
        echo '</form>';
        echo '</div>';

        $buttonCount++;

        // Cierra la fila si es el segundo botón de la fila o el último botón
        if ($buttonCount % 2 == 0 || $buttonCount == count($courses) - 1) {
            echo '</div>';
        }
    }
} else {
    echo "No se encontraron cursos con ID mayor que 1.";
}
echo $OUTPUT->footer();
?>
