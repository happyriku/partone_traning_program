<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
		$table->id();
        	$table->integer('user_id')->default(0);
		$table->string('name', 50);
		$table->dateTime('birthday');
		$table->tinyInteger('sex');
		$table->string('address', 2048);
		$table->string('email', 320)->unique();
		$table->timestamp('email_verified_at')->nullable();
		$table->string('password', 255);
		$table->timestamps();
		$table->boolean('status')->default(true);
		$table->integer('code_id')->nullable();
		$table->rememberToken();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
