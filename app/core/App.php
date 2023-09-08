<?php
    class App
    {
        public function loadController()
        {
            $url = $this->getURL();
            $controllerName = ucfirst(array_shift($url));

            try {
                $controllerFileName = "../app/controllers/{$controllerName}.php";

                if (file_exists($controllerFileName)) {
                    require_once $controllerFileName;
                } else {
                    throw new Exception("The controller file '{$controllerName}.php' does not exist.");
                }
            } catch (Exception $e) {
                $this->handleError("Controller Error", $e);
            }
        }

        private function getURL()
        {
            $url = $_GET['url'] ?? 'home';

            try {
                $url = explode("/", $url);
                return $url;
            } catch (Exception $e) {
                return [];
            }
        }

        private function handleError($title, Exception $e)
        {
            echo "<h1>{$title}</h1>";
            echo "<p>{$e->getMessage()}</p>";
            // Log the error or take other appropriate actions here.
        }
    }