<?php

$input = "your input";

// Step 1: Normalize input
$input = preg_replace('/\s+/', ' ', $input); // Replace multiple spaces with a single space
$array = explode(' ', trim($input)); // Split into individual numbers

// Step 2: Separate even and odd indices
$even = [];
$odd  = [];

for ($i = 0; $i < count($array); $i++)
{
if ($i % 2 == 0)
    {$even[] = $array[$i];}

else{$odd[]  = $array[$i];}

}

sort($odd);
sort($even);
$result = 0;

for ($i = 0; $i<count($odd); $i++)
{
    $result += abs($odd[$i] - $even[$i]);
}

//print_r($odd);
//echo "\n";
//print_r($even);
echo $result;

//Part 2
$result2 = 0;

for ($j = 0; $j <count($even); $j++)
{
    $temp = 0;
    for ($x = 0; $x < count($odd); $x++)
    {
        if ($even[$j] == $odd[$x])
        {
            $temp += 1;
        }
    }
    $result2 += $even[$j] * $temp;
}
echo "     ";
echo $result2;
