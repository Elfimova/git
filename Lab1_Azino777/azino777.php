<?php
$start = microtime(true);
function azino777($f, $a)
{
    $file=fopen($f, 'r') or die("Невозможно открыть файл!");
    $answer=fopen($a, 'r') or die("Невозможно открыть файл!");
    /*
    list($n1) = explode(" ", trim(fgets(STDIN)));
    for ($i = 0; $i < $n1; $i++) {
        list($bet[], $sum[], $who_winner[]) = explode(" ", trim(fgets(STDIN)));
    }


    list($n2) = explode(" ", trim(fgets(STDIN)));
    for ($i = 0; $i < $n2; $i++) {
        list($game[], $percent_l[], $percent_r[], $percent_d[], $winner[]) = explode(" ", trim(fgets(STDIN)));
    }
    */
    $flag = false;
    $ans = fgets($answer);

    $text = fgets($file);
    $inf=explode(" ", $text);
    $n1=$inf[0];
    for ($i = 0; $i < $n1; $i++) {
        $text = fgets($file);
        $inf = explode(" ", $text);
        $bet[] = $inf[0];
        $sum[] = $inf[1];
        $who_winner[] = $inf[2];
    }
    $text = fgets($file);
    $inf=explode(" ", $text);
    $n2 = $inf[0];
    for ($i = 0; $i < $n2; $i++) {
        $text = fgets($file);
        $inf = explode(" ", $text);
        $game[] = $inf[0];
        $percent_l[] = $inf[1];
        $percent_r[] = $inf[2];
        $percent_d[] = $inf[3];
        $winner[] = $inf[4];
    }

    $result = 0.000;


    for ($i = 0; $i < $n1; $i++) {
        for ($j = 0; $j < $n2; $j++) {
            if (trim($bet[$i]) == trim($game[$j])){
                if (trim($who_winner[$i]) == trim($winner[$j])) {
                    if (trim($who_winner[$i]) == 'L') {
                        $result += $sum[$i] * $percent_l[$j] - $sum[$i];
                        break;
                    } elseif (trim($who_winner[$i]) == 'R') {
                        $result += $sum[$i] * $percent_r[$j] - $sum[$i];
                        break;
                    } elseif (trim($who_winner[$i]) == 'D') {
                        $result += $sum[$i] * $percent_d[$j] - $sum[$i];
                        break;
                    }
                } else $result -= $sum[$i];
            }
        }
    }
    print("Решение: ");
    print $result;
    print("\nОтвет: ");
    print $ans;
    if($result == $ans) {
        print("Все сходится!\n");
        $flag = true;
    }
    else {
        print("Упс! У нас проблемы :(\n");
    }
    return $flag;
}


#$res1 = azino777("тесты/A/001.dat", "тесты/A/001.ans");

foreach (glob("тесты/A/*.dat") as $test) {
    $name_test[]=$test;
}
foreach (glob("тесты/A/*.ans") as $answer) {
    $name_answer[]=$answer;
}
for ($i = 0; $i < count($name_test); $i++) {
    print("Тест ");
    print($i+1);
    print(") \n");
    $res1 = azino777($name_test[$i], $name_answer[$i]);
}
echo 'Скрипт был выполнен за ' . (microtime(true) - $start) . ' секунд';