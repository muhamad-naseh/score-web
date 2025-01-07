<?php

namespace App;

enum FightResult: string
{
    case NA = '-';

    case WIN = 'win';

    case LOSE = 'lose';

    case DRAW = 'draw';

}
