<?php
session_start();
unset($_SESSION['blad']);


	
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
				$Id = $polaczeniee->query("SELECT Id FROM Zabytki");
				if(!$Id) throw new Exception($polaczeniee->error);
				
				
				
				$row = $Id->num_rows;
				$idtoshow = rand(1,$row);
				
				$sql_name = $polaczeniee->query("SELECT Name FROM Zabytki WHERE Id = $idtoshow");
				$showname = $sql_name->fetch_assoc();
				$showname = $showname['Name'];
				
				if(!$sql_name) throw new Exception($polaczeniee->error);
			
			}
			$polaczeniee->close(); 
			
	}catch(Exception $e)
	{
		echo '<span style ="color: red;"> Błąd serwera!</span>';
		
		echo '<br /> Infoerror: '.$e;
		
	}


?>


<!DOCTYPE html>
<html>

<head>
<title> Losowanie </title>
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
  position:absolute;
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

<h1><center><font size = "33">Losowanie atrakcji turystycznych wartych zwiedzenia</font></center></h1>
<br/>


<font size = 30px>
<center>
<br/><br/><br/><br/><br/>
<?php

echo "Wylosowanym dla Ciebie miejscem jest: ".$showname;

?>
</center>
</font>






</body>

<footer>

<div class = "footer">
<div class = "footer_text">
Copyright: Kamil Bogdanowski
</div>
</div>

</footer>


</html>