<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Define base path
define('BASE_PATH', dirname(__DIR__));
define('APPPATH', BASE_PATH . '/app');
define('APPURL', 'http://localhost:8080/PTIT-Do-An-Tot-Nghiep/umbrella-corporation');

// Thêm định nghĩa hằng số web app
define('TABLE_PREFIX', '');
define('TABLE_USERS', 'users');
define('TABLE_PACKAGES', 'packages');
define('WEBSITE_NAME', 'Umbrella Corporation');
define('VERSION', '1.0');

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

// Define helper functions
if (!function_exists('active_theme')) {
    function active_theme($param)
    {
        return BASE_PATH . '/themes/default';
    }
}

if (!class_exists('Input')) {
    class Input
    {
        public static function get($param)
        {
            return isset($_GET[$param]) ? $_GET[$param] : null;
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
                public function where($column, $operator = null, $value = null)
                {
                    return $this;
                }

                public function orWhere($column, $operator = null, $value = null)
                {
                    return $this;
                }

                public function leftJoin($table, $first, $operator, $second)
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
            if (strpos($key, '.') !== false) {
                list($mainKey, $subKey) = explode('.', $key, 2);
                if (isset($this->data[$mainKey])) {
                    $jsonObj = json_decode($this->data[$mainKey], true);
                    return $jsonObj[$subKey] ?? null;
                }
                return null;
            }
            return $this->data[$key] ?? null;
        }

        public function set($key, $value)
        {
            $this->data[$key] = $value;
            return $this;
        }

        public function isAvailable()
        {
            return $this->is_available;
        }

        public function markAsAvailable()
        {
            $this->is_available = true;
            return $this;
        }

        public function select($uniqid)
        {
            return $this;
        }

        public function save()
        {
            return $this;
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

// Mock DataList class if not exists
if (!class_exists('DataList')) {
    class DataList
    {
        protected $query;
        protected $data = [];

        public function setQuery($query)
        {
            $this->query = $query;
            return $this;
        }

        public function getQuery()
        {
            return $this->query;
        }

        public function search($query)
        {
            return $this;
        }

        public function getSearchQuery()
        {
            return "";
        }

        public function paginate()
        {
            return $this;
        }

        public function fetchData()
        {
            return $this;
        }
    }
}

// Override header function for testing
if (!function_exists('header_mock')) {
    function header_mock($header)
    {
        // Do nothing in tests
    }
}

// Create a proxy class that overrides the header function
if (!function_exists('header')) {
    function header($string)
    {
        // Do nothing in tests
        return;
    }
}

// Mock các include file fragment
if (!function_exists('mock_include')) {
    function mock_include($file)
    {
        // Do nothing
        return true;
    }
}

// Tạo fragment directory giả nếu chưa tồn tại
$fragment_dir = APPPATH . '/views/fragments';
if (!file_exists($fragment_dir)) {
    mkdir($fragment_dir, 0777, true);
}

// Tạo các fragment files giả
$fragments = [
    'navleft.fragment.php',
    'navtop.fragment.php',
    'appointmentRecords.fragment.php',
    'appointmentRecord.fragment.php',
    'appointments.fragment.php',
    'appointmentArrange.fragment.php',
    'appointment.fragment.php',
    'footer.fragment.php',
    'javascript.fragment.php'
];

foreach ($fragments as $fragment) {
    $path = $fragment_dir . '/' . $fragment;
    if (!file_exists($path)) {
        file_put_contents($path, '<?php // Mock fragment file ?>');
    }
}
