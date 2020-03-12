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

// Route::get('/feedback_mail', 'NotificationController@feedback_mail')->name('feedback_mail');
Route::post('/contact_mail', 'ContactController@store')->name('contact_mail');
Route::post('/service_control_mail', 'ServiceControlController@store')->name('service_control_mail');
Route::get('/clear-cache', function() {
   Artisan::call('cache:clear');
   return "Cache is cleared";
});

Route::get('/config-cache', function() {
   Artisan::call('config:cache');
   return "Cache is cleared";
});

Route::get('/config-clear', function() {
   Artisan::call('config:clear');
   return "Cache is cleared";
});

Route::group(['middleware' => ['auth','admin']], function() {

   Route::get('/admin/services/', 'AdminController@services');
   Route::get('/admin/services/edit/{service}', 'AdminController@services_edit')->name('admin_service_edit');
   Route::get('/admin/services/add/page/', 'AdminController@services_add_page')->name('admin_service_add_page');   

   Route::post('/admin/services/create/', 'AdminController@service_create'); 

   Route::get('/admin/services/delete/{service}', 'AdminController@services_delete')->name('admin_service_delete');

   Route::post('/admin/services/store/{service}', 'AdminController@services_store')->name('admin_service_store');

   Route::get('/admin/users/', 'AdminController@user');
   Route::get('/admin/contacts/', 'AdminController@contact_form');
   Route::get('/admin/service_control/', 'AdminController@service_control_form');

   Route::get('/admin/news/', 'AdminController@news');
   Route::get('/admin/news/create_page', 'AdminController@news_create_page');
   Route::post('/admin/news/store', 'AdminController@news_store')->name('admin_news_store');
   Route::get('/admin/news/delete/{id}', 'AdminController@news_delete');
   Route::get('/admin/news/edit/page/{id}', 'AdminController@news_edit_page');
   Route::post('/admin/news/edit/{id}', 'AdminController@news_edit');  


   Route::get('/admin/contracts/', 'AdminController@contracts');
   Route::get('/admin/contracts/create_page', 'AdminController@contracts_create_page');
   Route::post('/admin/contracts/store', 'AdminController@contracts_store')->name('admin_contracts_store');
   Route::get('/admin/contracts/delete/{id}', 'AdminController@contracts_delete');

   Route::get('/admin/questions/', 'AdminController@question');
   Route::get('/admin/questions/create_page', 'AdminController@questions_create_page');
   Route::post('/admin/questions/store', 'AdminController@question_store')->name('admin_question_store');
   Route::get('/admin/question/delete/{id}', 'AdminController@question_delete');



   Route::get('/admin/lawyers/', 'AdminController@lawyer');
   Route::post('/admin/lawyers/create', 'AdminController@lawyer_create')->name('admin_lawyer_create');
   Route::get('/admin/lawyers/create_page', 'AdminController@lawyer_create_page');
   Route::get('/admin/lawyers/edit/{lawyer}', 'AdminController@lawyer_edit')->name('lawyer_edit');
   Route::get('/admin/lawyers/docs/{lawyer}', 'AdminController@lawyer_docs')->name('lawyer_docs');
   Route::post('/admin/lawyers/accepted/{lawyer}', 'AdminController@lawyer_accepted')->name('lawyer_accepted');
   Route::post('/admin/lawyers/not_accepted/{lawyer}', 'AdminController@lawyer_not_accepted')->name('lawyer_not_accepted');
   Route::post('/admin/lawyers/update/{lawyer}', 'AdminController@lawyer_update')->name('lawyer_update');

   Route::post('/admin/experience/store', 'AdminController@experience_store')->name('admin_experience_store');
   Route::get('/admin/experience/delete/{id}', 'AdminController@experience_delete');

   Route::post('/admin/education/store', 'AdminController@education_store')->name('admin_education_store');
   Route::get('/admin/education/delete/{id}', 'AdminController@education_delete');

   Route::get('/admin/lawyer/delete/{id}', 'AdminController@lawyer_delete');





   // Route::post('/admin/doctors/accepted/{doctor}', 'AdminController@doctor_accepted')->name('doctor_accepted');
   // Route::post('/admin/doctors/blocked/{doctor}', 'AdminController@doctor_blocked')->name('doctor_blocked');
   // Route::post('/admin/doctors/weight/{doctor}', 'AdminController@doctor_weight')->name('doctor_weight');
   //
   // Route::get('/admin/doctors/delete/{id}', 'AdminController@doctor_delete');
   //
   //
   // Route::get('/admin/dashboard/', 'AdminController@dashboard');
   Route::get('/admin/profile/', 'AdminController@profile');
   Route::get('/admin/clients/', 'AdminController@clients');
   Route::get('/admin/clients/delete/{client}', 'AdminController@delete_client');


   Route::get('/admin/consultations/urgent', 'AdminController@consultation_urgent');

   Route::get('/admin/consultations/urgent/delete/{id}', 'AdminController@consultation_urgent_delete');

   Route::get('/admin/consultations/urgent/conclusion/{consultation}', 'AdminController@consultation_urgent_conclusion')->name('admin_urgent_conclusion');

   Route::get('/admin/consultations/application/conclusion/{consultation}', 'AdminController@consultation_application_conclusion')->name('admin_application_conclusion');

   Route::get('/admin/consultations/online', 'AdminController@consultation_online');

   Route::get('/admin/consultations/application', 'AdminController@consultation_application');

   Route::get('/admin/consultations/application/lawyer/edit/{consultation}', 'AdminController@application_lawyer_edit')->name('application_lawyer_edit');
   Route::post('/admin/consultations/application/lawyer/store/{consultation}', 'AdminController@application_lawyer_store')->name('application_lawyer_store');
   Route::get('/admin/consultations/application/comment/{consultation}', 'AdminController@application_comment')->name('application_comment');


   Route::get('/admin/lawyers_specializations', 'AdminController@lawyers_specializations');
   Route::get('/admin/lawyers_specializations/create/page', 'AdminController@lawyers_specializations_create_page');  
   
   Route::post('/admin/lawyers_specializations/create', 'AdminController@create')->name('lawyers_specializations_create');  

   Route::get('/admin/lawyers_specializations/delete/{id}', 'AdminController@delete_specialization');

   Route::get('/admin/lawyers_specializations/update_page/{id}', 'AdminController@update_specialization_page');

   Route::get('/admin/lawyers_specializations/update/{id}', 'AdminController@update_specialization');   


   // Route::get('/admin/interpretations/scans', 'AdminController@interpretation_scans');
   // Route::get('/admin/interpretations/analyses', 'AdminController@interpretation_analyses');
   // Route::get('/admin/payments', 'AdminController@payment');
   //
   // Route::get('/admin/specializations', 'AdminController@specialization');
   // Route::get('/admin/specializations/create', 'AdminController@specialization_create')->name('specialization_create');
   // Route::post('/admin/specializations/store', 'AdminController@specialization_store')->name('specialization_store');
   //
   // Route::get('/admin/institutions', 'AdminController@institutions');
   // Route::get('/admin/institutions/create/', 'AdminController@institution_create')->name('institution_create');
   // Route::post('/admin/institutions/store/', 'AdminController@institution_store')->name('institution_store');
   //
   // Route::get('/admin/cities', 'AdminController@cities');
   // Route::get('/admin/qualifications', 'AdminController@qualifications');
   //
   // Route::get('/admin/reports', 'AdminController@reports');
});


Route::get('/test', function () {
   return view('inner_page.test');
});#

Route::get('/', function () {
   return view('main_page.index');
});#


Route::get('/contact', function () {
   return view('inner_page.contact');
});#

Route::get('/information/for_clients', function () {
   return view('inner_page.information.for_clients');
});#

Route::get('/information/for_lawyers', function () {
   return view('inner_page.information.for_lawyers');
});#

Route::get('/information/service', function () {
   return view('inner_page.information.service');
});#

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');#

Route::get('/chat/{id}', 'HomeController@chat')->name('chat');
Route::get('/group/chat/{id}', 'HomeController@groupChat')->name('group.chat');

Route::post('/chat/message/send', 'HomeController@send')->name('chat.send');
Route::post('/chat/message/send/file', 'HomeController@sendFilesInConversation')->name('chat.send.file');
Route::post('/group/chat/message/send', 'HomeController@groupSend')->name('group.send');
Route::post('/group/chat/message/send/file', 'HomeController@sendFilesInGroupConversation')->name('group.send.file');

Route::get('/accept/message/request/{id}' , function ($id){
   Chat::acceptMessageRequest($id);
   return redirect()->back();
})->name('accept.message');

Route::post('/trigger/{id}' , function (\Illuminate\Http\Request $request , $id) {
   Chat::startVideoCall($id , $request->all());
});

Route::post('/group/chat/leave/{id}' , function ($id) {
   Chat::leaveFromGroupConversation($id);
});


Route::resource('/schedules', 'ScheduleController');
Route::post('/schedules/store', 'ScheduleController@store')->name('saveSchedule');

Route::post('/lawyers/online_time', 'LawyerController@online_time')->name('online_time');

Route::post('/lawyers/info', 'LawyerController@info')->name('lawyer_info');

Route::resource('/profile', 'ProfileController');
Route::post('/profile/update_user', 'ProfileController@update_user')->name('profile_update');
Route::post('/profile/delete_video', 'ProfileController@delete_video')->name('delete_video');

// Route::get('/profile/edit', 'ProfileController@edit')->name('profile_edit');

Route::resource('/admin', 'AdminController');

Route::resource('/online_consultations', 'OnlineConsultationController');
Route::post('/online_consultations/store', 'OnlineConsultationController@store')->name('save_online');
Route::post('/online_consultations/consultation_delete/{consultation}','OnlineConsultationController@consultation_delete')->name('online_consultation_delete');
Route::post('/online_consultations/update/{consultation}','OnlineConsultationController@update')->name('online_consultation_update');

Route::get('/online_consultations/detail/{consultation}', 'OnlineConsultationController@detail')->name('consultation_detail');
Route::resource('/urgent_consultations', 'UrgentConsultationController');
Route::post('/urgent_consultations/store', 'UrgentConsultationController@store')->name('save_urgent');
Route::post('/urgent_consultations/consultation_delete/{consultation}','UrgentConsultationController@consultation_delete')->name('urgent_consultation_delete');
Route::get('/urgent_consultations/description/{consultation}', 'UrgentConsultationController@description')->name('consultation_description');
Route::post('/urgent_consultations/success/{consultation}', 'UrgentConsultationController@success')->name('urgent_consultation_success');

Route::post('/urgent_consultations/conclusion_post/{consultation}', 'UrgentConsultationController@conclusion_post')->name('consultation_conclusion_post');
Route::get('/urgent_consultations/conclusion_get/{consultation}', 'UrgentConsultationController@conclusion_get')->name('consultation_conclusion_get');

Route::resource('/applications', 'ApplicationConsultationController');#
Route::post('/applications/update/{id}', 'ApplicationConsultationController@application_update')->name('application_update');
Route::get('/applications/detail/{id}', 'ApplicationConsultationController@application_detail')->name('application_detail');

Route::get('/applications/description/{consultation}', 'ApplicationConsultationController@description')->name('application_description');#

Route::post('/applications/conclusion_post/{consultation}', 'ApplicationConsultationController@conclusion_post')->name('application_conclusion_post');
Route::get('/applications/conclusion_get/{consultation}', 'ApplicationConsultationController@conclusion_get')->name('application_conclusion_get');

Route::resource('/experience', 'ExperienceController');
Route::get('/experience/delete/{id}', 'ExperienceController@destroy');
Route::get('/experience/edit/{id}', 'ExperienceController@edit');
Route::post('/experience/update/{id}', 'ExperienceController@update')->name('experience_update');


Route::resource('/education', 'EducationController');
Route::get('/education/delete/{id}', 'EducationController@destroy');
Route::get('/education/edit/{id}', 'EducationController@edit');
Route::post('/education/update/{id}', 'EducationController@update')->name('education_update');

Route::resource('/payments', 'PaymentController');

Route::resource('consultation_file', 'ConsultationFileController');
Route::post('consultation_file', 'ConsultationFileController@store')->name('consultation_file');
Route::post('consultation_file_upload', 'ConsultationFileController@store')->name('consultation_file_upload');
Route::get('/consultation_notification/application/store', 'ConsultationNotificationController@application_store');
Route::get('/consultation_notification/application/update', 'ConsultationNotificationController@application_update');
Route::get('/datetime_timer', 'TimerController@datetime_timer')->name('datetime_timer');

Auth::routes();

Route::resource('/news', 'NewsController');#
Route::resource('/contracts', 'ContractsController');#
Route::post('/contracts/download/{contract}', 'ContractsController@download')->name('download_contract');#

Route::resource('/lawyers', 'LawyerController');#
Route::resource('/services', 'ServiceController');#
Route::resource('/my_clients', 'ClientController');

Route::get('/search_get', 'SearchController@search')->name('search_get');#

Route::get('/redis', 'ConsultationNotificationController@showProfile');

#layer edit





#pay

Route::post('/pay', 'PayController@doPayment')->name('pay');

Route::get('/redirect', 'PayController@card3ds')->name('redirectPay');


Route::get('/redirect2', 'LaravelCloudPayments@cardsPost3ds')->name('redirectPay2');