<?php

$str = 'one,two,three,four';

// zero limit
print_r(explode(',',$str,0));
echo "</br>";

// positive limit
print_r(explode(',',$str,2));
echo "</br>";

// negative limit 
print_r(explode(',',$str,4));
echo "<br/>";
$list = explode(',',$str,4);
$first = $list[0];
$second = $list[1];
$third = $list[2];
$fourth = $list[3];
echo "$first -- $second -- $third -- $fourth </br>";

?>