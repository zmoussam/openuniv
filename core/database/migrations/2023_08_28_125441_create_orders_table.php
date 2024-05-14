<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('deposit_id')->default(0);
            $table->decimal('total_amount', 28, 8)->default(0);
            $table->tinyInteger('status')->default(0)->comment('ORDER_INITIATE => 0; ORDER_SUCCESS => 1; ORDER_PENDING => 2; ORDER_REJECT => 3;');
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
        Schema::dropIfExists('orders');
    }
};
