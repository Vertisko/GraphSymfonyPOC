# GraphQL POC in PHP

This project is a proof of concept to test graphQL usage in PHP.  
This work is based mainly on [Symfony framework](https://github.com/symfony/symfony/tree/4.0) and [overblog/GraphQLBundle](https://github.com/overblog/GraphQLBundle/tree/0.11).

This project implements :

* Type system
    * :heavy_check_mark: Scalars
    * :heavy_check_mark: Object
    * :heavy_check_mark: Interface
    * :heavy_check_mark: Union
    * :heavy_check_mark: Enum
    * :heavy_multiplication_x: Input Object
    * :heavy_check_mark: Lists
    * :heavy_check_mark: Non-Null
* Concepts :
    * :heavy_check_mark: Resolver
    * :heavy_check_mark: Query
    * :heavy_multiplication_x: Type Inheritance
    * :heavy_multiplication_x: Pagination
    * :heavy_multiplication_x: Mutation
    * :heavy_multiplication_x: Promise
    
## Requirement

* git
* composer
* PHP 7.1.3 or higher
* PDO-SQLite PHP extension enabled
* [a Symfony 4.1 compatible environment](https://symfony.com/doc/current/reference/requirements.html)

## Installation

Retrieve repository : 

```
$ git clone git@github.com:Samffy/graphql-poc.git
```

Go to the project directory : 

```
$ cd graphql-poc
```

Install and launch project using : 

```
$ make deploy
```

Go to : http://localhost:8000/graphiql

In `dev` mode, Symfony profiler is available at `/_profiler`.

## GraphQL

### Schema

You can consult the graphQL schema here :  
https://github.com/Samffy/graphql-poc/blob/master/config/graphql/schema.graphql

If you update this project, you can dump the new version of the GraphQL schema using this command : 

```
$ bin/console graphql:dump-schema --format=graphql --file=./config/graphql/schema.graphql
```

## Queries

This project use 2 mains types : `Person` and `Vehicle`  
A person has a `Pet` and one `Vehicle` or more.   
A `Pet` can be a `Dog`, a `Cat` or a `Bear`.  
A `Vehicle` can be a `Car` or a `Truck`.

Here is an example of a graphQL query :

```graphql
{
  persons(id: "duffy") {
    id
    name
    birth_date
    created_at
    pet {
      ...on Animal {
        id
        name
        breed
      }
    }
    vehicles {
      id
      manufacturer
      model
      ...on Car {
        seats_number
      }
      ...on Truck {
        maximum_load
      }
    }
  }
}
```
