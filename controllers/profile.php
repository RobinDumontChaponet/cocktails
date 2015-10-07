<?php
if (isset($_SESSION['cocktailsUser'])) {
    require_once MODELS_INC.'UserDAO.class.php';
    $user = UserDAO::getByLogin($_SESSION['cocktailsUser']->getLogin());
} else  {
    header ('Location: signin');
}

if( $_POST ) {
    echo 'Faire le post ...';
}

include(VIEWS_INC.'profile.php');

?>
