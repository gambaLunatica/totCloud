
<?php
class User{
    private $userName;
    private $realName;
    private $realSurname;
    private $email;
    private $password;
    private $idUserGroup;
    private $idCompany;//Indicates the company of which this user is MASTER



    public function __construct($userName, $email, $password, $idUserGroup, $idCompany=null ){
        $this->userName = $userName;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->idUserGroup = $idUserGroup;
        $this->idCompany = $idCompany;
    }

    public function getName():String{
        return $this->userName;
    }

    public function getEmail():String{
        return $this->email;
    }

    public function getPassword():String{
        return $this->password;
    }

    public function getUserGroup():int{
        return $this->idUserGroup;
    }

    public function getIdCompany():int{
        return $this->idCompany;
    }


}