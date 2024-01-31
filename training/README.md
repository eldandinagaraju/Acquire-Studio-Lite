# Setting up project

### Prerequisites

- Docker
- Docker Compose

# Setting up local environment

Clone the Repo, Change into the repo directory and run the following commands 

### Build the containers

`./dev-env build`

### Initialize the MySQL DB

`./dev-env init`

### Use the start Command to start all containers

`./dev-env`

### Connecting to local MySQL DB

`./dev-env run ci-api mysql`



# Writing and executing database migrations

### Create a migration file

`./dev-env run ci-api phinx create MigNameGoesHere`

### Run migrations

`./dev-env run ci-api phinx migrate`
