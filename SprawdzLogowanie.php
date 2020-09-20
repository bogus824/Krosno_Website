<?php

session_start();

if((!isset($_POST['login']))&&(!isset($_POST['haslo'])))
{
	header('Location: Logowanie.php');
	exit();
}


 require_once "polaczenie.php";
 
 $polaczeniee = @new mysqli($host,$db_login,$db_haslo,$db_name);
 
 if($polaczeniee->connect_errno!=0)
 {
	echo "Error:".$polaczeniee->connect.errno;
	 
 }else
 {
	 
	 $login = $_POST['login'];
	 $haslo = $_POST['haslo'];
	 $_SESSION['haslo_check'] =$haslo;
	 $_SESSION['login_check'] =$login;
	 
	 
	 $login = htmlentities($login,ENT_QUOTES,"UTF-8");
	 
	 
		
	 if($rezultat = @$polaczeniee->query(
	 sprintf("SELECT*FROM Rejestracja WHERE Login='%s'",
	 mysqli_real_escape_string($polaczeniee,$login))))
	{
		 $ilu_userow = $rezultat->num_rows;
		 if($ilu_userow>0)
		 {
			$wiersz = $rezultat->fetch_assoc();
			
			if(password_verify($haslo,$wiersz['Password'])){
				
		
				$_SESSION ['zalogowany'] = true;
				
				$_SESSION['id'] = $wiersz['Id'];
				$_SESSION['user'] = $wiersz['Login'];
				$_SESSION['password'] = $wiersz['Password'];
				$_SESSION['email'] = $wiersz['Mail'];
				
				unset($_SESSION['blad']);
							
				$rezultat->close();
				
				header('Location: Stronadlazalogowanych.php');
			}else
			{
				$_SESSION['blad'] = '<span style = "color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: Logowanie.php');					
			}
			 
		 }else
		 {
			$_SESSION['blad'] = '<span style = "color:red">Nieprawidłowy login lub hasło!</span>';
			header('Location: Logowanie.php');	 
		 }
	 }
	 
	 
	 $polaczeniee->close();
	 
	 
 }
 


?>