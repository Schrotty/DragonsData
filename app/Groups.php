<?php

namespace App;

abstract class Groups
{
    const ROOT = 0;
    const ADMIN = 1;
    const MEMBER = 2;

    const NAMES = array(
        'Root',
        'Admin',
        'Member'
    );
}