<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\OrderCommentRequest;
use App\Mails\OrderCommentMail;
use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use AvoRed\Framework\Database\Contracts\OrderCommentModelInterface;
use AvoRed\Framework\Database\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderCommentController extends Controller
{

    /**
     * Order Comment Repository
     * @param OrderCommentRepository $orderCommentRepository
     */
    protected $orderCommentRepository;
    /**
     * Configuration Repository
     * @param ConfigurationRepository $configurationRepository
     */
    protected $configurationRepository;


    /**
     * Order Comment Construct
     * @param OrderCommentRepository $orderCommentRepository
     */
    public function __construct(
        OrderCommentModelInterface $orderCommentRepository,
        ConfigurationModelInterface $configurationRepository
    ) {
        $this->orderCommentRepository = $orderCommentRepository;
        $this->configurationRepository = $configurationRepository;
    }

    /**
     * Store Order Comment into database
     * @param int $orderId //Do not need route binding at this stage.
     * @param OrderCommentRequest $request
     * @return Redirect
     */
    public function store($orderId, OrderCommentRequest $request)
    {
        $data = $request->all();
        $data['order_id'] = $orderId;
        $data['commentable_id'] = Auth::guard('customer')->user()->id;
        $data['commentable_type'] = Customer::class;
        $data['is_private'] = false;
    
        $this->orderCommentRepository->create($data);
        $email = $this->configurationRepository->getValueByCode('order_email_address');
        $url = route('admin.order.show', $orderId);
        Mail::to($email)->send(new OrderCommentMail($url));   

        return redirect()->route('account.order.show', $orderId);
    }

}
