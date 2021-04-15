<?php class Router
{
    function __construct()
    {
        $this->_start();
    }

    private function _start()
    {

        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }


        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        $getParams = explode('?', $action_name);

        $action_name = $getParams[0];

        if (isset($getParams[1])) {
            foreach (explode('&', $getParams[1]) as $value) {
                $pairs = explode('=', $value);
                $_GET[$pairs[0]] = $pairs[1];
            }
        }

        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'action_' . $action_name;



        $model_file = strtolower($model_name) . '.php';
        $model_path = "application/models/" . $model_file;
        if (file_exists($model_path)) {
            include "application/models/" . $model_file;
        }


        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "application/controllers/" . $controller_file;

        if (file_exists($controller_path)) {
            include "application/controllers/" . $controller_file;
        } else {
            $this->ErrorPage404();

            return;
        }


        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            $this->ErrorPage404();
            return;
        }
    }

    function ErrorPage404()
    {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        View::generate_404('template_view.php');
    }
}
