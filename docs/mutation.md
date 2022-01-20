# AvoRed GraphQL API mutations

AvoRed GraphQL API mutation is one way of modifying or creating the avored GraphQL server-side data and in return, it will send the success information or created or newly updated server data. 

#### Login Mutation

Login mutation is used to login a customer to a server and so in response you will get the token to validate the user. 

Query Request: 

     mutation VisitorLogin (
        $password: String!
        $email: String!
      ){
      login (
        email: $email
        password: $password
      ){
        token_type
        access_token
        expires_in
        refresh_token
      }
    }

Query Response:

    {
      "data": {
        "login": {
            "token_type": "Bearer",
            "access_token": "eyJ0eXAi********",
            "expires_in": 31536000,
            "refresh_token": "25847f285271*********"
        }
      }
    } 

#### Register Mutation

Register mutation is used to register a customer to a server and so in response you will get the token to validate the user. 

Query Request: 

    mutation CustomerRegistration (
        $email: String!
        $password: String!
        $first_name: String!
        $last_name: String!
    ) {
        register (
          first_name: $first_name,
          last_name: $last_name,
          email: $email,
          password: $password
        ) {
          access_token
        }
    }

Query Response:

    {
      "data": {
          "register": {
              "token_type": "Bearer",
              "access_token": "eyJ0eXAiOiJKV1QiLCJh*********",
              "expires_in": 31536000,
              "refresh_token": "def50200aff4577346c64f7eaabdfbdda9b3ae7d641f48a*****"
          }
      }
    }