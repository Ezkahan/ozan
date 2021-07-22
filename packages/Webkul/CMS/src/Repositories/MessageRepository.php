<?php


namespace Webkul\CMS\Repositories;


use Illuminate\Support\Facades\Event;
use Webkul\Core\Eloquent\Repository;

class MessageRepository extends Repository
{

    public function model()
    {
        return 'Webkul\CMS\Contracts\Message';
    }

    /**
     * @param  array  $data
     * @return \Webkul\CMS\Contracts\Message
     */
    public function create(array $data)
    {
        Event::dispatch('cms.message.create.before');

        $model = $this->getModel();

        $message = parent::create($data);

        Event::dispatch('cms.message.create.after', $message);

        return $message;
    }
}