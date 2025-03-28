# URL Shortener

URL Shortener is an open-source application for shortening URLs with basic features and simple analytics. Built with **Laravel** (backend) and **Vue.js** (frontend), this project is ideal for self-hosted deployment. **Note: This project is still a work in progress (WIP).**

## ✨ Features

- 🔗 **Shorten URL** – Convert long URLs into short, easy-to-share links.
- 🎨 **Dashboard** – View and manage shortened URLs.
- 📊 **Click Tracking** – Track the number of clicks on each link.
- 🏷 **Custom Slug** – Create custom short URLs with personalized slugs.
- 🔒 **Authentication** – Users can log in to manage their URLs.
- 📅 **Expiring Links** – Set expiration dates for short URLs (Coming Soon!).
- 📈 **Analytics** – View click statistics by time and location (Coming Soon!).

## 🚀 Technology Stack

- **Backend**: Laravel 11 + Sanctum (for API authentication)
- **Frontend**: Vue 3 + Vite + Tailwind CSS
- **Database**: MySQL / PostgreSQL
- **Cache**: Redis (for optimized redirects)

## 📥 Installation

### 1️⃣ Clone the Repository
```sh
git clone https://github.com/username/url-shortener.git
cd url-shortener
```

### 2️⃣ Install Dependencies
```sh
composer install
npm install
```

### 3️⃣ Setup Environment
Create a `.env` file and configure the database:
```sh
cp .env.example .env
php artisan key:generate
```
Edit `.env` to set up the database connection:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4️⃣ Migrate the Database
```sh
php artisan migrate
```

### 5️⃣ Run the Server
```sh
php artisan serve
npm run dev
```

Access the application at `http://localhost:8000` 🚀

## 📌 API Endpoints

| Method | Endpoint        | Description                 |
|--------|----------------|-----------------------------|
| POST   | `/shorten`      | Shorten a URL              |
| GET    | `/{shortCode}`  | Redirect to the original URL |
| GET    | `/dashboard`    | Display created short URLs |

## 🤝 Contributing

1. Fork this repository.
2. Create a new branch (`feature/your-feature-name`).
3. Commit your changes (`git commit -m 'Add feature X'`).
4. Push to the branch (`git push origin feature/your-feature-name`).
5. Create a Pull Request.

## 📜 License
This project is licensed under the **MIT License**.

---

**🌟 Star**: If you find this project useful, consider giving it a star on [GitHub](https://github.com/codewithrafli/shortly).

