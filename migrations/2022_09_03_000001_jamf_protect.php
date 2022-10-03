<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class JamfProtect extends Migration
{
    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->create('jamf_protect', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number')->unique();
            $table->string('connection_identifier')->nullable();
            $table->string('connection_state')->nullable();
            $table->string('install_type')->nullable();
            $table->bigInteger('last_check_in')->nullable();
            $table->bigInteger('last_insights_sync')->nullable();
            $table->string('plan_hash')->nullable();
            $table->string('plan_id')->nullable();
            $table->string('protect_version')->nullable();
            $table->string('protection_status')->nullable();
            $table->string('running_monitors')->nullable();
            $table->string('tenant')->nullable();

            $table->index('serial_number');
            $table->index('connection_identifier');
            $table->index('connection_state');
            $table->index('install_type');
            $table->index('plan_hash');
            $table->index('plan_id');
            $table->index('protect_version');
            $table->index('protection_status');
            $table->index('running_monitors');
            $table->index('tenant');
        });
    }

    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('jamf_protect');
    }
}