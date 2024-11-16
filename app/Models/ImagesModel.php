<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagesModel extends Model
{
  protected $table = 'images';
  protected $primaryKey = 'id';
  protected $allowedFields = ['user_id', 'image_id', 'url', 'filename', 'url_thumb', 'created_at', 'url_delete'];
}
