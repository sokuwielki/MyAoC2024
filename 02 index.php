<?php

$file_path = "input.txt";
$file = fopen($file_path,"r");

$result = 0;

$array = []; 
$array = fgets($file);

function isIncreasing($array): bool
{
    $count = 0;
        for($i = 1; $i < count($array); $i++)
        { //2 4 6 9 10 9
            $diff = $array[$i]-$array[$i-1];
            if ($diff >=1 and $diff <=3)
            {
                $count++;
            }
        }

return ($count >= count($array)-1);
}

function isDecreasing($array): bool
{
    $count = 0;
    for($i = 1; $i < count($array); $i++)
    {
        $diff = $array[$i]-$array[$i-1];
        if ($diff <=-1 and $diff >=-3)
        {
            $count++;
        }
    }
    return ($count >= count($array)-1);
}

while ($array != [])
{
    $array = explode(' ',$array);
    if (isIncreasing($array) or isDecreasing($array))
        {
        $result++;
        }
    else
    {
        $isSafe = false;
        for ($i = 0; $i < count($array); $i++) {
            $tempArray = $array;
            #unset($tempArray[$i]); // Remove one element <- Uncomment and it's the solution for part 2
            $tempArray = array_values($tempArray); // Re-index the array
    
            if (isIncreasing($tempArray) or isDecreasing($tempArray)) {
                $isSafe = true;
                break;
            }
        }
    
        if ($isSafe) {
            $result++;
        }
    }
        
    $array = fgets($file);


    }
echo $result . PHP_EOL;

//part 2 $array[$i+1] - $array[$i-1]; between 337 and 361

fclose($file);