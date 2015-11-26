#!/bin/bash
echo $(ip addr|grep -i $1 -A2|grep "inet\s"|sed "s/^\s*inet\s\([0-9\.]\+\).*/\1/ig"|tr -d "\n")" rogers.noip.me" > local.host

