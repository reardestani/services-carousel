/**
 * This script minifies all compiled CSS files from the dist folder.
 * It generates .min.css versions next to the original files.
 */

const fs = require( 'fs' );
const path = require( 'path' );
const csso = require( 'csso' );

const DIST_DIR = path.resolve( __dirname, '../assets/dist/css' );

// Read all files from dist css directory.
const files = fs.readdirSync( DIST_DIR );

files.forEach( ( file ) => {
    // Skip non-css files.
    if ( ! file.endsWith( '.css' ) || file.endsWith( '.min.css' ) ) {
        return;
    }

    const filePath = path.join( DIST_DIR, file );

    // Read original CSS content.
    const css = fs.readFileSync( filePath, 'utf8' );

    // Minify CSS content using csso.
    const result = csso.minify( css );

    // Build output filename.
    const minFileName = file.replace( '.css', '.min.css' );
    const outputPath = path.join( DIST_DIR, minFileName );

    // Write minified CSS.
    fs.writeFileSync( outputPath, result.css, 'utf8' );
} );
