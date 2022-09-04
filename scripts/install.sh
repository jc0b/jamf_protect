#!/bin/bash

# jamf_protect controller
CTL="${BASEURL}index.php?/module/jamf_protect/"

# Get the scripts in the proper directories
"${CURL[@]}" "${CTL}get_script/jamf_protect.py" -o "${MUNKIPATH}preflight.d/jamf_protect.py"

# Check exit status of curl
if [ $? = 0 ]; then
	# Make executable
	chmod a+x "${MUNKIPATH}preflight.d/jamf_protect.py"

	# Set preference to include this file in the preflight check
	setreportpref "jamf_protect" "${CACHEPATH}jamf_protect.plist"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/jamf_protect.py"

	# Signal that we had an error
	ERR=1
fi