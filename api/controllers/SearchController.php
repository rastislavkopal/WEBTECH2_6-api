<?php


namespace controllers;
require_once '/home/xkopalr1/public_html/zadanie6/api/models/NamedaysModel.php';
require_once './helpers.php';


class SearchController
{
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
        $namedays = [];
        $namedays['name_day'] = $model->getNamedaysByNameAndState($name, $state)[0]['day_numeric'];
        return json_encode($namedays, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
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
        $namedays = [];
        $namedays['holidays'] = $model->getHolidaysByState($state);
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
            'name',
            'user_id'
        ]);
        $model = new \NamedaysModel();
        $model->addSlovakNameday($ins['name'], $ins['day']);

    }
}