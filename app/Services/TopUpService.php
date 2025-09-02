<?php


namespace App\Services;


use App\Events\TopUpApproved;
use App\Http\Controllers\PushNotificationController;
use App\Models\Company;
use App\Models\Customer;
use App\Models\TopUpRequest;
use App\Notifications\SendNotification;
use App\Notifications\StoreNotification;
use http\Env\Request;
use Illuminate\Support\Facades\Notification;
use function Symfony\Component\Translation\t;

class TopUpService
{
    public function __construct(FileService $fileService=null)
    {
        $this->fileService = $fileService;
    }

    public function submitTopUp($request)
    {
        $imagePath = $this->fileService->upload($request->file('receipt_image'), "topups");
        $topUp = TopUpRequest::create([
            'requester_type' => get_class($request->model),
            'requester_id'   => $request->model->id,

            'invoice_number' => $request->invoice_number,

            'amount'         => $request->amount,
            'receipt_image'  => $imagePath,
            'payment_method_id' => $request->payment_method_id,
            'status'         => 'pending',
        ]);

        return $topUp;
    }


    /** UPDATE STATUS TO APPROVED,
     * INCREMENT USER BALANCE,
     * AND CREATE TRANSACTION,
     * SEND NOTIFICATION
     */
    public function approveTopUp( $request): void
    {
        if ($request->status !== 'approved') {
            $request->update(['status' => 'approved']);
            TopUpApproved::dispatch($request);

            $title = 'تم شحن رصيدك بنجاح 💳';
            $body = 'تم شحن رصيدك في تطبيقنا، يمكنك الآن الاستفادة من خدماتنا.' ;

            if ($request->requester_type == "App\Models\Customer" ) {
                // ✅ إرسال إشعار للزبون
                $customer = Customer::find($request->requester_id);
                $user = $customer->user;
                $push = new PushNotificationController();
                $push->sendPushNotification(
                    $title,
                    $body,
                    $user->device_token
                );
                //store notification on database
                Notification::send($user, new StoreNotification($request->id, $title, $body, "TopUp"));
            }
            else{
                $company = Company::find($request->requester_id);
                $user = $company->user;
                //Send Accept Notification to Company
                $user->notify(new SendNotification($request->id, $title, $body, "TopUp"));
            }



        }
    }

    /** UPDATE STATUS TO REJECTED,
     * SEND NOTIFICATION
     */
    public function rejectTopUp( $record)
    {
        $record->update(['status' => 'rejected']);

        $title = 'طلب الشحن مرفوض ❌';
        $body = 'معلومات الدفع غير صحيحة، لم يتم شحن رصيدك في التطبيق. يرجى المحاولة مرة أخرى.';

        if ($record->requester_type == "App\Models\Customer" ) {
            $customer = Customer::find($record->requester_id);
            $user = $customer->user;
            $push = new PushNotificationController();
            $push->sendPushNotification(
                $title,
                $body,
                $user->device_token
            );
            //store notification on database
            Notification::send($user, new StoreNotification($record->id, $title, $body, "TopUp"));
        }
        else{
            $company = Company::find($record->requester_id);
            $user = $company->user;
            //Send Accept Notification to Company
            $user->notify(new SendNotification($record->id, $title, $body, "TopUp"));

        }

    }

}
