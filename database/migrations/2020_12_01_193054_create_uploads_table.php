<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid');
            $table->string('name');
            $table->string('original_file_name')->nullable();
            $table->string('file_name');
            $table->string('extension')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('disk')->nullable();

            $table->unsignedBigInteger('size')->nullable();

            $table->json('meta')->nullable();

            $table->string('status')->default('active');
            $table->integer('processed_records')->default(0);
            $table->integer('total_records')->default(0);
            $table->string('type')->nullable();
            $table->string('stage')->default('checker');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->jsonb('notify')->nullable();
            $table->timestamp('processed_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}
