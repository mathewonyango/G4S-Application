<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phonenumber')->unique();
            $table->string('email')->unique();
            $table->string('idnumber')->unique();
            $table->string('dateofbirth')->nullable();
            $table->string('active')->default(0);
            $table->string('status')->default(0);
            $table->string('branch_id')->default(777);
            $table->string('address')->nullable();
            $table->string('password')->nullable();
            $table->string('uuid')->nullable();
            // $table->string('username')->nullable();
            $table->string('type');
            $table->string('avatar')->default('default.png');
            $table->unsignedBigInteger('created_by')->default(2066);
            $table->unsignedBigInteger('verifier_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
