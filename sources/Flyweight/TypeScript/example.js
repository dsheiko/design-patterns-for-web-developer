"use strict";
var ERROR_INUSUFFICIENT_ARG_TYPE = 1;
var ERROR_INUSUFFICIENT_ARG_VALUE = 2;
var ERROR_NODE_IS_UNDEFINED = 3;
var errorMap = [];
var logger;

var ErrorLogEntryContext = (function () {
    function ErrorLogEntryContext(date) {
        this.date = date;
    }
    ErrorLogEntryContext.prototype.getDate = function () {
        return this.date;
    };
    return ErrorLogEntryContext;
})();
var ErrorLogEntry = (function () {
    function ErrorLogEntry(errCode) {
        this.errCode = errCode;
    }
    ErrorLogEntry.prototype.getMessage = function (context) {
        return errorMap[this.errCode] + " " + context.getDate();
    };
    return ErrorLogEntry;
})();
var ErrorLogEntryFactory = (function () {
    function ErrorLogEntryFactory() {
        this.messages = {
        };
        this.callCount = 0;
        this.creationCount = 0;
    }
    ErrorLogEntryFactory.prototype.make = function (errCode) {
        if(typeof this.messages[errCode] === 'undefined') {
            this.messages[errCode] = new ErrorLogEntry(errCode);
            this.creationCount += 1;
        }
        this.callCount += 1;
        return this.messages[errCode];
    };
    ErrorLogEntryFactory.prototype.getInstanceCount = function () {
        return this.creationCount;
    };
    ErrorLogEntryFactory.prototype.getRequestCount = function () {
        return this.callCount;
    };
    return ErrorLogEntryFactory;
})();
var ErrorLogger = (function () {
    function ErrorLogger(factory) {
        this.errCodes = [];
        this.dates = [];
        this.factory = factory;
    }
    ErrorLogger.prototype.log = function (errCode) {
        this.errCodes.push(this.factory.make(errCode));
        this.dates.push(new ErrorLogEntryContext(new Date()));
    };
    ErrorLogger.prototype.printMessages = function () {
        var that = this;
        this.errCodes.forEach(function (logEntry, inx) {
            console.log(logEntry.getMessage(that.dates[inx]));
        });
    };
    ErrorLogger.prototype.getInstanceCount = function () {
        return this.factory.getInstanceCount();
    };
    ErrorLogger.prototype.getRequestCount = function () {
        return this.factory.getRequestCount();
    };
    return ErrorLogger;
})();
errorMap[ERROR_INUSUFFICIENT_ARG_TYPE] = 'Insufficient argument type';
errorMap[ERROR_INUSUFFICIENT_ARG_VALUE] = 'Insufficient argument value';
errorMap[ERROR_NODE_IS_UNDEFINED] = 'Node is undefined';
logger = new ErrorLogger(new ErrorLogEntryFactory());
logger.log(ERROR_INUSUFFICIENT_ARG_TYPE);
logger.log(ERROR_INUSUFFICIENT_ARG_TYPE);
logger.log(ERROR_INUSUFFICIENT_ARG_VALUE);
logger.log(ERROR_INUSUFFICIENT_ARG_TYPE);
logger.log(ERROR_NODE_IS_UNDEFINED);
logger.printMessages();
console.log(logger.getRequestCount() + " ErrorLogEntry instances were requested");
console.log(logger.getInstanceCount() + " LogEntry instances were really created");
