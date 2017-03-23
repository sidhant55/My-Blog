<?php
    ob_start();
    session_start();
    require_once 'dbconnect.php';
    
    // if session is not set this will redirect to login page
    if( !isset($_SESSION['user']) ) {
        header("Location: index.php");
        exit;
    }
    // select loggedin users detail
    $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
    $userRow=mysql_fetch_array($res);
  if ( isset($_POST['correct']) ) {
    $userRow['userId']=$userRow['userId']+1;
    $query = "INSERT INTO users(userName) VALUES('love')";
      $res = mysql_query($query);
  }
$rowSQL = mysql_query( "SELECT MAX(userScore) AS max FROM `users`;" );
$row = mysql_fetch_array( $rowSQL );
$largestNumber = $row['max'];
$que = mysql_query("SELECT * FROM users WHERE userScore = '$largestNumber' ");
$r1 = mysql_fetch_array($que);
$r2 = $r1['userName'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="icon" href="icon.jpg" height="30px">
<title>Welcome - <?php echo $userRow['userName']; ?></title></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="main.css" type="text/css" />
<style>
@media(max-width:700px){
  body{
           padding-top:120px;
  }
}
@media(min-width:700px){
  body{
           padding-top:120px;
  }
}
@media(max-width:500px){
    h1.header{
        font-size:20px;
  }
h1.foot{
        font-size:20px;
}
}
canvas {
    border:1px solid #d3d3d3;
    background-color: black;
    background:url(download.jpg);
    background-repeat: no-repeat; 
    background-size: 100% 100%; 
}
</style>
</head>
<body onload="startGame()">

<nav class="navbar navbar-default navbar-fixed-top" >
  <div style="background-color:black; font-color:white;" class="container-fluid">
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img class="abc" align="top" src="icon.jpg" height="30px"></a>

      <a class="navbar-brand" id="tit" href="#">Sidhant Mishra</a>

    </div>
            <nav class="nav">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
          <li><a href="http://www.sidhantmishra.byethost16.com">Home</a></li>
      </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
    </div>
    </nav>
  </div>
</nav>
<button style=" width:100%; text-align:center; background-color:lightblue; border-radius: 10px; cursor:pointer; font-size:50px" type="button" ontouchstart ="accelerate(-0.05)" onTouchEnd="accelerate(0.04)" onmousedown="accelerate(-0.05)" onmouseup="accelerate(0.04)">FLY</button>
<h3 class="foot" style="text-align:center; font-size:30px">Use fly button to accelerate your bird</h3>
<h3 class="foot" style="text-align:center; font-size:30px">How long can you stay alive?</h3>
<img id="image1" width="0" height="0" src="image1.jpg">
<img id="image2" width="0px" height="0px" src="image2.jpg">

    
        <div class="page-header">
        <h1 class="header" style="position:absolute; top:50px;">&nbsp;Welcome <?php echo $userRow['userName'];?>, lets have some fun...Your High Score:<?php echo $userRow['userScore'];?>&nbsp; </h1>
    </div>
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">
var myGamePiece;
var myObstacles = [];
var myScore;

function startGame() {
    myGamePiece = new component(45, 45, "red", 10, 200, "obj");
    myGamePiece.gravity = 0.05;
    myScore = new component("30px", "Consolas", "white", 80, 40, "text");
    myGameArea.start();
}
this.d=0;
var myGameArea = {
    canvas : document.createElement("canvas"),
    start : function() {
         this.canvas.width = window.innerWidth;
        var w=window.innerHeight;
        this.canvas.height = 0.7*w;
        this.context = this.canvas.getContext("2d");
        document.body.insertBefore(this.canvas, document.body.childNodes[0]);
        this.frameNo = 0;
 this.interval = setInterval(updateGameArea, 5);
            elemLeft = canvas.offsetLeft,
    elemTop = canvas.offsetTop,
    context = canvas.getContext('2d'),
    elements = [];

        },
    clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }
}


function component(width, height, color, x, y, type) {
    this.type = type;
    this.score = 0;
    this.width = width;
    this.height = height;
    this.speedX = 0;
    this.speedY = 0;    
    this.x = x;
    this.y = y;
    this.gravity = 0;
    this.gravitySpeed = 0;
    this.c = 0;
    this.update = function() {
        ctx = myGameArea.context;
        if (this.type == "text") {
            ctx.font = this.width + " " + this.height;
            ctx.fillStyle = color;
            ctx.fillText(this.text, this.x, this.y);
        } else if(this.type == "obj"){
            var img1 = document.getElementById("image1");
            var img2 = document.getElementById("image2");
            this.c++;
            if ((this.c%30>=1)&&(this.c%30<=15)){
            ctx.drawImage(img1, this.x, this.y, 45, 45);
            }
            else{
                ctx.drawImage(img2, this.x, this.y, 45, 45);
            }

        }
        else{
            ctx.fillStyle = color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        }
    }
    this.newPos = function() {
        this.gravitySpeed += this.gravity;
        this.x += this.speedX;
        this.y += this.speedY + this.gravitySpeed;
        this.hitTop();
        this.hitBottom();
    }
    this.hitBottom = function() {
        var rockbottom = myGameArea.canvas.height - this.height;
        if (this.y > rockbottom) {
            this.y = rockbottom;
            this.gravitySpeed = 0;
        }
    }
    this.hitTop = function() {
        if (this.y < 0){
            this.y = 0;
            this.gravitySpeed = 0.05;
        }
    }
    this.crashWith = function(otherobj) {
        var myleft = this.x;
        var myright = this.x + (this.width);
        var mytop = this.y;
        var mybottom = this.y + (this.height);
        var otherleft = otherobj.x;
        var otherright = otherobj.x + (otherobj.width);
        var othertop = otherobj.y;
        var otherbottom = otherobj.y + (otherobj.height);
        var crash = true;
        if ((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright)) {
            crash = false;

        }
            return crash;

    }
}

this.e=0;
function updateGameArea() {
    var x, height, gap, minHeight, maxHeight, minGap, maxGap;
    for (i = 0; i < myObstacles.length; i += 1) {
        if (myGamePiece.crashWith(myObstacles[i])) {
            this.e += 1;
        } 
    }
var highest='<?php echo $largestNumber; ?>';
    var highname='<?php echo $r2; ?>';
    if (this.e == 1)  { 
     var xhttp;
  if (window.XMLHttpRequest) {
    // code for modern browsers
    xhttp = new XMLHttpRequest();
    }
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "url.php?score=" + this.d, true);
  xhttp.send();
document.write('<p style="color:red; text-align:center; padding-top:50px; font-size:40px;">OOPS...you crashed...</p>');
      document.write('<p style="color:red; text-align:center; font-size:40px;">your score '+this.d+'</p>');
    document.write('<p style="text-align:center; font-size:40px;"><a href="http://www.sidhantmishra.byethost16.com/backend/home.php" style="text-align:center;">Retry</a></p>');
  document.write('<p style="color:red; text-align:center; font-size:40px;">'+highname+':'+highest+'</p>');
    }
    myGameArea.clear();
    myGameArea.frameNo += 1;
    
    if (myGameArea.frameNo == 1 || everyinterval(300)) {
        x = myGameArea.canvas.width;
        minHeight = 20;
        maxHeight = 200;
        height = Math.floor(Math.random()*(maxHeight-minHeight+1)+minHeight);
        minGap = 100;
        maxGap = 200;
        gap = Math.floor(Math.random()*(maxGap-minGap+1)+minGap);
        this.d++;
        if(this.d%8==1){
        myObstacles.push(new component(20, height, "green", x, 0));
        myObstacles.push(new component(20, x - height - gap, "white", x+150, height + gap));
        }
        else if(this.d%8==2){
        myObstacles.push(new component(20, height, "blue", x, 0));
        myObstacles.push(new component(20, x - height - gap, "orange", x+150, height + gap));
        }
        else if(this.d%8==3){
        myObstacles.push(new component(20, height, "red", x, 0));
        myObstacles.push(new component(20, x - height - gap, "brown", x+150, height + gap));
        }
        else if(this.d%8==4){
        myObstacles.push(new component(20, height, "pink", x, 0));
        myObstacles.push(new component(20, x - height - gap, "yellow", x+150, height + gap));
        }
        else if(this.d%8==5){
        myObstacles.push(new component(20, height, "yellow", x, 0));
        myObstacles.push(new component(20, x - height - gap, "pink", x+150, height + gap));
        }
        else if(this.d%8==6){
        myObstacles.push(new component(20, height, "brown", x, 0));
        myObstacles.push(new component(20, x - height - gap, "red", x+150, height + gap));
        }
        else if(this.d%8==7){
        myObstacles.push(new component(20, height, "orange", x, 0));
        myObstacles.push(new component(20, x - height - gap, "blue", x+150, height + gap));
        }
        else if(this.d%8==8){
        myObstacles.push(new component(10, height, "white", x, 0));
        myObstacles.push(new component(10, x - height - gap, "green", x+150, height + gap));
        }
    }
    for (i = 0; i < myObstacles.length; i += 1) {
        myObstacles[i].x += -1;
        myObstacles[i].update();
    }
    myScore.text="SCORE: " + this.d;
    myScore.update();
    myGamePiece.newPos();
    myGamePiece.update();
}

function everyinterval(n) {
    if ((myGameArea.frameNo / n) % 1 == 0) {return true;}
    return false;
}

function accelerate(n) {
    myGamePiece.gravity = n;
}
</script>
<br>

    
</body>
</html>
<?php ob_end_flush(); ?>        