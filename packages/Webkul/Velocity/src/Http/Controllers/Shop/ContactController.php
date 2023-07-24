<?php


namespace Webkul\Velocity\Http\Controllers\Shop;

class ContactController extends Controller
{

    public function index(){
        return view($this->_config['view']);
    }

    public function sendMessage(){

        $this->validate(request(), [
            'name' => 'string|required|min:2',
            'contact'  => 'required|min:8',
            'subject'    => 'string|required|min:2',
            'message'     => 'string|required|min:2',
            'gapja' => 'required|in:antispam, anti spam'
        ]);

        $result = $this->messageRepository->create(request()->all());

        $message = trans($result ? 'velocity::app.contactus.success_message': 'velocity::app.contactus.error_message') ;

        return view($this->_config['view'],compact('message'));
    }
}