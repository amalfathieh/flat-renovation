<?php


namespace App\Services;


use App\Events\TopUpApproved;
use App\Models\TopUpRequest;
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
            'amount'         => $request->amount,
            'receipt_image'  => $imagePath,
            'payment_method_id' => $request->payment_method_id,
            'status'         => 'pending',
        ]);

        return $topUp;
    }


    /** UPDATE STATUS TO APPROVED,
     * INCREMENT USER BALANCE,
     * AND CREATE TRANSACTION
     */
    public function approveTopUp( $request): void
    {
        if ($request->status !== 'approved') {
            $request->update(['status' => 'approved']);
            TopUpApproved::dispatch($request);
        }
    }

}
