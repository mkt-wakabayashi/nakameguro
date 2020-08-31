<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id',5);
            $table->string('number',7);
            $table->tinyInteger('business_type');
            $table->string('email_left',50);
            $table->string('email_right',50);
            $table->string('email_id',101);
            $table->date('temp_reg_mail_send_dt');
            $table->string('password',255);
            $table->string('main_reg_link',150);
            $table->date('main_reg_date');
            $table->tinyInteger('condition_1');
            $table->tinyInteger('progress');
            $table->tinyInteger('old_progress');
            $table->tinyInteger('entry_lock');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->string('updated_by',20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
