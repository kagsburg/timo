
<?php
	
	
	
	function reports(){
		
		//If user selected loans report.
		if($_POST['type']== "loan"){
			$db = new mysqli('localhost', 'root','','sacco1');
            $gat = "select * from loanrequest" ;
			$result = $db->query($gat);
        //asign the number of rows selected to the variable.
			@$num = $result->num_rows;
	     echo "<div id='table'>";
		 echo "<table border='1'>";
		 echo "<tr>";
		 echo "<td colspan='7' style='text-align:center'>"."LOAN DETAILS"."</td>";
		 echo "</tr>";
		 echo "<tr id='ni'>";
			echo "<td>"."loanid.</td>";
			echo "<td>"."memberid.</td>";
			echo "<td>"."status.</td>";
			echo "<td>"."total amount.</td>";
			
				echo "</tr>";
	for($j=0;$j<$num;++$j){
					$row = $result->fetch_assoc();
					if($j%2==0){
					echo "<tr id='even'>";
					echo "<td>".$row['loan id']."</td>";
				echo "<td>".$row['memberid']."</td>";
				echo "<td>".$row['status']."</td>";
				echo "<td>".$row['Total amount']."</td>";
				
					echo "</tr>";
					}
					

				}
				
					echo "</table>";
					echo"</div>";
				}
				//If user selected loan payback reports
				if($_POST['type']== "payback"){
	       $db = new mysqli('localhost', 'root','','sacco1');
            $gat = "select * from loanrepayment" ;
			$result = $db->query($gat);
        //asign the number of rows selected to the variable.
			@$num = $result->num_rows;
				echo "<div id='table'>";
				echo "<table border='1'>";
				echo "<tr>";
				echo "<td colspan='7' style='text-align:center'>"."LOAN PAYBACK DETAILS"."</td>";
				echo "</tr>";
				echo "<tr id='ni'>";
					echo "<td>"."repaymentid.</td>";
			echo "<td>"."loan id.</td>";
			echo "<td>"."memberid.</td>";
			echo "<td>"."amount paid.</td>";
			
				echo "</tr>";
				for($j=0;$j<$num;++$j){
					$row = $result->fetch_assoc();
					if($j%2==0){
					echo "<tr id='even'>";
					echo "<td>".$row['repaymentid']."</td>";
				echo "<td>".$row['loan id']."</td>";
				echo "<td>".$row['memberid']."</td>";
				echo "<td>".$row['amount paid']."</td>";
				
					echo "</tr>";
					}
					else{
					echo "<tr id='odd'>";
				echo "<td>".$row['repaymentid']."</td>";
				echo "<td>".$row['loan id']."</td>";
				echo "<td>".$row['memberid']."</td>";
				echo "<td>".$row['amount paid']."</td>";
				
					echo "</tr>";
					}

				}
				echo "</table>";
				echo"</div>";
			}
			//If user selected Family sacco members report
			if($_POST['type']== "member"){
	       $db = new mysqli('localhost', 'root','','sacco1');
            $gat = "select * from member" ;
			$result = $db->query($gat);
        //asign the number of rows selected to the variable.
			$num = $result->num_rows;
			//output the selected data in table format*/
			    echo "<div id='table'>";
				echo "<table border='1'>";
				echo "<tr id='head'>";
				echo "<td colspan='3' style='text-align:center'>"."FAMILY SACCO MEMBERS LIST"."</td>";
				echo "</tr>";
				echo "<tr id=''>";
				echo "<td>"."memberid.</td>";
			echo "<td>"."fisrtname.</td>";
			echo "<td>"."lastname.</td>";
			echo "<td>"."username.</td>";
			echo "<td>"."password.</td>";
				echo "</tr>";
				for($j=0;$j<$num;++$j){
					$row = $result->fetch_assoc();
					
					echo "<tr id=''>";
					echo "<td>".$row['memberid']."</td>";
				echo "<td>".$row['firstname']."</td>";
				echo "<td>".$row['lastname']."</td>";
				echo "<td>".$row['username']."</td>";
				echo "<td>".$row['password']."</td>";
					echo "</tr>";
					

				}
				echo "</table>";
				echo"</div>";
			}
			//report showing regular members
			if($_POST['type']== "regular"){
				$Count=0;
				$tym=30*6*24*60*60;
				$d=date("Y-m-d");
				$you=date("Y-m-d",time()-$tym);
				//echo date("Y-m-d H:i:s",time()-$var);
				//echo "$d\n";
				//echo "$you";
				
				/*if($you<$date){
					echo "$date is greater than $you";
				}*/
				@$connect=mysqli_connect("localhost","root","","sacco1");
				
				@$out="SELECT memberid FROM member";
				if($log=mysqli_query($connect, $out))
				{
				
					$num = $log->num_rows;

					for($j=0;$j<$num;++$j){
							$number=0;
							//echo "$j";
						$row=mysqli_fetch_array($log);
						$mem=$row['memberid'];
						echo "the first member $mem\n\n";
						/*if($member>$you){
							echo "$member is greater than $you\n\n";
							$sum=$row['memberId'];
							echo "$sum\n\n";*/
							
						@$get="SELECT * FROM contribution WHERE memberid ='$mem'";
						if($lg=mysqli_query($connect, $get))
						{
							$reg = $lg->num_rows;
							for($m=0;$m<$reg;++$m){
								$row=mysqli_fetch_array($lg);
								$d=$row['date'];
								if($d>$you){
									@$number++;
									echo "$number\n";
								}
							}
							if(@$number>=6){
								//$memberid=$da;
								$wet=$row['memberid'];
								echo "with count greater than 5 $wet\n";
								
								@$get2="SELECT memberid,username FROM member WHERE memberid ='$wet'";
								if($lg2=mysqli_query($connect, $get2))
								{
									$num2 = $lg2->num_rows;
									
									for($n=0;$n<$num2;++$n){
										
										$row2=mysqli_fetch_array($lg2);
										$member2=$row2['username'];
										
									}
									
								}
								
								@$get3="DELETE FROM regular_members WHERE memberid='$wet'";
								mysqli_query($connect, $get3);
								if(mysqli_query($connect,"INSERT INTO regular_members(memberid,username) 
								VALUES('$wet','$member2')")){}
								/*{
								echo "<script>alert('Submited successfully')</script>";
								
								}else{
								echo "<script>alert('Failed')</script>";
								
								}*/
							}
						}
						
						
						
					}	
				}
				$q= "select * from regular_members" ;
				$result8 = @$db->query($q);
	
				$num_r3 = $result8->num_rows;
				
				echo "<table border='1'>";
				echo "<tr>";
				echo "<td colspan='5' style='text-align:center'>"."LOAN DETAILS"."</td>";
				echo "</tr>";
				echo "<tr id='ni'>";
				echo "<td>"."memberid.</td>";
				echo "<td>"."username</td>";
				echo "</tr>";
				for($j=0;$j<$num_r3;++$j){
					$row=mysqli_fetch_array($result8);
					echo "<tr>";
					echo "<td>".$row['memberid']."</td>";
					echo "<td>".$row['username']."</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			//Report showing details of investment ideas.
			if($_POST['type']== "idea"){
	       $db = new mysqli('localhost', 'root','','sacco1');
            $gat = "select * from investmentidea" ;
			$result = $db->query($gat);
        //asign the number of rows selected to the variable.
			@$num = $result->num_rows;
			//output the selected data in table format*/
			    echo "<div id='table'>";
				echo "<table border='1'>";
				echo "<tr id='head'>";
				echo "<td colspan='5' style='text-align:center'>"."FAMILY SACCO INVESTMENT IDEAS"."</td>";
				echo "</tr>";
				echo "<tr id=''>";
				echo "<td>"."idea id.</td>";
			echo "<td>"."idea name.</td>";
			echo "<td>"."business idea.</td>";
			echo "<td>"."memberid.</td>";
			
				echo "</tr>";
				for($j=0;$j<$num;++$j){
					$row = $result->fetch_assoc();
					
					echo "<tr id='even'>";
					echo "<td>".$row['idea id']."</td>";
				echo "<td>".$row['idea name']."</td>";
				echo "<td>".$row['business idea']."</td>";
				echo "<td>".$row['memberid']."</td>";
				
					echo "</tr>";
					
					

				}
				echo "</table>";
				echo"</div>";
			}
			
			
			
			//Report showing members contributions and shares
			if($_POST['type']== "contribution"){
	       $db = new mysqli('localhost', 'root','','sacco1');
            $qury = "select * from contribution" ;
			$result = $db->query($qury);
        //asign the number of rows selected to the variable.
			$num = $result->num_rows;
			//output the selected data in table format*/
			    echo "<div id='table'style='background-color:#ffe6cc'>";
				echo "<table border='1'>";
				echo "<tr id='head'>";
				echo "<td colspan='3' style='text-align:center'>"."FAMILY SACCO MEMBERS CONTRIBUTIONS AND SHARES"."</td>";
				echo "</tr>";
				echo "<tr id='colh'>";
				echo "<td>"."receipt_no.</td>";
			echo "<td>"."amount.</td>";
			echo "<td>"."date.</td>";
			echo "<td>"."memberid.</td>";
			echo "<td>"."status.</td>";
				echo "</tr>";
				for($j=0;$j<$num;++$j){
					$row = $result->fetch_assoc();
				
					echo "<tr id=''>";
					echo "<td>".$row['reciept_no']."</td>";
				echo "<td>".$row['Amount']."</td>";
				echo "<td>".$row['Date']."</td>";
				echo "<td>".$row['memberid']."</td>";
				echo "<td>".$row['status']."</td>";
					echo "</tr>";
				}

				}
				echo "</table>";
				echo"</div>";
			}
		
		function login(){
		//Establish connection to the server and database
		$connect=mysqli_connect("localhost","root","","sacco1");
		//Fetch user name and password from the form
		@$admin=$_POST['administratorid'];
		$pass=$_POST['password'];
		//Retrive all records from table stud 
		$result="SELECT *FROM administrator
				 WHERE administratorid='$admin' AND password='$pass'";
		$log=$connect->query($result);
		//If no record has username and password that match the input from the user 
		if($log->fetch_assoc()==0){
			
			
			//Remain on the login interface if the user enters values that do not match
			echo "<script>alert('admin id and password not matching.'+' Please enter correct id and password')</script>";
            echo "<script>window.open('scfunc.php')</script>";
		}
			//If any record matches the user input  log  the user in and notify the user
		else{
			homepage();
			
		};
		
	}
		
	
//createdatabase();

	function createdatabase(){
		//Create connection to the server
		@$connect=mysql_connect("localhost","root","");
		//Test if connection is established 
		if($connect)
		{
			echo "Connected to the server<br/>";
		}
		
		else{
			echo "Connection failed<br/>";
		}
		
		//Create database "final" and check if it is created 
		if(mysql_query("CREATE DATABASE sacco1")){
			echo "Database created";
		}
		
		else{
			echo "Database not created.<br/>";
		}
		
		//Select the database created
		$db=mysql_select_db("sacco1");
		if($db){
			echo "Database selected";
		}
		
		else{
			echo "Database not selected selected";	
		}
		//Create table "stud" in the database selected
		$table1=mysql_query("CREATE TABLE `sacco1`.`member` (`memberid` INT(5) NOT NULL, 
		`firstname` VARCHAR(30) NOT NULL, `lastname` VARCHAR(30) NOT NULL, `username` VARCHAR(30) NOT NULL, 
		`password` VARCHAR(30) NOT NULL, `Date` DATE NOT NULL,
		PRIMARY KEY (`memberid`))");
  
			
			
			 
			    
		
		
		$table2=mysql_query("CREATE TABLE `sacco1`.`contribution` (`reciept_no` INT(5) NOT NULL, 
		`Amount` VARCHAR(30) NOT NULL, `Date` DATE NOT NULL, 
		`memberid` INT(5) NOT NULL,
		`status` VARCHAR(10) NOT NULL,
			 FOREIGN KEY (`memberid`) REFERENCES `member`(`memberid`)
		PRIMARY KEY (`reciept_no`))");
            
			
		         
		
		
		
		$table3=mysql_query("CREATE TABLE `sacco1`.`loanrequest` (`loan id` INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
		  `memberid` INT(5) NOT NULL, `status` VARCHAR(40) NOT NULL, 
		  `Total amount` FLOAT(40) NOT NULL
		   FOREIGN KEY (`memberid`) REFERENCES `member`(`memberid`)
)");
        
	

		  

		
		$table4=mysql_query("CREATE TABLE `sacco1`.`investmentidea`
			(
			 `idea id` INT(4) NOT NULL AUTO_INCREMENT,
			`idea name` VARCHAR(100) NOT NULL,
			`business idea` VARCHAR(100) NOT NULL,
			`memberid` INT(5) NOT NULL,
			 FOREIGN KEY (`memberid`) REFERENCES `member`(`memberid`)
			
			PRIMARY KEY(`idea id`) 
			
		
		)");
		
		$table5=mysql_query("CREATE TABLE administrator
			(
			administratorid INT(5) NOT NULL PRIMARY KEY,
	  

		password VARCHAR(20) NOT NULL 
		)");
		
		$table6=mysql_query("CREATE TABLE `sacco1`.`investmentoutcome`
			(
			`outcome id` INT(5) NOT NULL AUTO_INCREMENT,
			`idea id` INT(5) NOT NULL,
			
			`price` FLOAT(30) NOT NULL,  
			`loss` FLOAT(30) NOT NULL, 
			`memberid` INT(5) NOT NULL,
			`profit` FLOAT(30) NOT NULL,  
			PRIMARY KEY (`outcome id`)
			 FOREIGN KEY (`memberid`) REFERENCES `member`(`memberid`)
			
			
		)");
		
		
		$table7=mysql_query("CREATE TABLE `sacco1`.`loanrepayment`
			(
		     `repayment id` INT(5) NOT NULL AUTO_INCREMENT ,
			
			`loan id` INT(5) NOT NULL, 
			`memberid` INT(5) NOT NULL, 
			`amount paid` FLOAT(30) NOT NULL,
			PRIMARY KEY(`repayment id`)
			 FOREIGN KEY (`memberid`) REFERENCES `member`(`memberid`)
			 
			
		)");
		 
  
		$table8=mysql_query("CREATE TABLE `sacco1`.`benefits` 
			(
			`Id` int NOT NULL AUTO_INCREMENT,
			`memberid` INT(5) NOT NULL,
			`shares` FLOAT(30)  NULL,
            FOREIGN KEY (`memberid`) REFERENCES `member`(`memberid`)			
			PRIMARY KEY(`Id`)
			
		)");
		$table9=mysql_query("CREATE TABLE `sacco1`.`contribution_check` 
			(
			`memberid` VARCHAR(25) NOT NULL PRIMARY KEY,
			`amount` FLOAT(30) NOT NULL
		)");
	
		
		
		$table10=mysql_query("CREATE TABLE `sacco1`.`regular_members`
			(
			`memberid` VARCHAR(25) NOT NULL PRIMARY KEY,
			`username` VARCHAR(25) NOT NULL
			
		)");
		
		mysql_close($connect);
	}
	
	
	function submittingmember(){
		@$connect=mysql_connect("localhost","root","");
		@$db=mysql_select_db("sacco1");
		
		@$memberid =$_POST['memberid'];
	@$fname=$_POST['firstname'];
	@$lname=$_POST['lastname'];
	@$username=$_POST['username'];
	@$password=$_POST['password'];
	if(mysql_query("INSERT INTO member
	VALUES('$memberid','$fname','$lname','$username','$password')"))
	{
	//If data submited to the table alert the user.
	mysql_query("INSERT INTO benefits
	          VALUES(0,'$memberid',0)");
	   echo "<script>alert('Member added succesfully')</script>";
	   addingmember();
	}

	
		
		
		
}

	
	function investidea(){
	
		@$connect=mysql_connect("localhost","root","");
		
		@$db=mysql_select_db("sacco1");
		
		
		@$ideaid =$_POST['idea id'];
	@$ideaname =$_POST['idea name'];
	@$business =$_POST['business'];
	@$memberid =$_POST['memberid'];
    
	
	if(mysql_query("INSERT INTO investmentidea
		VALUES('$ideaid','$ideaname','$business','$memberid')"))
		{
		echo "<script>alert('Submited successfully')</script>";
		
		}else{
		echo "<script>alert('Failed')</script>";
		
		}
		}

	
	@$c = mysql_connect("localhost","root","");
   @$db = mysql_select_db("sacco1");

	@$c = $_REQUEST['action'];
	switch($c){
		case "submittingmember":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		submittingmember();  //call the function, which is in functions.php
		break;
		
		case "investidea":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		investidea();  //call the function, which is in functions.php
		break;
		
		case "login":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		login();  //call the function, which is in functions.php
		break;
		
		case "homepage":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		homepage();  //call the function, which is in functions.php
		break;
		
		case "getrecords":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		getrecords();  //call the function, which is in functions.php
		break;
		
		case "addingmember":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		addingmember();  //call the function, which is in functions.php
		break;
		
		case "addinginvest":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		addinginvest();  //call the function, which is in functions.php
		break;
		
		case "reports":
		reports();

		//break;



	}
	function getrecords(){
		//Create connection to the server
		@$connect=mysql_connect("localhost","root","");
		//Select the database created
		@$db=mysql_select_db("sacco1");
		
		@$begin=$_POST['begin'];
		
		@$RECEIPT=$_POST['receiptno'];
		@$AMT1 =$_POST['amount'];
		@$DATE =$_POST['date'];
		@$MEMBER=$_POST['memberid'];
	
		@$SUBMIT=$_POST['submit'];
		@$AMT2=$_POST['amt'];
		@$MEM=$_POST['membid'];
		
		@$IDEA = $_POST['idea'];
		@$CAPITAL = $_POST['capital'];
		@$BUSINESS = $_POST['business idea'];
		
		@$memberid = $_POST['memberid1'];
		
		if($begin=="idea"){
				if(mysql_query("INSERT INTO investmentidea 
				VALUES('$IDEA','$BUSINESS','$memberid','$CAPITAL')"))
				{
					echo "<script>alert('Submited successfully')</script>";
					
				}else{
					echo "<script>alert('Failed to submit')</script>";
					echo "<p class='logout'><a href='call.php?action=homepage'>back</a></p>";
					
				}
				
				
		}
		
			if($begin=="loan_request"){
			if(mysql_query("INSERT INTO loanrequest
				VALUES(NULL,'$MEM','$SUBMIT','$AMT2')"))
				{
					echo "<script>alert('Submited successfully')</script>";
					
				}else{
					echo "<script>alert('Failed to submit')</script>";
					echo "<p class='logout'><a href='call.php?action=homepage'>back</a></p>";
					
				}
	
		
		}
		
		
		if($begin=="contribution"){
				if(mysql_query("INSERT INTO contribution 
				VALUES('$RECEIPT','$AMT1','$DATE','$MEMBER','$SUBMIT')"))
				{
					echo "<script>alert('Submited successfully')</script>";
					
				}else{
					echo "<script>alert('Failed to submit')</script>";
					echo "<p class='logout'><a href='call.php?action=homepage'>back</a></p>";
					
				}
				
				
		}
		
}
function approveloan(){
if(!@fopen('records.txt','r')){
echo "no pending records";
}else{
echo "<div id='contr'>";
echo "<h3  id='hd'>FAMILY SACCO PENDING LOANS</H3>";
echo "<ul id='verif'>";
$lines= file('records.txt');
foreach($lines as $data){
if((strncmp($data,"loan",4)==0)){
$details=explode(" \n",$data);
echo "<li>$details[0] </li>";
}
}
echo "</ul>";
echo "</div>";
 }
}	
function approve(){
if(!@fopen('records.txt','r')){
echo "no records found";
}else{
echo "<div id=''>";
echo "<h3  id=''>FAMILY SACCO PENDING CONTRIBUTIONS</H3>";
echo "<ul id='verif'>";
$lines= file('records.txt');
foreach($lines as $data){
if((strncmp($data,"contribution",12)==0)){
$details=explode(" ",$data);
$name=$details[3]." ".$details[4];

echo "<li>$details[1] $details[2] $name </li>";

}
}
echo "</ul>";
echo "</div>";
}
}
		
function homepage(){
	echo"<!DOCTYPE html>";
	echo"<html>";
		echo"<head>";
		
			
			echo"<meta charset='UTF-8'>";
			echo"<style type='text/css'>";

				echo"body{";
					echo "background-color:#e6ffe6;";
					echo "margin:0%;";
					echo "margin-top:15pt;";
					echo "width:65em;";
					
					echo "border: 0em solid #4da6ff;";
					echo "border-radius: 0px;";
					echo "border-top: 3em solid #e6ffe6;";
				echo"}";
				echo"table{";
					echo"background-color:whitesmoke;";
					echo"border: 0;";
					echo"margin-left:10%;";
					echo"margin-right:10%;";
				echo"}";
				echo"td{";
					echo"font-size: 1.5em;";
				echo"}";
				
			echo	"table tr td{";
				echo	"cell-padding:2em;";
					echo "cell-spacing:4em;";
					echo"border-collapse:separate;";
					echo"text-align:left;";
					echo"font-weight:bold;";
				echo"}";
				echo"#hd{";
					echo "margin-top:-45pt;";
					echo "margin-right:-225pt;";
					echo "margin-left:5pt;";
					echo "margin-bottom:5pt;";
					echo "padding-bottom:22pt;";
					echo "padding-top:25pt;";
					echo "border:0.5px solid #4da6ff;";
					 echo "text-align:center;";
					 echo "color:black;";
					 echo "background-color:#4da6ff;";
					echo "height:20%;";
				echo"}";
				echo "div .hs{";
						echo"background-color:#ffe6cc;";
					echo"margin-left:80pt;";
					echo"margin-top:-5pt;";
					echo"padding:20pt;";
					echo"margin-right:-130pt;";
					echo"padding-bottom:50pt;";
					echo"padding-top:20pt;";
						echo "}";
			echo"</style>";

		echo"</head>";
	
	
	
	
	echo"<body>";
			
			echo"<header id='hd'>";
				echo"<h1 align='center'><strong>FAMILY SACCO</strong></h1>";
			echo"</header>";
			echo"<div>";
			echo"<fieldset class='hs'>";	
		echo"<p>";
				
				echo"<a href='call.php?action=addinginvest' style='text-decoration:none;'>
					<input type='button' value='INVESTMENT DETAILS' style='width:18%; margin-left:32%; background-color:;'></a>";
				echo"<a href='call.php?action=addingmember' style='text-decoration:none;'>
					<input type='button' value='ADD MEMBERS' style='width:15%; background-color:;'></a>";
	
 function openingfile(){
			@$kat = fopen("records.txt", "r") or die("Unable to open file!");
			echo fread($kat,filesize("records.txt"));
			fclose($kat);
		}
		
		@$help=file_get_contents('records.txt');
		@$Gobalarray= explode("\n", $help);
		
		
		@unlink("records.txt");
		
		
		if($Gobalarray != " "){
			foreach($Gobalarray as $element){
				
				@$smallarray= explode(" ", $element);
				
				if($smallarray[0]== "contribution"){
				
				    $begin=$smallarray[0];
					$amount=$smallarray[1];
					$date=$smallarray[2];
					$memberid=$smallarray[3];
					$receiptno=$smallarray[4];
					
					
				
					
					echo "<form action='call.php?action=getrecords' method='POST'>";
						echo "\n\n<input type='text' name = 'begin' value='$begin'>";
						echo "<input type='text'  name = 'amount' value='$amount'>";
						echo "<input type='text'  name = 'date' value='$date'>";
						echo "<input type='text'  name = 'memberid' value='$memberid'>";
						echo "<input type='text'  name = 'receiptno' value='$receiptno'>\n";
						echo "<input type='submit' value='Accepted' name = 'submit'>\n";
						echo "<input type='submit'  value='Rejected' name = 'submit'>";
					echo "</form>";
					
					
				}
				
				if($smallarray[0]== "loan_request"){
					$amt1=$smallarray[1];
					@$member=$smallarray[2];
					
					$begin=$smallarray[0];
				
				
				
					echo "<form action='call.php?action=getrecords' method='POST'>";
						echo "\n\n<input type='text' name = 'begin' value='$begin'>";
						echo "<input type='text'  name = 'amt' value='$amt1'>";
						echo "<input type='text'  name = 'membid' value='$member'>";
						
						echo "<input type='submit' value='Accepted' name ='submit'>\n";
						echo "<input type='submit'  value='Rejected' name = 'submit'>";
					echo "</form>";
					
				}
				
				if($smallarray[0]== "idea"){
					$begin=$smallarray[0];
					$idea=$smallarray[1];
					$capital=$smallarray[2];
					@$business=$smallarray[3];
					@$member1=$smallarray[4];
					
				
				
					
					echo "<form action='call.php?action=getrecords' method='POST'>";
						echo "\n\n<input type='text' name = 'begin' value='$begin'>";
						echo "<input type='text'  name = 'idea' value='$idea'>";
						echo "<input type='text'  name = 'capital' value='$capital'>";
						echo "<input type='textarea'  name = 'business idea' value='$business'>";
						
						echo "<input type='text' name = 'memberid1' value='$member1'>\n";
						echo "<input type='submit' value='Accepted' name = 'submit'>\n";
						echo "<input type='reset'  value='Rejected' name = 'submit'>";
					echo "</form>";
				
				}
			}	
			
		}
			echo"</p>";
			echo"<form action='call.php?action=reports' method='POST'>";
				
					echo"<p>";
						echo"</br><label style='margin-left:440px; width:200px '> SELECT A REPORT</br></br>"; 
						echo"<select name='type' style='width:200px;margin-left:420px'>";
						echo"	<option value='contribution'  > CONTRIBUTION REPORT</option>";
								echo"<option value='idea' >IDEA REPORT</option>";
								echo"<option value='regular' > REGULAR MEMBERS</option>";
								echo"<option value='benefits' >BENEFITS REPORT</option>";
								echo"<option value='loan' >LOAN REPORT</option>";
								echo"<option value='loanrequest' >PENDING LOAN REQUESTS</option>";
								echo"<option value='pendingcontri' >PENDING CONTRIBUTIONS</option>";
								echo"<option value='payback' >LOAN REPAYMENT REPORT</option>";
							echo"</select>";
					echo"</label>";
					echo"</p>";
					
					echo"<p align = 'center' >";
					echo"<input type='submit' value='Submit' style='width:15%; background-color:;'>";
					echo"</p>";
				echo"</form>";
				echo"</fieldset>";
				echo"</div>";
	echo"</body>";
	echo"</html>";	
	
		
	
}
if(@$_POST['type']=="loanrequest"){
approveloan();
}
if(@$_POST['type']=="pendingcontri"){
approve();
}
	function addingmember(){
		
		echo "<!DOCTYPE html>";
		echo "<html>";
			echo "<head>";
		
			
				echo "<meta charset='UTF-8'>";
				echo "<style type='text/css'>";

						echo "body{";
							echo "background-color:#e6ffe6;";
					echo "margin:0%;";
					echo "margin-top:20pt;";
					echo "width:65em;";
					
					echo "border: 0em solid #4da6ff;";
					echo "border-radius: 0px;";
					echo "border-top: 3em solid #e6ffe6;";
						echo "}";
						echo "table{";
							echo "background-color:#ffe6cc;";
							echo "border: 0;";
							echo "margin-left:10%;";
							echo "margin-right:10%;";
						echo "}";
						echo "td{";
						echo "	font-size: 1.5em;";
						echo "}";
						
						echo "table tr td{";
							echo "cell-padding:2em;";
							echo "cell-spacing:4em;";
							echo "border-collapse:separate;";
							echo "text-align:left;";
							echo "font-weight:bold;";
						echo "}";
						echo "#ad{";
							/*echo " border:3px solid blue;";*/
							
							echo "margin-top:-50pt;";
					echo "margin-right:-225pt;";
					echo "margin-left:5pt;";
					echo "margin-bottom:5pt;";
					echo "padding-bottom:22pt;";
					echo "padding-top:25pt;";
					echo "border:0.5px solid #4da6ff;";
					 echo "text-align:center;";
					 echo "color:black;";
					 echo "background-color:#4da6ff;";
					echo "height:20%;";
						echo "}";
						echo "#as{";
						echo "margin-top:-38pt";
						echo "}";
						echo".logout{";
						echo"margin-left:900pt;";
					    echo"}";
				echo "</style>";

			echo "</head>";
			
			echo "<body>";
	           echo "<header id='ad'>";
				echo "<h2 align='center'><strong>ADD NEW MEMBERS</strong></h2>";
				echo "</header>";
				echo "<div id='as'>";
				

					echo "<form action='call.php?action=submittingmember' method='POST'>";
                         echo "<p class='logout'><a href='call.php?action=homepage'>back</a></p>";
						echo "<table border='0'  cellspacing='50' align='CENTER'>";
				 echo "<td>Member id</td><td><input type='text'  id='first' name = 'memberid' required></td>";
                         echo "</tr>";
						 echo "<td>First Name</td><td><input type='text'  id='first' name = 'firstname' required></td>";
                         echo "</tr>";
                           echo "<td>Last Name</td><td><input type='text'  id='first' name = 'lastname' required></td>";
                         echo "<tr>";
                        echo "<td> Username</td><td><input type='text' id='first' name = 'username' required></td>";
                         echo "</tr>";
                         echo "<tr>";
                          echo "<td>Password</td><td><input type='text'id='first' name = 'password' required></td>";
                         echo "</tr>";
					
						echo "</table>";

						echo "<p align = 'center' >";
						echo "<input type='submit' value='Submit' style='width:15%; background-color:lightblue;'>";
						echo "</p>";
					echo "</form>";
					echo "</div";
			echo "</body>";
		echo "</html>";
	
	}
	
	function addinginvest(){
	
		echo "<!DOCTYPE html>";
		echo "<html>";
			echo "<head>";
		
			
				echo "<meta charset='UTF-8'>";
				echo "<style type='text/css'>";

						echo "body{";
							echo "background-color:#e6ffe6;";
					echo "margin:0%;";
					echo "margin-top:20pt;";
					echo "width:65em;";
					
					echo "border: 0em solid #4da6ff;";
					echo "border-radius: 0px;";
					echo "border-top: 3em solid #e6ffe6;";
						echo "}";
						echo "table{";
							echo "background-color:#ffe6cc;";
							echo "border: 0;";
							echo "margin-left:10%;";
							echo "margin-right:10%;";
						echo "}";
						echo "td{";
						echo "	font-size: 1.5em;";
						echo "}";
						
						echo "table tr td{";
							echo "cell-padding:2em;";
							echo "cell-spacing:4em;";
							echo "border-collapse:separate;";
							echo "text-align:left;";
							echo "font-weight:bold;";
						echo "}";
						echo "#di{";
							/*echo " border:3px solid blue;";*/
							
							echo "margin-top:-50pt;";
					echo "margin-right:-225pt;";
					echo "margin-left:5pt;";
					echo "margin-bottom:5pt;";
					echo "padding-bottom:22pt;";
					echo "padding-top:25pt;";
					echo "border:0.5px solid #4da6ff;";
					 echo "text-align:center;";
					 echo "color:black;";
					 echo "background-color:#4da6ff;";
					echo "height:20%;";
						echo "}";
						echo "#si{";
						echo "margin-top:-38pt";
						echo "}";
						echo".log{";
						echo"margin-left:900pt;";
					    echo"}";
				echo "</style>";

			echo "</head>";
			echo "<body>";
				 echo "<header id='di'>";
				echo "<h2 align='center'><strong>ENTER INVESTMENT DETAILS</strong></h2>";
				echo "</header>";
				echo "<div id='si'>";
				
                echo "<p class='log'><a href='call.php?action=homepage'>back</a></p>";
				echo "<form action='call.php?action=investidea' method='POST'>";

					echo "<table border='0'  cellspacing='50' align='CENTER'>";
					echo "<tr><td>Idea id:</td><td><input type='text' placeholder='' name = 'idea id'></td></tr>";
					echo "<tr><td>idea name:</td><td><input type='text' placeholder='' name = 'idea name'></td></tr>";
					echo "<tr><td>Business idea</td><td><input type='textarea' placeholder='' name = 'business'></td></tr>";
					echo "<tr><td>Memberid</td><td><input type='text' placeholder='' name = 'memberid'></td></tr>";
		            
					echo "</table>";

					echo "<p align = 'center' >";
						echo "<input type='submit' value='Submit' style='width:15%; background-color:lightblue;'>";
					echo "</p>";
				echo "</form>";
				echo"</div>";
			echo "</body>";
		echo "</html>";
	
	}
?>
