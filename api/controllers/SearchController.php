<?php


namespace controllers;
require_once '/home/xkopalr1/public_html/zadanie6/api/models/NamedaysModel.php';



class SearchController
{
    private  function parseNumericalDateIntoDate($num)
    {
        $months = ["Január","Február","Marec","Apríl","Máj", "Jún", "Júl", "August", "September", "Október", "November","December" ];

        $strNum = $num;
        if (strlen($strNum) == 3){
            $month = $strNum[0];
        } else {
            $month = substr($strNum,0,2);
        }
        $day = substr($strNum,2);

        $prettyDate = $day . ". " . $months[intval($month)-1];
        return $prettyDate;
    }


    /*
     * na základe zadaného dátumu získať informáciu,
     * kto má v daný deň meniny na Slovensku, resp. v niektorom inom uvedenom štáte;
     *
     * Expected date as MMDD
     */
    public function searchByDate($date){
        if (strlen($date) != 3 && strlen($date) != 4 && !is_numeric($date))
            return "400";
        $model = new \NamedaysModel();
        $namedays = [];
        $namedays['namedays'] = $model->getNamesForDay($date);

        return json_encode($namedays, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    /*
     * na základe uvedeného mena a štátu získať informáciu,
     * kedy má osoba s týmto menom meniny v danom štáte;
     */
    public function searchByNameAndState($name, $state){
        $model = new \NamedaysModel();
        $name = urldecode($name);
        $nameday = $model->getNamedaysByNameAndState($name, $state);
        if (empty($nameday))
            return 404;

        $nameday = $nameday[0];

        $nameday['meniny'] = $this->parseNumericalDateIntoDate($nameday['day_numeric']);
        unset($nameday['day_numeric']);

        return json_encode($nameday, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    /*
     * získať zoznam všetkých sviatkov na Slovensku (element <SKsviatky> resp <CZsviatky>) spolu s dňom,
     *  na ktorý tieto sviatky pripadajú;
     */
    public function holidaysByState($state)
    {
        $state = strtoupper($state);
        if (strcmp($state,"SK") != 0 && strcmp($state,"CZ") != 0)
            return 404;

        $model = new \NamedaysModel();
        $holidays = $model->getHolidaysByState($state);
        foreach ($holidays as &$record){
            $record['day'] = $this->parseNumericalDateIntoDate($record['day_numeric']);
            unset($record['day_numeric']);
        }

        $namedays['holidays'] = $holidays;


        return json_encode($namedays, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    /*
     * získať zoznam všetkých pamätných dní na Slovensku (element <SKdni>)
     *  spolu s dňom, na ktorý tieto dni pripadajú;
     */
    public function findSlovakMemorialDays()
    {
        $model = new \NamedaysModel();
        $namedays = [];
        $namedays['memorial_days'] = $model->getMemorialDays();
        return json_encode($namedays, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    
    /*
     * vložiť nové meno do kalendára (element <SKd>) k určitému dňu.
     */
    public function insertNameForDay()
    {
        $ins = input()->all([
            'add_name',
            'add_date'
        ]);
        $model = new \NamedaysModel();
        return $model->addSlovakNameday($ins['add_name'], $ins['add_date']);
    }
}