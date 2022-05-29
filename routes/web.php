<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //dd('TEST');
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/register', 'registerController@index')->name('register');

Route::get('/appregisterusers', 'registerController@index')->name('appregisterusers');




//Route::get('/trainer', 'PagesController@trainer');

Route::get('user/{id}', 'PagesController@show');

//Route::get('/trainee', 'PagesController@trainee');

//Route::get('/courses', 'PagesController@courses');

Route::get('/posts','PostsController@index')->name('posts.index');

Route::get('/posts/create','PostsController@create')->name('posts.create');
Route::post('/posts','PostsController@store')->name('posts.store');
Route::get('/posts/{id}','PostsController@show')->name('posts.show');

Route::get('/posts/{id}/edit','PostsController@edit')->name('posts.edit');
Route::put('/posts/{id}','PostsController@update')->name('posts.update');

Route::delete('/posts/{id}','PostsController@destroy')->name('posts.destroy');

Route::get('/course', function () {
    return '<h1> Course Page </h1>';
});


//Route::get('user/{id}', function ($id) {
//    return 'User '.$id;
//});

Route::get('posts/{postId}/comments/{comment}', function ($Id, $comment) {
    return 'Post : Your post No --'.$Id.' Has a Comment  : '.$comment;
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/reports', 'ReportsController@index')->name('reports');
Route::get('/reports/trainerReport', 'ReportsController@Trainerindex')->name('reports.trainerReport');
Route::get('/reports/traineeReport', 'ReportsController@Traineeindex')->name('reports.traineeReport');
Route::get('/reports/trainingReport', 'ReportsController@Trainingindex')->name('reports.trainingReport');
Route::get('/reports/aggReports', 'ReportsController@Aggindex')->name('reports.Aggindex');




//Route::get('/reports/search','ReportsController@search')->name('reports.search');
Route::post('/reports/searchTrainer','ReportsController@searchTrainer')->name('reports.searchTrainer');
Route::post('/reports/searchTrainee','ReportsController@searchTrainee')->name('reports.searchTrainee');
Route::post('/reports/searchTraining','ReportsController@searchTraining')->name('reports.searchTraining');

Route::get('/reports/viewTrainers','ReportsController@viewTrainers')->name('reports.viewTrainers');
Route::get('/reports/viewTrainees','ReportsController@viewTrainees')->name('reports.viewTrainees');
Route::get('/reports/{id}/viewTrainings','ReportsController@viewTrainings')->name('reports.viewTrainings');


/********************************************TRAINEE******************************************** */
Route::get('/trainee','TraineeController@index')->name('trainees.index');

Route::get('/trainees/create','TraineeController@create')->name('trainees.create');

Route::get('/trainees/uploadnewTrainees', 'uploadnewTraineesController@index')->name('trainees.uploadnewTrainees');
Route::post('/trainees/uploadnewTrainees/import', 'uploadnewTraineesController@import');
Route::get('/trainees/uploadnewTrainees/export', 'uploadnewTraineesController@export')->name('trainess.uploadnewTrainees.export');
Route::get('/trainees/uploadnewTrainees/exportTrainers', 'uploadnewTraineesController@exportTrainers')->name('trainess.uploadnewTrainers.exportTrainers');
Route::get('/trainees/uploadnewTrainees/exportTrainings', 'uploadnewTraineesController@exportTrainings')->name('trainess.uploadnewTrainings.exportTrainings');
//Route::get('/trainees/uploadnewTrainees/exportTrainings/{id}', 'uploadnewTraineesController@exportTrainings')->name('trainess.uploadnewTrainings.exportTrainings');

Route::get('/reports/AggReport', 'uploadnewTraineesController@exportAggregation')->name('trainess.uploadnewTrainings.exportAggregation');
Route::get('/reports/AggReport2', 'uploadnewTraineesController@exportAggregation2')->name('trainess.uploadnewTrainings.exportAggregation2');
Route::post('/reports/AggReport3', 'uploadnewTraineesController@exportAggregation3')->name('trainess.uploadnewTrainings.exportAggregation3');



Route::post('/trainees','TraineeController@store')->name('trainees.store');
Route::get('/trainees/{id}','TraineeController@show')->name('trainees.show');

Route::get('/trainees/{id}/edit','TraineeController@edit')->name('trainees.edit');
Route::put('/trainees/{id}','TraineeController@update')->name('trainees.update');

Route::delete('/trainees/{id}','TraineeController@destroy')->name('trainees.destroy');

/*********************************Trainers Routes*********************************** */

Route::get('/trainer','TrainerController@index')->name('trainers.index');

Route::get('/trainers/create','TrainerController@create')->name('trainers.create');
Route::post('/trainers','TrainerController@store')->name('trainers.store');
Route::get('/trainers/{id}','TrainerController@show')->name('trainers.show');

Route::get('/trainers/{id}/edit','TrainerController@edit')->name('trainers.edit');
Route::put('/trainers/{id}','TrainerController@update')->name('trainers.update');

Route::delete('/trainers/{id}','TrainerController@destroy')->name('trainers.destroy');

/*********************************Courses Routes*********************************** */

Route::get('/courses','CourseController@index')->name('courses.index');

Route::get('/courses/create','CourseController@create')->name('courses.create');
Route::post('/courses','CourseController@store')->name('courses.store');
Route::get('/courses/{id}','CourseController@show')->name('courses.show');

Route::get('/courses/{id}/edit','CourseController@edit')->name('courses.edit');
Route::put('/courses/{id}','CourseController@update')->name('courses.update');

Route::delete('/courses/{id}','CourseController@destroy')->name('courses.destroy');

/*********************************Trainings Routes*********************************** */

Route::get('/trainings','TrainingController@index')->name('trainings.index');

Route::get('/trainings/create','TrainingController@create')->name('trainings.create');
Route::post('/trainings','TrainingController@store')->name('trainings.store');
Route::get('/trainings/{id}','TrainingController@show')->name('trainings.show');

Route::get('/trainings/{id}/edit','TrainingController@edit')->name('trainings.edit');
Route::put('/trainings/{id}','TrainingController@update')->name('trainings.update');

Route::delete('/trainings/{id}','TrainingController@destroy')->name('trainings.destroy');




/* 
Route::get('/trainees/bin', 'TraineeController@bin')->name('trainees.bin');
Route::get('/trainees/restore/{id}', 'TraineeController@restore')->name('trainees.restore');
Route::get('/trainees/kill/{id}', 'TraineeController@kill')->name('trainees.kill');
 */


 /************************PDF*************************** */

 
Route::get('/dynamic_pdf/{id}/{course_id}', 'DynamicPDFController@index')->name('dynamic_pdf');
Route::get('/dynamic_pdf/{id}', 'DynamicPDFController@indextraining')->name('dynamic_pdf');
/* Route::get('events/{event}/remind/{user}', [
    'as' => 'remindHelper', 'uses' => 'EventsController@remindHelper']); */

Route::get('/dynamic_pdf/pdf/{id}/{course_id}', 'DynamicPDFController@pdf')->name('dynamic_pdf.pdf');

Route::get('/dynamic_pdfff/pdf/{id}', 'DynamicPDFController@pdfTraining');

/*****************************EXPORT TO EXCEL */


Route::get('/export_excel', 'ExportExcelController@index');

Route::get('/export_excel/excel', 'ExportExcelController@excel')->name('export_excel.excel');




