# Social App - Facebook-like Social Media Platform

## Project Overview
A modern social media application built with Laravel 12 backend and React frontend, featuring real-time chat, posts, friendships, and modern UI/UX.

## Tech Stack

### Backend (Laravel 12)
- **Framework**: Laravel 12
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Sanctum
- **Real-time**: Pusher for broadcasting
- **File Storage**: Laravel Storage with Intervention Image
- **API**: RESTful API with proper validation

### Frontend (React 19)
- **Framework**: React 19 with Vite
- **Styling**: Tailwind CSS 4
- **State Management**: Zustand + React Query
- **Routing**: React Router DOM
- **Forms**: React Hook Form
- **Icons**: Lucide React
- **Notifications**: React Hot Toast

## Database Structure

### Core Tables

#### 1. Users Table
```sql
users
├── id (Primary Key)
├── name
├── email (Unique)
├── password (Hashed)
├── email_verified_at
├── remember_token
├── created_at
└── updated_at
```

#### 2. Profiles Table
```sql
profiles
├── id (Primary Key)
├── user_id (Foreign Key -> users.id)
├── username (Unique)
├── bio
├── avatar
├── cover_photo
├── birth_date
├── location
├── website
├── social_links (JSON)
├── is_private
├── created_at
└── updated_at
```

#### 3. Posts Table
```sql
posts
├── id (Primary Key)
├── user_id (Foreign Key -> users.id)
├── content
├── type (text, image, video, link)
├── media (JSON array)
├── metadata (JSON)
├── is_public
├── created_at
└── updated_at
```

#### 4. Friendships Table
```sql
friendships
├── id (Primary Key)
├── user_id (Foreign Key -> users.id)
├── friend_id (Foreign Key -> users.id)
├── status (pending, accepted, rejected, blocked)
├── accepted_at
├── created_at
└── updated_at
```

#### 5. Likes Table
```sql
likes
├── id (Primary Key)
├── user_id (Foreign Key -> users.id)
├── post_id (Foreign Key -> posts.id)
├── type (like, love, haha, wow, sad, angry)
├── created_at
└── updated_at
```

#### 6. Comments Table
```sql
comments
├── id (Primary Key)
├── user_id (Foreign Key -> users.id)
├── post_id (Foreign Key -> posts.id)
├── parent_id (Foreign Key -> comments.id, for replies)
├── content
├── media (JSON)
├── is_edited
├── created_at
└── updated_at
```

#### 7. Conversations & Messages
```sql
conversations
├── id (Primary Key)
├── type (private, group)
├── name (for group chats)
├── avatar (for group chats)
├── created_at
└── updated_at

conversation_user (Pivot Table)
├── id (Primary Key)
├── conversation_id (Foreign Key -> conversations.id)
├── user_id (Foreign Key -> users.id)
├── last_read_at
├── is_muted
├── created_at
└── updated_at

messages
├── id (Primary Key)
├── conversation_id (Foreign Key -> conversations.id)
├── user_id (Foreign Key -> users.id)
├── content
├── type (text, image, video, audio, file)
├── media (JSON)
├── is_edited
├── read_at
├── created_at
└── updated_at
```

## API Endpoints

### Authentication
- `POST /api/register` - User registration
- `POST /api/login` - User login
- `POST /api/logout` - User logout
- `GET /api/me` - Get current user

### Posts
- `GET /api/posts` - Get all public posts
- `POST /api/posts` - Create new post
- `GET /api/posts/{id}` - Get specific post
- `PUT /api/posts/{id}` - Update post
- `DELETE /api/posts/{id}` - Delete post
- `POST /api/posts/{id}/like` - Like/unlike post

### Profiles
- `GET /api/profiles` - Get all profiles
- `GET /api/profiles/{id}` - Get specific profile
- `PUT /api/profiles` - Update own profile

### Friendships
- `GET /api/friends` - Get friends list
- `POST /api/friends/{id}` - Send friend request
- `PUT /api/friends/{id}` - Respond to friend request
- `DELETE /api/friends/{id}` - Remove friendship

### Messages
- `GET /api/conversations` - Get conversations
- `GET /api/conversations/{id}/messages` - Get messages
- `POST /api/conversations/{id}/messages` - Send message
- `POST /api/conversations/start/{id}` - Start conversation

## Frontend Structure

### Components Organization
```
src/
├── components/
│   ├── auth/
│   │   ├── Login.jsx
│   │   └── Register.jsx
│   ├── layout/
│   │   └── Layout.jsx
│   ├── posts/
│   │   ├── CreatePost.jsx
│   │   ├── PostCard.jsx
│   │   └── PostDetail.jsx
│   ├── profile/
│   │   └── Profile.jsx
│   ├── chat/
│   │   └── Chat.jsx
│   ├── Dashboard.jsx
│   └── App.jsx
├── contexts/
│   └── AuthContext.jsx
├── services/
│   └── api.js
├── hooks/
│   └── useAuth.js
├── utils/
│   └── helpers.js
└── index.css
```

### Key Features

#### 1. Authentication System
- User registration and login
- JWT token-based authentication
- Protected routes
- Automatic token refresh

#### 2. Social Feed
- Create posts with text, images, videos
- Like and comment on posts
- Real-time updates
- Infinite scroll pagination

#### 3. User Profiles
- Customizable profile information
- Avatar and cover photo uploads
- Privacy settings
- Friend management

#### 4. Real-time Chat
- Private and group conversations
- File sharing
- Read receipts
- Push notifications

#### 5. Friendship System
- Send/accept friend requests
- Block users
- Privacy controls

## Real-time Features

### Broadcasting Events
- New post notifications
- Friend request updates
- Message notifications
- Like/comment updates

### WebSocket Implementation
- Pusher integration for real-time chat
- Event broadcasting for social interactions
- Live notifications

## Security Features

### Backend Security
- CSRF protection
- SQL injection prevention
- XSS protection
- Rate limiting
- Input validation and sanitization

### Frontend Security
- JWT token storage
- Secure API calls
- Input validation
- XSS prevention

## Performance Optimizations

### Backend
- Database indexing
- Query optimization
- Caching strategies
- File compression
- Lazy loading

### Frontend
- Code splitting
- Lazy component loading
- Image optimization
- Bundle optimization
- Caching strategies

## Deployment

### Backend Deployment
- Laravel Forge or similar
- Environment configuration
- Database setup
- File storage configuration
- SSL certificate setup

### Frontend Deployment
- Vercel, Netlify, or similar
- Build optimization
- CDN configuration
- Environment variables

## Development Setup

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL/PostgreSQL
- Redis (optional)

### Installation Steps

#### Backend
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve
```

#### Frontend
```bash
cd social_react
npm install
npm run dev
```

## Testing Strategy

### Backend Testing
- Unit tests for models
- Feature tests for API endpoints
- Database testing
- Authentication testing

### Frontend Testing
- Component testing
- Integration testing
- E2E testing
- Performance testing

## Monitoring & Analytics

### Backend Monitoring
- Error logging
- Performance monitoring
- Database monitoring
- API usage analytics

### Frontend Analytics
- User behavior tracking
- Performance metrics
- Error tracking
- Conversion analytics

## Future Enhancements

### Planned Features
- Video calling
- Stories feature
- Live streaming
- Advanced search
- Content moderation
- Mobile app
- Push notifications
- Dark mode
- Multi-language support

### Technical Improvements
- GraphQL implementation
- Microservices architecture
- Advanced caching
- CDN optimization
- Mobile-first design
- PWA capabilities

## Contributing Guidelines

### Code Standards
- PSR-12 coding standards
- ESLint configuration
- Prettier formatting
- Git commit conventions
- Code review process

### Development Workflow
- Feature branch workflow
- Pull request process
- Testing requirements
- Documentation updates
- Release management

This structure provides a solid foundation for a scalable, maintainable social media application with modern best practices and comprehensive functionality.
