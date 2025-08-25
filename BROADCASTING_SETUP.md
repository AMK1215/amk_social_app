# Broadcasting Setup Guide

This guide explains how to set up real-time broadcasting features in the Social App using Laravel Broadcasting and Laravel Reverb.

## Overview

The Social App uses Laravel Broadcasting with Laravel Reverb to provide real-time features including:
- Live post updates
- Real-time notifications
- Live chat messaging
- Friend request notifications
- Post like/unlike updates

## Backend Setup

### 1. Environment Configuration

Update your `.env` file with Reverb credentials:

```env
BROADCAST_CONNECTION=reverb

# Laravel Reverb Configuration
REVERB_APP_ID=474837
REVERB_APP_KEY=rtk5ssu7lwwd90gwtdou
REVERB_APP_SECRET=3kyz2qdflfyv0jdwxfsa
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http
```

### 2. Broadcasting Configuration

The broadcasting configuration is already set up in `config/broadcasting.php` with:
- Default broadcaster: `reverb`
- Public channels for posts
- Private channels for user notifications and conversations
- Authentication middleware for private channels

### 3. Broadcasting Events

The following events are configured to broadcast:

#### PostCreated Event
- **Channel**: `posts` (public), `user.{id}` (private)
- **Triggered**: When a new post is created
- **Data**: Post details, user information, timestamp

#### PostLiked Event
- **Channel**: `post.{id}` (public), `user.{id}` (private)
- **Triggered**: When a post is liked/unliked
- **Data**: Like details, user information, timestamp

#### NewMessage Event
- **Channel**: `conversation.{id}` (private)
- **Triggered**: When a new message is sent
- **Data**: Message content, user information, timestamp

#### FriendRequestReceived Event
- **Channel**: `user.{id}` (private)
- **Triggered**: When a friend request is received
- **Data**: Friendship details, user information, timestamp

### 4. Broadcasting Routes

The broadcasting authentication route is configured at:
```
POST /api/broadcasting/auth
```

This route handles authentication for private channels using Laravel Sanctum.

### 5. Channel Authorization

Channel authorization is handled in `routes/channels.php`:

- **Public Channels**: `posts`, `post.{id}` - accessible to all authenticated users
- **Private Channels**: `user.{id}`, `conversation.{id}` - require authentication and ownership verification

## Frontend Setup

### 1. Dependencies

Install Laravel Echo and Pusher client:
```bash
cd social_react
npm install laravel-echo pusher-js
```

### 2. Configuration

Create a `.env` file in the `social_react` directory:
```env
VITE_APP_NAME="Social App"
VITE_API_URL=https://luckymillion.pro/api
VITE_REVERB_APP_KEY=rtk5ssu7lwwd90gwtdou
VITE_REVERB_HOST=localhost
VITE_REVERB_PORT=8080
VITE_REVERB_SCHEME=http
```

### 3. Broadcasting Service

The `src/services/broadcasting.js` file provides:
- Laravel Echo connection management with Reverb
- Channel subscription methods
- Event handling
- Connection status monitoring

### 4. React Hooks

Custom hooks are available in `src/hooks/useBroadcasting.js`:

- `useBroadcasting()` - Main broadcasting hook
- `usePostsFeed()` - Subscribe to new posts
- `usePostUpdates()` - Subscribe to post updates
- `useUserNotifications()` - Subscribe to user notifications
- `useConversationMessages()` - Subscribe to conversation messages

## Usage Examples

### 1. Real-time Posts Feed

```jsx
import { usePostsFeed } from '../hooks/useBroadcasting';

function PostsFeed() {
    const handleNewPost = (data) => {
        console.log('New post received:', data);
        // Update your posts list
    };

    usePostsFeed(handleNewPost);

    return (
        <div>
            {/* Your posts feed component */}
        </div>
    );
}
```

### 2. Real-time Chat

```jsx
import { useConversationMessages } from '../hooks/useBroadcasting';

function Chat({ conversationId }) {
    const handleNewMessage = (data) => {
        console.log('New message received:', data);
        // Add message to chat
    };

    useConversationMessages(conversationId, handleNewMessage);

    return (
        <div>
            {/* Your chat component */}
        </div>
    );
}
```

### 3. Real-time Notifications

```jsx
import { useUserNotifications } from '../hooks/useBroadcasting';

function Notifications({ userId }) {
    const handleNotification = (data) => {
        console.log('New notification:', data);
        // Show notification toast
    };

    useUserNotifications(userId, handleNotification);

    return (
        <div>
            {/* Your notifications component */}
        </div>
    );
}
```

## Testing Broadcasting

### 1. Backend Testing

Test broadcasting events using Laravel Tinker:

```php
php artisan tinker

// Test PostCreated event
$post = App\Models\Post::first();
event(new App\Events\PostCreated($post));

// Test PostLiked event
$like = App\Models\Like::first();
event(new App\Events\PostLiked($like));
```

### 2. Frontend Testing

Use the browser console to test Pusher connections:

```javascript
// Check connection status
broadcastingService.getConnectionStatus();

// Subscribe to test channel
broadcastingService.subscribeToChannel('posts', 'post.created', (data) => {
    console.log('Received:', data);
});
```

## Troubleshooting

### Common Issues

1. **Connection Failed**
   - Check Pusher credentials in `.env`
   - Verify network connectivity
   - Check browser console for errors

2. **Authentication Failed**
   - Ensure user is authenticated
   - Check CSRF token
   - Verify broadcasting auth route

3. **Events Not Received**
   - Check channel names match
   - Verify event names match
   - Check channel authorization

4. **Private Channel Access Denied**
   - Verify user ownership
   - Check channel authorization logic
   - Ensure proper authentication

### Debug Mode

Enable debug mode in Pusher configuration:

```javascript
// In broadcasting service
this.pusher = new Pusher(PUSHER_CONFIG.appKey, {
    cluster: PUSHER_CONFIG.cluster,
    encrypted: PUSHER_CONFIG.encrypted,
    authEndpoint: PUSHER_CONFIG.authEndpoint,
    enabledTransports: ['ws', 'wss'], // Enable WebSocket debugging
    debug: true, // Enable debug logging
    // ... other options
});
```

## Production Considerations

1. **Security**
   - Use HTTPS in production
   - Implement rate limiting
   - Validate all broadcast data

2. **Performance**
   - Monitor Pusher usage
   - Implement connection pooling
   - Use appropriate cluster regions

3. **Scalability**
   - Consider Redis for high-traffic applications
   - Implement queue workers for heavy operations
   - Monitor memory usage

## Next Steps

1. Set up your Pusher account and get credentials
2. Update environment variables
3. Test broadcasting functionality
4. Implement real-time UI updates
5. Add error handling and reconnection logic
6. Monitor and optimize performance

For more information, refer to:
- [Laravel Broadcasting Documentation](https://laravel.com/docs/broadcasting)
- [Pusher Documentation](https://pusher.com/docs)
- [Laravel Sanctum Documentation](https://laravel.com/docs/sanctum)
