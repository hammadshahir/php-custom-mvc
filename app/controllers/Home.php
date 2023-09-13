<?php

class Home
{
    use Controller;
    public function index()
    {
        $data['userName'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $this->view('home' , $data);
    }
}