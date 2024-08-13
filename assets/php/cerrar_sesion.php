<?php
session_start();
session_unset();
session_destroy();
?>
<script>
    alert("Se ha cerrado la sesión correctamente");
    window.location = "../html/login.html";
</script>
<?php
exit();
?>