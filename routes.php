<?php 
require_once 'controllers/UserController.php';
require_once 'controllers/PositionController.php';

$routes = [];
$userController = new UserController();

// Routes

route('/', function () 
{
    return null;
});

route('/404', function () 
{
    echo "Page not found";
});

route('/get-users', function () use ($userController) 
{
    echo $userController->getUsers();

    die;
});

route('/get-positions', function () 
{
    $positionController = new PositionController();

    echo $positionController->getPositions();
    die;
});

route('/add-user', function ($params) use ($userController) 
{
    echo $userController->addUser($params);

    die;
});

route('/delete-user', function ($params) use ($userController) 
{
    echo $userController->deleteUser($params);

    die;
});

route('/edit-user', function ($params) use ($userController) 
{
    echo $userController->editUser($params);

    die;
});



// Router logic

function route(string $path, callable $callback) 
{
    global $routes;
    $routes[$path] = $callback;
}

function runRoutes() 
{
    global $routes;

    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    parse_str(file_get_contents('php://input'), $params);
    $found = false;

    foreach ($routes as $path => $callback) 
    {
        if ($path !== $uri) continue;

        $found = true;

        if ($method === 'POST' || $method === 'DELETE' || $method === 'PUT') 
        {
            $callback($params);
        } else {
            $callback();
        }
    }

    if (!$found) 
    {
        $notFoundCallback = $routes['/404'];
        $notFoundCallback();
    }
}
