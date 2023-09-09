<?php

class Home extends Controller
{
    public function index()
    {
        $model = new Model();

        $this->view('home');
    }
}