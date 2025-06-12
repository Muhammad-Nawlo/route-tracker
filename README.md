# Route Tracker for Laravel

A simple Laravel package to **track and log usage statistics of your application routes**.  
This package logs each route's hit count and last usage timestamp to a JSON file stored in your app's storage disk.

---

## Features

- Automatically logs every route usage via middleware
- Stores hits count and last used timestamp per route
- Saves data in a JSON file (`route-usage.json`) in the storage disk
- Lightweight and easy to integrate
- Compatible with Laravel's filesystem abstraction (works with local, S3, etc.)
- Includes PestPHP tests for reliability

---

## Installation

Install the package via Composer:

```bash
composer require your-vendor/route-tracker
