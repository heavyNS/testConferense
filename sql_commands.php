<?php

const SQL_INSERT_NEW_ELEMENT = "INSERT INTO `conferense`(`title`, `conf_date_start`, `adress`, `latitude`, `longitude`, `country`) VALUES
(?, ?, ?, ?, ?, ?)";

const SQL_UPDATE_ELEMENT_BY_ID = "UPDATE conferense SET title=:title,
                                                        conf_date_start=:conf_date_start,
                                                        adress=:adress,
                                                        latitude=:latitude,
                                                        longitude=:logitude,
                                                        country=:country
                                                        ";

const SQL_GET_ELEMENT_BY_ID = "SELECT * FROM conferense WHERE id=?";

const SQL_GET_ALL_ELEMENTS = "SELECT * FROM conferense";

const SQL_DELETE_ELEMENT_BY_ID = "DELETE FROM conferense WHERE id=?";

const SQL_GET_ALL_COUNTRIES = "SELECT DISTINCT country FROM `conferense`";


?>