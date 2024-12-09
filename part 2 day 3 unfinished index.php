<?php

$input = file_get_contents("input.txt");

$old_pattern = '/mul\((\d+),(\d+)\)/'; 
$pattern = '/do\(\).*?mul\((\d+),(\d+)\)/'; //exclude do/don't part for part 1 || '/(don\'t\(\)|do\(\)).*?mul\((\d+),(\d+)\)/'; 
$gpt_pattern = "/mul\((\d+),(\d+)\)(?=(?!.*(?:don't\(\))).*)/";

$matches = [];
$old_matches = [];

$result = 0;

$temp_do = strpos($input, "do()");
$temp_dont = strpos($input, "don't()");


if (preg_match_all($old_pattern, $input, $old_matches)) {
    echo "Matches found:\n";
    echo"<pre>";
    print_r($old_matches);
    echo "</pre>";
}

for ($i = 0; $i <count($old_matches[0]); $i++)
{
    $result += ((int)$old_matches[1][$i] * (int)$old_matches[2][$i]);
}


///W GÓRE DZIAŁA


echo $result;


/*

if ( preg_match_all( $gpt_pattern, $new_input, $matches ) )
{
    echo "Matches found:\n";
    print_r($matches);
}

for ($i = 0; $i < count($matches[0]); $i++)
{
    $result += $matches[1][$i] * $matches[2][$i];
}


echo"<br>";
echo $result;
echo"<br>";

$offset = 0;
$indexes = [];
$indexes_donot = [];

for ($i = 0; $i < count($matches[0]); $i++)
{
        $indexes_donot = [-1];
        $indexes = [-1];
    
        $offset = 0;
        while (($pos_not = strpos($matches[0][$i], "don't()", $offset)) !== false) {
            $indexes_donot[] = $pos_not;
            $offset = $pos_not + 1;
        }

        $offset = 0;
        while (($pos = strpos($matches[0][$i], "do()", $offset)) !== false) {
            $indexes[] = $pos;
            $offset = $pos + 1;
        }

        if ((max($indexes_donot) >= max($indexes)) )
        {$matches[1][$i] = "don't";}
        else
        {$matches[1][$i] = "do";}
}

for ($i = 0; $i < count($matches[0]); $i++)
{
    echo "<br>" . $matches[1][$i];
    if ($matches[1][$i] == "do")
    {$result += ((int)$matches[2][$i] * (int)$matches[3][$i]);}
}
echo $result;
*/
//upper limit
//170807108
//75055276
//74838033
//51398302
//31419096
//20572642
//18520626
//12165678
//10171996 too low
//17918773
//12165678
//1993682