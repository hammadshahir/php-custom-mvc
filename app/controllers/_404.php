<?php

class _404
{
    use Controller;
    
    public function index()
    {
        echo "Page 404 - Controller not found.";
    }
}