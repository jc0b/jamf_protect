Jamf Protect module
==============

A Jamf Protect module for MunkiReport that collects output from Jamf Protect's `protectctl` binary, and submits it to MunkiReport.


Table Schema
---
* id - increments - Incremental value used by MunkiReport
* serial_number - string - Serial number of Mac
* connection_identifier - string - Jamf Protect's Connection ID
* connection_state - string - The connection state to the tenant
* install_type - string - Information about how Jamf Protect is installed
* last_check_in - bigInteger - Timestamp of last check in to Jamf Protect
* last_insights_sync - bigInteger - Timestamp of last Insights sync
* plan_hash - string - The hash of the plan Jamf Protect is using
* plan_id - string - The ID of the plan Jamf Protect is using
* protect_version - string - Version of the installed Jamf Protect agent
* protection_status - string - The protection status provided by the agent
* running monitors - string - A space-seperated list of the monitors currently running on the agent
* tenant - string - The tenant that the agent is reporting to (e.g. `munkireport.protect`)
