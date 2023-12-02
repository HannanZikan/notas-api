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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('order_number')->unique()->index();
            $table->double('amount');
            $table->date('issue_date')->index();
            $table->string('sender_cnpj')->index();
            $table->string('sender_name');
            $table->string('carrier_cnpj')->index();
            $table->string('carrier_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
