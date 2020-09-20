<?php
session_start();
unset($_SESSION['blad']);
?>


<!DOCTYPE html>
<html>

<head>
<title> Strona o Krośnie </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
  padding: 30px 69px;
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
  padding: 30px 69px;
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
 
 .slider
 {
	width:1200px auto;
	height:720px;
	
	background: url(5_1.jpg)no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size:cover;
	background-size: cover;

	animation: slide 10s infinite;
 }
 
 
 @keyframes slide
 {
 
	25%{
		background: url(2_1.jpg)no-repeat center center fixed;
		-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size:cover;
	background-size: cover;
		}
	50%{
		background: url(3_1.jpg)no-repeat center center fixed;
		-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size:cover;
	background-size: cover;
		}
	75%{
		background: url(4_1.jpg)no-repeat center center fixed;
		-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size:cover;
	background-size: cover;
	   }
	100%{
		background: url(5_1.jpg)no-repeat center center fixed;
		-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size:cover;
	background-size: cover;
	    }
 
 }
 
.absolute1right {
  position: absolute;
  top: 400px;
  right: 70px;  
}

.absolute2right 
{
  position: absolute;
  top: 700px;
  right: 70px;
}

.absolute1left {
  position: absolute;
  top: 400px;
  left: 70px;  
}

.absolute2left 
{
  position: absolute;
  top: 700px;
  left: 70px;
}
 
.footer
{
 
  height: 20px;
  text-align: center;
  text-bottom:0px;
  background-color: #333;
  color:gray;
}
 
 .footer_text
 {
	
	bottom:5px;
	left:850px; 
 }
 
 
 .responsive {
  
  width: 100%;
  max-width: 200px;
  height: auto;
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

<h1><center><font size = "33">STRONA NA SIECI KOMPUTEROWE I BAZY DANYCH</font></center></h1>
<p><center><font size = "11">STRONA O KROŚNIE</font></center></p>

<div class = "slider">
 
</div>

<div class = "absolute1right">
<a href="https://www.krosnocity.pl/">
<img border="0" alt="Krosnocity" src="kclogo.jpg" class = "responsive"></a>
</div>
<div class = "absolute2right">
<a href="http://krosno112.pl/">
<img border="0" alt="Krosno112" src="k112logo.png" width="200" height="200"></a>
</div>

<div class = "absolute1left">
<a href="https://krosno24.pl/">
<img border="0" alt="Krosno24" src="k24logo.jpg" width="200" height="200"></a>
</div>
<div class = "absolute2left">
<a href="http://www.krosno.pl/pl/dla-mieszkancow/">
<img border="0" alt="Krosno" src="klogo1.png" width="200" height="200"></a>
</div>

</body>

<footer>

<div class = "footer">
<div class = "footer_text">
Copyright: Kamil Bogdanowski
</div>
</div>

</footer>


</html>
