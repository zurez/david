<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends \BaseController {
 	private $_api_context;

    public function __construct()
    {
        
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function index($id)
    {
    	
	return View::make('commercial.getemail',compact('id'));

    }
    public function redirect($id)
    {
    	
    	$rules = array('email' => 'required|email');
    	$validator = Validator::make(Input::all(), $rules);
    	if ($validator->fails()) {

        // get the error messages from the validator
        $messages = $validator->messages();

        // redirect our user back to the form with the errors from the validator
        return Redirect::back()
            ->withErrors($validator);

    			}
    	else{
    	return $this->postPayment($id,Input::get('email'));
    	}
    }
    
    public function postPayment($id,$email)
{

    Session::put('id',$id);
    Session::put('email',$email);
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');
    $description = "David";
    $price =Products::find($id)->price;
    $item_1 = new Item();
    $item_1->setName('Script') // item name
        ->setCurrency('CAD')
        ->setQuantity(1)
        ->setPrice(strval($price)); // unit price

  
    
    // add item to list
    $item_list = new ItemList();
    $item_list->setItems(array($item_1));

    $amount = new Amount();
    $amount->setCurrency('CAD')
        ->setTotal($price);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setItemList($item_list)
        ->setDescription($description);

    $redirect_urls = new RedirectUrls();
    $redirect_urls->setReturnUrl(URL::route('payment.status'))
        ->setCancelUrl(URL::route('payment.status'));

    $payment = new Payment();
    $payment->setIntent('Sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirect_urls)
        ->setTransactions(array($transaction));

    try {
        $payment->create($this->_api_context);
    } catch (\PayPal\Exception\PPConnectionException $ex) {
        if (\Config::get('app.debug')) {
            echo "Exception: " . $ex->getMessage() . PHP_EOL;
            $err_data = json_decode($ex->getData(), true);
            exit;
        } else {
            die('Some error occur, sorry for inconvenient');
        }
    }

    foreach($payment->getLinks() as $link) {
        if($link->getRel() == 'approval_url') {
            $redirect_url = $link->getHref();
            break;
        }
    }

    // add payment ID to session
    Session::put('paypal_payment_id', $payment->getId());

    if(isset($redirect_url)) {
        // redirect to paypal
        return Redirect::away($redirect_url);
    }

    return Redirect::route('original.route')
        ->with('error', 'Unknown error occurred');
    }//EndsHere
   

public function getPaymentStatus()
{
    // Get the payment ID before session clear
    $payment_id = Session::get('paypal_payment_id');

    // clear the session payment ID
    Session::forget('paypal_payment_id');

    if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
        return Redirect::route('console')
            ->with('error', 'Payment failed');
    }

    $payment = Payment::get($payment_id, $this->_api_context);

    // PaymentExecution object includes information necessary 
    // to execute a PayPal account payment. 
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = new PaymentExecution();
    $execution->setPayerId(Input::get('PayerID'));

    //Execute the payment
    $result = $payment->execute($execution, $this->_api_context);

    // echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
    // $itemarray= $result->items;
    // echo $itemarray;
    // exit;

    if ($result->getState() == 'approved') { // payment made
        //logic
        $newcustomer = new Customer;
        $length=60;
        $string= str_random(4);
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    	$rest = substr( str_shuffle( $chars ), 0,8);
    	$username= str_random(7);
    	$password= $string."als".$rest;
    	$email=Session::get('email');
    	Session::forget('email');
    	$id= Session::get('id');
    	Session::forget('id');
    	$script =Findfile::where('lookupid',$id)->get()->filename;
    	$token = bin2hex(random_bytes($length));

        
    }
    return Redirect::route('original.route')
        ->with('error', 'Payment failed');
}

}
