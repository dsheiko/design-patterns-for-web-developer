var fs = require("fs"),
    path = require("path"),
    
    processFile = function( file, fn ) {
            var data = fs.readFileSync( file, 'utf-8' );
                    fn( file, data );
    },
    processDir = function( dir, fn ) {
            var rdir = fs.readdirSync( dir ),
                stat;
            rdir && rdir.forEach(function( file ){
                    var re = /\.md$/gi;
                    stat = fs.statSync( dir + "/" + file );
                    stat.isFile() && re.test( file ) &&
                        processFile( dir + "/" + file, fn );
                    stat.isDirectory() && processDir( dir + "/" + file, fn );
            });
    };
    
    
    processDir(".", function( dir, data ){
        if (path.basename( dir ) !== "index.md") {
            return; 
        } 
        
    });