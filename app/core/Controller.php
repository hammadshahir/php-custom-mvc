<?php

class Controller
{
    public function view($name)
    {
        $viewFileName = $this->getViewFileName($name);

        try {
            if (file_exists($viewFileName)) {
                require $viewFileName;
            } else {
                throw new Exception("View '{$name}' not found.");
            }
        } catch (Exception $e) {
            $this->handleError("View Error", $e);
        }
    }

    private function getViewFileName($name)
    {
        return "../app/views/{$name}.view.php";
    }

    private function handleError($title, Exception $e)
    {
        echo "<h1>{$title}</h1>";
        echo "<p>{$e->getMessage()}</p>";
        // Log the error or take other appropriate actions here.
    }
}