<?php
function checkSupervisorAuth() {
    if (!isset($_SESSION['supervisor_id']) || $_SESSION['supervisor_role'] != 'supervisor') {
        header("Location: /SPROJECT/frontend/html/supervisor_login.php");
        exit();
    }
}

function checkManagerAuth($type = null) {
    if (!isset($_SESSION['manager_id']) || $_SESSION['manager_role'] != 'manager') {
        header("Location: /SPROJECT/frontend/html/manager_login.php");
        exit();
    }
    
    
}

