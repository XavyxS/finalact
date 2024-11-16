<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseController
{
  public function dashboard()
  {
    $model = new UsersModel();
    $data['users'] = $model->findAll();

    return view('dashboard', $data);
  }

  public function delete($id)
  {
    $session = session();
    $userId = $session->get('user_id');

    if ($id == $userId) {
      return redirect()->to('/dashboard')->with('error', 'NO PUEDES BORRRA EL USUARIO QUE ESTA ACTIVO');
    }

    $model = new UsersModel();
    $model->delete($id);

    return redirect()->to('/dashboard');
  }

  public function edit($id)
  {
    $model = new UsersModel();
    $data['user'] = $model->find($id);

    if (!$data['user']) {
      throw PageNotFoundException::forPageNotFound();
    }

    return view('/registroForm', $data);
  }

  public function update($id)
  {
    $model = new UsersModel();

    $model->update($id, [
      'name' => $this->request->getPost('name'),
      'email' => $this->request->getPost('email')
    ]);

    return redirect()->to('/dashboard');
  }

  public function users_list()
  {
    $model = new UsersModel();
    $data['users'] = $model->findAll();

    return view('users_list', $data);
  }
}
