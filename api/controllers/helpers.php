<?php



function parseNumericalDateIntoDate($num)
{
    $months = ["Január","Február","Marec","Apríl","Máj", "Jún", "Júl", "August", "September", "Október", "November","December" ];

    $strNum = $num;
    if (strlen($strNum) == 3){
        $month = $strNum[0];
    } else {
        $month = substr($strNum,0,2);
    }
    $day = substr($strNum,2);

    $prettyDate = $day . ". " . $months[intval($month)];
    return $prettyDate;
}