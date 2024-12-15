<?php

/*
ZIEL
1.
Es scheint, als ob das Ziel des Programms nur darin besteht, einige Zahlen zu multiplizieren.
Dies geschieht mit Anweisungen wie mul(X,Y), wobei X und Y jeweils 1-3-stellige Zahlen sind.
Beispielsweise multipliziert mul(44,46) 44 mit 46 und erhält das Ergebnis 2024. Ebenso würde mul(123,4) 123 mit 4 multiplizieren.

Da der Speicher des Programms jedoch beschädigt wurde, gibt es auch viele ungültige Zeichen, die ignoriert werden sollten,
selbst wenn sie wie Teil einer mul-Anweisung aussehen. Sequenzen wie mul(4*, mul(6,9!, ?(12,34) oder mul ( 2 , 4 ) bewirken nichts.

Betrachten Sie beispielsweise den folgenden Abschnitt des beschädigten Speichers:

xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))
Nur die vier hervorgehobenen Abschnitte sind echte Mul-Anweisungen. Die Addition der Ergebnisse jeder Anweisung ergibt 161 (2*4 + 5*5 + 11*8 + 8*5).

Durchsuchen Sie den beschädigten Speicher nach unbeschädigten Mul-Anweisungen. Was erhalten Sie, wenn Sie alle Ergebnisse der Multiplikationen addieren?

2.
Wenn Sie einige der unbeschädigten bedingten Anweisungen im Programm verarbeiten, können Sie möglicherweise ein noch genaueres Ergebnis erzielen.

Es gibt zwei neue Anweisungen, die Sie verarbeiten müssen:

Die Anweisung do() aktiviert zukünftige mul-Anweisungen.
Die Anweisung don't() deaktiviert zukünftige mul-Anweisungen.
Nur die letzte do()- oder don't()-Anweisung gilt. Zu Beginn des Programms sind mul-Anweisungen aktiviert.

Zum Beispiel:

xmul(2,4)&mul[3,7]!^don't()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))
Dieser beschädigte Speicher ähnelt dem vorherigen Beispiel, aber diesmal sind die Anweisungen mul(5,5) und mul(11,8) deaktiviert, da vor ihnen eine don't()-Anweisung steht.
Die anderen mul-Anweisungen funktionieren normal, einschließlich der Anweisung am Ende, die durch eine do()-Anweisung wieder aktiviert wird.

Diesmal beträgt die Summe der Ergebnisse 48 (2*4 + 8*5).

Behandeln Sie die neuen Anweisungen. Was erhalten Sie, wenn Sie alle Ergebnisse nur der aktivierten Multiplikationen addieren?
*/

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
