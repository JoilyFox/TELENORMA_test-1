<?php 
require_once 'controllers/UserController.php';
require_once 'controllers/PositionController.php';

$routes = [];

route('/', function () {
    return null;
});

route('/404', function () {
    echo "Page not found";
});

route('/get-users', function () {
    $userController = new UserController();

    echo $userController->getUsers();
    die;
});

route('/get-positions', function () {
    $positionController = new PositionController();

    echo $positionController->getPositions();
    die;
});

route('/add-user', function ($params) {
    printf($params);
    // $userController = new UserController();

    // echo $userController->getUsers();
    die;
});


function route(string $path, callable $callback) {
    global $routes;
    $routes[$path] = $callback;
}

// function runRoutes() {
//     global $routes;
//     $uri = $_SERVER['REQUEST_URI'];
//     $found = false;

//     foreach ($routes as $path => $callback) {
//         if ($path !== $uri) continue;

//         $found = true;
//         $callback();

//     }

//     if (!$found) {
//         $notFoundCallback = $routes['/404'];
//         $notFoundCallback();
//     }
// }

function runRoutes() {
    global $routes;

    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    $params = json_decode(file_get_contents('php://input'), true);
    $found = false;

    foreach ($routes as $path => $callback) {
        if ($path !== $uri) continue;

        $found = true;

        if ($method === 'POST') {
            $callback($params);
        } else {
            $callback();
        }
    }

    if (!$found) {
        $notFoundCallback = $routes['/404'];
        $notFoundCallback();
    }
}
