<?php
class User implements IManager{
    protected $id;
    protected $fullName;
    protected $login;
    protected $pwd;
    protected $profil;
    protected $avatar;

    public function __construct($row=null){
        if($row!=null){
            $this->hydrate($row);
        }
    }

    public function hydrate($row){
       $this->id=$row['id'];
       $this->fullName=$row['fullName'];
       $this->login=$row['login'];
       $this->pwd=$row['pwd'];
       $this->profil=$row['profil'];
       $this->avatar=$row['avatar'];
    }

    // TRY AUTO-HYDRATE
    
    /*public function hydrate($row){
        foreach ($row as $key => $value) {
            $this->{$key} = $value;
        }
     }*/
}