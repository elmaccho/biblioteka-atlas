<?php

namespace App;

enum StatusEgzemp: string
{
    case DOSTEPNY = 'dostępny';
    case WYPOZYCZONY = 'wypozyczony';
    case ZAREZERWOWANY = 'zarezerwowany';
    case USZKODZONY = 'uszkodzony';
}
