<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 04.09.2017
 * Time: 14:09
 */

namespace App\Notifications;


abstract class Notifications
{
    const READ_ACCESS = array(
        AccessGranted::class,
        AccessLost::class
    );

    const WRITE_ACCESS = array(
        ContributorRightsLost::class,
        ContributorRightsGranted::class
    );
}