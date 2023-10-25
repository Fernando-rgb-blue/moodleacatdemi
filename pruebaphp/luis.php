<?php
require_once('../config.php');
global $CFG, $OUTPUT, $PAGE, $DB, $USER;
$redirect = $CFG->wwwroot.'/test/luis.php';

$PAGE->set_url('/test/payments.php');
$PAGE->set_pagelayout('popup');
echo $OUTPUT->header();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ejemplito</title>
    <!-- Agregar enlaces a los archivos de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
echo '<div class="container">';
echo '<h1 class="text-center">Luisin Test</h1>';
echo '<div class="row">';

// Sección de Nombres
echo '<div class="col-md-6">';
echo '<h2 class="text-center">Nombres</h2>';
echo '<p>' . $USER->firstname . '</p>';
echo '</div>';

// Sección de Apellidos
echo '<div class="col-md-6">';
echo '<h2 class="text-center">Apellidos</h2>';
echo '<p>' . $USER->lastname . '</p>';
echo '</div>';

echo '</div>';
echo '</div>';

// Enlace a Bootstrap JS (opcional, si necesitas funcionalidad específica de Bootstrap)
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>';
echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';

?>
</body>
</html>