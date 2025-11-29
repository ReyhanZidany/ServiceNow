# ServiceNow - Helpdesk Management System

A web-based helpdesk application developed to streamline issue reporting, 
tracking, and resolution processes.

## 📋 Features
- ✅ Ticket creation & management
- ✅ PIC assignment & tracking
- ✅ File upload & attachment support
- ✅ Activity logging & history
- ✅ Responsive web interface
- ✅ User authentication

## 🛠️ Tech Stack
| Component | Technology |
|-----------|------------|
| Backend | Laravel 9 |
| Frontend | React 18 |
| Database | MySQL 5.7 |
| UI Framework | Tailwind CSS |
| Styling | Tailwind CSS |
| Version Control | Git |

## 📦 Installation & Setup

### Prerequisites
- PHP 8.1+
- Node.js 16+
- MySQL 5.7+
- Composer
- npm

### Backend Setup
`````bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
`````

### Frontend Setup
`````bash
cd frontend
npm install
npm start
`````

**Access:** http://localhost:3000

## 🎯 Key Achievements
- ✨ Deployed in production serving 500+ daily users
- ⚡ Optimized database queries achieving 35% faster performance
- 📊 95+ Lighthouse performance score
- 🔒 Secure file upload with validation

## 📸 Screenshots
[Add screenshots here]

## 🚀 Deployment
- **Live Demo:** [Add link if deployed]
- **Docker:** 
`````bash
  docker-compose up
`````

## 🔗 Related
- [GitHub Repository](https://github.com/ReyhanZidany/ServiceNow)
- Experience: [PT. IPC Terminal Petikemas Internship](https://github.com/ReyhanZidany)

---

### Project 2: Mr-Beans-App (E-commerce)
`````markdown
# Mr-Beans-App - Coffee Shop E-Commerce Platform

A modern React-based e-commerce web application for coffee shop business. 
Customers can browse menu, manage shopping cart, and process purchases.

## 🎯 Features
- ✅ Product browsing & filtering
- ✅ Shopping cart management
- ✅ User authentication & profiles
- ✅ Order history tracking
- ✅ Responsive design (mobile-first)
- ✅ Search functionality

## 🛠️ Tech Stack
| Layer | Technology |
|-------|-----------|
| Frontend | React 18 |
| State Management | Redux / Context API |
| Routing | React Router v6 |
| Styling | Tailwind CSS |
| HTTP Client | Axios |
| Backend | [Your backend tech] |

## 📦 Installation
````bash
npm install
npm start
````

## 🎨 UI/UX Highlights
- Intuitive product browsing interface
- Smooth shopping cart experience
- Mobile-responsive design
- Fast page load times

## 📸 Screenshots
[Add screenshots]

## 🔗 Live Demo
- **Website:** [Add deployed link]

## 📚 Learning Outcomes
- React hooks & state management
- E-commerce flow design
- Responsive web design
- User authentication

---

### Project 3: DipoHelp (Ticket System)
````markdown
# DipoHelp - Ticket Management System

Ticket management application designed for university/organization to streamline 
issue reporting and track resolution processes.

## ✨ Features
- ✅ Issue/ticket creation
- ✅ Status tracking (Open, In Progress, Resolved)
- ✅ Priority levels
- ✅ Admin dashboard
- ✅ Real-time notifications
- ✅ Comment/discussion threads

## 🛠️ Tech Stack
- **Backend Framework:** Laravel
- **Template Engine:** Blade
- **Frontend:** HTML/CSS/JavaScript
- **Database:** MySQL
- **Server:** Apache/Nginx

## 📦 Setup
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## 🎯 Key Features
- User-friendly ticket creation process
- Real-time status updates
- Admin management panel
- Ticket history & analytics

## 📸 Screenshots
[Add screenshots]

## 🚀 Deployment
```bash
docker build -t dipohelp .
docker run -p 8000:8000 dipohelp
```

---

## PRIORITY 3: ADD VISUAL ELEMENTS (1 Hour)

### 3.1 Add Badges to Each README
```markdown
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![React](https://img.shields.io/badge/React-61DAFB?style=for-the-badge&logo=react&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
```

Source: https://badges.fyi/ or https://github.com/Ileriayo/markdown-badges

### 3.2 Add Code Quality Badges
```markdown
![Status](https://img.shields.io/badge/status-active-success.svg)
![Maintained](https://img.shields.io/badge/Maintained%3F-yes-green.svg)
```

---

## PRIORITY 4: DEPLOYMENT & LINKS (1-2 Hours)

### Add Live Demo Links
For each project, add section:
```markdown
## 🚀 Live Demo
- **Website:** https://[your-deployed-app].com
- **API Documentation:** https://[your-api-docs].com
```

**Deployment Options:**
- **Frontend (React):** Vercel, Netlify (free tier)
- **Backend (Laravel):** Railway, Render, Heroku (free tier ending)
- **Full-stack:** Azure, AWS free tier

---

## PRIORITY 5: GITHUB REPO DESCRIPTIONS (15 mins)

### Update each repo description (shown on profile):

**ServiceNow:**
````
Helpdesk management system | Laravel + React | 500+ daily users | Production-ready
`````

**Mr-Beans-App:**
