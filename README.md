# 🚀 Social App - Facebook-like Social Media Platform

A modern, mobile-first social media application built with **Laravel 12** backend and **React 19** frontend, featuring real-time chat, social interactions, and beautiful UI/UX.

## ✨ Features

### 🔐 Authentication & User Management
- **User Registration & Login** with JWT tokens
- **Profile Management** with customizable avatars and cover photos
- **Privacy Controls** for public/private profiles
- **Social Links** integration (Facebook, Twitter, Instagram, LinkedIn)

### 📱 Social Features
- **Create Posts** with text, images, videos, and links
- **Like & React** with multiple reaction types (like, love, haha, wow, sad, angry)
- **Comments & Replies** with nested comment threads
- **Media Upload** support for images and videos
- **Location Tagging** for posts
- **Privacy Settings** for public/friends-only posts

### 👥 Friendship System
- **Send/Accept Friend Requests**
- **Friend Suggestions** based on mutual connections
- **Block/Unblock Users**
- **Privacy Controls** for friend-only content

### 💬 Real-time Chat
- **Private Conversations** between users
- **Group Chats** with multiple participants
- **Real-time Messaging** with read receipts
- **File Sharing** in conversations
- **Emoji Support** with emoji picker
- **Conversation Search** and management

### 🎨 Modern UI/UX
- **Mobile-First Design** with responsive layouts
- **Beautiful Gradients** and modern aesthetics
- **Smooth Animations** and transitions
- **Dark/Light Mode** support (coming soon)
- **Accessibility Features** for better user experience

## 🛠️ Tech Stack

### Backend (Laravel 12)
- **Framework**: Laravel 12 with PHP 8.2+
- **Database**: MySQL/PostgreSQL with migrations
- **Authentication**: Laravel Sanctum for API tokens
- **Real-time**: Pusher for broadcasting and WebSocket
- **File Storage**: Laravel Storage with Intervention Image
- **API**: RESTful API with comprehensive validation
- **Security**: CSRF protection, rate limiting, input sanitization

### Frontend (React 19)
- **Framework**: React 19 with Vite build tool
- **Styling**: Tailwind CSS 4 with custom components
- **State Management**: Zustand + React Query
- **Routing**: React Router DOM v6
- **Forms**: React Hook Form with validation
- **Icons**: Lucide React icon library
- **Notifications**: React Hot Toast
- **HTTP Client**: Axios with interceptors

## 🗄️ Database Structure

### Core Tables
```sql
users                    # User accounts and authentication
├── id, name, email, password, email_verified_at, created_at, updated_at

profiles                 # Extended user information
├── id, user_id, username, bio, avatar, cover_photo, birth_date, location, website, social_links, is_private

posts                    # Social media posts
├── id, user_id, content, type, media, metadata, is_public, created_at, updated_at

friendships              # User relationships
├── id, user_id, friend_id, status, accepted_at, created_at, updated_at

likes                    # Post reactions
├── id, user_id, post_id, type, created_at, updated_at

comments                 # Post comments and replies
├── id, user_id, post_id, parent_id, content, media, is_edited, created_at, updated_at

conversations            # Chat conversations
├── id, type, name, avatar, created_at, updated_at

conversation_user        # Conversation participants
├── id, conversation_id, user_id, last_read_at, is_muted, created_at, updated_at

messages                 # Chat messages
├── id, conversation_id, user_id, content, type, media, is_edited, read_at, created_at, updated_at
```

## 🚀 Quick Start

### Prerequisites
- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18 or higher
- **MySQL/PostgreSQL**: 8.0 or higher
- **Redis**: 6.0 or higher (optional, for caching)

### 1. Clone the Repository
```bash
git clone <repository-url>
cd social_app
```

### 2. Backend Setup

#### Install Dependencies
```bash
composer install
```

#### Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

#### Database Configuration
Update `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=social_app
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### Pusher Configuration (for real-time features)
```env
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1
```

#### Run Migrations
```bash
php artisan migrate
```

#### Create Storage Link
```bash
php artisan storage:link
```

#### Start Backend Server
```bash
php artisan serve
```

### 3. Frontend Setup

#### Navigate to React Directory
```bash
cd social_react
```

#### Install Dependencies
```bash
npm install
```

#### Environment Configuration
Create `.env` file in `social_react` directory:
```env
VITE_API_URL=https://luckymillion.pro/api
VITE_APP_NAME="Social App"
```

#### Start Development Server
```bash
npm run dev
```

### 4. Access the Application
- **Backend API**: http://localhost:8000
- **Frontend App**: http://localhost:5173
- **API Documentation**: https://luckymillion.pro/api/documentation

## 📱 Mobile-First Design Features

### Responsive Breakpoints
- **Mobile**: 320px - 768px (default)
- **Tablet**: 768px - 1024px
- **Desktop**: 1024px+

### Mobile Optimizations
- **Touch-Friendly** buttons and interactions
- **Swipe Gestures** for navigation
- **Optimized Typography** for small screens
- **Collapsible Menus** and navigation
- **Mobile-First** component architecture

### Progressive Web App (PWA) Features
- **Offline Support** (coming soon)
- **Push Notifications** (coming soon)
- **App-like Experience** on mobile devices
- **Fast Loading** with optimized assets

## 🔌 API Endpoints

### Authentication
```
POST   /api/register          # User registration
POST   /api/login            # User login
POST   /api/logout           # User logout
GET    /api/me               # Get current user
```

### Posts
```
GET    /api/posts            # Get all public posts
POST   /api/posts            # Create new post
GET    /api/posts/{id}       # Get specific post
PUT    /api/posts/{id}       # Update post
DELETE /api/posts/{id}       # Delete post
POST   /api/posts/{id}/like  # Like/unlike post
```

### Profiles
```
GET    /api/profiles         # Get all profiles
GET    /api/profiles/{id}    # Get specific profile
PUT    /api/profiles         # Update own profile
```

### Friendships
```
GET    /api/friends          # Get friends list
POST   /api/friends/{id}     # Send friend request
PUT    /api/friends/{id}     # Respond to friend request
DELETE /api/friends/{id}     # Remove friendship
```

### Messages
```
GET    /api/conversations                    # Get conversations
GET    /api/conversations/{id}/messages     # Get messages
POST   /api/conversations/{id}/messages     # Send message
POST   /api/conversations/start/{id}        # Start conversation
```

## 🎨 UI Components

### Core Components
- **Layout**: Responsive navigation with mobile menu
- **Auth**: Login/Register forms with validation
- **Dashboard**: Social feed with post creation
- **Profile**: User profiles with editing capabilities
- **Chat**: Real-time messaging interface
- **Posts**: Post creation, display, and interaction

### Design System
- **Color Palette**: Blue to purple gradients
- **Typography**: Inter font family
- **Spacing**: Consistent 4px grid system
- **Shadows**: Subtle depth and elevation
- **Animations**: Smooth transitions and micro-interactions

## 🔒 Security Features

### Backend Security
- **JWT Authentication** with Laravel Sanctum
- **CSRF Protection** for web routes
- **Rate Limiting** on API endpoints
- **Input Validation** and sanitization
- **SQL Injection Prevention**
- **XSS Protection**

### Frontend Security
- **Secure Token Storage** in localStorage
- **API Request Validation**
- **Input Sanitization**
- **HTTPS Enforcement** in production

## 📊 Performance Optimizations

### Backend
- **Database Indexing** on frequently queried fields
- **Query Optimization** with eager loading
- **Caching Strategies** with Redis
- **File Compression** and optimization
- **Lazy Loading** for large datasets

### Frontend
- **Code Splitting** with React.lazy()
- **Image Optimization** and lazy loading
- **Bundle Optimization** with Vite
- **Caching Strategies** for static assets
- **Performance Monitoring** (coming soon)

## 🧪 Testing

### Backend Testing
```bash
# Run PHPUnit tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run tests with coverage
php artisan test --coverage
```

### Frontend Testing
```bash
# Run Jest tests
npm test

# Run tests in watch mode
npm run test:watch

# Run tests with coverage
npm run test:coverage
```

## 🚀 Deployment

### Backend Deployment
1. **Server Setup**: Use Laravel Forge, DigitalOcean, or AWS
2. **Environment**: Production environment configuration
3. **Database**: Production database setup
4. **SSL**: HTTPS certificate configuration
5. **Queue Workers**: Background job processing

### Frontend Deployment
1. **Build**: `npm run build`
2. **Hosting**: Vercel, Netlify, or AWS S3
3. **CDN**: CloudFront or similar for global distribution
4. **Environment**: Production environment variables

## 🔧 Development Workflow

### Git Workflow
```bash
# Create feature branch
git checkout -b feature/new-feature

# Make changes and commit
git add .
git commit -m "feat: add new feature"

# Push and create pull request
git push origin feature/new-feature
```

### Code Standards
- **PHP**: PSR-12 coding standards
- **JavaScript**: ESLint + Prettier configuration
- **CSS**: Tailwind CSS utility classes
- **Git**: Conventional commit messages

## 📈 Monitoring & Analytics

### Backend Monitoring
- **Error Logging** with Laravel Telescope
- **Performance Monitoring** with Laravel Debugbar
- **Database Monitoring** with query logging
- **API Usage Analytics** (coming soon)

### Frontend Analytics
- **User Behavior Tracking** (coming soon)
- **Performance Metrics** with Core Web Vitals
- **Error Tracking** with Sentry integration
- **Conversion Analytics** (coming soon)

## 🚧 Roadmap & Future Features

### Phase 1 (Current)
- ✅ User authentication and profiles
- ✅ Post creation and social interactions
- ✅ Real-time chat system
- ✅ Mobile-first responsive design

### Phase 2 (Next)
- 🔄 Video calling and live streaming
- 🔄 Stories feature (24-hour content)
- 🔄 Advanced search and discovery
- 🔄 Content moderation tools

### Phase 3 (Future)
- 📋 Mobile app (React Native)
- 📋 Push notifications
- 📋 Dark mode and themes
- 📋 Multi-language support
- 📋 AI-powered content recommendations

## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guidelines](CONTRIBUTING.md) for details.

### How to Contribute
1. **Fork** the repository
2. **Create** a feature branch
3. **Make** your changes
4. **Test** thoroughly
5. **Submit** a pull request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

### Getting Help
- **Documentation**: Check this README and code comments
- **Issues**: Create a GitHub issue for bugs or feature requests
- **Discussions**: Use GitHub Discussions for questions
- **Email**: Contact the development team

### Common Issues
- **CORS Errors**: Ensure backend CORS configuration matches frontend URL
- **Database Connection**: Verify database credentials and connection
- **File Uploads**: Check storage permissions and disk configuration
- **Real-time Features**: Verify Pusher configuration and credentials

## 🙏 Acknowledgments

- **Laravel Team** for the amazing framework
- **React Team** for the powerful frontend library
- **Tailwind CSS** for the utility-first CSS framework
- **Open Source Community** for inspiration and tools

---

**Made with ❤️ by the Social App Team**

*Building the future of social media, one line of code at a time.*
