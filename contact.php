<?php
$array = array("firstname" =>"", "name" =>"", "email" =>"", "phone" =>"", "message" =>"", "firstnameError" =>"", "nameError" =>"", "emailError" =>"", "phoneErrror" =>"", "messageError" =>"", "isSuccess" => false );
$emailTo =  "okrzyzos@outlook.fr";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$array["firstname"] = verifyInput($_POST["firstname"]);
$array["name"] = verifyInput($_POST["name"]);
$array["email"] = verifyInput($_POST["email"]);
$array["phone"] = verifyInput($_POST["phone"]);
$array["message"] = verifyInput($_POST["message"]);
$array["isSuccess"] = true;
$emailText ="";

if(empty($array["firstname"])){
    $array["firstnameError"] =" je veux connaitre ton prenom :";
    $array["isSuccess"] = false;

}
else
$emailText .= "Firstname: {$array["firstname"]}\n";


if(empty($array["name"])){
    $array["nameError"] =" je veux connaitre ton nom :";
    $array["isSuccess"] = false;

}
else
$emailText .= " Name:{$array["name"]}\n";

if(empty($array["message"])){
    $array["messageError"] =" je veux connaitre ton message :";
    $array["isSuccess"] = false;


}
else
$emailText .= " Message: {$array["message"]}\n";

  if(!isemail($array["email"])) {

    $array["emailError"] = "n essaie pas de me rouler";
$array["isSuccess"] = false;

  }
  else
  $emailText .= "Email: {$array["email"]}\n";

  if(!isphone($array["phone"])){

$array["phoneError"] = "que des chiffres et des espaces";
$array["isSuccess"] = false;


  }
  else
$emailText .= "Phone:{$array["phone"]}\n";

  if($array["isSuccess"]){
$headers = "From: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
mail($emailTo, "un message de votre site", $emailText , $headers);

echo json_encode($array);
  }
  
}
 function isemail($var){

return filter_var($var, FILTER_VALIDATE_EMAIL);


 }

 function isphone($var){

    return preg_match("/^[0-9 ]*$/", $var);
 }

function verifyInput($var){

//fonction de securite 
$var = trim($var);
$var = stripslashes($var);
$var = htmlspecialchars($var);
return $var;
}


?>
