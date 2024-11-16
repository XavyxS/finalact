<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login User</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">

</head>

<body>
  <?php include('header.php'); ?>
  <main>
    <div class="conteiner">
      <h2>Inicio de Sesión</h2>
      <form class="formulario" action="/auth" method="POST">
        <label for="email">Correo:</label>
        <input type="email" name="email" require>
        <label for="password">Contraseña</label>
        <input type="password" name="password" require>
        <div class="botones">
          <button class="stboton" type="submit">Iniciar Sesión</button>
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