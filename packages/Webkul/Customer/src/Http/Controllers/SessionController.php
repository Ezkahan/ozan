<?php

namespace Webkul\Customer\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $this->validate(request(), [
            'phone' => 'required',
        ]);

        $phone = request('phone');
        $customer = Customer::where('phone', $phone)->first();

        if (!$customer) {
            session()->flash('customer_not_found', trans('shop::app.customer.login-form.customer_not_found'));
            return redirect()->back();
        } else {
            $code = substr(str_shuffle("0123456789"), 0, 5);
            $customer->update(['sms_code' => $code]);
            shell_exec("sms_sender sendsms --phone '993" . request()->input("phone") . "' --message '" . $code . "'");

            return redirect()->intended(route($this->_config['redirect']))->withInput();
        }
    }

    /**
     * SMS code verification.
     */
    public function verifySMS(Request $request)
    {
        $phone = $request->phone;
        $smsCode = $request->sms_code;
        $customer = Customer::where('phone', $phone)->first();

        return $request->all();

        Log::debug($request->all());


        if ($customer->sms_code == $smsCode) {
            auth()->guard('customer')->attempt(['phone' => $phone, 'sms_code' => $smsCode]);
            // auth()->guard('customer')->login($customer);

            Log::debug(auth()->user());
            Log::alert(auth()->guard('customer')->user());

            //Event passed to prepare cart after login
            Event::dispatch('customer.after.login', request('phone'));

            return redirect()->intended(route($this->_config['redirect']));
        } else {
            return redirect()->back()->with('sms_code_error', trans('shop::app.customer.login-form.sms_code_error'));
        }

        // return redirect()->route($this->_config['redirect']);
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
