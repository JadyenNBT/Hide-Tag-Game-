<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <link rel="icon" href="./media/tab-logo.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie-edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
  <link rel="stylesheet" type='text/css' href='style.css' />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
  <title>Lights&Shadows</title>
</head>

<style> 
*{
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
}

html, body{
  font-family: 'Oswald', sans-serif;
  width:  100%;
  height: 100%;
  margin: 0;
}

#container {
 min-height: 100%;
}
th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
  text-align: center;
}
.table :nth-child(1) {
  background: gold;
}
.table :nth-child(2) {
  background: gold;
}
.table2 :nth-child(1) {
  background: silver;
}
.table2 :nth-child(2) {
  background: silver;
}
.table3 :nth-child(1) {
  background: brown;
}
.table3 :nth-child(2) {
  background: brown;
}
#main {
  overflow: auto;
  padding-bottom: 236px;
}

.logo-div,.nav-links{
  display: flex;
}

header{
  display: flex;
  position: relative;
  margin: auto;
  background-color: grey;
  min-height: 8vh;
  align-items: center;
  padding: 1%;
  width: 100%;
  overflow: auto;
}

.logo{
  font-weight: 400;
 text-transform: uppercase;
 letter-spacing: 2px;
  color: white;
}

.nav-links li {
  position: relative;
}

/* .nav-links a::before {
  content: '';
  display: block;
  height: 5px;
  width: 100%;
  background-color: orange;
  position: absolute;
  top: 0;
  width: 0%;
  transition: all ease-in-out 250ms;
} */

nav a:hover::before {
  width: 100%;
}

.nav-links a{
  float: left;
  display: block;
  color:whitesmoke;
  text-align: center;
  text-decoration: none;
}

.nav-links{
  justify-content: space-around;
  list-style: none;
  width: 2%;
  letter-spacing: 1px;
  font-size: 17px;
}

.nav-links a:hover{
  background-color: grey;
  color:orange;
}

.logo-div{
flex: 2;
}

nav{
  display: flex;
  align-items: center;
  flex: 1;
  padding: 1%; 
}

@media screen and (max-width: 500px) {
  header {
    float: none;
    display: block;
  }
}

.logo span {
  color: orange;
}

#canvas {
  position: relative;
  overflow: auto;
  top:0;
  bottom: 0;
  left: 0;
  right: 0;
  margin:1%;
}

/* Footer Styling */
.footer {
  background: grey;
  position: relative;
  height: 236px;
  margin-top: -236px;
  clear: both;
}

.footer-content{
  display: flex;
  margin-left: 40px;
  margin-right: 40px;
}

.footer-section {
  flex: 1;
  padding: 15px;
}

.footer .footer-content .links ul a {
  color: black;
  padding-left: 25px;
  text-decoration: none;
  display: block;
  margin-bottom: 8px;
  font-size: 1.1em;
  transition: all .3s;
}

.footer .footer-content .links ul a:hover {
  color: orange;
  margin-left: 15px;
  transition: all .3s;
}

.footer .footer-content .social-links .contact span{
  display: block;
  font-size: 1.1em;
  margin-bottom: 8px;
}

.footer .footer-content .social-links .contact span i{
  color: orange;
}

.footer .footer-content .social-links .socials a {
  border: 1px solid black;
  color:  black;
  width: 45px;
  height: 41px;
  padding-top: 5px;
  margin-right: 5px;
  text-align: center;
  display: inline-block;
  font-size: 1.1em;
  border-radius: 5px;
  transition: all 0.3s;
}

.footer .footer-content .social-links .socials a:hover{
  color: orange;
  border: 1px solid orange;
  transition: all 0.3s;
}

#gamebutton {
  display: inherit;
  border-radius: 4px;
  background-color: orange;
  border: none;
  color: white;
  text-align: center;
  font-size: 100px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  position: relative;
  width: 100%;
  height: 530px;
  align-items: center;
  justify-content: center;
}

#gamebutton span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

#gamebutton span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

#gamebutton:hover span {
  padding-right: 70px;
}

#gamebutton:hover span:after {
  opacity: 1;
  right: 0;
}

</style>

<body>
  <div id="header">
  <header>
    <div class="logo-div">
      <h4 class="logo">Lights & <span>Shadows</span></h4>
    </div>
    <nav class="nav-links">
      <li><a class="nav-link" href="/about">About Us</a></li>
      <li><a class="nav-link" href="#">The Game</a></li>
      <li><a class="nav-link" href="/leaderboards">Leaderboards</a></li>
     
	   <!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<p>Welcome <?php echo $_SESSION['username']; ?></p>
			<p> <a href="/registration"> <i class="fa fa-sign-out" aria-hidden="true"></i></a> </p>
		<?php endif ?>

    </nav>
  </header>
  </div>
  <div id= "container">
    <div id="main">
        <button id="gamebutton" type="button" onclick=myFunction()><span>Play Game!</span></button>
     <canvas id="canvas" width="400" height="300">No HTML5 canvas support</canvas>

    </div>
  </div>
  <div id="footer">
  <footer>
    <div class="footer">
      <div class="footer-content">
        <div class="footer-section about">
          <h1 class="logo-text">Lights & Shadows</h1>
          <p> A simple game where there are hiders and seekers. The objective is for the seeker to catch all hiders or
            the hiders evading the seeker till time runs out.</p>
        </div>
        <div class="footer-section links">
          <h1>Quick Links</h1>
          <br>
          <ul>
            <a href="/about">
              <li>About Us</li>
            </a>
            <a href="/leaderboards">
              <li>Leader Boards</li>
            </a>
            <a href="#">
              <li>Terms and Conditions</li>
            </a>
            <a href="#">
              <li>Credits</li>
            </a>
          </ul>
        </div>
        <div class="footer-section social-links">
          <h1>Contact Us</h1>
          <div class="contact">
            <span><i class="fa fa-phone"></i> &nbsp; 0506234176</span>
            <span><i class="fa fa-envelope"></i> &nbsp; lights&shadows@protonmail.com</span>
          </div>
          <div class="socials">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="https://www.twitch.tv/reformedmonty" target="_blank"><i class="fa fa-twitch"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  </div>
  <script src="./js/index.js"></script>
  <script src = "/socket.io/socket.io.js"></script>
  <script>
      var socket=io(); 
      socket.emit('clientEvent', 'Sent an event from the client!');
      socket.on('broadcast',function(data) {
        console.log(data);
      //document.body.innerHTML = '';
      //document.write(data.description);
      }); 
  </script>
</body>

		
	</div>
		
</html>