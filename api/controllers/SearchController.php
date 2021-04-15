<?php


namespace controllers;
require_once '/home/xkopalr1/public_html/zadanie6/api/models/NamedaysModel.php';


class SearchController
{
    /*
     * na základe uvedeného mena a štátu získať informáciu,
     * kedy má osoba s týmto menom meniny v danom štáte;
     *
     * Expected date as YYYY-MM-DD
     */
    public function searchByDate($date){
        if (strlen($date) != 3 && strlen($date) != 4 && !is_numeric($date))
            return "400";
        $model = new \NamedaysModel();
        $namedays = [];
        $namedays['namedays'] = $model->getNamesForDay($date);
        return json_encode($namedays, JSON_PRETTY_PRINT);
    }


    /*
     * na základe zadaného dátumu získať informáciu,
     * kto má v daný deň meniny na Slovensku, resp. v niektorom inom uvedenom štáte;
     */
    public function searchByNameAndState($name, $state){
        echo "helloooo " . $name . " from- " . $state;
    }


    /*
     * získať zoznam všetkých sviatkov na Slovensku (element <SKsviatky> resp <CZsviatky>) spolu s dňom,
     *  na ktorý tieto sviatky pripadajú;
     */
    public function holidaysByState($state)
    {
        return "holiiiii dayyss";
    }


    /*
     * získať zoznam všetkých pamätných dní na Slovensku (element <SKdni>)
     *  spolu s dňom, na ktorý tieto dni pripadajú;
     */
    public function findSlovakMemorialDays()
    {

    }

    
    /*
     * vložiť nové meno do kalendára (element <SKd>) k určitému dňu.
     */
    public function insertNameForDay()
    {

    }
}