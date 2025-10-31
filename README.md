# SkillShare Platform

A modern web platform that connects tutors and learners, enabling skill sharing and educational collaboration.

## Features

- **User Registration & Authentication**: Secure user registration with role selection (Learner, Tutor, or Both)
- **Skill Management**: Tutors can add and manage their skills with hourly rates and experience levels
- **Session Booking**: Learners can book sessions with tutors for specific skills
- **Profile Management**: Users can manage their profiles and view their sessions
- **Responsive Design**: Modern, mobile-friendly interface using Tailwind CSS

## Database Schema

The platform uses a robust MySQL database with the following main tables:

- `users` - User accounts with roles (tutor, learner, both)
- `skills` - Available skills categorized by type
- `tutor_skills` - Many-to-many relationship linking tutors to their skills
- `sessions` - Booked learning sessions between tutors and learners
- `reviews` - Session reviews and ratings
- `resources` - Learning materials shared by tutors

## Getting Started

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)

### Installation

1. Clone or download the project files to your web server directory
2. Configure your database connection in `query.php`
3. Run the database setup by visiting `reset-database.php` in your browser
4. Access the platform through your web server

### Sample Users

The system comes with pre-configured sample users for testing:

**Tutors:**
- Email: `john@example.com` | Password: `password` | Skills: Web Development, Mobile Apps, Python
- Email: `sarah@example.com` | Password: `password` | Skills: Graphic Design, Video Editing
- Email: `michael@example.com` | Password: `password` | Skills: Data Science, Machine Learning, Math
- Email: `emily@example.com` | Password: `password` | Skills: English, Spanish, French
- Email: `david@example.com` | Password: `password` | Skills: Photography, Video Editing

**Learners:**
- Email: `jane@example.com` | Password: `password`
- Email: `alex@example.com` | Password: `password`
- Email: `robert@example.com` | Password: `password`

**Both (Tutor & Learner):**
- Email: `adam@example.com` | Password: `password` | Skills: Mathematics

## Usage

### For Learners

1. **Register/Login**: Create an account or login with existing credentials
2. **Browse Tutors**: View available tutors and their skills on the main feed
3. **Book Sessions**: Select a tutor, choose date/time, and book a learning session
4. **Manage Sessions**: View your booked sessions in "My Sessions" view
5. **Profile**: Update your profile information

### For Tutors

1. **Register/Login**: Create an account with "Tutor" or "Learner" or "Both" role
2. **Add Skills**: Go to your profile and add skills you can teach
3. **Set Rates**: Define hourly rates and experience levels for each skill
4. **Manage Sessions**: View and manage your teaching sessions
5. **Profile**: Keep your profile updated with bio and contact information

### For Both Roles

Users can select "Both" during registration to act as both tutors and learners, allowing them to teach some skills while learning others.

## File Structure

- `index.php` - Landing page with platform information
- `login.php` - User authentication
- `register.php` - New user registration
- `feed.php` - Main platform feed showing tutors and sessions
- `profile.php` - User profile and skill management
- `query.php` - Database connection and query functions
- `query.txt` - Database schema and sample data
- `reset-database.php` - Database initialization script
- `message.php` - Success/error message display
- `logout.php` - User logout
- `css/` - Stylesheets and design assets
- `js/` - JavaScript files
- `images/` - Platform images and icons

## Security Features

- Password hashing using PHP's `password_hash()` function
- SQL injection protection through parameterized queries
- Session management for user authentication
- Input validation and sanitization

## Customization

The platform is designed to be easily customizable:

- Add new skill categories in the database
- Modify the UI by editing CSS files
- Extend functionality by adding new PHP modules
- Customize the database schema as needed

## Support

For questions or issues, please refer to the code comments or contact the development team.

## License

This project is open source and available under the MIT License.
