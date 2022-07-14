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
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('blogpost_id'); // FK collumn
            $table->foreign('blogpost_id')
                ->references('id')->on('blogposts')
                ->onDelete('cascade')
                ->onUpdate('restrict'); // Apribojimas
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['blogpost_id']);
            $table->dropColumn('blogpost_id');
        });
    }
};
