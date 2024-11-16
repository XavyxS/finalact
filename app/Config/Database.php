<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
  public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
  public string $defaultGroup = 'default';

  // Declarar la propiedad sin valores dinámicos
  public array $default = [];

  public array $tests = [
      'DSN'         => '',
      'hostname'    => '127.0.0.1',
      'username'    => '',
      'password'    => '',
      'database'    => ':memory:',
      'DBDriver'    => 'SQLite3',
      'DBPrefix'    => 'db_',
      'pConnect'    => false,
      'DBDebug'     => true,
      'charset'     => 'utf8',
      'DBCollat'    => '',
      'swapPre'     => '',
      'encrypt'     => false,
      'compress'    => false,
      'strictOn'    => false,
      'failover'    => [],
      'port'        => 3306,
      'foreignKeys' => true,
      'busyTimeout' => 1000,
      'dateFormat'  => [
          'date'     => 'Y-m-d',
          'datetime' => 'Y-m-d H:i:s',
          'time'     => 'H:i:s',
      ],
  ];

  public function __construct()
  {
      parent::__construct();

      // Inicializar la propiedad $default con valores dinámicos
      $this->default = [
          'DSN'        => '',
          'hostname'   => getenv('DB_HOST'),
          'username'   => getenv('DB_USER'),
          'password'   => getenv('DB_PASS'),
          'database'   => getenv('DB_NAME'),
          'schema'     => 'public',
          'DBDriver'   => 'Postgre',
          'DBPrefix'   => '',
          'pConnect'   => false,
          'DBDebug'    => (ENVIRONMENT !== 'production'),
          'charset'    => 'utf8',
          'DBCollat'   => 'utf8_general_ci',
          'swapPre'    => '',
          'failover'   => [],
          'port'       => 5432,
      ];

      // Configuración para el entorno de pruebas
      if (ENVIRONMENT === 'testing') {
          $this->defaultGroup = 'tests';
      }
  }
}
