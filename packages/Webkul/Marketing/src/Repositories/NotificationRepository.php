<?php

namespace Webkul\Marketing\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\Marketing\Contracts\Notification;

class NotificationRepository  extends Repository
{

    public function model()
    {
        return Notification::class;
    }
}