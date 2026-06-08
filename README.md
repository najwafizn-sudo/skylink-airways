# Skylink Airways- Maximize ticket revenue of an airline
## Project Overview
SkyLink Airways Optimization System is a web-based Decision Support System developed using PHP and MySQL. The system is designed to assists airline management in optimizing passenger allocation and maximizing revenue using Linear Programming techniques.

Users can input ticket prices, aircraft capacity and weight constraints anthe the system calculates the optimal number of passengers for each class (Economy and Business) to maximize total revenue. 

## Features

Flight & Budget Optimization

Linear Programming Calculation

Real-Time Result Display

Constraint-Based Decision Support 

MySQL Database Integration

Responsive Bootstrap Interface


## Technologies Used

PHP

MySQL

HTML5

XAMPP

phpMyAdmin

GitHub


## System Modules
### Home Page
Provides an overview of SkyLink Airways and the system purpose including airline optimization objectives.

### Flight Optimization Module

Users enter:

### General Specifications 
Flight/Scenario Reference Title 

### Objective Coefficients
Economy Ticket Price (RM 350.00)
Business Ticket Price (RM 950.00)

### System Constraints & Limitations
Maximum Cabin Capacity 
Maximum Payload Weight 
Average Weight per Economy Passenger
Average Weight per Business Passenger

Users then click:
Run Optimization Model

### Result Module
Displays:

Optimal Number of Economy Passengers

Optimal Number of Business Passengers

Maximum Revenue Generated

Resource Usage (Seats & Weight Utilization)

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
Objective Function:
Maximize
Z = 350X + 950Y
Where:

X = Number of Economy Passengers
Y = Number of Business Passengers


Constraints:

Seat Capacity Constraint
X + Y ≤ 180

Weight Constraint
100X + 140Y ≤ 22000

Non-negativity
X ≥ 0, Y ≥ 0

Result:

Economy Passengers = 140

Business Passengers = 40

Maximum Revenue = RM 83,000


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
