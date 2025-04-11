# 🍽️ DineWise RMS — Restaurant Management System

## 🚀 Overview

**DineWise RMS** is a smart restaurant management software designed to **streamline operations and enhance the dining experience**. It automates essential processes like table booking, table allocation, and order placement—minimizing wait times, reducing manual errors, and boosting customer satisfaction.

Whether it’s a crowded weekend or a casual weekday, DineWise ensures smooth operations by making table bookings and order processing efficient and hassle-free.

---

## ✨ Key Features

- 🔐 **User Registration & Login**
  - Users (Admin, Manager, Customer) can register and log in securely.
  - Admin approves manager registration requests.

- 📅 **Table Booking**
  - Customers can book a table with basic info.
  - System shows available seating locations.
  - Only one active booking per customer is allowed.

- 🪑 **Table Management**
  - Managers can add/manage tables (table no, seat count, location).
  - Tracks table status (available/occupied).

- 🍔 **Menu & Ordering**
  - Customers can view menu and place orders once seated.
  - Items can be added/updated by the manager.
  - Orders appear on the manager dashboard.

---

## 👥 User Roles

| Role      | Access & Responsibilities |
|-----------|----------------------------|
| **Admin** | Full system control; manages manager accounts. |
| **Manager** | Handles tables, menus, orders, and views reports. |
| **Customer** | Books tables, views menu, places orders. |

---

## 🛠️ Tools & Technologies

**Frontend:**  
`HTML5`, `CSS3`, `JavaScript (ES2022)`, `Bootstrap 5`, `Ajax`, `PHP 7.0`, `XML`

**Backend:**  
`MySQL`, `Java`

**Environment & Tools:**  
- **Web Server:** XAMPP  
- **Editor:** VS Code  
- **Docs:** Microsoft Word  
- **Diagrams:** Draw.io, UMLet 15  
- **Testing:** Selenium IDE, Postman, JMeter  

---

## ⚙️ System Design

- **Use Case Diagrams:** For Admin, Manager, Customer.
- **Activity Diagrams:** For Manager Registration, Login, Booking, Ordering, Menu Management.
- **Database:**  
  - 10 well-structured tables:
    - `admin`, `customer`, `customer_visit`, `tables`, `table_allocated`, `manager`, `item_category`, `menu_item`, `order`, `order_items`
  - Followed normalized design (3NF), with primary/foreign keys and naming standards.

---

## 📱 User Interface

### Customer Pages
- Home
- Book Table + Booking Status
- View Menu
- Order Summary
- Order History

### Manager Pages
- Manager Registration & Login
- Approve Requests
- Add/Manage Tables
- Add/Manage Categories & Items
- View Orders

Each page maps to its respective database logic and provides a clean, responsive UI.

---

## 💻 Coding Standards

- ✅ **Naming:** Uses `camelCase` for variables & functions.
- ✅ **Comments:** Included in complex logic blocks.
- ✅ **Security:** Input sanitization, MD5 hashing for passwords.
- ✅ **Structure:** Organized files, logical folder grouping.
- ✅ **Database:** Uses `VARCHAR` instead of `TEXT`, avoids `NULL` in favor of empty strings.

---

## 🔗 APIs Used

- `move_uploaded_file()` – File upload handling  
- `mysqli_real_escape_string()` – Prevent SQL injection  
- `md5()` – Password encryption  
- `prepare()` + `bind_param()` – Secure SQL queries  
- `fetch_assoc()` – Data fetching  

---

## 📊 Dashboard & Reporting

Interactive dashboard with real-time data from:
- `customer`, `customer_visit`, `tables`, `table_allocated`

### Reports Generated
- 🗓️ **Monthly Items Sold**
- 🏆 **Top-Selling Items**
- 📆 **Orders by Date**
- 💰 **Revenue by Month**

---

## ✅ Testing & Quality Assurance

### Manual Testing:
- Functional, Usability, Interface, Database, and Flow Testing

### Automated Testing:
- Selenium 3.7.12 for:
  - Registration
  - Login
  - Table Booking
  - Manager Approval
  - Menu Management

---

## 📦 Future Suggestions

To make your GitHub repo even more beginner-friendly, consider adding:

- 🧑‍💻 **Installation & Setup Instructions**
- 👥 **Contribution Guidelines**
- 📄 **License Info**

---

**Built with passion to make dining seamless and smart. Enjoy using DineWise RMS!**
