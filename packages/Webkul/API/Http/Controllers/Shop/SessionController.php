<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\API\Http\Resources\Customer\Customer as CustomerResource;
use Webkul\Customer\Models\Customer;

class SessionController extends Controller
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
    public function create()
    {
        request()->validate([
            'phone'    => 'required|numeric|digits:8',
            'password' => 'required',
        ]);

        $jwtToken = null;

        if (! $jwtToken = auth()->guard($this->guard)->attempt(request()->only('phone', 'password'))) {
            return response()->json([
                'error' => 'Invalid Phone or Password',
            ], 401);
        }

        if (auth()->guard( $this->guard)->user()->status == 0) {
            auth()->guard( $this->guard)->logout();

            return response()->json([
                'error' => trans('shop::app.customer.login-form.not-activated'),
            ], 401);
        }

        if (auth()->guard( $this->guard)->user()->is_verified == 0) {


            auth()->guard( $this->guard)->logout();

            return response()->json([
                'error' => trans('shop::app.customer.login-form.verify-first'),
            ], 401);
        }
        Event::dispatch('customer.after.login', request('phone'));

        $customer = auth($this->guard)->user();

        return response()->json([
            'token'   => $jwtToken,
            'message' => 'Logged in successfully.',
            'data'    => new CustomerResource($customer),
        ]);
    }



    /**
     * Get details for current logged in customer
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $customer = auth($this->guard)->user();

        return response()->json([
            'data' => new CustomerResource($customer),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $customer = auth($this->guard)->user();

        $this->validate(request(), [
            'first_name'    => 'required',
            'last_name'     => 'required',
//            'gender'        => 'required',
            'date_of_birth' => 'nullable|date|before:today',
//            'email'         => 'email|unique:customers,email,' . $customer->id,
            'password'      => 'confirmed|min:6',
            'phone' => 'numeric|digits:8|unique:customers,phone,' . $customer->id
        ]);

        $data = request()->only('first_name', 'last_name', 'gender', 'date_of_birth', 'email', 'password','phone');

        if (! isset($data['password']) || ! $data['password']) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $updatedCustomer = $this->customerRepository->update($data, $customer->id);

        return response()->json([
            'message' => trans('shop::app.customer.account.profile.edit-success'),
            'data'    => new CustomerResource($updatedCustomer),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('account_delete')) {
            Customer::whereId(auth()->guard($this->guard)->user()->id)->first()->delete();
            return response()->json([
                    'message' => 'Account deleted',
            ]);
        }

        auth()->guard($this->guard)->logout();

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }
}
