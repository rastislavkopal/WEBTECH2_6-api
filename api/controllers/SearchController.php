<?php


namespace controllers;


class SearchController
{
    /*
     * na základe zadaného dátumu získať informáciu,
     * kto má v daný deň meniny na Slovensku, resp. v niektorom inom uvedenom štáte;
     */
    public function searchByNameAndState($name, $state){
        echo "helloooo " . $name . " from- " . $state;
    }


    /*
     * na základe uvedeného mena a štátu získať informáciu,
     * kedy má osoba s týmto menom meniny v danom štáte;
     */
    public function searchByDate($date){
        echo $date;
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