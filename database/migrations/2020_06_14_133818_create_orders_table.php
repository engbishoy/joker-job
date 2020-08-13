<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('service_work_id');
            $table->foreign('service_work_id')->references('id')->on('service_works')->onUpdate('cascade')->onDelete('cascade');

            $table->string('payed_id'); // transaction id
            $table->integer('price');
            $table->integer('taxes');
            $table->integer('total_price');

            $table->integer('sale_service_approve')->default('0'); // موافقة بائع الخدمة
            $table->integer('status')->default('0'); // حالة نجاح شراء الخدمة


            //cron job
            // انتهاء مهلة 3 ايام 
            $table->integer('expire_time_sale_approve')->default('0'); //انتهاء مدة القبول او الرفض من قبل بائع الخدمة على العرض
            $table->integer('expire_time_sale_attachment')->default('0'); // انتهاء مدة ارسال المرفقات خلال مدة الخدمة 


            $table->integer('expire_time_buyer_approve')->default('0'); // انتهاء مدة القبول او الرفض من المشترى على المرفقات الخدمة

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
