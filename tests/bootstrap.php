<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Load environment variables if .env exists
if (file_exists(BASE_PATH . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    $dotenv->load();
}

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Mock User class if not exists
if (!class_exists('User')) {
    class User
    {
        private $data = [];

        public function __construct()
        {
            $this->data = [
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'role' => 'admin'
            ];
        }

        public function get($key)
        {
            return $this->data[$key] ?? null;
        }

        public function set($key, $value)
        {
            $this->data[$key] = $value;
        }
    }
}

// Mock DB class if not exists
if (!class_exists('DB')) {
    class DB
    {
        public static function table($table)
        {
            return new class {
                public function where($column, $operator, $value)
                {
                    return $this;
                }

                public function limit($limit)
                {
                    return $this;
                }

                public function select($columns)
                {
                    return $this;
                }

                public function count()
                {
                    return 1;
                }

                public function get()
                {
                    return [];
                }

                public function insert($data)
                {
                    return 1;
                }

                public function update($data)
                {
                    return true;
                }

                public function delete()
                {
                    return true;
                }
            };
        }
    }
}

// Mock DataEntry class if not exists
if (!class_exists('DataEntry')) {
    class DataEntry
    {
        protected $data = [];
        protected $is_available = false;

        public function __construct() {}

        public function get($key)
        {
            return $this->data[$key] ?? null;
        }

        public function set($key, $value)
        {
            $this->data[$key] = $value;
        }

        public function isAvailable()
        {
            return $this->is_available;
        }

        public function markAsAvailable()
        {
            $this->is_available = true;
        }
    }
}

// Mock UserModel class if not exists
if (!class_exists('UserModel')) {
    class UserModel extends DataEntry
    {
        public function __construct($uniqid = 0)
        {
            parent::__construct();
            $this->select($uniqid);
        }

        public function select($uniqid)
        {
            $this->data = [
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'role' => 'admin'
            ];
            $this->is_available = true;
            return $this;
        }
    }
}

// Mock Controller classes if not exists
$controllers = [
    'AppointmentController',
    'AppointmentArrangeController',
    'AppointmentRecordController',
    'AppointmentRecordsController',
    'AppointmentsController'
];

foreach ($controllers as $controller) {
    if (!class_exists($controller)) {
        eval("class $controller {
            protected \$variables = [];
            
            public function setVariable(\$key, \$value) {
                \$this->variables[\$key] = \$value;
            }
            
            public function getVariable(\$key) {
                return \$this->variables[\$key] ?? null;
            }
            
            public function view(\$view, \$data = []) {
                return true;
            }

            public function process() {
                return true;
            }
        }");
    }
}
