Laravel Senior Developer Exam
Part 1: Eloquent Relationships
- [x] Question 1: One-to-Many Relationship
You are building an application. Implement a one-to-many relationship between User and Product
models where a user can have multiple products. Using
● Models: User, Product
Tasks:
- [x] 1. Create the Product model and migration.
- [x] 2. Define the one-to-many relationship in the User and Product models.
- [x] 3. Write a method in the User model to fetch all products of a user.
Expected Output:
- [x] ● User model should have a method products() returning all products by the user.

- [x] Question 2: What are the coding principles/practices you can apply in your
Code?

- Inheritance
I applied inheritance by extending the Illuminate\Database\Eloquent\Model and other classes

- Encapsulation 
The User model implements protected properties and also it parent  Illuminate\Foundation\Auth\User Illuminate\Database\Eloquent\Model also has proctected method that only its child class can access.

- Abstraction
Model is an abractract class has has implemented several interfaces that can be implemted to the class. the child class can use the method in abstract class and the abstract class should implement the interfaces declared.

- Polymorphish 
If you had a child class that extends Shape class like Circle or Square. A Cirlce and Square is also a Shape class
for example a function paramter type with Shape should be abble to accept Circle and Square class because they are all shape this is the same with Classes the implements interfaces.
See task #18.

Note: Please put your answer in README.md of the root directory of the project

Part 3: Routing and Middleware
- [x] Question 4: Custom Middleware
Create a custom middleware that checks if a user is an admin. If the user is not an admin, redirect
them to their product list page.
● Middleware Name: CheckAdmin

- [x] Part 4: Advanced Eloquent Queries
Question 5: Eloquent Scopes
Create a global scope for the Product model to only retrieve products that are not deleted.
- [x] ● Model: Product
- [x] ● Fields: id, title, body, del_flag
Tasks:
- [x] 1. Add an del_flag field to the products table.
- [x] 2. Create a global scope to filter products that are not deleted.
- [x] 3. Test the scope to ensure it works correctly.
Expected Output:
- [x] ● Product::all() should only return not deleted products.
Tasks:
- [x] 2. Create the middleware.
- [x] 3. Register the middleware.
- [x] 4. Create an admin routes access only, page will consist of user list with their products
- [x] 5. Create an admin routes access only, page will consist of product list. In this page admin
can add, edit or delete a product (if product already tag to a user product cannot be
deleted, note: can do to hide the button or click delete will pop up an error message)
- [x] 6. Apply the middleware to a route group for admin routes.
- [x] 7. admin can view all users with their products (this is the no. 3)
- [x] 8. non-admin users can (create, update, delete, view) products
- [x] 9. non-admin users can only view their product
- [x] 10. Use Observables and Eloquent
- [x] 11. Create custom command to update quantity of the products
12. Add image for each product and use ftp server(should be applied in docker) for storage
- [x] 13. Create scheduler to delete products with less than 10 quantity every monday midnight - 
See: routes/console.php
- [x] 14. Use proper status code
15. Share api used(postman, swagger, etc…) via readme
- [x] 16. Dispatch cron job via event channel to send email every time product is created
- [x] 17. The email should have link to product view
- [x] 18. Integrate https://fakestoreapi.com/ and https://fakeapi.platzi.com/ make sure to have 1 interface
to access between this 2 api. We should be able to switch from these 2 apis to add products.
interface ProductInterface
{
public function addProduct(): Response;
}
See: 
app/Providers/AppServiceProvider.php
app/Listeners/SyncProductToThirdPartyAPI.php

- [x] 19. During adding of product avoid having duplicate product names.
20. Create unit test for crud operation in products
Note: Seen Sample in tests directory
- [x] 21. Create unit test for these 2 third party api just test adding products
22. Use mysql for unit test not sqlite and should be different from the database used by the app.
23. Use caching for get all products
24. Create docker to run this app
Submission
1. Store it in your github then share it to us. Do not make it private.
