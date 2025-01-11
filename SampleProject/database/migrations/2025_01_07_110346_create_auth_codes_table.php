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
        Schema::create('auth_codes', function (Blueprint $table) {
		$table->id();
		$table->integer('user_id')->default(0);
		$table->string('email')->index();
		$table->integer('code');
		$table->timestamp('expires_at'); //authentication code
            	$table->timestamps(); //created_at, updated_at
		$table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth_codes');
    }
};
