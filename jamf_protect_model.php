<?php

use munkireport\models\MRModel as Eloquent;

class Jamf_protect_model extends Eloquent
{
    protected $table = 'jamf_protect';

    protected $fillable = [
      'serial_number',
      'connection_identifier',
      'connection_state',
      'install_type',
      'last_check_in',
      'last_insights_sync',
      'plan_hash',
      'plan_id',
      'protect_version',
      'protection_status',
      'running_monitors',
      'tenant',
    ];

    public $timestamps = false;
}