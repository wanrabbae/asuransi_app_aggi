<?php

use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\CategoryArtikelController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AdminAuthContoller;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Admin\DataLandingController;
use App\Http\Controllers\Admin\DataOnlineProductController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\IpaymuSettingController;
use App\Http\Controllers\Admin\OfflineProductController;
use App\Http\Controllers\Admin\OfflineTransactionController;
use App\Http\Controllers\Admin\PoinController;
use App\Http\Controllers\Admin\RedeemController;
use App\Http\Controllers\Admin\TargetSetting;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Route::get('/register', [LoginController::class, 'registerView'])->name('register');
// Route::post('/register-post', [LoginController::class, 'registerFromPage'])->name('register-page');
Route::get('/login-user', [LoginController::class, 'loginView'])->name('login-user-view');
Route::post('/login-user', [LoginController::class, 'loginUser'])->name('login-user');
Route::post('/register-user', [LoginController::class, 'registerUser'])->name('register-user');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/transaction-bangunan', [TransactionController::class, 'storeBangunan'])->name('transaction');
Route::post('/transaction-kecelakaan', [TransactionController::class, 'storeKecelakaan'])->name('transaction');
Route::post('/transaction-bangunan/agent', [TransactionController::class, 'storeBangunan'])->name('transaction');
Route::post('/transaction-kecelakaan/agent', [TransactionController::class, 'storeKecelakaan'])->name('transaction');
Route::post('/transaction-offline', [TransactionController::class, 'storeOffline'])->name('transaction.offline');

// front
Route::controller(LandingController::class)->group(function () {
    Route::get('/', 'index')->name('landinghome');
    Route::get('/kawan-aggi', 'kawanaggi')->name('kawan-aggi');
    Route::get('/klaim', 'klaim')->name('klaim');
    Route::get('/aturan-pengguna', 'aturanpengguna')->name('aturan-pengguna');
    Route::get('/kebijakan-privasi', 'kebijakanprivasi')->name('kebijakan-privasi');
    Route::get('/faqs', 'faqs')->name('faqs');
    Route::get('/artikel', 'artikel')->name('artikel');
    Route::get('/read/{slug}', 'read')->name('read');
    Route::get('/onlinedetails/{slug}', 'onlinedetails')->name('onlinedetails');
    Route::get('/offlinedetails/{slug}', 'offlinedetails')->name('offlinedetails');
    Route::get('404', 'pageerror')->name('404');
});


// user
Route::group(['middleware' => 'PreventBackHistory', 'verified'], function () {
    Auth::routes(['verify' => true]);
    Route::controller(UserController::class)->name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/user/link', 'link')->name('user.link');
        Route::get('/user/linkagen', 'linkagen')->name('user.linkagen');
        Route::get('/user', 'index')->name('user');
        Route::get('/user/profile', 'profile')->name('profile');
        Route::post('/user/editprofile', 'editprofile')->name('editprofile');
        Route::put('/updateprofile', 'updateprofile')->name('updateprofile');
        Route::put('/upgradeAffiliator', 'upgradeAffiliator')->name('upgradeAffiliator');
        Route::put('/upgradeToAgent', 'upgradeToAgent')->name('upgradeToAgent');
        Route::get('/user/commission', 'commission')->name('commission');

        Route::get('/user/notifikasi', 'notifikasi')->name('notifikasi');

        Route::get('/user/polis', 'polis')->name('polis');
        Route::get('/user/active', 'active')->name('active');
        Route::get('/user/followup', 'followup')->name('followup');
        Route::get('/user/expired', 'expired')->name('expired');
        Route::get('/user/process', 'process')->name('process');
        Route::get('/user/paid', 'paid')->name('paid');
        Route::get('/user/unpaid', 'unpaid')->name('unpaid');
        Route::get('/user/request', 'request')->name('request');
        Route::get('/user/polis/{id}', 'show')->name('polis.show');

        Route::post('/user/redeem', 'requestRedeem')->name('requestRedeem');
        Route::get('/user/upgrade/affiliator', 'upgradeAffiliator')->name('user.upgrade.affiliator');
        Route::get('/user/upgrade/agent', 'upgradeToAgent')->name('user.upgrade.agent');

        Route::get('/user/offpolis', 'offpolis')->name('offpolis');
        Route::get('/user/offexpired', 'offexpired')->name('offexpired');
        Route::get('/user/offactive', 'offactive')->name('offactive');
        Route::get('/user/offpolisprocess', 'offpolisprocess')->name('offpolisprocess');
        Route::get('/user/offpaid', 'offpaid')->name('offpaid');
        Route::get('/user/offunpaid', 'offunpaid')->name('offunpaid');
        Route::get('/user/offprocess', 'offprocess')->name('offprocess');
        Route::get('/user/offrequest', 'offrequest')->name('offrequest');
        Route::get('/user/offpolis/{id}', 'offshow')->name('offpolis.show');

        Route::get('/user/belibaru', 'belibaru')->name('belibaru');
        Route::get('/user/belibaru/{slug}', 'belibaruDetailForm')->name('belibaru.detail');
        Route::get('/user/belibaruoffline', 'belibaruOffline')->name('belibaru.offline');
        Route::get('/user/belibaruoffline/{slug}', 'belibaruOfflineDetailForm')->name('belibaru.offline.detail');
        Route::get('/user/nasabahagen', 'nasabahagen')->name('nasabahagen');
    });
});

// admin
Route::group(['middleware' => 'PreventBackHistory'], function () {

    Route::controller(AdminAuthContoller::class)->name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/admin', 'index')->name('admin');
        Route::get('/admin/login', 'index')->name('admin.login');
        Route::post('/admin/login', 'login')->name('login_id');
        Route::post('/admin/logout_id', 'logout_id')->name('logout_id');
    });

    Route::middleware(['AuthAdmin:admin'])->name('dashboard.')->prefix('dashboard')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/staff', 'staff')->name('staff');
            Route::get('/finance', 'finance')->name('finance');
            Route::get('/underwriting', 'underwriting')->name('underwriting');
            Route::get('/admin_profil', 'profile')->name('admin_profil');
            Route::put('/admin_updateprofile', 'updateprofile')->name('admin_updateprofile');
        });

        Route::controller(DataUserController::class)->name('userdata.')->prefix('userdata')->group(function () {
            // data members
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::get('/show/{id}', 'show')->name('show');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::put('/update/{id}', 'update')->name('update');

            // data affliator
            Route::get('/affliator', 'affliator')->name('affliator');
            Route::get('/{id}/editaffliator', 'editaffliator')->name('editaffliator');
            Route::get('/{id}/datanasabahaff', 'datanasabahaff')->name('datanasabahaff');
            Route::get('/{id}/nasabahaff', 'nasabahaff')->name('nasabahaff');
            Route::put('/updateaffliator/{id}', 'updateaffliator')->name('updateaffliator');
            Route::delete('/destroyaffliator/{id}', 'destroyaffliator')->name('destroyaffliator');
            Route::get('/affsales', 'affsales')->name('affsales');

            // data agent
            Route::get('/agent', 'agent')->name('agent');
            Route::get('/createagent', 'createagent')->name('createagent');
            Route::post('/storeagent', 'storeagent')->name('storeagent');
            Route::get('/{id}/editagent', 'editagent')->name('editagent');
            Route::get('/{id}/nasabahagent', 'nasabahagent')->name('nasabahagent');
            Route::get('/{id}/datanasabahagent', 'datanasabahagent')->name('datanasabahagent');
            Route::put('/updateagent/{id}', 'updateagent')->name('updateagent');
            Route::delete('/destroyagent/{id}', 'destroyagent')->name('destroyagent');
            Route::get('/agentsales', 'agentsales')->name('agentsales');

            // data admin
            Route::get('/admin', 'admin')->name('admin');
            Route::get('/createadmin', 'createadmin')->name('createadmin');
            Route::post('/storeadmin', 'storeadmin')->name('storeadmin');
            Route::get('/{id}/editadmin', 'editadmin')->name('editadmin');
            Route::put('/updateadmin/{id}', 'updateadmin')->name('updateadmin');
            Route::delete('/destroyadmin/{id}', 'destroyadmin')->name('destroyadmin');

            // data request agent
            Route::get('/agent/request', 'agentRequest')->name('agent.request');
            Route::get('/agent/request/approve/{id}', 'approveAgentRequest')->name('agent.request.approve');
            Route::get('/agent/request/reject/{id}', 'rejectAgentRequest')->name('agent.request.reject');
            Route::get('/{id}/editagentrequest', 'editagentrequest')->name('editagentrequest');
            Route::put('/updateagentrequest/{id}', 'updateagentrequest')->name('updateagentrequest');
        });

        Route::resource('onlineproductdata', DataOnlineProductController::class);
        Route::resource('offlineproductdata', OfflineProductController::class);

        // Online transaction
        Route::controller(AdminTransactionController::class)->name('onlinetransaction.')->prefix('onlinetransaction')->group(function () {
            Route::get('/alltrx', 'alltrx')->name('alltrx');
            Route::get('/', 'index')->name('index');
            Route::get('/pending', 'pending')->name('pending');
            Route::get('/paid', 'paid')->name('paid');
            Route::get('/process', 'process')->name('process');
            Route::get('/completed', 'complated')->name('completed');
            Route::get('/followup', 'followup')->name('followup');
            Route::get('/expired', 'expired')->name('expired');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/showfinance/{id}', 'showfinance')->name('showfinance');
            Route::get('/showall/{id}', 'showall')->name('showall');
            Route::put('/update/{id}', 'update')->name('update');
            Route::put('/revisipolis/{id}', 'revisipolis')->name('revisipolis');

            Route::get('/premi', 'premi')->name('premi');
            Route::get('/adminfee', 'adminfee')->name('adminfee');
            Route::get('/materai', 'materai')->name('materai');
            Route::get('/alldata', 'alldata')->name('alldata');

            Route::get('/adminfee/filter', 'adminfeeFilter')->name('adminfee.filter');
            Route::get('/materai/filter', 'materaiFilter')->name('materai.filter');
            Route::get('/alldata/filter', 'alldataFilter')->name('alldata.filter');
            Route::get('/premi/filter', 'premiFilter')->name('premi.filter');

            Route::get('/alltrx/filter', 'alltrxFilter')->name('alltrx.filter');
            Route::get('/pending/filter', 'pendingFilter')->name('pending.filter');
            Route::get('/filter', 'requestFilter')->name('index.filter');
            Route::get('/pending/filter', 'pendingFilter')->name('pending.filter');
            Route::get('/paid/filter', 'paidFilter')->name('paid.filter');
            Route::get('/process/filter', 'processFilter')->name('process.filter');
            Route::get('/complete/filter', 'complateFilter')->name('complete.filter');
            Route::get('/follow/filter', 'followFilter')->name('follow.filter');
            Route::get('/expired/filter', 'expiredFilter')->name('expired.filter');
            Route::get('/paid/submit', 'processPaid')->name('paid.process');
        });

        // offline transaction
        Route::controller(OfflineTransactionController::class)->name('offlinetransaction.')->prefix('offlinetransaction')->group(function () {
            Route::get('/alltrx', 'alltrx')->name('alltrx');
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/showfinance/{id}', 'showfinance')->name('showfinance');
            Route::get('/request/process/{id}', 'requestProcess')->name('request.process');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/process', 'process')->name('process');
            Route::put('/process/payment/{id}', 'processPayment')->name('process.payment');

            Route::get('/payment', 'payment')->name('payment');
            Route::get('/paid', 'paid')->name('paid');
            Route::get('/polisprocess', 'polisprocess')->name('polisprocess');
            Route::get('/completed', 'complated')->name('completed');
            Route::get('/followup', 'followup')->name('followup');
            Route::get('/expired', 'expired')->name('expired');
            Route::get('/premi', 'premi')->name('premi');

            Route::get('/filter', 'requestFilter')->name('index.filter');
            Route::get('/alltrx/filter', 'alltrxFilter')->name('alltrx.filter');
            Route::get('/process/filter', 'processFilter')->name('process.filter');
            Route::get('/payment/filter', 'paymentFilter')->name('payment.filter');
            Route::get('/paid/filter', 'paidFilter')->name('paid.filter');
            Route::get('/polisprocess/filter', 'polisprocessFilter')->name('polisprocess.filter');
            Route::get('/completed/filter', 'complatedFilter')->name('completed.filter');
            Route::get('/follow/filter', 'followFilter')->name('follow.filter');
            Route::get('/expired/filter', 'expiredFilter')->name('expired.filter');
            Route::get('/premi/filter', 'premiFilter')->name('premi.filter');
            Route::get('/paid/submit', 'processPaid')->name('paid.process');
        });

        Route::controller(PoinController::class)->name('poindata.')->prefix('poindata')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/filter', 'indexFilter')->name('index.filter');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/datapoin', 'index_poin')->name('index_poin');
            Route::get('/datapoin/filter', 'index_poin_filter')->name('index_poin.filter');
        });

        Route::controller(RedeemController::class)->name('redeemdata.')->prefix('redeemdata')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/request', 'request')->name('request');
            Route::get('/process', 'process')->name('process');
            Route::get('/success', 'success')->name('success');
            Route::get('/filter', 'indexFilter')->name('index.Filter');
            Route::get('/request/filter', 'requestFilter')->name('request.Filter');
            Route::get('/request/submit', 'requestSubmit')->name('request.Submit');
            Route::get('/process/filter', 'processFilter')->name('process.Filter');
            Route::get('/process/submit', 'processSubmit')->name('process.Submit');
            Route::get('/success/filter', 'successFilter')->name('success.Filter');
        });

        Route::controller(DataLandingController::class)->name('landingdata.')->prefix('landingdata')->group(function () {
            // data members
            Route::get('/company', 'index')->name('company');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::put('/update/{id}', 'update')->name('update');
            // setting fee
            Route::get('/fee', 'fee')->name('fee');
            Route::get('/{id}/editfee', 'editfee')->name('editfee');
            Route::put('/updatefee/{id}', 'updatefee')->name('updatefee');
            // data home page
            Route::get('/home', 'home')->name('home');
            Route::get('/{id}/edithome', 'edithome')->name('edithome');
            Route::put('/updatehome/{id}', 'updatehome')->name('updatehome');
            // data kawan page
            Route::get('/kawan', 'kawan')->name('kawan');
            Route::get('/{id}/editkawan', 'editkawan')->name('editkawan');
            Route::put('/updatekawan/{id}', 'updatekawan')->name('updatekawan');
            // data aturan page
            Route::get('/aturan', 'aturan')->name('aturan');
            Route::get('/{id}/editaturan', 'editaturan')->name('editaturan');
            Route::put('/updateaturan/{id}', 'updateaturan')->name('updateaturan');
            // data aturan page
            Route::get('/kebijakan', 'kebijakan')->name('kebijakan');
            Route::get('/{id}/editkebijakan', 'editkebijakan')->name('editkebijakan');
            Route::put('/updatekebijakan/{id}', 'updatekebijakan')->name('updatekebijakan');
            // data faq page
            Route::get('/faq', 'faq')->name('faq');
            Route::get('/createfaq', 'createfaq')->name('createfaq');
            Route::post('/storefaq', 'storefaq')->name('storefaq');
            Route::get('/{id}/editfaq', 'editfaq')->name('editfaq');
            Route::put('/updatefaq/{id}', 'updatefaq')->name('updatefaq');
            // data klaim page
            Route::get('/klaim', 'klaim')->name('klaim');
            Route::get('/{id}/editklaim', 'editklaim')->name('editklaim');
            Route::put('/updateklaim/{id}', 'updateklaim')->name('updateklaim');
            // data popup
            Route::get('/popup', 'popup')->name('popup');
            Route::get('/{id}/editpopup', 'editpopup')->name('editpopup');
            Route::put('/updatepopup/{id}', 'updatepopup')->name('updatepopup');
        });

        Route::resource('categoryartikeldata', CategoryArtikelController::class)->only([
            'index', 'edit', 'update', 'store', 'destroy'
        ]);

        Route::controller(ExpenseController::class)->name('expensedata.')->prefix('expensedata')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/filter', 'expenseFilter')->name('filter');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
        });

        Route::resource('artikeldata', ArtikelController::class);
        Route::resource('targetdata', TargetSetting::class);

        Route::resource('ipaymu', IpaymuSettingController::class);
    });
});

// Online Transaction
Route::get('/dashboard/onlinetransaction/alltrx/excel', [AdminTransactionController::class, 'alltrxExcel'])->name('alltrx.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/onlinetransaction/excel', [AdminTransactionController::class, 'requestExcel'])->name('index.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/onlinetransaction/pending/excel', [AdminTransactionController::class, 'pendingExcel'])->name('pending.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/onlinetransaction/paid/excel', [AdminTransactionController::class, 'paidExcel'])->name('paid.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/onlinetransaction/process/excel', [AdminTransactionController::class, 'processExcel'])->name('process.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/onlinetransaction/complete/excel', [AdminTransactionController::class, 'complateExcel'])->name('complete.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/onlinetransaction/print/{id}', [AdminTransactionController::class, 'printTransaction'])->name('transaction.print');
Route::get('/dashboard/onlinetransaction/polis/download/{id}', [AdminTransactionController::class, 'downloadFileFromPublic'])->name('polis.download')->middleware('AuthAdmin:admin');
Route::get('/dashboard/onlinetransaction/premi/download/{id}', [AdminTransactionController::class, 'downloadFilePremiFromPublic'])->name('premi.download')->middleware('AuthAdmin:admin');
Route::get('/dashboard/onlinetransaction/komisi/download/{id}', [AdminTransactionController::class, 'downloadFileKomisiFromPublic'])->name('komisi.download')->middleware('AuthAdmin:admin');

// offline transaction
Route::get('/dashboard/offlinetransaction/alltrx/excel', [OfflineTransactionController::class, 'alltrxExcel'])->name('alltrx.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/offlinetransaction/excel', [OfflineTransactionController::class, 'requestExcel'])->name('index.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/offlinetransaction/process/excel', [OfflineTransactionController::class, 'processExcel'])->name('process.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/offlinetransaction/payment/excel', [OfflineTransactionController::class, 'paymentExcel'])->name('payment.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/offlinetransaction/paid/excel', [OfflineTransactionController::class, 'paidExcel'])->name('paid.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/offlinetransaction/polisprocess/excel', [OfflineTransactionController::class, 'polisprocessExcel'])->name('polisprocess.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/offlinetransaction/completed/excel', [OfflineTransactionController::class, 'complatedExcel'])->name('completed.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/offlinetransaction/print/{id}', [OfflineTransactionController::class, 'printTransaction'])->name('transaction.print');
Route::get('/dashboard/offlinetransaction/polis/download/{id}', [OfflineTransactionController::class, 'downloadFileFromPublic'])->name('polis.download')->middleware('AuthAdmin:admin');

// REDEEM
Route::get('/dashboard/redeemdata/excel', [RedeemController::class, 'indexExcel'])->name('index.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/redeemdata/request/excel', [RedeemController::class, 'requestExcel'])->name('request.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/redeemdata/process/excel', [RedeemController::class, 'processExcel'])->name('process.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/redeemdata/success/excel', [RedeemController::class, 'successExcel'])->name('success.excel')->middleware('AuthAdmin:admin');

// POIN DATA / COMISSION
Route::get('/dashboard/poindata/excel', [PoinController::class, 'indexExcel'])->name('poin.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/poindata/datapoin/excel', [PoinController::class, 'index_poin_excel'])->name('datapoin.excel')->middleware('AuthAdmin:admin');

// PREMI / ONLINE TRANSACTION
Route::get('/dashboard/onlinetransaction/premi/excel', [AdminTransactionController::class, 'premiExcel'])->name('premi.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/offlinetransaction/premi/excel', [OfflineTransactionController::class, 'premiExcel'])->name('premi.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/onlinetransaction/adminfee/excel', [AdminTransactionController::class, 'adminfeeExcel'])->name('adminfee.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/onlinetransaction/materai/excel', [AdminTransactionController::class, 'materaiExcel'])->name('materai.excel')->middleware('AuthAdmin:admin');
Route::get('/dashboard/onlinetransaction/alldata/excel', [AdminTransactionController::class, 'alldataExcel'])->name('alldata.excel')->middleware('AuthAdmin:admin');

// CLAIM
Route::get('/product/claim/download', [LandingController::class, 'claimDownload'])->name('claim.download');

// EXCEL NASABAH AFFILIATOR EXCEL (ADMIN)
Route::get('/dashboard/userdata/nasabahaffExcel', [DataUserController::class, 'nasabahaffExcel']);
Route::get('/dashboard/userdata/datanasabahaffExcel', [DataUserController::class, 'datanasabahaffExcel']);
// EXCEL NASABAH AGENT EXCEL (ADMIN)
Route::get('/dashboard/userdata/nasabahExcel', [DataUserController::class, 'nasabahExcel']);
Route::get('/dashboard/userdata/datanasabahExcel', [DataUserController::class, 'datanasabahExcel']);
// EXCEL TOP SALES EXCEL (ADMIN)
Route::get('/dashboard/userdata/agentsalesExcel', [DataUserController::class, 'agentsalesExcel']);
Route::get('/dashboard/userdata/affsalesExcel', [DataUserController::class, 'affsalesExcel']);
// EXCEL EXPENSES
Route::get('/dashboard/expensedata/expense/excel', [ExpenseController::class, 'expenseExcel'])->name('expense.excel')->middleware('AuthAdmin:admin');

// UPDATE IPAYMU SETTING
Route::post('/dashboard/ipaymu/store', [IpaymuSettingController::class, 'store'])->name('ipaymu.store')->middleware('AuthAdmin:admin');
