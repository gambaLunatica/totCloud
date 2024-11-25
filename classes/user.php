
<?php
class User{
    private $userName;
    private $realName;
    private $realSurname;
    private $email;
    private $password;
    private $idUserGroup;
    private $idCompany;//Indicates the company of which this user is MASTER



    public function __construct(String $userName, String $realName, String $realSurname, String $email, String $password, int $idUserGroup, $idCompany=null){
        $this->userName = $userName;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->idUserGroup = $idUserGroup;
        $this->idCompany = $idCompany;
        $this->realSurname = $realSurname;
        $this->realName = $realName;
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

    public function getIdUserGroup():int{
        return $this->idUserGroup;
    }

    public function getIdCompany():int{
        return $this->idCompany;
    }

    public function getRealName():String{
        return $this->realName;
    }

    public function getRealSurname():String{
        return $this->realSurname;
    }


}