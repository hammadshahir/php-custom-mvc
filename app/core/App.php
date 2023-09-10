<?php
    class App
    {
        private $controller = 'home';
        private $method = 'index';

        private function getURL()
        {
            $URL = $_GET['url'] ?? 'home';
            return explode("/", trim($URL, "/"));
        }

        public function loadController()
        {
            $URL = $this->getURL();
            $controllerName = ucfirst($URL[0]);
            $controllerFileName = "../app/controllers/{$controllerName}.php";

            try {
                // Select controller
                if (file_exists($controllerFileName)) {
                    require_once $controllerFileName;
                    if (class_exists($controllerName)) {
                        $this->controller = $controllerName;
                        unset($URL[0]);
                    } else {

                        throw new Exception("Controller class '{$controllerName}' not found.");
                    }
                } else {
                    require_once '../app/controllers/_404.php';
                    $this->controller = '_404';
                }
                
                if (class_exists($this->controller)) {
                    $controller = new $this->controller;
                    // Select method
                    if(!empty($URL[1])) {
                        if (method_exists($controller, $URL[1] )) {
                            $this->method = $URL[1];
                            unset($URL[1]);
                        }
                    }
                    call_user_func_array([$controller, $this->method], $URL);
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
