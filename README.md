# Services Carousel Plugin

This repository contains the source code for the plugin. To install it in WordPress, you must build the plugin first. Please note that the build process was developed and tested on macOS, so you may encounter issues when building it on other operating systems.

If you prefer, you can download the **installable plugin** from the Releases section of this Git repository.

## Building the Plugin

Before building the plugin, make sure that Node.js, npm, and Composer (if required) are installed on your system.

1. In the plugin's root directory, run:

```bash
npm install
composer install
```

2. Then run the following command to generate the distributable plugin. A new folder with the plugin's name will be created. You can compress this folder into a ZIP archive and install it in WordPress.

```bash
npm run release
```

You can also check the `package.json` file for additional available commands.

## Important Notes

* Swiper is intentionally **not loaded in the Block Editor** for performance reasons. Instead, a small amount of styling is applied to mimic the frontend appearance. The editor also provides a horizontal scrollbar so you can preview all loaded posts.
* Before using the **Services Carousel** block, make sure you have created some **Services** posts and assigned them to categories.
* The visual design was intentionally kept minimal because no design specification was provided. The primary focus of this task was the plugin's functionality and development.
