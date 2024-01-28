<?php

    // This file is part of Moodle - http://moodle.org/
    //
    // Moodle is free software: you can redistribute it and/or modify
    // it under the terms of the GNU General Public License as published by
    // the Free Software Foundation, either version 3 of the License, or
    // (at your option) any later version.
    //
    // Moodle is distributed in the hope that it will be useful,
    // but WITHOUT ANY WARRANTY; without even the implied warranty of
    // MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    // GNU General Public License for more details.
    //
    // You should have received a copy of the GNU General Public License
    // along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

    /**
     * Main login page.
     *
     * @package    core
     * @subpackage auth
     * @copyright  1999 onwards Martin Dougiamas  http://dougiamas.com
     * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
     */

    require('../config.php');
    require_once('lib.php');

    // mi php
    require_once('../config.php');
    global $CFG, $OUTPUT, $PAGE, $DB, $USER;
    $redirect = $CFG->wwwroot.'index.php';
    $campos = $DB->get_records_sql("SELECT * FROM {cursosp}"); 

    $resultados = $DB->get_records_sql("SELECT DISTINCT titulo, url FROM {cursosp}");

    $ocursos = [];
    $urls = [];

    foreach ($resultados as $resultado) {
        $ocursos[] = $resultado->titulo;
        $urls[] = $resultado->url;
    }

?> 


<!DOCTYPE html>
<html lang="es" class="my-page">
<body>
    <head>
        <title>Login|Ingresar</title>
    </head>
    <header class="page-wrapper">
            <div class="nav-wrapper">
                <div class="grad-bar"></div>
                    <nav class="navbar">
                        <a><img src="../pre/que/cambiado.svg" id="logoHome2" alt="Company Logo" class="lo"></a>
                        <div class="menu-toggle" id="mobile-menu">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </div>
                        <ul class="nav no-search">
                            <li class="nav-item" id="ocultar">
                                <img src="../pre/que/lupa.svg" height="20px" alt="" id="lupaImagen">
                                <input type="text" id="search-input" class="search-input" placeholder="Buscar curso...">
                                <ul id="suggestions" class="dropdown-content"></ul>
                            </li>
                            <li class="nav-item"><a href="../pre/courses.php" id="cursos">Cursos</a></li>
                            <li class="nav-item"><a href="../pre/help.php" id="ayuda">Ayuda</a></li>
                            <li class="nav-item">
                                <div class="dropdown" id="idiomaDropdown">
                                    <a><span id="idioma">Idioma</span></a>
                                    <div class="dropdown-content">
                                        <div id="ingles" class="dropdown-option" onclick="cambiarIdioma('en')">Inglés</div>
                                        <div id="espanol" class="dropdown-option" onclick="cambiarIdioma('es')">Español</div>
                                        <!-- <div id="frances" class="dropdown-option" onclick="cambiarIdioma('fr')">Francés</div> -->
                                        <div id="portugues" class="dropdown-option" onclick="cambiarIdioma('pt')">Portugués</div>

                                    </div>
                                </div>
                            </li>
                            <li class="nav-item"><a href="../index.php" id="ayuda">Pre</a></li>
                            <?php
                                if (!empty($USER->firstname) && !empty($USER->lastname) && strtoupper(substr($USER->firstname, 0, 1)) !='&' && strtoupper($USER->firstname) !='INVITADO') {
                                    echo '<li class="nav-item iniciar">';
                                    echo '<a id="desloguear" href="" target="_blank" onclick="abrirVentanaYRecargar()">Salir sesión</a>';
                                    echo '</li>';
                                    echo '<li class="nav-item crear">';
                                    echo '<img src="que/usuario.svg" height="20px" alt="" id="imgusuario">';
                                    echo '<a href="../user/profile.php">';
                                    echo '<span>' . strtoupper(substr($USER->firstname, 0, 1)) . strtoupper(substr($USER->lastname, 0, 1)) . '</span>';
                                    echo '</a>';
                                    echo '</li>';
                                } else {
                                    echo '<li class="nav-item iniciar prim"><a id="iniciar" href="index.php">Ingresar</a></li>';
                                    echo '<li class="nav-item crear prim"><a id="registrarse" href="../login/signup.php">Registrarse</a></li>';
                                }
                            ?>
                        </ul> 
                    </nav>
                </div>
    </header>
    
    
                                

    <script> 
            // para poner un 'a' a mi img del logohome2
            var miImagenhome2 = document.getElementById('logoHome2');

            // Agregamos un evento de clic a la imagen
            miImagenhome2.addEventListener('click', function() {
                window.location.href = '../pre/index.php';
            });            
            
            // inicio de busqueda
            // Array de opciones de sugerencias ocursos
            // const opciones = ["programacion en python", "redes y topologias", "switch"];
            const opciones = <?php echo json_encode($ocursos); ?>;
            const opurl = <?php echo json_encode($urls); ?>;
            const lupaImagen = document.getElementById("lupaImagen");

            // Maneja el clic en la imagen de la lupa
            lupaImagen.addEventListener("click", function () {
                const searchInput = document.getElementById("search-input");

                // Activa el input de búsqueda y enfócalo
                searchInput.classList.add("search-active");
                searchInput.focus();
            });
            // Función para mostrar sugerencias
            function mostrarSugerencias(inputValue) {
                const suggestions = opciones.filter((opcion) =>
                    opcion.toLowerCase().includes(inputValue.toLowerCase())
                );

                const suggestionsList = document.getElementById("suggestions");

                // Limpia la lista de sugerencias previas
                suggestionsList.innerHTML = "";

                // Calcula la posición y el ancho de la barra de búsqueda
                const searchInput = document.getElementById("search-input");
                const inputRect = searchInput.getBoundingClientRect();
                const inputWidth = inputRect.width;
                const inputTop = inputRect.bottom;

                // Actualiza la posición de la lista de sugerencias
                suggestionsList.style.width = inputWidth + "px";
                suggestionsList.style.top = inputTop + "px";
                suggestionsList.style.left = inputRect.left + "px";

                // Muestra u oculta la lista de sugerencias según si hay coincidencias
                if (inputValue.length > 0 && suggestions.length > 0) {
                    // Agrega las sugerencias coincidentes a la lista
                    suggestions.forEach((suggestion) => {
                    const listItem = document.createElement("li");
                    listItem.textContent = suggestion;
                    listItem.classList.add("dropdown-option");
                    suggestionsList.appendChild(listItem);
                    });

                    suggestionsList.style.display = "block";
                } else if(inputValue.length === 0) {
                        suggestionsList.style.display = "none"; // Oculta la lista si está vacío
                }else {
                    // Si no hay coincidencias, muestra el mensaje "Curso no encontrado"
                    const listItem = document.createElement("li");
                    listItem.textContent = "❌ No encontrado";
                    listItem.classList.add("dropdown-option");
                    suggestionsList.appendChild(listItem);
                    suggestionsList.style.display = "block";
                }
            }

            // Función para manejar el redireccionamiento
            function redirigirURL(url) {
                window.open(url, '_blank');
            }

            // Maneja el clic en una sugerencia para llenar la barra de búsqueda
            document.getElementById("suggestions").addEventListener("click", function (event) {
                const clickedSuggestion = event.target.textContent;
                this.style.display = "none";

                switch (clickedSuggestion) {
                    case "Curso no encontrado":
                        // Aquí puedes manejar el comportamiento personalizado para "Curso no encontrado"
                        // Por ejemplo, mostrar un mensaje de error o realizar otra acción.
                        break;
                    default:
                        // Busca la opción seleccionada en el arreglo 'opciones' opciones opurl
                        const selectedIndex = opciones.findIndex(option => option === clickedSuggestion);

                        if (selectedIndex !== -1 && opciones[selectedIndex]) {
                            const urlSeleccionada = opurl[selectedIndex];
                            // Redirige directamente a la URL
                            redirigirURL(urlSeleccionada);
                        } else {
                            // Si la opción no se encuentra en el arreglo, redirige a home.html por defecto
                            redirigirURL("index.html");
                        }

                        break;
                }
            });

            // Maneja el evento de cambio en el input de búsqueda
            document.getElementById("search-input").addEventListener("input", function () {
                const inputValue = this.value;
                mostrarSugerencias(inputValue);
            });

            // Cerrar la lista de sugerencias si se hace clic en cualquier lugar fuera de ella
            document.addEventListener("click", function (event) {
                if (!event.target.closest(".search-input")) {
                    document.getElementById("suggestions").style.display = "none";
                }
            });
            // fin de busqueda
        </script>                      
    </body>
</html>   





<?php
redirect_if_major_upgrade_required();

$testsession = optional_param('testsession', 0, PARAM_INT); // test session works properly
$anchor      = optional_param('anchor', '', PARAM_RAW);     // Used to restore hash anchor to wantsurl.

$resendconfirmemail = optional_param('resendconfirmemail', false, PARAM_BOOL);

// It might be safe to do this for non-Behat sites, or there might
// be a security risk. For now we only allow it on Behat sites.
// If you wants to do the analysis, you may be able to remove the
// if (BEHAT_SITE_RUNNING).
if (defined('BEHAT_SITE_RUNNING') && BEHAT_SITE_RUNNING) {
    $wantsurl    = optional_param('wantsurl', '', PARAM_LOCALURL);   // Overrides $SESSION->wantsurl if given.
    if ($wantsurl !== '') {
        $SESSION->wantsurl = (new moodle_url($wantsurl))->out(false);
    }
}

$context = context_system::instance();
$PAGE->set_url("$CFG->wwwroot/login/index.php");
$PAGE->set_context($context);
$PAGE->set_pagelayout('login');

/// Initialize variables
$errormsg = '';
$errorcode = 0;

// login page requested session test
if ($testsession) {
    if ($testsession == $USER->id) {
        if (isset($SESSION->wantsurl)) {
            $urltogo = $SESSION->wantsurl;
        } else {
            $urltogo = $CFG->wwwroot.'/';
        }
        unset($SESSION->wantsurl);
        redirect($urltogo);
    } else {
        // TODO: try to find out what is the exact reason why sessions do not work
        $errormsg = get_string("cookiesnotenabled");
        $errorcode = 1;
    }
}

/// Check for timed out sessions
if (!empty($SESSION->has_timed_out)) {
    $session_has_timed_out = true;
    unset($SESSION->has_timed_out);
} else {
    $session_has_timed_out = false;
}

$frm  = false;
$user = false;

$authsequence = get_enabled_auth_plugins(); // Auths, in sequence.
foreach($authsequence as $authname) {
    $authplugin = get_auth_plugin($authname);
    // The auth plugin's loginpage_hook() can eventually set $frm and/or $user.
    $authplugin->loginpage_hook();
}


/// Define variables used in page
$site = get_site();

// Ignore any active pages in the navigation/settings.
// We do this because there won't be an active page there, and by ignoring the active pages the
// navigation and settings won't be initialised unless something else needs them.
$PAGE->navbar->ignore_active();
$loginsite = get_string("loginsite");
$PAGE->navbar->add($loginsite);

if ($user !== false or $frm !== false or $errormsg !== '') {
    // some auth plugin already supplied full user, fake form data or prevented user login with error message

} else if (!empty($SESSION->wantsurl) && file_exists($CFG->dirroot.'/login/weblinkauth.php')) {
    // Handles the case of another Moodle site linking into a page on this site
    //TODO: move weblink into own auth plugin
    include($CFG->dirroot.'/login/weblinkauth.php');
    if (function_exists('weblink_auth')) {
        $user = weblink_auth($SESSION->wantsurl);
    }
    if ($user) {
        $frm->username = $user->username;
    } else {
        $frm = data_submitted();
    }

} else {
    $frm = data_submitted();
}

// Restore the #anchor to the original wantsurl. Note that this
// will only work for internal auth plugins, SSO plugins such as
// SAML / CAS / OIDC will have to handle this correctly directly.
if ($anchor && isset($SESSION->wantsurl) && strpos($SESSION->wantsurl, '#') === false) {
    $wantsurl = new moodle_url($SESSION->wantsurl);
    $wantsurl->set_anchor(substr($anchor, 1));
    $SESSION->wantsurl = $wantsurl->out();
}

/// Check if the user has actually submitted login data to us

if ($frm and isset($frm->username)) {                             // Login WITH cookies

    $frm->username = trim(core_text::strtolower($frm->username));

    if (is_enabled_auth('none') ) {
        if ($frm->username !== core_user::clean_field($frm->username, 'username')) {
            $errormsg = get_string('username').': '.get_string("invalidusername");
            $errorcode = 2;
            $user = null;
        }
    }

    if ($user) {
        // The auth plugin has already provided the user via the loginpage_hook() called above.
    } else if (($frm->username == 'guest') and empty($CFG->guestloginbutton)) {
        $user = false;    /// Can't log in as guest if guest button is disabled
        $frm = false;
    } else {
        if (empty($errormsg)) {
            $logintoken = isset($frm->logintoken) ? $frm->logintoken : '';
            $user = authenticate_user_login($frm->username, $frm->password, false, $errorcode, $logintoken);
        }
    }

    // Intercept 'restored' users to provide them with info & reset password
    if (!$user and $frm and is_restored_user($frm->username)) {
        $PAGE->set_title(get_string('restoredaccount'));
        $PAGE->set_heading($site->fullname);
        echo $OUTPUT->header();
        echo $OUTPUT->heading(get_string('restoredaccount'));
        echo $OUTPUT->box(get_string('restoredaccountinfo'), 'generalbox boxaligncenter');
        require_once('restored_password_form.php'); // Use our "supplanter" login_forgot_password_form. MDL-20846
        $form = new login_forgot_password_form('forgot_password.php', array('username' => $frm->username));
        $form->display();
        echo $OUTPUT->footer();
        die;
    }

    if ($user) {

        // language setup
        if (isguestuser($user)) {
            // no predefined language for guests - use existing session or default site lang
            unset($user->lang);

        } else if (!empty($user->lang)) {
            // unset previous session language - use user preference instead
            unset($SESSION->lang);
        }

        if (empty($user->confirmed)) {       // This account was never confirmed
            $PAGE->set_title(get_string("mustconfirm"));
            $PAGE->set_heading($site->fullname);
            echo $OUTPUT->header();
            echo $OUTPUT->heading(get_string("mustconfirm"));
            if ($resendconfirmemail) {
                if (!send_confirmation_email($user)) {
                    echo $OUTPUT->notification(get_string('emailconfirmsentfailure'), \core\output\notification::NOTIFY_ERROR);
                } else {
                    echo $OUTPUT->notification(get_string('emailconfirmsentsuccess'), \core\output\notification::NOTIFY_SUCCESS);
                }
            }
            echo $OUTPUT->box(get_string("emailconfirmsent", "", s($user->email)), "generalbox boxaligncenter");
            $resendconfirmurl = new moodle_url('/login/index.php',
                [
                    'username' => $frm->username,
                    'password' => $frm->password,
                    'resendconfirmemail' => true,
                    'logintoken' => \core\session\manager::get_login_token()
                ]
            );
            echo $OUTPUT->single_button($resendconfirmurl, get_string('emailconfirmationresend'));
            echo $OUTPUT->footer();
            die;
        }

    /// Let's get them all set up.
        complete_user_login($user);

        \core\session\manager::apply_concurrent_login_limit($user->id, session_id());

        // sets the username cookie
        if (!empty($CFG->nolastloggedin)) {
            // do not store last logged in user in cookie
            // auth plugins can temporarily override this from loginpage_hook()
            // do not save $CFG->nolastloggedin in database!

        } else if (empty($CFG->rememberusername)) {
            // no permanent cookies, delete old one if exists
            set_moodle_cookie('');

        } else {
            set_moodle_cookie($USER->username);
        }

        $urltogo = core_login_get_return_url();

    /// check if user password has expired
    /// Currently supported only for ldap-authentication module
        $userauth = get_auth_plugin($USER->auth);
        if (!isguestuser() and !empty($userauth->config->expiration) and $userauth->config->expiration == 1) {
            $externalchangepassword = false;
            if ($userauth->can_change_password()) {
                $passwordchangeurl = $userauth->change_password_url();
                if (!$passwordchangeurl) {
                    $passwordchangeurl = $CFG->wwwroot.'/login/change_password.php';
                } else {
                    $externalchangepassword = true;
                }
            } else {
                $passwordchangeurl = $CFG->wwwroot.'/login/change_password.php';
            }
            $days2expire = $userauth->password_expire($USER->username);
            $PAGE->set_title("$site->fullname: $loginsite");
            $PAGE->set_heading("$site->fullname");
            if (intval($days2expire) > 0 && intval($days2expire) < intval($userauth->config->expiration_warning)) {
                echo $OUTPUT->header();
                echo $OUTPUT->confirm(get_string('auth_passwordwillexpire', 'auth', $days2expire), $passwordchangeurl, $urltogo);
                echo $OUTPUT->footer();
                exit;
            } elseif (intval($days2expire) < 0 ) {
                if ($externalchangepassword) {
                    // We end the session if the change password form is external. This prevents access to the site
                    // until the password is correctly changed.
                    require_logout();
                } else {
                    // If we use the standard change password form, this user preference will be reset when the password
                    // is changed. Until then it will prevent access to the site.
                    set_user_preference('auth_forcepasswordchange', 1, $USER);
                }
                echo $OUTPUT->header();
                echo $OUTPUT->confirm(get_string('auth_passwordisexpired', 'auth'), $passwordchangeurl, $urltogo);
                echo $OUTPUT->footer();
                exit;
            }
        }

        // Discard any errors before the last redirect.
        unset($SESSION->loginerrormsg);

        // test the session actually works by redirecting to self
        $SESSION->wantsurl = $urltogo;
        redirect(new moodle_url(get_login_url(), array('testsession'=>$USER->id)));

    } else {
        if (empty($errormsg)) {
            if ($errorcode == AUTH_LOGIN_UNAUTHORISED) {
                $errormsg = get_string("unauthorisedlogin", "", $frm->username);
            } else {
                $errormsg = get_string("invalidlogin");
                $errorcode = 3;
            }
        }
    }
}

/// Detect problems with timedout sessions
if ($session_has_timed_out and !data_submitted()) {
    $errormsg = get_string('sessionerroruser', 'error');
    $errorcode = 4;
}

/// First, let's remember where the user was trying to get to before they got here

if (empty($SESSION->wantsurl)) {
    $SESSION->wantsurl = null;
    $referer = get_local_referer(false);
    if ($referer &&
            $referer != $CFG->wwwroot &&
            $referer != $CFG->wwwroot . '/' &&
            $referer != $CFG->wwwroot . '/login/' &&
            strpos($referer, $CFG->wwwroot . '/login/?') !== 0 &&
            strpos($referer, $CFG->wwwroot . '/login/index.php') !== 0) { // There might be some extra params such as ?lang=.
        $SESSION->wantsurl = $referer;
    }
}

/// Redirect to alternative login URL if needed
if (!empty($CFG->alternateloginurl)) {
    $loginurl = new moodle_url($CFG->alternateloginurl);

    $loginurlstr = $loginurl->out(false);

    if (strpos($SESSION->wantsurl ?? '', $loginurlstr) === 0) {
        // We do not want to return to alternate url.
        $SESSION->wantsurl = null;
    }

    // If error code then add that to url.
    if ($errorcode) {
        $loginurl->param('errorcode', $errorcode);
    }

    redirect($loginurl->out(false));
}

/// Generate the login page with forms

if (!isset($frm) or !is_object($frm)) {
    $frm = new stdClass();
}

if (empty($frm->username) && $authsequence[0] != 'shibboleth') {  // See bug 5184
    if (!empty($_GET["username"])) {
        // we do not want data from _POST here
        $frm->username = clean_param($_GET["username"], PARAM_RAW); // we do not want data from _POST here
    } else {
        $frm->username = get_moodle_cookie();
    }

    $frm->password = "";
}

if (!empty($SESSION->loginerrormsg)) {
    // We had some errors before redirect, show them now.
    $errormsg = $SESSION->loginerrormsg;
    unset($SESSION->loginerrormsg);

} else if ($testsession) {
    // No need to redirect here.
    unset($SESSION->loginerrormsg);

} else if ($errormsg or !empty($frm->password)) {
    // We must redirect after every password submission.
    if ($errormsg) {
        $SESSION->loginerrormsg = $errormsg;
    }
    redirect(new moodle_url('/login/index.php'));
}




$PAGE->set_title("$site->fullname: $loginsite");
$PAGE->set_heading("$site->fullname");

echo $OUTPUT->header();

if (isloggedin() and !isguestuser()) {
    // prevent logging when already logged in, we do not want them to relogin by accident because sesskey would be changed
    echo $OUTPUT->box_start();
    $logout = new single_button(new moodle_url('/login/logout.php', array('sesskey'=>sesskey(),'loginpage'=>1)), get_string('logout'), 'post');
    $continue = new single_button(new moodle_url('/'), get_string('cancel'), 'get');
    echo $OUTPUT->confirm(get_string('alreadyloggedin', 'error', fullname($USER)), $logout, $continue);
    echo $OUTPUT->box_end();
} else {
    $loginform = new \core_auth\output\login($authsequence, $frm->username);
    $loginform->set_error($errormsg);
    echo $OUTPUT->render($loginform);
}

echo $OUTPUT->footer();


include('../pre/header.php');
?>