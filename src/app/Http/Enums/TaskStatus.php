<?php

namespace App\Http\Enums;

enum TaskStatus: string
{
    case New = 'New';

    case Accepted = 'Accepted';

    case InProgress = 'In progress';

    case Testing = 'Testing';

    case Done = 'Done';
}
