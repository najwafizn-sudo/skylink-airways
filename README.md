# skylink airways- Maximize ticket revenue of an airline
## Project Overview
SkyLink Airways Optimization System (SAOS) is a web-based Decision Support System developed using PHP and MySQL. The system assists airline management in optimizing flight operations, budget allocation and resource utilization using Linear Programming techniques.

Users can input flight routes, operational costs, passenger demand, and resource constraints to generate optimal decisions that maximize profit while maintaining operational efficiency.

## Features

User Registration and Login 

Secure Password Hashing 

Flight & Budget Optimization

Linear Programming Calculation

Real-Time Result Interpretation

Optimization History Storage

MySQL Database Integration

Responsive Bootstrap Interface


## Technologies Used

PHP

MySQL

HTML5

XAMPP

phpMyAdmin


## System Modules
### Home Page
Provides an overview of SkyLink Airways and the system purpose including airline optimization objectives.

### User Authentication

Register Account

Login Account

Logout Session

### Flight Optimization Module

Users enter:

Flight Route / Operation Name

Expected Passenger Demand

Operational Costs (fuel, crew, maintenance)

Aircraft Capacity Constraints

Available Fleet Resources

The system calculates the optimal allocation of flights and resources.

### Result Module
Displays:

Optimal Number of Flights per Route

Maximum Profit / Revenue

Resource Usage Summary (aircraft, crew, fuel)

Strategic Recommendations


### History Module
Stores and displays previous optimization results for management review.

## Database
Database Name:
skylink_db
Tables:

users
flight_optimization

Import:
skylink_db.sql
using phpMyAdmin before running the system.

## Installation Guide
### Step 1
Install XAMPP

### Step 2
Start:

Apache

MySQL

### Step 3
Copy project folder into:
xampp/htdocs/

### Step 4
Open phpMyAdmin:
http://localhost/phpmyadmin

### Step 5
Create database:
skylink_db

### Step 6
Import:
skylink_db.sql

### Step 7
Open system:
http://localhost/SAOS

### Example Case Study
Flight Route Optimization
Objective Function:
Maximize Z = 120X + 90Y
Where:

X = Domestic Flight Route
Y = International Flight Route

Constraints:
200X + 300Y ≤ 5000  (Fuel Capacity)
5X + 8Y ≤ 120       (Crew Availability)
X + Y ≤ 40          (Fleet Limit)

Result:

Domestic Flights = 20
International Flights = 10
Maximum Profit = 3,900


## Project Members

Norafiqah Najwa binti Mohd Afizan 2240244

Nurien Aina binti Abdul Halim 2240246

Muhammad Afiq Aiman bin Noor Kamaruzaman 2240237

Ilham Fariq bin Shaharuddin 2240234

## Course Information
Course: Operational Research

Project Title:
SkyLink Airways Optimization System
Academic Year: 2025/2026

## License
This project was developed for academic and educational purposes.
