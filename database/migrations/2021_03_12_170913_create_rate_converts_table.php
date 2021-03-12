<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateConvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                                        Schema::create('rate_converts', function (Blueprint $table) {
            $table->id();
            $table->string('currency_from', 10);
            $table->string('currency_to', 10);
            $table->float('value', 30, 10);
            $table->float('converted_value', 30, 10);
            $table->float('rate', 30, 10);
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
        Schema::dropIfExists('rate_converts');
    }
}
