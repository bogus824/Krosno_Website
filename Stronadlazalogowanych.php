<?php


session_start();

if(!isset($_SESSION['zalogowany']))
{
	header("Location: Logowanie.php");
	exit();
}



//Zmiana Maila
if(isset($_POST['starymail']) && isset($_POST['nowymail']))
{
	$wszystko_gra_mail = true;
	$staryemail = $_POST['starymail'];
	$nowyemail = $_POST['nowymail'];
	
		
	$staryemailB = filter_var($staryemail,FILTER_SANITIZE_EMAIL);
	$nowyemailB = filter_var($nowyemail,FILTER_SANITIZE_EMAIL);
	
	if((filter_var($staryemailB,FILTER_VALIDATE_EMAIL)==false)||($staryemailB!=$staryemail))
	{$wszystko_gra_mail = false;
	 $_SESSION['e_starymail'] = "Podaj poprawny adres email! ";
	}
	
	if((filter_var($nowyemailB,FILTER_VALIDATE_EMAIL)==false)||($nowyemailB!=$nowyemail))
	{$wszystko_gra_mail = false;
	 $_SESSION['e_nowyemail'] = "Podaj poprawny adres email! ";
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
			 $rezultat = $polaczeniee->query("SELECT Id FROM Rejestracja WHERE Mail = '$staryemail'");
			 $rezultat2 = $polaczeniee->query("SELECT Id FROM Rejestracja WHERE Mail = '$nowyemail'");
			 $wiersz2 = $rezultat->fetch_assoc();
			 
			 if(!$rezultat) throw new Exception($polaczeniee->error);
			 if(!$rezultat2) throw new Exception($polaczeniee->error);
			 
			 $ile_maili = $rezultat->num_rows;
			 $ile_maili2 = $rezultat2->num_rows;
			 
			 if($ile_maili!=1)
			 {
				$wszystko_gra_mail = false;
				$_SESSION['e_starymail'] = "Taki mail nie istnieje! ";
			 }
			 if($ile_maili2>0)
			 {
				$wszystko_gra_mail = false;
				$_SESSION['e_nowyemail'] = "Taki mail już istnieje, wybierz inny! ";
			 }
			 
			 
			 if($wiersz2['Id'] != $_SESSION['id'])
				{
				$wszystko_gra_mail = false;
				$_SESSION['e_starymail'] = "To nie jest Twój mail! ";
				}
			
			if($wszystko_gra_mail == true)
			{
				$idd = $wiersz2['Id'];
					if($polaczeniee->query(" UPDATE Rejestracja SET Mail ='$nowyemail' WHERE id=$idd"))
				{
					$_SESSION['u1'] = "Udana zmiana maila!";
					header("Location: Stronadlazalogowanych.php");
					
				}else
				{
					if(!$rezultat) throw new Exception($polaczeniee->error);
					if(!$rezultat2) throw new Exception($polaczeniee->error);
					
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
	


//Zmiana Hasła
if(isset($_POST['starehaslo']) && isset($_POST['nowehaslo1']) && isset($_POST['nowehaslo2']))
{
	$wszystko_gra_haslo = true;
	$starehaslo = $_POST['starehaslo'];
	$nowehaslo1 = $_POST['nowehaslo1'];
	$nowehaslo2 = $_POST['nowehaslo2'];
	
	if((strlen($nowehaslo1)<5)||(strlen($nowehaslo1)>20))
	{
		$wszystko_gra_haslo = false;
		$_SESSION['e_haslo'] = "Hasło musi posiadać od 5 do 20 znaków! ";
	}
	
	if($nowehaslo1 != $nowehaslo2)
	{
		$wszystko_gra_haslo = false;
		$_SESSION['e_haslo'] = "Podane hasła nie są identyczne! ";
		
	}
	
	if($starehaslo != $_SESSION['haslo_check'])
	{
		$wszystko_gra_haslo = false;
		$_SESSION['e_haslo'] = "Stare hasło niepoprawne! ";
		
	}
	
	$nowehaslo_hash = password_hash($nowehaslo1,PASSWORD_DEFAULT);
	
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
			 
			 
			 
			 $logincheck = $_SESSION['login_check'];
			 $rezultat = $polaczeniee->query("SELECT*FROM Rejestracja WHERE Mail = ' $logincheck'");		 
			 if(!$rezultat) throw new Exception($polaczeniee->error);
			 	 		 
			if($wszystko_gra_haslo == true)
			{
				
					if($polaczeniee->query(" UPDATE Rejestracja SET Password ='$nowehaslo_hash' WHERE Login='$logincheck'"))
				{
					
					$_SESSION['udanazmianahasla'] = true;
					header("Location: Stronadlazalogowanych.php");
					
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
	
	//Dodawanie zabytków do bazy
	
	if(isset($_POST['zabytek']))
	{
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
				$zabytek = $_POST['zabytek'];
					if($polaczeniee->query("INSERT INTO Zabytki VALUES (NULL,'$zabytek')"))
				{
					
					
					header("Location: Stronadlazalogowanych.php");
					
				}else
				{
					if(!$rezultat) throw new Exception($polaczeniee->error);
										
				}
			}
			$polaczeniee->close(); 
			
	}catch(Exception $e)
	{
		echo '<span style ="color: red;"> Błąd serwera!</span>';
		
		echo '<br /> Infoerror: '.$e;
		
	}
		 
	}
	
	

?>


<!DOCTYPE html>
<html>

<head>
<title> Dla Zalogowanych </title>
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
  padding: 30px 68px;
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
  padding: 30px 68px;
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
  min-width:72px;
  text-align: center;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  font-size: 25px;  
  float: none;
  color: black;
  padding: 30px 80px;
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
 
 .absoluterightcorner {
	 font-size: 25px;  
    padding: 20px;
  position: absolute;
  top: 800px;
  right: 50px; 
 
}

.changemailbox {
  
  padding: 60px;
  position: absolute;
  
  
 
}

.changehaslobox {
  padding: 60px;
  left:500px;
  position: absolute;
   
}

.addzabytki {
 
  padding: 40px;
  position: absolute;
  
  right: 200px; 
  
 
} 
 

 
 

 .error {
	 font-size: 13px;
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

<font size = "50px"><center>
<?php

echo"<p>Witaj ".$_SESSION['user']. "!";
?>
</center></font>

<center>
<div class="absoluterightcorner">
<?php

echo '<p>[ <a href = "Wylogowanie.php"> Wyloguj się ]</a></p>'

?>
</div>


<div class ="changemailbox">
<center><font size = 20px> Zmień Mail </font></center><br/><br/><br/>
<form method = "post">

Stary Mail: <br/> <input type="text" name="starymail"/> <br/>
<?php
 if(isset($_SESSION['e_starymail'])){
 echo '<div class = "error">'.$_SESSION['e_starymail'].'</div>';
 unset($_SESSION['e_starymail']);
 }
 ?>

Nowy Mail: <br/> <input type="text" name="nowymail"/> <br/>
<?php
 if(isset($_SESSION['e_nowyemail'])){
 echo '<div class = "error">'.$_SESSION['e_nowyemail'].'</div>';
 unset($_SESSION['e_nowyemail']);
 }
 ?>

<input type ="submit" value="Zmień mail" />
<br/> 

</form>
</div>

<div class ="changehaslobox">
<center><font size = 20px> Zmień Hasło </font></center><br/><br/><br/>
<form method = "post">

Stare Hasło: <br/> <input type="password" name="starehaslo"/> <br/>
<?php
 if(isset($_SESSION['e_haslo'])){
 echo '<div class = "error">'.$_SESSION['e_haslo'].'</div>';
 unset($_SESSION['e_haslo']);
 }
 ?>
Nowe Hasło: <br/> <input type="password" name="nowehaslo1"/> <br/>
<?php
 if(isset($_SESSION['e_haslo'])){
 echo '<div class = "error">'.$_SESSION['e_haslo'].'</div>';
 unset($_SESSION['e_haslo']);
 }
 ?>
Powtórz Nowe Hasło: <br/> <input type="password" name="nowehaslo2"/> <br/>
<?php
 if(isset($_SESSION['e_haslo'])){
 echo '<div class = "error">'.$_SESSION['e_haslo'].'</div>';
 unset($_SESSION['e_haslo']);
 }
 ?><br/>

<input type ="submit" value="Zmień hasło" />
<br/> 

</form>

</div>

<div class = "addzabytki">

<center><font size = 20px> Dodaj zabytek </font></center><br/><br/><br/>
<form method = "post">

Zabytek: <br/> <input type="text" name="zabytek"/> <br/>


<input type ="submit" value="Dodaj zabytek do bazy" />
<br/> 

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