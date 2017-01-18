<?php

/**
 * Created by PhpStorm.
 * User: etbeur
 * Date: 17/01/17
 * Time: 11:06
 */

namespace AppBundle\Model;

class Eleve
{
    public $id;
    public $firstname;
    public $lastname;
    public $birthDate;
    public $adress;
    public $phone;
    public $email;
    public $emergencyContact;
    public $github;
    public $likedIn;
    public $personalProject;
    public $photo;

    function __construct(int $id, String $firstname, String $lastname, \dateTime $birthDate,
                        String $adress, String $phone, String $email, g )
    {

    }
}