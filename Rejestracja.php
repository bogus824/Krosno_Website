<?php
session_start();
unset($_SESSION['blad']);

if(isset($_POST['email']))
{
	$wszystko_gra = true;
	
	
	$nick = $_POST['nick'];
	$email = $_POST['email'];
	$haslo1 = $_POST['haslo1'];
	$haslo2 = $_POST['haslo2'];
	
	
	if((strlen($nick)<5)||(strlen($nick)>30))
	{
		$wszystko_gra = false;
		$_SESSION['e_nick'] = "Nick musi posiadać od 5 do 30 znaków! ";
	}	
	
	if(ctype_alnum($nick)==false)
	{$wszystko_gra = false;
	 $_SESSION['e_nick'] = "Nick może składać się tylko z liter i cyfr bez polskich znaków! ";
	}
	
	$emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
	
	if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email))
	{$wszystko_gra = false;
	 $_SESSION['e_email'] = "Podaj poprawny adres email! ";
		
	}
	
	if((strlen($haslo1)<5)||(strlen($haslo1)>20))
	{
		$wszystko_gra = false;
		$_SESSION['e_haslo'] = "Hasło musi posiadać od 5 do 20 znaków! ";
	}
	
	if($haslo1 != $haslo2)
	{
		$wszystko_gra = false;
		$_SESSION['e_haslo'] = "Podane hasła nie są identyczne! ";
		
	}
	
	$haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT);
	
	if(!isset($_POST['regulamin']))
	{
		$wszystko_gra = false;
		$_SESSION['e_regulamin'] = "Zaakceptuj regulamin! ";
	}
	
	
	
	require_once "polaczenie.php";
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try 
	{
		$polaczeniee = new mysqli($host,$db_login,$db_haslo,$db_name);
		if($polaczeniee->connect_errno!=0)
		 {
			throw new Exception(mysqli_connect_errno());
			 
		 }else
		 {
			 $rezultat = $polaczeniee->query("SELECT Id FROM Rejestracja WHERE Mail = '$email'");
			 
			 if(!$rezultat) throw new Exception($polaczeniee->error);
		
			$ile_maili = $rezultat->num_rows;
			if($ile_maili>0)
			{
				$wszystko_gra = false;
				$_SESSION['e_email'] = "Istnieje już konto o takim adresie email! ";
			}
			
			$rezultat = $polaczeniee->query("SELECT Id FROM Rejestracja WHERE Login = '$nick'");
			 
			 if(!$rezultat) throw new Exception($polaczeniee->error);
		
			$ile_loginow = $rezultat->num_rows;
			if($ile_loginow>0)
			{
				$wszystko_gra = false;
				$_SESSION['e_nick'] = "Istnieje już konto o takim nicku! ";
			}
			
			
			if($wszystko_gra == true)
			{
				if($polaczeniee->query("INSERT INTO Rejestracja VALUES ('$nick','$haslo_hash','$email',NULL)"))
				{
					$_SESSION['udanarejestracja'] = true;
					header("Location: Logowanie.php");
					
				}else
				{
					if(!$rezultat) throw new Exception($polaczeniee->error);
										
				}
			}
			 
			$polaczeniee->close(); 
		 }
		 
	}
	catch(Exception $e)
	{
		echo '<span style ="color: red;"> Błąd serwera!</span>';
		
		echo '<br /> Infoerror: '.$e;
		
	}
}




?>



<!DOCTYPE html>
<html>

<head>
<title>Rejestracja</title>
<meta name="viewport" content="width=device-width, initial-scale=1">


<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  padding: 0;
  }

.navbar {
	  overflow: hidden;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 32px;
  color: white;
  text-align: center;
  padding: 30px 70px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 32px;  
  border: none;
  outline: none;
  color: white;
  text-align: center;
  padding: 30px 70px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: gray;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 70px;
  text-align: center;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
	font-size: 25px;  
  float: none;
  color: black;
  padding: 15px 82px;
  text-decoration: none;
  text-align: center;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
  
  
 }
  
 
.footer
{
  position:fixed;
  bottom:0px;	
  height: 20px;
  width:100%;
  text-align: center;
  text-bottom:0px;
  background-color: #333;
  color:gray;
}
 
 .footer_text
 {
	
	left:850px; 
 }
 
 .absolutemiddle {
	 font-size: 12px;
  border: 5px black solid;
  padding: 70px;
  position: fixed;
  top: 200px;
  right: 750px; 
  left: 750px;
 }
 
 .error {
	 font-size: 10px;
	 color:red;
	 margin-top:10px;
	 margin-botton: 10px;
	 
 }
 
 
</style>


</head>
<body bgcolor="#E0E0E0">


<div class="navbar">
	<a href = "index.php"> Strona Główna</a> 
	<a href = "ksiega_gosci.php"> Księga Gości</a> 
	<a href = "Losowanie.php"> Losowanie</a> 
	<a href = "Logowanie.php"> Logowanie</a> 
	<a href = "Rejestracja.php"> Rejestracja</a> 
    <div class="dropdown">
    <button class="dropbtn">Sprawozdania 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="s1.pdf">Sprawozdanie 1</a>
      <a href="s2.pdf">Sprawozdanie 2</a>
	  <a href="s3.pdf">Sprawozdanie 3</a>
	  <a href="s4.pdf">Sprawozdanie 4</a>
	  <a href="s5.pdf">Sprawozdanie 5</a>
	       
    </div>
  </div> 
  
</div>

<h1><center><font size = "33">Rejestracja</font></center></h1>

<center>


<form method = "post">

 Login: <br /> <input type = "text" name="nick"/><br/>Tylko znaki alfanumeryczne - 5 do 30 znaków<br/>
 <?php
 if(isset($_SESSION['e_nick'])){
 echo '<div class = "error">'.$_SESSION['e_nick'].'</div>';
 unset($_SESSION['e_nick']);
 }
 ?>
 <br/>
 
 Hasło: <br /> <input type = "password" name="haslo1"/><br/>Tylko znaki alfanumeryczne - 5 do 20 znaków<br/>
 <?php
 if(isset($_SESSION['e_haslo'])){
 echo '<div class = "error">'.$_SESSION['e_haslo'].'</div>';
 unset($_SESSION['e_haslo']);
 }
 ?>
 <br/>
 
 Powtórz hasło: <br /> <input type = "password" name="haslo2"/><br/>
 <?php
 if(isset($_SESSION['e_haslo'])){
 echo '<div class = "error">'.$_SESSION['e_haslo'].'</div>';
 unset($_SESSION['e_haslo']);
 }
 ?>
 <br/>
 
 
 E-mail: <br /> <input type = "text" name="email"/><br/>
 <?php
 if(isset($_SESSION['e_email'])){
 echo '<div class = "error">'.$_SESSION['e_email'].'</div>';
 unset($_SESSION['e_email']);
 }
 ?>
 <br/>
 
 <label>
 <input type = "checkbox" name = "regulamin"/> Akceptuję regulamin <a href = "reg.pdf"><br/>Regulamin</a>
</label>
 <br/>
 <?php
 if(isset($_SESSION['e_regulamin'])){
 echo '<div class = "error">'.$_SESSION['e_regulamin'].'</div>';
 unset($_SESSION['e_regulamin']);
 }
 ?>
 <br/>
 
 <br/><br/>

<input type ="submit" value="Zarejestruj się" />
<br/> <br/><br/><br/><br/><br/><br/>

</form>

</div>
</center>



</body>

<footer>

<div class = "footer">
<div class = "footer_text">
Copyright: Kamil Bogdanowski
</div>
</div>

</footer>


</html>