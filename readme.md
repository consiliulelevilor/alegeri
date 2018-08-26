# alegeri.consiliulelevilor.com
This is the repo for https://alegeri.consiliulelevilor.com

# Development
The development environment is based on Homestead. Homestead runs using Vagrant and VirtualBox. If you are not familiar, check the [official Homestead documentation](https://laravel.com/docs/5.6/homestead) where there are in-depth details about how Development environment works. But for this, all details will be explained below:

# Prerequisites
To run the development environment, you need:
* [Vagrant](https://www.vagrantup.com)
* [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
* [PHP 7.2+ (done by XAMPP)](https://www.apachefriends.org/index.html)
* [Composer](https://getcomposer.org)

For Composer, you'll need PHP (in case you work on Windows). For this, XAMPP should be installed before and then just mention to Composer Installer that you have PHP to your XAMPP folder.

# Installing Homestead
After cloning the repo and installing all prereqs, you should install dependencies via Composer CLI:
```bash
$ cd project-folder/
```
```bash
$ composer install --ignore-platform-reqs
```

After dependencies installed, you should configure Homestead & spin up the virtual machine.

To create a `Homestead.yaml` configuration file, just issue the following command:
```bash
$ vendor/bin/homestead make
```

This will create a `Homestead.yaml` file in your root project that you can edit. Your `Homestead.yaml` file should look like this:
```yaml
ip: 192.168.10.10
memory: 1024
cpus: 1
mongodb: true
provider: virtualbox
authorize: ~/.ssh/id_rsa.pub
keys:
    - ~/.ssh/id_rsa
folders:
    -
        map: '/leave/this/path/like/it/was/generated'
        to: /leave/this/path/like/it/was/generated
sites:
    -
        map: alegeri.cne.com
        to: /home/vagrant/code/public
        type: "apache"
        php: "7.2"
        schedule: true
databases:
    - alegeri
name: alegeri
hostname: alegeri
```

As you can notice, the following likes were added:
```yaml
ip: 192.168.10.10
memory: 1024
cpus: 1
>> mongodb: true
provider: virtualbox
authorize: ~/.ssh/id_rsa.pub
keys:
    - ~/.ssh/id_rsa
folders:
    -
        map: '/leave/this/path/like/it/was/generated'
        to: /leave/this/path/like/it/was/generated
sites:
    -
        map: alegeri.cne.com
        to: /home/vagrant/code/public
>>      type: "apache"
>>      php: "7.2"
>>      schedule: true
databases:
    - alegeri
name: alegeri
hostname: alegeri
```

Spinning up the development server can be done with `up` command & `--provision` flag:
```bash
$ vagrant up --provision
```

This might take a while, brew some coffee and wait. After it finishes, SSH into the server:
```bash
$ vagrant ssh
```
```bash
$ cd code
```

# Configuring your hosts file
Because the VM is running on a local IP, we should use a name instead of the IP, for various reasons. The most valuable reason is that it should have a name, like a website name. And this can be done in local environment. In case you are on Linux, the file can be found in your `/etc/hosts`. Otherwise, you find your file in `C:\System32\drivers\etc\hosts`. Make sure you edit it with Administrator rights and add the following line:
```
192.168.10.10 alegeri.cne.com
```

In case you have a different IP or a different name, feel free to change it.

# Configuring your .env file
Now we should create a configuration file with our `.env` variables for sensitive data. The `.env` variables are never commited to the source tree and should be kept safe, away from other people. To do so, copy the `.env.example` file to `.env`:
```bash
$ cp .env.example .env
```

Basically, you can leave it like that if your `Homestead.yaml` file looks like the one specified, or you can configure your own file for different configurations.
Additionally, some .env variables refer to some keys for various 3rd party services & APIs, so make sure you ask them from soneone or use your own.

# Finishing up the install
Now, to finish, run the following commands:
```bash
$ php artisan key:generate
```
```bash
$ chmod -R 777 bootstrap/cache/ storage/logs/
```
```bash
$ php artisan migrate
```
```bash
$ php artisan passport:install
```

# Final notes
Your website is available locally, on `https://alegeri.cne.com`. This enables all features, but in case you use webhooks (this project doesn't use webhooks yet), you should use [ngrok](https://ngrok.com). Since this project uses keys for social media, feel free to ask the public and secret keys from the admin or use your own social apps within their respective developer sections.