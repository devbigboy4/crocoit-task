
# 📦 CrocoIt Task

Welcome to the **CrocoIt Task** project! This is a robust and scalable task designed for a Manage Articles platform built with Laravel. 

## 🛠 Features

- **Multi-Role Authentication**: Facilitated distinct access levels for users, admins.
- **Category and Tag Management**: Manage Articles categories and Categories.

## 📜 Technologies Used

- **Laravel**: The PHP framework used for building the task.
- **MySQL**: Database management system.
- **Git**: Version Controller
- **Linux**: Operating System.


## 🗂 Database Schema

The database consists of the following tables:

- **Users**: 
- **Admins**: 
- **Categories**: 
- **Articles**: 

## 🔗 API Routes

### Auth Routes

- **USer Routes**:
  - `POST /login`: Login
  - `POST /register/user`: Register user
  - `POST /register/admin`: Register admin
  - `POST /password/forgot`: Forgot Password
  - `POST /password/reset`: Reset Password

- **Authenticated Routes**:
  - `POST /auth/logout`: Logout
  - `GET /auth/profile`: View Profile
  - `POST /auth/profile`: Update Profile
  - `POST /auth/password/change`: Change Password


### Category Routes

- `GET /admin/categories`: List Categories



### Product Routes

- `GET /articels`: List Articels




## 🛠 Installation

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/devbigboy4/crocoit-task.git
   ```

2. **Navigate to the Project Directory:**

   ```bash
   cd your-repository
   ```

3. **Install Dependencies:**

   ```bash
   composer install
   ```

4. **Set Up Environment File:**

   Copy `.env.example` to `.env` and configure your database and other environment variables.

   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key:**

   ```bash
   php artisan key:generate
   ```

6. **Run Migrations:**

   ```bash
   php artisan migrate
   ```

7. **Start the Development Server:**

   ```bash
   php artisan serve
   ```

## 💡 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or fix.
3. Make your changes and test thoroughly.
4. Submit a pull request with a clear description of your changes.

## 📜 License

This project is licensed under the [MIT License](LICENSE).
