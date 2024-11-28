<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EvaluationController;
//use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

//AUTHENTIFICATION
Route::get('/', function () {
    return view('login');
})->name('login');
// Route::get('/register', function () {
//     return view('register');
// });
// Route::get('/forgetpassword', function () {
//     return view('forgetpassword');
// });
// Route::get('/reset-password/{email}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');

// Route::get('/test-mail', function () {
//     Mail::raw('This is a test email', function ($message) {
//         $message->to('test@example.com')
//                 ->subject('Test Email');
//     });
//     return 'Email sent!';
// });

Route::get('/test', function () {
    return view('test');
});



//DASH
Route::get('dash', function () {
    if (Session::get('email') == null || Session::get('role') != 'Admin') {
        return redirect('login');
    }
    $user = Session::get('username');
    return view('dash', ['user' => $user]);
})->name('dash');
Route::get('/dash', [CoursesController::class, 'showDash'])->name('dash');

//USER
Route::get('/user', [UserController::class, 'index'])->name('User');
Route::get('/adduser', [UserController::class, 'adduser'])->name('adduser');
Route::get('/edituser/{id}/update', [UserController::class, 'edituser'])->name('edituser')->name('user.edit');;

//FORMATION
Route::get('/courses', [CoursesController::class, 'indexcourse'])->name('Courses');
Route::get('/addcourse', [CoursesController::class, 'addcourse'])->name('addcourse');
Route::get('/editcourse/{id}/update', [CoursesController::class, 'editcourse'])->name('editcourse');

//EVALUATION
Route::get('/evaluation/view/{courseId}/{personnel?}', [EvaluationController::class, 'viewEvaluation'])->name('evaluation.show');
Route::get('/addevaluation/{courseId}', [EvaluationController::class, 'addevaluation'])->name('addevaluation');
Route::get('/editevaluation/{id}/update', [EvaluationController::class, 'editevaluation'])->name('editevaluation');
Route::get('/get-competences/{themeId}', [EvaluationController::class, 'getCompetences']);


//DELETE
Route::delete('/user/{id}', [UserController::class,'destroy'])->name('user.destroy');
Route::delete('/courses/{id}', [CoursesController::class,'destroy'])->name('course.destroy');
Route::delete('/evaluation/{id}', [EvaluationController::class,'destroy'])->name('evaluation.destroy');

//INSERT
Route::post('/createuser', [UserController::class, 'createuser'])->name('createuser');
Route::post('/createcourse', [CoursesController::class, 'createcourse'])->name('createcourse');
Route::post('/evaluation/create/{courseId}', [EvaluationController::class, 'createevaluation'])->name('createevaluation');

//UPDATE
Route::post('/edituser', [UserController::class, 'update'])->name('user.update');
Route::post('/editcourse', [CoursesController::class, 'update'])->name('course.update');
Route::post('/editevaluation/{id}', [EvaluationController::class, 'update'])->name('evaluation.update');

//SHOW
Route::get('/courses/evaluations', [EvaluationController::class, 'showCourses']);
Route::get('/detailcourse/{id}', [CoursesController::class, 'show'])->name('course.show');
    //cours
Route::get('/courses/{filename}', function ($filename) {
    $path = public_path('courses/' . $filename);
    if (!file_exists($path))
    {
        abort(404);
    }
    return response()->file($path);
})->where('filename', '.*');
    //image
Route::get('/images/{filename}', function ($filename) {
    $path = public_path('images/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->where('filename', '.*');



//AUTHENTIFICATION
// Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
// Route::post('/forgetpassword', [PasswordController::class, 'sendResetLink'])->name('password.email');
// Route::post('/forgetpassword', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
// Route::post('/forgetpassword', function (Request $request) {
//     $status = Password::sendResetLink($request->only('email'));

//     return $status === Password::RESET_LINK_SENT
//         ? response()->json(['message' => __($status)])
//         : response()->json(['message' => __($status)], 400);
// });









