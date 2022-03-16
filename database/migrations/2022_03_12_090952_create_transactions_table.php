<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('transaction_types')->onDelete('cascade');
            $table->foreignId('beneficiary_id')->nullable()->constrained('beneficiaries')->onDelete('cascade');
            $table->decimal('previous_amount', 8, 2)->default(0);
            $table->decimal('transfer_amount', 8, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->dateTime('transaction_date');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('transactions');
    }
}
