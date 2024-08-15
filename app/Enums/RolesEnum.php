<?php
namespace App\Enums;
enum RolesEnum : string
{
    case ADMIN = "admin";
    case GUEST = "guest";
    case USERMANAGER = "user-manager";

    public function label () : string
    {
        return match ($this)
        {
            static::ADMIN => "Admin",
            static::GUEST => "Guest",
            static::USERMANAGER => "User-Manager"
        };
    }
}