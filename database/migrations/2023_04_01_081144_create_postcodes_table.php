<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postcodes', function (Blueprint $table) {
            $table->id();
            $table->string('pcd')->unique();
            $table->string('pcd2')->nullable();
            $table->string('pcds')->nullable();
            $table->integer('dointr')->nullable();
            $table->string('doterm')->nullable();
            $table->string('oscty')->nullable();
            $table->string('ced')->nullable();
            $table->string('oslaua')->nullable();
            $table->string('osward')->nullable();
            $table->string('parish')->nullable();
            $table->integer('usertype')->nullable();
            $table->string('oseast1m')->nullable();
            $table->string('osnrth1m')->nullable();
            $table->string('osgrdind')->nullable();
            $table->string('oshlthau')->nullable();
            $table->string('nhser')->nullable();
            $table->string('ctry')->nullable();
            $table->string('rgn')->nullable();
            $table->string('streg')->nullable();
            $table->string('pcon')->nullable();
            $table->string('eer')->nullable();
            $table->string('teclec')->nullable();
            $table->string('ttwa')->nullable();
            $table->string('pct')->nullable();
            $table->string('itl')->nullable();
            $table->string('statsward')->nullable();
            $table->string('oa01')->nullable();
            $table->string('casward')->nullable();
            $table->string('park')->nullable();
            $table->string('lsoa01')->nullable();
            $table->string('msoa01')->nullable();
            $table->string('ur01ind')->nullable();
            $table->string('oac01')->nullable();
            $table->string('oa11')->nullable();
            $table->string('lsoa11')->nullable();
            $table->string('msoa11')->nullable();
            $table->string('wz11')->nullable();
            $table->string('ccg')->nullable();
            $table->string('bua11')->nullable();
            $table->string('buasd11')->nullable();
            $table->string('ru11ind')->nullable();
            $table->string('oac11')->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('long', 10, 8)->nullable();
            $table->string('lep1')->nullable();
            $table->string('lep2')->nullable();
            $table->string('pfa')->nullable();
            $table->string('imd')->nullable();
            $table->string('calncv')->nullable();
            $table->string('stp')->nullable();
            $table->string('oa21')->nullable();
            $table->string('lsoa21')->nullable();
            $table->string('msoa21')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('post_codes');
    }
}
