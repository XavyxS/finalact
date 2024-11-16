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
      <h2>Lista de Usuarios</h2>
      <table class="tabla">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Última enttrada</th>
          <th>Acciones</th>
        </tr>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['last_login'] ?></td>
            <td>
              <a href="/edit/<?= $user['id'] ?>">Editar</a>
              <a href="/delete/<?= $user['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar al usuario: <?= $user['name'] ?>')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <div class="botones">
        <a class="stboton rdboton" href="/dashboard">Menú Principal</a>
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