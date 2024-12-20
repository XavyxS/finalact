<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'email', 'password', 'last_login', 'remember_token', 'created_at'];
}

