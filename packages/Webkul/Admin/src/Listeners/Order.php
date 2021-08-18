<?php

namespace Webkul\Admin\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Webkul\Admin\Mail\CancelOrderAdminNotification;
use Webkul\Admin\Mail\CancelOrderNotification;
use Webkul\Admin\Traits\Mails;
use Webkul\Paypal\Payment\SmartButton;

class Order
{
    use Mails;

    public function refundOrder($refund)
    {
        $order = $refund->order;

        if ($order->payment->method === 'paypal_smart_button') {
            /* getting smart button instance */
            $smartButton = new SmartButton;

            /* getting paypal oder id */
            $paypalOrderID = $order->payment->additional['orderID'];

            /* getting capture id by paypal order id */
            $captureID = $smartButton->getCaptureId($paypalOrderID);

            /* now refunding order on the basis of capture id and refund data */
            $smartButton->refundOrder($captureID, [
                'amount' =>
                  [
                    'value' => $refund->grand_total,
                    'currency_code' => $refund->order_currency_code
                  ]
            ]);
        }
    }

    public function sendCancelOrderSMS($order)
    {
        $customerLocale = $this->getLocale($order);
        Log::info('function sendCancelOrderSMS called');
        try {
            /* email to customer */
            $configKey = 'emails.general.notifications.emails.general.notifications.cancel-order';
            if (core()->getConfigData($configKey)) {
                app()->setLocale($customerLocale);

                \Webkul\Admin\Notifications\CancelOrderNotification::dispatch($order);
            }else{
                Log::info('function sendCancelOrderSMS CancelOrderNotification not dispatched');
            }

        } catch (\Exception $e) {
            report($e);
        }
    }

    public function sendAcceptOrderSMS($order)
    {
        $customerLocale = $this->getLocale($order);
        Log::info('function sendAcceptOrderSMS called');
        try {
            /* email to customer */
            $configKey = 'emails.general.notifications.emails.general.notifications.new-order';
            Log::info('');
            if (core()->getConfigData($configKey)) {
                app()->setLocale($customerLocale);

                \Webkul\Admin\Notifications\OrderAcceptedNotification::dispatch($order);
            }
            else{
                Log::info('function sendAcceptOrderSMS OrderAcceptedNotification not dispatched');
            }

        } catch (\Exception $e) {
            report($e);
        }
    }
}
