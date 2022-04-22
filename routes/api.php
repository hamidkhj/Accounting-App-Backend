<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationTypeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageTypeController;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Title;
use App\Models\MaritalStatus;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return response()->json(auth()->user());
// });

Route::get('/checkLogInStatus', function (Request $request) {

    if(auth()->check()) {
        $data ['user'] = auth()->user();
        // $data['permissions'] = auth()->user()->getPermissions()->pluck('slug');
        $data['code'] = 200;
        return response()->json($data);
    }

    $response = ['message' => 'user is not loged in', 'code' => 400];
    return response()->json($response);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $data ['user'] = auth()->user();
    $data ['user']['ip'] = $request->ip();
    $data ['role'] = auth()->user()->roles()->pluck('name');
    $data ['permissions'] = auth()->user()->getPermissions()->pluck('slug');
    return response()->json($data);
});

Route::middleware('auth:sanctum')->get('/getPermissions', function (){
    if(auth()->check()) {
        $data['permissions'] = auth()->user()->getPermissions()->pluck('slug');
        $data['role'] = auth()->user()->getRoles()->pluck('name');
        $data['code'] = 200;
        return response()->json($data);
    }

    $response = ['message' => 'user is not loged in', 'code' => 400];
    return response()->json($response);
});


Route::get('/titles', function () {
    return Title::all();
});

Route::get('/maritalStatus', function () {
    return MaritalStatus::all();
});

Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'list']);

//------------Routes for managing Roles---------
Route::get('/rolesForEdit', [RoleController::class, 'listForEdit']);
Route::get('/rolesForAssignment', [RoleController::class, 'listForAssignment']);
Route::post('/roles', [RoleController::class, 'store']);
Route::get('/roles/{role}', [RoleController::class, 'edit']);
Route::put('/roles/{role}', [RoleController::class, 'update']);
Route::put('/roles/changePermission/{role}', [RoleController::class, 'changePermission']);
Route::get('/permissions', [RoleController::class, 'permissionList']);

//------------Routes for managing Groups---------
Route::get('/groups', [GroupController::class, 'list']);
Route::post('/groups', [GroupController::class, 'store']);
Route::get('/groups/{group}', [GroupController::class, 'edit']);
Route::put('/groups/{group}', [GroupController::class, 'update']);
Route::delete('/groups/{group}', [GroupController::class, 'delete']);

//------------Routes for managing Locations---------
Route::get('/locations', [LocationController::class, 'list']);
Route::post('/locations', [LocationController::class, 'store']);
Route::get('/locations/{location}', [LocationController::class, 'edit']);
Route::put('/locations/{location}', [LocationController::class, 'update']);
Route::delete('/locations/{location}', [LocationController::class, 'delete']);

//------------Routes for managing Location Types---------
Route::get('/locationTypes', [LocationTypeController::class, 'list']);
Route::post('/locationTypes', [LocationTypeController::class, 'store']);
Route::get('/locationTypes/{locationType}', [LocationTypeController::class, 'edit']);
Route::put('/locationTypes/{locationType}', [LocationTypeController::class, 'update']);
Route::delete('/locationTypes/{locationType}', [LocationTypeController::class, 'delete']);

//------------Routes for managing Locations---------
Route::get('/packages', [PackageController::class, 'index']);
Route::post('/packages', [PackageController::class, 'store']);
Route::get('/packages/{package}', [PackageController::class, 'edit']);
Route::put('/packages/{package}', [PackageController::class, 'update']);

//------------Routes for managing Package Types---------
Route::get('/packageTypes', [PackageTypeController::class, 'index']);
Route::post('/packageTypes', [PackageTypeController::class, 'store']);
Route::get('/packageTypes/{packageType}', [PackageTypeController::class, 'show']);
Route::put('/packageTypes/{packageType}', [PackageTypeController::class, 'update']);
Route::delete('/packageTypes/{packageType}', [PackageTypeController::class, 'destroy']);

//------------Routes for managing Services---------
Route::get('/services', [ServiceController::class, 'list']);
Route::post('/services', [ServiceController::class, 'store']);
Route::get('/services/{service}', [ServiceController::class, 'edit']);
Route::put('/services/{service}', [ServiceController::class, 'update']);
Route::delete('/services/{service}', [ServiceController::class, 'delete']);

//------------Routes for managing users---------
Route::get('/users', [UserController::class, 'list']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'edit']);
Route::delete('/users/{user}', [UserController::class, 'delete']);
Route::post('/users/searchUsers', [UserController::class, 'searchUsers']);
Route::post('/users/findUser', [UserController::class, 'findUser']);
Route::post('/users/editUser', [UserController::class, 'editUser']);
Route::post('/users/changeRole', [UserController::class, 'changeRole']);
Route::post('/users/resetPasswordByAdmin/{user}', [UserController::class, 'ResetPasswordByAdmin']);
Route::post('/users/forgotPassword', [UserController::class, 'forgotPassword']);
Route::post('/users/requestNewPassword', [UserController::class, 'requestNewPassword']);

//------------Routes for managing reports---------
Route::post('/ipReport', [ReportController::class, 'ipReport']);
Route::post('/packageReport', [ReportController::class, 'packageReport']);
Route::post('/userConsumptionReport', [ReportController::class, 'userConsumptionReport']);
Route::post('/userActionLogReport', [ReportController::class, 'userActionLogReport']);
Route::post('/userErrorReport', [ReportController::class, 'userErrorReport']);


// ----------------------------routes for getting info for user pages---------------
Route::post('/userFreePackage', [UserController::class, 'getFreePackageInfo']);
Route::post('/userPurchasedPackage', [UserController::class, 'getPurchasedPacakge']);
Route::post('/userTodayUsage', [UserController::class, 'getTodayUsage']);