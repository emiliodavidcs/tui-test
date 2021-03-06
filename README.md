# TUI technical test solution
This repository contains the solution to TUI technical test.

**Developed by**: Emilio D. Clemente Silmi.

## Development environment
This project can be run with Docker, following these instructions.
1. Build the docker image
    ```
    docker build -t tui-app .
    ```
2. Bring up the container (replace <your_valid_key> with a valid Weather API key)
    ```
    docker run -itd -v `pwd`:/var/www/tui-app -e WEATHER_API_KEY=<your_valid_key> --rm --name tui-app tui-app
    ```  
3. Check that container is running
    ```
    docker ps -f name=tui-app
    ```
    
If the last command outputs something like this, then the development environment is ready to use
```
CONTAINER ID   IMAGE     COMMAND                  CREATED         STATUS         PORTS     NAMES
fc9ca3ee2062   tui-app   "docker-php-entrypoi…"   3 minutes ago   Up 3 minutes             tui-app
```

To stop the container
```
docker stop tui-app
```

## Running the application
Make sure dependencies are insalled, if they are not, install them with the following command
```
docker exec -it tui-app composer install
```
To run the application and get the forecast messages in screen, run the following command
```
docker exec -it tui-app php app.php
```

## Tests
To run PHPUnit tests, execute the following command
```
docker exec -it tui-app vendor/bin/phpunit tests
```

## Standards

### PSR
The code follows PSR standards, in order to comply with them, a tool called PHP CS Fixer is used. [Click here](https://github.com/FriendsOfPHP/PHP-CS-Fixer) for more information.

To execute this tool and fix anything that does not comply with the standard, run the following command
```
docker exec -it tui-app vendor/bin/php-cs-fixer .
```

### Static code analyser
The project contains a static code analyser as well, in order to execute it and see any possible errors run the following command
```
docker exec -it tui-app vendor/bin/phpstan analyse -l 6 src tests
```

# TUI technical test solution (PART II)

## API Design

### Endpoints to set the forecast for a specific city

- Create a forecast
    - Endpoint
        ```
        POST /api/v3/forecasts
        ```

    - Payload
        ```
        {
            "city": {
                "id": 1,
                ...
            },
            "date": "2021-11-01",
            "condition": "Sunny",
            ...
        }
        ```
        
    - Possible responses
        - HTTP 201
            ```
            {
                "id": 1,
                "city": {
                    "id": 1,
                    ...
                },
                "date": "2021-11-01",
                "condition": "Sunny",
                ...
            }
            ```
        - HTTP 400
            ```
            {
                "message": "The city already has a forecast for that date"
            }
            ```
            ```
            {
                "message": "The property 'city/date/condition' is required"
            }
            ```
            ```
            {
                "message": "City does not exist"
            }
            ```
        
- Update a forecast
    - Endpoint
        ```
        PATCH /api/v3/forecasts/{id}
        ```
    
    - Payload
        ```
        {
            "condition": "Cloudy"
        }
        ```
        
    - Possible responses
        - HTTP 200
            ```
            {
                "id": 1,
                "city": {
                    "id": 1,
                    ...
                },
                "date": "2021-11-01",
                "condition": "Cloudy",
                ...
            }
            ```
        - HTTP 400
            ```
            {
                "message": "The property 'condition' is required"
            }
            ```
        - HTTP 404
            ```
            {
                "message": "Forecast does not exist"
            }
            ```
        
    
    
 
 ### Endpoint to read the forecast for a specific city
 
- Endpoint
    ```
    GET /api/v3/forecasts
    ```
- Query parameters
    - **city**: unique identifier of the city of the forecast to retrieve
    - **date**: date of the forecast to retrieve
    
- Example
    ```
    GET /api/v3/forecasts?city=1&date=2021-11-01
    ```

- Response
    
    HTTP 200
    ```
    [
        {
            "id": 1,
            "city": {
                "id": 1
            },
            "date": 2021-11-01,
            "condition": "Cloudy"
        }
    ]
    ```
