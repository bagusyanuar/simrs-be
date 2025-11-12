<?php

namespace App\Commons\Enums;

enum RoomBedStatus: string
{
    case AVAILABLE = 'available';
    case OCCUPIED = 'occupied';
    case MAINTENANCE = 'maintenance';
}
