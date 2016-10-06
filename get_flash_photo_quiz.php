<?
/*
   getscores.php: Retrieves score data from highscores table and returns 
                  data and status to Flash
   
   errorcode:
      0: successful select
      1: can't connect to server
      2: can't connect to database
      3: can't run query
*/

//  fill this in with the right data for your server/database config

if($_SERVER['HTTP_HOST']=='localhost')
{
	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "wannaquiz";
}
else{
	$server = "localhost";
	$username = "proshore_sun";
	$password = "sunildongol";
	$database = "proshore_wannaquiz";
}

   mysql_connect($server, $username, $password);
   mysql_select_db($database);

  
   $sql="SELECT * from tbl_quizes q,tbl_quiz_options qo,tbl_quiz_images qm where q.quiz_id=qo.quiz_id and q.quiz_id=qm.quiz_id AND q.quiz_id=".$_GET['quiz_id'];;
   $qr = mysql_query($sql);

   
   if (!qr || mysql_num_rows($qr)==0) {
      $r_string = '&errorcode=3&msg='.mysql_error().'&';
   } else {
      $r_string = '&errorcode=0&n='.mysql_num_rows ($qr);
      $i = 0;
      while ($row = mysql_fetch_assoc ($qr)) {
         while (list ($key, $val) = each ($row)) {
            $r_string .= '&' . $key . $i . '=' . stripslashes($val);
         }
         $i++;
      }
      // add extra & to prevent returning extra chars at the end
      $r_string .='&answer=ttt.jpg&';
   }

echo $r_string;
?>
