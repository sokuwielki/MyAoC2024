<?php

/*
ZIEL
1.
Bei diesem Suchwort können Wörter horizontal, vertikal, diagonal oder rückwärts geschrieben sein oder sich sogar über andere Wörter erstrecken.
Es ist allerdings etwas ungewöhnlich, da Sie nicht nur eine Instanz von XMAS finden müssen, sondern alle.
Hier sind einige Möglichkeiten, wie XMAS erscheinen kann, wobei irrelevante Zeichen durch . ersetzt wurden:

..X...
.SAMX.
.A..A.
XMAS.S
.X....
Das eigentliche Suchwort ist stattdessen voller Buchstaben. Beispiel:

MMMSXXMASM
MSAMXMSMSA
AMXSXMAAMM
MSAMASMSMX
XMASAMXAMM
XXAMMXXAMA
SMSMSASXSS
SAXAMASAAA
MAMMMXMMMM
MXMXAXMASX
In diesem Suchwort kommt XMAS insgesamt 18 Mal vor; hier ist das gleiche Suchwort noch einmal, wobei Buchstaben, die in keinem XMAS vorkommen, durch . ersetzt wurden:

....XXMAS.
.SAMXMS...
...S..A...
..A.A.MS.X
XMASAMX.MM
X.....XA.A
S.S.S.S.SS
.A.A.A.A.A
..M.M.M.MM
.X.X.XMASX

Wie oft kommt XMAS vor?

2.
Auf der Suche nach den Anweisungen drehen Sie das Wortsuchrätsel um und stellen fest, dass dies eigentlich kein XMAS-Puzzle ist;
es ist ein X-MAS-Puzzle, in dem Sie zwei MAS in Form eines X finden sollen. Eine Möglichkeit, dies zu erreichen, ist wie folgt:

M.S
.A.
M.S
Irrelevante Zeichen wurden im obigen Diagramm erneut durch . ersetzt. Innerhalb des X kann jedes MAS vorwärts oder rückwärts geschrieben werden.

Hier ist das gleiche Beispiel wie zuvor, aber dieses Mal wurden stattdessen alle X-MAS beibehalten:

.M.S......
..A..MSMS.
.M.S.MAA..
..A.ASMSM.
.M.S.M....
..........
S.S.S.S.S.
.A.A.A.A..
M.M.M.M.M.
..........
In diesem Beispiel erscheint ein X-MAS 9 Mal.
Wie oft kommt X-MAS vor?
*/

// Read the content of input.txt
$input = file("input.txt");

#print_r($input);

function find_word_horizontal($string, $word)//DZIAŁA
{
    $temp = 0;
    for ($i = 0; $i < strlen($string); $i++)
    {
        $temp_loop = 0;
        for ($j =0; $j<strlen($word); $j++)
        {
            if ($i+$j<strlen($string) && $string[$i+$j] == $word[$j])
            {
                $temp_loop++;
            }
        }
        if ($temp_loop == strlen($word))
        {
            $temp++;
        }
    }
    return $temp;
}

function find_word_vertical($string, $word, $z)
{
    $temp = 0;
    for ($i = 0; $i < count($string); $i++)
    {
        $temp_loop = 0;
        for ($j =0; $j<strlen($word); $j++)
        {
            if($z+$j<count($string) && $string[$z+$j][$i] == $word[$j] )
            {
                $temp_loop++;
            }
        }
        
        if ($temp_loop == strlen($word))
        {
            $temp++;
        }

        
    }
    return $temp;
}

function find_word_diagonal_l_r($string, $word, $z)
{
    

    $temp = 0;
    for ($i = 0; $i < count($string); $i++)
    {
        $temp_loop = 0;
        for ($j = 0; $j<strlen($word); $j++)
        {
            if(
                $z+$j < count($string) && 
                $i+$j < strlen($string[$z])-1 &&
                $string[$z+$j][$i+$j] == $word[$j])
            {
                $temp_loop++;
            }
        }
        if ($temp_loop == strlen($word))
        {
            $temp++;
        }
    }
    return $temp;
}

function find_word_diagonal_r_l($string, $word, $z)
{
    $temp = 0;
    for ($i = 2; $i < count($string); $i++)
    {
        /*$temp_loop = 0;
        for ($j = 0; $j < count($string); $j++)
        {
            if (
                $i-$j >= 0 &&
                $z+$j < count($string)-1)
                
                {
                    if ($string[$z+$j][$i-$j] == $word[$j])
                    {
                        $temp_loop++;
                    }
                }
        }

        if ($temp_loop == strlen($word))
        {
            $temp++;
        }*/

        if ($string[$z][$i] == $word[0] && $i-3 >= 0 && $z+3 <count($string))
        {
            if ($string[$z+1][$i-1] == $word[1] )
            {
                if ($string[$z+2][$i-2] == $word[2])
                {
                    if ($string[$z+3][$i-3] == $word[3])
                    {
                        $temp++;
                    }
                }
            }
        }
    }
    return $temp;
}

$result =0;

for ($z = 0; $z < count($input); $z++)
{
    $result += find_word_horizontal($input[$z], "XMAS"); //those two do horizontals
    $result += find_word_horizontal($input[$z], "SAMX");
    $result += find_word_diagonal_l_r($input, "XMAS", $z);//both diagonals in those two
    $result += find_word_diagonal_l_r($input, "SAMX", $z);//both diagonals in those two
    $result += find_word_diagonal_r_l($input, "SAMX", $z);
    $result += find_word_diagonal_r_l($input, "XMAS", $z);
    $result += find_word_vertical($input, "XMAS", $z); 
    $result += find_word_vertical($input, "SAMX", $z);
}

echo $result;

//2582 incorrect ¯\_(ツ)_/¯
//1122 too low
//1009 too low
//1004 too low
echo"<br>";

////////Part 2

function find_word_diagonal_X($input, $word_v, $word_h, $z)
{
    $temp = 0;
    for ($i = 0; $i < count($input); $i++)
    {
        $temp_loop_v = 0; //left to right
        for ($j = 0; $j < strlen($word_v); $j++)
        {
            if (
                $i + $j < strlen($input[$z+$j]) &&
                $z + $j < count($input)
                )
                {
                    if ($input[$z+$j][$i+$j] == $word_v[$j])
                    {
                        $temp_loop_v++;
                    }
                }
        }
    
        $temp_loop_h = 0; //right to left
        for ($j = 0; $j < strlen($word_h); $j++)
        {
            if (
                $i+$j < strlen($input[$z + strlen($word_h) - $j - 1]) && 
                ($z + strlen($word_h)-$j-1) >= 0
                #< count($input)-1 && $i+$j > 0
                )
                {
                    if($input[$z+strlen($word_h)-$j-1][$i+$j] == $word_h[$j])
                    {
                        $temp_loop_h++;
                    }
                }
        }

        if ($temp_loop_v == strlen($word_v) && $temp_loop_h == strlen($word_h))
        {$temp++;}

    }
    return $temp;
}

$result = 0;

for ($z = 0; $z < count($input); $z++)
{
    $result += find_word_diagonal_X($input, "MAS", "MAS", $z);
    $result += find_word_diagonal_X($input, "MAS", "SAM", $z);
    $result += find_word_diagonal_X($input, "SAM", "SAM", $z);
    $result += find_word_diagonal_X($input, "SAM", "MAS", $z);
}

echo $result;

//2788 too high
//2769 too high
//1958 wrong
//815 too low

?>
