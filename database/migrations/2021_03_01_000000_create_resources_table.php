<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'resources',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('remark')->nullable();
                $table->date('date');
                $table->text('content')->nullable();
                $table->string('file', 512)->nullable();
                $table->timestamps();

                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
