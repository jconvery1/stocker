Stocker - A stock management system built using Vue.js and Laravel
This web application was developed as the final year project for my computer science bachelor's degree. It is a comprehensive stock management system designed to streamline inventory control and order processing.

Technologies Used
Docker: The application is containerized using Docker, with three individual containers: Nginx (using the Nginx image), MySQL (using the MySQL image), and the project source code container. Docker offers benefits such as easy deployment, scalability, and consistency across different environments.
Vue.js and Laravel: The frontend is built using Vue.js, a progressive JavaScript framework, while the backend is powered by Laravel, a PHP web application framework. This combination provides a modern and efficient development environment for building robust web applications.
Tailwind CSS: The application's styling is implemented using Tailwind CSS, a utility-first CSS framework that allows for rapid UI development and customization.
Features
Stock Management: Users can efficiently manage stock items, including tracking quantities, prices, and suppliers.
Orders, Sales, and Deliveries: The system facilitates order processing, sales tracking, and delivery management to streamline business operations.
Supplier Management: Suppliers can be managed within the system, allowing for easy communication and order placement.
System Settings: Users can configure various system settings to customize the application according to their business requirements.
User Authentication and Authorization: The application includes secure sign-in and user creation screens. It supports two different authorization levels: managers and floor staff, allowing for granular access control.
Automated Reordering: When a stock item reaches a certain level, the system automatically triggers reordering. Additionally, when a stock item needs to be reordered, an email notification is sent to the associated supplier.
Getting Started
To get started with the application, follow these steps:

Clone the repository to your local machine.
Ensure you have Docker installed and running.
Navigate to the project directory and run docker-compose up to start the containers.
Access the application through your web browser at the specified URL.
