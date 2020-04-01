<?php

// Room Owner's role id = 1
// Room seeker's role id = 2


Route::get('/', function () {
    return view('welcome');
})->name('/');

Auth::routes(['verify' => true]);

#--------------------------------------------------------------------------------------------------------------------------------------------------------#

Route::group(['middleware' => ['auth', 'verified']], function () {

    //-------------------------------------------------------------------------------------((Default Routes))

    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('comment/create/{room}', 'CommentController@addRoomComment')->name('room.comment');
    Route::post('comment/update/{comment}', 'CommentController@updateRoomComment')->name('room.comment_update');
    Route::delete('comment/delete/{comment}', 'CommentController@deleteRoomComment')->name('room.comment_delete');

    Route::post('reply/create/{comment}', 'CommentController@addReplyComment')->name('room.reply');


    //----------------------------------------------------------------------------------------------------
    // ((Room Seeker))
    //-----------------------------------------------------------------------------------------------------

    #-----------------------------------------------------------------------------------((Room seeker Profile))
    Route::get('seeker/profile/{name}', 'SeekerController@profile')->name('seeker_profile');
    Route::get('seeker/show/{id}', 'SeekerController@show')->name('seeker.show');
    Route::resource('seeker', 'SeekerController')->except(['show', 'edit', 'create']);

    Route::post('/education_ajax', 'EducationController@Ajax')->name('ajax.post');
    Route::resource('education', 'EducationController')->only(['store', 'update', 'destroy']);

    Route::post('/work_ajax', 'WorkController@Ajax')->name('ajax.work');
    Route::resource('work', 'WorkController')->only(['store', 'update', 'destroy']);

    #-----------------------------------------------------------------------------------((Seeker's Room functions))
    Route::post('seeker_room_ajax', 'SeekerRoomController@allRoomAjax')->name('ajax.all_room');
    Route::get('seeker_room/search', 'SeekerRoomController@allRoomSearch');

    Route::get('seeker_room', 'SeekerRoomController@index')->name('seeker_room');

    #-----------------------------------------------------------------------------------((Applicant/Application))
    Route::get('applicant/create/{id}', 'ApplicantController@create')->name('applicant.create');
    Route::post('applicant/store/{room_id}', 'ApplicantController@store')->name('applicant.store');
    Route::get('applicant/user/{user_id}/room/{room_id}', 'ApplicantController@viewApplicants')->name('applicants.view');
    Route::get('applicant/{user_id}/{room_id}/hire', 'ApplicantController@hire')->name('applicant.hire');
    Route::get('applicant/{user_id}/{room_id}/reject', 'ApplicantController@reject')->name('applicant.reject');


    //----------------------------------------------------------------------------------------------------
    // ((Room Owner))
    //----------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------((Room Owner Profile))
    Route::get('owner/profile/{name}', 'OwnerController@profile')->name('owner_profile');
    Route::get('owner/show/{id}', 'OwnerController@show')->name('owner.show');
    Route::resource('owner', 'OwnerController')->except(['show', 'edit', 'create']);

    #-------------------------------------------------------------------------------------((Room Main))
    Route::resource('room', 'RoomController');

    //----------------------------------------------------------------------------------------------------
    // ((Site Admin))
    //----------------------------------------------------------------------------------------------------

    #--------------------------------------------------------------------------------------((Room Category))
    Route::resource('room_category', 'CategoryController')->except(['show', 'edit', 'create']);

    #-------------------------------------------------------------------------------------((Room Facilities))
    Route::resource('room_facility', 'FacilityController')->except(['show', 'edit', 'create']);

});

