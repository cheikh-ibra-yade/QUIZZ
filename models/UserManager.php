<?php

class UserManager extends Manager{
   
    function __construct(){
        $this->tableName="User"; //dois tjr correspondre avec le classname
    }



    public function create($objet){
       $sql = "INSERT INTO User VALUES (null,'$objet->fullName','$objet->login','$objet->pwd','$objet->profil','$objet->avatar')";
       return  $this->executeUpdate( $sql)!=0;

    }
    public function update($objet){

    }
    public  function delete($id){
      
    }
    public function findAll(){
      
    }
    public function findById($id){

    }  

    public function getUserByLoginAndPwd($login,$pwd){
       $sql="select * from user where login='$login' and pwd='$pwd'";
       return $this-> ExecuteSelect($sql);
    } 
}