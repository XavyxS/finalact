<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\ImagesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ImagesController extends BaseController
{
  public function images_list()
  {
    $session = session();
    $userId = $session->get('user_id');

    $model_img = new ImagesModel();
    $data['images'] = $model_img->where('user_id', $userId)->findAll();

    return view('images_list', $data);
  }

  public function upload_img()
  {
    $image = $this->request->getFile('image');

    if ($image->isValid() && !$image->hasMoved()) {

      $filename = $image->getClientName();

      $imageData = base64_encode(file_get_contents($image->getTempName()));

      $url = getenv('URL_IMGBB') . '?key=' . getenv('API_KEY_IMGBB');

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('image' => $imageData),
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
      ));

      $response = curl_exec($curl);
      // Verifica si hay errores
      if (curl_errno($curl)) {
        echo 'Error de cURL: ' . curl_error($curl);
      }
      // echo $response;

      curl_close($curl);

      // Decodifica la respuesta JSON
      $responseData = json_decode($response, true);

      // Verifica si la subida fue exitosa
      if (isset($responseData['success']) && $responseData['success']) {
        // Extrae los datos necesarios
        $imageId = $responseData['data']['id'];
        $imageUrl = $responseData['data']['url'];
        $urlThumb = $responseData['data']['thumb']['url'];
        $urlDelete = $responseData['data']['delete_url'];

        // Obtiene el ID del usuario de la sesión
        $session = session();
        $userId = $session->get('user_id');

        // Guarda los datos en la base de datos
        $model = new \App\Models\ImagesModel();
        $model->insert([
          'user_id' => $userId,
          'image_id' => $imageId,
          'url' => $imageUrl,
          'filename' => $filename,
          'url_thumb' => $urlThumb,
          'url_delete' => $urlDelete
        ]);

        return redirect()->back()->with('message', 'Imagen subida y guardada con éxito.');
      } else {
        return redirect()->back()->with('error', 'Hubo un error al subir la imagen a ImgBB.');
      }
    } else {
      return redirect()->back()->with('error', 'Hubo un error al procesar la imagen.');
    }
  }

  public function delete_img($id)
  {
    $model_img = new ImagesModel();
    $image = $model_img->find($id);
    $urlDelete = $image['url_delete'];
    $model_img->delete($id);

    // Ahora vamos a borrar la imagen de IMGBB

    $curl = curl_init();

    // Configura las opciones de cURL

    curl_setopt_array($curl, array(
      CURLOPT_URL => $urlDelete,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
    ));

    // Ejecuta la solicitud y obtiene la respuesta
    $response = curl_exec($curl);

    // Verifica si hay errores
    if (curl_errno($curl)) {
      echo 'Error de cURL: ' . curl_error($curl);
    } else {
      echo 'Respuesta de eliminación: ' . $response;
    }

    // Cierra la sesión de cURL
    curl_close($curl);

    return redirect()->to('/images_list');
  }
}
