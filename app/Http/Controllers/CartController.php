<?php
// chemin relatif ou se trouve la classe
namespace App\Http\Controllers;

use App\Http\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Netshell\Paypal\Facades\Paypal;

/**
 * Class CartController
 * To handle checkout.
 */
class CartController extends Controller
{
    /**
     * @var Api Paypal
     */
    private $_apiContext;

    /**
     * @var
     */
    private $cart;

    /**
     * Constructor for initialize Paypal.
     */
    public function __construct()
    {
        // Get Cart in Container
        $this->cart = App::make('App\Http\Cart\Cart');

        $this->_apiContext = Paypal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret')
        );

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE',
        )
        );
    }

    /**
     * Payments.
     */
    public function checkout()
    {
        $ids = session('likes', []);

        $total = 0;
        foreach ($ids as $id) {
            $movie = Movies::find($id);
            $total = $total + $movie->price;
        }

        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = PayPal::Amount();
        $amount->setCurrency('EUR');
        $amount->setTotal($total);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Récapitulatif total des '.count($ids).' films commandés');

        $redirectUrls = PayPal::RedirectUrls();
        $redirectUrls->setReturnUrl(route('cart_done'));
        $redirectUrls->setCancelUrl(route('cart_cancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        //response de Paypal
        $response = $payment->create($this->_apiContext);

        $redirectUrl = $response->links[1]->href;

        //redirect to Plateform Paypal
        return Redirect::to($redirectUrl);
    }

    /**
     * Payments Récapitilatif.
     */
    public function recapitulatif()
    {
        return view('Cart/recapitulatif');
    }

    /**
     * Done.
     */
    public function done(Request $request)
    {

        //je recupere les informations de retour de Paypal
        $id = $request->get('paymentId');
//        $token = $request->get('token');
        $payer_id = $request->get('PayerID');
        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();
        //execution du paiment a partir du Payer
        //Requete à Paypal: débit du montant de a transaction au Payer
        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        // Clear the shopping cart,
        $request->session()->pull('likes', []);

        //write log
        Log::info('Un client vient de passer uen commande via Paypal'.$payer_id);

        // Write database

        // Thank the user for the purchase
        return view('Cart/success');
    }

    /**
     * Cancel.
     */
    public function cancel()
    {
    }
}
