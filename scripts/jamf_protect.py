#!/usr/local/munkireport/munkireport-python3

import os
import subprocess
import sys
import plistlib
import re
import string
import datetime
import time
import json


def get_jp_data():

    cmd = ['/usr/local/bin/protectctl', 'info', '--json']
    proc = subprocess.Popen(cmd, shell=False, bufsize=-1, stdin=subprocess.PIPE, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    (output, unused_error) = proc.communicate()

    out = {}

    output_json = json.loads(output.decode(), object_hook=_decode_dict)

    out['connection_identifier'] = output_json['Connection']['identifier']
    out['connection_state'] = output_json['Connection']['state']
    out['install_type'] = output_json['InstallType']
    out['last_check_in'] = int(output_json['LastCheckin'])*1000
    out['last_insights_sync'] = int(output_json['LastInsightsSync'])*1000
    out['plan_hash'] = output_json['PlanHash']
    out['plan_id'] = output_json['PlanID']
    out['protect_version'] = output_json['Version'] 
    out['protection_status'] = output_json['Status']
    out['running_monitors'] = list_running_monitors(output_json["Monitors"])
    out['tenant'] = output_json['Tenant']

    return out

def list_running_monitors(monitors):
    result = []
    for monitor in list(monitors.keys()):
        if len(monitors[monitor]) > 0:
            if monitors[monitor]["running"]:
                result.append(monitor)
    return ' '.join(result)


def _decode_list(data):
    rv = []
    for item in data:
        if isinstance(item, str):
            item = item.encode('utf-8')
        elif isinstance(item, list):
            item = _decode_list(item)
        elif isinstance(item, dict):
            item = _decode_dict(item)
        rv.append(item)
    return rv

def _decode_dict(data):
    rv = {}
    for key, value in data.items():
        if isinstance(key, str):
            key = key.encode('utf-8')
        if isinstance(value, str):
            value = value.encode('utf-8')
        elif isinstance(value, list):
            value = _decode_list(value)
        elif isinstance(value, dict):
            value = _decode_dict(value)
        rv[key] = value
    return rv


def main():
    """Main"""

    # Check if Jamf Protect is installed
    if not os.path.isfile('/usr/local/bin/protectctl'):
        print("ERROR: Jamf Protect is not installed")
        exit(0)

    # Get information about Jamf Protect    
    result = get_jp_data()

    # Write results to cache
    cachedir = '%s/cache' % os.path.dirname(os.path.realpath(__file__))
    output_plist = os.path.join(cachedir, 'jamf_protect.plist')
    try:
        plistlib.writePlist(result, output_plist)
    except:
        with open(output_plist, 'wb') as fp:
            plistlib.dump(result, fp, fmt=plistlib.FMT_XML)

if __name__ == "__main__":
    main()