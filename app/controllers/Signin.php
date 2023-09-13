<?php

class Signin
{
    use Controller;

    public function index()
    {
        $data = [];
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $user = new User();
            $user->email = $_POST['email'];
            $user->password = $_POST['password'];
    
            $row = $user->first(['email' => $user->email]);
    
            if ($row) {
                if ($row->password === $_POST['password']) {
                    $_SESSION['USER'] = $row;
                    redirect('home');
                }
            }
    
            $user->errors['email'] = "Wrong email or password"; 
            $data['errors'] = $user->errors;
        }
    
        $this->view('signin', $data);
    }
    
}