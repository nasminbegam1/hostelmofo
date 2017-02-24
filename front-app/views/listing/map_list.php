<?php
if(isset($_GET['zoom']) && !empty($_GET['zoom'])){
        $zoom   = (int)trim($_GET['zoom']);
}else{
        $zoom      = 11;
}

echo $zoom;

if(isset($_GET['cp_lat']) && !empty($_GET['cp_lat'])){
        $cp_lat   = trim($_GET['cp_lat']);
}else{
        $cp_lat      = 7.97;
}

echo $cp_lat;

if(isset($_GET['cp_lng']) && !empty($_GET['cp_lng'])){
        $cp_lng   = trim($_GET['cp_lng']);
}else{
        $cp_lat      = 98.3359;
}

echo $cp_lat;

echo "Hello";
?>