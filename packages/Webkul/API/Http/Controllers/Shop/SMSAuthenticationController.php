<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Customer\Repositories\CustomerGroupRepository;
use Webkul\API\Http\Resources\Customer\Customer as CustomerResource;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    protected $customerGroupRepository;
    /**
     * Controller instance
     *
     * @param  \Webkul\Customer\Repositories\CustomerRepository  $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository, CustomerGroupRepository $customerGroupRepository)
    {
        $this->guard = request()->has('token') ? 'api' : 'customer';

        auth()->setDefaultDriver($this->guard);

        $this->middleware('auth:' . $this->guard, ['only' => ['get', 'update', 'destroy']]);

        $this->_config = request('_config');

        $this->customerRepository = $customerRepository;

        $this->customerGroupRepository = $customerGroupRepository;
    }

    /**
     * Method to store user's sign up form data to DB.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|numeric|digits:8',
            'first_name' => 'required',
            'last_name' => 'required',
            //'password'   => 'confirmed|min:6|required',
        ]);

        $customer = $this->customerRepository->findOneByField('phone', $request->get('phone'));

        if ($customer && $customer->is_verified) {
            return response()->json(
                [
                    'error' => trans('velocity::app.customer.signup-form.already_registered'),
                ],
                400,
            );
        } elseif ($customer && !$customer->is_verified) {
            $this->customerRepository->delete($customer->id);
        }

        $code = substr(str_shuffle('0123456789'), 0, 5);

        $data = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'phone' => $request->get('phone'),
            // 'password' => bcrypt($request->get('password')),
            'channel_id' => core()->getCurrentChannel()->id,
            'api_token' => Str::random(80),
            'is_verified' => 1, //core()->getConfigData('customer.settings.email.verification') ? 0 : 1,
            'sms_code' => $code,
            'customer_group_id' => $this->customerGroupRepository->findOneWhere(['code' => 'general'])->id,
        ];

        shell_exec("sms_sender sendsms --phone '993" . request()->input('phone') . "' --message '" . $code . "'");

        Event::dispatch('customer.registration.before');

        $customer = $this->customerRepository->create($data);

        try {
            Event::dispatch('customer.registration.after', $customer);

            return response()->json([
                'success' => true,
                'message' => trans('velocity::app.customer.signup-form.success'),
            ]);
        } catch (\Exception $exception) {
            report($exception);

            return response()->json(
                [
                    'error' => trans('velocity::app.customer.signup-form.success-verify-email-unsent'),
                ],
                400,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()
            ->guard($this->guard)
            ->logout();

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }

    public function verifyPhone()
    {
        $phone = str_replace(' ', '', request('phone'));
        $smsCode = request('sms_code');
        $customer = $this->customerRepository->findOneByField('phone', $phone);

        if ($customer->sms_code == $smsCode) {
            $jwtToken = JWTAuth::fromUser($customer);

            return response()->json([
                'message' => trans('velocity::app.customer.signup-form.verified'),
                'token' => $jwtToken,
                'data' => new CustomerResource($customer),
            ]);
        } else {
            return response()->json(
                [
                    'error' => trans('velocity::app.customer.signup-form.verify-failed'),
                ],
                400,
            );
        }

        return response()->json(
            [
                'error' => 'Phone and code is required',
            ],
            400,
        );
    }

    public function resendVerificationSMS()
    {
        if (!($phone = request('phone'))) {
            return response()->json(
                [
                    'error' => 'Phone number is required.',
                ],
                400,
            );
        }

        $customer = $this->customerRepository->findOneByField('phone', request('phone'));

        if (!$customer) {
            return response()->json(
                [
                    'error' => 'Customer not found.',
                ],
                400,
            );
        }

        $code = substr(str_shuffle('0123456789'), 0, 5);
        $customer->token = $code;
        $customer->save();

        try {
            shell_exec("sms_sender sendsms --phone '993" . request()->input('phone') . "' --message '" . $code . "'");
            // \Webkul\Customer\Jobs\PhoneVerification::dispatchIf(core()->getConfigData('customer.settings.email.verification'), $customer->toArray());

            return response()->json([
                'message' => 'Verification code sent successfully.',
            ]);
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(
                [
                    'error' => 'Verification code cannot be sent.',
                ],
                400,
            );
        }
    }
}
