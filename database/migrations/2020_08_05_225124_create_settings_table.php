<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('policyUsage_en'); //سياسة الاستخدام
            $table->text('policyUsage_ar'); 

            $table->text('conditions_en'); // الشروط والاحكام
            $table->text('conditions_ar'); 

            $table->text('about_en'); //عن الجوكر جوب
            $table->text('about_ar'); //عن الجوكر جوب

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
        Schema::dropIfExists('settings');
    }
}
