<?php


session_start();


if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	header("Location: Stronadlazalogowanych.php");
	exit();
}





?>



<!DOCTYPE html>
<html>

<head>
<title> Logowanie </title>
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
  min-width:70px;
  text-align: center;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  font-size: 25px;  
  float: none;
  color: black;
  padding: 30px 82px;
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

<h1><center><font size = "33">LOGOWANIE</font></center></h1>

<center>
<?php
if((isset($_SESSION['udanarejestracja'])) && ($_SESSION['udanarejestracja']==true))
{
	echo "Udana Rejestracja!! Możesz sie zalogować :)";
	unset($_SESSION['udanarejestracja']);
	
}
?>
</center>
<br/><br/>


<center>


<form action = "SprawdzLogowanie.php" method = "post">

Login: <br/> <input type="text" name="login"/> <br/>
Hasło: <br/> <input type="password" name="haslo"/> <br/><br/>
<input type ="submit" value="Zaloguj się" />
<br/> 

</form>



<?php

if(isset($_SESSION['blad']))
{
echo $_SESSION['blad'];
}

unset($_SESSION['blad']);

?>
<br/>
<form>
<input type="button" value="Zarejestruj" onclick="window.location.href='Rejestracja.php'" />
</form>

</br>

</center>
<br/><br/><br/><br/><br/><br/>


</body>

<footer>

<div class = "footer">
<div class = "footer_text">
Copyright: Kamil Bogdanowski
</div>
</div>

</footer>


</html>