<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\API\Http\Resources\Customer\Customer as CustomerResource;

class SMSAuthenticationController extends Controller
{
    /**
     * Contains current guard
     *
     * @var string
     */
    protected $guard;

    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * Controller instance
     *
     * @param  \Webkul\Customer\Repositories\CustomerRepository  $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->guard = request()->has('token') ? 'api' : 'customer';

        auth()->setDefaultDriver($this->guard);

        $this->middleware('auth:' . $this->guard, ['only' => ['get', 'update', 'destroy']]);

        $this->_config = request('_config');

        $this->customerRepository = $customerRepository;
    }

    /**
     * Method to store user's sign up form data to DB.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|numeric|digits:8|unique:customers,phone',
            'first_name' => 'required',
            'last_name'  => 'required',
            'password'   => 'confirmed|min:6|required',
        ]);

        $data = [
            'first_name'  => $request->get('first_name'),
            'last_name'   => $request->get('last_name'),
            'email'       => $request->get('email'),
//            'password'    => $request->get('password'),
            'password'    => bcrypt($request->get('password')),
            'channel_id'  => core()->getCurrentChannel()->id,
            'api_token'         => Str::random(80),
            'is_verified' => core()->getConfigData('customer.settings.email.verification') ? 0 : 1,
            'token'       => substr(str_shuffle("0123456789"), 0, 5),
            'customer_group_id' => $this->customerGroupRepository->findOneWhere(['code' => 'general'])->id
        ];
        // su yerde sms ugratmaly

        Event::dispatch('customer.registration.before');
        $customer = $this->customerRepository->create($data);

        try {
            \Webkul\Customer\Jobs\PhoneVerification::dispatchIf(core()->getConfigData('customer.settings.email.verification'), $customer->toArray());
            Event::dispatch('customer.registration.after', $customer);

            return response()->json([
                'message' => trans('shop::app.customer.signup-form.success-verify'),
            ]);
        }
        catch (\Exception $exception){
            report($exception);

            return response()->json([
                'message' => trans('shop::app.customer.signup-form.success-verify-email-unsent'),
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()->guard($this->guard)->logout();

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }

    public function verifyPhone(){
        $api_token = request('api_token');
        $token = request('token');
        if(isset($token) && isset($api_token)){
            $customer = $this->customerRepository->findOneByField('api_token', $api_token);
            if ($customer && $customer->token == $token ) {
                $customer->update(['is_verified' => 1, 'token' => 'NULL']);

                session()->flash('success', trans('velocity::app.customer.signup-form.verified'));
            } else {
                session()->flash('warning', trans('velocity::app.customer.signup-form.verify-failed'));
            }
            return response()->json([
                'message' => 'Verification code sent successfully.',
            ]);
        }
        return response()->json([
            'message' => 'Verification code sent successfully.',
        ],400);
    }

    public function resendVerificationSMS($api_token){
        $customer = $this->customerRepository->findOneByField('api_token', $api_token);
        //todo phone verification settings
        try {
            \Webkul\Customer\Jobs\PhoneVerification::dispatchIf(core()->getConfigData('customer.settings.email.verification'), $customer->toArray());

            return response()->json([
                'message' => 'Verification code sent successfully.',
            ]);
        }
        catch (\Exception $exception){
            report($exception);
            return response()->json([
                'message' => 'Verification code cannot be sent.',
            ],400);
        }
    }
}
