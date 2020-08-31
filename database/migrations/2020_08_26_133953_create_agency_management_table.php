<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAgencyManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_management', function (Blueprint $table) {
            $table->tinyInteger('code')->unique()->primary()->index();
            $table->string('name',20);
            $table->string('zip_code',7);
            $table->string('address_1',40);
            $table->string('address_2',40);
            $table->string('phone_no',11);
            $table->string('email_id',50);
            $table->decimal('agency_fee_rate', 8, 2);
            $table->string('agency_refree',6);
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
        Schema::dropIfExists('agency_management');
    }
}
