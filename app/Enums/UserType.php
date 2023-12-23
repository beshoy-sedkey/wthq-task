<?php declare(strict_types=1);

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

final class UserType extends Enum
{
    const normal = 1;
    const gold = 2;
    const silver = 4;
}
