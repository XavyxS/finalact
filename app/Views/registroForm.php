<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Usuario</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">

</head>

<body>
  <?php include('header.php'); ?>
  <main>
    <div class="conteiner">
      <h2><?= isset($user) ? 'Actualizar Usuario' : 'Registro de Usuario' ?></h2>
      <form class="formulario" action="<?= isset($user) ? '/update/' . $user['id'] : '/registro' ?>" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" name="name" value="<?= isset($user) ? $user['name'] : '' ?>" require>
        <label for="email">Correo:</label>
        <input type="email" name="email" value="<?= isset($user) ? $user['email'] : '' ?>" require>
        <?php if (!isset($user)) { ?>
          <label for="password">Contraseña</label>
          <input type="password" name="password" value="<?= isset($user) ? $user['password'] : '' ?>" require>
        <?php } ?>
        <div class="botones">
          <button class="stboton" type="submit"><?= isset($user) ? 'Actualizar' : 'Registro' ?></button>
        </div>
      </form>
    </div>
  </main>
  <?php if (session()->getFlashdata('error')): ?>
    <script>
      alert('<?= session()->getFlashdata('error') ?>');
    </script>
  <?php endif; ?>

  <?php include('footer.php'); ?>
</body>

</html>