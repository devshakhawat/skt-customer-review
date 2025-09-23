# Product Reviews Plugin - Context Information

## Project Overview

This is a WordPress plugin called "Product Reviews" that extends WooCommerce's default review system by enabling customers to submit video testimonials. The plugin allows customers to either record videos directly via webcam or upload pre-recorded video files.

### Key Features
- Video capture via webcam
- Video upload support
- Seamless WooCommerce integration
- Customizable settings for video duration, button colors, and display options

### Technologies Used
- PHP (WordPress plugin development)
- JavaScript (with some jQuery)
- Laravel Mix for asset compilation
- Sass for CSS preprocessing
- Freemius SDK for licensing and premium features

## Project Structure

```
product-reviews/
├── assets/                 # Compiled assets (CSS, JS)
│   ├── admin/              # Admin-specific assets
│   ├── img/                # Images and icons
│   ├── libs/               # Third-party libraries
│   └── public/             # Frontend assets
├── dev/                    # Development source files
│   ├── admin/              # Admin SCSS and JS source
│   └── public/             # Public SCSS and JS source
├── freemius/               # Freemius SDK for premium features
├── includes/               # PHP class files and core functionality
├── languages/              # Language translation files
├── templates/              # Template files for admin and frontend
├── product-reviews.php     # Main plugin file
├── webpack.mix.js          # Laravel Mix configuration
├── package.json            # NPM dependencies and scripts
└── build.sh                # Build and packaging script
```

## Main Plugin File

**product-reviews.php** is the main plugin file that:
- Defines plugin metadata
- Sets up constants
- Initializes the Freemius SDK
- Loads essential files (functions, autoloader, plugin)

## Core Architecture

The plugin follows an object-oriented approach with a singleton pattern:

1. **Plugin.php** - Main plugin class that initializes all components
2. **Autoloader.php** - Handles class autoloading using a classmap approach
3. **classmaps.php** - Maps class names to file paths

### Key Components
- `Hooks` - WordPress hook management
- `Scripts` - Asset enqueueing for admin and frontend
- `Video_Btn` - Video button display logic
- `Admin_Menu` - Admin menu and settings page
- `Save_Video` - Video saving functionality
- `Display_Video` - Video display on product pages
- `Helpers` - Utility functions and settings management
- `Generate_CSS` - Dynamic CSS generation
- `Template_Loader` - Template loading system

## Settings System

The plugin uses WordPress options to store settings:
- Option name: `sktpr_review_settings`
- Default values are defined in the `Helpers` trait
- Settings are managed through the admin interface

## Building and Development

### Asset Compilation
The plugin uses Laravel Mix for asset compilation:

```bash
# Development build
npm run dev

# Watch for changes
npm run watch

# Production build
npm run production
```

### Build Process
The `build.sh` script handles the production build process:
1. Compiles assets for production
2. Creates a clean build directory
3. Copies necessary files
4. Removes development-only files
5. Packages everything into a ZIP file

## Admin Interface

The admin interface is accessible via **WooCommerce > Product Reviews** and allows configuration of:
- Video record button visibility
- File uploader visibility
- Video duration limits (premium feature)
- Button colors and text customization

## Frontend Features

On product pages, customers can:
1. Record videos using their webcam
2. Upload pre-recorded video files
3. View submitted video testimonials

## Freemius Integration

The plugin integrates with Freemius for:
- Premium feature gating
- Licensing management
- Trial periods
- Upgrade prompts

## Development Workflow

1. Modify source files in the `dev/` directory
2. Run `npm run dev` to compile assets
3. Test changes in WordPress
4. For production, run `npm run production` or `./build.sh`

## Constants Defined

- `SKTPR_VERSION` - Plugin version
- `SKTPR_PLUGIN_FILE` - Main plugin file path
- `SKTPR_PLUGIN_DIR` - Plugin directory path
- `SKTPR_PLUGIN_URI` - Plugin URL

## Dependencies

### PHP Dependencies
- WordPress 4.5 or higher
- WooCommerce plugin
- PHP 7.4 or higher

### NPM Dependencies
- Laravel Mix
- Sass and Sass Loader
- Babel plugins
- Cross-env
- wp-pot (for translation files)

## Testing

To test the plugin:
1. Install and activate in WordPress
2. Ensure WooCommerce is active
3. Navigate to Product Reviews in the admin menu
4. Configure settings as needed
5. Visit a product page to test video recording/upload features