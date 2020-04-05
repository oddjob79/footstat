#!/usr/bin/env bash

source /vagrant/Projects/footstat/ext/py_env/bin/activate
# virtualenv is now active.
#
python /vagrant/Projects/footstat/ext/history.py $1 

#deactivate
