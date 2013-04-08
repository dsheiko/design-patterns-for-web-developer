#
# @category Design Pattern Tutorial
# @package Singleton Sample
# @author Dmitry Sheiko <me@dsheiko.com>
# @licence MIT

class Singleton:
    # Declare static property to hold a reference to the single instance
    # of Singleton
    instance = None
    # Helper class acting as a factory
    class SingletonHelper:
        def __call__( self ):
            if Singleton.instance is None :
                Singleton.instance = Singleton()
            return Singleton.instance;
    # Declare a static method, which must be used to access Singleton
    getInstance = SingletonHelper()

# Usage
print Singleton.getInstance() == Singleton.getInstance()

# Output
# True