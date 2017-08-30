# Weather
[![Project Status: WIP – Initial development is in progress, but there has not yet been a stable, usable release suitable for the public.](http://www.repostatus.org/badges/latest/wip.svg)](http://www.repostatus.org/#wip)
[![Build Status](https://travis-ci.org/kezkankrayon/weather.svg?branch=master)](https://travis-ci.org/kezkankrayon/weather)

> This project will try to follow the [semver](http://semver.org) pro forma.

## About Weather
Weather was developed to record the temperature and humidity within an incubators at the [Marshall Lab](http://marshall-lab.org). 

### Features
- Individual triggers
- Real-time display

### Assumptions
- Raspberry Pi 3 with Rasbian
- AM2315 sensor

### Wiring

## System Configuration

### PHP

### NginX

### PostgreSQL

### Redis

### I2C
Allow the web server to query the i2c bus. 
`sudo adduser www-data i2c`



## Software Installation (compiling and configuring Weather)

### Clone repository

Once your system and dotenv file are configured, this software can be installed in your webroot using standard package managers.

Install various php and node.js packages.
```commandline
composer install
yarn intall
```

Build javascript and css.
```commandline
yarn run production
```

### dotenv

## Post Installation

### Starting Laravel Echo and Workers
In your project root directory, run
```commandline
laravel-echo-server start
```

### Crontab
Execute  `sudo crontab -u www-data -e`, then add the entry below to the www-data user's crontab.

```commandline
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

### Supervisor

### Register Administrator

```commandline
php artisan register:administrator
```

## Security Vulnerabilities and Considerations

If you discover a security vulnerability or know of a better way to configure the Raspberry Pi, please send an e-mail to Ciarán O'Mara at Ciaran.OMara@utas.edu.au. 

## TODO

### Features
- [ ] Humidity chart
    - [ ] Search
    - [ ] Export
- [ ] Humidity table
    - [ ] Search
    - [ ] Export
- [ ] Temperature chart
    - [ ] Search
    - [ ] Export
- [ ] Temperature table
    - [ ] Search
    - [ ] Export
- [ ] Real time web alerts
- [ ] Administrator features
- [ ] Streamlined backup/database export

### Documentation
- [ ] Document PHP installation and configuration
- [ ] Document NginX installation and configuration
- [ ] Document PostgreSQL installation and configuration
- [ ] Document PostgreSQL roles and permissions
- [ ] Document Redis installation and configuration
- [ ] Document Socket.js
- [ ] Document Cronjobs
- [ ] Document Supervisor installation and configuration
- [ ] Document Security considerations
- [ ] Note AM2315
- [ ] Note wiring 
- [ ] Features
