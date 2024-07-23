
# User Dashboard Project

## Overview
This project is a full-stack coding challenge for the company Loaded, showcasing my approach to building a basic dashboard using Laravel for the backend and Vue.js for the frontend. The dashboard showcases a list of users with data about their country and comment activity, including the number of comments made today and the trend compared to the previous day.

<div align="center">
  <h3>Project in Action</h3>
  <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExdzZ6ZWhteGZneXl6Y3JiN3hsbHc5cGN0aTE1YXUwanV2aW5lcDBnaCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/0IIDF8PNDomvTquZQ4/giphy.gif" alt="Project GIF">
</div>

## Project Approach

### Backend (Laravel)
1. **Setup and Configuration**:
   - I set up a Laravel project to handle migrations, models, and queries.
   
2. **Database Migrations**:
   - Created the `users` table with the following properties:
     - `id: number`
     - `first_name: string`
     - `last_name: string`
     - `country: string` (limited to: ['US', 'MX', 'CA'])
     - `created_at: date`
     - `avatar: string`
   - Created the `comments` table with the following properties:
     - `id: number`
     - `user_id: number`
     - `content: string`
     - `created_at: date`

3. **Seeding Data**:
   - Used Faker to fill the tables with mock data, generating 30 users and one week's worth of comments for each user.
   - Ran the seeders to populate the database.

4. **API Endpoint**:
   - Created an API endpoint in `UserController.php` to return user data with the following structure:
     ```json
     [
       {...},
       {
         "id": number,
         "name": string,
         "country": {
           "code": string,
           "name": string
         },
         "avatar": string,
         "comment_activity": {
           "comments_today": number,
           "trend": "higher" | "lower" | "neutral" // Compared to the previous day.
         }
       }
     ]
     ```
   - Implemented pagination to return 5 users per page.

### Frontend (Vue.js)
1. **Setup and Configuration**:
   - Installed Vue.js using Laravel UI.
   
2. **Components**:
   - Created the following components:
     - `Dashboard`: Main component containing the filters and user table.
     - `Pagination`: Component for handling pagination.
     - `Filters`: Component for filtering by country and comment activity trend.
     - `UserTable`: Component for displaying the user data in a table format.

3. **Data Fetching and Display**:
   - Fetched data from the backend endpoint and displayed it in the `UserTable` component.
   - Implemented controls for changing the page, filtering by country and comment activity trend, and sorting by the time the user was created or by the number of comments.
   
4. **Styling and Responsiveness**:
   - Used Tailwind CSS to style the frontend.
   - Ensured the layout is responsive, adjusting the filters and table display for smaller screens.

### Running the Project Locally
1. **Clone the Repository**:
   ```sh
   git clone https://github.com/awr7/fullstack-challenge
   cd fullstack-challenge
   ```

2. **Install Dependencies**:
   ```sh
   composer install
   npm install
   ```

3. **Set Up Environment Variables**:
   - Copy the `.env.example` to `.env` and configure your database settings.

4. **Run Migrations and Seed the Database**:
   ```sh
   php artisan migrate
   php artisan db:seed --class=UserSeeder
   php artisan db:seed --class=CommentSeeder
   ```

5. **Run the Development Servers**:
   - Start the Laravel backend server:
     ```sh
     php artisan serve
     ```
   - Start the Vue.js frontend server:
     ```sh
     npm run dev
     ```

6. **Access the Project**:
   - Open your browser and navigate to `http://localhost:8000`.

