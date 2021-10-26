# TUI technical test solution
This repository contains the solution to TUI technical test.

**Developed by**: Emilio D. Clemente Silmi.

## Development environment
This project can be run with Docker, following these instructions.
1. Build the docker image
    ```
    docker build -t tui-app .
    ```
2. Bring up the container
    ```
    docker run -itd --rm --name tui-app tui-app
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