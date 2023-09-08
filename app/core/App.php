<?php
    class App
    {
        private $controller = 'home';
        private $method = 'index';

        private function getURL()
        {
            $URL = $_GET['url'] ?? 'home';
            return explode("/", $URL);
        }

        public function loadController()
        {
            $URL = $this->getURL();
            $controllerName = ucfirst($URL[0]);
            $controllerFileName = "../app/controllers/{$controllerName}.php";

            try {
                if (file_exists($controllerFileName)) {
                    require_once $controllerFileName;
                    if (class_exists($controllerName)) {
                        $this->controller = $controllerName;
                    } else {
                        throw new Exception("Controller class '{$controllerName}' not found.");
                    }
                } else {
                    require_once '../app/controllers/_404.php';
                    $this->controller = '_404';
                }

                if (class_exists($this->controller)) {
                    $controller = new $this->controller;
                    call_user_func_array([$controller, $this->method], []);
                } else {
                    throw new Exception("Controller class '{$this->controller}' not found.");
                }
            } catch (Exception $e) {
                $this->handleError("Controller Error", $e);
            }
        }

        private function handleError($title, Exception $e)
        {
            echo "<h1>{$title}</h1>";
            echo "<p>{$e->getMessage()}</p>";
            // Log the error or take other appropriate actions here.
        }
    }
