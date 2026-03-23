# Pandora's Produce E-Commerce Website with Database

## Database Setup Guide

### Step 1: Start your XAMPP server
- Open XAMPP Control Panel
- Start Apache and MySQL services

### Step 2: Create the database
1. Open phpMyAdmin by going to `http://localhost/phpmyadmin`
2. Create a new database named `pandora_produce`
3. Select the database
4. Go to the "SQL" tab
5. Copy and paste all content from `database.sql` file
6. Click "Go" to execute the SQL queries

**OR** use the command line:
```bash
mysql -u root -p < database.sql
```

### Step 3: Access your website
- Main Store: `http://localhost/Hello/myLatestCodes/index.php`
- Shopping Cart: `http://localhost/Hello/myLatestCodes/cart.php`
- Checkout: `http://localhost/Hello/myLatestCodes/checkout.php`
- Admin Orders: `http://localhost/Hello/myLatestCodes/admin.php`

## Database Structure

### Tables Created:

#### 1. **products** - Stores all products
- id (Primary Key)
- name
- description
- price
- emoji
- bg_color
- created_at

#### 2. **users** - Stores customer information
- id (Primary Key)
- email (Unique)
- name
- phone
- address
- created_at

#### 3. **orders** - Stores order information
- id (Primary Key)
- user_email
- subtotal
- total_amount
- tax
- shipping
- status (Pending/Shipped/Completed)
- created_at

#### 4. **order_items** - Stores individual items in each order
- id (Primary Key)
- order_id (Foreign Key to orders)
- product_id (Foreign Key to products)
- product_name
- price
- quantity
- subtotal

## Files Structure

```
📁 myLatestCodes/
├── index.php              (Main product page)
├── header.php             (Navigation header)
├── footer.php             (Footer)
├── cart.php               (Shopping cart)
├── checkout.php           (Checkout form)
├── admin.php              (Admin orders dashboard)
├── api.php                (API endpoints)
├── db-config.php          (Database connection)
├── db-functions.php       (Database queries)
├── style.css              (Main styles)
├── cart-style.css         (Cart page styles)
├── checkout-style.css     (Checkout page styles)
├── admin-style.css        (Admin page styles)
├── script.js              (Main JavaScript)
├── cart.js                (Cart functionality)
├── checkout.js            (Checkout functionality)
├── admin.js               (Admin dashboard)
└── database.sql           (Database schema)
```

## Features Implemented

### 1. **Product Management**
- ✅ 6 sample products stored in database
- ✅ Dynamic product loading from MySQL
- ✅ Product modal with details
- ✅ Add to cart functionality

### 2. **Shopping Cart**
- ✅ LocalStorage-based cart
- ✅ Add/remove items
- ✅ Quantity controls
- ✅ Auto-calculations (subtotal, tax, shipping)
- ✅ Free shipping over $50

### 3. **Checkout**
- ✅ Customer information form
- ✅ Order placement
- ✅ Order saved to database
- ✅ Automatic user profile creation/update

### 4. **Order Management**
- ✅ Orders saved to database
- ✅ Order history tracking
- ✅ Admin dashboard to view all orders
- ✅ Order details modal
- ✅ Customer email and details stored

## How It Works

### User Flow:
1. Browse products on index.php
2. Click "View Details" to see product in modal
3. Select quantity and "Add to Cart"
4. Click cart icon to view cart.php
5. Review items and "Proceed to Checkout"
6. Fill checkout form and place order
7. Order is saved to database automatically

### Admin Flow:
1. Visit `http://localhost/Hello/myLatestCodes/admin.php`
2. View all orders from the database
3. Click "View" on any order to see details
4. See customer information and ordered items

## Testing the System

### Test User:
- Name: John Doe
- Email: john@example.com
- Phone: 555-1234
- Address: 123 Main St, City, State

### Sample Cart:
1. Buy 2x Fresh Apples ($5.99 each)
2. Buy 1x Organic Bananas ($3.49)
3. Total: $15.47 + $5.99 shipping + $1.73 tax = **$23.19**

## Troubleshooting

### "Connection failed" error
- Make sure MySQL is running in XAMPP
- Check database name is `pandora_produce`
- Verify db-config.php has correct credentials

### Orders not showing in admin
- Check database.sql was imported successfully
- Verify orders table exists in phpMyAdmin
- Check that orders are being inserted (check database)

### Cart not persisting
- Clear browser localStorage or cookies
- Check console for JavaScript errors
- Ensure JavaScript is enabled

## Future Enhancements

- User login/registration system
- Email notifications for orders
- Payment gateway integration (Stripe/PayPal)
- Product search functionality
- Order tracking system
- Customer reviews and ratings
- Inventory management
- Discount codes/coupons
