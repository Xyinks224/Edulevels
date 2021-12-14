<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('edulevel_id')->unsigned(); //CARA 1 v
            $table->foreignId('edulevel_id')->constrained('edulevels')->onDelete('cascade')->onUpdate('cascade'); //CARA 2
            $table->string('name', 100);
            $table->integer('student_price')->nullable();
            $table->tinyInteger('student_max')->nullable();
            $table->enum('jenislaba', ['1', '2']);
            $table->text('info')->nullable();
            $table->timestamps();
        });

        // CARA 1 ^
        // Schema::table('programs', function (Blueprint $table) {
        //     $table -> foreign('edulevel_id')->references('id')->on('edulevels')->onDelete('cascade')
        //                                                                        ->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
