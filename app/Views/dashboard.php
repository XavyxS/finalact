<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">

</head>

<body>
  <?php include('header_user.php'); ?>
  <main>
    <div class="conteiner">
      <h2>Selecciona una opción</h2>
      <div class="botones">
        <a class="mnboton" href="/users_list">Registro de Usuarios</a>
        <a class="mnboton" href="/images_list">Banco de Imágenes</a>
      </div>
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