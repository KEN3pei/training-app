<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToGroupemembarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groupemembars', function (Blueprint $table) {
            $table->renameColumn('list_id', 'groupe_id');
            $table->renameColumn('list_membar', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groupemembars', function (Blueprint $table) {
            $table->renameColumn('groupe_id', 'list_id');
            $table->renameColumn('user_id', 'list_membar');
        });
    }
}
