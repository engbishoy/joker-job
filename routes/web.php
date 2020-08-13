<?php

use App\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Section;
use App\Models\Category;
use App\Models\Pull_credit;
use App\Models\Service_work;
use App\Models\ticket;

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




// admin 


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


        // admin login
        route::get('/admin/login','Admin\adminLoginController@showlogin')->name('admin.showlogin');
        route::post('/admin/login','Admin\adminLoginController@login')->name('admin.login');
        //end

        Route::group(['prefix' => '/dashboard','middleware'=>'auth:admin','namespace'=>'Admin'], function () {

            Route::get('/',function(){
                return view('admin.dashboard')->with('categories', Category::all())->with('sections', Section::all())
                ->with('services', Service_work::all())
                ->with('orders', Order::all())
                ->with('requiredTransfer', Pull_credit::where('pull_status',0)->get())
                ->with('tickets', ticket::all())
                ->with('admins',  Admin::whereRoleIs('admin')->get())
                ->with('users',  User::all());
            });

            // edit profile admin
            route::get('profile/edit','adminController@editProfile')->name('profile.edit');
            route::put('profile/update','adminController@updateProfile')->name('profile.update');


            //admin all
            route::get('admin/index','adminController@index')->name('admin.index');

            // add admin
            route::get('admin/create','adminController@create')->name('admin.create');
            route::post('admin/store','adminController@store')->name('admin.store');

            //edit admin
            route::get('admin/edit/{id}','adminController@edit')->name('admin.edit');
            route::put('admin/update/{id}','adminController@update')->name('admin.update');

            //delete admin
            route::delete('admin/delete/{id}','adminController@delete')->name('admin.delete');

            //search admin
            route::get('admin/search','adminController@search')->name('admin.search');



            
            //users all
            route::get('users/index','usersController@index')->name('users.index');

            // add users
            route::get('users/create','usersController@create')->name('users.create');
            route::post('users/store','usersController@store')->name('users.store');

            //edit users
            route::get('users/edit/{id}','usersController@edit')->name('users.edit');
            route::put('users/update/{id}','usersController@update')->name('users.update');

            //delete users
            route::delete('users/delete/{id}','usersController@delete')->name('users.delete');

            //search users
            route::get('users/search','usersController@search')->name('users.search');



            //add category
            route::get('category/create','categoryController@create')->name('category.create');
            route::post('category/store','categoryController@store')->name('category.store');
            // all category
            route::get('category/index','categoryController@index')->name('category.index');
            // edit category
            route::get('category/edit/{id}','categoryController@edit')->name('category.edit');
            route::put('category/update/{id}','categoryController@update')->name('category.update');
            //delete category
            route::delete('category/delete/{id}','categoryController@delete');
            route::get('category/search','categoryController@search')->name('category.search');


            // section of category
            route::get('category/sections/{id}','categoryController@sections')->name('category.sections');
   

            // all section
            route::get('section/index','sectionController@index')->name('section.index');
            //add section
            route::get('section/create','sectionController@create')->name('section.create');
            route::post('section/store','sectionController@store')->name('section.store');
            //update section
            route::get('section/edit/{id}','sectionController@edit')->name('section.edit');
            route::put('section/update/{id}','sectionController@update')->name('section.update');
            // delete section
            route::delete('section/delete/{id}','sectionController@delete')->name('section.delete');

            // section search
            route::get('section/search','sectionController@search')->name('section.search');



            // servicework
            route::get('service_work/index','service_workController@index')->name('servicework.index');
            //delete service
            route::delete('service_work/delete/{id}','service_workController@delete');
            //approve service
            route::put('service_work/approve/{id}','service_workController@approve')->name('servicework.approve');
            //unapprove
            route::put('service_work/unapprove/{id}','service_workController@unapprove')->name('servicework.unapprove');
            //block
            route::put('service_work/block/{id}','service_workController@block')->name('servicework.block');
            //delete service
            route::delete('service_work/delete/{id}','service_workController@delete')->name('servicework.delete');
            // show service
            route::get('service_work/show/{id}','service_workController@show')->name('servicework.show');
            
            // search service
            route::get('/service/search','service_workController@search')->name('service.search');



            //orders
            route::get('order/all','ordersController@index')->name('order.all');
            route::get('/order/show/{id}','ordersController@show')->name('order.show');


            route::post('/order/complete/{id}','ordersController@complete')->name('order.complete');
            route::post('/order/cancel/{id}','ordersController@cancel')->name('order.cancel');

            // block service
            route::put('/service/block/{id}','ordersController@blockService')->name('service.block');


            // search order

            route::get('/order/search','ordersController@search')->name('order.search');


            // money transfer

            // required transfers
            route::get('transfers/required','transferController@transferRequired')->name('transfer.required');
            //completed transfers
            route::get('transfers/completed','transferController@transferCompleted')->name('transfer.complete');

            route::post('transfers/pay','transferController@transferPay')->name('transfer.pay');

            route::get('transfer/success','transferController@transferPaySuccess')->name('transfer.success');
            route::post('transfer/cancel','transferController@transferPayCancel')->name('transfer.cancel');


            // search transfer completed
            route::get('/transfer/search','transferController@search')->name('transfer.search');


            // technical support

            route::get('technical/category/create','technicalSupportController@createCategory')->name('technical.category.create');
            route::post('technical/category/store','technicalSupportController@storeCategory')->name('technical.category.store');

            // tickets category technical support
            route::get('technical/category/{id}/tickets','technicalSupportController@tickets')->name('technical.category.tickets');

            // show ticket
            route::get('technical/ticket/show/{id}','technicalSupportController@showTicket')->name('technical.ticket.show');
            
            //download attachment ticket
            route::get('technical/ticket/attachment/download/{attach}','technicalSupportController@downloadAttach')->name('technical.ticket.attachment.download');


            route::post('/ticket/comment/store','technicalSupportController@storeComment')->name('technical.ticket.comment.store');


            // notification seen
            route::get('notification/seen','technicalSupportController@seenNotification')->name('notification.seen');




            // setting
            route::get('setting/index','settingController@index')->name('setting.index');
            route::put('setting/update/{id}','settingController@update')->name('setting.update');


            // questions
            route::get('question/index','questionController@index')->name('question.index');

            // store question
            route::get('question/create','questionController@create')->name('question.create');
            route::post('question/store','questionController@store')->name('question.store');

            // search question
            route::get('question/search','questionController@search')->name('question.search');
            

        });

});

//end admin


//site

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        //cancel user
        route::delete('/user/delete','site\userController@cancelemail')->name('user.delete');


        // main page site
        Route::get('/', function () {
            $category=Category::take(5)->get();
            return view('welcome')->with('category',$category);
        });
        //show service
        route::get('/service/show/{id}','site\serviceController@show')->name('service.show');

        // search service
        route::get('/services/search','site\serviceController@search')->name('services.search');



        // profile user
        route::get('/user/profile/{id}','site\userController@profile')->name('user.profile');
        // خدمات المستخدم
        route::get('/user/profile/{id}/service','site\userController@service')->name('user.profile.service');
        // المبيعات
        route::get('/user/profile/{id}/sales','site\userController@completeOrder')->name('user.profile.sales');
        // الاعمال السابقة
        route::get('/user/profile/{id}/businessExhibition','site\userController@businessExhibition')->name('user.profile.businessExhibition');

        //end


        // service from section
        route::get('/section/{id}','site\serviceController@serviceSection')->name('section');

        // filter time 
        route::post('/service/filter/time','site\serviceController@filterTime')->name('service.filter.time');

        // filter sort service
        route::post('/service/filter/sort','site\serviceController@filterSort')->name('service.filter.sort');

        

        Route::group(['middleware'=>['verified'],'prefix'=>'home','namespace'=>'site'], function (){



            // account setting  user
            route::get('/account/setting','userController@accountSetting')->name('account.setting');
            route::put('/account/setting/update','userController@updateAccountSetting')->name('account.setting.update');

            // معرض اعمالى
            route::get('/businessExhibition/myworks','businessExhibitionController@myworks')->name('BusinessExhibition.myworks');
            route::get('/businessExhibition/show/{id}','businessExhibitionController@show')->name('BusinessExhibition.show');
            
            route::get('/businessExhibition/create','businessExhibitionController@create')->name('BusinessExhibition.create');
            route::post('/businessExhibition/store','businessExhibitionController@store')->name('BusinessExhibition.store');
            
            route::get('/businessExhibition/edit/{id}','businessExhibitionController@edit')->name('BusinessExhibition.edit');
            route::put('/businessExhibition/update/{id}','businessExhibitionController@update')->name('BusinessExhibition.update');

            route::delete('/BusinessExhibition/delete/{id}','businessExhibitionController@delete')->name('BusinessExhibition.delete');


            route::get('/businessExhibition/index','businessExhibitionController@index')->name('BusinessExhibition.index');



            // credit user

            //index credit 
            route::get('/credit','userController@credit')->name('credit.index');
            // pull credit
            route::post('/credit/pull','userController@pullCredit')->name('credit.pull');

            // my services
            route::get('/myservice','userController@myservice')->name('myservice');

            //edit service
            route::get('/service/edit/{id}','serviceController@edit')->name('service.edit');
            route::put('/service/update/{id}','serviceController@update')->name('service.update');


            //create service
            route::get('/service/create','serviceController@create')->name('service.create');
            // section bt category with ajax
            route::post('/sectionsByCategory','serviceController@sectionsByCategory')->name('sectionsByCategory');
            
            //store service
            route::post('/service/store','serviceController@store')->name('service.store');


            // chat
            route::get('/chat/index','chatController@index')->name('chat.index');
            route::get('/chat/{id}','chatController@userfriend')->name('chat');
            route::post('/sendmessage','chatController@sendmessage')->name('sendmessage');

            //seen message
            route::get('/message/seen','chatController@seenMessage')->name('message.seen');



            // show pay service 
            
            //pay with paypal
            route::get('/service/pay/{id}','serviceController@showPay')->name('service.pay.show');
            route::post('/service/pay/{id}','serviceController@payService')->name('service.pay');

            route::get('/pay/success','serviceController@success')->name('pay.success');
            route::get('/pay/cancel','serviceController@cancel')->name('pay.cancel');

            //pay with my credit
            route::post('/service/pay/mycredit/{id}','serviceController@payMyCredit')->name('service.paymycredit');


            // notification order service
            route::get('/notification/orderservice/read','ordersController@readNotificationOrderservice')->name('orderservice.read');
            //notification message mark as read
            route::get('/notification/message/read','chatController@readNotificationMessage')->name('notification.message.read');


            // my orders
            route::get('/myorders/all','ordersController@index')->name('orders.index');
            route::get('/myorders/completed','ordersController@completed')->name('orders.completed');
            route::get('/myorders/canceled','ordersController@canceled')->name('orders.canceled');


            route::get('/myorders/show/{id}','ordersController@show')->name('orders.show');
            // approve order from buyer service
            route::post('/order/approve/{id}','ordersController@approve')->name('order.approve');
            // refusal order from buyer service
            route::put('/order/refusal/{id}','ordersController@refusal')->name('order.refusal');
            

            // Requests received
            route::get('/requests_received/all','requestsReceivedController@index')->name('requests_received.index');
            route::get('/requests_received/completed','requestsReceivedController@completed')->name('requests_received.completed');
            route::get('/requests_received/Refusal','requestsReceivedController@Refusal')->name('requests_received.Refusal');
            route::get('/requests_received/canceled','requestsReceivedController@canceled')->name('requests_received.canceled');


            route::get('/requests_received/show/{id}','requestsReceivedController@show')->name('requests_received.show');

            // approve order from sale service
            route::put('/requests_received/approve/{id}','requestsReceivedController@approve')->name('requests_received.approve');
            // cancel order from sale service
            route::put('/requests_received/cancel/{id}','requestsReceivedController@cancel')->name('requests_received.cancel');
            
            // store attachments service from sale service
            route::post('/attachment/store','attachmentController@store')->name('attachment.store');


            // technical support tickets 
            route::get('/ticket/all','ticketController@all')->name('ticket.all');
            route::get('/ticket/show/{id}','ticketController@show')->name('ticket.show');
            
            route::post('/ticket/comment/store','ticketController@storeComment')->name('ticket.comment.store');


            // create ticket
            route::get('/ticket/create','ticketController@create')->name('ticket.create');
            //store ticket
            route::post('/ticket/store','ticketController@store')->name('ticket.store');



        });


        
            // downloads attachment
            route::get('/attachment/file/download/{file}','site\attachmentController@downloadfile')->name('attachment.file.download');
            //download attachment ticket
            route::get('/ticket/attachment/download/{attach}','site\ticketController@downloadAttach')->name('ticket.attachment.download');


            // setiing site
            route::get('/aboutus','site\settingController@aboutus')->name('site.aboutus');
            route::get('/usagePolicy','site\settingController@usagePolicy')->name('site.usagePolicy');
            route::get('/conditions','site\settingController@conditions')->name('site.conditions');
            route::get('/questions','site\settingController@questions')->name('site.questions');



        Auth::routes(['verify' => true]);
        Route::get('/home', 'HomeController@index')->name('home');
    });


    
