/**
 * This script minifies all compiled JS files from the dist folder.
 * It generates .min.js versions next to the original files.
 */

const fs = require( 'fs' );
const path = require( 'path' );
const terser = require( 'terser' );

const DIST_DIR = path.resolve( __dirname, '../assets/dist/js' );

// Read all files in dist/js directory.
const files = fs.readdirSync( DIST_DIR );

files.forEach( async ( file ) => {

    // Skip non-js files and already minified files.
    if ( ! file.endsWith( '.js' ) || file.endsWith( '.min.js' ) ) {
        return;
    }

    const filePath = path.join( DIST_DIR, file );

    // Read original JS content.
    const code = fs.readFileSync( filePath, 'utf8' );

    try {

        // Minify JS using terser.
        const result = await terser.minify( code );

        if ( ! result.code ) {
            return;
        }

        // Build output filename.
        const minFileName = file.replace( '.js', '.min.js' );
        const outputPath = path.join( DIST_DIR, minFileName );

        // Write minified JS.
        fs.writeFileSync( outputPath, result.code, 'utf8' );

    } catch ( error ) {
        console.error( `Error minifying ${ file }:`, error );
    }

} );
