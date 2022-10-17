<?php
function num($table,$col,$state){
global $conn;
$query="SELECT * FROM $table WHERE $col = '$state'";
$result = $conn->prepare($query);    
$result->execute();    
$count = $result->rowCount();
return $count ; }

function makee($text) {
$regex = 'https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)';
return preg_replace_callback($regex, function ($matches) {
return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";  }, $text);} 

function make_clickable($text) {
$text = preg_replace('/http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/' ,
'<iframe width="690" height="400" src="https://www.youtube.com/embed/$1" allowfullscreen></iframe>', $text);
return $text;}

function username_exists($username){
    global $conn;
    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = $conn->prepare($query);    
    $result->execute();   
    if($result->rowCount() > 0) {
        return true;} else {return false;}}


        function email_exists($email){
            global $conn;
            $query = "SELECT user_email FROM users WHERE user_email = '$email'";
            $result = $conn->prepare($query);    
            $result->execute();   
            if($result->rowCount() > 0) {
                return true;} else {return false;}}
