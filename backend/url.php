<?php

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

  echo $userRow['userName'];
    $test= $userRow['userId'];
    $basescore= $userRow['userScore'];
    $score = mysql_real_escape_string($_GET['score']);
    if ($score>$basescore){
$query = "UPDATE users  SET userScore=$score WHERE userId=$test";
}
			$res = mysql_query($query);
			echo $score;
			echo $basescore;
?>