# offbalance-ballettstudio-stade.de

This repository contains the [official website](http://offbalance-ballettstudio-stade.de) of the dance school **offbalance** from Stade, Germany.

### Prerequisites

* docker >= 20.10
* php >= 8.0
* symfony-cli >= 4.23
* node >= 14.16
* yarn >= 1.22

### Get Started

```bash
$ git clone git@github.com:JonasKraska/offbalance.git
$ docker-compose up -d
$ php bin/composer build
$ symfony serve # open http://127.0.0.1:8000/dev.php
```

### Services

| service | url |
| --- | --- |
| mysql | mysql://offbalance:offbalance@127.0.0.1:3306 |
| phpmyadmin | http://127.0.0.1:8888 |

---
