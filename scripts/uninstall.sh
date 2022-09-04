#!/bin/bash

# Remove jamf_protect script
rm -f "${MUNKIPATH}preflight.d/jamf_protect.py"

# Remove jamf_protect.plist file
rm -f "${MUNKIPATH}preflight.d/cache/jamf_protect.plist"