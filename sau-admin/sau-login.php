<?php

require_once 'sau-conexion.php';
session_start();
class Login
{

    private static $instancia;
    private $dbh;
 
    private function __construct()
    {

        $this->dbh = Conexion::singleton_conexion();

    }
 
    public static function singleton_login()
    {

        if (!isset(self::$instancia)) {

            $miclase = __CLASS__;
            self::$instancia = new $miclase;

        }

        return self::$instancia;

    }
	
	public function login_users($email,$password)
	{
		
		try {

			$crypt = sha1(SALT.$password.PEPER);
			
			$sql = "SELECT * FROM usuarios WHERE email = ? AND password = ? AND activo = 2";
			$query = $this->dbh->prepare($sql);
			$query->bindParam(1,$email);
			$query->bindParam(2,$crypt);
			$query->execute();
			$this->dbh = null;

			//si existe el usuario
			if($query->rowCount() == 1)
			{
				 
				 $fila  = $query->fetch();
				 $_SESSION['idusuario'] = $fila['idusuario'];
				 $_SESSION['ranker'] = $fila['ranker'];	
				 $_SESSION['email'] = $fila['email'];			 
				 return TRUE;
	
			}else
			return FALSE;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}		
		
	}
    

     // Evita que el objeto se pueda clonar
    public function __clone()
    {

        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);

    }

}