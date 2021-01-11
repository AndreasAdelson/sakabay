<?php

namespace App\Infrastructure\EventListener;

use App\Domain\Model\Company;
use DateTime;
use DateTimeZone;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\DBAL\Event\ConnectionEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CompanyListener
{


    public function __construct()
    {
    }

    public function postConnect(ConnectionEventArgs  $args)
    {

        $tz = new DateTimeZone(date_default_timezone_get());
        $offset = $tz->getOffset(new DateTime('now'));
        $abs = abs($offset);
        $str = sprintf('%s%02d:%02d', $offset < 0 ? '-' : '+', intdiv($abs, 3600), intdiv($abs % 3600, 60));
        $args->getConnection()->exec("SET time_zone = '$str'");
    }
}
