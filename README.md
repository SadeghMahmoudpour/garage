# Machine Requirements

For this challenge to run, you'll have to have Docker running or have PHP running locally on your machine.

This README assumes you're using Docker to run the challenge.

1. Start the Docker containers; `docker compose up -d`

2. Run your tests; `docker compose exec app vendor/bin/phpunit .`

3. Stop the docker containers; `docker compose down`

Without further ado - good luck with the challenge and, even more importantly, HAVE FUN!

# Assumptions and design decisions

## Project Approach

For this test project, I chose to implement a rich model design pattern. The use of rich models allowed me to
encapsulate both data and behavior within the domain model, promoting a more cohesive and maintainable solution. This
approach enhances the clarity and readability of the code, fostering a robust foundation for future scalability and
modification.

## System Implementation

### Dynamic Floors and Vehicle Restrictions

This garage system is designed to be flexible, accommodating any number of floors dynamically. Each floor can specify
excluded vehicle types, allowing for specific restrictions such as preventing vans from parking on the first floor.

### Interface Abstraction

To promote modularity and flexibility, three interfaces are employed:

**FloorInterface**: Defines methods for checking whether a floor accepts a particular vehicle and parking a vehicle on
that
floor.  
**ParkingInterface**: Mirrors the FloorInterface with methods for checking if parking is accepted and parking a
vehicle.    
**VehicleInterface**: Ensures a consistent interface for vehicle classes, allowing seamless integration into the garage
system.

### Vehicle Classes

#### Vehicle Hierarchy
The vehicle hierarchy in this garage system is structured around a base class, **Vehicle**, which serves as the foundation
for specific vehicle types. Three distinct classes, namely **Car**, **Motorcycle**, and **Van**, extend the Vehicle base class.

## Testing Approach

### Stubs for Isolated Testing

To ensure the robustness and reliability of the garage system, a testing approach leveraging stubs was adopted. Stubs,
such as VehicleStub and FloorStub, were created to simulate the behavior of interfaces without relying on the actual
implementations.

**VehicleStub**: A stub implementing the VehicleInterface, designed to provide controlled responses for testing the
interactions with vehicle-related functionalities.

**FloorStub**: A stub implementing FloorInterface, facilitating isolated testing of the
parking model.

### Table-Driven Testing for Comprehensive Coverage

Table-driven testing was employed to achieve thorough coverage of various test cases. Different scenarios and inputs
were systematically organized in tables, allowing for a structured and efficient testing approach.