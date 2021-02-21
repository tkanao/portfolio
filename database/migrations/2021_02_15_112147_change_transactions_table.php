<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 型を変更
        Schema::table('transactions', function(Blueprint $table) {
          $table->integer('amount')->charset(null)->change();
          $table->integer('balance')->charset(null)->change();
        });
        
        // 型を変更
        Schema::table('accounts', function(Blueprint $table) {
          $table->integer('balance')->charset(null)->change(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function(Blueprint $table) {
            $table->string('amount')->change();
            $table->string('balance')->change();
        });
        
        Schema::table('accounts', function(Blueprint $table) {
          $table->string('balance')->change(); 
        });
        
    }
}
