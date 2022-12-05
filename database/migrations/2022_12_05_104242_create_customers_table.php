<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->integer('created_by')->unsigned(); 
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->integer('employee_id')->unsigned()->nullable(); 
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('action_id')->unsigned()->nullable();
            $table->foreign('action_id')->references('id')->on('actions')->onDelete('cascade');
            $table->enum('state', array('true', 'false', 'deleted'))->default('true');
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
        Schema::dropIfExists('customers');
    }
}
