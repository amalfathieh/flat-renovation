<?php
namespace App\Enums;

enum ProjectStatusEnum : string{

case FINISHED = 'finished';

case IN_PROGRESS = 'In progress';

case PREPARING = 'Preparing';

public static function options(): array
    {
        return [
            self::FINISHED->value =>  self::FINISHED->value,
            self::IN_PROGRESS->value =>  self::IN_PROGRESS->value,
            self::PREPARING->value =>  self::PREPARING->value,
        ];
    }
}

