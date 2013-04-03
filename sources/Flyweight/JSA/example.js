/*
 * @category Design Pattern Tutorial
 * @package Flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 */
(function () {

    "use strict";
    /*global console:false, require:false, escape:false, unescape:false */
    
var ERROR_INUSUFFICIENT_ARG_TYPE = 1,
    ERROR_INUSUFFICIENT_ARG_VALUE = 2,
    ERROR_NODE_IS_UNDEFINED = 3,
    jsa = require("../../../vendors/jsa/jsa.umd"),
    ErrorMap = [],
    
    FlyweightContext = function() {
        return {};
    },
    
    /**
     * Flyweight context keeps extrinsic state of ErrorLogEntry (datetime stamp)
     */
    ErrorLogEntryContext = function( date ){
       var date; 
       return {
           __extends__: FlyweightContext,
           __constructor__: function( date ) {
               
           },
           getDate: function() {
               return date;
           }
       };
    },
    
    FlyweightInterface = {
        getMessage: ErrorLogEntryContext
    },
    /**
     * Flyweight 
     */
    ErrorLogEntry = function(){
       return {
           __implements__: FlyweightInterface,
           __constructor__: function( errCode ) {
               this.errCode = errCode;
           },
           errCode: 0,
           getMessage: function( context ) {
               return ErrorMap[ this.errCode ] + " " + context.getDate();
           }
       };
    },
    

   /**
    * FlyweightFactory creates flyweights and ensures they are shared properly
    */
    ErrorLogEntryFactory = (function(){
       var messages = {}, 
           callCount = 0, 
           creationCount = 0;
       return {
           make : function( errCode ) {
               if (typeof messages[ errCode ] === 'undefined') {
                   messages[ errCode ] = ErrorLogEntry.createInstance( errCode );
                   creationCount += 1;
               }
               callCount += 1;
               return messages[ errCode ];
           },
           getInstanceCount: function() {

               return creationCount;
           },
           getRequestCount: function() {
               return callCount;
           }
       };
    }()),
    
    Client = {
        log: [ "number" ],
        printMessages: []
    },
    /**
     * Client
     */
    ErrorLogger = function(){
        var errCodes = [], 
            dates = [];
        return {
            __implements__: Client,
            log: function( errCode ) {
                errCodes.push( ErrorLogEntryFactory.make(errCode) );
                dates.push( ErrorLogEntryContext.createInstance(new Date()) );
            },
            printMessages: function() {
                errCodes.forEach(function( logEntry, inx ){
                    console.log( logEntry.getMessage(dates[ inx ]) );
                });
            }
        };
    },
    logger;
    
ErrorMap[ ERROR_INUSUFFICIENT_ARG_TYPE ] = 'Insufficient argument type';
ErrorMap[ ERROR_INUSUFFICIENT_ARG_VALUE ] = 'Insufficient argument value';
ErrorMap[ ERROR_NODE_IS_UNDEFINED ] = 'Node is undefined';


/**
 * Usage
 */

logger = ErrorLogger.createInstance();
logger.log( ERROR_INUSUFFICIENT_ARG_TYPE );
logger.log( ERROR_INUSUFFICIENT_ARG_TYPE );
logger.log( ERROR_INUSUFFICIENT_ARG_VALUE );
logger.log( ERROR_INUSUFFICIENT_ARG_TYPE );
logger.log( ERROR_NODE_IS_UNDEFINED );

logger.printMessages();



console.log( ErrorLogEntryFactory.getRequestCount() + " ErrorLogEntry instances were requested");
console.log( ErrorLogEntryFactory.getInstanceCount() + " LogEntry instances were really created");


/**
 * Output
 */
// Insufficient argument type Wed Jan 23 2013 23:01:59 GMT+0100 (CET)
// Insufficient argument type Wed Jan 23 2013 23:01:59 GMT+0100 (CET)
// Insufficient argument value Wed Jan 23 2013 23:01:59 GMT+0100 (CET)
// Insufficient argument type Wed Jan 23 2013 23:01:59 GMT+0100 (CET)
// Node is undefined Wed Jan 23 2013 23:01:59 GMT+0100 (CET)
// 5 ErrorLogEntry instances were requested
// 3 LogEntry instances were really created

}());