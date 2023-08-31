<?php

namespace Webkul\Customer\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Cookie;
use Tymon\JWTAuth\Claims\Custom;
use Webkul\Customer\Models\Customer;

class SessionController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customer')->except(['show', 'create']);

        $this->_config = request('_config');
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        if (auth()->guard('customer')->check()) {
            return redirect()->route('customer.profile.index');
        } else {
            return view($this->_config['view']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->validate(request(), [
        //     // 'phone'    => 'required',
        //     // 'password' => 'required',
        // ]);

        $phone = request('phone');
        $customer = Customer::where('phone', $phone)->first();

        if (!$customer) {
            session()->flash('customer_not_found', trans('shop::app.customer.login-form.customer_not_found'));
            return redirect()->back()->with('customer_not_found', trans('shop::app.customer.login-form.customer_not_found'));
        }

        if ($customer && !request('sms_code')) {
            session()->flash('sms_verification', trans('shop::app.customer.login-form.verification'));
            $code = substr(str_shuffle("0123456789"), 0, 5);
            $customer->update(['sms_code' => $code]);
            shell_exec("sms_sender sendsms --phone '993" . request()->input("phone") . "' --message '" . $code . "'");

            return redirect()->back();
        }

        if ($customer && request('sms_code')) {
            if ($customer->sms_code == request('sms_code')) {
                auth()->guard('customer')->attempt(['phone' => request('phone'), 'sms_code' => request('sms_code')]);
                // auth()->guard('customer')->login($customer);
                //Event passed to prepare cart after login
                Event::dispatch('customer.after.login', request('phone'));

                return redirect()->intended(route($this->_config['redirect']));
            }
        } else {
            return redirect()->back()->with('sms_code_error', trans('shop::app.customer.login-form.sms_code_error'));
        }

        // if (auth()->guard('customer')->user()->status == 0) {
        //     auth()->guard('customer')->logout();

        //     session()->flash('warning', trans('shop::app.customer.login-form.not-activated'));

        //     return redirect()->back();
        // }

        // if (auth()->guard('customer')->user()->is_verified == 0) {
        //     session()->flash('info', trans('shop::app.customer.login-form.verify-first'));

        //     Cookie::queue(Cookie::make('enable-resend', 'true', 1));

        //     Cookie::queue(Cookie::make('email-for-resend', request('email'), 1));

        //     auth()->guard('customer')->logout();

        //     return redirect()->back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->guard('customer')->logout();

        Event::dispatch('customer.after.logout', $id);

        return redirect()->route($this->_config['redirect']);
    }
}
