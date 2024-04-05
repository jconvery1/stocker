<p align="center">
  <img src="stocker.png" />
</p>

## 📝 Description
This web application was developed as the final year project for my computer science degree, it was the first large coding project I completed independently and although it's far from perfect it was good enough to get me a first-class honours.

Stocker is a comprehensive stock management system designed to streamline inventory control and order processing for a small shoe retailer.

## 👨‍💻 Technologies Used

- **Docker**: The application is containerized using Docker, with three individual containers: Nginx (using the Nginx image), MySQL (using the MySQL image), and the project source code container. Docker offers benefits such as easy deployment, scalability, and consistency across different environments.
- **Vue.js and Laravel**: The frontend is built using Vue.js, a progressive JavaScript framework, while the backend is powered by Laravel, a PHP web application framework. This combination provides a modern and efficient development environment for building robust web applications.
- **Tailwind CSS**: The application's styling is implemented using Tailwind CSS, a utility-first CSS framework that allows for rapid UI development and customization.

## 📱 Features

- **Stock Management**: Users can efficiently manage stock items, including tracking quantities, prices, suppliers, as well as facilitating order processing, sales tracking, and delivery management to streamline business operations. Suppliers can be managed within the system, allowing for easy communication and order placement.
- **System Settings**: Users can configure various system settings to customize the application according to their business requirements.
- **User Authentication and Authorization**: The application includes secure sign-in and user creation screens. It supports two different authorization levels: managers and floor staff, allowing for granular access control.
- **Automated Reordering**: When a stock item reaches a certain level, the system automatically reorders this item based on an amount configured by the user.
- **Email Functionality**: An email is sent to the associated supplier when a stock item is reordered.

## 🚀 Getting Started

To get started with the application, follow these steps:

1. Clone the repository to your local machine.
2. Ensure you have Docker installed and running.
3. Navigate to the project directory.
4. Run `docker-compose up` to start the containers.
5. Ensure `DB_HOST` in your .env file is set to `127.0.0.1`.
6. Run `php artisan migrate:fresh --seed` to migrate and seed the database.
7. Change `DB_HOST` in your .env file to `mysql`.
8. Access the application through your web browser (http://localhost:8888/sign-in).
9. Create an account and sign in with your credentials or sign in with one of the existing accounts (usernames and passwords can be found in the users migration file).

Note: 'composer install' may need ran in the project directory, this will import the packages and create the vendor folder.
