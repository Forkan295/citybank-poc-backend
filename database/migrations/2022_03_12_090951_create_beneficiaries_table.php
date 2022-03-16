<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('account_name');
            $table->foreignId('account_id')->nullable()->constrained('accounts')->onDelete('cascade')->comment('if self bank account .reciver account id ');
            $table->char('account_no',32)->comment('reciver account number');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->char('routing_number',32)->nullable();
            $table->string('branch_city');
            $table->string('currency')->default('bdt');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('beneficiaries');
    }
}
