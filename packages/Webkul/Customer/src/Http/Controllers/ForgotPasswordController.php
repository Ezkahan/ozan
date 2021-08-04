<?php

namespace Webkul\Customer\Http\Controllers;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Webkul\Customer\Models\Customer;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_config = request('_config');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view($this->_config['view']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store_old()
    {
        try {
            $this->validate(request(), [
                'phone' => 'required|numeric|digits:8',
            ]);

            $response = $this->broker()->sendResetLink(
                request(['phone'])
            );

            if ($response == Password::RESET_LINK_SENT) {
                session()->flash('success', trans('customer::app.forget_password.reset_link_sent'));

                return back();
            }

            return back()
                ->withInput(request(['email']))
                ->withErrors([
                    'email' => trans('customer::app.forget_password.email_not_exist'),
                ]);
        } catch (\Swift_RfcComplianceException $e) {
            session()->flash('success', trans('customer::app.forget_password.reset_link_sent'));

            return redirect()->back();
        } catch (\Exception $e) {
            report($e);
            session()->flash('error', trans($e->getMessage()));

            return redirect()->back();
        }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('customers');
    }

    public function store(){
        $this->validate(request(), [
            'phone' => 'required|numeric|digits:8',
        ]);

        $customer = Customer::where('phone',request('phone'))->first();

        if($customer){
            $customer->token = substr(str_shuffle("0123456789"), 0, 5);
            \Webkul\Customer\Jobs\PhoneVerification::dispatch($customer->toArray());
            $customer->save();
            return view('shop::customers.signup.reset-password',compact('customer'));
        }
        else{
            return back()
                ->withInput(request(['phone']))
                ->withErrors([
                    'phone' => trans('customer::app.forget_password.email_not_exist'),
                ]);
        }
    }
}