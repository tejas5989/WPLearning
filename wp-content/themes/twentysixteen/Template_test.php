<?php
/**
 * Template Name: Template Test
 *
 */
get_header();
remove_filter ('the_content', 'wpautop');
?>

<?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?>

<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
</style>

<form name= "registration" id= "registration" method= "post" action= "" >
<table width= "400" border= "0" align="center" cellpadding= "4" cellspacing= "1">
<tr>
<td>Employee Name:</td>
<td><input name= "emp_name" type= "text" id="emp_name" value="<?php if(isset($emp_name)){echo $emp_name;} ?>"
 <?php if(isset($code) && $code == 1){echo "class=errorMsg" ;} ?> ></td>
</tr>
<tr>
<td>Contact No.: </td>
<td><input name= "emp_number" type= "text" id= "emp_number" value="<?php if(isset($emp_number)){echo $emp_number;} ?>"
<?php if(isset($code) && $code == 2){echo "class=errorMsg" ;}?> ></td>
</tr>
<tr>
<td> Personal Email: </td>
<td><input name= "emp_email" type= "text" id= "emp_email" value="<?php if(isset($emp_email)){echo $emp_email; }?>"
<?php if(isset($code) && $code == 3){echo "class=errorMsg" ;}?> ></td>
</tr>
<tr>
<td> </td>
<td><input type= "submit" name= "Submit" value= "Submit" ></td>
</tr>
<tr><td></td><td><?php echo $test; ?></td></tr>
</table>
</form>

<?php 
if(isset($_POST['Submit'])){

	$test = "";
$emp_name=trim($_POST["emp_name"]);
$emp_number=trim($_POST["emp_number"]);
$emp_email=trim($_POST["emp_email"]);

if($emp_name =="") {
  $errorMsg=  "error : You did not enter a name.";
  $code= "1" ;
  $test = 'Test1';
}

elseif($emp_number == "") {
  $errorMsg=  "error : Please enter number.";
  $code= "2";
  $test = 'Test2';
}

//check if the number field is numeric
  elseif(is_numeric(trim($emp_number)) == false){
  $errorMsg=  "error : Please enter numeric value.";
  $code= "2";
  $test = 'Test3';
}

elseif(strlen($emp_number)<10){
  $errorMsg=  "error : Number should be ten digits.";
  $code= "2";
  $test = 'Test4';
}

//check if email field is empty
elseif($emp_email == ""){
  $errorMsg=  "error : You did not enter a email.";
  $code= "3";
  $test = 'Test5';
} //check for valid email 
  elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $emp_email)){
  $errorMsg= 'error : You did not enter a valid email.';
  $code= "3";
  $test = 'Test6';
}

else{
  echo "Success";
  //final code will execute here.
}

}
?>
<?php get_footer(); ?>