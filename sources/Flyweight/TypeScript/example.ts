/*
 * @category Design Pattern Tutorial
 * @package flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

"use strict";

declare var console;

var ERROR_INUSUFFICIENT_ARG_TYPE = 1,
    ERROR_INUSUFFICIENT_ARG_VALUE = 2,
    ERROR_NODE_IS_UNDEFINED = 3,
    errorMap = [],
    logger: Client;

    // Abstract flyweight context
    interface FlyweightContext
    {
        getDate(): Date;
    }
    // Flyweight context keeps extrinsic state of
    // ErrorLogEntry (datetime stamp)
    class ErrorLogEntryContext implements FlyweightContext
    {
        private date;
        constructor( date )
        {
            this.date = date;
        }
        public getDate(): Date
        {
            return this.date;
        }
    }
    // Flyweight interface
    interface FlyweightInterface
    {
        getMessage( context: FlyweightContext ): string;
    }
    // Concrete Flyweight
    class ErrorLogEntry implements FlyweightInterface
    {
        private errCode: number;
        constructor( errCode )
        {
            this.errCode = errCode;
        }
        public getMessage( context: FlyweightContext ): string
        {
               return errorMap[ this.errCode ] + " " + context.getDate();
        }
    }

    // FlyweightFactory creates flyweights and ensures they are shared properly
    class ErrorLogEntryFactory
    {
        private messages = {};
        private callCount = 0;
        private creationCount = 0;

        public make( errCode ): string
        {
            if (typeof this.messages[ errCode ] === 'undefined') {
                this.messages[ errCode ] = new ErrorLogEntry( errCode );
                this.creationCount += 1;
            }
            this.callCount += 1;
            return this.messages[ errCode ];
        }
        public getInstanceCount(): number
        {
            return this.creationCount;
        }
        public getRequestCount(): number
        {
            return this.callCount;
        }
    }

    // Client
    interface Client
    {
        log(errCode: number): void;
        printMessages(): void;
        getInstanceCount(): number;
        getRequestCount(): number;
    }

    // Concrete Client
    class ErrorLogger implements Client
    {
        private errCodes = [];
        private dates = [];
        private factory: ErrorLogEntryFactory;

        constructor( factory )
        {
            this.factory = factory;
        }

        public log( errCode ): void
        {
            this.errCodes.push( this.factory.make( errCode ) );
            this.dates.push( new ErrorLogEntryContext( new Date() ) );
        }
        public printMessages(): void
        {
            var that = this;
            this.errCodes.forEach(function( logEntry, inx ){
                console.log( logEntry.getMessage( that.dates[ inx ] ) );
            });
        }

        public getInstanceCount(): number
        {
            return this.factory.getInstanceCount();
        }
        public getRequestCount(): number
        {
            return this.factory.getRequestCount();
        }
    }

errorMap[ ERROR_INUSUFFICIENT_ARG_TYPE ] = 'Insufficient argument type';
errorMap[ ERROR_INUSUFFICIENT_ARG_VALUE ] = 'Insufficient argument value';
errorMap[ ERROR_NODE_IS_UNDEFINED ] = 'Node is undefined';


/**
 * Usage
 */

logger = new ErrorLogger( new ErrorLogEntryFactory() );
logger.log( ERROR_INUSUFFICIENT_ARG_TYPE );
logger.log( ERROR_INUSUFFICIENT_ARG_TYPE );
logger.log( ERROR_INUSUFFICIENT_ARG_VALUE );
logger.log( ERROR_INUSUFFICIENT_ARG_TYPE );
logger.log( ERROR_NODE_IS_UNDEFINED );

logger.printMessages();

console.log( logger.getRequestCount() + " ErrorLogEntry instances were requested" );
console.log( logger.getInstanceCount() + " LogEntry instances were really created" );

/**
 * Output
 */

// Insufficient argument type Wed Apr 03 2013 17:25:24 GMT+0200 (CEST)
// Insufficient argument type Wed Apr 03 2013 17:25:24 GMT+0200 (CEST)
// Insufficient argument value Wed Apr 03 2013 17:25:24 GMT+0200 (CEST)
// Insufficient argument type Wed Apr 03 2013 17:25:24 GMT+0200 (CEST)
// Node is undefined Wed Apr 03 2013 17:25:24 GMT+0200 (CEST)
// 5 ErrorLogEntry instances were requested
// 3 LogEntry instances were really created
