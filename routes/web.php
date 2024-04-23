<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TestCaseController;
use App\Http\Controllers\ExportController;

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

Route::match(['get', 'post'],'/login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'],'/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/activate', [AuthController::class, 'activateAccount']);


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'showDashboard'])->name('dashboard');
    Route::get('/projects', [ProjectController::class, 'showProjects'])->name('projects');
    Route::get('/test-cases', [TestCaseController::class, 'showTestCases'])->name('test-cases');
    Route::get('/export', [ExportController::class, 'showExportables'])->name('export');

    // Project Operations
    Route::post('/saveProject', [ProjectController::class, 'saveProject'])->name('saveProject');
    Route::post('/fetchProjectInfo', [ProjectController::class, 'fetchProjectInfo'])->name('fetchProjectInfo');
    Route::post('/updateProject', [ProjectController::class, 'updateProject'])->name('updateProject');
    Route::get('/deleteProject', [ProjectController::class, 'deleteProject'])->name('deleteProject');

    // Test Case Operations
    Route::get('/new-test-case', [TestCaseController::class, 'newTestCase'])->name('newTestCase');
    Route::post('/setActiveProject', [TestCaseController::class, 'setActiveProject'])->name('setActiveProject');
    Route::post('/saveTestCase', [TestCaseController::class, 'saveTestCase'])->name('saveTestCase');
    Route::post('/checkTestCaseNum', [TestCaseController::class, 'checkTestCaseNum'])->name('checkTestCaseNum');
    Route::match(['post', 'get'], '/test-steps', [TestCaseController::class, 'testSteps'])->name('testSteps');
    Route::get('/test-case', [TestCaseController::class, 'testCase'])->name('testCase');

    Route::post('/deleteTestCase', [TestCaseController::class, 'deleteTestCase'])->name('deleteTC');
    Route::get('/test-steps', [TestCaseController::class, 'testSteps'])->name('testSteps');
    Route::post('/fetchTestSteps', [TestCaseController::class, 'fetchTestSteps'])->name('fetchTestSteps');
    Route::post('/saveTestSteps', [TestCaseController::class, 'saveTestSteps'])->name('saveTestSteps');
    Route::post('/deleteTestSteps', [TestCaseController::class, 'deleteTestSteps'])->name('deleteTestSteps');

    // Export Operations
    Route::get('/print', [ExportController::class, 'print']);
    Route::get('/print-all', [ExportController::class, 'printAll'])->name('printAll');
    Route::post('/fetchPrintCases', [ExportController::class, 'fetchPrintCases'])->name('fetchPrintCases');

    // Universal Routes
    Route::post('/unsetActiveProject', [TestCaseController::class, 'unsetActiveProject'])->name('unsetActiveProject');
    
});