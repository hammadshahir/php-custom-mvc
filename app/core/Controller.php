<?php

Trait Controller
{
    public function view($name)
    {
        $viewFileName = $this->getViewFileName($name);

        if (file_exists($viewFileName)) {
            require $viewFileName;
        } else {
            // Load the 404 view page
            $this->load404Page();
        }
    }

    private function getViewFileName($name)
    {
        return "../app/views/{$name}.view.php";
    }

    private function load404Page()
    {
        // Load the 404 view page
        require "../app/views/404.view.php";
    }
}