<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCategoryTimeAddressContactInDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->string('category')->after('description')->default('Wisata Buatan');
            $table->string('time')->after('category')->default('-');
            $table->string('address')->after('time')->default('-');
            $table->string('contact')->after('address')->default('-');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('time');
            $table->dropColumn('address');
            $table->dropColumn('contact');
        });
    }
}
