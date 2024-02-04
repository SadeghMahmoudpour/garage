# Machine Requirements

For this challenge to run, you'll have to have Docker running or have PHP running locally on your machine.

This README assumes you're using Docker to run the challenge.

1. Start the Docker containers; `docker compose up -d`

2. Run your tests; `docker compose exec app vendor/bin/phpunit .`

3. Stop the docker containers; `docker compose down`

4. Run application command; `docker compose exec app php index.php`

# Assumptions and design decisions

## Project Approach

For this test project, I chose to implement a rich model design pattern. The use of rich models allowed me to
encapsulate both data and behavior within the domain model, promoting a more cohesive and maintainable solution. This
approach enhances the clarity and readability of the code, fostering a robust foundation for future scalability and
modification.

## Project Architecture

Our project follows the principles of Hexagonal Architecture, separating concerns into distinct layers: *Application*, *Domain*, and *Infrastructure*.

### Application Layer

In the `src/application` directory, we organize our use cases into the `usecases` directory, which contains the following commands:

1. *CheckCapacity Command:*
    - Responsible for checking the capacity of the parking system for given vehicle type.

2. *CreateParking Command:*
    - Handles the creation of a parking facility.

3. *ParkVehicle Command:*
    - Manages the parking of a vehicle within the system.

### Domain Layer

The core business logic resides in the `src/domain` directory. It includes the following components:

- *exceptions:*
    - Exception classes for handling domain-specific errors.

- *models:*
    - Model classes representing core domain entities.

- *repositories:*
    - The `src/domain/repositories` directory includes outbound repository interfaces, defining contracts for interacting with external systems or databases.

- *services:*
    - Contains domain services responsible for encapsulating domain logic that doesn't naturally fit into a specific entity.

### Infrastructure Layer

In the `src/infrastructure` directory, we organize our infrastructure-related code into the following directories:

- *console:*
    - Contains console-related functionality, allowing interaction with the command line.

- *repository:*
    - Implements the outbound repository interfaces defined in the domain layer. These implementations handle interactions with external systems, such as databases.

### Future Considerations

As our project evolves, we will continue to adhere to the principles of Hexagonal Architecture, ensuring a clear separation of concerns and flexibility in adapting to changing requirements.

## System Implementation

### Dynamic Floors and Vehicle Restrictions

This garage system is designed to be flexible, accommodating any number of floors dynamically. Each floor can specify
excluded vehicle types, allowing for specific restrictions such as preventing vans from parking on the first floor.

### Vehicle Classes

#### Vehicle Hierarchy
The vehicle hierarchy in this garage system is structured around a base class, **Vehicle**, which serves as the foundation
for specific vehicle types. Three distinct classes, namely **Car**, **Motorcycle**, and **Van**, extend the Vehicle base class.

## Testing Approach

### Stubs for Isolated Testing

To ensure the robustness and reliability of the garage system, a testing approach leveraging stubs was adopted. Stubs,
such as FloorStub and ParkingRepositoryStub, were created to simulate the behavior of them without relying on the actual
implementations.

### Table-Driven Testing for Comprehensive Coverage

Table-driven testing was employed to achieve thorough coverage of various test cases. Different scenarios and inputs
were systematically organized in tables, allowing for a structured and efficient testing approach.