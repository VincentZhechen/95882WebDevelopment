<?php
/**
 * Created by PhpStorm.
 * User: 于哲晨
 * Date: 2017/4/23
 * Time: 19:19
 */

//$array = explode("\n",file_get_contents('lib/CommonWord.txt') );
//$array = file('lib/CommonWord.txt');
//$total = count($array);
//for($n=0;$n < $total;$n = $n +1) {
//    $array[$n] = trim($array[$n]);
//}
//foreach ($array as  $word) {
//    echo $word;
////    echo '<br>';
//}
//echo $array[0];
//echo strlen($array[0]);
//echo $array[1];
//echo strlen($array[1]);
//
//if (in_array('a', $array, TRUE))
//{
//    echo "Match found";
//}
$common = file('lib/CommonWord.txt');
$total = count($common);
for($n=0;$n < $total;$n = $n +1) {
    $common[$n] = trim($common[$n]);
}
foreach($common as $c) {
    echo $c;
}
echo "<br>";
echo strlen($common[0]);
echo "<br>";
echo strlen($common[1]);

?>