<?php

namespace App\Enum;

enum Status: string
{
    case chevalier = 'Chevalier Jedi';
    case maitre = 'Maître Jedi';
    case grand_maitre = 'Grand Maître Jedi';
}