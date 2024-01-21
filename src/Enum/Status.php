<?php

namespace App\Enum;

enum Status: string
{
    case chevalier = 'Chevalier Jedi';
    case maitre = 'Maître Jedi';
    case grand_maitre = 'Grand Maître Jedi';
    case sith = "Sith";


    public static function toArray(): array
    {
        return [
            'chevalier' => self::chevalier,
            'maitre' => self::maitre,
            'grand_maitre' => self::grand_maitre,
            'sith' => self::sith,
        ];
    }
}