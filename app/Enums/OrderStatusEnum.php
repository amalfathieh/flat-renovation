<?php


namespace App\Enums;



enum OrderStatusEnum : string{

    case ACCEPTED = 'accepted';

    case WAITING = 'waiting';

    case COMPLETED = 'completed';

    case REJECTED = 'rejected';
}
