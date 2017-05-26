# Weather
[![Build Status](https://travis-ci.org/kezkankrayon/weather.svg?branch=master)](https://travis-ci.org/kezkankrayon/weather)

## Assumptions
- Raspberry Pi 3 with Rasbian
- AM2315 sensor

## System Setup and Configuration Notes
### I2C
`sudo adduser www-data i2c`

### Crontab
Execute  `sudo crontab -u www-data -e`, then add the entry below to the www-data user's crontab.

```commandline
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

## Software Installation

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

## Versioning
This project will try to follow the [semver](http://semver.org) pro forma.

## TODO
- [ ] Humidity chart
- [ ] Humidity table
- [ ] Humidity search
- [ ] Humidity export
- [ ] Temperature chart
- [ ] Temperature table
- [ ] Temperature search
- [ ] Temperature export
- [ ] Alerts
- [ ] Administrator features
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