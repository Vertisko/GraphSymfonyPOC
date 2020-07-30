# GraphQL POC in PHP

This project is a proof of concept to test graphQL usage in PHP.  
This work is based mainly on [Symfony framework](https://github.com/symfony/symfony/tree/4.1) and [overblog/GraphQLBundle](https://github.com/overblog/GraphQLBundle/tree/0.11).

This project implements :

## Requirement

* git
* composer
* PHP 7.1.3 or higher
* [a Symfony 4.4 compatible environment](https://symfony.com/doc/4.4/setup.html#technical-requirements)

## Installation


Install and launch project using : 

```
$ make deploy
```

Endpoints: 

http://localhost:8000/graphiql - graphiQL IDE 
http://localhost:8000/ - postman/curl/what ever GraphQL client

In `dev` mode, Symfony profiler is available at `/_profiler`.  

## GraphQL

### Schema

You can consult the graphQL schema here :  
https://github.com/Samffy/graphql-poc/blob/master/config/graphql/schema.graphql

If you update this project, you can dump the new version of the GraphQL schema using this command : 

```
$ bin/console graphql:dump-schema --format=graphql --file=./config/graphql/schema.graphql
```

### Queries

This project use 2 mains types : `Person` and `Vehicle`  

Here is an example of a graphQL query :

```graphql
{
    {
        allPersons (last: 1){
            id
            title
            birthDate
            vehicles {
                id
                manufacturer
            }
            pet {
                name
            }
        }
    }
}
```


### Mutations

Some examples of mutations on Car/Vehicle Entity

```graphql
mutation CreateCarMutation($carInput: CarInput!){
    createCarMutation(input: $carInput)
    {
        model
        manufacturer
        class
    }
}

{   
    "carInput": {
        "id": "VmVoaWNsZTox", 
        "manufacturer": "DMC", 
        "model": "DeLorean DMC-12", 
        "seats_number": 4
    }
}
```

```graphql
mutation UpdateCarMutation($carInput: CarInput!) {
    updateCarMutation(input: $carInput) {
        manufacturer
    }
}

{   
    "carInput": {
        "id": "VmVoaWNsZTox", 
        "manufacturer": "CX",
        "model": "XZ",
        "seats_number": 4
    }
}
```


```graphql
mutation DeleteVehicleMutation($idInput: IdInput!){
        deleteVehicleMutation(input: $idInput)
}

{
    "idInput": {
        "id": "Q2FyOjE0"
    }

}
```

You can find many examples in the [functional tests](tests/features/bootstrap/resources/graphql_query).

## Developer tools

This project use `Makefile` to simplify application usage.  
[Take a look](Makefile), you will find some useful commands.


### Fixtures

If you corrupt data you can drop database and reload fixtures using this command : 

```
$ make install
```

### Tests

There is some functional tests, read it to see some useful examples.  
It basically launch [queries](tests/features/bootstrap/resources/graphql_query/) and check response.  

To launch them use : 

```
$ make integration
```

:warning: It will truncate database and dump default fixtures.
