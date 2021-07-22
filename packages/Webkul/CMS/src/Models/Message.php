<?php


namespace Webkul\CMS\Models;


use Illuminate\Database\Eloquent\Model;
use Webkul\CMS\Contracts\Message as MessageContract;

class Message extends Model implements MessageContract
{
    protected $fillable = ['name','contact','subject','message'];
    protected $table = 'messages';
}