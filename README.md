# Medical Tools E-Commerce System

A comprehensive e-commerce platform for medical tools and equipment with multi-role support (Customer, Vendor, Admin) and payment gateway integration.

## Features

### 🔐 Authentication & Registration
- **Customer Registration**: Standard user registration for customers
- **Vendor Registration**: Special registration form for vendors with store information
- **Admin Approval System**: Vendors must be approved by admins before they can sell
- **Role-based Access Control**: Different features for different user roles

### 🛒 Shopping Features
- **Product Browsing**: Browse products by category with search functionality
- **Shopping Cart**: Add products to cart (customers only, login required)
- **Checkout Process**: Complete checkout with shipping information
- **Payment Integration**: Midtrans payment gateway support
- **Order Management**: Track order status and history

### 👨‍💼 Vendor Features
- **Product Management**: Add, edit, delete products
- **Order Notifications**: Receive email notifications for new orders
- **Sales Dashboard**: View sales statistics and order history
- **Store Profile**: Manage store information and settings

### 👨‍💻 Admin Features
- **Vendor Approval**: Approve or reject vendor applications
- **User Management**: Manage customers and vendors
- **Product Management**: Oversee all products in the system
- **Order Management**: Track and manage all orders
- **Category Management**: Manage product categories
- **Review Management**: Moderate product reviews

### 📧 Email Notifications
- **Order Confirmation**: Customers receive order confirmation emails
- **Vendor Notifications**: Vendors receive notifications for new orders
- **Admin Notifications**: Admins are notified of new vendor registrations

## System Requirements

- PHP 8.1 or higher
- Laravel 11.x
- MySQL 8.0 or higher
- Composer
- Node.js & NPM (for frontend assets)

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd medtools
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=medtools
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Configure email settings**
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=your_smtp_host
   MAIL_PORT=587
   MAIL_USERNAME=your_email
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your_email
   MAIL_FROM_NAME="${APP_NAME}"
   ```

7. **Configure Midtrans payment gateway**
   ```env
   MIDTRANS_SERVER_KEY=your_server_key
   MIDTRANS_CLIENT_KEY=your_client_key
   MIDTRANS_IS_PRODUCTION=false
   MIDTRANS_MERCHANT_ID=your_merchant_id
   ```

8. **Run migrations**
   ```bash
   php artisan migrate
   ```

9. **Seed the database (optional)**
   ```bash
   php artisan db:seed
   ```

10. **Build frontend assets**
    ```bash
    npm run build
    ```

11. **Start the development server**
    ```bash
    php artisan serve
    ```

## User Roles

### Customer
- Browse products
- Add items to cart (login required)
- Complete checkout
- View order history
- Write product reviews
- Manage profile

### Vendor
- Register as vendor (requires admin approval)
- Manage products (add, edit, delete)
- View orders for their products
- Receive order notifications
- Manage store profile

### Admin
- Approve/reject vendor applications
- Manage all users
- Oversee all products and categories
- Manage orders and reviews
- View system statistics

## API Endpoints

### Authentication
- `POST /register` - Customer registration
- `POST /vendor/register` - Vendor registration
- `POST /login` - User login
- `POST /logout` - User logout

### Products
- `GET /products` - List all products
- `GET /products/{slug}` - Show product details
- `POST /vendor/products` - Create product (vendor only)
- `PUT /vendor/products/{id}` - Update product (vendor only)
- `DELETE /vendor/products/{id}` - Delete product (vendor only)

### Cart
- `POST /cart/add` - Add item to cart (customer only)
- `GET /cart` - View cart (customer only)
- `PATCH /cart/update/{item}` - Update cart item (customer only)
- `DELETE /cart/remove/{item}` - Remove cart item (customer only)

### Orders
- `POST /checkout` - Process checkout (customer only)
- `GET /orders` - List user orders (customer only)
- `GET /orders/{id}` - Show order details (customer only)
- `POST /checkout/payment-callback` - Payment gateway callback

### Admin
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/vendors` - List vendors
- `PATCH /admin/vendors/{id}/approve` - Approve vendor
- `PATCH /admin/vendors/{id}/reject` - Reject vendor
- `GET /admin/orders` - List all orders
- `PATCH /admin/orders/{id}/update-status` - Update order status

## Database Structure

### Users Table
- `id` - Primary key
- `name` - User's full name
- `email` - Unique email address
- `password` - Hashed password
- `role` - Enum: customer, vendor, admin
- `phone` - Phone number
- `address` - Address
- `store_name` - Vendor's store name
- `store_description` - Vendor's store description
- `is_approved` - Vendor approval status
- `approved_at` - Approval timestamp
- `approved_by` - Admin who approved

### Products Table
- `id` - Primary key
- `name` - Product name
- `slug` - URL-friendly slug
- `description` - Product description
- `price` - Product price
- `category_id` - Foreign key to categories
- `vendor_id` - Foreign key to users (vendor)
- `stock` - Available stock
- `is_active` - Product availability
- `linkImage` - Product image URL

### Orders Table
- `id` - Primary key
- `user_id` - Foreign key to users (customer)
- `total_amount` - Order total
- `shipping_address` - Delivery address
- `phone` - Contact phone
- `payment_method` - Payment method used
- `payment_token` - Payment gateway token
- `status` - Order status
- `notes` - Additional notes

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is licensed under the MIT License.

## Support

For support, please contact the development team or create an issue in the repository.
