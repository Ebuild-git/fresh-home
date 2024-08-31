<?php

use App\Models\config;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable()->default(null);
            $table->string('icon')->nullable()->default(null);
            $table->string('footer_text')->nullable()->default(null);
            $table->string('telephone')->nullable()->default(null);
            $table->string('adresse')->nullable()->default(null);
            $table->decimal("frais", 10,3)->default(0);
            $table->decimal("tva", 13, 3)->default(0);
            $table->decimal('timbre', 13, 2)->default(0);
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
            $table->string('tiktok')->nullable();
            $table->string("matricule")->nullable();
            $table->string('email')->nullable()->default(null);

            //page a propos
            $table->string("about_cover")->nullable();
            $table->string("about_image")->nullable();
            $table->string("about_cover_video")->nullable();
            $table->string("about_video")->nullable();
            $table->string("about_titre")->nullable();
            $table->text("about_description")->nullable();
            $table->timestamps();
        });


        $config = new config();
        $config->logo=null;
        $config->save();


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
