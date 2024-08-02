<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerPackage\Bases;

use Jenssegers\Model\Model;
use ValmarHoldings\DialerLiftUp\Contracts\ValueObject as ValueObjectContract;

abstract class ValueObject extends Model implements ValueObjectContract
{
    //
}
