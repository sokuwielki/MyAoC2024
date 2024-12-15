<?php

/*
ZIEL
1.
Ein Bericht gilt also nur dann als sicher, wenn beide der folgenden Aussagen zutreffen:

Die Pegel steigen entweder alle an oder sinken alle.
Jeder der beiden benachbarten Pegel unterscheidet sich um mindestens eins und höchstens drei.
Im obigen Beispiel können die Berichte durch Überprüfen dieser Regeln als sicher oder unsicher eingestuft werden:

7 6 4 2 1: Sicher, weil die Pegel alle um 1 oder 2 sinken.
1 2 7 8 9: Unsicher, weil 2 7 eine Erhöhung um 5 ist.
9 7 6 2 1: Unsicher, weil 6 2 eine Verringerung um 4 ist.
1 3 2 4 5: Unsicher, weil 1 3 steigt, aber 3 2 sinkt.
8 6 4 4 1: Unsicher, weil 4 4 weder eine Erhöhung noch eine Verringerung ist.
1 3 6 7 9: Sicher, weil die Pegel alle um 1, 2 oder 3 steigen.
In diesem Beispiel sind also 2 Berichte sicher.

Analysieren Sie die ungewöhnlichen Daten der Ingenieure. Wie viele Berichte sind sicher?

2.
Jetzt gelten die gleichen Regeln wie zuvor, außer wenn das Entfernen einer einzelnen Ebene aus einem unsicheren Bericht diesen sicher machen würde, gilt der Bericht stattdessen als sicher.

Weitere Berichte aus dem obigen Beispiel sind jetzt sicher:

7 6 4 2 1: Sicher ohne Entfernen einer Ebene.
1 2 7 8 9: Unsicher, unabhängig davon, welche Ebene entfernt wird.
9 7 6 2 1: Unsicher, unabhängig davon, welche Ebene entfernt wird.
1 3 2 4 5: Sicher durch Entfernen der zweiten Ebene, 3.
8 6 4 4 1: Sicher durch Entfernen der dritten Ebene, 4.
1 3 6 7 9: Sicher ohne Entfernen einer Ebene.
*/

$file_path = "input.txt";
/*
7 6 4 2 1
1 2 7 8 9
9 7 6 2 1
1 3 2 4 5
8 6 4 4 1
1 3 6 7 9
*/
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
