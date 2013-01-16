/*
 * @category Design Pattern Tutorial
 * @package Flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @link http://dsheiko.com
 */
(function() {

var ERROR_INUSUFFICIENT_ARG_TYPE = 1,
    ERROR_INUSUFFICIENT_ARG_VALUE = 2,
    ERROR_NODE_IS_UNDEFINED = 3;

var ErrorMap = [];
ErrorMap[ERROR_INUSUFFICIENT_ARG_TYPE] = 'Insufficient argument type';
ErrorMap[ERROR_INUSUFFICIENT_ARG_VALUE] = 'Insufficient argument value';
ErrorMap[ERROR_NODE_IS_UNDEFINED] = 'Node is undefined';

/**
 * Flyweight object
 */
var ErrorLogEntry = function(errCode){
    var _errCode = errCode;
    return {
        getMessage: function(context) {
            return ErrorMap[_errCode] + " " + context.getDate();
        }
    }
};
var ErrorLogEntryContext = function(date){
    var _date = date;
    return {
        getDate: function() {
            return _date;
        }
    }
};

/**
 * FlyweightFactory object
 */
var ErrorLogEntryFactory = (function(){
    var _messages = [], _callCount = 0, _creationCount = 0;
    return {
        make : function(errCode) {
            if (typeof _messages[errCode] === 'undefined') {
                _messages[errCode] = new ErrorLogEntry(errCode);
                _creationCount += 1;
            }
            _callCount += 1;
            return _messages[errCode];
        },
        getInstanceCount: function() {

            return _creationCount;
        },
        getRequestCount: function() {
            return _callCount;
        }
    }
}());

var ErrorLogger = function(){
    var _errCodes = [], _dates = [];
    return {
        log: function(errCode) {
            _errCodes.push(ErrorLogEntryFactory.make(errCode));
            _dates.push(new ErrorLogEntryContext(new Date()));
        },
        printMessages: function() {
            _errCodes.forEach(function(logEntry, inx){
                console.log(logEntry.getMessage(_dates[inx]));
            });
        }
    }
};

/**
 * Usage
 */

var logger = new ErrorLogger();
logger.log(ERROR_INUSUFFICIENT_ARG_TYPE);
logger.log(ERROR_INUSUFFICIENT_ARG_TYPE);
logger.log(ERROR_INUSUFFICIENT_ARG_VALUE);
logger.log(ERROR_INUSUFFICIENT_ARG_TYPE);
logger.log(ERROR_NODE_IS_UNDEFINED);

logger.printMessages();

console.log(ErrorLogEntryFactory.getRequestCount() + " ErrorLogEntry instances were requested");
console.log(ErrorLogEntryFactory.getInstanceCount() + " LogEntry instances were really created");

// Output:
// Insufficient argument type Mon Dec 05 2011 13:02:30 GMT+0100
// Insufficient argument type Mon Dec 05 2011 13:02:30 GMT+0100
// Insufficient argument value Mon Dec 05 2011 13:02:30 GMT+0100
// Insufficient argument type Mon Dec 05 2011 13:02:30 GMT+0100
// Node is undefined Mon Dec 05 2011 13:02:30 GMT+0100
// 5 ErrorLogEntry instances were requested
// 3 LogEntry instances were really created

}());