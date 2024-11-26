
<?php
class User{
    private $realName;
    private $realSurname;
    private $email;
    private $password;
    private $idUserGroup;
    private $nameCompany;//Indicates the company of which this user is MASTER



    public function __construct(String $realName, String $realSurname, String $email, String $password, int $idUserGroup, String $nameCompany=null){
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->idUserGroup = $idUserGroup;
        $this->nameCompany = $nameCompany;
        $this->realSurname = $realSurname;
        $this->realName = $realName;
    }

    public function getEmail():String{
        return $this->email;
    }

    public function getPassword():String{
        return $this->password;
    }

    public function getIdUserGroup():int{
        return $this->idUserGroup;
    }

    public function getNameCompany():String{
        return $this->nameCompany;
    }

    public function getRealName():String{
        return $this->realName;
    }

    public function getRealSurname():String{
        return $this->realSurname;
    }
}