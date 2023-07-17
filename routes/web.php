<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\socketcontroller;
use App\Http\Controllers\CountryStateController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PDFmaker;
use App\Http\Controllers\ExcelMaker;
use App\Models\Client;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\ExchangeRate;
// use Stripe\Checkout\Session;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by theet RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    
    // Mail::to('bhaveshpr54@gmail.com')->send(new MailableClass);
    $categories=DB::select('select category_name from categories');
    
    
    return view('Home');
    
});

// -----authentication------
Route::get('login',[AuthController::class,'Login'])->name('login')->middleware('authCheck');
Route::post('loginauth',[AuthController::class,'postLogin']);
Route::get('/logout',function()
{
   Session::flush(); 

   return redirect('/');
});

// --------category----------
Route::get('/subcategories/{catid}',[CategoryController::class,'subcat']);

// 
Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard')->middleware('authCheck');
Route::get('/freelancer/{id}',[FreelancerController::class,'fpview']);
Route::get('/addorder',[OrderController::class,'add'])->middleware('authCheck');
Route::get('/subcat/{sid}',[OrderController::class,'subcategories']);
Route::get('/Bids/{fid}',[BidController::class,'showfbid']);
Route::post('/add',[OrderController::class,'Postadd']);
Route::view('register','registration')->middleware('authCheck')->name('register');
Route::post('registrations',[AuthController::class,'postRegister']);
Route::get('/AllOrders',[OrderController::class,'show']);
Route::get('/findFreelancers',[FreelancerController::class,'showfreelancers']);

Route::get('client/{cid}',[ClientController::class,'profileview']);
// ----Direct Hire-----
Route::get('/proposal/{fid}',[ClientController::class,'directHire']);
Route::post('/directHire/{fid}',[ClientController::class,'confirmdh']);
// ------

Route::Post('/makeProposal/{orderId}',[OrderController::class,'makeProposal'])->middleware('authCheck');
Route::get('/viewOrder/{oid}',[OrderController::class,'fulldetailorder']);
// Route::get('/projectsofclient',function()
// {
//     return view('components.show');
// });

//----- Bid-------
Route::get('viewbid/{orderid}',[BidController::class,'showbids'])->middleware('authCheck');
Route::get('acceptbid/{bidid}/{oid}/{fid}/{bidprice}',[BidController::class,'accept'])->middleware('authCheck');
Route::get('rejectbid/{bidid}',[BidController::class,'reject'])->middleware('authCheck');
// Route::get('rejectallbid/{orderid}',[BidController::class,'rejectall'])->middleware('authCheck');

// -----Project Post-----
Route::post('uploadProject/{oid}',[DeliveryController::class,'deliverysend']);
Route::get('/delivery_view',[DeliveryController::class,'deliveryview']);
Route::get('download/{file}',[DeliveryController::class,'download']);

Route::get('/download/orderinfo/{file}',[OrderController::class,'download']);

Route::get('acceptdelivery/{did}',[DeliveryController::class,'Accept']);
Route::get('rejectdelivery/{did}',[DeliveryController::class,'Reject']);

// ------client dashboard------
Route::post('updateOrder/{orderid}',[OrderController::class,'changeorderdata'])->middleware('authCheck');
Route::get('/projectsofclient',[ClientController::class,'showprojects']);

// -----Freelancer-----
Route::get('/fprojects/{fid}',[FreelancerController::class,'fprojects'])->middleware('authCheck');
Route::get('/editfreelancer/{fid}',[FreelancerController::class,'editprofile'])->middleware('authCheck');
Route::post('/updatefreelancer/{fid}',[FreelancerController::class,'updateprofile']);
Route::get('/clientRequests/{fid}',[FreelancerController::class,'clientrequest']);
Route::get('/Acceptrequest/{oid}',[FreelancerController::class,'acceptrequest']);
Route::get('/Rejectrequest/{oid}',[FreelancerController::class,'rejectrequest']);

// ------Admin-----
Route::get('/loginAdmin', function()
{
    return view('Admin.login');
});
Route::post('/adminLogin',[AdminController::class,'login']);
// ----projects-----
Route::get('/projects',[AdminController::class,'Projects']);
// ---freelancer anagement by admin------
Route::get('/freelancerA',[AdminController::class,'show']);
Route::get('/clientA',[AdminController::class,'show']);
Route::get('/feedbackA',[AdminController::class,'show']);

Route::get('/categoryA',[AdminController::class,'show']);
Route::get('/subcateA/{cid}',[AdminController::class,'subcateA']);

Route::get('/delete/{id}',[AdminController::class,'deletef']);
Route::get('/cdelete/{id}',[AdminController::class,'deletec']);
Route::post('/updatef/{fid}',[AdminController::class,'updatef']);
Route::post('/update/{id}',[AdminController::class,'updatec']);
Route::post('/subcatUpdate/{subcatid}',[CategoryController::class,'subcatupdate']);
Route::post('/addcat/{categoryid}/',[CategoryController::class,'addcat']);

// ----feedback------
Route::post('/feedback/{fid}/{cid}',[FreelancerController::class,'feedback']);
Route::post('/editfeedback/{feid}',[FreelancerController::class,'editfeedback']);


Route::get('send',[BidController::class,'sendmail']);
Route::get('/search',[SearchController::class,'search']);

Route::get('/removeskill/{skillid}/{fid}',[FreelancerController::class,'removeskills']);
Route::get('/cancelorder/{oid}',[OrderController::class,'cancelOrder']);
Route::get('/editprofileClient/{cid}',[ClientController::class,'editprofile']);
Route::post('/updateclient/{cid}',[ClientController::class,'updateprofile']);
Route::get('/payment',[PaymentController::class,'paymentView']);
Route::get('/pay/{oid}/{amount}/{did}',[PaymentController::class,'gateway']);
Route::post('/afterPayment/{oid}/{amount}/{did}',[PaymentController::class,'afterpayment']);

Route::get('/viewfreelancersbycategory/{scatid}',[FreelancerController::class,'showfreelancerbycat']);
Route::get('/subcatdelete/{scatid}',[CategoryController::class,'deletesubcat']);
Route::post('/addmaincat',[CategoryController::class,'addmaincat']);
Route::get('/deletecat/{catid}',[CategoryController::class,'deletecat']);


Route::post('/updatebid/{bidid}',[BidController::class,'updatebid']);
Route::get('/feedbackA',[FeedbackController::class,'show']);


Route::get('/changepassword',[AuthController::class,'changepass']);
Route::post('/passwordchange/{fid}',[AuthController::class,'changepassword']);
Route::get('/forgotpassword',[AuthController::class,'forgotpassword']);
Route::post('/changepassforgot',[AuthController::class,'changepassforgot']);
// Route::post('/verifyotp/{otp}',[AuthController::class],'verifyotp');
Route::post('/passwordchangeforgot/{email}',[AuthController::class,'forgotpasswordchanged']);

// Route::get('/chat/open',[App\Chat::class,'onOpen']);
Route::get('/chat', function()
{
    return view('chat');
});



Route::get('/process-payment/{oid}/{amount}/{did}', [PaymentController::class, 'stripePost'])->name('stripe.post');
Route::get('/process-pay', function()
{
    return view('pay');
});
// report
Route::get('/userpdfgenerate',[PDFmaker::class,'generate']);
Route::get('/orderReport',[PDFmaker::class,'orderReport']);
Route::get('/freelancerReport',[PDFmaker::class,'freelancerReport']);
Route::get('/clientReport',[PDFmaker::class,'clientReport']);
Route::get('/feedbackReport',[PDFmaker::class,'feedbackReport']);
Route::get('/paymentReport',[PDFmaker::class,'paymentReport']);
Route::get('/deliveryReport',[PDFmaker::class,'deliveryReport']);
// reportend
Route::get('/countries',[CountryStateController::class,'getcountries']);
Route::get('/states/{countryid}',[CountryStateController::class,'getstates']);

Route::post('/adduser',[AdminController::class,'adduser']);
Route::post('/updateAdmin/{adminid}',[AdminController::class,'editprofile']);
Route::get('/viewadminprofile',[AdminController::class,'viewprofile']);

Route::get('/success',[PaymentController::class,'success']);
Route::get('/freelancerpaymentview',[PaymentController::class,'freelancerpaymentview']);
Route::get('/deliveryoffreelancer',[DeliveryController::class,'deliveryoffreelancer']);
Route::get('/receipt',function()
{
    // cs_test_a1G9NuZUbnF617fi7RoYfoA52dcUI6OugOVFjzTGGUiYYF3kAq2nSuc5MI
    // $stripe = new \Stripe\StripeClient(
    //     'sk_test_51MoL3DSEdH4rFdg1zCyvGvvl3B1KVDZTscxtbUiEslQGUXPdbSI5L4r2Wq1prRAraysEhOewCAsCckVVPCErZLKA00S2wakAtb'
    // );
    
    Stripe::setApiKey('sk_test_51MoL3DSEdH4rFdg1zCyvGvvl3B1KVDZTscxtbUiEslQGUXPdbSI5L4r2Wq1prRAraysEhOewCAsCckVVPCErZLKA00S2wakAtb');
    
    $session_data=Session::retrieve(
      'cs_test_a10HUM1KEUI4qOZHY1BvyNvwBLwx0RMdVymLY4tqftFxFTCENeyHcdXdUn',
    );
    $chargeid=$session_data->payment_intent;
    $pi= PaymentIntent::retrieve('pi_3MywcNSEdH4rFdg10N7KiO67');
    // $trasfer_id=$pi->transfers;
    // dd($trasfer_id);
    $charge=Charge::retrieve($pi->latest_charge);
    dd($pi);
    // $er=ExchangeRate::retrieve([
    //     'currency'=>'INR',
    //     'expand'=>['latest_conversion'],
    //     'latest'=>true,
    //     'from'=>'USD',
    // ]);
    // dd($er);
    // return redirect($charge->receipt_url);
});

Route::get('/adminpayments',function(){
    
    return view('Admin.payment');
});

Route::get('/chats/{orderid}',[ChatController::class,'chatview']);

Route::get('/sendmessages',[ChatController::class,'sendMessages']);
Route::get('/getmessages',[ChatController::class,'getMessages']);
Route::get('/activate/{fid}',function($fid)
{
    DB::table('freelancers')->where('freelancer_id','=',$fid)->update(['status'=>1]);
    return back();
});
Route::get('/clientactivate/{cid}',function($cid)
{
    DB::table('clients')->where('client_id','=',$cid)->update(['status'=>1]);
    return back();
});

// excel 
Route::get('/excelproject',[ExcelMaker::class,'exportprojects']);
Route::get('/excelfreelancer',[ExcelMaker::class,'freelancerexcel']);
Route::get('/excelclient',[ExcelMaker::class,'clientexcel']);
Route::get('/excelfeedback',[ExcelMaker::class,'feedbackexcel']);
Route::get('/excelpayment',[ExcelMaker::class,'paymentexcel']);

Route::get('/adminregister',function()
{
    return view('Admin.adminRegister');
});
Route::post('/adminregister',[AdminController::class,'registeradmin']);
Route::post('/editcatadmin/{catid}',[CategoryController::class,'admincatedit']);