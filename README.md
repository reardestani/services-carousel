# Services Carousel Plugin
This repository holds the source codes of the plugin. To be able to install the plugin in WP, you would need to build it first.

You can also download the **installable plugin** from each release in the Git repository.

## How to build the plugin
Make sure Node.js, npm and Composer are installed on your system.

1. In the plugin root directory, run:
```
npm install
composer install
```
2. Then run the following command, it generates a folder with name of the plugin. You can zip it and install it in WP.
```
npm run release
```

You can also check `package.json` file for more commands.
