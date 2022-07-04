<?php require_once("controlador/cini.php"); ?>
<!-- Form-login -->

  <form name="frm1" action="model/control.php" method="POST">
    <?php errorauth();?>
    <input type="email" name="usu" placeholder="Correo electronico" class="form-control">
    <input type="password" name="con" placeholder="Contraseña" class="form-control">
    <input type="submit" value="SEND">
  </form>
</div>
