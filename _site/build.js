var fs = require("fs"),
    path = require("path"),
    sys = require('sys'),
    exec = require('child_process').exec,
    /**
     * @class
     */
    util = {
        /**
         * Port ES6 trim method
         * @param {string} line
         * @return {string}
         */
        trim: function( line ) {
            return line.replace(/^\s+/, "").replace(/\s+$/, "")  ;
        },
        /**
         * Generate a unique id by a suppolied string
         * @param {string} line
         * @return {string}
         */
        unqieueId: function( line ) {
            return line.toLowerCase().replace(/[^a-z\d]/g, "-");
        }
    },
    /**
     * @module
     */
    view = (function(){
        return {
            /**
             * Render doc navigation
             * @param {object} sections
             * @return {string}
             */
            renderNav: function( sections ) {
                var category,
                    out = '<div class="bs-docs-sidebar">' + "\n" +
                    '<ul class="nav bs-docs-sidenav">' + "\n" +
                    '<h3 class="bs-docs-sidenav-heading"><a href="/">Design Patterns for Web-Developer</a></h3>' + "\n";

                for ( category in sections ) {
                    if ( sections.hasOwnProperty( category ) ) {
                        out += '<li><a href="#">' + category + '</a>' + "\n";
                        if ( sections[ category ].length ) {
                            out += '<ul class="nav">' + "\n";
                            sections[ category ].forEach( function( section ){
                                out += '<li><a href="#' + section.id + '">' + section.title + '</a></li>' + "\n";
                            });
                            out += '</ul>';
                        }
                    }
                }
                out += "</ul>\n</div>\n";
                return out;
            },
            /**
             * Render section
             * @param {object} section
             * @return {string}
             */
            renderSection: function( section ) {
                return '## ' + section.title + "\n{: .bs-docs-section #" + section.id + "}\n" + section.content;
            }
        }
    }()),
    /**
     * @module
     */
    builder = (function(){
        var sections = [],
            /**
             * @module
             */
            Liquid = function() {
                var section = {
                    category: "",
                    title: "",
                    content: ""
                };
                return {

                    /**
                    * Process statement:
                    * {% include "examples/Flyweight/PHP/tutorial.php" %}
                    * @param {string} content
                    * @return {string}
                    */
                   processInclude: function( content ) {
                       var re = /{%\s+include\s+\"(.*?)\"\s+%}/gmi;
                       return content.replace( re, function( match, link ) {
                           return fs.readFileSync( link, 'utf-8' );
                       });

                   },

                   /**
                    * Process statement:
                    * {% template "examples/AbstractFactory/PHP/tutorial.php" %}
                    * Provide an interface for creating families of related or dependent objects without specifying their concrete classes.
                    * {% endtemplate }
                    * @param {string} content
                    * @return {string}
                    */
                   processTemplate: function( content ) {
                       var re = /\{%\s+template\s+\"(.*?)\"\s+%\}([^%]+)\{%\s+endtemplate\s+%\}/gmi;
                       return content.replace( re, function( match, link, tplContent ) {
                           return fs.readFileSync( link, 'utf-8' ).replace(/\{\{ content \}\}/, tplContent);
                       });
                   },

                    /**
                     * Parse Liquid blocks
                     * @param {string} content
                     * @return {object} section
                     */
                    parse: function( content ) {
                        var re = /^---\s*$/g,
                            lines = content.split("\n"),
                            i = 0,
                            parts;
                            //console.log(lines[ 0 ], lines[ 1 ], lines[ 2 ]);
                        if ( re.test( lines[ 0 ] )) {
                            while ( !re.test( lines[ ++i ] ) ) {
                                parts = lines[ i ].split(":");
                                if ( parts.length < 2 ) {
                                    throw new Error( "Invalid Liquid syntax: " + lines[ i ] );
                                }
                                section[ util.trim( parts[ 0 ] ) ] = util.trim( parts[ 1 ] );
                            }
                            if ( !section.title ) {
                                throw new Error( "Invalid Liquid syntax: title attribute is missing"  );
                            }
                            section.id = util.unqieueId( section.category + "-" + section.title );
                            section.content =  this.processTemplate(this.processInclude(
                                lines.splice( i + 1 ).join("\n")
                            ));
                        }
                        return section;
                    }
                };
            },
            /**
             * Process section file
             * @param {string} file
             * @param {string} section
             */
            processFile = function( file, section ) {
                var liquid = new Liquid();
                    section = liquid.parse( fs.readFileSync( file, 'utf-8' ) );
                sections[ section.category ] || ( sections[ section.category ] = [] );
                sections[ section.category ].push( section );
            },
            /**
             * Process directory with section file
             * @param {string} dir
             * @param {string} section
             */
            processDir = function( dir, section ) {
                var rdir = fs.readdirSync( dir ),
                    stat;
                rdir && rdir.forEach(function( file ){
                        var re = /\.md$/gi;
                        stat = fs.statSync( dir + "/" + file );
                        stat.isFile() && re.test( file ) &&
                            processFile( dir + "/" + file, section );
                        stat.isDirectory() && processDir( dir + "/" + file, section );
                });
            }
        return {
            /**
             * Process a supplied path(can be a file or a directory)
             * @param {string} path
             * @param {string} section
             */
            processPath: function( path, section ) {
                    var stat;
                    path = path.replace(/\/+$/, "");
                    if (  !fs.existsSync( path ) ) {
                            return console.error( path + " doesn't exist\n" );
                    }
                    stat = fs.statSync( path );
                    return stat.isFile() ? processFile( path, section ) : processDir( path, section );
            },
            /**
             * Save generated files (doc nav and contet)
             */
            save: function() {
                var content = "", category;
                for ( category in sections ) {
                    if ( sections.hasOwnProperty( category ) ) {
                        sections[ category ].sort(function( a, b ){
                            return a.title.localeCompare( b.title );
                        }).forEach(function( section ){
                            content += view.renderSection( section );
                        })
                    }
                }
                fs.writeFileSync( "../_includes/docs-nav.html", view.renderNav( sections ), 'utf-8' );
                fs.writeFileSync( "../index.md", "---\nlayout: default\ntitle: Design Patterns for Web-Developer\n---\n" +
                    content, 'utf-8' );
            }
        };
    }());


    process.chdir( "./_sources")

    builder.processPath( "./sections/Object Creational", "Object Creational" );
    builder.processPath( "./sections/Object Structural", "Object Structural" );
    builder.save();

    process.chdir( "../")
    exec("jekyll", function(error, stdout, stderr){ sys.puts(stdout) });

