# DEVOM CODE CONVENTION


### FILE STRUCTURE
Domain:
```
Appto/[BoundedContext]/Domain/[Aggregate]/[RootAggregate, Entities, ValueObjects]
```
Application:
```
Appto/[BoundedContext]/Application/[Aggregate]/Command
Appto/[BoundedContext]/Application/[Aggregate]/Query
```
Infrastructure:
```
Appto/[BoundedContext]/Infrastructure/[Aggregate]
```

##### COMMON
- Appto/Common
    - The Common Value Objects for your Bounded Context
    - The General Common Value Objects Candidate
        > When the Value Object is generic, and it is tested you should move to the appto/php-value-objects repository
    - Other libraries separated by layers (application, infrastructure)
     


### TESTS
Our tests, try to cover the most fundamentals parts of the application

Unit Test:

Test files need to have the same folder structure than code structure

- Domain
- Application services if there is complexity

Acceptance Test:
- Behat for endpoints. 


### 
