#
# @category Design Pattern Tutorial
# @package Registry Sample
# @author Dmitry Sheiko <me@dsheiko.com>
# @licence MIT

class Registry:
    # Declare static property to hold a reference to the single instance
    # of Registry
    instance = None
    # Declare registry data container
    __data = {};
    # Helper class acting as a factory for singleton
    class RegistryHelper:
        def __call__( self ):
            if Registry.instance is None :
                Registry.instance = Registry()
            return Registry.instance;
    # Declare a static method, which must be used to access Registry
    getInstance = RegistryHelper()
    # Mutator method
    def set(self, name, value):
        self.__data[name] = value
    # Accessor method
    def get(self, name):
        return self.__data[name]

# Usage

Registry.getInstance().set("Foo", "Bar")
print Registry.getInstance().get("Foo")

# Output
# Bar