# Law of Demeter (Tell, Don't Ask)

## The method on an object is allowed to interact with the following

1. Other methods on its object
2. Methods on properties of the object
3. Methods on arguments passed into the method
4. Methods on instances of new objects created inside of the method
