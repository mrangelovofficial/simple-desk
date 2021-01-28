<h1>SimpleDesk - Open Source</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-1.0.0-blue.svg?cacheSeconds=2592000" />
  
  <a href="#" target="_blank">
    <img alt="Maintenance" src="https://img.shields.io/badge/Maintained-yes-green.svg" />
  </a>
  <a href="https://www.codefactor.io/repository/github/mrangelovofficial/simple-desk"><img src="https://www.codefactor.io/repository/github/mrangelovofficial/simple-desk/badge" alt="CodeFactor" /></a>
</p>

SimpleDesk is a open-source and self-hosted ticket system. You have three levels of users: SuperAdmin, Admin and Users. Through them you can manage the whole system. The system is maintained and will be upgraded regularly.


## Prerequisites

- php >=7.3
- composer >= 1.9.0
- npm >= 6.0.0

## Install

```sh
cp .env.example .env
composer install
npm install && npm run dev
php artisan key:generate
php artisan migrate
```

## Usage

```sh
php artisan serve
```


## Author

👤 **Georgi Angelov**

* Website: https://mrangelov.ga/
* Github: [@mrangelovofficial](https://github.com/mrangelovofficial)



## 📝 License
MIT License
Copyright (c) [2020] [Georgi Angelov](https://github.com/mrangelovofficial)
