<?php

class Conf{
    protected $id;
    protected $title;
    protected $date_start;
    protected $adress;
    protected $latitude;
    protected $longitude;
    protected $country;

    public function get_id(){
        return $this->id;
    }

    public function get_title(){
        return $this->title;
    }

    public function set_title($title){
        $this->title = $title;
    }

    public function get_date_start(){
        return $this->conf_date_start;
    }

    public function set_date_start($conf_date_start){
        $this->conf_date_start = $conf_date_start;
    }   

    public function get_adress(){
        return $this->adress;
    }

    public function set_adress($adress){
        $this->adress = $adress;
    }

    public function get_latitude(){
        return $this->latitude;
    }

    public function set_latitude($latitude){
        $this->latitude = $latitude;
    }

    public function get_longitude(){
        return $this->longitude;
    }

    public function set_longitude($longitude){
        $this->longitude = $longitude;
    }

    public function get_country(){
        return $this->country;
    }

    public function set_country($country){
        $this->country = $country;
    }
}


?>