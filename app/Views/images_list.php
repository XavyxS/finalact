<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Imágenes</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">

</head>

<body>
  <?php include('header_user.php'); ?>
  <main>
    <div class="conteiner">
      <h2>Banco de Imágenes</h2>
      <table class="tabla">
        <tr>
          <th>ID</th>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Fecha de subida</th>
          <th>Acciones</th>
        </tr>
        <?php foreach ($images as $image): ?>
          <tr>
            <td><?= $image['id'] ?></td>
            <td><img src="<?= $image['url_thumb'] ?>" class="thumb_img" alt=""></td>
            <td><?= $image['filename'] ?></td>
            <td><?= $image['created_at'] ?></td>
            <td>
              <a href="<?= $image['url'] ?>" target="_blank">Ver</a>
              <a href="/delete_img/<?= $image['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar la imagen: ')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <div class="form_input_file">
        <form action="/upload_img" method="POST" enctype="multipart/form-data">
          <label class="stboton" for="image">Seleccionar Archivo</label><br><br>
          <input type="file" name="image" id="image" hidden>
          <span class="nombre_archivo" id="nombre_archivo">Ningún archivo seleccionado</span><br>
          <button class="stboton" name="enviar">Enviar</button>
        </form>
      </div>
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
  <?php if (session()->getFlashdata('message')): ?>
    <script>
      alert('<?= session()->getFlashdata('message') ?>');
    </script>
  <?php endif; ?>

  <script>
    document.getElementById('image').addEventListener('change', function() {
      var archivo = this.files[0];
      var fileNameSpan = document.getElementById('nombre_archivo');
      if (archivo) {
        fileNameSpan.textContent = "Archivo seleccionado: " + archivo.name;
      } else {
        fileNameSpan.textContent = "Ningún archivo seleccionado";
      }
    });
  </script>

  <?php include('footer.php'); ?>

</body>

</html>