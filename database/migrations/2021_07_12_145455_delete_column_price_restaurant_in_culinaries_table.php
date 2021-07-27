<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnPriceRestaurantInCulinariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('culinaries', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('restaurant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('culinaries', function (Blueprint $table) {
            $table->integer('price')->default(0);
            $table->string('restaurant')->default('-');
        });
    }
}
