<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Support\Facades\Event;
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
            'phone' => 'required|numeric|unique:customers,phone',
            'first_name' => 'required',
            'last_name'  => 'required',
            'address' => 'required',
            'password'   => 'confirmed|min:6|required',
        ]);

        $data = [
            'first_name'  => $request->get('first_name'),
            'last_name'   => $request->get('last_name'),
            'email'       => $request->get('email'),
            'password'    => $request->get('password'),
            'password'    => bcrypt($request->get('password')),
            'channel_id'  => core()->getCurrentChannel()->id,
            'phonePasscodeTimeStamp' => "now",
            'is_verified' => 1,
            'customer_group_id' => $this->customerGroupRepository->findOneWhere(['code' => 'general'])->id
        ];
        // su yerde sms ugratmaly

        Event::dispatch('customer.registration.before');

        $customer = $this->customerRepository->create($data);

        Event::dispatch('customer.registration.after', $customer);

        return response()->json([
            'message' => 'Your account has been created successfully.',
        ]);
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
}
