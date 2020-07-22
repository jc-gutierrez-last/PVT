<?php
/*
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1',
], function () {
    // Rutas abiertas
    Route::get('config', 'Api\V1\ConfigController');
    Route::apiResource('auth', 'Api\V1\AuthController')->only('store');


    // INDEFINIDO (TODO)
    Route::get('document/{affiliate_id}', 'Api\V1\ScannedDocumentController@create_document');


    // Autenticado con token
    Route::group([
        'middleware' => 'auth'
    ], function () {
        Route::apiResource('user', 'Api\V1\UserController')->only('index', 'show');
        if (!env("LDAP_AUTHENTICATION")) Route::apiResource('user', 'Api\V1\UserController')->only('update');
        Route::get('user/{user}/role', 'Api\V1\UserController@get_roles');
        Route::apiResource('auth', 'Api\V1\AuthController')->only('index');
        Route::patch('auth', 'Api\V1\AuthController@refresh');
        Route::delete('auth', 'Api\V1\AuthController@logout');
        Route::get('procedure_modality/{procedure_modality}/requirement', 'Api\V1\ProcedureModalityController@get_requirements');
        Route::apiResource('calculator', 'Api\V1\CalculatorController')->only('store');
        Route::apiResource('role', 'Api\V1\RoleController')->only('index', 'show');
        Route::apiResource('permission', 'Api\V1\PermissionController')->only('index');
        Route::apiResource('loan_global_parameter', 'Api\V1\LoanGlobalParameterController')->only('index', 'show', 'store', 'update', 'destroy');
        Route::apiResource('loan_destiny', 'Api\V1\LoanDestinyController')->only('index', 'show', 'store', 'update', 'destroy');
        Route::apiResource('affiliate', 'Api\V1\AffiliateController')->only('show');
        Route::apiResource('affiliate_state', 'Api\V1\AffiliateStateController')->only('index');
        Route::get('affiliate/{affiliate}/fingerprint', 'Api\V1\AffiliateController@fingerprint_saved');
        Route::apiResource('city', 'Api\V1\CityController')->only('index', 'show');
        Route::apiResource('pension_entity', 'Api\V1\PensionEntityController')->only('index', 'show');
        Route::apiResource('degree', 'Api\V1\DegreeController')->only('index', 'show');
        Route::apiResource('category', 'Api\V1\CategoryController')->only('index', 'show');
        Route::apiResource('unit', 'Api\V1\UnitController')->only('index', 'show');
        Route::apiResource('procedure_type', 'Api\V1\ProcedureTypeController')->only('index');
        Route::get('procedure_type/{procedure_type}/flow', 'Api\V1\ProcedureTypeController@get_flow');
        Route::apiResource('payment_type', 'Api\V1\PaymentTypeController')->only('index');
        Route::apiResource('procedure_modality', 'Api\V1\ProcedureModalityController')->only('index', 'show');
        Route::apiResource('module', 'Api\V1\ModuleController')->only('index', 'show');
        Route::get('module/{module}/role', 'Api\V1\ModuleController@get_roles');
        Route::get('module/{module}/procedure_type', 'Api\V1\ModuleController@get_procedure_types');
        Route::get('module/{module}/observation_type', 'Api\V1\ModuleController@get_observation_types');
        Route::apiResource('loan', 'Api\V1\LoanController')->only('update');
        Route::patch('loans', 'Api\V1\LoanController@bulk_update_role');
        Route::apiResource('record', 'Api\V1\RecordController')->only('index');
        Route::apiResource('statistic', 'Api\V1\StatisticController')->only('index', 'show');
        Route::apiResource('voucher', 'Api\V1\VoucherController')->only('index', 'show');


        // Afiliado
        Route::group([
            'middleware' => 'permission:show-affiliate'
        ], function () {
            Route::apiResource('affiliate', 'Api\V1\AffiliateController')->only('index');
            Route::apiResource('spouse', 'Api\V1\SpouseController')->only('index', 'show');
            Route::get('affiliate/{affiliate}/state', 'Api\V1\AffiliateController@get_state');
            Route::get('affiliate/{affiliate}/spouse', 'Api\V1\AffiliateController@get_spouse');
            Route::get('affiliate/{affiliate}/address', 'Api\V1\AffiliateController@get_addresses');
            Route::get('affiliate/{affiliate}/contribution', 'Api\V1\AffiliateController@get_contributions');
            Route::get('affiliate/{affiliate}/fingerprint_picture', 'Api\V1\AffiliateController@get_fingerprint_images');
            Route::get('affiliate/{affiliate}/profile_picture', 'Api\V1\AffiliateController@get_profile_images');
            Route::get('affiliate/{affiliate}/observation','Api\V1\AffiliateController@get_observations');
            Route::post('affiliate/{affiliate}/observation','Api\V1\AffiliateController@set_observation');
            Route::patch('affiliate/{affiliate}/observation','Api\V1\AffiliateController@update_observation');
            Route::delete('affiliate/{affiliate}/observation','Api\V1\AffiliateController@unset_observation');
            Route::post('affiliate_guarantor', 'Api\V1\AffiliateController@test_guarantor');

        });
        Route::group([
            'middleware' => 'permission:create-affiliate'
        ], function () {
            Route::apiResource('affiliate', 'Api\V1\AffiliateController')->only('store');
        });
        Route::group([
            'middleware' => 'permission:update-affiliate-primary|update-affiliate-secondary'
        ], function () {
            Route::apiResource('affiliate', 'Api\V1\AffiliateController')->only('update');
            Route::apiResource('spouse', 'Api\V1\SpouseController')->only('update');
        });
        Route::group([
            'middleware' => 'permission:update-affiliate-secondary'
        ], function () {
            Route::apiResource('spouse', 'Api\V1\SpouseController')->only('store');
            Route::patch('affiliate/{affiliate}/fingerprint', 'Api\V1\AffiliateController@update_fingerprint');
            Route::patch('affiliate/{affiliate}/profile_picture', 'Api\V1\AffiliateController@picture_save');
            Route::patch('affiliate/{affiliate}/address', 'Api\V1\AffiliateController@update_addresses');
            Route::apiResource('personal_reference', 'Api\V1\PersonalReferenceController')->only('index', 'store', 'show', 'destroy', 'update');
        });
        Route::group([
            'middleware' => 'permission:delete-affiliate'
        ], function () {
            Route::apiResource('affiliate', 'Api\V1\AffiliateController')->only('destroy');
            Route::apiResource('spouse', 'Api\V1\SpouseController')->only('destroy');
        });

        // Préstamo
        Route::group([
            'middleware' => 'permission:show-loan|show-all-loan'
        ], function () {
            Route::apiResource('loan', 'Api\V1\LoanController')->only('index');
            Route::apiResource('loan', 'Api\V1\LoanController')->only('show');
            Route::get('loan/{loan}/disbursable', 'Api\V1\LoanController@get_disbursable');
            Route::apiResource('loan_interval', 'Api\V1\LoanIntervalController')->only('index');
            Route::get('affiliate/{affiliate}/loan','Api\V1\AffiliateController@get_loans');
            Route::get('loan/{loan}/document','Api\V1\LoanController@get_documents');
            Route::get('loan/{loan}/note','Api\V1\LoanController@get_notes');
            Route::get('loan/{loan}/flow','Api\V1\LoanController@get_flow');
            Route::get('loan/{loan}/print/plan','Api\V1\LoanController@print_plan');
            Route::apiResource('note','Api\V1\NoteController')->only('show');
            Route::get('procedure_type/{procedure_type}/loan_destiny', 'Api\V1\ProcedureTypeController@get_loan_destinies');
            Route::get('loan/{loan}/payment','Api\V1\LoanController@get_payments');
            Route::patch('loan/{loan}/payment','Api\V1\LoanController@get_next_payment');
            Route::post('loan/{loan}/payment','Api\V1\LoanController@set_payment');
            Route::get('loan/{loan}/observation','Api\V1\LoanController@get_observations');
            Route::post('loan/{loan}/observation','Api\V1\LoanController@set_observation');
            Route::patch('loan/{loan}/observation','Api\V1\LoanController@update_observation');
            Route::delete('loan/{loan}/observation','Api\V1\LoanController@unset_observation');
            Route::get('loan/{loan}/print/form', 'Api\V1\LoanController@print_form');
            Route::get('loan/{loan}/print/contract', 'Api\V1\LoanController@print_contract');

        });
        Route::group([
            'middleware' => 'permission:create-loan'
        ], function () {
            Route::apiResource('loan', 'Api\V1\LoanController')->only('store');
            Route::get('loan/{loan}/print/documents', 'Api\V1\LoanController@print_documents');
            Route::get('affiliate/{affiliate}/loan_modality', 'Api\V1\AffiliateController@get_loan_modality');
        });
        Route::group([
            'middleware' => 'permission:update-loan'
        ], function () {
            Route::patch('loan/{loan}/document/{document}', 'Api\V1\LoanController@update_document');
        });
        Route::group([
            'middleware' => 'permission:delete-loan'
        ], function () {
            Route::apiResource('loan', 'Api\V1\LoanController')->only('destroy');
        });

        // Dirección
        Route::group([
            'middleware' => 'permission:create-address'
        ], function () {
            Route::apiResource('address', 'Api\V1\AddressController')->only('store');
        });
        Route::group([
            'middleware' => 'permission:update-address'
        ], function () {
            Route::apiResource('address', 'Api\V1\AddressController')->only('update');
        });
        Route::group([
            'middleware' => 'permission:delete-address'
        ], function () {
            Route::apiResource('address', 'Api\V1\AddressController')->only('destroy');
        });

        // Notas
        Route::group([
            'middleware' => 'permission:update-note'
        ], function () {
            Route::apiResource('note', 'Api\V1\NoteController')->only('update');
        });
        Route::group([
            'middleware' => 'permission:delete-note'
        ], function () {
            Route::apiResource('note', 'Api\V1\NoteController')->only('destroy');
        });

        // Ajustes
        Route::group([
            'middleware' => 'permission:update-setting'
        ], function () {
            Route::patch('procedure_type/{procedure_type}/flow', 'Api\V1\ProcedureTypeController@set_flow');
            Route::patch('procedure_type/{procedure_type}/loan_destiny', 'Api\V1\ProcedureTypeController@set_loan_destinies');
        });

        // Administrador
        Route::group([
            'middleware' => 'permission:show-role'
        ], function () {
            Route::get('user/{user}/permission', 'Api\V1\UserController@get_permissions');
            Route::get('role/{role}/permission', 'Api\V1\RoleController@get_permissions');
        });
        Route::group([
            'middleware' => 'permission:update-role'
        ], function () {
            Route::patch('user/{user}/role', 'Api\V1\UserController@set_roles');
            Route::patch('role/{role}/permission', 'Api\V1\RoleController@set_permissions');
        });
        Route::group([
            'middleware' => 'role:TE-admin'
        ], function () {
            // Ldap
            Route::apiResource('user', 'Api\V1\UserController')->only('store', 'destroy');;
            if (env("LDAP_AUTHENTICATION")) {
                Route::get('user/ldap/unregistered', 'Api\V1\UserController@unregistered_users');
                Route::get('user/ldap/sync', 'Api\V1\UserController@synchronize_users');
            }
        });
    });
});
*/

//mio
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});