# Matchbox Blocks

Custom blocks and extensions built by the Matchbox team.

## Requirements

- WordPress 6.5+
- PHP 7.4+
- [Node.js](https://nodejs.org/) (latest LTS version recommended)
- [npm](https://www.npmjs.com/) (bundled with Node.js)
- [nvm](https://github.com/nvm-sh/nvm) (Node Version Manager)

## Development

1. Set up a local WordPress development environment.
2. Clone / download this repository into the `wp-content/plugins` folder.
3. Navigate to the `wp-content/plugins/matchbox-blocks` folder in the command line.
4. If you already have `nvm` installed, run `nvm use`. This will automatically switch to the correct Node.js version.
5. If the required version is not installed, run `nvm install` to install the correct version and set it as active.
6. Run `npm install` to install the plugin's dependencies within a `/node_modules/` folder.
7. Run `composer install` to install the additional WordPress composer tools within a `/vendor/` folder.
8. Run `npm run start` to compile and watch source files for changes while developing.

Refer to `package.json` for additional commands.
