<?php

/* source: https://adventofcode.com/2024/day/1
ZIEL
1.
Ermitteln Sie innerhalb jedes Paares, wie weit die beiden Zahlen auseinander liegen.
Sie müssen alle diese Abstände addieren.
Wenn Sie beispielsweise eine 3 aus der linken Liste mit einer 7 aus der rechten Liste paaren, beträgt der Abstand 4;
wenn Sie eine 9 mit einer 3 paaren, beträgt der Abstand 6.
2.
Dieses Mal müssen Sie genau herausfinden, wie oft jede Zahl aus der linken Liste in der rechten Liste vorkommt.
Berechnen Sie einen Gesamtähnlichkeitswert,
indem Sie alle Zahlen in der linken Liste addieren und mit der Häufigkeit multiplizieren, mit der diese Zahl in der rechten Liste vorkommt.
So ermitteln Sie den Ähnlichkeitswert für diese Beispiellisten:

Die erste Zahl in der linken Liste ist 3. Sie erscheint dreimal in der rechten Liste, daher erhöht sich der Ähnlichkeitswert um 3 * 3 = 9.
Die zweite Zahl in der linken Liste ist 4. Sie erscheint einmal in der rechten Liste, daher erhöht sich der Ähnlichkeitswert um 4 * 1 = 4.
Die dritte Zahl in der linken Liste ist 2. Sie erscheint nicht in der rechten Liste, daher erhöht sich der Ähnlichkeitswert nicht (2 * 0 = 0).
*/

$input = "your input";
//Beispiel:
/*
3   4
4   3
2   5
1   3
3   9
3   3
*/

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
