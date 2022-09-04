<?php

/**
 * jamf_protect class
 *
 * @package munkireport
 * @author jc0b
 **/
class Jamf_protect_controller extends Module_controller
{

    /*** Protect methods with auth! ****/
    function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }

    public function get_jamf_protect_status()
    {	
	jsonView(
	    $out = Jamf_protect_model::selectRaw('protection_status, count(*) AS count')
		->filter()
		->groupBy('protection_status')
		->orderBy('count', 'desc')
		->get()
		->toArray()
	    );
    }

    /**
     * Get jamf_protect health stats
    **/
    public function get_protection_stats()
    {
        jsonView(
            Ms_defender_model::selectRaw("COUNT(CASE WHEN `protection_status` = 'Protected' THEN 1 END) AS 'protected'")
                ->selectRaw("COUNT(CASE WHEN `protection_status` <> 'Protected' THEN 1 END) AS 'unprotected'")
                ->filter()
                ->first()
                ->toLabelCount()
        );
    }

    /**
     * Get jamf_protect information for serial_number
     *
     * @param string $serial serial number
     **/
    public function get_data($serial_number = '')
    {
        jsonView(
            Jamf_protect_model::selectRaw('protect_version, protection_status, tenant, connection_identifier, connection_state, install_type, last_check_in, last_insights_sync, plan_hash, plan_id, running_monitors')
                ->whereSerialNumber($serial_number)
                ->filter()
                ->get()
                ->toArray()
        );
    }
    
}
