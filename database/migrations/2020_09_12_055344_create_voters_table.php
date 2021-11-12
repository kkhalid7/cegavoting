<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('membership_number')->unique();
            $table->string('name');
            $table->string('designation');
            $table->string('phone')->unique();
            $table->string('alt_phone')->nullable()->unique();
            $table->text('address')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->string('bank_acc_number')->nullable();
            $table->decimal('latitude',12,8)->nullable();
            $table->decimal('longitude',12,8)->nullable();
            $table->string('hash')->nullable();
            $table->boolean('vote_casted')->default(0);
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voters');
    }
}
