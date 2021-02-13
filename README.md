# Products REST API

## API Endpoints
- List: [GET] /api/product/
- Show: [GET] /api/product/{productId}
- Create: [POST] /api/product/{productId}
- Update: [PUT] /api/product/{productId}
- Delete: [DELETE] /api/product/{productId}

### Data format:

## Framework and packages
- Lumen 8.x (https://lumen.laravel.com/docs/8.x)

## Environment
- Apache
- PHP 8.x
- MySQL 8.x

## Setting up using docker
- Install Docker (https://www.docker.com/get-started)

### Running Instance
In the root of the repo directory run the following command
> docker-compose up -d
 
### Run migration
Run the following command to configure the project after the docker containers up and running
> docker exec -it web bash
> 
> cp .env.example .env
> 
> php artisan migrate:fresh --seed
> 

### Shutdown the instance
> docker-compose down
> 
Data will need to re-seed after containers are destroy

## Accessing the API
http://localhost:480/api/product
