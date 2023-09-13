<?php

class Signup
{
    use Controller;
    public function index()
    {
       $user = new User();

       if($user->validate($_POST))
       {
           $user->insert($_POST);
           redirectToHome('home');
       }
       
       $data['errors'] = $user->errors;
       
       $this->view('signup', $data);
    }
}