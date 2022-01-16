<?php

namespace App\Http;

use App\Http\Middleware\ApprovalMiddleware;
use App\Http\Middleware\CheckAdministrator;
use App\Http\Middleware\CheckArrowSticker;
use App\Http\Middleware\CheckCartoon;
use App\Http\Middleware\CheckCreateAS;
use App\Http\Middleware\CheckCreateCB;
use App\Http\Middleware\CheckCreateE;
use App\Http\Middleware\CheckCreateF;
use App\Http\Middleware\CheckCreateG;
use App\Http\Middleware\CheckCreateGI;
use App\Http\Middleware\CheckCreateI;
use App\Http\Middleware\CheckCreateP;
use App\Http\Middleware\CheckCreateQC;
use App\Http\Middleware\CheckCreateT;
use App\Http\Middleware\CheckCreateTD;
use App\Http\Middleware\CheckCreateUser;
use App\Http\Middleware\CheckEditUser;
use App\Http\Middleware\CheckElastic;
use App\Http\Middleware\CheckFabric;
use App\Http\Middleware\CheckGeneralItem;
use App\Http\Middleware\CheckGumtape;
use App\Http\Middleware\CheckInterlining;
use App\Http\Middleware\CheckPoly;
use App\Http\Middleware\CheckQCSticker;
use App\Http\Middleware\CheckResetPassword;
use App\Http\Middleware\CheckRestoreUser;
use App\Http\Middleware\CheckThread;
use App\Http\Middleware\CheckTissue;
use App\Http\Middleware\CheckUpdateAS;
use App\Http\Middleware\CheckUpdateCB;
use App\Http\Middleware\CheckUpdateE;
use App\Http\Middleware\CheckUpdateF;
use App\Http\Middleware\CheckUpdateG;
use App\Http\Middleware\CheckUpdateGI;
use App\Http\Middleware\CheckUpdateI;
use App\Http\Middleware\CheckUpdateP;
use App\Http\Middleware\CheckUpdateQCS;
use App\Http\Middleware\CheckUpdateT;
use App\Http\Middleware\CheckUpdateTD;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\ApprovalMiddleware::class,
        ],

        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'administrator' => CheckAdministrator::class,
        'cartoon' => CheckCartoon::class,
        'createcb' => CheckCreateCB::class,
        'updatecbmaster' => CheckUpdateCB::class,
        'elastic' => CheckElastic::class,
        'createe' => CheckCreateE::class,
        'updateemaster' => CheckUpdateE::class,
        'fabric' => CheckFabric::class,
        'createf' => CheckCreateF::class,
        'updatefmaster' => CheckUpdateF::class,
        'tissue' => CheckTissue::class,
        'createt' => CheckCreateT::class,
        'updatetmaster' => CheckUpdateT::class,
        'interlining' => CheckInterlining::class,
        'createi' => CheckCreateI::class,
        'updateimaster' => CheckUpdateI::class,
        'qcsticker' => CheckQCSticker::class,
        'createqcs' => CheckCreateQC::class,
        'updateqcsmaster' => CheckUpdateQCS::class,
        'arrowsticker' => CheckArrowSticker::class,
        'createas' => CheckCreateAS::class,
        'updateasmaster' => CheckUpdateAS::class,
        'gumtape' => CheckGumtape::class,
        'creategt' => CheckCreateG::class,
        'updategtmaster' => CheckUpdateG::class,
        'thread' => CheckThread::class,
        'createtd' => CheckCreateTD::class,
        'updatetdmaster' => CheckUpdateTD::class,
        'poly' => CheckPoly::class,
        'createp' => CheckCreateP::class,
        'updatepmaster' => CheckUpdateP::class,
        'generalitem' => CheckGeneralItem::class,
        'creategi' => CheckCreateGI::class,
        'updategimaster' => CheckUpdateGI::class,
        'createuser' => CheckCreateUser::class,
        'restoreuser' => CheckRestoreUser::class,
        'updateuser' => CheckEditUser::class,
        'resetpassword' => CheckResetPassword::class,
    ];
}
