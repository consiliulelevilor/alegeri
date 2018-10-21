#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.

# Copying the Horizon worker's configuration.
sudo cp /home/vagrant/code/storage/supervisor/horizon.conf /etc/supervisor/conf.d/horizon.conf

# Installing Laravel Echo Server & copying the worker's configuration.
sudo npm install -g laravel-echo-server
sudo cp /home/vagrant/code/storage/supervisor/laravel-echo-server.conf /etc/supervisor/conf.d/laravel-echo-server.conf

# Rereading, updating and restarting all workers.
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl restart all