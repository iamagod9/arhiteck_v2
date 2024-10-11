<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->longText('description')->maxLength(7500);
            $table->string('video_url')->nullable();
            $table->string('avito_id')->nullable();
            $table->dateTime('date_begin')->nullable();
            $table->dateTime('date_end')->nullable();
            $table->string('listing_fee')->nullable();
            $table->string('ad_status')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_method')->nullable();
            $table->string('category')->nullable();
            $table->integer('price')->nullable();
            $table->string('operation_type')->nullable();
            $table->json('balcony_or_loggia')->nullable();
            $table->string('market_type')->nullable();
            $table->string('house_type')->nullable();
            $table->string('floor')->nullable();
            $table->string('floors')->nullable();
            $table->string('rooms')->nullable();
            $table->float('square', precision: 1)->nullable();
            $table->float('kitchen_space', precision: 1)->nullable();
            $table->float('living_space', precision: 1)->nullable();
            $table->float('land_area', precision: 1)->nullable();
            $table->string('land_status')->nullable();
            $table->string('apartment_number')->nullable();
            $table->string('status')->nullable();
            $table->string('object_type')->nullable();
            $table->json('view_from_windows')->nullable();
            $table->string('renovation')->nullable();
            $table->string('passenger_elevator')->nullable();
            $table->string('freight_elevator')->nullable();
            $table->json('courtyard')->nullable();
            $table->json('parking_type')->nullable();
            $table->json('room_type')->nullable();
            $table->json('bathroom_type')->nullable();
            $table->float('ceiling_height', precision: 1)->nullable();
            $table->json('nd_additionally')->nullable();
            $table->integer('new_development_id')->nullable();
            $table->integer('built_year')->nullable();
            $table->string('address')->maxLength(255)->nullable();
            $table->string('lon', 32)->nullable();
            $table->string('lat', 32)->nullable();
            $table->string('property_rights')->nullable();
            $table->string('decoration')->nullable();
            $table->string('lease_appliances')->nullable();
            $table->string('video_file_url')->nullable();
            $table->string('repair_additionally')->nullable();
            $table->json('in_house')->nullable();
            $table->json('ss_additionally')->nullable();
            $table->json('furniture')->nullable();
            $table->json('land_additionally')->nullable();
            $table->string('house_additionally')->nullable();
            $table->string('electricity')->nullable();
            $table->string('gas_supply')->nullable();
            $table->string('heating')->nullable();
            $table->string('deal_type')->nullable();
            $table->string('heating_type')->nullable();
            $table->string('water_supply')->nullable();
            $table->string('sewerage')->nullable();
            $table->json('infrastructure')->nullable();
            $table->json('lease_multimedia')->nullable();
            $table->string('walls_type')->nullable();

            $table->boolean('published')->default(true);
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('estate_type_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estates');
    }
};