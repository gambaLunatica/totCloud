
<?php
class User{
    private $name;
    private $email;
    private $password;
    private $userGroup;



    public function __construct($name, $email, $password, $userGroup){
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->userGroup = $userGroup;
    }

    public function getName():String{
        return $this->name;
    }

    public function getEmail():String{
        return $this->email;
    }

    public function getPassword():String{
        return $this->password;
    }

    public function getUserGroup():int{
        return $this->userGroup;
    }


}