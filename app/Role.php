<?php

namespace App;

enum Role: string
{
    case ADMIN = 'admin';
    CASE USER = 'uzytkownik';
    CASE LIBRARIAN = 'bibliotekarz';
}
